<?php

namespace app\core\middlewares;

use app\core\Application;
use app\core\exception\ForbiddenException;

class AuthMiddleware extends BaseMiddleware
{
    public array $actions = [];

    /**
     * AuthMiddleware Constructor
     *
     * @param array $actions
     */

    public function __construct(array $actions = [])
    {
        $this->actions = $actions;
    }

    public function execute()
    {
        if ((Application::isGuestCustomer() && Application::isGuestTechnician() && Application::isGuestServiceCenter()) || in_array(Application::$app->controller->action, $this->actions)) {
            throw new ForbiddenException();

        }
    }

}