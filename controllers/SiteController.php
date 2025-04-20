<?php

namespace app\controllers;

use app\core\Controller;
use app\models\ServiceCenter;
use app\models\Technician;

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

    public function homeMap()
    {
        $this->setLayout('main');
        return $this->render('/home-map');
    }

    public function homeGeolocationTechnicians()
    {
        header("Access-Control-Allow-Origin: http://localhost:8080");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type");

        $technician = new Technician();
        return $technician->techniciansGeocoding();
    }

    public function homeGeolocationServiceCentres()
    {
        header("Access-Control-Allow-Origin: http://localhost:8080");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type");

        $serviceCenter = new ServiceCenter();
        return $serviceCenter->serviceCentresGeocoding();

    }

    public function aboutUs()
    {
        $this->setLayout('main');
        return $this->render('/about-us');
    }
}
