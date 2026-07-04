<?php
require_once __DIR__.'/../Services/BookOrderService.php';

class BookOrderController
{
    private BookOrderService $service;

    public function __construct()
    {
        $this->service = new BookOrderService();
    }

    /**
     * Danh sách đơn hàng
     */
    public function index(): void
    {
        require_login();

        $keyword = trim($_GET['q'] ?? '');
        $page = (int)($_GET['page'] ?? 1);
        $sort = $_GET['sort'] ?? 'created_at';
        $direction = $_GET['direction'] ?? 'asc';

        $result = $this->service->getOrders(
            $keyword,
            $page,
            10,
            $sort,
            $direction
        );

        view('book_orders/index', [
            'title' => 'Book Orders',
            'view' => 'book_orders/index',
            'orders' => $result['orders'],
            'total' => $result['total'],
            'page' => $page,
            'keyword' => $keyword,
            'sort' => $sort,
            'direction' => $direction,
            'success' => get_flash('success')
        ]);
    }

    /**
     * Form tạo đơn
     */
    public function create(): void
    {
        require_login();

        view('book_orders/create', [
            'title' => 'Create Order',
            'view' => 'book_orders/create',
            'customers' => $this->service->getCustomers(),
            'errors' => get_flash('errors', []),
            'old' => get_flash('old', [])
        ]);
    }

    /**
     * Lưu đơn hàng
     */
    public function store(): void
    {
        require_login();

        try {
            $this->service->create($_POST);
            flash(
                'success',
                'Order created successfully.'
            );
            redirect('/orders');
        } catch (DuplicateRecordException $e) {
            flash('errors', [
                'order_code' => $e->getMessage()
            ]);
        } catch (InvalidArgumentException $e) {
            flash(
                'errors',
                json_decode($e->getMessage(), true)
            );

        }
        flash('old', $_POST);
        redirect('/orders/create');
    }

    /**
     * Form sửa
     */
    public function edit(): void
    {
        require_login();

        $id = (int)($_GET['id'] ?? 0);

        $order = $this->service->find($id);

        if (!$order) {

            http_response_code(404);

            view('errors/404', [
                'title' => '404',
                'view' => 'errors/404'
            ]);

            return;
        }

        view('book_orders/edit', [
            'title' => 'Edit Order',
            'view' => 'book_orders/edit',
            'order' => $order,
            'customers' => $this->service->getCustomers(),
            'errors' => get_flash('errors', [])
        ]);
    }

    /**
     * Cập nhật đơn
     */
    public function update(): void
    {
        require_login();

        $id = (int)($_POST['id'] ?? 0);

        try {
            $this->service->update($id, $_POST);
            flash(
                'success',
                'Order updated successfully.'
            );
            redirect('/orders');
        } catch (InvalidArgumentException $e) {
            flash(
                'errors',
                json_decode($e->getMessage(), true)
            );
        }
        flash('old', $_POST);
        redirect("/orders/edit?id={$id}");
    }

    /**
     * Xóa đơn
     */
    public function delete(): void
    {
        require_login();

        $id = (int)($_POST['id'] ?? 0);

        $this->service->delete($id);
        flash(
            'success',
            'Order deleted successfully.'
        );
        redirect('/orders');
    }
}

