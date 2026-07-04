<?php
require_once __DIR__ . '/../Repositories/BookOrderRepository.php';
require_once __DIR__ . '/../Core/Database.php';

class BookOrderService
{
    private function repository(): BookOrderRepository {
        $config = require __DIR__.'/../../config/database.php';
        $pdo = (new Database($config));
        return new BookOrderRepository($pdo->getConnection());
    }

    public function getOrders(
        string $keyword,
        int $page,
        int $limit,
        string $sort,
        string $direction
    ): array {

        $page = max(1, $page);

        $offset = ($page - 1) * $limit;

        return [

            'orders' => $this->repository()->getPaginated(
                $keyword,
                $limit,
                $offset,
                $sort,
                $direction
            ),

            'total' => $this->repository()->countAll($keyword)

        ];
    }

    public function getCustomers(): array
    {
        return $this->repository()->getCustomers();
    }

    public function find(int $id): ?array
    {
        return $this->repository()->findById($id);
    }

    public function create(array $data): void
    {
        $data = $this->validate($data);

        $data['order_code'] = $this->generateOrderCode();

        $data['total_amount'] =
            $data['quantity'] * $data['unit_price'];

        $this->repository()->create($data);
    }

    public function update(int $id, array $data): void
    {
        $data = $this->validate($data);

        $data['total_amount'] =
            $data['quantity'] * $data['unit_price'];

        $this->repository()->update($id, $data);
    }

    public function delete(int $id): void
    {
        $this->repository()->delete($id);
    }

    private function validate(array $data): array
    {
        $customerId = (int)($data['customer_id'] ?? 0);

        $bookTitle = trim($data['book_title'] ?? '');

        $quantity = (int)($data['quantity'] ?? 0);

        $unitPrice = (float)($data['unit_price'] ?? 0);

        $status = trim($data['status'] ?? '');

        $errors = [];

        if ($customerId <= 0) {
            $errors['customer_id'] = 'Please select customer.';
        }

        if ($bookTitle === '') {
            $errors['book_title'] = 'Book title is required.';
        }

        if ($quantity <= 0) {
            $errors['quantity'] = 'Quantity must be greater than zero.';
        }

        if ($unitPrice <= 0) {
            $errors['unit_price'] = 'Unit price must be greater than zero.';
        }

        $allowedStatus = [
            'pending',
            'completed',
            'cancelled'
        ];

        if (!in_array($status, $allowedStatus, true)) {
            $errors['status'] = 'Invalid status.';
        }

        if (!empty($errors)) {
            throw new InvalidArgumentException(
                json_encode($errors)
            );
        }

        return [

            'customer_id' => $customerId,

            'book_title' => $bookTitle,

            'quantity' => $quantity,

            'unit_price' => $unitPrice,

            'status' => $status

        ];
    }

    /**
     * Sinh mã ORD000001
     */
    private function generateOrderCode(): string
    {
        $last = $this->repository()->getLastOrderCode();

        if (!$last) {
            return "ORD000001";
        }

        $number = (int) substr($last, 3);

        $number++;

        return sprintf(
            "ORD%06d",
            $number
        );
    }
}

