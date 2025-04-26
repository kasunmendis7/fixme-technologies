<?php

namespace app\models;

use app\core\DbModel;

class Vehicle extends DbModel
{
    public function fetchVehicleTypes()
    {
        $sql = "SELECT * FROM vehicle";
        $stmt = self::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function saveVehicleTypes(): bool
    {
        foreach ($this->vehicle_ids as $vehicle_id) {
            $statement = self::prepare("INSERT INTO tech_spec_veh (tech_id, vehicle_id) VALUES (:tech_id, :vehicle_id)");
            $statement->bindValue(':tech_id', $this->tech_id);
            $statement->bindValue(':vehicle_id', $vehicle_id);
            $statement->execute();
        }
        return true;
    }

    public function getIssuesByVehicleIds(array $vehicleIds): array
    {
        $placeholders = implode(',', array_fill(0, count($vehicleIds), '?'));
        $sql = "
            SELECT DISTINCT
                i.issue_id,
                i.issue_type
            FROM issue AS i
            JOIN vehicle_issue AS vi
              ON i.issue_id = vi.issue_id
            WHERE vi.vehicle_id IN ({$placeholders})
        ";
        $stmt = self::prepare($sql);
        $stmt->execute($vehicleIds);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getVehicleIdsByTechnician(int $techId): array
    {
        $sql = "SELECT vehicle_id FROM tech_spec_veh WHERE tech_id = :tech_id";
        $stmt = self::prepare($sql);
        $stmt->bindValue(':tech_id', $techId, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_COLUMN);
    }

    public function saveSpecializedIssues(): bool
    {
        foreach ($this->issue_ids as $issue_id) {
            $stmt = self::prepare("INSERT INTO tech_spec_issue (tech_id, issue_id) VALUES (:tech_id, :issue_id)");
            $stmt->bindValue(':tech_id', $this->tech_id);
            $stmt->bindValue(':issue_id', $issue_id);
            $stmt->execute();
        }
        return true;
    }

    public function addVehicleType($vehicle_type)
    {
        $sql = "INSERT INTO vehicle(vehicle_type) VALUES (:vehicle_type)";
        $stmt = self::prepare($sql);
        $stmt->bindValue(':vehicle_type', $vehicle_type);
        $stmt->execute();

    }

    public function removeVehicleType($vehicle_id)
    {
        $sql = "DELETE FROM vehicle WHERE vehicle_id = :vehicle_id";
        $stmt = self::prepare($sql);
        $stmt->bindValue(':vehicle_id', $vehicle_id, \PDO::PARAM_INT);
        $stmt->execute();
    }


    public function tableName(): string
    {
        return 'vehicle';
    }

    public function rules(): array
    {
        return [];
    }

    public function attributes(): array
    {
        return ['vehicle_id', 'vehicle_type'];
    }

    public function primaryKey(): string
    {
        return 'vehicle_id';
    }

    public function updateRules(): array
    {
        return [

        ];
    }
}