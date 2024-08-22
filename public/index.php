<?php

require_once __DIR__ . '/../vendor/autoload.php';

use app\core\Application;
use app\controllers\SiteController;
use app\controllers\CustomerController;

$app = new Application(dirname(__DIR__));

$app->router->get('/', [SiteController::class, 'home']);
$app->router->get('/customer-sign-up', [CustomerController::class, 'customerSignUp']);
$app->run();









function show($data)
{
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}
