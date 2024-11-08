<?php

namespace app\core;

class Application
{

    public static string $ROOT_DIR;
    public string $technicianClass;
    public static Application $app;
    public string $customerClass;
    public Router $router;
    public Request $request;
    public Response $response;
    public Session $session;
    public Database $db;
    public ?DbModel $technician;

    public Controller $controller;
    public ?DbModel $customer;

    public function __construct($rootPath, array $config)
    {
        $this->technicianClass = $config['technicianClass'];
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->customerClass = $config['customerClass'];
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
        $this->router = new Router($this->request, $this->response);

        $this->db = new Database($config['db']);


        $primaryValueTechnician = $this->session->get('technician');
        if ($primaryValueTechnician) {
            $technicianInstance = new $this->technicianClass;
            $primaryKey = $technicianInstance->primaryKey();
            $this->technician = $technicianInstance->findOne([$primaryKey => $primaryValueTechnician]);
        } else {
            $this->technician = null;
        }

        $primaryValueCustomer = $this->session->get('customer');
        if ($primaryValueCustomer) {
            $customerInstance = new $this->customerClass;
            $primaryKey = $customerInstance->primaryKey();
            $this->customer = $customerInstance->findOne([$primaryKey => $primaryValueCustomer]);
        } else {
            $this->customer = null;
        }
    }

    public function loginCustomer(DbModel $customer)
    {
        $this->customer = $customer;
        $primaryKey = $customer->primaryKey();
        $primaryValue = $customer->{$primaryKey};
        $this->session->set('customer', $primaryValue);
        return true;
    }

    public function logoutCustomer()
    {
        $this->customer = null;
        $this->session->remove('customer');
    }

    public static function isGuestCustomer()
    {
        return !self::$app->customer;
    }

    public function run()
    {
        echo $this->router->resolve();
    }

    public static function isGuestTechnician()
    {
        return !self::$app->technician;
    }
  
    public function loginTechnician(DbModel $technician)
    {
        $this->technician = $technician;
        $primaryKey = $technician->primaryKey();
        $primaryValue = $technician->{$primaryKey};
        $this->session->set('technician', $primaryValue);
        return true;
    }


    public function logoutTechnician()
    {
        $this->technician = null;
        $this->session->remove('technician');
    }
}
