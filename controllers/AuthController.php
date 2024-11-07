<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\Customer;
use app\models\Technician;
use app\models\ServiceCenterRegisterModel;

class AuthController extends Controller
{
    // customer sign up method
    public function customerSignUp(Request $request)
    {
        $customer = new Customer();
        if ($request->isPost()) {

            $customer->loadData($request->getBody());
            if ($customer->validate() && $customer->save()) {
                Application::$app->session->setFlash('success', 'You have been registered successfully!');
                Application::$app->response->redirect('/');
            }
            $this->setLayout('auth');
            return $this->render('/customer/customer-sign-up', [
                'model' => $customer
            ]);
        }
        $this->setLayout('auth');
        return $this->render('/customer/customer-sign-up', [
            'model' => $customer
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
        $technician = new Technician();
        if ($request->isPost()) {
            $technician->loadData($request->getBody());

            if ($technician->validate() && $technician->save()) {
                Application::$app->session->setFlash('success', 'You have been registered successfully!');
                Application::$app->response->redirect('/');
            }
            $this->setLayout('auth');
            return $this->render('/technician/technician-sign-up', [
                'model' => $technician
            ]);
        }
        $this->setLayout('auth');
        return $this->render('/technician/technician-sign-up', [
            'model' => $technician
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
          
            if ($registerModel->validate() && $registerModel->save()) {
                Application::$app->session->setFlash('success', 'You have been registered successfully!');
                Application::$app->response->redirect('/');
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
