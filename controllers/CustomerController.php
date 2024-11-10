<?php

namespace app\controllers;

use app\core\Controller;

class CustomerController extends Controller
{

    public function customerDashboard()
    {
        $this->setLayout('auth');
        return $this->render('/customer/customer-dashboard');
    }

    public function customerSettings()
    {
        $this->setLayout('auth');
        return $this->render('/customer/customer-settings');
    }

    public function customerHelp()
    {
        $this->setLayout('auth');
        return $this->render('/customer/customer-help');
    }

    public function customerProfile()
    {
        $this->setLayout('auth');
        return $this->render('/customer/customer-profile');
    }

    public function customerTechnicians()
    {
        $this->setLayout('auth');
        return $this->render('/customer/customer-technicians');
    }
}
