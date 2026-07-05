<header class="bg-slate-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-14">
            <a href="/" class="text-lg font-bold tracking-tight">
                Bookstore Order CRM
            </a>
            <nav class="hidden md:flex items-center space-x-1 text-sm">
                <a href="/dashboard"
                    class="px-3 py-2 rounded-md hover:bg-white/10 text-gray-300 hover:text-white">
                    Dashboard
                </a>
                <a href="/customers"
                    class="px-3 py-2 rounded-md hover:bg-white/10 text-gray-300 hover:text-white">
                    Customers
                </a>
                <a href="/customers/create"
                    class="px-3 py-2 rounded-md hover:bg-white/10 text-gray-300 hover:text-white">
                    Create Customer
                </a>
                <a href="/book-orders"
                    class="px-3 py-2 rounded-md hover:bg-white/10 text-gray-300 hover:text-white">
                    Orders
                </a>
                <a href="/book-orders/create"
                    class="px-3 py-2 rounded-md hover:bg-white/10 text-gray-300 hover:text-white">
                    Create Order
                </a>
                <?php if (is_logged_in()): ?>
                    <form action="/logout" method="POST" class="inline">
                        <button
                            class="px-3 py-2 rounded-md hover:bg-red-600 text-gray-300 hover:text-white">
                            Logout

                        </button>
                    </form>
                <?php else: ?>
                    <a href="/login"
                        class="px-3 py-2 rounded-md hover:bg-white/10 text-gray-300 hover:text-white">
                        Login
                    </a>
                <?php endif; ?>
            </nav>
        </div>
    </div>
</header>

