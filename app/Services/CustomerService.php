<?php
require_once __DIR__ . '/../Repositories/CustomerRepository.php';
require_once __DIR__ . '/../Core/Database.php';

class CustomerService
{
    private function repository(): CustomerRepository {
        $config = require __DIR__.'/../../config/database.php';
        $pdo = (new Database($config));
        return new CustomerRepository($pdo->getConnection());
    }

    public function getCustomers(
        string $keyword,
        int $page,
        int $limit,
        string $sort,
        string $direction
    ): array {

        $page = max($page, 1);

        $offset = ($page - 1) * $limit;

        return [
            'customers' => $this->repository()->getPaginated(
                $keyword,
                $limit,
                $offset,
                $sort,
                $direction
            ),

            'total' => $this->repository()->countAll($keyword)
        ];
    }

    public function find(int $id): ?array
    {
        return $this->repository()->findById($id);
    }

    public function create(array $data): void
    {
        $data = $this->validate($data);

        $this->repository()->create($data);
    }

    public function update(int $id, array $data): void
    {
        $data = $this->validate($data);

        $this->repository()->update($id, $data);
    }

    public function delete(int $id): void
    {
        $this->repository()->delete($id);
    }

    private function validate(array $data): array
    {
        $name = trim($data['name'] ?? '');
        $email = trim($data['email'] ?? '');
        $phone = trim($data['phone'] ?? '');
        $address = trim($data['address'] ?? '');

        $errors = [];

        if ($name === '') {
            $errors['name'] = 'Name is required.';
        }

        if ($email === '') {
            $errors['email'] = 'Email is required.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Invalid email.';
        }

        if (!empty($errors)) {
            throw new \InvalidArgumentException(json_encode($errors));
        }

        return [
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'address' => $address
        ];
    }
}

