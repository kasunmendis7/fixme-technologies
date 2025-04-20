<?php

namespace app\core;

class Controller
{

    /* This is a property that sets the default layout file to use when rendering views */
    public string $layout = 'main';

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
}
