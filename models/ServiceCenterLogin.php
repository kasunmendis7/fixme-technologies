<?php

namespace app\models;

use app\core\Application;
use app\core\Model;

class ServiceCenterLogin extends Model
{
    public string $email = '';
    public string $password = '';
    public function rules(): array
    {
        // TODO: Implement rules() method.
        return [
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED],
        ];
    }

    public function updateRules(): array
    {
        return [];
    }

    public function loginServiceCenter()
    {
        $service_centerModel = new ServiceCenter;
        $service_center = $service_centerModel->findOne(['email' => $this->email]);
        if (!$service_center) {
            $this->addError('email', 'service center not exist with this email');
            return false;
        }

        if (!password_verify($this->password, $service_center->password)) {
            $this->addError('password', 'wrong password');
            return false;
        }

        return Application::$app->loginServiceCenter($service_center);
    }
}
