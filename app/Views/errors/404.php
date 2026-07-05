<main class="px-10 py-8 max-w-2xl">
    <h1 class="text-2xl font-bold text-gray-800 mb-1">404 Not Found</h1>
    <p class="text-sm text-gray-500 mb-6">
      Route không tồn tại hoặc gọi sai HTTP method phải trả lỗi rõ ràng.
    </p>

    <!-- Error box -->
    <div class="bg-red-50 border border-red-200 rounded-lg px-5 py-4 mb-4">
      <p class="text-sm font-semibold text-red-600 mb-1">The page you requested was not found.</p>
      <p class="text-sm text-red-500">
        Trong production, không hiển thị SQLSTATE, path source code hoặc stack trace cho user.
      </p>
    </div>

    <!-- Developer check box -->
    <div class="bg-white border border-gray-200 rounded-lg px-5 py-4">
      <p class="text-sm font-semibold text-gray-800 mb-1">Developer check:</p>
      <p class="text-sm text-gray-600">
        public/index.php cần có fallback 404 và xử lý 405 Method Not Allowed giống Lab03.
      </p>
    </div>
  </main>

  