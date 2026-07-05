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
 
function flash(string $key, mixed $message): void
{
    $_SESSION['flash'][$key] = $message;
}
 
function get_flash(string $key, mixed $default = null): mixed
{
    if (!isset($_SESSION['flash'][$key])) {
        return $default;
    }

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

function is_logged_in(): bool
{
    return isset($_SESSION['user_id']);
}
 
function require_login(): void
{
    if (!is_logged_in()) {
        flash('error', 'Vui lòng đăng nhập để truy cập.');
        redirect('/login');
    }
}
 
function check_session_timeout(): void
{
    $idleLimit = 15 * 60; // 15 phút. Khi demo có thể đổi thành 60 giây.
 
    if (!isset($_SESSION['user_id'])) {
        return;
    }
 
    $last = $_SESSION['last_activity_at'] ?? time();
    if (time() - $last > $idleLimit) {
        logout_clean();
        session_start();
        flash('error', 'Phiên đăng nhập đã hết hạn. Vui lòng đăng nhập lại.');
        redirect('/login');
    }
 
    $_SESSION['last_activity_at'] = time();
}
 
function check_session_context(): void
{
    if (!isset($_SESSION['user_id'])) {
        return;
    }
 
    $currentAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';
    $savedAgent = $_SESSION['user_agent'] ?? '';
 
    if ($savedAgent !== '' && $savedAgent !== $currentAgent) {
        logout_clean();
        session_start();
        flash('error', 'Phiên có dấu hiệu bất thường. Vui lòng đăng nhập lại.');
        redirect('/login');
    }
}
 
function logout_clean(): void
{
    $_SESSION = [];
 
    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params['path'],
            $params['domain'],
            $params['secure'],
            $params['httponly']
        );
    }
 
    session_destroy();
}

function check_rate_limit(int $seconds = 5): void
{
    $last = $_SESSION['last_submit'] ?? 0;

    if (time() - $last < $seconds) {

        flash(
            'errors',
            ['Please wait a few seconds before submitting again.']
        );

        redirect($_SERVER['HTTP_REFERER'] ?? '/');

        exit;
    }

    $_SESSION['last_submit'] = time();
}

