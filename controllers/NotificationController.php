<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\Customer;
use app\models\Notification;
use app\models\Post;
use app\models\Appointment;
use app\models\ServiceCenter;

class NotificationController extends Controller
{

    //function to get notifications for the user
    public function getNotificationsForUser(Request $request)
    {
        $user_id = Application::$app->session->get('customer');
        if (!$user_id) {
            http_response_code(401); // Unauthorized
            echo json_encode(['error' => 'Not logged in']);
            return;
        }

        $notification = new Notification();
        $notifications = $notification->getUserNotifications($user_id);

        header('Content-Type: application/json');
        echo json_encode($notifications);
        return;
    }


    //function to get notifications for the service center
    public function getNotificationsForServiceCenter(Request $request)
    {
        $ser_cen_id = Application::$app->session->get('serviceCenter');

        if (!$ser_cen_id) {
            http_response_code(401);
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Not logged in']);
            exit;
        }

        $notification = new Notification();
        $notifications = $notification->getServiceCenterNotifications($ser_cen_id);

        header('Content-Type: application/json');
        echo json_encode($notifications);
        exit;
    }

    //function mark as read 
    public function markAsRead($id)
    {
        // If $id is an array, extract the first value
        if (is_array($id)) {
            $id = $id[0]; // Get the first element in the array
        }

        // Log the corrected value
        error_log('Notification ID received: ' . var_export($id, true));

        $notification = new Notification();
        $res = $notification->markAsRead($id);

        if ($res) {
            http_response_code(200);
            header('Content-Type: application/json');
            echo json_encode(['status' => 'success', 'message' => 'Marked as read']);
            Application::$app->session->setFlash('success', 'Marked as read');
        } else {
            http_response_code(500);
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => 'Failed to mark as read']);
        }
    }


    public function deleteNotificationForServiceCenter(Request $request)
    {
        $ser_cen_id = Application::$app->session->get('serviceCenter');
        if (!$ser_cen_id) {
            http_response_code(401);
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Not logged in']);
            exit;
        }
        $notification = new Notification();
        $res = $notification->deleteReadMessagesForServiceCenter($ser_cen_id);
        if ($res) {
            http_response_code(200);
            header('Content-Type: application/json');
            echo json_encode(['status' => 'success', 'message' => 'Deleted successfully']);
        } else {
            http_response_code(500);
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => 'Failed to delete']);
        }
    }

}