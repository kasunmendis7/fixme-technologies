<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\models\CusTechAdvPayment;
use app\models\CusTechContract;
use app\models\CusTechReq;
use app\models\Customer;
use app\models\ServiceCenter;
use app\models\Technician;

class SiteController extends Controller
{

    public function home()
    {
        $params = [
            'name' => 'Fixme'
        ];
        return $this->render('home', $params);
    }

    public function selectUserLogin()
    {
        $this->setLayout('auth');
        return $this->render('/select-user-login');
    }

    public function selectUserSignUp()
    {
        $this->setLayout('auth');
        return $this->render('/select-user-sign-up');
    }

    public function homeMap()
    {
        $this->setLayout('main');
        return $this->render('/home-map');
    }

    public function homeGeolocationTechnicians()
    {
        header("Access-Control-Allow-Origin: http://localhost:8080");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type");

        $technician = new Technician();
        return $technician->techniciansGeocoding();
    }

    public function homeGeolocationServiceCentres()
    {
        header("Access-Control-Allow-Origin: http://localhost:8080");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type");

        $serviceCenter = new ServiceCenter();
        return $serviceCenter->serviceCentresGeocoding();

    }

    public function aboutUs()
    {
        $this->setLayout('main');
        return $this->render('/about-us');
    }

    public function payHerePaymentProcess()
    {
        header('Content-type: application/json');

        try {
            $jsonData = file_get_contents('php://input');
            $data = json_decode($jsonData, true);

            $customerId = $data['cus_id'];
            $technicianId = $data['tech_id'];

            if (!$customerId || !$technicianId) {
                Application::$app->response->setStatusCode(400);
                return json_encode(['success' => false, 'error' => 'Missing the required parameter customerId, technicianId']);
                exit;
            }

            $cusReq = new CusTechReq();
            $reqId = $cusReq->getRequestId($customerId, $technicianId);
            $order_id = $reqId;

            $cusAdvPay = new CusTechAdvPayment();
            $advancePayment = $cusAdvPay->getAdvancePayment($reqId);
            $amount = $advancePayment['amount'];

            $custInfo = new Customer();
            $customer = $custInfo->findById($customerId);
            $fname = $customer['fname'];
            $lname = $customer['lname'];
            $email = $customer['email'];
            $phone_no = $customer['phone_no'];
            $address = $customer['address'];

            $merchant_id = $_ENV['MERCHANT_ID'];
            $merchant_secret = $_ENV['MERCHANT_SECRET'];
            $currency = "LKR";

            $hash = strtoupper(
                md5(
                    $merchant_id .
                    $order_id .
                    number_format($amount, 2, '.', '') .
                    $currency .
                    strtoupper(md5($merchant_secret))
                )
            );

            $array = [];
            $array["items"] = "Technician Advance Payment";
            $array["first_name"] = $fname;
            $array["last_name"] = $lname;
            $array["email"] = $email;
            $array["phone"] = $phone_no;
            $array["address"] = $address;
//            $array["city"] = "Colombo";
            $array["country"] = "Sri Lanka";
            $array["amount"] = $amount;
            $array["merchant_id"] = $merchant_id;
            $array["order_id"] = $order_id;
            $array["currency"] = $currency;
            $array["hash"] = $hash;

            $jsonObject = json_encode($array);

            echo $jsonObject;
        } catch (\Exception $e) {
            Application::$app->response->setStatusCode(500);
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    public function paymentResponse()
    {
        // Get payment notification data from PayHere
        $merchant_id = $_POST['merchant_id'] ?? '';
        $order_id = $_POST['order_id'] ?? '';
        $payhere_amount = $_POST['payhere_amount'] ?? '';
        $payhere_currency = $_POST['payhere_currency'] ?? '';
        $status_code = $_POST['status_code'] ?? '';
        $md5sig = $_POST['md5sig'] ?? '';

        // Log the received data for debugging
        error_log("PayHere Notification Received: " . json_encode($_POST));

        // Your merchant secret from PayHere dashboard (should be in environment variables)
        $merchant_secret = $_ENV['MERCHANT_SECRET'];

        // Generate the local MD5 signature for verification
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

        // Verify the signature and update the database
        if ($local_md5sig === $md5sig) {
            // The notification is authentic, now check the status code
            if ($status_code == 2) {
                // Payment successful, update the database
                $paymentModel = new CusTechAdvPayment();
                $success = $paymentModel->updatePaymentStatus($order_id);
                $cusTechContract = new CusTechContract();
                $cusTechContract->createCusTechContractUsingReqId($order_id);

                if ($success) {
                    error_log("Payment record updated successfully: OrderID=" . $order_id);
                } else {
                    error_log("Error updating payment record for OrderID=" . $order_id);
                }
            } else {
                // Payment not successful (pending, canceled, failed, or chargedback)
                error_log("Payment not successful. Status code: " . $status_code);
                // Keep the payment status as false (default)
            }
        } else {
            // MD5 signature verification failed, possible security breach
            error_log("MD5 signature verification failed! Possible security breach.");
        }

        // Return 200 OK to acknowledge receipt
        http_response_code(200);
        // No view is needed since this is a server-to-server callback
        exit;
    }
}
