<?php

require_once __DIR__ . '/../vendor/autoload.php';

use app\core\Application;
use app\controllers\SiteController;
use app\controllers\CustomerController;
use app\controllers\TechnicianController;
use app\controllers\ServiceCentreController;

$app = new Application(dirname(__DIR__));

$app->router->get('/', [SiteController::class, 'home']);
$app->router->get('/customer-sign-up', [CustomerController::class, 'customerSignUp']);
$app->router->get('/technician-sign-up', [TechnicianController::class, 'technicianSignUp']);
$app->router->get('/technician-landing', [TechnicianController::class, 'technicianLanding']);
$app->router->get('/service-centre-landing', [ServiceCentreController::class, 'serviceCentreLanding']);
$app->router->get('/service-centre-dashboard', [ServiceCentreController::class, 'serviceCentreDashboard']);
$app->router->get('/service-centre-sign-up', [ServiceCentreController::class, 'serviceCentreSignup']);
$app->router->get('/service-centre-login', [ServiceCentreController::class, 'serviceCentreLogin']);
$app->router->get('/technician-home', [TechnicianController::class, 'technicianHome']);
$app->router->get('/technician-dashboard', [TechnicianController::class, 'technicianDashboard']);
$app->router->get('/technician-map', [TechnicianController::class, 'technicianMap']);
$app->router->get('/service-centre-map', [ServiceCentreController::class, 'serviceCentreMap']);
$app->router->get('/service-centre-home', [ServiceCentreController::class, 'serviceCentreHome']);

$app->run();

function show($data)
{
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}
