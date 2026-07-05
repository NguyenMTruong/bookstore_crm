<main class="px-10 py-8 max-w-2xl">
    <h1 class="text-2xl font-bold text-gray-800 mb-1">500 Internal Server Error</h1>
    <p class="text-sm text-gray-500 mb-6">
      Lỗi phía server — không bao giờ để lộ chi tiết kỹ thuật ra ngoài môi trường production.
    </p>

    <!-- Error box -->
    <div class="bg-red-50 border border-red-200 rounded-lg px-5 py-4 mb-4">
      <p class="text-sm font-semibold text-red-600 mb-1">Something went wrong on our end.</p>
      <p class="text-sm text-red-500">
        Trong production, không hiển thị SQLSTATE, stack trace, tên bảng hoặc query thô cho user. Ghi log nội bộ để debug.
      </p>
    </div>

    <!-- Developer check box -->
    <div class="bg-white border border-gray-200 rounded-lg px-5 py-4">
      <p class="text-sm font-semibold text-gray-800 mb-1">Developer check:</p>
      <p class="text-sm text-gray-600">
        Bật <code class="bg-gray-100 px-1 rounded">display_errors = Off</code> trong <code class="bg-gray-100 px-1 rounded">php.ini</code> khi deploy. Dùng <code class="bg-gray-100 px-1 rounded">error_log()</code> hoặc logging library ghi lỗi ra file, không echo ra response.
      </p>
    </div>
  </main>

  