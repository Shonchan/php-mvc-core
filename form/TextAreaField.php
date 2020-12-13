<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 12.12.2020
 * Time: 16:43
 */

namespace App\form;


class TextAreaField extends BaseField
{

    public function renderInput(): string
    {
        return sprintf('<textarea name="%s" class="form-control%s">%s</textarea>',
                $this->attribute,
            $this->model->hasError($this->attribute) ? ' is-invalid' : '',
                $this->model->{$this->attribute},

            );
    }
}