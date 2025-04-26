<?php 

namespace app\controllers;
use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\CheckoutInfo;
use app\core\Response;

class CheckoutInfoController extends Controller
{
    public function saveCheckout(Request $request) {
        if($request->isPost()) {
            $checkoutInfo = new CheckoutInfo();
            $body = $request->getBody();
            $checkoutInfo->loadData([
                'user_id' => Application::$app->session->get('customer'),
                'email' => $body['checkout-email'],
                'phone' => $body['checkout-phone'],
                'full_name' => $body['checkout-name'],
                'address' => $body['checkout-address'],
                'city' => $body['checkout-city'],
                'postal_code' => $body['checkout-postal'],
            ]);
            // $checkoutInfo->user_id = Application::$app->session->get('customer');
            if($checkoutInfo->validate() && $checkoutInfo->save()) {
                Application::$app->session->setFlash('success', 'Checkout information saved successfully!');
                Application::$app->response->redirect('/check-out-page');
            } else {
                Application::$app->session->setFlash('error', 'Failed to save checkout information.');
                Application::$app->response->redirect('/view-cart');
            }
        }
    }

    public function saveCheckoutCustomer(Request $request) {
        if($request->isPost()) {
            $checkoutInfo = new CheckoutInfo();
            $body = $request->getBody();
            $checkoutInfo->loadData([
                'user_id' => Application::$app->session->get('customer'),
                'email' => $body['checkout-email'],
                'phone' => $body['checkout-phone'],
                'full_name' => $body['checkout-name'],
                'address' => $body['checkout-address'],
                'city' => $body['checkout-city'],
                'postal_code' => $body['checkout-postal'],
            ]);
            // $checkoutInfo->user_id = Application::$app->session->get('customer');
            if($checkoutInfo->validate() && $checkoutInfo->save()) {
                Application::$app->session->setFlash('success', 'Checkout information saved successfully!');
                Application::$app->response->redirect('/service-center-check-out-page');
            } else {
                Application::$app->session->setFlash('error', 'Failed to save checkout information.');
                Application::$app->response->redirect('/view-cart');
            }
        }
    }

}