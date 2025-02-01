<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\Chat;
use app\models\Customer;
use app\models\Technician;

class ChatController extends Controller
{
    public function loadCustomerList()
    {
        $tech_id = Application::$app->session->get('technician');
        $model = new Chat();

        // Get customer chat list
        $customers = $model->getCustomerChatList($tech_id);

        $this->setLayout('auth');
        return $this->render('/technician/components/load-user-list', [
            'customers' => $customers
        ]);
    }

    public function loadTechnicianList()
    {
        $cus_id = Application::$app->session->get('customer');
        $model = new Chat();

        // Get customer chat list
        $technicians = $model->getTechnicianChatList($cus_id);

        $this->setLayout('auth');
        return $this->render('/customer/components/load-user-list', [
            'technicians' => $technicians
        ]);
    }

    public function viewCustomerMessages($id)
    {
        $chatModel = new Chat();
        $customerId = intval($id[0]);

        $tech_id = Application::$app->session->get('technician');

        $customer = $chatModel->findCustomerById($customerId);
        $customers = $chatModel->getCustomerChatList($tech_id);
        $this->setLayout('auth');
        if (!$customer) {
            return $this->render('_404');
        }

        $messages = $chatModel->customerChatMessages($customerId, $tech_id);
        return $this->render('/technician/customer-messages', [
            'customers' => $customers,
            'customer' => $customer,
            'messages' => $messages
        ]);
    }

    public function viewTechnicianMessages($id)
    {
        $chatModel = new Chat();
        $technicianId = intval($id[0]);

        $cus_id = Application::$app->session->get('customer');

        $technician = $chatModel->findTechnicianById($technicianId);
        $technicians = $chatModel->getTechnicianChatList($cus_id);
        $this->setLayout('auth');
        if (!$technician) {
            return $this->render('_404');
        }

        $messages = $chatModel->technicianChatMessages($technicianId, $cus_id);
        return $this->render('/customer/technician-messages', [
            'technicians' => $technicians,
            'technician' => $technician,
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

        $messages = $chatModel->customerChatMessages(intval($id[0]), $tech_id);
        return $this->render('/technician/components/load-messages', [
            'customer' => $customer,
            'messages' => $messages
        ]);
    }

    public function loadTechnicianMessages($id)
    {
        $chatModel = new Chat();
        // echo json_encode($id);
        // $id is an array, we need only the first element of that array
        $cus_id = Application::$app->session->get('customer');

        $technician = (new Technician())->findById(intval($id[0]));
        $this->setLayout('auth');
        if (!$technician) {
            return $this->render('_404');
        }

        $messages = $chatModel->technicianChatMessages(intval($id[0]), $cus_id);
        return $this->render('/customer/components/load-messages', [
            'technician' => $technician,
            'messages' => $messages
        ]);
    }

    public function technicianSendMessage()
    {
        header('Content-type: application/json');

        try {
            $jsonData = file_get_contents('php://input');
            $data = json_decode($jsonData, true);

            $outgoingMsgId = $data['outgoing_msg_id'];
            $incomingMsgId = $data['incoming_msg_id'];
            $message = $data['message'];

            if (!$incomingMsgId || !$outgoingMsgId) {
                Application::$app->response->setStatusCode(400);
                return json_encode(['success' => false, 'error' => 'Missing the required parameter customerId, technicianId']);
                exit;
            }

            $chatModel = new Chat();
            $res = $chatModel->technicianSaveMessage($outgoingMsgId, $incomingMsgId, $message);
            return json_encode($res);

        } catch (\Exception $e) {
            Application::$app->response->setStatusCode(500);
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    public function customerSendMessage()
    {
        header('Content-type: application/json');

        try {
            $jsonData = file_get_contents('php://input');
            $data = json_decode($jsonData, true);

            $outgoingMsgId = $data['outgoing_msg_id'];
            $incomingMsgId = $data['incoming_msg_id'];
            $message = $data['message'];

            if (!$incomingMsgId || !$outgoingMsgId) {
                Application::$app->response->setStatusCode(400);
                return json_encode(['success' => false, 'error' => 'Missing the required parameter customerId, technicianId']);
                exit;
            }

            $chatModel = new Chat();
            $res = $chatModel->customerSaveMessage($outgoingMsgId, $incomingMsgId, $message);
            return json_encode($res);

        } catch (\Exception $e) {
            Application::$app->response->setStatusCode(500);
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    }
}