<?php

namespace app\core;

use app\core\exception\NotFoundException;

class  Router
{
    protected array $routes = [];
    public Request $request;
    public Response $response;
    public ?Controller $controller = null;

    // Initialize the router with the current request and response objects.
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }


    public function get($path, $callback)
    {
        // Store the callback in the GET routes array using path as key
        $this->routes['get'][$path] = $callback;
    }

    public function post($path, $callback)
    {
        /* Store the callback in the POST routes array using path as key */
        $this->routes['post'][$path] = $callback;
    }

    public function resolve()
    {
        /* Get the current URL and HTTP method, then checks if a matching route exists. */
        $path = $this->request->getPath();
        $method = $this->request->method();
        $callback = $this->routes[$method][$path] ?? false;

        /* Configuring query stings / dynamic route handling */
        $isQueryStr = false;
        /* If no direct route match was found */
        if (!$callback) {
            /* // Loop through all registered routes for the current HTTP method (get/post) */
            foreach ($this->routes[$method] as $route => $handler) {
                /* Replace any {param} in route path with a regex group to match actual values
                    For example: '/technician/{id}' becomes '/technician/([a-zA-Z0-9_]+)' */
                $routePattern = preg_replace('/\{[a-zA-Z0-9_]+\}/', '([a-zA-Z0-9_]+)', $route);
                /* Wrap the pattern with regex delimiters and ensure it matches the entire path */
                $routePattern = "#^" . $routePattern . "$#";

                /* Check if the current request path matches the dynamic route pattern */
                if (preg_match($routePattern, $path, $matches)) {
                    $callback = $handler; // Set the matching handler/callback
                    array_shift($matches); // Remove the full regex match from matches
                    $this->request->params = $matches; // Store captured dynamic params (like IDs) into request
                    $isQueryStr = true; // Mark that we matched a dynamic route
                    break; // Stop looping once a match is found
                }
            }
        }
        /* End of configuring query parameters in dynamic url */
        if ($isQueryStr) {
            /* If a dynamic route was matched, call the callback function with the extracted params */
            if ($callback === false) {
                /* If the callback is false, it means the route handler was not found */
                /* Render the 404 view */
                throw new NotFoundException();
            }
            /* If the callback is a string, it means it's a view name */
            if (is_string($callback)) {
                /* Render the view with the extracted params */
                return $this->renderView($callback);
            }
            /* If the callback is an array, it means it's a controller action */
            if (is_array($callback)) {
                /* Create a new controller instance */
//                Application::$app->controller = new $callback[0]();
                /* Set the controller as the current controller */
//                $callback[0] = Application::$app->controller;
                $controller = new $callback[0]();
                Application::$app->controller = $controller;
                $controller->action = $callback[1];
                $callback[0] = $controller;

                foreach ($controller->getMiddlewares() as $middleware) {
                    $middleware->execute();
                }
            }
            /* In dynamic url's pass the extracted params as the parameters of the callback function */
            return call_user_func($callback, $this->request->params ?? [], $this->response);
        }
        /* End of configuring query parameters in dynamic url */

        /* If no matching route was found, return false */
        if ($callback === false) {
            /* If the callback is false, it means the route handler was not found */
//            return $this->renderView('_error');
            throw new NotFoundException();
        }
        /* If the callback is a string, it means it's a view name */
        if (is_string($callback)) {
            /* Render the view */
            return $this->renderView($callback);
        }
        /* If the callback is an array, it means it's a controller action */
        if (is_array($callback)) {

            /** @var \app\core\Controller $controller */
//            Application::$app->controller = new $callback[0]();
//            $callback[0] = Application::$app->controller;

            $controller = new $callback[0]();
            Application::$app->controller = $controller;
            $controller->action = $callback[1];
            $callback[0] = $controller;

            foreach ($controller->getMiddlewares() as $middleware) {
                $middleware->execute();
            }

        }
        /* Call the callback function with the request and response objects */
        return call_user_func($callback, $this->request, $this->response);
    }

    /* Render a view with optional parameters */
    public function renderView($view, $params = [])
    {
        /* Get the layout content */
        $layoutContent = $this->layoutContent();
        /* Render the view content */
        $viewContent = $this->renderOnlyView($view, $params);
        /* Replace the {{content}} placeholder in the layout with the rendered view content */
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    /* Render a view with optional parameters */
    public function renderContent($viewContent)
    {
        /* Get the layout content */
        $layoutContent = $this->layoutContent();
        /* Replace the {{content}} placeholder in the layout with the rendered view content */
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    /* Get the layout content */
    protected function layoutContent()
    {
        /* Get the layout name from the application config */
        $layout = Application::$app->layout;
        /* If the controller has a layout, use that instead */
        if (Application::$app->controller && Application::$app->controller->layout) {
            $layout = Application::$app->controller->layout;
        }
        /* Get the layout content */
        ob_start();
        /* Include the layout file */
        include_once Application::$ROOT_DIR . "/views/layouts/$layout.php";
        /* Return the layout content */
        return ob_get_clean();
    }

    /* Render a view with optional parameters */
    protected function renderOnlyView($view, $params)
    {
        /* Extract the parameters into local variables */
        foreach ($params as $key => $value) {
            /* Assign the parameter value to the local variable */
            $$key = $value;
        }
        /* Start output buffering */
        ob_start();
        /* Include the view file */
        include_once Application::$ROOT_DIR . "/views/$view.php";
        /* Return the rendered view content */
        return ob_get_clean();
    }
}
