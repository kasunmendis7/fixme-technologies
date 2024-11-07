<?php

namespace app\controllers;
use app\core\Controller;

class ServiceCentreController extends Controller
{
    public function serviceCentreLanding()
    {
        $this->setLayout('auth');
        return $this->render('/service-centre-landing');
    }

    public function serviceCentreDashboard()
    {
        $this->setLayout('auth');
        return $this->render('/service-centre/service-centre-dashboard');
    }

    public function serviceCentreSignup()
    {
        $this->setLayout('auth');
        return $this->render('/service-centre-sign-up');
    }

    public function serviceCentreLogin()
    {
        $this->setLayout('auth');
        return $this->render('/service-centre-login');
    }

    public function serviceCentreMap()
    {
        $this->setLayout('auth');
        return $this->render('service-centre/service-centre-map');
    }

    public function serviceCentreHome()
    {
        $this->setLayout('auth');
        return $this->render('service-centre/service-centre-home');
    }
}