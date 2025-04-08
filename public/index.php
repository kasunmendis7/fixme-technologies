<?php

require_once __DIR__ . '/../vendor/autoload.php';

use app\controllers\AuthController;
use app\controllers\CartController;
use app\core\Application;
use app\controllers\SiteController;
use app\controllers\CustomerController;
use app\controllers\TechnicianController;
use app\controllers\ServiceCentreController;
use app\controllers\AdminController;
use app\controllers\PostController;
use app\controllers\CommentController;
use app\controllers\ProductController;
use app\controllers\ChatController;
use app\controllers\TechnicianReviewController;
use app\controllers\ServiceCenterReviewController;

/* load environment variables */

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

/* database configuration */
$config = [
    'technicianClass' => \app\models\Technician::class,
    'customerClass' => \app\models\Customer::class,
    'serviceCenterClass' => \app\models\ServiceCenter::class,
    'adminClass' => \app\models\Admin::class,
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ]
];

$app = new Application(dirname(__DIR__), $config);

/* Home Route */
$app->router->get('/', [SiteController::class, 'home']);
$app->router->get('/select-user-login', [SiteController::class, 'selectUserLogin']);
$app->router->get('/select-user-sign-up', [SiteController::class, 'selectUserSignUp']);
$app->router->get('/home-map', [SiteController::class, 'homeMap']);
$app->router->get('/home-geolocation-technicians', [SiteController::class, 'homeGeolocationTechnicians']);
$app->router->get('/home-geolocation-service-centres', [SiteController::class, 'homeGeolocationServiceCentres']);
$app->router->get('/about-us', [SiteController::class, 'aboutUs']);

/* Technician Routes */
$app->router->get('/technician-landing', [TechnicianController::class, 'technicianLanding']);
$app->router->get('/technician-home', [TechnicianController::class, 'technicianHome']);
$app->router->get('/technician-dashboard', [TechnicianController::class, 'technicianDashboard']);
$app->router->get('/technician-map', [TechnicianController::class, 'technicianMap']);
$app->router->get('/technician-settings', [TechnicianController::class, 'technicianSettings']);
$app->router->get('/technician-help', [TechnicianController::class, 'technicianHelp']);
$app->router->get('/technician-profile', [TechnicianController::class, 'technicianProfile']);
$app->router->post('/update-technician-profile', [TechnicianController::class, 'updateTechnicianProfile']);
$app->router->get('/technician-requests', [TechnicianController::class, 'viewRequests']);
$app->router->post('/technician-requests-update', [TechnicianController::class, 'updateRequestStatus']);
$app->router->get('/technician-transactions', [TechnicianController::class, 'technicianTransactions']);
$app->router->get('/technician-payment-details', [TechnicianController::class, 'technicianPaymentDetails']);
$app->router->get('/customer-request/{id}', [TechnicianController::class, 'viewCustomerRequest']);

/* Routes related to the Post */
$app->router->get('/technician-create-post', [TechnicianController::class, 'technicianCreatePost']);
$app->router->get('/technician-edit-post', [TechnicianController::class, 'technicianEditPost']);
$app->router->post('/technician-create-post', [PostController::class, 'create']);
$app->router->post('/technician-edit-post', [PostController::class, 'edit']);
$app->router->get('/technician-community', [PostController::class, 'index']);
$app->router->post('/technician-delete-post', [PostController::class, 'delete']);
$app->router->get('/fixme-community', [CustomerController::class, 'fixmeCommunity']);

/* Routes related to the Comment */
$app->router->post('/comment-create', [CommentController::class, 'create']);
$app->router->get('/comment-edit', [CommentController::class, 'edit']);
$app->router->post('/comment-edit', [CommentController::class, 'edit']);
$app->router->get('/comment-delete', [CommentController::class, 'delete']);
$app->router->post('/comment-delete', [CommentController::class, 'delete']);

/* Routes related to the Like */
$app->router->post('/post-like', [PostController::class, 'like']);
$app->router->post('/post-unlike', [PostController::class, 'unlike']);


