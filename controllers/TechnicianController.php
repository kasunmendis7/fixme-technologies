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
}

