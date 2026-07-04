<h1>Edit Customer</h1>

<form method="POST" action="/customers/update">
    <input
        type="hidden"
        name="id"
        value="<?= $customer['id'] ?>"
    >

    <div>
        <label>Name</label><br>
        <input
            type="text"
            name="name"
            value="<?= e($customer['name']) ?>"
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
            value="<?= e($customer['email']) ?>"
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
            value="<?= e($customer['phone']) ?>"
        >
    </div>
    <br>
    <div>
        <label>Address</label><br>
        <textarea
            name="address"
            rows="3"
        ><?= e($customer['address']) ?></textarea>
    </div>
    <br>
    <button type="submit">
        Update
    </button>
    <a href="/customers">
        Back
    </a>
</form>

