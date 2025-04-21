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
        $sql = "SELECT ctap.pin AS pin, ctap.cus_id AS cus_id, ctap.tech_id AS tech_id, CONCAT(t.fname, ' ', t.lname) AS name, ctap.amount AS amount, ctap.req_id AS req_id, ctap.done AS done FROM cus_tech_adv_payment ctap JOIN technician t ON ctap.tech_id = t.tech_id WHERE cus_id = :cus_id AND done = 'false'";
        $stmt = Application::$app->db->prepare($sql);
        $stmt->bindValue(':cus_id', $cusId);
        $stmt->execute();
        $payments = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $payments;

    }

    public function getCusTechUsingReqId($req_id)
    {
        $sql = "SELECT cus_id, tech_id FROM cus_tech_adv_payment WHERE req_id = :req_id";
        $stmt = self::prepare($sql);
        $stmt->bindValue(':req_id', $req_id);
        $stmt->execute();
        $cusTech = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $cusTech;
    }

    public function deleteAdvPaymentUsingReqId($req_id)
    {
        $sql = "DELETE FROM cus_tech_adv_payment WHERE req_id = :req_id";
        $stmt = Application::$app->db->prepare($sql);
        $stmt->bindValue(':req_id', $req_id);
        $stmt->execute();

    }

    public function getAdvancePayment($req_id)
    {
        $sql = "SELECT * FROM cus_tech_adv_payment WHERE req_id = :req_id";
        $stmt = Application::$app->db->prepare($sql);
        $stmt->bindValue(':req_id', $req_id);
        $stmt->execute();
        $payment = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $payment;
    }

    public function updatePaymentStatus($order_id)
    {
        $sql = "UPDATE cus_tech_adv_payment SET done = 'true' WHERE req_id = :req_id";
        $stmt = Application::$app->db->prepare($sql);
        $stmt->bindValue(':req_id', $order_id);
        $stmt->execute();
    }

    public function countAdvancePayment($cus_id)
    {
        $sql = "SELECT COUNT(*) FROM cus_tech_adv_payment WHERE cus_id = :cus_id AND done = 'false'";
        $stmt = Application::$app->db->prepare($sql);
        $stmt->bindValue(':cus_id', $cus_id);
        $stmt->execute();
        $count = $stmt->fetchColumn();
        return $count;
    }

    public function getTotalEarning($tech_id)
    {
        $sql = "SELECT SUM(amount) AS total FROM cus_tech_adv_payment WHERE tech_id = :tech_id AND done = 'true'";
        $stmt = Application::$app->db->prepare($sql);
        $stmt->bindValue(':tech_id', $tech_id);
        $stmt->execute();
        $total = $stmt->fetchColumn();
        return $total;
    }

    public function getTotalAdvancePaymentRevenue()
    {
        $sql = "SELECT SUM(amount) AS total FROM cus_tech_adv_payment WHERE done = 'true'";
        $stmt = Application::$app->db->prepare($sql);
        $stmt->execute();
        $total = $stmt->fetchColumn();
        return $total;

    }

    public function getTotalPendingAdvancePayment($tech_id)
    {
        $sql = "SELECT SUM(amount) AS total FROM cus_tech_adv_payment WHERE tech_id = :tech_id AND done = 'false'";
        $stmt = Application::$app->db->prepare($sql);
        $stmt->bindValue(':tech_id', $tech_id);
        $stmt->execute();
        $pending = $stmt->fetchColumn();
        return $pending;
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