<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 12.12.2020
 * Time: 14:26
 */

namespace App\middlewares;


use App\Application;
use App\exception\ForbiddenException;

class AuthMiddleware extends BaseMiddleware
{
    public $actions = [];

    /**
     * AuthMiddleware constructor.
     * @param array $actions
     */
    public function __construct(array $actions = [])
    {
        $this->actions = $actions;
    }

    public function execute()
    {
        if (Application::isGuest()) {
            if (empty($this->actions) || in_array(Application::$controller->action, $this->actions)) {
                throw new ForbiddenException();
            }
        }
    }
}