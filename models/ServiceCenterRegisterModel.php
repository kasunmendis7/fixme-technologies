<?php

namespace app\models;

use app\core\Model;

class ServiceCenterRegisterModel extends Model
{

    public string $centreName = '';
    public string $nic = '';
    public string $email = '';
    public string $phoneNumber = '';
    public string $address = '';
    public string $password = '';
    public string $confirmPassword = '';

    public function register()
    {
        return 'Creating new Service Center';
    }

    public function rules(): array
    {
        return [
            'centreName' => [self::RULE_REQUIRED],
            'nic' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 10], [self::RULE_MAX, 'max' => 15]],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'phoneNumber' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 10], [self::RULE_MAX, 'max' => 10]],
            'address' => [self::RULE_REQUIRED],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8]],
            'confirmPassword' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']],
        ];
    }
}
