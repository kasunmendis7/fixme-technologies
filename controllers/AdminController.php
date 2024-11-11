<?php

namespace app\controllers;

use app\core\Controller;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Render the admin dashboard view
        $this->setLayout('auth');
        return $this->render('admin/admin-dashboard');
    }
}
