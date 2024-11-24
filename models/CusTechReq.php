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
            Application::$app->session->setFlash('createCusTechReq-success', 'You have been successfully requested this technician');

            return ['success' => true, 'message' => 'Customer request created succesfully'];
        } else {
            /* Bad request http status code*/
            Application::$app->response->setStatusCode(400);
            Application::$app->session->setFlash('createCusTechReq-error', 'You have already been requested this technician');

            return ['success' => false, 'message' => 'Customer request already created !'];
        }
    }

    public function getAllRequests($cusId)
    {
        $sql = "SELECT tech.fname AS fname, tech.lname AS lname, ctr.status AS status FROM technician AS tech, cus_tech_req AS ctr WHERE ctr.tech_id = tech.tech_id AND ctr.cus_id = :cus_id";
        $stmt = self::prepare($sql);
        $stmt->bindValue(':cus_id', $cusId);
        $stmt->execute();
        $requests = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $requests;
    }

    public function getRecentTechnicians($cusId)
    {
        $sql = "SELECT tech.fname AS fname, tech.lname AS lname, tech.profile_picture AS profile_picture FROM technician AS tech, cus_tech_req AS ctr WHERE tech.tech_id = ctr.tech_id AND ctr.cus_id = :cus_id AND ctr.status = 'pending'";
        /* Reminder : change ctr.status = 'completed' after implementing the completed status */
        $stmt = self::prepare($sql);
        $stmt->bindValue(':cus_id', $cusId);
        $stmt->execute();
        $recentTechnicians = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $recentTechnicians;
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