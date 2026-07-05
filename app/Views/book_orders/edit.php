<section class="max-w-5xl mx-auto">
    <h1 class="text-2xl font-bold text-gray-800 mb-1">
        Edit Book Order
    </h1>

    <p class="text-sm text-gray-500 mb-6">
        Chỉnh sửa thông tin đơn hàng.
    </p>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 max-w-2xl overflow-hidden">
        <div class="px-5 py-4 border-b border-gray-200">
            <h2 class="text-sm font-bold text-gray-800">
                Order #<?= e($order['order_code']) ?>
            </h2>
        </div>

        <form action="/book-orders/update" method="POST">
            <input
                type="hidden"
                name="id"
                value="<?= e((string)$order['id']) ?>">
            
            <!-- Customer -->
            <div class="flex items-center border-b border-gray-200 px-5 py-3">
                <label class="w-36 text-sm font-semibold text-gray-700">
                    Customer
                </label>
                <select
                    name="customer_id"
                    class="flex-1 border border-gray-300 rounded px-3 py-2">
                    <?php foreach ($customers as $customer): ?>
                        <option
                            value="<?= $customer['id'] ?>"
                            <?= (($old['customer_id'] ?? $order['customer_id']) == $customer['id']) ? 'selected' : '' ?>>
                            <?= e($customer['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <!-- Order Code -->
            <div class="flex items-center border-b border-gray-200 px-5 py-3">
                <label class="w-36 text-sm font-semibold text-gray-700">
                    Order Code
                </label>
                <input
                    type="text"
                    name="order_code"
                    value="<?= e($old['order_code'] ?? $order['order_code']) ?>"
                    class="flex-1 border border-gray-300 rounded px-3 py-2">
            </div>
            
            <!-- Book Title -->
            <div class="flex items-center border-b border-gray-200 px-5 py-3">
                <label class="w-36 text-sm font-semibold text-gray-700">
                    Book Title
                </label>
                <input
                    type="text"
                    name="book_title"
                    value="<?= e($old['book_title'] ?? $order['book_title']) ?>"
                    class="flex-1 border border-gray-300 rounded px-3 py-2">
            </div>
            
            <!-- Quantity -->
            <div class="flex items-center border-b border-gray-200 px-5 py-3">
                <label class="w-36 text-sm font-semibold text-gray-700">
                    Quantity
                </label>
                <input
                    type="number"
                    name="quantity"
                    value="<?= e((string)($old['quantity'] ?? $order['quantity'])) ?>"
                    class="flex-1 border border-gray-300 rounded px-3 py-2">
            </div>
            
            <!-- Unit Price -->
            <div class="flex items-center border-b border-gray-200 px-5 py-3">
                <label class="w-36 text-sm font-semibold text-gray-700">
                    Unit Price
                </label>
                <input
                    type="number"
                    step="0.01"
                    name="unit_price"
                    value="<?= e((string)($old['unit_price'] ?? $order['unit_price'])) ?>"
                    class="flex-1 border border-gray-300 rounded px-3 py-2">
            </div>
            
            <!-- Status -->
            <div class="flex items-center border-b border-gray-200 px-5 py-3">
                <label class="w-36 text-sm font-semibold text-gray-700">
                    Status
                </label>
                <select
                    name="status"
                    class="flex-1 border border-gray-300 rounded px-3 py-2">
                    <?php
                    $statuses = ['pending', 'processing', 'completed', 'cancelled'];
                    foreach ($statuses as $status):
                    ?>
                        <option
                            value="<?= $status ?>"
                            <?= (($old['status'] ?? $order['status']) == $status) ? 'selected' : '' ?>>
                            <?= ucfirst($status) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="px-5 py-4 flex gap-3">
                <button
                    type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded">
                    Update
                </button>
        </form>

        <form
            action="/book-orders/delete"
            method="POST"
            onsubmit="return confirm('Delete this order?')">
            <input
                type="hidden"
                name="id"
                value="<?= e((string)$order['id']) ?>">
            <button
                class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded">
                Delete
            </button>
        </form>
    </div>
</section>