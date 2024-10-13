<?php

namespace app\core\form;

use app\core\Model;

class Field
{
    public const TYPE_TEXT = 'text';
    public const TYPE_PASSWORD = 'password';
    public const TYPE_NUMBER = 'number';

    public string $type;
    public Model $model;
    public string $attribute;

    public function __construct(Model $model, string $attribute)
    {
        $this->type = self::TYPE_TEXT; // Default input type
        $this->model = $model;
        $this->attribute = $attribute;
    }

    public function __toString()
    {
        return sprintf('
            <div class="input-element">
                <label for="%s">%s</label>
                <input type="%s" name="%s" id="%s" value="%s" class="form-control%s">
                <div class="invalid-feedback">
                    %s
                </div>
            </div>
        ',
            $this->attribute, // For attribute
            ucfirst($this->attribute), // Label text (capitalize the attribute for display)
            $this->type,
            $this->attribute,
            $this->attribute, // Matching ID with name
            htmlspecialchars($this->model->{$this->attribute}), // Ensure safe output
            $this->model->hasError($this->attribute) ? ' is-invalid' : '',
            $this->model->getFirstError($this->attribute)
        );
    }

    public function passwordField()
    {
        $this->type = self::TYPE_PASSWORD; // Change type to password
        return $this;
    }
}
