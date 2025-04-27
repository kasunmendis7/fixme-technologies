<?php

namespace app\models;

use app\core\DbModel;

class Issue extends DbModel
{
    public function tableName(): string
    {
        return 'issue';
    }

    public function rules(): array
    {
        return [];
    }

    public function attributes(): array
    {
        return ['issue_id', 'issue_type'];
    }

    public function primaryKey(): string
    {
        return 'issue_id';
    }

    public function fetchIssueTypes()
    {
        $sql = "SELECT * FROM issue";
        $stmt = self::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function addIssueType($issue_type)
    {
        $sql = "INSERT INTO issue(issue_type) VALUES (:issue_type)";
        $stmt = self::prepare($sql);
        $stmt->bindValue(':issue_type', $issue_type);
        $stmt->execute();
    }

    public function removeVehicleIssue($issue_id)
    {
        $sql = "DELETE FROM issue WHERE issue_id = :issue_id";
        $stmt = self::prepare($sql);
        $stmt->bindValue(':issue_id', $issue_id);
        $stmt->execute();
    }

    public function getIssueById($issueId)
    {
        $sql = "SELECT * FROM issue WHERE issue_id = :issue_id";
        $statement = self::prepare($sql);
        $statement->bindValue(':issue_id', $issueId);
        $statement->execute();
        return $statement->fetch(\PDO::FETCH_ASSOC);
    }

    public function updateIssueType($issueId, $issueType)
    {
        $sql = "UPDATE issue SET issue_type = :issue_type WHERE issue_id = :issue_id";
        $statement = self::prepare($sql);
        $statement->bindValue(':issue_type', $issueType);
        $statement->bindValue(':issue_id', $issueId);
        return $statement->execute();
    }

    public function updateRules(): array
    {
        return [

        ];
    }
}