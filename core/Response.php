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

    /* This function redirects the user to another url */
    public function redirect(string $url)
    {
        header('Location: ' . $url);
    }

    /* Sends a JSON-encoded response to the client. This is especially useful for AJAX or API responses */
    public function json($data)
    {
        header('Content-Type: application/json'); /*Sets the Content-Type header so the client knows to expect JSON*/
        echo json_encode($data); /*Converts the $data (array, object, etc.) to a JSON string*/
        exit;
    }
}
