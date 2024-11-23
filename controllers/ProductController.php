<?php

namespace app\controllers;
use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\Product;

class ProductController extends Controller
{
    public function create(Request $request)
    {
        $product = new Product();
        $ser_cen_id = Application::$app->session->get('serviceCenter');

        if (!$ser_cen_id) {
            Application::$app->session->setFlash('error', 'Please log in to create a product.');
            Application::$app->response->redirect('/service-centre-login');
            return;
        }
        $product->ser_cen_id = $ser_cen_id;

        if ($request->isPost()) {
            $product->loadData($request->getBody());

            if (!empty($_FILES['media']['name'])) {
                $uploadDir = 'assets/uploads/';
                $product->media = $_FILES['media']['name'];
                $targetFile = $uploadDir . basename($product->media);

                if (!move_uploaded_file($_FILES['media']['tmp_name'], $targetFile)) {
                    Application::$app->session->setFlash('error', 'Failed to upload file.');
                    return $this->render('service-centre/create-product', [
                        'model' => $product,
                        'products' => [] // Ensure products is passed even if empty
                    ]);
                }
            }

            if ($product->validate() && $product->save()) {
                Application::$app->session->setFlash('success', 'Product created successfully.');
                Application::$app->response->redirect('/service-center-create-product');
                return;
            }
        }

        // Fetch products for the logged-in service center
        // Output the dump in the HTML

//        $products = $product->getProductByServiceCenter($ser_cen_id);

        return $this->render('/service-centre/create-product', [

            'model' => $product,
//             'products' => $products
             // Pass the products to the view
        ]);
    }

    public function filterProductsById()
    {
        $ser_cen_id = Application::$app->session->get('serviceCenter');
        $products = (new Product)->getProductByServiceCenter($ser_cen_id);
        $this->setLayout('auth');
        return $this->render('service-centre/create-product', [
            'products' => $products
        ]);
    }

    public function index()
    {
        $products = (new Product)->getAllProducts(); // Fetch all products from the database
        $this->setLayout('auth'); // Set layout if needed
        return $this->render('/service-centre/market-place-home', [
            'products' => $products // Pass products to the view
        ]);
    }

    public function update(Request $request)
    {
        $product = new Product();
        $ser_cen_id = Application::$app->session->get('serviceCenter');

        if (!$ser_cen_id) {
            Application::$app->session->setFlash('error', 'Please log in to create a product.');
            Application::$app->response->redirect('/service-centre-login');
        }

        if ($request->isPost()) {
            $product->loadData($request->getBody());
            $product->ser_cen_id = $ser_cen_id;

            if (!empty($_FILES['media']['name'])) {
                $uploadDir = 'assets/uploads/';
                $fileName = uniqid() . '_' . basename($_FILES['media']['name']);
                $targetFile = $uploadDir . $fileName;

                if (!move_uploaded_file($_FILES['media']['tmp_name'], $targetFile)) {
                    Application::$app->session->setFlash('error', 'Failed to upload file.');
                    Application::$app->response->redirect('/service-center-create-product');
                    return;
                }

                $product->media = $fileName;
            }
            if ($product->editProduct()){
                Application::$app->session->setFlash('success', 'Product updated successfully.');
                Application::$app->response->redirect('/service-center-create-product');
            }
            else {
                Application::$app->session->setFlash('error', 'Failed to update product.');
            }
            Application::$app->response->redirect('/service-center-create-product');
        }
    }


}



?>