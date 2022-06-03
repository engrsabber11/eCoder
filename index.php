<?php 

    use app\core\Application;
    use app\core\Router;

    require_once __DIR__.'/vendor/autoload.php';
    
    $app = new Application();

    $app->router->get('/', function(){
        return "Hello word";
    });

    $app->router->get('/sabber', function(){
        return "Hello Sabber";
    });

    $app->router->get('/contact', function(){
        return "Hello Contact";
    });

    $app->run();
?>