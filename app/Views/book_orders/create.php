<section class="max-w-7xl mx-auto">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">
            Create Book Order
        </h1>
        <p class="mt-2 text-gray-500">
            Create a new order for an existing customer.
        </p>
    </div>

    <div class="flex flex-col lg:flex-row gap-6">
        <!-- FORM -->
        <div class="flex-1 bg-white rounded-xl shadow border border-gray-200 overflow-hidden">
            <form action="/book-orders" method="POST">
                <!-- Honeypot -->
                <input
                    type="text"
                    name="website"
                    class="hidden"
                    autocomplete="off"
                >

                <!-- Order Code -->
                <div class="flex items-center border-b px-6 py-4">
                    <label class="w-40 font-medium">
                        Order Code
                    </label>
                    <div class="flex-1">
                        <input
                            type="text"
                            name="order_code"
                            value="<?= e($old['order_code'] ?? '') ?>"
                            class="w-full rounded-lg border px-3 py-2
                            <?= isset($errors['order_code']) ? 'border-red-500' : 'border-gray-300' ?>"
                        >
                        <?php if(isset($errors['order_code'])): ?>
                            <p class="mt-1 text-sm text-red-500">
                                <?= e($errors['order_code']) ?>
                            </p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Customer -->
                <div class="flex items-center border-b px-6 py-4">
                    <label class="w-40 font-medium">
                        Customer
                    </label>
                    <div class="flex-1">
                        <select
                            name="customer_id"
                            class="w-full rounded-lg border border-gray-300 px-3 py-2">
                            <option value="">
                                -- Select Customer --
                            </option>
                            <?php foreach($customers as $customer): ?>
                                <option
                                    value="<?= $customer['id'] ?>"
                                    <?= (($old['customer_id'] ?? '') == $customer['id']) ? 'selected' : '' ?>
                                >
                                    <?= e($customer['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?php if(isset($errors['customer_id'])): ?>
                            <p class="mt-1 text-sm text-red-500">
                                <?= e($errors['customer_id']) ?>
                            </p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Book -->
                <div class="flex items-center border-b px-6 py-4">
                    <label class="w-40 font-medium">
                        Book Title
                    </label>
                    <div class="flex-1">
                        <input
                            type="text"
                            name="book_title"
                            value="<?= e($old['book_title'] ?? '') ?>"
                            class="w-full rounded-lg border border-gray-300 px-3 py-2"
                        >
                        <?php if(isset($errors['book_title'])): ?>
                            <p class="mt-1 text-sm text-red-500">
                                <?= e($errors['book_title']) ?>
                            </p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Quantity -->
                <div class="flex items-center border-b px-6 py-4">
                    <label class="w-40 font-medium">
                        Quantity
                    </label>
                    <div class="flex-1">
                        <input
                            type="number"
                            min="1"
                            name="quantity"
                            value="<?= e($old['quantity'] ?? '') ?>"
                            class="w-full rounded-lg border border-gray-300 px-3 py-2"
                        >
                    </div>
                </div>

                <!-- Unit Price -->
                <div class="flex items-center border-b px-6 py-4">
                    <label class="w-40 font-medium">
                        Unit Price
                    </label>
                    <div class="flex-1">
                        <input
                            type="number"
                            step="0.01"
                            min="0"
                            name="unit_price"
                            value="<?= e($old['unit_price'] ?? '') ?>"
                            class="w-full rounded-lg border border-gray-300 px-3 py-2"
                        >
                    </div>
                </div>

                <!-- Status -->
                <div class="flex items-center border-b px-6 py-4">
                    <label class="w-40 font-medium">
                        Status
                    </label>
                    <div class="flex-1">
                        <select
                            name="status"
                            class="w-full rounded-lg border border-gray-300 px-3 py-2">
                            <?php
                            $statuses = [
                                'pending',
                                'processing',
                                'completed',
                                'cancelled'
                            ];
                            foreach($statuses as $status):
                            ?>
                                <option
                                    value="<?= $status ?>"
                                    <?= (($old['status'] ?? '') == $status) ? 'selected' : '' ?>
                                >
                                    <?= ucfirst($status) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <!-- Submit -->
                <div class="px-6 py-5 flex gap-3">
                    <button
                        type="submit"
                        class="rounded-lg bg-blue-600 px-6 py-2 text-white hover:bg-blue-700">
                        Save Order
                    </button>
                    <a
                        href="/book-orders"
                        class="rounded-lg bg-gray-200 px-6 py-2 hover:bg-gray-300">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
        
        <!-- RIGHT PANEL -->
        <div class="w-full lg:w-72 rounded-xl border border-gray-200 bg-white p-5 shadow">
            <h2 class="mb-4 font-semibold">
                Secure Flow
            </h2>
            <div class="space-y-3">
                <div class="rounded bg-blue-600 px-3 py-2 text-sm text-white">
                    1. Read POST safely
                </div>
                <div class="rounded bg-blue-600 px-3 py-2 text-sm text-white">
                    2. Trim Input
                </div>
                <div class="rounded bg-blue-600 px-3 py-2 text-sm text-white">
                    3. Server Validation
                </div>
                <div class="rounded bg-blue-600 px-3 py-2 text-sm text-white">
                    4. Honeypot + Rate Limit
                </div>
                <div class="rounded bg-blue-600 px-3 py-2 text-sm text-white">
                    5. Prepared Statement
                </div>
                <div class="rounded bg-blue-600 px-3 py-2 text-sm text-white">
                    6. Unique Order Code
                </div>
                <div class="rounded bg-blue-600 px-3 py-2 text-sm text-white">
                    7. PRG Redirect
                </div>
            </div>
        </div>
    </div>
</section>