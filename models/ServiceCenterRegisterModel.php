<?php

namespace app\models;

use app\core\DbModel;

class ServiceCenterRegisterModel extends DbModel
{

    public string $name = '';
//    public string $nic = '';
    public string $email = '';
    public string $phone_no = '';
    public string $address = '';
    public string $service_category = '';
    public string $password = '';
    public string $confirmPassword = '';

//    public function register()
//    {
//        return 'Creating new Service Center';
//    }

    public static function tableName(): string
    {
        return 'service_center';
    }

    public static function primaryKey(): string
    {
        return 'ser_cen_id';
    }


    public function save()
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return parent::save();
    }

    public function rules(): array
    {
        return [
            'name' => [self::RULE_REQUIRED],
//            'nic' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 10], [self::RULE_MAX, 'max' => 15]],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'phone_no' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 10], [self::RULE_MAX, 'max' => 10]],
            'address' => [self::RULE_REQUIRED],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8]],
            'confirmPassword' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']],
        ];
    }
    public function attributes(): array
    {
        return [
            'name',
//            'nic',
            'phone_no',
            'address',
            'email',
            'password',
            'service_category',
        ];
    }
}
