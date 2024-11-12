<?php


namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\Customer;
use app\models\Technician;

class TechnicianController extends Controller
{

    public function technicianLanding()
    {
        $this->setLayout('auth');
        return $this->render('/technician/technician-landing');
    }
    public function technicianHome()
    {
        $this->setLayout('auth');
        return $this->render('/technician/technician-home');
    }
    public function technicianDashboard()
    {
        $this->setLayout('auth');
        return $this->render('/technician/technician-dashboard');
    }
    public function technicianMap()
    {
        $this->setLayout('auth');
        return $this->render('/technician/technician-map');
    }
    public function technicianMessages()
    {
        $this->setLayout('auth');
        return $this->render('/technician/technician-messages');
    }
    public function technicianSettings()
    {
        $this->setLayout('auth');
        return $this->render('/technician/technician-settings');
    }
    public function technicianHelp()
    {
        $this->setLayout('auth');
        return $this->render('/technician/technician-help');
    }

    public function technicianProfile()
    {
        $this->setLayout('auth');
        return $this->render('/technician/technician-profile');
    }

    public function updateTechnicianProfile(Request $request)
    {
        $technician = new Technician();

        if ($request->isPost()) {
            $technician->loadData($request->getBody());
            if ($technician->updateValidate()) {
                $technician->updateTechnician();
                Application::$app->session->setFlash('update-success', 'You have been Updated your account info successfully!');
                Application::$app->response->redirect('/technician-profile');
            } else {
                Application::$app->response->redirect('/technician-profile');
            }
        }
    }
}

