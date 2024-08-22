<?php

namespace app\controllers;

use app\core\Controller;

class CustomerController extends Controller
{
    public function customerSignUp()
    {
        $this->setLayout('auth');
        return $this->render('customer-sign-up');
    }
}
