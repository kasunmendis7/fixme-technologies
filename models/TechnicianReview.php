<?php

namespace app\models;

use app\core\Application;
use app\core\DbModel;
use app\models\Customer;

class TechnicianReview extends DbModel
{
    public string $user_name = '';
    public int $user_rating = 0;
    public string $user_review = '';
    public int $datetime;
    public int $cus_id;
    public int $tech_id;


    public function tableName(): string
    {
        return 'technician_reviews';
    }

    public function attributes(): array
    {
        return ['cus_id', 'tech_id', 'user_name', 'user_rating', 'user_review'];
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

    public static function fetchTechnicianReviews($tech_id): array
    {
        $sql = "SELECT * FROM technician_reviews WHERE tech_id = :tech_id ORDER BY review_id DESC";
        $stmt = (new ServiceCenterReview)->prepare($sql);
        $stmt->bindValue(':tech_id', $tech_id);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function countTotalReviewsByTechnicianId($tech_id): int
    {
        $sql = "SELECT COUNT(*) as total_reviews FROM technician_reviews WHERE tech_id = :tech_id";
        $stmt = (new TechnicianReview())->prepare($sql);
        $stmt->bindValue(':tech_id', $tech_id);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result['total_reviews'] ?? 0;
    }

    public function countTotalTechnicianReviews()
    {
        $sql = "SELECT COUNT(*) as total_reviews FROM technician_reviews";
        $stmt = (new TechnicianReview())->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result['total_reviews'] ?? 0;

    }

    public function getTopRatedTechnicians()
    {
        $sql = "SELECT 
            t.tech_id,
            t.fname, t.lname, t.profile_picture,
            SUM(r.user_rating) AS total_ratings
        FROM technician t
        JOIN technician_reviews r ON t.tech_id = r.tech_id
        GROUP BY t.tech_id
        ORDER BY total_ratings DESC;
";
        $stmt = (new TechnicianReview())->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getAverageRatings($tech_id)
    {
        $sql = "SELECT AVG(user_rating) as average_rating FROM technician_reviews WHERE tech_id = :tech_id";
        $stmt = (new TechnicianReview())->prepare($sql);
        $stmt->bindValue(':tech_id', $tech_id);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result['average_rating'] ?? 0;

    }

    public function getReviewsCnt($cus_id)
    {
        $sql = "SELECT COUNT(*) as reviews_cnt FROM technician_reviews WHERE cus_id = :cus_id";
        $stmt = self::prepare($sql);
        $stmt->bindValue(':cus_id', $cus_id);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result['reviews_cnt'] ?? 0;
    }

    public function primaryKey(): string
    {
        return 'review_id';  // Assuming review_id is your primary key
    }

    public function updateRules(): array
    {
        return $this->rules();
    }
}
