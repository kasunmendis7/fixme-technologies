<?php

namespace app\models;

use app\core\DbModel;

class Media extends DbModel
{
    public int $media_id;
    public int $post_id;
    public ?string $media_type;
    public ?string $media_url;
    public ?string $uploaded_at;

    public function tableName(): string
    {
        return 'media';
    }

    public function attributes(): array
    {
        return ['post_id', 'media_type', 'media_url', 'uploaded_at'];
    }

    public function primaryKey(): string
    {
        return 'media_id';
    }

    public function rules(): array
    {
        return [
            'post_id' => [self::RULE_REQUIRED],
            'media_type' => [self::RULE_REQUIRED],
            'media_url' => [self::RULE_REQUIRED, [self::RULE_MAX, 'max' => 1000]],
        ];
    }

    public function save(): bool
    {
        $this->uploaded_at = date('Y-m-d H:i:s');
        return parent::save();
    }
}
