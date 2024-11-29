<?php

namespace app\models;

use app\core\Application;
use app\core\DbModel;


class Promotion extends DbModel
{

    public function tableName(): string
    {
        return 'promotion';
    }

    public function primaryKey(): string
    {
        return 'promotion_id';
    }

    public function rules(): array
    {
        return [
            'admin_id' => [self::RULE_REQUIRED],
            'descriptioin' => [self::RULE_REQUIRED],
            'price' => [self::RULE_REQUIRED],
            'created_at' => [self::RULE_REQUIRED],
            'updated_at' => [self::RULE_REQUIRED],

        ];
    }


    public function updateRules(): array
    {
        return [

        ];
    }

    public function attributes(): array
    {
        return [
            'admin_id',
            'description',
            'price',
            'media',
            'created_at',
            'updated_at'
        ];
    }


    public static function getAllPromotions()
    {
        $sql = "SELECT * FROM promotion";
        $stmt = (new Promotion)->prepare($sql);
        $stmt->execute();
        $promotion = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $promotion;

    }

    public static function insert_promotion($desc, $create, $price, $update, $admin_id = 1)
    {
        $sql = "INSERT INTO promotion 
                (description, created_at, price, updated_at,admin_id) 
                VALUES (:desc, :created, :price, :updated,:admin)";

        $stmt = (new Promotion)->prepare($sql);
        $stmt->bindParam(':desc', $desc);
        $stmt->bindParam(':created', $create);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':updated', $update);
        $stmt->bindParam(':admin', $admin_id);

        return $stmt->execute();
    }

    public static function updatePromotion($id, $desc, $price, $update)
    {
        $sql = "UPDATE promotion 
                SET description = :desc, 
                    price = :price,
                    updated_at = :updated
                WHERE promotion_id = :id";

        $stmt = (new Promotion)->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':desc', $desc);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':updated', $update);

        return $stmt->execute();
    }

    public static function deletePromotion($id)
    {
        $sql = "DELETE FROM promotion WHERE promotion_id = :id";

        $stmt = (new Promotion)->prepare($sql);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }
}
