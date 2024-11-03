<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\models\CustomerRegisterModel;
use app\models\TechnicianRegisterModel;
use app\models\ServiceCenterRegisterModel;

class AuthController extends Controller
{
    // customer sign up method
    public function customerSignUp(Request $request)
    {
        $registerModel = new CustomerRegisterModel();
        if ($request->isPost()) {

            $registerModel->loadData($request->getBody());
            if ($registerModel->validate() && $registerModel->register()) {
                return 'Success';
            }
            $this->setLayout('auth');
            return $this->render('/customer/customer-sign-up', [
                'model' => $registerModel
            ]);
        }
        $this->setLayout('auth');
        return $this->render('/customer/customer-sign-up', [
            'model' => $registerModel
        ]);
    }
    // customer login method
    public function customerLogin(Request $request)
    {
        if ($request->isPost()) {
            return 'Handle submitted data';
        }
        $this->setLayout('auth');
        return $this->render('/customer/customer-login');
    }
    // technician sign up method
    public function technicianSignUp(Request $request)
    {
        $registerModel = new TechnicianRegisterModel();
        if ($request->isPost()) {
            $registerModel->loadData($request->getBody());
            if ($registerModel->validate() && $registerModel->register()) {
                return 'Success';
            }
            $this->setLayout('auth');
            return $this->render('/technician/technician-sign-up', [
                'model' => $registerModel
            ]);
        }
        $this->setLayout('auth');
        return $this->render('/technician/technician-sign-up', [
            'model' => $registerModel
        ]);
    }
    // technician login method
    public function technicianLogin(Request $request)
    {
        $this->setLayout('auth');
        return $this->render('/technician/technician-login');
    }
    // service centre sign up method
    public function serviceCentreSignup(Request $request)
    {
        $registerModel = new ServiceCenterRegisterModel();
        if ($request->isPost()) {
            $registerModel->loadData($request->getBody());
            if ($registerModel->validate() && $registerModel->register()) {
                return 'Success';
            }
            $this->setLayout('auth');
            return $this->render('/service-centre/service-centre-sign-up', [
                'model' => $registerModel
            ]);
        }
        $this->setLayout('auth');
        return $this->render('/service-centre/service-centre-sign-up', [
            'model' => $registerModel
        ]);
    }
    // service centre login method
    public function serviceCentreLogin(Request $request)
    {
        if ($request->isPost()) {
            return 'Handle submitted data';
        }
        $this->setLayout('auth');
        return $this->render('/service-centre/service-centre-login');
    }
}
