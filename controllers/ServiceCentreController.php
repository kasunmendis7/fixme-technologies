<?php

namespace app\controllers;
use app\core\Controller;

class ServiceCentreController extends Controller
{
    public function serviceCentreLanding()
    {
        $this->setLayout('auth');
        return $this->render('/service-centre/service-centre-landing');
    }

    public function serviceCentreDashboard()
    {
        $this->setLayout('auth');
        return $this->render('/service-centre/service-centre-dashboard');
    }

    public function serviceCentreSignup()
    {
        $this->setLayout('auth');
        return $this->render('/service-centre/service-centre-sign-up');
    }

    public function serviceCentreLogin()
    {
        $this->setLayout('auth');
        return $this->render('/service-centre/service-centre-login');
    }
}