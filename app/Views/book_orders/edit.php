<h1>Edit Order</h1>

<form method="POST" action="/book-orders/update">
    <input
        type="hidden"
        name="id"
        value="<?= $order['id'] ?>">

    <label>Customer</label>

    <br>

    <select name="customer_id">
        <?php foreach ($customers as $customer): ?>
            <option
                value="<?= $customer['id'] ?>"
                <?= $order['customer_id'] == $customer['id']
                    ? 'selected'
                    : ''
                ?>>
                <?= e($customer['name']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <br><br>

    <label>Book Title</label>

    <br>

    <input
        type="text"
        name="book_title"
        value="<?= e($order['book_title']) ?>">

    <br><br>

    <label>Quantity</label>

    <br>

    <input
        type="number"
        name="quantity"
        value="<?= e($order['quantity']) ?>">

    <br><br>

    <label>Unit Price</label>

    <br>

    <input
        type="number"
        name="unit_price"
        value="<?= e($order['unit_price']) ?>">

    <br><br>

    <label>Status</label>

    <br>

    <select name="status">
        <option
            value="pending"
            <?= $order['status'] == 'pending'
                ? 'selected' : ''
            ?>>
            Pending
        </option>
        <option
            value="completed"
            <?= $order['status'] == 'completed'
                ? 'selected' : ''
            ?>>
            Completed
        </option>
        <option
            value="cancelled"
            <?= $order['status'] == 'cancelled'
                ? 'selected' : ''
            ?>>
            Cancelled
        </option>
    </select>

    <br><br>

    <button>
        Update
    </button>

    <a href="/book-orders">
        Back
    </a>
</form>

