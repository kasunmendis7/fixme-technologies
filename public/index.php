<?php

require_once __DIR__ . '/../vendor/autoload.php';

use app\controllers\AuthController;
use app\core\Application;
use app\controllers\SiteController;
use app\controllers\CustomerController;
use app\controllers\TechnicianController;
use app\controllers\ServiceCentreController;
use app\controllers\PostController;
use app\controllers\CommentController;
use app\controllers\ProductController;

/* load environment variables */

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

/* database configuration */
$config = [
    'technicianClass' => \app\models\Technician::class,
    'customerClass' => \app\models\Customer::class,
    'serviceCenterClass' => \app\models\ServiceCenterRegisterModel::class,
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ]
];

$app = new Application(dirname(__DIR__), $config);

/** Home Route */
$app->router->get('/', [SiteController::class, 'home']);
$app->router->get('/select-user-login', [SiteController::class, 'selectUserLogin']);
$app->router->get('/select-user-sign-up', [SiteController::class, 'selectUserSignUp']);

/** Technician Routes */
$app->router->get('/technician-landing', [TechnicianController::class, 'technicianLanding']);
$app->router->get('/technician-home', [TechnicianController::class, 'technicianHome']);
$app->router->get('/technician-dashboard', [TechnicianController::class, 'technicianDashboard']);
$app->router->get('/technician-map', [TechnicianController::class, 'technicianMap']);
$app->router->get('/technician-messages', [TechnicianController::class, 'technicianMessages']);
$app->router->get('/technician-settings', [TechnicianController::class, 'technicianSettings']);
$app->router->get('/technician-help', [TechnicianController::class, 'technicianHelp']);
$app->router->get('/technician-profile', [TechnicianController::class, 'technicianProfile']);
$app->router->post('/update-technician-profile', [TechnicianController::class, 'updateTechnicianProfile']);

/** Service Center Routes */
$app->router->get('/service-centre-landing', [ServiceCentreController::class, 'serviceCentreLanding']);
$app->router->get('/service-centre-dashboard', [ServiceCentreController::class, 'serviceCentreDashboard']);
$app->router->get('/service-centre-settings', [ServiceCentreController::class, 'serviceCentreSettings']);
$app->router->get('/service-centre-profile', [ServiceCentreController::class, 'serviceCentreProfile']);
$app->router->post('/update-service-centre-profile', [ServiceCentreController::class, 'updateServiceCenter']);
$app->router->get('/service-center-help', [ServiceCentreController::class, 'serviceCenterHelp']);
$app->router->get('/service-center-community', [ServiceCentreController::class, 'serviceCenterCommunity']);
$app->router->get('/market-place-home', [ServiceCentreController::class, 'marketPlaceHome']);


/* Customer Routes */
$app->router->get('/customer-dashboard', [CustomerController::class, 'customerDashboard']);
$app->router->get('/customer-settings', [CustomerController::class, 'customerSettings']);
$app->router->get('/customer-help', [CustomerController::class, 'customerHelp']);
$app->router->get('/customer-profile', [CustomerController::class, 'customerProfile']);
$app->router->get('/customer-technicians', [CustomerController::class, 'customerTechnicians']);
$app->router->post('/update-customer-profile', [CustomerController::class, 'updateCustomerProfile']);


/* Auth routes handled by AuthController */

/* Customer Auth routes */
$app->router->get('/customer-sign-up', [AuthController::class, 'customerSignUp']);
$app->router->post('/customer-sign-up', [AuthController::class, 'customerSignUp']);
$app->router->get('/customer-login', [AuthController::class, 'customerLogin']);
$app->router->post('/customer-login', [AuthController::class, 'customerLogin']);
$app->router->get('/customer-logout', [AuthController::class, 'customerLogout']);

/* Technician Auth routes */
$app->router->get('/technician-sign-up', [AuthController::class, 'technicianSignUp']);
$app->router->post('/technician-sign-up', [AuthController::class, 'technicianSignUp']);
$app->router->get('/technician-login', [AuthController::class, 'technicianLogin']);
$app->router->post('/technician-login', [AuthController::class, 'technicianLogin']);
$app->router->get('/technician-logout', [AuthController::class, 'technicianLogOut']);


/* Service Centre Auth routes */
$app->router->get('/service-centre-sign-up', [AuthController::class, 'serviceCentreSignup']);
$app->router->post('/service-centre-sign-up', [AuthController::class, 'serviceCentreSignup']);
$app->router->get('/service-centre-login', [AuthController::class, 'serviceCentreLogin']);
$app->router->post('/service-centre-login', [AuthController::class, 'serviceCentreLogin']);
$app->router->get('/technician-logout', [AuthController::class, 'technicianLogOut']);
$app->router->get('/service-center-logout', [AuthController::class, 'serviceCenterLogout']);

/* routes related to the by Post */
$app->router->get('/technician-create-post', [TechnicianController::class, 'technicianCreatePost']);
$app->router->get('/technician-edit-post', [TechnicianController::class, 'technicianEditPost']);
$app->router->post('/technician-create-post', [PostController::class, 'create']);
$app->router->post('/technician-edit-post', [PostController::class, 'edit']);
$app->router->get('/technician-community', [PostController::class, 'index']);
$app->router->post('/technician-delete-post', [PostController::class, 'delete']);
$app->router->get('/fixme-community', [CustomerController::class, 'fixmeCommunity']);

/* Routes related to the by Comment */
$app->router->post('/comment-create', [CommentController::class, 'create']);
$app->router->get('/comment-edit', [CommentController::class, 'edit']);
$app->router->post('/comment-edit', [CommentController::class, 'edit']);
$app->router->get('/comment-delete', [CommentController::class, 'delete']);
$app->router->post('/comment-delete', [CommentController::class, 'delete']);

/* Routes related to the by Like */
$app->router->post('/post-like', [PostController::class, 'like']);
$app->router->post('/post-unlike', [PostController::class, 'unlike']);

/* Routes related to the product */
//$app->router->get('/marketplace', [ServiceCentreController::class, 'marketPlaceHome']);
$app->router->get('/marketplace', [ProductController::class, 'index']);
$app->router->get('/marketplace-add-product', [ServiceCentreController::class, 'serviceCentreAddProduct']);
$app->router->post('/marketplace-add-product', [ProductController::class, 'create']);
//$app->router->get('/marketplace', [PostController::class, 'index']);

/* Run the application */
$app->run();

/* Debugging function */
function show($data)
{
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}
