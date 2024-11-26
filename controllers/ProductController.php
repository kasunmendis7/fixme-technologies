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
        $productModel = new Product();
        $ser_cen_id = Application::$app->session->get('serviceCenter');

        if (!$ser_cen_id) {
            Application::$app->session->setFlash('error', 'Please log in to create a product.');
            Application::$app->response->redirect('/service-centre-login');
            return;
        }
        $productModel->ser_cen_id = $ser_cen_id;

        if ($request->isPost()) {
            $productModel->loadData($request->getBody());

            if (!empty($_FILES['media']['name'])) {
                $uploadDir = 'assets/uploads/';
                $productModel->media = $_FILES['media']['name'];
                $targetFile = $uploadDir . basename($productModel->media);

                if (!move_uploaded_file($_FILES['media']['tmp_name'], $targetFile)) {
                    Application::$app->session->setFlash('error', 'Failed to upload file.');
                    return $this->render('service-centre/create-product', [
                        'model' => $productModel,
                        'products' => [] // Ensure products is passed even if empty
                    ]);
                }
            }

            if ($productModel->validate() && $productModel->save()) {
                Application::$app->session->setFlash('success', 'Product created successfully.');
                Application::$app->response->redirect('/service-center-create-product');
                return;
            }
        }

        // Fetch products for the logged-in service center
        // Output the dump in the HTML

//        $productModels = $productModel->getProductByServiceCenter($ser_cen_id);

        return $this->render('/service-centre/create-product', [

            'model' => $productModel,
//             'products' => $productModels
             // Pass the products to the view
        ]);
    }

    public function filterProductsById()
    {
        $ser_cen_id = Application::$app->session->get('serviceCenter');
        $productModels = (new Product)->getProductByServiceCenter($ser_cen_id);
        $this->setLayout('auth');
        return $this->render('service-centre/create-product', [
            'products' => $productModels
        ]);
    }


    public function index()
    {
        $productModels = (new Product)->getAllProducts(); // Fetch all products from the database
        $this->setLayout('auth'); // Set layout if needed
        return $this->render('/service-centre/market-place-home', [
            'products' => $productModels // Pass products to the view
        ]);
    }

    public function update(Request $request)
    {
        $productModel = new Product();
        $ser_cen_id = Application::$app->session->get('serviceCenter');
        if (!$ser_cen_id) {
            Application::$app->session->setFlash('error', 'Please log in to update a product.');
            Application::$app->response->redirect('/service-centre-login');
        }
        if ($request->isGet()){
            $product_id = $request->getBody()['product_id'] ?? null;

            if ($product_id) {
                $product = $productModel->getProductByIdAndServiceCenter($ser_cen_id, $product_id);
                if ($product) {
                    $this->setLayout('auth');
                    return $this->render('service-centre/update-product', [
                        'product' => $product
                    ]);
                }
            }
            else {
                Application::$app->session->setFlash('error', 'invalid product id.');
                Application::$app->response->redirect('/service-centre-login');
            }

        }

        if ($request->isPost()) {
            $productModel->loadData($request->getBody());
            $productModel->ser_cen_id = $ser_cen_id;
            if (!empty($_FILES['media']['name'])) {
                $productModel->media = $_FILES['media']['name'];
                move_uploaded_file($_FILES['media']['tmp_name'], 'assets/uploads/' . $productModel->media);
            }
            if ($productModel->editProduct()){
                Application::$app->session->setFlash('success', 'Product updated successfully.');
                Application::$app->response->redirect('/service-center-create-product');
                return;
            }
        }

    }

    public function delete(Request $request){
        $product_id = $request->getBody()['product_id'];
        $ser_cen_id = Application::$app->session->get('serviceCenter');

        if ((new Product())->deleteProduct($product_id, $ser_cen_id)){
            Application::$app->session->setFlash('success', 'Product deleted successfully.');
        }
        else {
            Application::$app->session->setFlash('error', 'Failed to delete product.');
        }
        Application::$app->response->redirect('/service-center-create-product');
    }


}



?>