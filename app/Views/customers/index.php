<h1>Customer Management</h1>

<?php if (!empty($success)): ?>
    <p style="color: green;">
        <?= e($success) ?>
    </p>
<?php endif; ?>

<p>
    <a href="/customers/create">+ Create Customer</a>
</p>

<form method="GET" action="/customers" style="margin-bottom:20px;">
    <input
        type="text"
        name="q"
        placeholder="Search..."
        value="<?= e($keyword) ?>">
    <button type="submit">
        Search
    </button>
</form>

<table border="1" cellpadding="8" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Created At</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        <?php if (empty($customers)): ?>
            <tr>
                <td colspan="7" align="center">
                    No customer found.
                </td>
            </tr>
        <?php else: ?>
            <?php foreach ($customers as $customer): ?>
                <tr>
                    <td><?= e($customer['id']) ?></td>
                    <td><?= e($customer['name']) ?></td>
                    <td><?= e($customer['email']) ?></td>
                    <td><?= e($customer['phone']) ?></td>
                    <td><?= e($customer['address']) ?></td>
                    <td><?= e($customer['created_at']) ?></td>
                    <td>
                        <a href="/customers/edit?id=<?= $customer['id'] ?>">
                            Edit
                        </a>
                        |
                        <form
                            method="POST"
                            action="/customers/delete"
                            style="display:inline;">
                            <input
                                type="hidden"
                                name="id"
                                value="<?= $customer['id'] ?>">
                            <button
                                onclick="return confirm('Delete this customer?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>
<?php
$totalPages = ceil($total / 10);
if ($totalPages > 1):
?>
    <div style="margin-top:20px;">
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="/customers?page=<?= $i ?>&q=<?= urlencode($keyword) ?>">
                <?= $i ?>
            </a>
        <?php endfor; ?>
    </div>
<?php endif; ?>