<?php

use app\core\Application;
use app\controllers\SiteController;
use app\controllers\CustomerController;
use app\controllers\TechnicianController;


require_once __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();


$config =  [
    'dsn' => 'mysql:host=localhost;dbname=fixmedb;charset=utf8',
    'user' => 'root',
    'password' => ''
];

$app = new Application(dirname(__DIR__), $config);

$app->router->get('/', [SiteController::class, 'home']);
$app->router->get('/customer-sign-up', [CustomerController::class, 'customerSignUp']);
$app->router->get('/technician-sign-up', [TechnicianController::class, 'technicianSignUp']);
$app->router->post('/technician-sign-up', [TechnicianController::class, 'technicianSignUp']);
$app->router->get('/technician-landing', [TechnicianController::class, 'technicianLanding']);
$app->router->get('/technician-add-new-post', [TechnicianController::class, 'technicianAddNewPost']);
$app->router->get('/technician-home', [TechnicianController::class, 'technicianHome']);
$app->run();

function show($data)
{
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}
