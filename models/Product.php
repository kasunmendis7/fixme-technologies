<?php

    namespace app\models;

    use app\core\DbModel;

    class Product extends DbModel
    {
        public int $ser_cen_id;
        public string $description = '';
        public float $price;
        public string $media;
        public ?string $created_at = null;
        public ?string $updated_at = null;

        public function tableName(): string
        {
            return 'product';
        }

        public function attributes(): array
        {
            return ['ser_cen_id', 'description', 'price', 'media'];
        }
        public function primaryKey(): string
        {
            return 'product_id';
        }


        public function save()
        {
//            if (!empty($_FILES['media']['name'])) {
//                $uploadDir = 'assets/uploads/';
//                $fileName = uniqid() . '_' . basename($_FILES['media']['name']); // Generate unique name
//                $targetFile = $uploadDir . $fileName;
//
//                // Validate file type and size (example: images only, max 5MB)
//                $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
//                if (in_array($_FILES['media']['type'], $allowedTypes) && $_FILES['media']['size'] <= 5 * 1024 * 1024) {
//                    if (!move_uploaded_file($_FILES['media']['tmp_name'], $targetFile)) {
//                        throw new \Exception('File upload failed.');
//                    }
//                    $this->media = $fileName;
//                } else {
//                    throw new \Exception('Invalid file type or size.');
//                }
//            }
            $this->media = $_FILES['media']['name'];
            move_uploaded_file($_FILES['media']['tmp_name'], 'assets/uploads/' . $this->media);
            return parent::save();
        }

        public static function getAllProducts(): array
        {
            $sql = 'SELECT p.*, s.name AS seller_name
            FROM product p
            JOIN service_center s ON p.ser_cen_id = s.ser_cen_id
            ORDER BY p.created_at DESC';
            $stmt = (new Product)->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function getProductByServiceCenter(int $ser_cen_id): array
        {
            try {
                $sql = 'SELECT * FROM product WHERE ser_cen_id = :ser_cen_id ORDER BY created_at DESC';
                $stmt = self::prepare($sql);
                $stmt->bindValue(':ser_cen_id', $ser_cen_id);
                $stmt->execute();

                $products = $stmt->fetchAll(\PDO::FETCH_ASSOC);

                // Debugging: Check the fetched data
                if (!$products) {
                    throw new \Exception("No products found for service center ID: $ser_cen_id");
                }

                return $products;
            } catch (\Exception $e) {
                // Log the error (optional) and return an empty array
                error_log($e->getMessage());
                return [];
            }
        }

        public function editProduct(): bool
        {
            $sql = "UPDATE product SET description = :description, price = :price, media = :media, updated_at = NOW() WHERE product_id = :product_id AND ser_cen_id = :ser_cen_id";
            $stmt = self::prepare($sql);
            $stmt->bindValue(':description', $this->description);
            $stmt->bindValue(':price', $this->price);
            $stmt->bindValue(':media', $this->media);
            $stmt->bindValue("product_id", $this->product_id);
            $stmt->bindValue("ser_cen_id", $this->ser_cen_id);

            return $stmt->execute();
        }

        public function deleteProduct(int $product_id, int $ser_cen_id): bool
        {
            $tableName = self::tableName();
            $statement = self::prepare("
            DELETE FROM $tableName 
            WHERE product_id = :product_id AND ser_cen_id = :ser_cen_id
        ");
            $statement->bindValue(':product_id', $product_id);
            $statement->bindValue(':seller_id', $ser_cen_id);
            return $statement->execute();
        }
        public function productRules(): array
        {
            return [
                'seller_id' => [self::RULE_REQUIRED],
                'name' => [self::RULE_REQUIRED, [self::RULE_MAX, 'max' => 255]],
                'description' => [self::RULE_REQUIRED, [self::RULE_MAX, 'max' => 1000]],
                'price' => [self::RULE_REQUIRED]
            ];
        }

        public function rules(): array
        {
            return [

            ];
        }

        public function updateRules(): array
        {
            return [

            ];
        }
    }

?>