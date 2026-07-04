<?php
class DashboardController
{
    private function getDB(): mixed{
        $config = require __DIR__.'/../../config/database.php';
        $pdo = (new Database($config));
        return $pdo ->getConnection();
    }

    public function index(): void
    {
        require_login();
        
        $pdo = $this->getDB();

        $customers = (int) $pdo->query(
            "SELECT COUNT(*) FROM customers"
        )->fetchColumn();

        $orders = (int) $pdo->query(
            "SELECT COUNT(*) FROM book_orders"
        )->fetchColumn();

        $stmt = $pdo->prepare(
            "SELECT COUNT(*) FROM book_orders WHERE status = :status"
        );
        $stmt->execute([':status' => 'pending']);
        $pending = (int) $stmt->fetchColumn();

        $stmt->execute([':status' => 'completed']);
        $completed = (int) $stmt->fetchColumn();

        view('dashboard/index', [
            'title' => 'Dashboard',
            'view' => 'dashboard/index',
            'statistics' => [
                'customers' => $customers,
                'orders' => $orders,
                'pending' => $pending,
                'completed' => $completed,
            ]
        ]);
    }
}

