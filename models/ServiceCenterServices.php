<?php

namespace app\models;

use app\core\DbModel;

class ServiceCenterServices extends DbModel
{
    public int $ser_cen_id = 0;
    public string $name = '';
    public string $created_at; 


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
        return ['ser_cen_id', 'name', 'created_at'];
    }

    public function rules(): array
    {
        return [
            'service_center_id' => [self::RULE_REQUIRED],
            'name' => [self::RULE_REQUIRED]
        ];
    }

    public function create($data)
    {
        $this->loadData($data);
        $this->created_at = date('Y-m-d H:i:s');
        return $this->save();
    }

    public function getServicesByServiceCenter($service_center_id)
    {
        $sql = "SELECT * FROM " . $this->tableName() . " WHERE ser_cen_id = :service_center_id";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(':service_center_id', $service_center_id);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
