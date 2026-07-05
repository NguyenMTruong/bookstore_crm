<main class="px-10 py-8 max-w-2xl">
    <h1 class="text-2xl font-bold text-gray-800 mb-1">405 Method Not Allowed</h1>
    <p class="text-sm text-gray-500 mb-6">
      HTTP method không được phép trên route này (ví dụ: dùng GET thay vì POST).
    </p>

    <!-- Error box -->
    <div class="bg-red-50 border border-red-200 rounded-lg px-5 py-4 mb-4">
      <p class="text-sm font-semibold text-red-600 mb-1">Method Not Allowed.</p>
      <p class="text-sm text-red-500">
        Request method không hợp lệ cho endpoint này. Trong production, không lộ danh sách method cho phép trừ khi cần thiết.
      </p>
    </div>

    <!-- Developer check box -->
    <div class="bg-white border border-gray-200 rounded-lg px-5 py-4">
      <p class="text-sm font-semibold text-gray-800 mb-1">Developer check:</p>
      <p class="text-sm text-gray-600">
        Kiểm tra router có xử lý riêng GET và POST không. Trả header <code class="bg-gray-100 px-1 rounded">Allow: POST</code> kèm theo HTTP 405 đúng chuẩn RFC 7231.
      </p>
    </div>
  </main>
  