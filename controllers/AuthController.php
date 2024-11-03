<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\models\RegisterModel;

class AuthController extends Controller
{

    public function customerSignUp(Request $request)
    {
        $registerModel = new RegisterModel();
        if ($request->isPost()) {

            $registerModel->loadData($request->getBody());
            if ($registerModel->validate() && $registerModel->register()) {
                return 'Success';
            }
            show($registerModel->errors);
            $this->setLayout('auth');
            return $this->render('customer-sign-up', [
                'model' => $registerModel
            ]);
        }
        $this->setLayout('auth');
        return $this->render('customer-sign-up', [
            'model' => $registerModel
        ]);
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
