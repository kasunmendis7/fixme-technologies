<?php

namespace app\core;

class Application
{

    public static string $ROOT_DIR;
    public string $technicianClass;
    public static Application $app;
    public Router $router;
    public Request $request;
    public Response $response;
    public Session $session;
    public Database $db;
    public ?DbModel $technician;

    public Controller $controller;

    public function __construct($rootPath, array $config)
    {
        $this->technicianClass = $config['technicianClass'];
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
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
    }

    public function run()
    {
        echo $this->router->resolve();
    }

    public static function isGuestTechnician()
    {
        return !self::$app->technician;
    }
    public function technicianLogin(DbModel $technician)
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
