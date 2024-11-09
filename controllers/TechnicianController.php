<?php


namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\core\Session;
use app\models\Post;

class TechnicianController extends Controller
{
    public Session $session;
    public string $technicianClass;


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
    public function technicianCommunity()
    {
        $this->setLayout('auth');
        return $this->render('/technician/technician-community');
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
        $post = Post::findOne(['post_id' => $post_id]);

        if (!$post) {
            return $this->render('/technician/technician-community', ['error' => 'Post not found']);
        }

        // Pass the post data to the view
        return $this->render('/technician/technician-edit-post', ['post' => $post]);
    }
}

