<section class="mb-8">
    <h1 class="text-3xl font-bold text-gray-900">
        Dashboard
    </h1>
    <p class="mt-2 text-sm text-gray-500">
        Tổng quan Bookstore Order CRM sau khi đăng nhập.
    </p>
</section>
<section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Customers -->
    <article class="bg-white rounded-xl border border-gray-200 shadow-sm p-5 flex justify-between items-center">
        <div>
            <h3 class="text-sm font-semibold text-gray-600">
                Customers
            </h3>
            <p class="text-3xl font-bold text-blue-600">
                <?= e((string)$customers) ?>
            </p>
        </div>
        <div class="w-10 h-10 rounded-full bg-blue-100"></div>
    </article>
    <!-- Orders -->
    <article class="bg-white rounded-xl border border-gray-200 shadow-sm p-5 flex justify-between items-center">
        <div>
            <h3 class="text-sm font-semibold text-gray-600">
                Orders
            </h3>
            <p class="text-3xl font-bold text-green-600">
                <?= e((string)$totalOrders) ?>
            </p>
        </div>
        <div class="w-10 h-10 rounded-full bg-green-100"></div>
    </article>
    <!-- Users -->
    <article class="bg-white rounded-xl border border-gray-200 shadow-sm p-5 flex justify-between items-center">
        <div>
            <h3 class="text-sm font-semibold text-gray-600">
                Users
            </h3>
            <p class="text-3xl font-bold text-purple-600">
                <?= e((string)$totalUsers) ?>
            </p>
        </div>
        <div class="w-10 h-10 rounded-full bg-purple-100"></div>
    </article>
    <!-- Revenue -->
    <article class="bg-white rounded-xl border border-gray-200 shadow-sm p-5 flex justify-between items-center">
        <div>
            <h3 class="text-sm font-semibold text-gray-600">
                Revenue
            </h3>
            <p class="text-3xl font-bold text-orange-600">
                <?= e(number_format($totalRevenue, 0, ',', '.')) ?> đ
            </p>
        </div>
        <div class="w-10 h-10 rounded-full bg-orange-100"></div>
    </article>
</section>
<section class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Recent Customers -->
    <article class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">
        <h2 class="text-lg font-semibold mb-4">
            Recent Customers
        </h2>
        <?php if (empty($recentCustomers)): ?>
            <p class="text-gray-500">
                No customer found.
            </p>
        <?php else: ?>
            <div class="space-y-4">
                <?php foreach ($recentCustomers as $customer): ?>
                    <div class="flex justify-between border-b pb-3">
                        <div>
                            <p class="font-medium">
                                <?= e($customer['name']) ?>
                            </p>
                            <p class="text-sm text-gray-500">
                                <?= e($customer['email']) ?>
                            </p>
                        </div>
                        <span class="text-xs text-gray-500">
                            <?= date('d/m/Y', strtotime($customer['created_at'])) ?>
                        </span>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </article>
    <!-- System Health -->
    <article class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">
        <h2 class="text-lg font-semibold mb-4">
            System Health
        </h2>
        <ul class="space-y-3 text-sm">
            <li>✅ Session active</li>
            <li>✅ PDO connected</li>
            <li>✅ Prepared Statements</li>
            <li>✅ PRG Pattern</li>
            <li>✅ MVC Architecture</li>
            <li>✅ Flash Messages</li>
        </ul>
    </article>
</section>

