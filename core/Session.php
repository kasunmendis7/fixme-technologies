<?php

/* Set namespace so that classes in this file are part of app\core, which helps in autoloading and avoid class name conflicts */

namespace app\core;

/* This class provides a wrapper around PHP’s native $_SESSION functionality with some added features like flash messaging */

class Session
{
    /* The key used to store flash messages in the session */
    protected const FLASH_KEY = 'flash_messages';

    public function __construct()
    {
        /* Start the session(required for using $_SESSION */
        session_start();
        /* Mark flash messages for removal */
        $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];
        foreach ($flashMessages as $key => &$flashMessage) {
            // Mark to be removed
            $flashMessage['remove'] = true;
        }

        /* Store flash messages */
        $_SESSION[self::FLASH_KEY] = $flashMessages;
    }

    /* Set a flash message under a specified key */
    /* Flash messages are only available on the next page load and then are removed automatically */
    public function setFlash($key, $message)
    {
        $_SESSION[self::FLASH_KEY][$key] = [
            'remove' => false,
            'value' => $message
        ];
    }

    /* Get a flash message under a specified key (if it exists) from session */
    public function getFlash($key)
    {
        return $_SESSION[self::FLASH_KEY][$key]['value'] ?? false;
    }

    /* Set a key-value pair in the session */
    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    /* Retrieves a session value or returns false if the key doesn't exist */
    public function get($key)
    {
        return $_SESSION[$key] ?? false;
    }

    /* Deletes a session value by key */
    public function remove($key)
    {
        unset($_SESSION[$key]);
    }

    /* Called when the Session object is destroyed (e.g., at the end of the request) */
    public function __destruct()
    {
        /* Removes flash messages that were flagged during the previous request */
        $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];
        foreach ($flashMessages as $key => &$flashMessage) {
            if ($flashMessage['remove']) {
                unset($flashMessages[$key]);
            }
        }

        $_SESSION[self::FLASH_KEY] = $flashMessages;
    }
}
