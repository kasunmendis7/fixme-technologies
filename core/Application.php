<?php

namespace app\core;

class Application
{

    public static string $ROOT_DIR;
    public string $technicianClass;
    public Router $router;
    public Request $request;
    public Response $response;
    public Session $session;
    public Database $db;
    public ?DbModel $user;

    public static Application $app;
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

        $technicianPrimaryValue = $this->session->get('technician');
        if ($technicianPrimaryValue) {
            $technicianPrimaryKey = $this->technicianClass::primaryKey();
            $this->user = $this->technicianClass::findOne([$technicianPrimaryKey => $technicianPrimaryValue]);
        }else{
            $this->user = null;
        }
        $this->db = new Database($config['db']);
    }

    public function run()
    {
        echo $this->router->resolve();
    }

    public function isGuest()
    {
        return !self::$app->user;
    }

    public function login(DbModel $user)
    {
        $this->user = $user;
        $primaryKey = $user->primaryKey();
        $primaryValue = $user->{$primaryKey};
        $this->session->set('technician', $primaryValue);
        return true;
    }

    public function logout()
    {
        $this->user = null;
        $this->session->remove('technician');
    }

}
