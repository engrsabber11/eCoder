<?php
namespace app\core;
use app\core\Router;

class Application{

    public static string $ROOT_DIR;

    public Router $router;
    public Request $request;
    public Response $response;

    public function __construct($rootPath){
        self::$ROOT_DIR = $rootPath;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
    }

    public function run(){
        echo $this->router->resolve();
    }
}
?>