<?php

use app\controllers\AuthController;
use app\core\Application;
use app\controllers\SiteController;
use app\controllers\CustomerController;
use app\controllers\TechnicianController;
use app\controllers\ServiceCentreController;
require_once __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();
$config = [
    'db'=>[
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ]
];
$app = new Application(dirname(__DIR__), $config);

$app->router->get('/', [SiteController::class, 'home']);
//$app->router->get('/customer-sign-up', [CustomerController::class, 'customerSignUp']);
//$app->router->get('/technician-sign-up', [TechnicianController::class, 'technicianSignUp']);
$app->router->get('/technician-landing', [TechnicianController::class, 'technicianLanding']);
$app->router->get('/service-centre-landing', [ServiceCentreController::class, 'serviceCentreLanding']);
$app->router->get('/service-centre-dashboard', [ServiceCentreController::class, 'serviceCentreDashboard']);
//$app->router->get('/service-centre-sign-up', [ServiceCentreController::class, 'serviceCentreSignup']);
//$app->router->get('/service-centre-login', [ServiceCentreController::class, 'serviceCentreLogin']);
$app->router->get('/technician-home', [TechnicianController::class, 'technicianHome']);
$app->router->get('/technician-dashboard', [TechnicianController::class, 'technicianDashboard']);
$app->router->get('/technician-map', [TechnicianController::class, 'technicianMap']);
$app->router->get('/technician-messages', [TechnicianController::class, 'technicianMessages']);
$app->router->get('/technician-settings', [TechnicianController::class, 'technicianSettings']);
$app->router->get('/technician-help', [TechnicianController::class, 'technicianHelp']);

// Auth routes handled by AuthController
$app->router->get('/customer-sign-up', [AuthController::class, 'customerSignUp']);
$app->router->post('/customer-sign-up', [AuthController::class, 'customerSignUp']);
$app->router->get('/technician-sign-up', [AuthController::class, 'technicianSignUp']);
$app->router->post('/technician-sign-up', [AuthController::class, 'technicianSignUp']);
$app->router->get('/service-centre-sign-up', [AuthController::class, 'serviceCentreSignup']);
$app->router->post('/service-centre-sign-up', [AuthController::class, 'serviceCentreSignup']);
$app->router->get('/service-centre-login', [AuthController::class, 'serviceCentreLogin']);
$app->router->post('/service-centre-login', [AuthController::class, 'serviceCentreLogin']);

$app->run();

function show($data)
{
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}
