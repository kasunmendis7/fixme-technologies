<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\Customer;
use app\models\CustomerLoginForm;

//use app\core\Response;
use app\models\CustomerRegisterModel;
use app\models\ServiceCenterLogin;
use app\models\Technician;
use app\models\ServiceCentre;
use app\models\TechnicianLogin;

class AuthController extends Controller
{
    /* customer sign up method */
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

    /* customer login method */
    public function customerLogin(Request $request, Response $response)
    {
        $loginForm = new CustomerLoginForm();
        if ($request->isPost()) {
            $loginForm->loadData($request->getBody());
            if ($loginForm->validate() && $loginForm->login()) {
                $response->redirect('/customer-dashboard'); // later will change this to customer dashboard
                $customer = new Customer();
                $customer->customerAddressGeocoding();
                return;
            }
        }
        $this->setLayout('auth');
        return $this->render('/customer/customer-login', [
            'model' => $loginForm
        ]);
    }

    /* customer logout method */
    public function customerLogout(Request $request, Response $response)
    {
        Application::$app->logoutCustomer();
        $response->redirect('/');
    }

    /* technician sign up method */
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
            if ($technicianLogin->validate() && $technicianLogin->loginTechnician()) {
                $response->redirect('/technician-dashboard');
                $technician = new Technician();
                $technician->technicianAddressGeocoding();
                return;
            }
        }
        $this->setLayout('auth');
        return $this->render('/technician/technician-login', ['model' => $technicianLogin]);
    }

    public function technicianLogOut(Request $request, Response $response)
    {
        Application::$app->logoutTechnician();
        $response->redirect('/');
    }


    /* service centre sign up method */

    public function serviceCentreSignup(Request $request)
    {
        $registerModel = new ServiceCentre();
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

    /* service centre login method */
//    public function serviceCentreLogin(Request $request)
    // service centre login method
    public function serviceCentreLogin(Request $request, Response $response)
    {
        $serviceCenterLogin = new ServiceCenterLogin();
        if ($request->isPost()) {
            $serviceCenterLogin->loadData($request->getBody());
            if ($serviceCenterLogin->validate() && $serviceCenterLogin->loginServiceCenter()) {
                $response->redirect('/service-centre-dashboard');
                $service_centre = new ServiceCentre();
                $service_centre->serviceCentreAddressGeocoding();
                return;
            }
        }
        $this->setLayout('auth');
        return $this->render('/service-centre/service-centre-login', [
            'model' => $serviceCenterLogin
        ]);
    }

    public function serviceCenterLogout(Request $request, Response $response)
    {
        Application::$app->logoutServiceCenter();
        $response->redirect('/service-centre-landing');
    }

}
