<?php

require __DIR__ . '/../Services/AuthService.php';

class AuthController
{
    private AuthService $authService;

    public function __construct()
    {
        $this->authService = new AuthService();
    }

    /**
     * GET /login
     */
    public function login(): void
    {
        if (is_logged_in()) {
            redirect('/dashboard');
        }

        view('auth/login', [
            'title' => 'Login',
            'view'  => 'auth/login',
            'error' => get_flash('error'),
            'success' => get_flash('success'),
            'old' => get_flash('old', [])
        ]);
    }

    /**
     * POST /login
     */
    public function handleLogin(): void
    {
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        $errors = [];

        if ($email === '') {
            $errors[] = 'Email is required.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Invalid email format.';
        }

        if ($password === '') {
            $errors[] = 'Password is required.';
        }

        if (!empty($errors)) {

            flash('error', implode('<br>', $errors));

            flash('old', [
                'email' => $email
            ]);

            redirect('/login');
        }

        $user = $this->authService->attempt($email, $password);

        if (!$user) {

            flash('error', 'Email hoặc mật khẩu không đúng.');

            flash('old', [
                'email' => $email
            ]);

            redirect('/login');
        }

        // Chống Session Fixation
        session_regenerate_id(true);

        // Lưu session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['login_at'] = time();
        $_SESSION['last_activity_at'] = time();
        $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'] ?? '';

        flash('success', 'Đăng nhập thành công.');

        redirect('/dashboard');
    }

    /**
     * POST /logout
     */
    public function logout(): void
    {
        logout_clean();

        session_start();

        flash('success', 'Đăng xuất thành công.');

        redirect('/login');
    }
}

