<?php

namespace app\models;

use app\core\Application;
use app\core\DbModel;

class CusTechAdvPayment extends DbModel
{
    public function tableName(): string
    {
        return 'cus_tech_adv_payment';
    }

    public function primaryKey(): string
    {
        return 'pin';

    }

    public function getPendingAdvancePayments($cusId)
    {
        $sql = "SELECT ctap.pin AS pin, CONCAT(t.fname, ' ', t.lname) AS name, ctap.amount AS amount, ctap.req_id AS req_id FROM cus_tech_adv_payment ctap JOIN technician t ON ctap.tech_id = t.tech_id WHERE cus_id = :cus_id AND done = 'false'";
        $stmt = Application::$app->db->prepare($sql);
        $stmt->bindValue(':cus_id', $cusId);
        $stmt->execute();
        $payments = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $payments;

    }

    public function deleteAdvPaymentUsingReqId($req_id)
    {
        $sql = "DELETE FROM cus_tech_adv_payment WHERE req_id = :req_id";
        $stmt = Application::$app->db->prepare($sql);
        $stmt->bindValue(':req_id', $req_id);
        $stmt->execute();

    }

    public function attributes(): array
    {
        return [
            'pin',
            'cus_id',
            'tech_id',
            'amount',
            'time',
            'req_id',
            'done'
        ];
    }

    public function rules(): array
    {
        return [
            'cus_id' => [self::RULE_REQUIRED],
            'tech_id' => [self::RULE_REQUIRED],
            'amount' => [self::RULE_REQUIRED],
            'req_id' => [self::RULE_REQUIRED],
            'done' => [self::RULE_REQUIRED],
        ];
    }

    public function updateRules(): array
    {
        return [];
    }

}