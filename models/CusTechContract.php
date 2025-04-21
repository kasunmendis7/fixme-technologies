<?php

namespace app\models;

use app\core\DbModel;

class CusTechContract extends DbModel
{
    public function createCusTechContractUsingReqId($req_id)
    {
        $ctAdvModel = new CusTechAdvPayment();
        $cusTech = $ctAdvModel->getCusTechUsingReqId($req_id);
        $cus_id = $cusTech['cus_id'];
        $tech_id = $cusTech['tech_id'];
        $sql = "INSERT INTO cus_tech_contract(cus_id, tech_id) VALUES(:cus_id, :tech_id)";
        $stmt = self::prepare($sql);
        $stmt->bindValue(':cus_id', $cus_id);
        $stmt->bindValue(':tech_id', $tech_id);
        $stmt->execute();

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