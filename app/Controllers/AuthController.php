<?php
require __DIR__.'/../Services/AuthService.php';
class AuthController
{
    private AuthService $authService;

    public function __construct()
    {
        $this->authService = new AuthService();
    }

    /**
     * Hiển thị form login
     */
    public function login(): void
    {
        if(is_logged_in())
            redirect('/dashboard');

        view('auth/login', [
            'title' => 'Login',
            'view' => 'auth/login',
            'errors' => get_flash('errors', []),
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

        // Validate email
        if ($email === '') {
            $errors['email'] = 'Email is required.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Invalid email format.';
        }

        // Validate password
        if ($password === '') {
            $errors['password'] = 'Password is required.';
        }

        // Nếu validate lỗi
        if (!empty($errors)) {

            flash('errors', $errors);

            flash('old', [
                'email' => $email
            ]);

            redirect('/login');
        }

        // Kiểm tra tài khoản
        $user = $this->authService->attempt($email, $password);

        if (!$user) {

            flash('errors', [
                'password' => 'Email or password is incorrect.'
            ]);

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

        flash(
            'success',
            'Login successfully.'
        );

        redirect('/dashboard');
    }

    /**
     * POST /logout
     */
    public function logout(): void
    {
        logout_clean();

        session_start();

        flash(
            'success',
            'Logout successfully.'
        );

        redirect('/login');
    }
}

