<?php

namespace app\models;

use app\core\Application;
use app\core\Model;
use app\models\Admin;

class AdminLogin extends Model
{

    public string $email = '';
    public string $password = '';

    public function rules(): array
    {
        return [
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED]
        ];
    }

    public function updateRules(): array
    {
        return [];
    }

    public function login()
    {
        $adminModel = new Admin();
        $admin = $adminModel->findOne(['email' => $this->email]);
        if (!$admin) {
            $this->addErrorMessage('email', 'User does not exist with this email');
            return false;
        }

        if (!password_verify($this->password, $admin->password)) {
            $this->addErrorMessage('password', 'Password is incorrect');
            return false;
        }

        show($admin);

        return Application::$app->loginAdmin($admin);
    }
}
