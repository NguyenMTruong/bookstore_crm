<section class="max-w-5xl mx-auto">
    <h1 class="text-2xl font-bold text-gray-800 mb-1">
        Edit Customer
    </h1>

    <p class="text-sm text-gray-500 mb-6">
        Chỉnh sửa thông tin khách hàng.
    </p>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 max-w-2xl overflow-hidden">
        <div class="px-5 py-4 border-b border-gray-200">
            <h2 class="text-sm font-bold text-gray-800">
                Customer #<?= e((string)$customer['id']) ?>
            </h2>
        </div>

        <form action="/customers/update" method="POST">
            <input
                type="hidden"
                name="id"
                value="<?= e((string)$customer['id']) ?>"
            >
            
            <!-- Name -->
            <div class="flex items-center border-b border-gray-200 px-5 py-3">
                <label class="w-32 text-sm font-semibold text-gray-700">
                    Name
                </label>
                <input
                    type="text"
                    name="name"
                    value="<?= e($old['name'] ?? $customer['name']) ?>"
                    class="flex-1 border border-gray-300 rounded px-3 py-2
                           focus:ring-2 focus:ring-blue-500 outline-none"
                >
            </div>
            
            <!-- Email -->
            <div class="flex items-center border-b border-gray-200 px-5 py-3">
                <label class="w-32 text-sm font-semibold text-gray-700">
                    Email
                </label>
                <input
                    type="email"
                    name="email"
                    value="<?= e($old['email'] ?? $customer['email']) ?>"
                    class="flex-1 border border-gray-300 rounded px-3 py-2
                           focus:ring-2 focus:ring-blue-500 outline-none"
                >
            </div>
            
            <!-- Phone -->
            <div class="flex items-center border-b border-gray-200 px-5 py-3">
                <label class="w-32 text-sm font-semibold text-gray-700">
                    Phone
                </label>
                <input
                    type="text"
                    name="phone"
                    value="<?= e($old['phone'] ?? $customer['phone']) ?>"
                    class="flex-1 border border-gray-300 rounded px-3 py-2
                           focus:ring-2 focus:ring-blue-500 outline-none"
                >
            </div>
            
            <!-- Address -->
            <div class="flex items-center border-b border-gray-200 px-5 py-3">
                <label class="w-32 text-sm font-semibold text-gray-700">
                    Address
                </label>
                <input
                    type="text"
                    name="address"
                    value="<?= e($old['address'] ?? $customer['address']) ?>"
                    class="flex-1 border border-gray-300 rounded px-3 py-2
                           focus:ring-2 focus:ring-blue-500 outline-none"
                >
            </div>
            
            <!-- Actions -->
            <div class="px-5 py-4 flex gap-3">
                <button
                    type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded"
                >
                    Update
                </button>
        </form>
        
        <form
            action="/customers/delete"
            method="POST"
            onsubmit="return confirm('Delete this customer?')"
        >
            <input
                type="hidden"
                name="id"
                value="<?= e((string)$customer['id']) ?>"
            >
            <button
                class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded"
            >
                Delete
            </button>
        </form>
            </div>
    </div>
</section>