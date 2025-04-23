<?php

namespace app\controllers;
use app\core\Controller;
use app\core\Application;
use app\core\Request;
use app\core\Response;
use app\models\CheckoutInfo;
use app\models\Customer;
use app\models\cart;
use app\models\MarketplaceOrder;
use app\models\MarketplaceOrderServiceCenter;

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


        $totalAmount = 0;
        $itemDescriptions = [];

        foreach ($cartItems as $item) {
            $totalAmount += $item['price'] * $item['quantity'];
            $itemDescriptions[] = $item['description'] . ' x' . $item['quantity'];
        }

        $checkout = new CheckoutInfo();
        $checkoutInfo = $checkout->listData($cus_id);


        $order_id = uniqid();
        $merchant_id = "1229154";
        $merchant_secret = "MzMzNDA4ODgwMDIyNDA1MjIyNzEyMzE4MjA1NzIyMzM4ODczMDY0Nw==";
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
            "customer_1" => $cus_id,
        ];


        echo json_encode($paymentData);
    }

    //function to market place payment response 
    public function marketPlacePaymentResponse(Request $request, Response $response)
    {
        error_log("Payment Response: " . print_r($_POST, true));
        // $cus_id = Application::$app->session->get('customer');
        $merchant_id = $_POST['merchant_id'] ?? '';
        $order_id = $_POST['order_id'] ?? '';
        $payhere_amount = $_POST['payhere_amount'] ?? '';
        $payhere_currency = $_POST['payhere_currency'] ?? '';
        $status_code = $_POST['status_code'] ?? '';
        $md5sig = $_POST['md5sig'] ?? '';
        $cus_id = $_POST['custom_1'] ?? '';
        error_log("Customer ID>>: " . print_r($cus_id, true));

        $merchant_secret = "MzMzNDA4ODgwMDIyNDA1MjIyNzEyMzE4MjA1NzIyMzM4ODczMDY0Nw==";

        $local_md5sig = strtoupper(
            md5(
                $merchant_id .
                $order_id .
                $payhere_amount .
                $payhere_currency .
                $status_code .
                strtoupper(md5($merchant_secret))
            )
        );

        if ($local_md5sig === $md5sig && $status_code == 2) {
            if (!$cus_id) {
                // Application::$app->response->setStatusCode(401);
                echo json_encode(['error' => 'Customer not found']);
                exit;
            }
            $cartItems = (new Cart())->getCartItemsWithDetailsByCustomer($cus_id);
            error_log("Cart Items>>>>>>: " . print_r($cartItems, true));
            $totalAmount = 0;
            $scTotal = [];

            foreach ($cartItems as $item) {
                $scId = $item['ser_cen_id'];
                $lineTotal = $item['price'] * $item['quantity'];
                $totalAmount += $lineTotal;

                if (!isset($scTotal[$scId])) {
                    $scTotal[$scId] = 0;
                }
                $scTotal[$scId] += $lineTotal;
            }

            error_log("Total Amount: " . print_r($totalAmount, true));
            error_log("Service Center Totals: " . print_r($scTotal, true));

            $order = new MarketplaceOrder();
            $order->order_id = $order_id;
            $order->customer_id = $cus_id;
            $order->total_amount = $totalAmount;
            $order->status = 'completed';
            $order->payed_at = date('Y-m-d H:i:s');
            $order->save();

            // $order->save();

            foreach ($scTotal as $scId => $subTotal) {
                $commission = round($subTotal * 0.1, 2);
                $earning = round($subTotal - $commission, 2);

                $scOrder = new MarketplaceOrderServiceCenter();
                // $scOrder->loadData([
                //     'order_id' => $order_id,
                //     'service_center_id' => $scId,
                //     'sub_total' => $subTotal,
                //     'commission' => $commission,
                //     'seller_earning' => $earning
                // ]);
                $scOrder->order_id = $order_id;
                $scOrder->service_center_id = $scId;
                $scOrder->sub_total = $subTotal;
                $scOrder->commission = $commission;
                $scOrder->seller_earning = $earning;
                $scOrder->save();
            }
            // http_response_code(response_code: 200);
            exit;
        }



    }

}