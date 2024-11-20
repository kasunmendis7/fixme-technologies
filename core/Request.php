<?php

namespace app\core;

class Request
{

    public function getPath()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($path, '?');
        if ($position === false) {
            return $path;
        }
        return substr($path, 0, $position);
    }

    public function method()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function isGet()
    {
        return $this->method() === 'get';
    }

    public function isPost()
    {
        return $this->method() === 'post';
    }

    public function getBody()
    {
        // Empty associative array
        $body = [];
        // Checks if the request method is GET
        if ($this->method() === 'get') {
            // $_GET: A PHP superglobal that holds query parameters from the URL (e.g., ?key=value).
            // Iterates through each key-value pair in the $_GET array
            foreach ($_GET as $key => $value) {
                // Sanitizes the value associated with $key from $_GET
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        // Checks if the request method is POST
        if ($this->method() === 'post') {
            // $_POST: A PHP superglobal that holds form data submitted via HTTP POST.
            // Iterates through each key-value pair in the $_POST array
            foreach ($_POST as $key => $value) {
                // Sanitizes the values and adds to the $body array
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        // Returns the sanitized data
        return $body;
    }
}
