<?php
namespace app\core;

class Router{

    public Request $request;
    public Response $response;
    public $routes = [];

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;

    }

    public function get($path, $callback){
        $this->routes['get'][$path] = $callback; 
    }

    public function post($path, $callback){
        $this->routes['post'][$path] = $callback; 
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? false;

        if($callback === false){
            $this->response->statusCode(404);
            return $this->pageNotFound();
        }
        if(is_string($callback)){
            return $this->renderView($callback);
        }

        return call_user_func($callback);
    }

    public function renderView($view){
        $contentLayout = $this->layoutContent();
        $renderOnlyView = $this->renderOnlyView($view);
        return str_replace('{{content}}',$renderOnlyView, $contentLayout);
    }

    protected function layoutContent(){
        ob_start();
        require_once Application::$ROOT_DIR."/views/layouts/main.php";
        return ob_get_clean();
    }

    protected function renderOnlyView($view){
        ob_start();
        require_once Application::$ROOT_DIR."/views/$view.php";
        return ob_get_clean();
    }

    public function pageNotFound(){
        return $this->renderView('_404');;
    }
}
?>