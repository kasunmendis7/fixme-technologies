<?php


namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\Customer;
use app\models\Post;
use app\models\Technician;

class TechnicianController extends Controller
{

    public function technicianLanding()
    {
        $this->setLayout('auth');
        return $this->render('/technician/technician-landing');
    }

    public function technicianHome()
    {
        $this->setLayout('auth');
        return $this->render('/technician/technician-home');
    }

    public function technicianDashboard()
    {
        $this->setLayout('auth');
        return $this->render('/technician/technician-dashboard');
    }

    public function technicianMap()
    {
        $this->setLayout('auth');
        return $this->render('/technician/technician-map');
    }

    public function technicianMessages()
    {
        $this->setLayout('auth');
        return $this->render('/technician/technician-messages');
    }

    public function technicianSettings()
    {
        $this->setLayout('auth');
        return $this->render('/technician/technician-settings');
    }

    public function technicianHelp()
    {
        $this->setLayout('auth');
        return $this->render('/technician/technician-help');
    }

    public function technicianProfile()
    {
        $this->setLayout('auth');
        return $this->render('/technician/technician-profile');
    }

    public function updateTechnicianProfile(Request $request)
    {
        $technician = new Technician();

        if ($request->isPost()) {
            $technician->loadData($request->getBody());
            if ($technician->updateValidate()) {
                $technician->updateTechnician();
                Application::$app->session->setFlash('update-success', 'You have been Updated your account info successfully!');
                Application::$app->response->redirect('/technician-profile');
            } else {
                Application::$app->response->redirect('/technician-profile');
            }
        }
    }

    public function technicianCreatePost()
    {
        $this->setLayout('auth');
        return $this->render('/technician/technician-create-post');
    }

    public function technicianEditPost(Request $request)
    {
        $this->setLayout('auth');

        // Retrieve the post_id from the request (assuming it's passed as a query parameter)
        $post_id = $request->getBody()['post_id'] ?? null;
        if (!$post_id) {
            return $this->render('/technician/technician-community', ['error' => 'Post not found']);
        }

        // Load post data from the database
        $post = (new Post)->findOne(['post_id' => $post_id]);

        if (!$post) {
            return $this->render('/technician/technician-community', ['error' => 'Post not found']);
        }

        // Pass the post data to the view
        return $this->render('/technician/technician-edit-post', ['post' => $post]);
    }

    public function viewTechnicianProfile($id)
    {
        // echo json_encode($id);
        // $id is an array, we need only the first element of that array
        $technician = (new Technician())->findById(intval($id[0]));
        $this->setLayout('auth');
        if (!$technician) {
            return $this->render('_404');
        }
//        show($technician['fname']);
        return $this->render('/customer/technician-profile', ['technician' => $technician]);
    }
}

