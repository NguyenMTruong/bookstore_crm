<section class="max-w-5xl mx-auto">
    <h1 class="text-3xl font-bold text-gray-900 mb-2">
        Login
    </h1>
    <p class="text-gray-500 mb-8">
        Đăng nhập để truy cập hệ thống Bookstore Order CRM.
    </p>
    <?php if (!empty($success)): ?>
        <div class="mb-5 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-green-700">
            <?= $success ?>
        </div>
    <?php endif; ?>
    <?php if (!empty($error)): ?>
        <div class="mb-5 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-red-700">
            <?= $error ?>
        </div>
    <?php endif; ?>
    <div class="max-w-md mx-auto bg-white rounded-xl shadow border border-gray-200 p-8">
        <form action="/login" method="POST">
            <div class="mb-5">
                <label class="block mb-2 text-sm font-medium text-gray-700">
                    Email
                </label>
                <input
                    type="email"
                    name="email"
                    value="<?= e($old['email'] ?? '') ?>"
                    class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none"
                    required
                >
            </div>
            <div class="mb-5">
                <label class="block mb-2 text-sm font-medium text-gray-700">
                    Password
                </label>
                <input
                    type="password"
                    name="password"
                    class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none"
                    required
                >
            </div>
            <div class="mb-6 flex items-center">
                <input
                    id="remember"
                    type="checkbox"
                    name="remember"
                    class="h-4 w-4 rounded border-gray-300"
                >
                <label
                    for="remember"
                    class="ml-2 text-sm text-gray-700">
                    Remember me
                </label>
            </div>
            <button
                type="submit"
                class="w-full rounded-lg bg-blue-600 py-2.5 text-white hover:bg-blue-700 transition">
                Login
            </button>
        </form>
        <div class="mt-6 rounded-lg border border-blue-200 bg-blue-50 p-4">
            <p class="font-semibold text-blue-700">
                Demo Account
            </p>
            <p class="mt-2 text-sm">
                Email:
                <strong>admin@example.com</strong>
            </p>
            <p class="text-sm">
                Password:
                <strong>123456</strong>
            </p>
        </div>
    </div>
</section>

