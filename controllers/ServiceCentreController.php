<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\ServiceCenterRegisterModel;

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

    public function serviceCentreSettings()
    {
        $this->setLayout('auth');
        return $this->render('service-centre/service-centre-settings');
    }

    public function serviceCentreProfile()
    {
        $this->setLayout('auth');
        return $this->render('service-centre/service-centre-profile');
    }

    public function updateServiceCenter(Request $request)
    {
        $serviceCenter = new ServiceCenterRegisterModel();

        if ($request->isPost()) {
            $serviceCenter->loadData($request->getBody());
            if ($serviceCenter->updateValidate()) {
                $serviceCenter->updateServiceCenter();
                Application::$app->session->setFlash('update-success', 'Update is successful');
                Application::$app->response->redirect('/service-centre-profile');
            } else {
                Application::$app->session->setFlash('update-error', 'Update is failed');
                Application::$app->response->redirect('/service-centre-profile');
            }
        }
    }

    public function serviceCenterHelp()
    {
        $this->setLayout('auth');
        return $this->render('service-centre/service-center-help');
    }

    public function serviceCenterCommunity()
    {
        $this->setLayout('auth');
        return $this->render('service-centre/service-center-community');
    }

    public function marketPlaceHome()
    {
        $this->setLayout('auth');
        return $this->render('service-centre/market-place/market-place-home');
    }

    public function serviceCentreAddProduct()
    {
        $this->setLayout('auth');
        return $this->render('/service-centre/marketplace-add-product');
    }

}