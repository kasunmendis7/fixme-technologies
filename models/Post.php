<?php

namespace app\models;

use app\core\DbModel;
use app\core\Application;

class Post extends DbModel
{
    public int $tech_id;
    public string $description = '';
    public string $media;
    public ?string $created_at = null;
    public ?string $updated_at = null;

    public function tableName(): string
    {
        return 'post';
    }

    public function attributes(): array
    {
        return ['tech_id', 'description', 'media'];
    }

    public function primaryKey(): string
    {
        return 'post_id';
    }

    public function save()
    {
        $this->media = $_FILES['media']['name'];
        move_uploaded_file($_FILES['media']['tmp_name'], 'assets/uploads/' . $this->media);
        return parent::save();
    }


    public static function getAllPostsWithLikes(?int $userId)
    {
        $sql = "SELECT p.*, t.fname, t.lname, t.profile_picture,
            (SELECT COUNT(*) FROM post_like WHERE post_id = p.post_id) AS like_count,
            (SELECT COUNT(*) FROM post_like WHERE post_id = p.post_id AND cus_id = :user_id) AS user_liked
        FROM post p
        JOIN technician t ON p.tech_id = t.tech_id
        ORDER BY p.created_at DESC";
        $stmt = (new Post)->prepare($sql);
        $stmt->bindValue(':user_id', $userId);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }


    public function editPost(): bool
    {
        $tableName = self::tableName();
        $statement = self::prepare("
            UPDATE $tableName 
            SET description = :description, media = :media, updated_at = NOW() 
            WHERE post_id = :post_id AND tech_id = :tech_id
        ");
        $statement->bindValue(':description', $this->description);
        $statement->bindValue(':media', $this->media);
        $statement->bindValue(':post_id', $this->post_id);
        $statement->bindValue(':tech_id', $this->tech_id);
        return $statement->execute();
    }

    public function deletePost(int $post_id, int $tech_id): bool
    {
        $tableName = self::tableName();
        $statement = self::prepare("
        DELETE FROM $tableName 
        WHERE post_id = :post_id AND tech_id = :tech_id
    ");
        $statement->bindValue(':post_id', $post_id);
        $statement->bindValue(':tech_id', $tech_id);
        return $statement->execute();
    }


    public function postRules(): array
    {
        return [
            'tech_id' => [self::RULE_REQUIRED],
            'description' => [self::RULE_REQUIRED, [self::RULE_MAX, 'max' => 1000]],

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

    // In models/Post.php
    public function getPostsByTechnicianId($id)
    {
        $sql = "SELECT * FROM post WHERE tech_id = :tech_id ORDER BY created_at DESC";
        $stmt = self::prepare($sql);
        $stmt->bindValue(':tech_id', $id);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

}
