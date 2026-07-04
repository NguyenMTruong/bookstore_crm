<?php
 
function e(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}
 
function redirect(string $path): void
{
    header("Location: {$path}");
    exit;
}
 
function query_string(array $params = []): string
{
    $current = $_GET;
    foreach ($params as $key => $value) {
        $current[$key] = $value;
    }
    return http_build_query($current);
}
 
function flash(string $key, string $message): void
{
    $_SESSION['flash'][$key] = $message;
}
 
function get_flash(string $key): ?string
{
    if (empty($_SESSION['flash'][$key])) return null;
    $message = $_SESSION['flash'][$key];
    unset($_SESSION['flash'][$key]);
    return $message;
}
 
function view(string $view, array $data = []): void
{
    extract($data);
    require __DIR__ . "/../Views/layouts/main.php";
}

function view_path(string $view): string
{
    return __DIR__ . "/../Views/{$view}.php";
}

