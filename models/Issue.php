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

    public function updateRules(): array
    {
        return [

        ];
    }
}