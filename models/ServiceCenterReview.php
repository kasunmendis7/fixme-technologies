<?php

namespace app\models;

use app\core\Application;
use app\core\DbModel;
use app\models\Customer;

class ServiceCenterReview extends DbModel
{
    public string $user_name = '';
    public int $user_rating = 0;
    public string $user_review = '';
    public int $datetime;
    public int $cus_id;
    public int $ser_cen_id;


    public function tableName(): string
    {
        return 'ser_cen_reviews';
    }

    public function attributes(): array
    {
        return ['cus_id', 'ser_cen_id', 'user_name', 'user_rating', 'user_review'];
    }

    public function rules(): array
    {
        return [
//            'user_name' => [self::RULE_REQUIRED],
            'user_rating' => [self::RULE_REQUIRED],
        ];
    }

    public function saveReview(): bool
    {
        $customer_id = Application::$app->session->get('customer');
        $this->cus_id = $customer_id;
        return $this->save();
    }

    public static function fetchServiceCenterReviews($ser_cen_id): array
    {
        $sql = "SELECT * FROM ser_cen_reviews WHERE ser_cen_id = :ser_cen_id ORDER BY review_id DESC";
        $stmt = (new ServiceCenterReview)->prepare($sql);
        $stmt->bindValue(':ser_cen_id', $ser_cen_id);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function countTotalReviewsByServiceCenterId($ser_cen_id): int
    {
        $sql = "SELECT COUNT(*) as total_reviews FROM ser_cen_reviews WHERE ser_cen_id = :ser_cen_id";
        $stmt = (new ServiceCenterReview())->prepare($sql);
        $stmt->bindValue(':ser_cen_id', $ser_cen_id);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result['total_reviews'] ?? 0;
    }

    public function primaryKey(): string
    {
        return 'review_id';
    }

    public function updateRules(): array
    {
        return $this->rules();
    }
}
