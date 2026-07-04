<h1>Create Book Order</h1>

<form method="POST" action="/book-orders">
    <label>Customer</label>

    <br>

    <select name="customer_id">
        <option value="">Select customer</option>
        <?php foreach ($customers as $customer): ?>
            <option
                value="<?= $customer['id'] ?>"
                <?= ($old['customer_id'] ?? '') == $customer['id']
                    ? 'selected'
                    : ''
                ?>>
                <?= e($customer['name']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <div style="color:red">
        <?= e($errors['customer_id'] ?? '') ?>
    </div>

    <br><br>

    <label>Book Title</label>

    <br>

    <input
        type="text"
        name="book_title"
        value="<?= e($old['book_title'] ?? '') ?>">

    <div style="color:red">
        <?= e($errors['book_title'] ?? '') ?>
    </div>

    <br><br>

    <label>Quantity</label>

    <br>

    <input
        type="number"
        name="quantity"

    <div style="color:red">
        <?= e($errors['quantity'] ?? '') ?>
    </div>

    <br><br>

    <label>Unit Price</label>

    <br>

    <input
        type="number"
        name="unit_price"
        value="<?= e($old['unit_price'] ?? '') ?>">
    <div style="color:red">
        <?= e($errors['unit_price'] ?? '') ?>
    </div>

    <br><br>

    <label>Status</label>

    <br>

    <select name="status">
        <option value="pending">Pending</option>
        <option value="completed">Completed</option>
        <option value="cancelled">Cancelled</option>
    </select>

    <div style="color:red">
        <?= e($errors['status'] ?? '') ?>
    </div>

    <br><br>

    <button>
        Save
    </button>

    <a href="/book-orders">
        Back
    </a>
</form>

