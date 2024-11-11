<?php

namespace app\models;

use app\core\DbModel;

class Comment extends DbModel
{
    public $comment_id;
    public $post_id;
    public $cus_id;
    public $comment_text;
    public $created_at;

    public static function tableName(): string
    {
        return 'post_comment';
    }

    public static function primaryKey(): string
    {
        return 'comment_id';
    }

    public function attributes(): array
    {
        return ['post_id', 'cus_id', 'comment_text', 'created_at'];
    }

    public function rules(): array
    {
        return [
            'post_id' => [self::RULE_REQUIRED],
            'cus_id' => [self::RULE_REQUIRED],
            'comment_text' => [self::RULE_REQUIRED, [self::RULE_MAX, 'max' => 500]],
        ];
    }

    // Automatically set created_at before saving
    public function save()
    {
        $this->created_at = date('Y-m-d H:i:s');
        return parent::save();
    }

    // Get all comments for a specific post
    public static function getAllComments($post_id): array
    {
        $commentTable = self::tableName(); // 'post_comment'

        $statement = self::prepare("
        SELECT c.*, cu.fname, cu.lname
        FROM $commentTable c
        JOIN customer cu ON c.cus_id = cu.cus_id
        WHERE c.post_id = :post_id
        ORDER BY c.created_at ASC
    ");

        $statement->bindValue(':post_id', $post_id, \PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function deleteComment(int $comment_id, int $cus_id): bool
    {
        $tableName = self::tableName();
        $statement = self::prepare("
        DELETE FROM $tableName 
        WHERE comment_id = :comment_id AND cus_id = :cus_id
    ");
        $statement->bindValue(':comment_id', $comment_id);
        $statement->bindValue(':cus_id', $cus_id);
        return $statement->execute();
    }

}
