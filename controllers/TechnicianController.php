<?php


namespace app\controllers;

use app\core\Controller;

class TechnicianController extends Controller
{
    public function technicianSignUp()
    {
        $this->setLayout('auth');
        return $this->render('/technician/technician-sign-up');
    }
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
    public function technicianAddNewPost()
    {
        $this->setLayout('auth');
        return $this->render('/technician/technician-add-new-post');
    }
}

