<?php

/* Set namespace so that classes in this file are part of app\core, which helps in autoloading and avoid class name conflicts */

namespace app\core;

/* Main application class that controls overall app behavior: routing, session management, authentication, database access... */

class Application
{

    public string $layout = 'auth'; /* Default layout for views */
    public static string $ROOT_DIR; /* Root directory of the application */
    public string $technicianClass;
    public string $serviceCenterClass;
    public static Application $app; /* Singleton(static) instance of the Application class */
    public string $customerClass;
    public string $adminClass;
    public Router $router; /* Router handles requests to the correct controller */
    public Request $request; /* Request class handles HTTP requests */
    public Response $response; /* Response class handles HTTP responses */
    public Session $session; /* Session class handles session management(session data) */
    public Database $db; /* Custom class for DB connection and queries */
    public ?DbModel $technician;
    public ?Controller $controller = null;
    public ?DbModel $customer;
    public ?DbModel $serviceCenter;

    public function __construct($rootPath, array $config)
    {
        $this->customerClass = $config['customerClass'];
        $this->technicianClass = $config['technicianClass'];
        $this->serviceCenterClass = $config['serviceCenterClass'];
        $this->adminClass = $config['adminClass'];
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
        $this->router = new Router($this->request, $this->response);

        $this->db = new Database($config['db']);

        /* Retrieve technician data from the session */
        $primaryValueTechnician = $this->session->get('technician');
        /* If the technician is logged in, retrieve their data from the database */
        if ($primaryValueTechnician) {
            $technicianInstance = new $this->technicianClass;
            $primaryKey = $technicianInstance->primaryKey();
            $this->technician = $technicianInstance->findOne([$primaryKey => $primaryValueTechnician]);
        } else {
            $this->technician = null;
        }

        /* Retrieve customer data from the session */
        $primaryValueCustomer = $this->session->get('customer');
        /* If the customer is logged in, retrieve their data from the database */
        if ($primaryValueCustomer) {
            $customerInstance = new $this->customerClass;
            $primaryKey = $customerInstance->primaryKey();
            $this->customer = $customerInstance->findOne([$primaryKey => $primaryValueCustomer]);
        } else {
            $this->customer = null;
        }

        /* Retrieve service center data from the session */
        $primaryValueServiceCentre = $this->session->get('serviceCenter');
        /* If the service center is logged in, retrieve their data from the database */
        if ($primaryValueServiceCentre) {
            $serviceCenterInstance = new $this->serviceCenterClass;
            $primaryKey = $serviceCenterInstance->primaryKey();
            $this->serviceCenter = $serviceCenterInstance->findOne([$primaryKey => $primaryValueServiceCentre]);
        } else {
            $this->serviceCenter = null;
        }

        /* Retrieve admin data from the session */
        $primaryValueAdmin = $this->session->get('admin');
        /* If the admin is logged in, retrieve their data from the database */
        if ($primaryValueAdmin) {
            $adminInstance = new $this->adminClass;
            $primaryKey = $adminInstance->primaryKey();
            $this->admin = $adminInstance->findOne([$primaryKey => $primaryValueAdmin]);
        } else {
            $this->admin = null;
        }
    }

    /* Login customer */
    public function loginCustomer(DbModel $customer)
    {
        $this->customer = $customer;
        $primaryKey = $customer->primaryKey();
        $primaryValue = $customer->{$primaryKey};
        /* Set the customer ID in the session */
        $this->session->set('customer', $primaryValue);
        return true;
    }

    /* Logout customer */
    public function logoutCustomer()
    {
        /* Unset the customer ID from the session */
        $this->customer = null;
        $this->session->remove('customer');
    }

    /* Check if the customer is logged in */
    public static function isGuestCustomer()
    {
        /* If the customer is not logged in, return true */
        return !(self::$app->session->get('customer'));
    }

    /* Run the application */
    public function run()
    {
        /* Resolve the request and return the response */
        echo $this->router->resolve();
    }

    /* Check if the technician is logged in */
    public static function isGuestTechnician()
    {
        /* If the technician is not logged in, return true */
        return !(self::$app->session->get('technician'));
    }

    /* Login technician */
    public function loginTechnician(DbModel $technician)
    {
        $this->technician = $technician;
        $primaryKey = $technician->primaryKey();
        $primaryValue = $technician->{$primaryKey};
        /* Set the technician ID in the session */
        $this->session->set('technician', $primaryValue);
        return true;
    }


    /* Logout technician */
    public function logoutTechnician()
    {
        /* Unset the technician ID from the session */
        $this->technician = null;
        $this->session->remove('technician');
    }

    /* Check if the service center is logged in */
    public static function isGuestServiceCenter()
    {
        /* If the service center is not logged in, return true */
        return !(self::$app->session->get('serviceCenter'));
    }

    /* Login service center */
    public function loginServiceCenter(DbModel $serviceCenter)
    {
        $this->serviceCenter = $serviceCenter;
        $primaryKey = $serviceCenter->primaryKey();
        $primaryValue = $serviceCenter->{$primaryKey};
        /* Set the service center ID in the session */
        $this->session->set('serviceCenter', $primaryValue);
        return true;
    }

    /* Logout service center */
    public function logoutServiceCenter()
    {
        /* Unset the service center ID from the session */
        $this->serviceCenter = null;
        $this->session->remove('serviceCenter');
    }

    /* Login admin */
    public function loginAdmin(DbModel $admin)
    {
        $this->admin = $admin;
        $primaryKey = $admin->primaryKey();
        $primaryValue = $admin->{$primaryKey};
        /* Set the admin ID in the session */
        $this->session->set('admin', $primaryValue);
        return true;
    }

    /* Logout admin */
    public function logoutAdmin()
    {
        /* Unset the admin ID from the session */
        $this->admin = null;
        $this->session->remove('admin');
    }

}
