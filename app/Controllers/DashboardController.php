<?php
class DashboardController
{
    private function getDB(): PDO
    {
        $config = require __DIR__ . '/../../config/database.php';

        return (new Database($config))->getConnection();
    }

    public function index(): void
    {
        require_login();

        $pdo = $this->getDB();

        // Tổng số khách hàng
        $customers = (int) $pdo
            ->query("SELECT COUNT(*) FROM customers")
            ->fetchColumn();

        // Tổng số đơn hàng
        $totalOrders = (int) $pdo
            ->query("SELECT COUNT(*) FROM book_orders")
            ->fetchColumn();

        // Tổng số user
        $totalUsers = (int) $pdo
            ->query("SELECT COUNT(*) FROM users")
            ->fetchColumn();

        // Tổng doanh thu
        $totalRevenue = (float) $pdo
            ->query("
                SELECT COALESCE(SUM(total_amount),0)
                FROM book_orders
            ")
            ->fetchColumn();

        // 5 khách hàng mới nhất
        $stmt = $pdo->prepare("
            SELECT
                name,
                email,
                created_at
            FROM customers
            ORDER BY created_at DESC
            LIMIT 5
        ");

        $stmt->execute();

        $recentCustomers = $stmt->fetchAll();

        view('dashboard/index', [
            'title' => 'Dashboard',
            'view' => 'dashboard/index',

            'customers' => $customers,
            'totalOrders' => $totalOrders,
            'totalUsers' => $totalUsers,
            'totalRevenue' => $totalRevenue,
            'recentCustomers' => $recentCustomers
        ]);
    }
}

