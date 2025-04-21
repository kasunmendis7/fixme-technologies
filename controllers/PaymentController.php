<?php

namespace app\controllers;
use app\core\Controller;
use app\core\Application;
use app\core\Request;
use app\core\Response;
use app\models\CheckoutInfo;
use app\models\Customer;
use app\models\cart;

class PaymentController extends Controller
{
    //function to integrate market place payments 
    public function marketPlacePaymentProcess()
    {
        header('Content-Type: application/json');

        $cus_id = Application::$app->session->get('customer');

        if (!$cus_id) {
            Application::$app->response->setStatusCode(401);
            echo json_encode(['error' => 'Customer not found']);
            exit;
        }

        $customer = (new Customer())->findById($cus_id);
        $cartId = $customer['cart_id'];
        $cartItems = (new Cart())->getCartItemsWithDetails($cartId);

        error_log("Cart Items: " . print_r($cartItems, true));

        $totalAmount = 0;
        $itemDescriptions = [];

        foreach ($cartItems as $item) {
            $totalAmount += $item['price'] * $item['quantity'];
            $itemDescriptions[] = $item['description'] . ' x' . $item['quantity'];
        }

        $checkout = new CheckoutInfo();
        $checkoutInfo = $checkout->listData($cus_id);

        error_log("Checkout Info: " . print_r($checkoutInfo, true));

        $order_id = uniqid();
        $merchant_id = $_ENV['MERCHANT_ID'];
        $merchant_secret = $_ENV['MERCHANT_SECRET'];
        $currency = "LKR";

        $hash = strtoupper(
            md5(
                $merchant_id .
                $order_id .
                number_format($totalAmount, 2, '.', '') .
                $currency .
                strtoupper(md5($merchant_secret))
            )
        );

        $paymentData = [
            'items' => implode(", ", $itemDescriptions),
            'full_name' => $checkoutInfo['full_name'],
            'email' => $checkoutInfo['email'],
            'phone' => $checkoutInfo['phone'],
            'address' => $checkoutInfo['address'],
            'city' => $checkoutInfo['city'],
            'country' => "Sri Lanka",
            'amount' => number_format($totalAmount, 2, '.', ''),
            'merchant_id' => $merchant_id,
            'order_id' => $order_id,
            'currency' => $currency,
            'hash' => $hash,
        ];

        error_log("Payment Data: " . print_r($paymentData, true));

        echo json_encode($paymentData); 
    }

}