/* Service Center Routes */
$app->router->get('/service-centre-landing', [ServiceCentreController::class, 'serviceCentreLanding']);
$app->router->get('/service-centre-dashboard', [ServiceCentreController::class, 'serviceCentreDashboard']);
$app->router->get('/service-centre-settings', [ServiceCentreController::class, 'serviceCentreSettings']);
$app->router->get('/service-centre-profile', [ServiceCentreController::class, 'serviceCentreProfile']);
$app->router->post('/update-service-centre-profile', [ServiceCentreController::class, 'updateServiceCenter']);
$app->router->get('/service-center-help', [ServiceCentreController::class, 'serviceCenterHelp']);
$app->router->get('/service-center-community', [ServiceCentreController::class, 'serviceCenterCommunity']);
$app->router->get('/service-center-messages', [ServiceCentreController::class, 'serviceCenterMessages']);
$app->router->get('/check-out-page', [ServiceCentreController::class, 'checkOutPage']);
$app->router->get('/card-details', [ServiceCentreController::class, 'cardDetails']);
$app->router->get('/service-centre-map', [ServiceCentreController::class, 'serviceCentreMap']);
$app->router->get('/service-center-payment-details', [ServiceCentreController::class, 'serviceCenterPaymentDetails']);
$app->router->get('/service-center-profile/{id}', [ServiceCentreController::class, 'viewServiceCenterProfile']);
$app->router->get('/view-cart', [CartController::class, 'viewCart']);
$app->router->post('/remove-from-cart', [CartController::class, 'removeItemsFromCart']);


/* Routes related to the product (service center) */
$app->router->get('/service-center-create-product', [ServiceCentreController::class, 'serviceCenterCreateProduct']);
$app->router->post('/service-center-create-product', [ProductController::class, 'create']);
$app->router->get('/market-place-home', [ProductController::class, 'index']);
$app->router->get('/service-center-create-product', [ProductController::class, 'filterProductsById']);
$app->router->get('/service-center-update-product', [ProductController::class, 'update']);
$app->router->get('/service-center-update-product', [ServiceCentreController::class, 'update']);
$app->router->post('/service-center-update-product', [ProductController::class, 'update']);
$app->router->post('/service-center-delete-product', [ProductController::class, 'delete']);
$app->router->get('/get-product-by-category', [ProductController::class, 'filterProductByCategory']);
$app->router->post('/add-to-cart', [CartController::class, 'addToCartController']);

/* Customer Routes */
$app->router->get('/customer-dashboard', [CustomerController::class, 'customerDashboard']);
$app->router->get('/customer-settings', [CustomerController::class, 'customerSettings']);
$app->router->get('/customer-help', [CustomerController::class, 'customerHelp']);
$app->router->get('/customer-profile', [CustomerController::class, 'customerProfile']);
$app->router->get('/customer-technicians', [CustomerController::class, 'customerTechnicians']);
$app->router->get('/customer-service-centers', [CustomerController::class, 'customerServiceCenters']);
$app->router->post('/update-customer-profile', [CustomerController::class, 'updateCustomerProfile']);
$app->router->get('/customer-map', [CustomerController::class, 'customerMap']);
$app->router->get('/geolocation-technicians', [CustomerController::class, 'getTechnicianGeocoding']);
$app->router->get('/geolocation-service-centres', [CustomerController::class, 'getServiceCentresGeocoding']);
$app->router->get('/customer-location', [CustomerController::class, 'customerLocation']);
$app->router->get('/technician-profile/{id}', [TechnicianController::class, 'viewTechnicianProfile']);
$app->router->post('/cus-tech-req', [CustomerController::class, 'cusTechReq']);
$app->router->post('/delete-cus-tech-req', [CustomerController::class, 'deleteCusTechReq']);
$app->router->get('/customer-messages', [CustomerController::class, 'customerMessages']);
$app->router->get('/service-center-profile', [CustomerController::class, 'serviceCenterProfile']);
$app->router->get('/customer-vehicle-issue', [CustomerController::class, 'customerVehicleIssue']);
$app->router->get('/customer-transactions', [CustomerController::class, 'customerTransactions']);
$app->router->get('/customer-payment-details', [CustomerController::class, 'customerPaymentDetails']);


/* Admin Routes */
$app->router->get('/admin-dashboard', [AdminController::class, 'adminDashboard']);
$app->router->get('/customers', [AdminController::class, 'customers']);
$app->router->get('/technicians', [AdminController::class, 'technicians']);
$app->router->post('/admin/delete-technician', [AdminController::class, 'deleteTechnician']);
$app->router->get('/admin-settings', [AdminController::class, 'adminSettings']);
$app->router->get('/admin-profile', [AdminController::class, 'adminProfile']);
$app->router->post('/update-admin-profile', [AdminController::class, 'updateAdminProfile']);

