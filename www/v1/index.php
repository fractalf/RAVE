<?php
namespace Rave\Modules;
use Rave\Lib\Tpl;

// Require composer autoloader
require __DIR__ . '/../../vendor/autoload.php';

// Create Router instance
$router = new \Bramus\Router\Router();

$router->get('/', function() {
    Tpl::render('usage.html');
});

$router->mount('/foo', function() use ($router) {
 
    $router->get('/bar', function() {
        Foo::bar();
    });

    $router->post('/beer/(.+)', function ($task) {
        switch ($task) {
            case 'brew':
                Foo::beerBrew();
                break;
        }
    });
    
});

$router->set404(function() {
    header('HTTP/1.1 404 Not Found');
    Tpl::render('404.html');
});

$router->run();
