<?php
use app\core\Application;
use app\controllers\SiteController;
use app\controllers\CustomerController;
use app\controllers\TechnicianController;
require_once __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$config = [
    'db'=>[
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ]
];
$app = new Application(__DIR__, $config);
$app->router->get('/', [SiteController::class, 'home']);
$app->router->get('/customer-sign-up', [CustomerController::class, 'customerSignUp']);
$app->router->get('/technician-sign-up', [TechnicianController::class, 'technicianSignUp']);
$app->router->post('/technician-sign-up', [TechnicianController::class, 'technicianSignUp']);
$app->router->get('/technician-landing', [TechnicianController::class, 'technicianLanding']);
$app->router->get('/technician-add-new-post', [TechnicianController::class, 'technicianAddNewPost']);
$app->router->get('/technician-home', [TechnicianController::class, 'technicianHome']);
$app->db->applyMigrations();