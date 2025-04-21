<?php

namespace app\models;
use app\core\Application;
use app\core\DbModel;

class CheckoutInfo extends DbModel
{
    public int $user_id;
    public string $email;
    public string $phone;
    public string $full_name;
    public string $address;
    public string $city;
    // public string $country;
    public string $postal_code;
    // public int $save_info = 0;

    public function tableName(): string
    {
        return 'checkout_info';
    }

    public function attributes(): array
    {
        return ['user_id', 'email', 'phone', 'full_name', 'address', 'city', 'postal_code'];
    }

    public function rules(): array
    {
        return [
            // 'user_id' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'phone' => [self::RULE_REQUIRED],
            'full_name' => [self::RULE_REQUIRED],
            'address' => [self::RULE_REQUIRED],
            'city' => [self::RULE_REQUIRED],
            'postal_code' => [self::RULE_REQUIRED],
        ];
    }

    //list the data
    public function listData($user_id)
    {
        $sql = "SELECT * FROM checkout_info WHERE user_id = :user_id";
        $stmt = self::prepare($sql);
        $stmt->bindValue(':user_id', $user_id);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function primaryKey(): string
    {
        return 'id';
    }

    public function updateRules(): array
    {
        return [];
    }

    
}