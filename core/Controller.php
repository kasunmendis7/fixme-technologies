<?php

namespace app\core;

use app\core\middlewares\BaseMiddleware;

class Controller
{

    /* This is a property that sets the default layout file to use when rendering views */
    public string $layout = 'main';
    public string $action = '';

    /**
     * @var \app\core\middlewares\BaseMiddleware[]
     */
    protected array $middlewares = [];

    /* Allows controllers to change the layout dynamically */
    public function setLayout($layout)
    {
        $this->layout = $layout;
    }

    // what $params is for is to pass data to the view
    public function render($view, $params = [])
    {
        return Application::$app->router->renderView($view, $params);
    }

    public function registerMiddleware(BaseMiddleware $middleware)
    {
        $this->middlewares[] = $middleware;
    }

    /**
     * @return \app\core\middlewares\BaseMiddleware[]
     */
    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }
}
