<?php

namespace app\models;

use app\core\DbModel;

class VehicleIssue extends DbModel
{
    public function getVehicleIssues($vehicle_id)
    {
        $sql = "SELECT i.issue_id AS issue_id, i.issue_type AS issue_type FROM issue i JOIN vehicle_issue vi ON i.issue_id = vi.issue_id WHERE vi.vehicle_id = :vehicle_id";
        $stmt = self::prepare($sql);
        $stmt->bindValue(':vehicle_id', $vehicle_id);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function tableName(): string
    {
        return 'vehicle_issue';
    }

    public function attributes(): array
    {
        return [
            'vehicle_issue_id',
            'vehicle_id',
            'issue_id',
        ];
    }

    public function primaryKey(): string
    {
        return 'vehicle_issue_id';
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