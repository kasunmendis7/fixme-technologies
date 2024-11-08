<?php

namespace app\core;

class Application
{

    public static string $ROOT_DIR;
    public string $serviceCenterClass;
    public static Application $app;
    public Router $router;
    public Request $request;
    public Response $response;
    public Session $session;
    public Database $db;
    public Controller $controller;
    public ?DbModel $serviceCenter;

    public function __construct($rootPath, array $config)
    {
        $this->serviceCenterClass = $config['serviceCenterClass'];
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
        $this->router = new Router($this->request, $this->response);

        $this->db = new Database($config['db']);

        $primaryValueServiceCenter = $this->session->get('service_center');
        if ($primaryValueServiceCenter) {
            $serviceCenterInstance = new $this->serviceCenterClass;
            $primaryKey = $serviceCenterInstance->primaryKey();
            $this->serviceCenter = $serviceCenterInstance->findOne([$primaryKey => $primaryValueServiceCenter]);
        }
        else {
            $this->serviceCenter = null;
        }


    }

    public function run()
    {
        echo $this->router->resolve();
    }

    public static function isGuestServiceCenter()
    {
        return !self::$app->serviceCenter;
    }

    public function loginServiceCenter(DbModel $serviceCenter)
    {
        $this->serviceCenter = $serviceCenter;
        $primaryKey = $serviceCenter->primaryKey();
        $primaryValue = $serviceCenter->{$primaryKey};
        $this->session->set('service_center', $primaryValue);
        return true;
    }

    public function logoutServiceCenter()
    {
        $this->user = null;
        $this->session->remove('service_center');
    }
}
