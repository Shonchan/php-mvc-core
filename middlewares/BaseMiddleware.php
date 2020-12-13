<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 12.12.2020
 * Time: 14:24
 */

namespace shonchan\phpmvc\middlewares;


abstract class BaseMiddleware
{
    abstract public function execute();
}