<?php
class Router
{
    private array $routes = [];

    public function get(string $path, array $handler): void
    {
        $this->routes[$path]['GET'] = $handler;
    }

    public function post(string $path, array $handler): void
    {
        $this->routes[$path]['POST'] = $handler;
    }

    public function dispatch(string $method, string $path): void
    {
        if (!isset($this->routes[$path])) {

            http_response_code(404);

            view('errors/404');

            return;
        }

        if (!isset($this->routes[$path][$method])) {

            http_response_code(405);

            view('errors/405');

            return;
        }

        [$controller, $action]
            = $this->routes[$path][$method];
        (new $controller())->$action();
    }
}

