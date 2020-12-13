<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 29.11.2020
 * Time: 16:22
 */

namespace App;


class Response
{
    public function setStatusCode(int $code)
    {
        http_response_code($code);
    }

    public function redirect(string $url)
    {
        header('Location: '.$url);
    }
}