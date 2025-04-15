<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\Chat;
use app\models\Comment;
use app\models\CusTechAdvPayment;
use app\models\Customer;
use app\models\Post;
use app\models\ServiceCenter;
use app\models\Technician;
use app\models\CusTechReq;
use app\models\CustomerPaymentMethod;

class CustomerController extends Controller
{

    public function customerDashboard()
    {
        $this->setLayout('auth');
        return $this->render('/customer/customer-dashboard');
    }

    public function customerSettings()
    {
        $this->setLayout('auth');
        return $this->render('/customer/customer-settings');
    }

    public function customerHelp()
    {
        $this->setLayout('auth');
        return $this->render('/customer/customer-help');
    }

    public function customerProfile()
    {
        $this->setLayout('auth');
        return $this->render('/customer/customer-profile');
    }

    public function customerTechnicians()
    {
        $this->setLayout('auth');
        return $this->render('/customer/customer-technicians');
    }

    public function customerServiceCenters()
    {
        $this->setLayout('auth');
        return $this->render('/customer/customer-service-centers');
    }

    public function serviceCenterProfile()
    {
        $this->setLayout('auth');
        return $this->render('/customer/service-center-profile');
    }

    public function customerMap()
    {
        $this->setLayout('auth');
        return $this->render('/customer/customer-map');
    }

    public function getTechnicianGeocoding()
    {
        header("Access-Control-Allow-Origin: http://localhost:8080");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type");

        $technician = new Technician();
        return $technician->techniciansGeocoding();
    }

    public function getServiceCentresGeocoding()
    {
        header("Access-Control-Allow-Origin: http://localhost:8080");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type");

        $serviceCenter = new ServiceCenter();
        return $serviceCenter->serviceCentresGeocoding();
    }

    public function customerLocation()
    {
        header("Access-Control-Allow-Origin: http://localhost:8080");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type");

        $customer = new Customer();
        return $customer->getCustomerLocation();
    }

    public function updateCustomerProfile(Request $request)
    {
        $customer = new Customer();

        if ($request->isPost()) {
            $customer->loadData($request->getBody());

            if (!empty($_FILES['profile_picture']['name'])) {
                $file = $_FILES['profile_picture'];
                $fileName = $file['name'];
                $fileTmpName = $file['tmp_name'];
                $fileSize = $file['size'];
                $fileError = $file['error'];
                $fileType = $file['type'];
                $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
                $maxSize = 2 * 1024 * 1024; // max file size 2MB

                if (!in_array($fileType, $allowedTypes)) {
                    throw new \Exception('Unsupported file type. Please upload a JPEG, PNG or JPG file.');
                }
                if ($fileSize > $maxSize) {
                    throw new \Exception('File size exceeds the 2MB limit.');
                }

                $uploadDir = dirname(__DIR__) . '/public/uploads/profile-pictures/customer/';
                $newFileName = uniqid('profile_', true) . '.' . pathinfo($fileName, PATHINFO_EXTENSION);
                $destination = $uploadDir . $newFileName;

                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                if (!move_uploaded_file($fileTmpName, $destination)) {
                    throw new \Exception('Failed to upload the file');
                }

                $customerId = Application::$app->session->get('customer');
                $relativePath = '/uploads/profile-pictures/customer/' . $newFileName;
                $sql = 'UPDATE customer SET profile_picture = :profile_picture WHERE cus_id = :cus_id';
                $stmt = Application::$app->db->prepare($sql);
                $stmt->bindValue(':profile_picture', $relativePath);
                $stmt->bindValue(':cus_id', $customerId);
                $stmt->execute();
            }

            if ($customer->updateValidate()) {
                $customer->updateCustomer();
                $customer->customerAddressGeocoding();
                Application::$app->session->setFlash('update-success', 'You have been Updated your account info successfully!');
                Application::$app->response->redirect('/customer-profile');
            } else {
                Application::$app->response->redirect('/customer-profile');
            }
        }
    }

