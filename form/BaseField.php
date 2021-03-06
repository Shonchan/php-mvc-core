<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 12.12.2020
 * Time: 16:27
 */

namespace shonchan\phpmvc\form;



use shonchan\phpmvc\Model;

abstract class BaseField
{
    public $model;
    public $attribute;

    /**
     * Field constructor.
     * @param $model
     * @param $attribute
     */
    public function __construct(Model $model, string $attribute)
    {
        $this->model = $model;
        $this->attribute = $attribute;
    }

    abstract public  function  renderInput():string;

    public function __toString()
    {
        return sprintf('
                <div class="form-group">
                    <label >%s</label>
                    %s
                    <div class="invalid-feedback">
                        %s
                    </div>
                </div>
        ',
            $this->model->getLabel($this->attribute),
            $this->renderInput(),
            $this->model->getFirstError($this->attribute)
        );
    }
}