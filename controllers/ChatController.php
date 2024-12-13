<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\Chat;

class ChatController extends Controller
{

    public function sendMessage(Request $request)
    {
        $data = $request->getBody();
        $tech_id = Application::$app->session->get('technician');

        $model = new Chat();
        $model->saveMessage($tech_id, $data['cus_id'], $data['message']);

        return json_encode(['status' => 'success']);
    }

    public function loadMessages(Request $request)
    {
        $data = $request->getBody();
        $tech_id = Application::$app->session->get('technician');
        $cus_id = $data['cus_id'];

        $model = new Chat();
        $messages = $model->getChatMessages($tech_id, $cus_id);

        return json_encode($messages);
    }
}
