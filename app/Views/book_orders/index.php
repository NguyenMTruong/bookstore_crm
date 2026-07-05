<section class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-3xl font-bold">Book Orders</h1>
        <p class="text-gray-500 mt-2">Manage bookstore orders.</p>
    </div>

    <a href="/book-orders/create"
        class="bg-blue-600 text-white px-5 py-2 rounded-lg">
        + Create Order
    </a>
</section>

<form method="GET" action="/book-orders"
    class="bg-gray-50 border rounded-lg p-4 mb-6 flex flex-wrap gap-3">

    <input
        name="keyword"
        value="<?= e($keyword ?? '') ?>"
        placeholder="Search order..."
        class="border rounded-lg px-3 py-2 w-72">

    <select name="sort" class="border rounded-lg px-3 py-2">
        <option value="created_at">Created</option>
        <option value="order_code">Order Code</option>
    </select>

    <select name="direction" class="border rounded-lg px-3 py-2">
        <option value="desc">DESC</option>
        <option value="asc">ASC</option>
    </select>

    <button class="bg-slate-900 text-white px-5 rounded-lg">
        Filter
    </button>
</form>

<div class="overflow-x-auto border rounded-lg">
    <table class="w-full">
        <thead class="bg-slate-50">
            <tr>
                <th>Order Code</th>
                <th>Customer</th>
                <th>Book</th>
                <th>Qty</th>
                <th>Total</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($orders as $order): ?>
                <tr class="border-t hover:bg-gray-50">
                    <td><?= $order['order_code'] ?></td>
                    <td><?= $order['customer_name'] ?></td>
                    <td><?= $order['book_title'] ?></td>
                    <td><?= $order['quantity'] ?></td>
                    <td><?= number_format($order['total_amount']) ?></td>
                    <td>
                        <?php
                        $statusColor = [
                            'pending' => 'bg-yellow-100 text-yellow-700',
                            'completed' => 'bg-green-100 text-green-700',
                            'cancelled' => 'bg-red-100 text-red-700'
                        ];
                        ?>
                        <span class="px-3 py-1 rounded-full <?= $statusColor[$order['status']] ?>">
                            <?= $order['status'] ?>
                        </span>
                    </td>

                    <td>
                        <div class="flex gap-2">
                            <a href="/book-orders/edit?id=<?= $order['id'] ?>"
                                class="bg-blue-600 text-white px-3 py-1 rounded">
                                Edit
                            </a>

                            <form method="POST" action="/book-orders/delete">
                                <input type="hidden" name="id" value="<?= $order['id'] ?>">
                                <button class="bg-red-600 text-white px-3 py-1 rounded"
                                    onclick="return confirm('Delete?')">
                                    Delete
                                </button>
                            </form>

                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="flex justify-between items-center mt-6">
    <div class="text-sm text-gray-600">
        Showing
        <strong><?= (($page-1)*$limit)+1 ?></strong>
        -
        <strong><?= min($page*$limit,$total) ?></strong>
        of
        <strong><?= $total ?></strong>
        customers
    </div>

    <div class="flex gap-2">
        <?php if($page>1): ?>
        <a
            href="/book-orders?<?=query_string(['page'=>$page-1])?>"
            class="px-3 py-2 border rounded hover:bg-gray-100">
            Previous
        </a>
        <?php endif; ?>
        <?php for($i=1;$i<=$totalPages;$i++): ?>
        <a
            href="/book-orders?<?=query_string(['page'=>$i])?>"
            class="px-3 py-2 border rounded
            <?= $i==$page
                ? 'bg-blue-600 text-white'
                : 'bg-white hover:bg-gray-100'
            ?>">
            <?= $i ?>
        </a>
        <?php endfor; ?>
        <?php if($page<$totalPages): ?>
        <a
            href="/book-orders?<?=query_string(['page'=>$page+1])?>"
            class="px-3 py-2 border rounded hover:bg-gray-100">
            Next
        </a>
        <?php endif; ?>
    </div>
</div>