/* Admin Routes */
$app->router->get('/admin-services', [AdminController::class, 'manageServices']);
$app->router->post('/admin-services-add', [AdminController::class, 'addService']);
$app->router->post('/admin-services-edit', [AdminController::class, 'editService']);
$app->router->post('/admin-services-delete', [AdminController::class, 'deleteService']);
$app->router->get('/admin-reports', [AdminController::class, 'viewReports']);
$app->router->post('/admin-reports-generate', [AdminController::class, 'generateReport']);
$app->router->post('/admin-settings-update', [AdminController::class, 'updateSettings']);
$app->router->get('/admin-promotions', [AdminController::class, 'promotions']);


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
$app->router->get('/service-center-logout', [AuthController::class, 'serviceCenterLogout']);


/*routes related to the product(service center)*/
$app->router->get('/service-center-create-product', [ServiceCentreController::class, 'serviceCenterCreateProduct']);
$app->router->post('/service-center-create-product', [ProductController::class, 'create']);
$app->router->get('/service-center-marketplace', [ProductController::class, 'viewMarketplace']);
$app->router->get('/service-center-create-product', [ProductController::class, 'filterProductsById']);
$app->router->get('/service-center-update-product', [ProductController::class, 'update']);
$app->router->post('/service-center-update-product', [ProductController::class, 'update']);
$app->router->post('/service-center-delete-product', [ProductController::class, 'delete']);


/** Admin Routes */
$app->router->get('/customers', [AdminController::class, 'customers']);
$app->router->post('/admin/delete-customer', [AdminController::class, 'deleteCustomer']);

$app->router->get('/admin-services', [AdminController::class, 'manageServices']);
$app->router->post('/admin-services-add', [AdminController::class, 'addService']);
$app->router->post('/admin-services-edit', [AdminController::class, 'editService']);
$app->router->post('/admin-services-delete', [AdminController::class, 'deleteService']);

$app->router->get('/admin-reports', [AdminController::class, 'viewReports']);
$app->router->post('/admin-reports-generate', [AdminController::class, 'generateReport']);

$app->router->post('/admin-settings-update', [AdminController::class, 'updateSettings']);

$app->router->get('/admin-promotions', [AdminController::class, 'promotions']);

/* Admin Auth routes */
$app->router->get('/admin-login', [AuthController::class, 'adminLogin']);
$app->router->post('/admin-login', [AuthController::class, 'adminLogin']);
$app->router->get('/admin-logout', [AuthController::class, 'adminLogout']);

//promotion for admin
$app->router->get('/promotion-create', [PromotionController::class, 'create']);
$app->router->post('/promotion/add', [AdminController::class, 'insert_promotion']);
$app->router->post('/promotion/update', [AdminController::class, 'update_promotion']);
$app->router->post('/promotion/delete', [AdminController::class, 'delete_promotion']);

/* Routes related to the Technician sending message to Customer */
$app->router->get('/technician-messages', [TechnicianController::class, 'technicianMessages']);
$app->router->get('/technician-messages/load-user-list', [ChatController::class, 'loadCustomerList']);
$app->router->get('/customer-messages/{id}', [ChatController::class, 'viewCustomerMessages']);
$app->router->get('/customer-messages/{id}/load-messages', [ChatController::class, 'loadCustomerMessages']);
$app->router->post('/customer-messages/{id}', [ChatController::class, 'technicianSendMessage']);

/* Routes related to the Customer sending message to Technician */
$app->router->get('/customer-messages', [CustomerController::class, 'customerMessages']);
$app->router->get('/customer-messages/load-user-list', [ChatController::class, 'loadTechnicianList']);
$app->router->get('/technician-messages/{id}', [ChatController::class, 'viewTechnicianMessages']);
$app->router->get('/technician-messages/{id}/load-messages', [ChatController::class, 'loadTechnicianMessages']);
$app->router->post('/technician-messages/{id}', [ChatController::class, 'customerSendMessage']);

/* Routes related to the customer reviews */
$app->router->post('/technician-profile/submit-rating', [TechnicianReviewController::class, 'submit']);
$app->router->post('/technician-profile/fetch-reviews', [TechnicianReviewController::class, 'fetch']);
$app->router->post('/service-center-profile/submit-rating', [ServiceCenterReviewController::class, 'submit']);
$app->router->post('/service-center-profile/fetch-reviews', [ServiceCenterReviewController::class, 'fetch']);


/* Run the application */
$app->run();

/* Debugging function */
function show($data)
{
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}
