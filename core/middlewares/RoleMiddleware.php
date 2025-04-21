<?php

namespace app\core\middlewares;

use app\core\Application;
use app\core\exception\ForbiddenException;
use app\core\middlewares\BaseMiddleware;

class RoleMiddleware extends BaseMiddleware
{
    protected array $roles;

    public function __construct(array $roles = [])
    {
        $this->roles = $roles;
    }

    public function execute()
    {
        $userRole = '';
        if (Application::$app->session->get('customer')) {
            $userRole = 'customer';
        } else if (Application::$app->session->get('technician')) {
            $userRole = 'technician';
        } else if (Application::$app->session->get('serviceCenter')) {
            $userRole = 'serviceCenter';
        }
        if (!in_array($userRole, $this->roles)) {
            throw new ForbiddenException();
        }
    }
}