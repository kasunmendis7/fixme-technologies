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

        $primaryValue = $this->session->get('technician');
        if ($primaryValue) {
            $primaryKey = $this->technicianClass::primaryKey();
            $this->technician = $this->technicianClass::findOne([$primaryKey => $primaryValue]);
        } else {
            $this->technician = null;
        }
    }

    public function run()
    {
        echo $this->router->resolve();
    }

    public static function isGuest()
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


    public function logout()
    {
        $this->technician = null;
        $this->session->remove('technician');
    }
}
