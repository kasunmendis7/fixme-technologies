<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\middlewares\AuthMiddleware;
use app\core\Request;
use app\core\Response;
use app\models\cart;

class CartController extends Controller
{


    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware());
    }

    // add product to the cart
    public function addToCartController(Request $request, Response $response)
    {
        $user_id = Application::$app->session->get('customer');

        if (!$user_id) {
            Application::$app->response->redirect('/customer-login');
        }

        $product_id = $request->getBody()['product_id'];
        $quantity = $request->getBody()['quantity'] ?? 1;

        if (!$product_id) {
            Application::$app->session->setFlash('error', 'no id getting ');
        }

        $cart = new Cart();
        if ($cart->addToCart($user_id, $product_id, $quantity)) {
            Application::$app->session->setFlash('success', 'Product add to cart');
            // http_response_code(200); // Set HTTP status code
            // header('Content-Type: application/json'); // Set response header
            // echo json_encode(['message' => 'Product added to cart']);
            Application::$app->response->redirect('/market-place-home');

        } else {
            Application::$app->session->setFlash('error', 'Prodcut add to cart fail');
            // http_response_code(400); // Set HTTP status code
            // header('Content-Type: application/json'); // Set response header
            // echo json_encode(['message' => 'Failed to add product to cart']);
            Application::$app->response->redirect('/market-place-home');
        }
    }

    //function to retrive products
    public function viewCart()
    {
        if (!Application::$app->session->get('customer')) {
            Application::$app->response->redirect('/customer-login');
        }

        $user_id = Application::$app->session->get('customer');
        $cart = new Cart();
        $cartItems = $cart->getCartItems($user_id);

        if (empty($cartItems)) {
            Application::$app->session->setFlash('error', 'Cart is empty');
            Application::$app->response->redirect('/market-place-home');
        }

        $this->setLayout('auth');
        return $this->render('service-centre/view-cart', ['cartItems' => $cartItems]);

    }

    //function to remove cart items
    public function removeItemsFromCart(Request $request, Response $response)
    {
        if (!Application::$app->session->get('customer')) {
            Application::$app->session->setFlash('error', 'Please login first');
            Application::$app->response->redirect('/customer-login');
        }
        $user_id = Application::$app->session->get('customer');
        $product_id = $request->getBody()['product_id'];

        if (!$product_id) {
            Application::$app->session->setFlash('error', 'Select item to remove');
        }
        $cart = new Cart();
        if ($cart->removeCartItem($user_id, $product_id)) {
            Application::$app->response->redirect('/view-cart');
            Application::$app->session->setFlash('success', 'Product remove successfully');
        } else {
            Application::$app->session->setFlash('error', 'Product remove failed, try again');
        }
    }

}