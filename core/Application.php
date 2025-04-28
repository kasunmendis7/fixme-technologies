<?php


namespace app\core;

class Application
{

    public string $layout = 'auth';
    public static string $ROOT_DIR;
    public string $technicianClass;
    public string $serviceCenterClass;
    public static Application $app;
    public string $customerClass;
    public string $adminClass;
    public Router $router;
    public Request $request;
    public Response $response;
    public Session $session;
    public Database $db;
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

        $primaryValueServiceCentre = $this->session->get('serviceCenter');
        if ($primaryValueServiceCentre) {
            $serviceCenterInstance = new $this->serviceCenterClass;
            $primaryKey = $serviceCenterInstance->primaryKey();
            $this->serviceCenter = $serviceCenterInstance->findOne([$primaryKey => $primaryValueServiceCentre]);
        } else {
            $this->serviceCenter = null;
        }

        $primaryValueAdmin = $this->session->get('admin');
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
        $this->customer = null;
        $this->session->remove('customer');
    }

    public static function isGuestCustomer()
    {
        return !(self::$app->session->get('customer'));
    }

    public function run()
    {
        try {
            echo $this->router->resolve();
        } catch (\Exception $e) {
            $this->response->setStatusCode($e->getCode());
            echo $this->router->renderView('_error', ['exception' => $e]);
        }
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
