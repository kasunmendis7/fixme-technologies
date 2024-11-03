<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\models\TechnicianModel;

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
