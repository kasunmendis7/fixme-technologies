<?php


namespace app\controllers;

use app\core\Controller;

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
    public function technicianCommunity()
    {
        $this->setLayout('auth');
        return $this->render('/technician/technician-community');
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

