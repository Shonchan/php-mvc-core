<?php
/**
 * User: Alex
 */

namespace App;

use App\db\Database;

/**
 * Class Application
 * @package App
 */
class Application
{
    public static string $ROOT_DIR;

    public $layout = 'main';
    public string $userClass;
    public Router $router;
    public Request $request;
    public Response $response;
    public Database $db;
    public Session $session;
    public ?UserModel $user;
    public View $view;

    public static Application $app;
    public static ?Controller $controller = null;

    public function __construct($rootPath, array $config)
    {
        $this->userClass = $config['userClass'];
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
        $this->router = new Router($this->request, $this->response);
        $this->view = new View();


        $this->db = new Database($config['db']);

        $primaryValue = $this->session->get('user');

        if ($primaryValue) {
            $primaryKey = $this->userClass::primaryKey();
            $this->user = $this->userClass::findOne([$primaryKey => $primaryValue]);
        } else {
            $this->user = null;
        }

    }

    /**
     * @return mixed
     */
    public static function getController(Controller $controller): Controller
    {
        return self::$controller;
    }

    /**
     * @param mixed $controller
     */
    public static function setController(Controller $controller): void
    {
        self::$controller = $controller;
    }

    public static function isGuest()
    {
        return !self::$app->user;
    }


    public function run()
    {
        try{
            echo $this->router->resolve();
        }catch (\Exception $e){
            $this->response->setStatusCode($e->getCode());
            echo $this->view->renderView('_error', [
                'exception' => $e,
            ]);
        }
    }

    public function login(UserModel $user)
    {
        $this->user = $user;
        $primaryKey = $user->primaryKey();
        $primaryValue = $user->{$primaryKey};
        $this->session->set('user', $primaryValue);
        return true;
    }

    public function logout()
    {
        $this->user = null;
        $this->session->remove('user');
    }

}