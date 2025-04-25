<?php

namespace app\models;

use app\core\DbModel;

class TechSpecVeh extends DbModel
{
    public function getTechsOnIssueAndVeh($vehicle_id, $issue_id)
    {
        $sql = "SELECT tsv.tech_id AS tech_id FROM tech_spec_veh tsv JOIN tech_spec_issue tsi ON tsi.tech_id = tsv.tech_id WHERE tsv.vehicle_id = :vehicle_id AND tsi.issue_id = :issue_id";
        $stmt = self::prepare($sql);
        $stmt->bindValue(':vehicle_id', $vehicle_id);
        $stmt->bindValue(':issue_id', $issue_id);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function tableName(): string
    {
        return 'tech_spec_veh';
    }

    public function attributes(): array
    {
        return [];
    }

    public function primaryKey(): string
    {
        return 'tech_spec_veh_id';
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