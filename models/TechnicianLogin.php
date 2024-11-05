<?php

namespace app\models;

use app\core\Application;
use app\core\Model;
use app\models\Technician;


class TechnicianLogin extends Model
{
    public string $email = '';
    public string $password = '';

    public function rules():array{
        return[
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED],
        ];
    }

    public function login()
    {
        $technician = Technician::findOne(['email' => $this->email]);
        if (!$technician){
            $this->addError('email', 'Technician does not exist with this email');
            return false;
        }

        if (!password_verify($this->password, $technician->password)) {
            $this->addError('password', 'Password is incorrect');
            return false;
        }
        echo '<pre>';
        var_dump($technician);
        echo '</pre>';
        exit;

        return Application::$app->login($technician);
    }

}