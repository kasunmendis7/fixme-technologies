<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\CustomerRegisterModel;
use app\models\Technician;
use app\models\ServiceCenterRegisterModel;
use app\models\TechnicianLogin;

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
    public function technicianLogin(Request $request, Response $response)
    {
        $technicianLogin = new TechnicianLogin();
        if ($request->isPost()) {
            $technicianLogin->loadData($request->getBody());
            if ($technicianLogin->validate() && $technicianLogin->login()){
                $response->redirect('/');
                return;
            }
        }
        $this->setLayout('auth');
        return $this->render('/technician/technician-login', ['model' => $technicianLogin] );
    }

    public function technicianLogout(Request $request, Response $response)
    {
        Application::$app->logout();
        $response->redirect('/');
    }

    // service centre sign up method
    public function serviceCentreSignup(Request $request)
    {
        $registerModel = new ServiceCenterRegisterModel();
        if ($request->isPost()) {
            $registerModel->loadData($request->getBody());
            if ($registerModel->validate() && $registerModel->save()) {
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
