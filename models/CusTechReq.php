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

    public function deleteCusTechReq($cusId, $techId)
    {
        /* Check if a pending request from customer to technician already exits in the database */
        $sql = "SELECT req_id FROM cus_tech_req WHERE cus_id = :cus_id AND tech_id = :tech_id";
        $stmt = self::prepare($sql);
        $stmt->bindValue(':cus_id', $cusId);
        $stmt->bindValue(':tech_id', $techId);
        $stmt->execute();
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($row) {
            $sql = "DELETE FROM cus_tech_req WHERE cus_id = :cus_id AND tech_id = :tech_id";
            $stmt = self::prepare($sql);
            $stmt->bindValue(':cus_id', $cusId);
            $stmt->bindValue(':tech_id', $techId);
            $stmt->execute();
            Application::$app->response->setStatusCode(200);
            Application::$app->session->setflash('deleteCusTechReq-success', 'You have been successfully deleted the request !');

            return ['success' => true, 'message' => 'Customer request deleted succesfully'];

        } else {
            Application::$app->response->setStatusCode(400);
            Application::$app->session->setFlash('deleteCusTechReq-error', 'You have already been deleted the request for this technician !');

            return ['success' => false, 'message' => 'Unable to delete technician request !'];
        }
    }

    public function deleteCusTechReqUsingReqId($req_id)
    {
        $sql = "DELETE FROM cus_tech_req WHERE req_id = :req_id";
        $stmt = self::prepare($sql);
        $stmt->bindValue(':req_id', $req_id);
        $stmt->execute();
        Application::$app->response->setStatusCode(200);
    }

    public function getAllRequests($cusId)
    {
        $sql = "SELECT ctr.req_id AS req_id, ctr.tech_id AS tech_id, ctr.cus_id AS cus_id, tech.fname AS fname, tech.lname AS lname, ctr.status AS status, ctap.amount AS amount, ctap.done AS done FROM technician AS tech, cus_tech_req AS ctr LEFT JOIN cus_tech_adv_payment AS ctap ON ctr.req_id = ctap.req_id WHERE ctr.tech_id = tech.tech_id AND ctr.cus_id = :cus_id";
        $stmt = self::prepare($sql);
        $stmt->bindValue(':cus_id', $cusId);
        $stmt->execute();
        $requests = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $requests;
    }

    public function getAllTechnicianRequests($techId)
    {
        $sql = "SELECT ctr.cus_id AS cus_id, ctr.tech_id AS tech_id, cus.fname AS fname, cus.lname AS lname, ctr.status AS status, ctr.req_id AS req_id, ctap.amount AS amount, ctap.done AS done 
            FROM customer AS cus
            INNER JOIN cus_tech_req AS ctr ON ctr.cus_id = cus.cus_id 
            LEFT JOIN cus_tech_adv_payment AS ctap ON ctr.req_id = ctap.req_id
            WHERE ctr.tech_id = :tech_id
            ORDER BY ctr.req_id DESC";
        $stmt = self::prepare($sql);
        $stmt->bindValue(':tech_id', $techId, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
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

    public function getRecentCustomers($techId)
    {
        $sql = "SELECT cus.fname AS fname, cus.lname AS lname, cus.profile_picture AS profile_picture FROM customer AS cus, cus_tech_req AS ctr WHERE cus.cus_id = ctr.cus_id AND ctr.tech_id = :tech_id AND (ctr.status = 'pending' OR ctr.status = 'InProgress') ORDER BY ctr.req_id DESC";
        /* Reminder : change ctr.status = 'completed' after implementing the completed status */
        $stmt = self::prepare($sql);
        $stmt->bindValue(':tech_id', $techId);
        $stmt->execute();
        $recentCustomers = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $recentCustomers;
    }

    public function getTechnicianTotalRepairs($techId)
    {
        $sql = "SELECT COUNT(*) AS total_repairs FROM cus_tech_req WHERE tech_id = :tech_id";
        $stmt = self::prepare($sql);
        $stmt->bindValue(':tech_id', $techId);
        $stmt->execute();
        $totalTechnicianRepairs = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $totalTechnicianRepairs['total_repairs'] ?? 0; // Ensuring a default value is returned
    }

    public function getRequestId($cusId, $techId)
    {
        $sql = "SELECT req_id FROM cus_tech_req WHERE cus_id = :cus_id AND tech_id = :tech_id ORDER BY time DESC LIMIT 1";
        $stmt = self::prepare($sql);
        $stmt->bindValue(':cus_id', $cusId);
        $stmt->bindValue(':tech_id', $techId);
        $stmt->execute();
        $requestId = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $requestId['req_id'];
    }

    public function getTechnicianRejectedRepairs($tech_id)
    {
        $sql = "SELECT COUNT(*) AS total_repairs FROM cus_tech_req WHERE tech_id = :tech_id AND status = 'Rejected'";
        $stmt = self::prepare($sql);
        $stmt->bindValue(':tech_id', $tech_id, \PDO::PARAM_INT); // Added explicit parameter type
        $stmt->execute();
        $totalTechnicianRepairs = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $totalTechnicianRepairs['total_repairs'] ?? 0;

    }

    public function countTotalRequests()
    {
        $sql = "SELECT COUNT(*) as total_requests FROM cus_tech_req";
        $stmt = self::prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result['total_requests'] ?? 0;
    }

    public function countPendingTotalRequests()
    {
        $sql = "SELECT COUNT(*) as total_requests FROM cus_tech_req WHERE status = 'pending'";
        $stmt = self::prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result['total_requests'] ?? 0;

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