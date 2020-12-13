<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 12.12.2020
 * Time: 15:30
 */

namespace shonchan\phpmvc\exception;


class NotFounsException extends \Exception
{
    protected $message = 'Page not found';
    protected $code = 404;
}