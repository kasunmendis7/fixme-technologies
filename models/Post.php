<?php

namespace app\models;

use app\core\DbModel;

class Post extends DbModel
{
    public int $post_id;
    public int $tech_id;
    public string $description;
    public ?string $created_at = null;
    public ?string $updated_at = null;

    public static function tableName(): string
    {
        return 'post';
    }

    public function attributes(): array
    {
        return ['tech_id', 'description', 'created_at', 'updated_at'];
    }

    public function primaryKey(): string
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
     * Saves post and media entry.
     *
     * @param array $mediaData - Data for media, such as ['media_type' => 'image/jpeg', 'media_url' => '/path/to/image.jpg']
     * @return bool
     */
    public function savePostWithMedia(array $mediaData): bool
    {
        $this->created_at = date('Y-m-d H:i:s');
        $this->updated_at = date('Y-m-d H:i:s');

        // Begin transaction for atomicity
        $db = self::getDb();
        $db->beginTransaction();

        try {
            // Save post in `post` table
            if (!$this->save()) {
                $db->rollBack();
                return false;
            }

            // Retrieve the last inserted post ID for foreign key reference
            $this->post_id = $db->lastInsertId();

            // Save media in `media` table
            $media = new Media();
            $media->post_id = $this->post_id;
            $media->media_type = $mediaData['media_type'];
            $media->media_url = $mediaData['media_url'];
            $media->uploaded_at = date('Y-m-d H:i:s');

            if (!$media->save()) {
                $db->rollBack();
                return false;
            }

            // Commit transaction
            $db->commit();
            return true;
        } catch (\Exception $e) {
            $db->rollBack();
            return false;
        }
    }
}
