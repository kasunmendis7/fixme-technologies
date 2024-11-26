<?php

namespace app\core\form;

use app\core\Model;
use app\core\form\Field;

class Form
{

    public static function begin($action, $method, $classes)
    {
        echo sprintf('<form action="%s" method="%s" class="%s">', $action, $method, $classes);
        return new Form();
    }

    public static function end()
    {
        echo "</form>";
    }

    public function field(Model $model, $attribute)
    {
        return new Field($model, $attribute);
    }

    public function submit($label)
    {
        echo "<button type='submit' class='btn'>$label</button>";
    }
}
