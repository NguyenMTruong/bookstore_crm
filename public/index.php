<?php

require __DIR__.'/../vendor/autoload.php';

require __DIR__.'./app/Core/Router.php';

require __DIR__.'./app/Controllers/HomeController.php';
require __DIR__.'./app/Controllers/DashboardController.php';

$router=new Router();

$router->get('/',[
    HomeController::class,
    'index'
]);

$router->get('/dashboard',[
    DashboardController::class,
    'index'
]);

$router->dispatch(
    $_SERVER['REQUEST_METHOD'],
    parse_url(
        $_SERVER['REQUEST_URI'],
        PHP_URL_PATH
    )
);
