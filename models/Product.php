<?php

namespace app\models;

use app\core\DbModel;

class Product extends DbModel
{
    public string $ser_cen_id = '';
    public string $description = '';
    public string $price = '';
    public string $media = '';

    public function tableName(): string
    {
        return 'product';
    }

    public function attributes(): array
    {
        return ['ser_cen_id', 'description', 'price', 'media', 'created_at', 'updated_at'];
    }

    public function primaryKey(): string
    {
        return 'product_id';
    }

    public function save()
    {
        // Handle media upload
        if (!empty($_FILES['media']['name'])) {
            $this->media = $_FILES['media']['name'];
            move_uploaded_file($_FILES['media']['tmp_name'], 'assets/products/' . $this->media);
        }

        // Set created and updated timestamps
        $this->created_at = date('Y-m-d H:i:s');
        $this->updated_at = date('Y-m-d H:i:s');

        return parent::save();
    }

    public static function getAllProducts(): array
    {
        $sql = "
            SELECT p.*, sc.name 
            FROM product p
            JOIN service_center sc ON p.ser_cen_id = sc.ser_cen_id
            ORDER BY p.created_at DESC
        ";
        $statement = (new Product)->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function productRules(): array
    {
        return [
            'ser_cen_id' => [self::RULE_REQUIRED],
            'description' => [self::RULE_REQUIRED, [self::RULE_MAX, 'max' => 1000]],
            'price' => [self::RULE_REQUIRED],
            'media' => [self::RULE_REQUIRED],
        ];
    }

    public function rules(): array
    {
        return $this->productRules();
    }

    public function updateRules(): array
    {
        return $this->productRules();
    }
}
