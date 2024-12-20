<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\Comment;
use app\models\Customer;
use app\models\Post;
use app\models\ServiceCenter;
use app\models\Technician;
use app\models\CusTechReq;
use app\models\Chat;

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
            if ($customer->updateValidate()) {
                $customer->updateCustomer();
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
        $this->setLayout('auth');
        return $this->render('/customer/customer-messages');
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

    public function viewCustomerMessages($id)
    {
        $chatModel = new Chat();
        // echo json_encode($id);
        // $id is an array, we need only the first element of that array
        $tech_id = Application::$app->session->get('technician');

        $customer = (new Customer())->findById(intval($id[0]));
        $customers = $chatModel->getChatList($tech_id);
        $this->setLayout('auth');
        if (!$customer) {
            return $this->render('_404');
        }
//        show($technician['fname']);
//        var_dump($tech_id);
//        exit;
        $messages = $chatModel->getChatMessages(intval($id[0]), $tech_id);
        return $this->render('/technician/customer-messages', [
            'customers' => $customers,
            'customer' => $customer,
            'messages' => $messages
        ]);
    }

    public function loadCustomerMessages($id)
    {
        $chatModel = new Chat();
        // echo json_encode($id);
        // $id is an array, we need only the first element of that array
        $tech_id = Application::$app->session->get('technician');

        $customer = (new Customer())->findById(intval($id[0]));
        $this->setLayout('auth');
        if (!$customer) {
            return $this->render('_404');
        }

        $messages = $chatModel->getChatMessages(intval($id[0]), $tech_id);
        return $this->render('/technician/components/load-messages', [
            'customer' => $customer,
            'messages' => $messages
        ]);
    }
}
