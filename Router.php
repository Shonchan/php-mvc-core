<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 29.11.2020
 * Time: 13:40
 */

namespace shonchan\phpmvc;

use App\exception\NotFounsException;

/**
 * Class Router
 * @package App
 */
class Router
{
    protected $routes = [];
    public $request;
    public $response;

    /**
     * Router constructor.
     * @param $request
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }


    /**
     * @param $path
     * @param $callback
     */
    public function get( $path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    /**
     * @param $path
     * @param $callback
     */
    public function post( $path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    /**
     * @return mixed|string
     */
    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->method();
        $callback = $this->routes[$method][$path] ?? false;
        if ($callback === false) {
            throw new NotFounsException();
        }
        if (is_string($callback)){
            return Application::$app->view->renderView($callback);
        }
        if (is_array($callback)){

            /** @var Controller $controller */
            $controller = new $callback[0]();
            Application::$controller = $controller;
            $controller->action = $callback[1];
            $callback[0] = $controller;
            foreach ($controller->getMiddlewares()  as $middleware) {
                $middleware->execute();
            }

        }
        return call_user_func($callback, $this->request, $this->response);
    }


}
