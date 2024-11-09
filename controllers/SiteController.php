<?php

namespace app\controllers;

use app\core\Controller;

class SiteController extends Controller
{

    public function home()
    {
        $params = [
            'name' => 'Fixme'
        ];
        return $this->render('home', $params);
    }

    public function selectUserLogin()
    {
        $this->setLayout('auth');
        return $this->render('/select-user-login');
    }

    public function selectUserSignUp()
    {
        $this->setLayout('auth');
        return $this->render('/select-user-sign-up');
    }
}
