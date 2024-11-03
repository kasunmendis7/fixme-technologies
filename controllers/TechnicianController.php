<?php


namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\models\TechnicianModel;

class TechnicianController extends Controller
{
    public function technicianSignUp(Request $request)
    {
        $errors=[];
        $technicianModel = new TechnicianModel();
        if ($request->isPost()) {
            $technicianModel->loadData($request->getBody());
            if ($technicianModel->validate() && $technicianModel->signUp()) {
                // Redirect to the login page after successful sign-up
                header('Location: /technician-login');
                exit();
            }
            // Render the form again if validation fails, passing the model with errors
            return $this->render('/technician/technician-sign-up', [
                'model' => $technicianModel,
            ]);
        }
        $this->setLayout('auth');
        return $this->render('/technician/technician-sign-up',[
            'model' => $technicianModel,
            'errors'=>$errors
        ]);
    }
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
}

