<?php

namespace app\models;

use app\core\Application;
use app\core\DbModel;

class CusTechContract extends DbModel
{
    public function createCusTechContractUsingReqId($req_id)
    {
        $ctAdvModel = new CusTechAdvPayment();
        $cusTech = $ctAdvModel->getCusTechUsingReqId($req_id);
        $cus_id = $cusTech['cus_id'];
        $tech_id = $cusTech['tech_id'];
        $sql = "INSERT INTO cus_tech_contract(cus_id, tech_id, req_id) VALUES(:cus_id, :tech_id, :req_id)";
        $stmt = self::prepare($sql);
        $stmt->bindValue(':cus_id', $cus_id);
        $stmt->bindValue(':tech_id', $tech_id);
        $stmt->bindValue(':req_id', $req_id);
        $stmt->execute();
    }

    /** this is used from the customer point of view to list all active contracts  */
    public function getContractsUsingCusId()
    {
        $cus_id = Application::$app->session->get('customer');
        $sql = "SELECT ctc.contract_id AS contract_id, CONCAT(t.fname, ' ', t.lname) AS technician_name, t.profile_picture AS profile_picture FROM cus_tech_contract ctc JOIN technician t ON ctc.tech_id = t.tech_id WHERE ctc.cus_id = :cus_id AND ctc.done = 'false'";
        $stmt = self::prepare($sql);
        $stmt->bindValue(':cus_id', $cus_id);
        $stmt->execute();
        $contracts = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $contracts;
    }

    public function getContractsUsingTechId()
    {
        $tech_id = Application::$app->session->get('technician');
        $sql = "SELECT ctc.contract_id AS contract_id, CONCAT(c.fname, ' ', c.lname) AS customer_name, c.profile_picture AS profile_picture FROM cus_tech_contract ctc JOIN customer c ON ctc.cus_id = c.cus_id WHERE ctc.tech_id = :tech_id AND ctc.done = 'false'";
        $stmt = self::prepare($sql);
        $stmt->bindValue(':tech_id', $tech_id);
        $stmt->execute();
        $contracts = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $contracts;
    }

    /** This pin will be given to the technician by the customer in order to start the contract */
    public function generateStartPin($contract_id)
    {
        $start_pin = rand(100000, 999999);
        $sql = "UPDATE cus_tech_contract SET start_pin = :start_pin WHERE contract_id = :contract_id";
        $stmt = self::prepare($sql);
        $stmt->bindValue(':start_pin', $start_pin);
        $stmt->bindValue(':contract_id', $contract_id);
        $stmt->execute();
        return $start_pin;
    }

    /** Method to check whether a contract has a start pin */
    public function getStartPin($contract_id)
    {
        $sql = "SELECT start_pin FROM cus_tech_contract WHERE contract_id = :contract_id";
        $stmt = self::prepare($sql);
        $stmt->bindValue(':contract_id', $contract_id);
        $stmt->execute();
        $data = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $data['start_pin'];
    }

    public function getContractUsingContractId($contract_id)
    {
        $sql = "SELECT * FROM cus_tech_contract WHERE contract_id = :contract_id";
        $stmt = self::prepare($sql);
        $stmt->bindValue(':contract_id', $contract_id);
        $stmt->execute();
        $data = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $data;
    }

    public function updateStatusToOngoing($contract_id)
    {
        $sql = "UPDATE cus_tech_contract SET status = 'ongoing' WHERE contract_id = :contract_id";
        $stmt = self::prepare($sql);
        $stmt->bindValue(':contract_id', $contract_id);
        $stmt->execute();
    }

    public function updateStatusToFinished($contract_id)
    {
        $sql = "UPDATE cus_tech_contract SET status = 'finished' WHERE contract_id = :contract_id";
        $stmt = self::prepare($sql);
        $stmt->bindValue(':contract_id', $contract_id);
        $stmt->execute();
    }

    public function finishContract($contract_id)
    {
        $sql = "UPDATE cus_tech_contract SET done = 'true', end_time = NOW() WHERE contract_id = :contract_id";
        $stmt = self::prepare($sql);
        $stmt->bindValue(':contract_id', $contract_id);
        $stmt->execute();
    }

    public function generateFinishPin($contract_id)
    {
        $finish_pin = rand(100000, 999999);
        $sql = "UPDATE cus_tech_contract SET finish_pin = :finish_pin WHERE contract_id = :contract_id";
        $stmt = self::prepare($sql);
        $stmt->bindValue(':finish_pin', $finish_pin);
        $stmt->bindValue(':contract_id', $contract_id);
        $stmt->execute();
        return $finish_pin;
    }

    public function getFinishPin($contract_id)
    {
        $sql = "SELECT finish_pin FROM cus_tech_contract WHERE contract_id = :contract_id";
        $stmt = self::prepare($sql);
        $stmt->bindValue(':contract_id', $contract_id);
        $stmt->execute();
        $data = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $data['finish_pin'];
    }

    public function getReqIdFromContract($contract_id)
    {
        $sql = "SELECT req_id FROM cus_tech_contract WHERE contract_id = :contract_id";
        $stmt = self::prepare($sql);
        $stmt->bindValue(':contract_id', $contract_id);
        $stmt->execute();
        $data = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $data;
    }

    public function tableName(): string
    {
        return 'cus_tech_contract';
    }

    public function attributes(): array
    {
        return [
            'contract_id',
            'cus_id',
            'tech_id',
            'start_time',
            'end_time',
            'done',
        ];
    }

    public function primaryKey(): string
    {
        return 'contract_id';
    }

    public function rules(): array
    {
        return [];
    }

    public function updateRules(): array
    {
        return [];
    }
}