    public function cusTechReq()
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
            $res = $cusReq->createCusTechReq($customerId, $technicianId);
            return json_encode($res);

        } catch (\Exception $e) {
            Application::$app->response->setStatusCode(500);
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    public function deleteCusTechReq()
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
            $res = $cusReq->deleteCusTechReq($customerId, $technicianId);
            return json_encode($res);

        } catch (\Exception $e) {
            Application::$app->response->setStatusCode(500);
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }

    }

    public function fixmeCommunity()
    {

        $posts = (new Post)->getAllPostsWithLikes(Application::$app->customer->cus_id);
        foreach ($posts as &$post) {
            $post['comments'] = (new Comment)->getAllComments($post['post_id']);
        }
        $this->setLayout('auth');
        return $this->render('/customer/fixme-community', [
            'posts' => $posts
        ]);
    }

    public function customerMessages()
    {
        $cus_id = Application::$app->session->get('customer');
        $model = new Chat();

        // Get customer chat list
        $technicians = $model->getTechnicianChatList($cus_id);
        $this->setLayout('auth');
        return $this->render('/customer/customer-messages', [
            'technicians' => $technicians
        ]);
    }

    public function customerVehicleIssue()
    {
        $this->setLayout('auth');
        return $this->render('/customer/customer-vehicle-issue');
    }

    public function customerTransactions()
    {
        $this->setLayout('auth');
        return $this->render('/customer/customer-transactions');
    }

    public function customerPaymentDetails()
    {
        $this->setLayout('auth');
        return $this->render('/customer/customer-payment-details');
    }

    public function customerPaymentMethod()
    {
        $request = json_decode(file_get_contents('php://input'), true);

        $cardNumber = $request['card_number'] ?? null;
        $expiryDate = $request['expiry_date'] ?? null;
        $cardName = $request['card_name'] ?? null;

        if (!$cardNumber || !$expiryDate || !$cardName) {
            echo json_encode(['success' => false, 'message' => 'Invalid input.']);
            exit;
        }

        $lastFour = substr($cardNumber, -4);
        $maskedCardNumber = str_repeat("*", 12) . $lastFour;

        $paymentMethod = new CustomerPaymentMethod();
        $cusId = Application::$app->session->get('customer');
        $paymentMethod->addPaymentMethod($cusId, $lastFour, $cardName, $expiryDate);

        // Respond to frontend
        echo json_encode([
            'success' => true,
            'message' => 'Payment method stored successfully.',
            'data' => [
                'card_holder_name' => $cardName,
                'card_number' => $maskedCardNumber,
                'expiry_date' => $expiryDate,
            ],
        ]);
        exit;
    }

    public function getCustomerPaymentMethods()
    {
        try {
            $cusId = Application::$app->session->get('customer');
            if (!$cusId) {
                throw new \Exception('Customer not logged in ');
            }

            $paymentMethodModel = new CustomerPaymentMethod();
            $paymentMethods = $paymentMethodModel->getPaymentMethods($cusId);
            echo json_encode(['success' => true, 'data' => $paymentMethods]);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function deleteCustomerPaymentMethod($id)
    {
        try {
            $cusId = Application::$app->session->get('customer');
            $id = intval($id[0]);
            if (!$cusId) {
                throw new \Exception('Customer not logged in');
            }
            $paymentMethodModel = new CustomerPaymentMethod();
            $paymentMethodModel->deletePaymentMethod($id, $cusId);

            echo json_encode(['success' => true, 'message' => 'Payment method deleted successfully']);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function getCustomerAdvancePayments()
    {
        try {
            $cus_id = Application::$app->session->get('customer');
            $advPayModel = new CusTechAdvPayment();
            $data = $advPayModel->getPendingAdvancePayments($cus_id);
            return $data;

        } catch (\Exception $e) {
            http_response_code(500);
        }
    }

    public function customerAdvancePayments()
    {
        $adv_payments = self::getCustomerAdvancePayments();

        $this->setLayout('auth');
        return $this->render('/customer/customer-advance-payments', ['adv_payments' => $adv_payments]);
    }

    public function rejectAdvPaymentUsingReqId($req_id)
    {
        $req_id = intval($req_id[0]);
        (new CusTechAdvPayment())->deleteAdvPaymentUsingReqId($req_id);
        (new CusTechReq())->deleteCusTechReqUsingReqId($req_id);
        Application::$app->response->redirect('/customer-advance-payments');
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

    public function updatePaymentStatus()
    {
        header('Content-type: application/json');

        try {
            $jsonData = file_get_contents('php://input');
            $data = json_decode($jsonData, true);

            $requestId = $data['req_id'];
            $paymentModel = new CusTechAdvPayment();
            $paymentModel->updatePaymentStatus($requestId);

            echo json_encode(['success' => true]);
        } catch (\Exception $e) {
            Application::$app->response->setStatusCode(500);
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }

    }

}
