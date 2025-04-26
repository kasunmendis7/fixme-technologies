<?php

namespace app\models;

use app\core\DbModel;


class ServiceCenterServices extends DbModel
{
    public int $service_center_id;
    public string $name;

    public function tableName(): string
    {
        return 'service_center_services';
    }

    public function primaryKey(): string
    {
        return 'id';
    }

    public function updateRules(): array
    {
        return [];
    }

    public function attributes(): array
    {
        return ['service_center_id', 'name'];
    }

    public function rules(): array
    {
        return [
            'service_center_id' => [self::RULE_REQUIRED],
            'name' => [self::RULE_REQUIRED]
        ];
    }

    //function to get all services for a specific service center
    public function getServicesByServiceCenter($service_center_id)
    {
        $sql = "SELECT * FROM " . $this->tableName() . " WHERE service_center_id = :service_center_id";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(':service_center_id', $service_center_id);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    
}