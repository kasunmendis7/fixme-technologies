<?php

/* This sets the class under the app\core namespace, helping organize your MVC structure and making autoloading work properly */

namespace app\core;

class Response
{
    /* This function sets the HTTP status code of the response */
    public function setStatusCode(int $code)
    {
        http_response_code($code);
    }

    public function redirect(string $url)
    {
        header('Location: ' . $url);
    }

    public function json($data)
    {
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
}
