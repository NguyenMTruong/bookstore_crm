<section class="max-w-7xl mx-auto">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">
            Create Customer
        </h1>
        <p class="mt-2 text-gray-500">
            Add a new customer to Bookstore Order CRM.
        </p>
    </div>

    <div class="flex flex-col lg:flex-row gap-6">
        <!-- Form -->
        <div class="flex-1 bg-white rounded-xl shadow border border-gray-200 overflow-hidden">
            <form action="/customers" method="POST">
                <!-- Honeypot -->
                <input
                    type="text"
                    name="website"
                    class="hidden"
                    autocomplete="off"
                >

                <!-- Name -->
                <div class="flex items-center border-b px-6 py-4">
                    <label class="w-32 font-medium">
                        Name
                    </label>
                    <div class="flex-1">
                        <input
                            type="text"
                            name="name"
                            value="<?= e($old['name'] ?? '') ?>"
                            class="w-full border rounded-lg px-3 py-2
                            <?= isset($errors['name']) ? 'border-red-500' : 'border-gray-300' ?>"
                        >
                        <?php if(isset($errors['name'])): ?>
                            <p class="text-sm text-red-500 mt-1">
                                <?= e($errors['name']) ?>
                            </p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Email -->
                <div class="flex items-center border-b px-6 py-4">
                    <label class="w-32 font-medium">
                        Email
                    </label>
                    <div class="flex-1">
                        <input
                            type="email"
                            name="email"
                            value="<?= e($old['email'] ?? '') ?>"
                            class="w-full border rounded-lg px-3 py-2
                            <?= isset($errors['email']) ? 'border-red-500' : 'border-gray-300' ?>"
                        >
                        <?php if(isset($errors['email'])): ?>
                            <p class="text-sm text-red-500 mt-1">
                                <?= e($errors['email']) ?>
                            </p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Phone -->
                <div class="flex items-center border-b px-6 py-4">
                    <label class="w-32 font-medium">
                        Phone
                    </label>
                    <input
                        type="text"
                        name="phone"
                        value="<?= e($old['phone'] ?? '') ?>"
                        class="flex-1 border rounded-lg border-gray-300 px-3 py-2"
                    >
                </div>

                <!-- Address -->
                <div class="flex items-center border-b px-6 py-4">
                    <label class="w-32 font-medium">
                        Address
                    </label>
                    <input
                        type="text"
                        name="address"
                        value="<?= e($old['address'] ?? '') ?>"
                        class="flex-1 border rounded-lg border-gray-300 px-3 py-2"
                    >
                </div>

                <!-- Submit -->
                <div class="px-6 py-5 flex gap-3">
                    <button
                        type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">
                        Save Customer
                    </button>
                    <a
                        href="/customers"
                        class="bg-gray-200 hover:bg-gray-300 px-6 py-2 rounded-lg">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
        
        <!-- Secure Flow -->
        <div class="w-full lg:w-72 bg-white rounded-xl shadow border border-gray-200 p-5">
            <h2 class="font-semibold mb-4">
                Secure Flow
            </h2>
            <div class="space-y-3">
                <div class="bg-blue-600 text-white rounded px-3 py-2 text-sm">
                    1. Read POST safely
                </div>
                <div class="bg-blue-600 text-white rounded px-3 py-2 text-sm">
                    2. Trim input
                </div>
                <div class="bg-blue-600 text-white rounded px-3 py-2 text-sm">
                    3. Server validation
                </div>
                <div class="bg-blue-600 text-white rounded px-3 py-2 text-sm">
                    4. Honeypot + Rate limit
                </div>
                <div class="bg-blue-600 text-white rounded px-3 py-2 text-sm">
                    5. PDO Prepared Statement
                </div>
                <div class="bg-blue-600 text-white rounded px-3 py-2 text-sm">
                    6. Duplicate Email Handling
                </div>
                <div class="bg-blue-600 text-white rounded px-3 py-2 text-sm">
                    7. PRG Redirect
                </div>
            </div>
        </div>
    </div>
</section>

