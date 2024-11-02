<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;

class AuthController extends Controller
{

    public function customerSignUp(Request $request)
    {
        if ($request->isPost()) {
            return 'Handle submitted data';
        }
        $this->setLayout('auth');
        return $this->render('customer-sign-up');
    }
    public function technicianSignUp(Request $request)
    {
        if ($request->isPost()) {
            return 'Handle submitted data';
        }
        $this->setLayout('auth');
        return $this->render('technician-sign-up');
    }
    public function serviceCentreSignup(Request $request)
    {
        if ($request->isPost()) {
            return 'Handle submitted data';
        }
        $this->setLayout('auth');
        return $this->render('service-centre-sign-up');
    }
    public function serviceCentreLogin(Request $request)
    {
        if ($request->isPost()) {
            return 'Handle submitted data';
        }
        $this->setLayout('auth');
        return $this->render('service-centre-login');
    }
}
