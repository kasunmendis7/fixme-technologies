<?php

namespace app\models;

use app\core\DbModel;

class Like extends DbModel
{
    public int $like_id;
    public int $post_id;
    public int $cus_id;
    public string $liked_at;

    public static function tableName(): string
    {
        return 'post_like';
    }

    public function attributes(): array
    {
        return ['post_id', 'cus_id', 'liked_at'];
    }

    public function likePost($postId, $customerId)
    {
        $statement = self::prepare("INSERT IGNORE INTO post_like (post_id, cus_id) VALUES (:post_id, :cus_id)");
        $statement->bindValue(':post_id', $postId);
        $statement->bindValue(':cus_id', $customerId);
        return $statement->execute();  // Return true if insertion was successful
    }

    public function unlikePost($postId, $customerId)
    {
        $statement = self::prepare("DELETE FROM post_like WHERE post_id = :post_id AND cus_id = :cus_id");
        $statement->bindValue(':post_id', $postId);
        $statement->bindValue(':cus_id', $customerId);
        return $statement->execute();  // Return true if deletion was successful
    }

    public function toggleLike($postId, $customerId)
    {
        // Check if the like record already exists
        $existingLike = self::prepare("SELECT * FROM post_like WHERE post_id = :post_id AND cus_id = :cus_id");
        $existingLike->bindValue(':post_id', $postId);
        $existingLike->bindValue(':cus_id', $customerId);
        $existingLike->execute();

        if ($existingLike->fetch()) {
            // If a record exists, delete it (unlike the post)
            return $this->unlikePost($postId, $customerId);
        } else {
            // If no record exists, create it (like the post)
            return $this->likePost($postId, $customerId);
        }
    }


    public static function getLikeCountByPostId($postId)
    {
        $statement = self::prepare("SELECT COUNT(*) FROM post_like WHERE post_id = :post_id");
        $statement->bindValue(':post_id', $postId);
        $statement->execute();
        return $statement->fetchColumn();
    }

    public static function userLikedPost($postId, $customerId)
    {
        $statement = self::prepare("SELECT COUNT(*) FROM post_like WHERE post_id = :post_id AND cus_id = :cus_id");
        $statement->bindValue(':post_id', $postId);
        $statement->bindValue(':cus_id', $customerId);
        $statement->execute();
        return $statement->fetchColumn() > 0;
    }

    public function rules(): array
    {
        return [

        ];
    }

    public static function primaryKey(): string
    {
        return 'like_id';
    }
}
