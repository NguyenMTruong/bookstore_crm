<h1>Book Orders</h1>

<?php if (!empty($success)): ?>
    <p style="color:green">
        <?= e($success) ?>
    </p>
<?php endif; ?>

<p>
    <a href="/book-orders/create">+ Create Order</a>
</p>

<form method="GET" action="/book-orders">
    <input
        type="text"
        name="q"
        value="<?= e($keyword) ?>"
        placeholder="Search...">
    <button>Search</button>
</form>

<br>

<table border="1" cellpadding="8">
    <tr>
        <th>Order Code</th>
        <th>Customer</th>
        <th>Book</th>
        <th>Qty</th>
        <th>Price</th>
        <th>Total</th>
        <th>Status</th>
        <th>Action</th>
    </tr>

    <?php foreach ($orders as $order): ?>
        <tr>
            <td><?= e($order['order_code']) ?></td>
            <td><?= e($order['customer_name']) ?></td>
            <td><?= e($order['book_title']) ?></td>
            <td><?= e($order['quantity']) ?></td>
            <td><?= number_format($order['unit_price']) ?></td>
            <td><?= number_format($order['total_amount']) ?></td>
            <td><?= e($order['status']) ?></td>
            <td>
                <a href="/book-orders/edit?id=<?= $order['id'] ?>">
                    Edit
                </a>
                |
                <form
                    method="POST"
                    action="/book-orders/delete"
                    style="display:inline">
                    <input
                        type="hidden"
                        name="id"
                        value="<?= $order['id'] ?>">
                    <button
                        onclick="return confirm('Delete order?')">
                        Delete
                    </button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php
    $totalPages = ceil($total / 10);
    for ($i = 1; $i <= $totalPages; $i++):
?>
    <a href="/book-orders?page=<?= $i ?>&q=<?= urlencode($keyword) ?>">
        <?= $i ?>
    </a>
<?php endfor; ?>

