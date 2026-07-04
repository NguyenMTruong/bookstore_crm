<h1>Login</h1>

<?php if (!empty($success)): ?>
    <div style="color:green;margin-bottom:15px;">
        <?= e($success) ?>
    </div>
<?php endif; ?>

<form method="POST" action="/login">

    <div style="margin-bottom:15px;">

        <label>Email</label><br>

        <input
            type="email"
            name="email"
            value="<?= e($old['email'] ?? '') ?>">

        <?php if (!empty($errors['email'])): ?>
            <div style="color:red;">
                <?= e($errors['email']) ?>
            </div>
        <?php endif; ?>

    </div>

    <div style="margin-bottom:15px;">

        <label>Password</label><br>

        <input
            type="password"
            name="password">

        <?php if (!empty($errors['password'])): ?>
            <div style="color:red;">
                <?= e($errors['password']) ?>
            </div>
        <?php endif; ?>

    </div>

    <button type="submit">
        Login
    </button>

</form>