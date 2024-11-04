<?php

namespace app\models;

use app\core\Model;

class TechnicianModel extends Model
{
    public string $username = '';
    public string $nic = '';
    public string $email = '';
    public string $password = '';
    public string $confirmPassword = '';

    public function signUp(){
        echo "Creating new technician account";
    }

    public function rules():array{
        return[
            'username' => [self::RULE_REQUIRED],
            'nic' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min'=>8], [self::RULE_MAX, 'max'=>24]],
            'confirmPassword' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match'=>'password']],
        ];
    }

}