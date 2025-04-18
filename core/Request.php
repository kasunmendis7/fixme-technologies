<?php

/* This places Request class inside the app\core namespace */

namespace app\core;

class Request
{
    public $params = [];

    /* This function is used to get the path portion of the URL(without the query string) */
    public function getPath()
    {
        /* Retrieves the requested URL path */
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        /* Looks for the position of a ? to seperate the path from the query string */
        $position = strpos($path, '?');
        /* If there is no query string, return the path directly */
        if ($position === false) {
            return $path;
        }
        /* Otherwise, return only the portion before ? */
        return substr($path, 0, $position);
    }

    /* This function is used to get the HTTP request method(in lowercase) */
    public function method()
    {
        /* Converts methods like 'GET', 'POST' to lowercase ('get', 'post'), which helps with case-insensitive comparisons */
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    /* This function returns true if the request method is GET */
    public function isGet()
    {
        return $this->method() === 'get';
    }

    /* This function returns true if the request method is POST */
    public function isPost()
    {
        return $this->method() === 'post';
    }

    /* This function returns sanitized input data depending on the request method */
    public function getBody()
    {
        $body = [];
        /*If it's a GET request, loops through all GET parameters
           Uses filter_input() to sanitize each value */
        if ($this->method() === 'get') {
            foreach ($_GET as $key => $value) {
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        /* If it's a POST request, loops through all POST parameters
           Uses filter_input() to sanitize each value */
        if ($this->method() === 'post') {
            foreach ($_POST as $key => $value) {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        /* Returns the cleaned input data as an associative array */
        return $body;
    }
}
