<?php
/* Product CRUD Operations */

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\Product;

class ProductController extends Controller
{
    /* Create method for a product */
    public function create(Request $request)
    {
        $product = new Product();

        // Fetch logged-in service center ID from session
        $serviceCenterID = Application::$app->session->get('service_center');

        if ($serviceCenterID) {
            $product->ser_cen_id = $serviceCenterID;
        } else {
            // Set flash message and redirect if not logged in
            Application::$app->session->setFlash('error', 'You must be logged in to create a product.');
            Application::$app->response->redirect('/service-centre-login');
            return;
        }

        // Handle form submission
        if ($request->isPost()) {
            $product->loadData($request->getBody());

            // Check for file upload for media
            if (!empty($_FILES['media']['name'])) {
                $product->media = $_FILES['media']['name'];
            }

            // Validate and save product to the database
            if ($product->validate() && $product->save()) {
                Application::$app->session->setFlash('success', 'Product added successfully!');
                Application::$app->response->redirect('/marketplace');
                return;
            }
        }

        // Render the product creation view with model data (if validation fails)
        return $this->render('/service-centre/marketplace-home', [
            'model' => $product
        ]);
    }

    /* Retrieve and display all products */
    public function index()
    {
        $products = Product::getAllProducts();

        $this->setLayout('auth');
        return $this->render('/service-centre/marketplace-home', [
            'products' => $products
        ]);
    }

    public function edit(Request $request)
    {
        // Fetch the product ID from the request and find the product
        $productID = $request->getBody()['product_id'] ?? null;
        $product = (new Product)->findOne(['product_id' => $productID]);

        if (!$product) {
            Application::$app->session->setFlash('error', 'Product not found.');
            Application::$app->response->redirect('/marketplace');
            return;
        }

        // Fetch the logged-in service_center's ID from the session
        $serviceCenterID = Application::$app->session->get('service_center');
        if ($product->tech_id !== $serviceCenterID) {
            Application::$app->session->setFlash('error', 'Unauthorized access.');
            Application::$app->response->redirect('/marketplace');
            return;
        }

        if ($request->isPost()) {
            $product->loadData($request->getBody());

            // Check if a new media file is uploaded
            if (!empty($_FILES['media']['name'])) {
                $product->media = $_FILES['media']['name'];
                move_uploaded_file($_FILES['media']['tmp_name'], 'assets/products/' . $product->media);
            }

            if ($product->validate() && $product->editProduct()) {
                Application::$app->session->setFlash('success', 'Product updated successfully!');
                Application::$app->response->redirect('/marketplace');
                return;
            }
        }

        return $this->render('/service-centre/marketplace-edit', [
            'product' => $product
        ]);
    }

    public function delete(Request $request)
    {
        // Fetch the product ID from the request
        $productID = $request->getBody()['product_id'] ?? null;
        $serviceCenterID = Application::$app->session->get('service_center');

        if (!$productID || !$serviceCenterID) {
            Application::$app->session->setFlash('error', 'Invalid request.');
            Application::$app->response->redirect('/marketplace');
            return;
        }

        $product = (new Product)->findOne(['product_id' => $productID]);

        if (!$product) {
            Application::$app->session->setFlash('error', 'Product not found.');
            Application::$app->response->redirect('/marketplace');
            return;
        }

        if ($product->ser_cen_id !== $serviceCenterID) {
            Application::$app->session->setFlash('error', 'Unauthorized access.');
            Application::$app->response->redirect('/marketplace');
            return;
        }

        if ((new Product)->deleteProduct($productID, $serviceCenterID)) {
            Application::$app->session->setFlash('success', 'Product deleted successfully!');
        } else {
            Application::$app->session->setFlash('error', 'Failed to delete the product.');
        }

        Application::$app->response->redirect('/marketplace');
    }
}
