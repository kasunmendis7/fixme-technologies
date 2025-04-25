<?php

namespace app\models;

use app\core\DbModel;

class TechSpec extends DbModel
{
    public int $tech_id;
    public array $tech_spec_cat_ids = []; // Array to hold multiple specialization category IDs

    public function tableName(): string
    {
        return 'tech_spec';
    }

    public function attributes(): array
    {
        return ['tech_id', 'tech_spec_cat_id'];
    }

    public function primaryKey(): string
    {
        return 'tech_spec_id';
    }

    // Custom method to save multiple specializations
    public function saveMultiple(): bool
    {
        foreach ($this->tech_spec_cat_ids as $specCatId) {
            $statement = self::prepare("INSERT INTO tech_spec (tech_id, tech_spec_cat_id) VALUES (:tech_id, :tech_spec_cat_id)");
            $statement->bindValue(':tech_id', $this->tech_id);
            $statement->bindValue(':tech_spec_cat_id', $specCatId);
            $statement->execute();
        }
        return true;
    }

    public function fetchTechnicianSpecialization()
    {
        $sql = "SELECT * FROM tech_spec_cat";
        $stmt = self::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function checkTechnicianSpecVeh($tech_id)
    {
        $sql = "SELECT COUNT(*) as total_specs FROM tech_spec_veh WHERE tech_id = :tech_id";
        $stmt = self::prepare($sql);
        $stmt->bindValue(':tech_id', $tech_id);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function checkTechnicianSpecIssue($tech_id)
    {
        $sql = "SELECT COUNT(*) as total_specs FROM tech_spec_issue WHERE tech_id = :tech_id";
        $stmt = self::prepare($sql);
        $stmt->bindValue(':tech_id', $tech_id);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function rules(): array
    {

    }

    public function updateRules(): array
    {

    }
}
