<?php


namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\Customer;
use app\models\Technician;

class AdminController extends Controller
{
    public function dashboard()
    {
        $this->setLayout('auth');
        return $this->render('/admin/dashboard');
    }
    public function manageUsers()
    {
        $this->setLayout('auth');
        return $this->render('/admin/users');
    }
    public function settings()
    {
        $this->setLayout('auth');
        return $this->render('/admin/settings');
    }
    public function viewReports()
    {
        $this->setLayout('auth');
        return $this->render('/admin/reports');
    }
    public function manageServices()
    {
        $this->setLayout('auth');
        return $this->render('/admin/services');
    }
    public function adminLogin()
    {
        $this->setLayout('auth');
        return $this->render('/admin/admin-login.php');
    }
    

    

}

