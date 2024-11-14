<?php
/* Post CRUD Operations */

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\Product;

class ProductController extends Controller
{
    /* Create method of a product */
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

            // Check if the product data is valid and save it to the database
            if ($product->validate() && $product->save()) {
                Application::$app->session->setFlash('success', 'Product added successfully!');
                Application::$app->response->redirect('/marketplace');
                return;
            }
        }

        // Render the product creation view with model data (if any errors)
        return $this->render('/service-centre/marketplace-home', [
            'model' => $product
        ]);
    }

    /* Retrieve and display all products */
    public function index()
    {
//        $products = (new Product)->getAllProducts();

        $this->setLayout('auth');
        return $this->render('/service-centre/marketplace-home', [
            'products' => $products
        ]);
    }
}
