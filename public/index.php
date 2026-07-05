<?php

require __DIR__.'/../vendor/autoload.php';

require __DIR__.'/../app/Core/Router.php';

require __DIR__.'/../app/Controllers/HomeController.php';
require __DIR__.'/../app/Controllers/DashboardController.php';
require __DIR__.'/../app/Controllers/HealthController.php';
require __DIR__.'/../app/Controllers/AuthController.php';
require __DIR__.'/../app/Controllers/CustomerController.php';
require __DIR__.'/../app/Controllers/BookOrderController.php';

$isHttps = (
    (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
);

session_name('BOOKSTORESESSID');

session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'secure' => $isHttps,
    'httponly' => true,
    'samesite' => 'Lax'
]);

session_start();

check_session_context();
check_session_timeout();

$router=new Router();

//**************
// HOME
//**************
$router->get('/',[
    HomeController::class,
    'index'
]);

//**************
// DASHBOARD
//**************
$router->get('/dashboard',[
    DashboardController::class,
    'index'
]);

//**************
// CHECK DB
//**************
$router->get('/health', [
    HealthController::class,
    'index'
]);

//**************
// AUTHENTICATE
//**************
$router->get('/login', [
    AuthController::class,
    'login'
]);

$router->post('/login', [
    AuthController::class,
    'handleLogin'
]);

$router->post('/logout', [
    AuthController::class,
    'logout'
]);

//**************
// CUSTOMER
//**************
$router->get('/customers', [
    CustomerController::class,
    'index'
]);

$router->get('/customers/create', [
    CustomerController::class,
    'create'
]);

$router->post('/customers', [
    CustomerController::class,
    'store'
]);

$router->get('/customers/edit', [
    CustomerController::class,
    'edit'
]);

$router->post('/customers/update', [
    CustomerController::class,
    'update'
]);

$router->post('/customers/delete', [
    CustomerController::class,
    'delete'
]);

//**************
// BOOK ORDER
//**************
$router->get('/book-orders', [
    BookOrderController::class,
    'index'
]);

$router->get('/book-orders/create', [
    BookOrderController::class,
    'create'
]);

$router->post('/book-orders', [
    BookOrderController::class,
    'store'
]);

$router->get('/book-orders/edit', [
    BookOrderController::class,
    'edit'
]);

$router->post('/book-orders/update', [
    BookOrderController::class,
    'update'
]);

$router->post('/book-orders/delete', [
    BookOrderController::class,
    'delete'
]);

try {

    $router->dispatch(
        $_SERVER['REQUEST_METHOD'],
        parse_url(
            $_SERVER['REQUEST_URI'],
            PHP_URL_PATH
        )
    );

} catch (Throwable $e) {

    error_log($e);

    http_response_code(500);

    view('errors/500', [

        'title' => '500',

        'view' => 'errors/500'

    ]);

}

