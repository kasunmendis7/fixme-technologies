<?php

namespace app\models;

use app\core\DbModel;
use app\core\Model;

class Technician extends DbModel
{

    public string $fname = '';
    public string $lname = '';
    public string $phone_no = '';
    public string $address = '';
    public string $email = '';
    public string $password = '';
    public string $confirmPassword = '';

    public static function tableName(): string
    {
        return 'technician';
    }

    public static function primaryKey(): string
    {
        return 'tech_id';
    }

    public function save()
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return parent::save();
    }

    public function rules(): array
    {
        return [
            'fname' => [self::RULE_REQUIRED],
            'lname' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL, [
                self::RULE_UNIQUE, 'class' => self::class
            ]],
            'phone_no' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 10], [self::RULE_MAX, 'max' => 10]],
            'address' => [self::RULE_REQUIRED],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8]],
            'confirmPassword' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']],
        ];
    }

    public function attributes(): array
    {
        return [
            'fname',
            'lname',
            'phone_no',
            'address',
            'email',
            'password',

        ];
    }


}
