<?php

namespace app\core;

abstract class TechnicianModel extends DbModel
{
    abstract public function getDisplayName(): string;

    abstract public function attributes(): array;

    public function save(){
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $params=array_map(fn($attr)=>":$attr", $attributes);
        $statement = self::prepare("INSERT INTO $tableName (".implode(',', $attributes).") 
                                        VALUES (".implode(',', $params).")");
        $statement->execute(array_combine($params, $this->attributes()));
    }
}