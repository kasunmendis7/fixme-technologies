<?php

namespace app\core;

class  Router
{
    protected array $routes = [];
    public Request $request;
    public Response $response;
    public ?Controller $controller = null;

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->method();
        $callback = $this->routes[$method][$path] ?? false;

        /* Configuring query stings */
        $isQueryStr = false;
        if (!$callback) {
            foreach ($this->routes[$method] as $route => $handler) {
                $routePattern = preg_replace('/\{[a-zA-Z0-9_]+\}/', '([a-zA-Z0-9_]+)', $route);
                $routePattern = "#^" . $routePattern . "$#";

                if (preg_match($routePattern, $path, $matches)) {
                    $callback = $handler;
                    array_shift($matches); // Remove the full match
                    $this->request->params = $matches; // Store extracted params
                    $isQueryStr = true;
                    break;
                }
            }
        }
        if ($isQueryStr) {
            if ($callback === false) {
                $this->response->setStatusCode(404);
                return $this->renderView('_404');
            }
            if (is_string($callback)) {
                return $this->renderView($callback);
            }
            if (is_array($callback)) {
                Application::$app->controller = new $callback[0]();
                $callback[0] = Application::$app->controller;
            }
            /* In dynamic url's pass the extracted params as the parameters of the callback function */
            return call_user_func($callback, $this->request->params ?? [], $this->response);
        }
        /* End of configuring query parameters in dynamic url */

        if ($callback === false) {
            $this->response->setStatusCode(404);
            return $this->renderView('_404');
        }
        if (is_string($callback)) {
            return $this->renderView($callback);
        }
        if (is_array($callback)) {
            Application::$app->controller = new $callback[0]();
            $callback[0] = Application::$app->controller;
        }
        return call_user_func($callback, $this->request, $this->response);
    }

    public function renderView($view, $params = [])
    {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view, $params);
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    public function renderContent($viewContent)
    {
        $layoutContent = $this->layoutContent();
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    protected function layoutContent()
    {
        $layout = Application::$app->layout;
        if (Application::$app->controller && Application::$app->controller->layout) {
            $layout = Application::$app->controller->layout;
        }
        ob_start();
        include_once Application::$ROOT_DIR . "/views/layouts/$layout.php";
        return ob_get_clean();
    }


    protected function renderOnlyView($view, $params)
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include_once Application::$ROOT_DIR . "/views/$view.php";
        return ob_get_clean();
    }
}
