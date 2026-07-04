<h1>Create Customer</h1>

<form method="POST" action="/customers">
    <div>
        <label>Name</label><br>
        <input
            type="text"
            name="name"
            value="<?= e($old['name'] ?? '') ?>"
        >
        <div style="color:red;">
            <?= e($errors['name'] ?? '') ?>
        </div>
    </div>
    <br>
    <div>
        <label>Email</label><br>
        <input
            type="email"
            name="email"
            value="<?= e($old['email'] ?? '') ?>"
        >
        <div style="color:red;">
            <?= e($errors['email'] ?? '') ?>
        </div>
    </div>
    <br>
    <div>
        <label>Phone</label><br>
        <input
            type="text"
            name="phone"
            value="<?= e($old['phone'] ?? '') ?>"
        >
    </div>
    <br>
    <div>
        <label>Address</label><br>
        <textarea
            name="address"
            rows="3"
        ><?= e($old['address'] ?? '') ?></textarea>
    </div>
    <br>
    <button type="submit">
        Save
    </button>
    <a href="/customers">
        Back
    </a>
</form>

