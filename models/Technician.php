<?php

namespace app\models;

use app\core\Application;
use app\core\DbModel;

class Technician extends DbModel
{

    public string $fname = '';
    public string $lname = '';
    public string $phone_no = '';
    public string $address = '';
    public string $email = '';
    public string $password = '';
    public string $confirmPassword = '';

    public function tableName(): string
    {
        return 'technician';
    }

    public function primaryKey(): string
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
                self::RULE_UNIQUE,
                'class' => self::class
            ]],
            'phone_no' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 10], [self::RULE_MAX, 'max' => 10]],
            'address' => [self::RULE_REQUIRED],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8]],
            'confirmPassword' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']],
        ];
    }

    public function updateRules(): array
    {
        return [
            'fname' => [self::RULE_REQUIRED],
            'lname' => [self::RULE_REQUIRED],
            'phone_no' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 10], [self::RULE_MAX, 'max' => 10]],
            'address' => [self::RULE_REQUIRED],
        ];
    }

    public function updateTechnician()
    {
        $sql = "UPDATE technician SET fname = :fname, lname = :lname, phone_no = :phone_no, address = :address WHERE tech_id = :tech_id";
        $stmt = self::prepare($sql);
        $stmt->bindValue(':fname', $this->fname);
        $stmt->bindValue(':lname', $this->lname);
        $stmt->bindValue(':phone_no', $this->phone_no);
        $stmt->bindValue(':address', $this->address);
        $stmt->bindValue(':tech_id', Application::$app->technician->{'tech_id'});
        return $stmt->execute();
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
