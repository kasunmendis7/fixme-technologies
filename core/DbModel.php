<?php

namespace app\core;

abstract class DbModel extends Model
{
    abstract static public function tableName(): string;

    abstract public function attributes(): array;
    abstract static public function primaryKey(): string;


    public function save(){

        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $params = array_map(fn($attr) => ":$attr", $attributes);
        $statement = self::prepare("INSERT INTO $tableName (" . implode(',', $attributes) . ") 
                                        VALUES (" . implode(',', $params) . ")");

        foreach ($attributes as $attribute) {
            $statement->bindValue(":$attribute", $this->$attribute);
        }

        $statement->execute();
        return true;
    }


    public static function findOne($where) // ['email' => 'lastboss@gmail.com', 'fname' => 'mario']
    {
        /* since tableName() is abstract we can't use self::tableName. when use static::tableName() we use the tablename of the class from which findOne() is called */
        $tableName = static::tableName();
        $attributes = array_keys($where);
        /**  SELECT * FROM $tableName WHERE email = :email AND fname = :fname */
        $sql = implode(" AND ", array_map(fn($attr) => "$attr = :$attr", $attributes));
        $statement = self::prepare("SELECT * FROM $tableName WHERE $sql");
        foreach ($where as $key => $item) {
            $statement->bindValue(":$key", $item);
        }
        $statement->execute();
        return $statement->fetchObject(static::class);
        // static::class is used to get the class name of the class from which findOne() is called
        // what fetchObject does is that it fetches the object of the class from which findOne() is called
    }

    public static function prepare($sql)
    {
        return Application::$app->db->pdo->prepare($sql);
    }
}