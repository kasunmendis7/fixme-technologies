<?php

namespace app\models;

use app\core\Application;
use app\core\DbModel;

class CusTechReq extends DbModel
{

    public function tableName(): string
    {
        return 'cus_tech_req';
    }

    public function createCusTechReq($cusId, $techId)
    {
        /* If the customer has already requested this technician no need to allow him to request again */
        $sql = "SELECT req_id FROM cus_tech_req WHERE cus_id = :cus_id AND tech_id = :tech_id AND status = 'pending'";
        $stmt = Application::$app->db->prepare($sql);
        $stmt->bindValue(':cus_id', $cusId);
        $stmt->bindValue(':tech_id', $techId);
        $stmt->execute();
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$row) {
            $sql = "INSERT INTO cus_tech_req (cus_id, tech_id, status) VALUES (:cus_id, :tech_id, 'pending')";
            $stmt = self::prepare($sql);
            $stmt->bindValue(':cus_id', $cusId);
            $stmt->bindValue(':tech_id', $techId);
            $stmt->execute();
            Application::$app->response->setStatusCode(200);

            return ['success' => true, 'message' => 'Customer request created succesfully'];
        } else {
            /* Bad request http status code*/
            Application::$app->response->setStatusCode(400);
            return ['success' => false, 'message' => 'Customer request already created !'];
        }
    }

    public function attributes(): array
    {
        return [
            'cus_id',
            'tech_id',
            'status',
        ];
    }

    public function primaryKey(): string
    {
        return 'req_id';
    }

    public function rules(): array
    {
        return [
            ['cus_id', [self::RULE_REQUIRED]],
            ['tech_id', [self::RULE_REQUIRED]],
            ['status', [self::RULE_REQUIRED]],
        ];
    }

    public function updateRules(): array
    {
        return [];
    }
}