<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?= e($title ?? '') ?></title>
    <link rel="stylesheet" href="/assets/style.css">
</head>

<body>
    <nav>
        <a href="/">Home</a>
        <a href="/dashboard">Dashboard</a>
        <a href="/customers">Customers</a>
        <a href="/book-orders">Book Orders</a>
        <a href="/login">Login</a>
    </nav>

    <div class="container">
        <?php require view_path($view); ?>
    </div>
</body>
</html>