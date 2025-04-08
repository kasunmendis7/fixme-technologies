<?php

namespace app\core\form;

use app\core\Model;

class Field
{

    public Model $model;
    public string $attribute;

    public function __construct(Model $model, string $attribute)
    {
        $this->model = $model;
        $this->attribute = $attribute;
    }

    public function __toString()
    {
        return sprintf(
            '
            <div class="input-element %s">
                <label for="%s">%s</label>
                <input type="text" name="%s" value="%s" id="%s">
                <div class="invalid-feedback">
                    %s
                </div>
            </div>
        ',
            $this->model->hasError($this->attribute) ? 'is-invalid' : '',
            $this->attribute,
            $this->attribute,
            $this->attribute,
            $this->model->{$this->attribute},
            $this->attribute,
            $this->model->getFirstError($this->attribute),
        );
    }
}
