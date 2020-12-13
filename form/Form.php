<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 30.11.2020
 * Time: 15:17
 */

namespace App\form;


use App\Model;

class Form
{
    public static function begin($action = '', $method = '')
    {
        echo sprintf('<form action="%s" method="%s">', $action, $method);
        return new Form();
    }

    public static function end()
    {
        echo '</form>';
    }

    public function field(Model $model, $attribute)
    {
        return new InputField($model, $attribute);
    }
}