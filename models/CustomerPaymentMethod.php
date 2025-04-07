<?php

namespace app\models;

use app\core\DbModel;
use app\core\Application;

class CustomerPaymentMethod extends DbModel
{
    public function tableName(): string
    {
        return 'cus_payment_opt';
    }

    public function primaryKey(): string
    {
        return 'cus_pay_opt_id';
    }

    public function addPaymentMethod($cusId, $lastFour, $cardType, $expDate)
    {
        $sql = "INSERT INTO cus_payment_opt( cus_id, last_four, card_type, exp_date ) VALUES(:cus_id, :last_four, :card_type, :exp_date)";
        $stmt = Application::$app->db->prepare($sql);
        $stmt->bindValue(':cus_id', $cusId);
        $stmt->bindValue(':last_four', $lastFour);
        $stmt->bindValue(':card_type', $cardType);
        $stmt->bindValue(':exp_date', $expDate);
        $stmt->execute();

    }

    public function rules(): array
    {
        return [
            'cus_id' => [self::RULE_REQUIRED],
            'last_four' => [self::RULE_REQUIRED],
            'card_type' => [self::RULE_REQUIRED],
            'exp_date' => [self::RULE_REQUIRED],
        ];
    }

    public function updateRules(): array
    {
        return [
            'cus_id' => [self::RULE_REQUIRED],
            'last_four' => [self::RULE_REQUIRED],
            'card_type' => [self::RULE_REQUIRED],
            'exp_date' => [self::RULE_REQUIRED],
        ];
    }

    public function attributes(): array
    {
        return [
            'cus_id',
            'last_four',
            'card_type',
            'exp_date',
        ];
    }

}