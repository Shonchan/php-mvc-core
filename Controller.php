<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 29.11.2020
 * Time: 17:16
 */

namespace shonchan\phpmvc;

use shonchan\phpmvc\middlewares\BaseMiddleware;

/**
 * Class Controller
 * @package App
 */
class Controller
{
    public $layout = 'main';
    public $action = '';
    /**
     * @var BaseMiddleware[]
     */
    protected $middlewares = [];

    public function setLayout($layout)
    {
        $this->layout = $layout;
    }

    /**
     * @param $view
     * @param array $params
     * @return mixed
     */
    public function render( $view, $params =[])
    {
        return Application::$app->view->renderView($view, $params);
    }

    public function registerMiddleware(BaseMiddleware $middleware)
    {
        $this->middlewares[] = $middleware;
    }

    /**
     * @return BaseMiddleware[]
     */
    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }
}