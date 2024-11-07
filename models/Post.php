<?php

namespace app\models;
use app\core\DbModel;

class Post extends DbModel
{
    public int $post_id;
    public int $tech_id;
    public string $description;
    public ?string $created_at = NULL;
    public ?string $updated_at = NULL;

    public static function tableName(): string{
        return 'post';
    }

    public function attributes(): array
    {
        return [
            'tech_id',
            'description',
            'created_at',
            'updated_at',
        ];
    }

    public static function primaryKey(): string
    {
        return 'post_id';
    }

    public function rules(): array
    {
        return [
            'tech_id' => [self::RULE_REQUIRED],
            'description' => [self::RULE_REQUIRED, [self::RULE_MAX, 'max' => 1000]]
        ];
    }

    /**
     * Save post and media entry
     *
     * @param array $mediaData - Data for media, such as ['media_type' => 'image/jpeg', 'media_url' => '']
     * @return bool
     */

    public function savePostWithMedia(array $mediaData): bool
    {
        $this->created_at = date('Y-m-d H:i:s');
        $this->updated_at = date('Y-m-d H:i:s');
        $this->tech_id = $_SESSION['tech_id'];
        return $this->save($mediaData);
        $db = self::getDb();
        $db->beginTransaction();

        try {
            // Save post in 'post' table
            if (!$this->save()) {
                $db->rollBack();
                return false;
            }

            // Retrieve the last inserted post ID for foreign key reference
            $this->post_id = $db->lastInsertId();

            // Save media in 'media' table
            $media = new Media();
            $media->post_id = $this->post_id;
            $media->media_type = $mediaData['media_type'];
            $media->media_url = $mediaData['media_url'];
            $media->uploaded_at = date('Y-m-d H:i:s');

            if (!$media->save()) {
                $db->rollBack();
                return false;
            }

            // Commit the transaction
            $db->commit();
            return true;
        } catch (\Exception $e) {
            $db->rollBack();
            return false;
        }
    }

}