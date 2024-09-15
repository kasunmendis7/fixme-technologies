<?php


namespace app\controllers;

use app\core\Controller;

class TechnicianController extends Controller
{
    public function technicianSignUp()
    {
        $this->setLayout('auth');
        return $this->render('/technician-sign-up');
    }
    public function technicianLanding()
    {
        $this->setLayout('auth');
        return $this->render('/technician-landing');
    }
    public function technicianAddNewPost()
    {
        $this->setLayout('auth');
        return $this->render('/technician-add-new-post');
    }
}

