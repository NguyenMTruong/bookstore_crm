<?php
class CustomerRepository
{
    public function __construct(private PDO $db)
    {
    }

    public function countAll(string $keyword = ''): int
    {
        $sql = "SELECT COUNT(*) AS total FROM customers";
        $params = [];

        if ($keyword !== '') {
            $sql .= " WHERE name LIKE :name
                      OR email LIKE :email
                      OR phone LIKE :phone";
            $search = '%' . $keyword . '%';
            $params = [
                'name' => $search,
                'email' => $search,
                'phone' => $search
            ];
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);

        return (int) ($stmt->fetch()['total'] ?? 0);
    }

    public function getPaginated(
        string $keyword,
        int $limit,
        int $offset,
        string $sort,
        string $direction
    ): array {

        $allowedSorts = [
            'id',
            'name',
            'email',
            'phone',
            'created_at'
        ];

        $allowedDirections = [
            'asc',
            'desc'
        ];

        if (!in_array($sort, $allowedSorts, true)) {
            $sort = 'created_at';
        }

        if (!in_array(strtolower($direction), $allowedDirections, true)) {
            $direction = 'desc';
        }

        $sql = "
            SELECT
                id,
                name,
                email,
                phone,
                address,
                created_at
            FROM customers
        ";

        $params = [];

        if ($keyword !== '') {
            $sql .= " WHERE name LIKE :name
                      OR email LIKE :email
                      OR phone LIKE :phone";
            $search = '%' . $keyword . '%';
            $params = [
                'name' => $search,
                'email' => $search,
                'phone' => $search
            ];
        }

        $sql .= " ORDER BY {$sort} {$direction}
                  LIMIT :limit
                  OFFSET :offset";

        $stmt = $this->db->prepare($sql);

        foreach ($params as $key => $value) {
            $stmt->bindValue(
                ':' . $key,
                $value,
                PDO::PARAM_STR
            );
        }

        $stmt->bindValue(
            ':limit',
            $limit,
            PDO::PARAM_INT
        );

        $stmt->bindValue(
            ':offset',
            $offset,
            PDO::PARAM_INT
        );

        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function findById(int $id): ?array
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM customers WHERE id = :id"
        );

        $stmt->execute([
            'id' => $id
        ]);

        return $stmt->fetch() ?: null;
    }

    public function create(array $data): bool
    {
        $sql = "
            INSERT INTO customers
            (
                name,
                email,
                phone,
                address
            )
            VALUES
            (
                :name,
                :email,
                :phone,
                :address
            )
        ";

        try {

            $stmt = $this->db->prepare($sql);

            return $stmt->execute([

                'name' => $data['name'],

                'email' => $data['email'],

                'phone' => $data['phone'] ?: null,

                'address' => $data['address'] ?: null

            ]);

        } catch (PDOException $e) {

            if (($e->errorInfo[1] ?? null) === 1062) {
                throw new DuplicateRecordException(
                    'Email khách hàng đã tồn tại.'
                );
            }

            throw $e;
        }
    }

    public function update(int $id, array $data): bool
    {
        $sql = "
            UPDATE customers

            SET

                name = :name,

                email = :email,

                phone = :phone,

                address = :address,

                updated_at = NOW()

            WHERE id = :id
        ";

        try {

            $stmt = $this->db->prepare($sql);

            return $stmt->execute([

                'id' => $id,

                'name' => $data['name'],

                'email' => $data['email'],

                'phone' => $data['phone'] ?: null,

                'address' => $data['address'] ?: null

            ]);

        } catch (PDOException $e) {

            if (($e->errorInfo[1] ?? null) === 1062) {

                throw new DuplicateRecordException(
                    'Email khách hàng đã tồn tại.'
                );
            }

            throw $e;
        }
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare(
            "DELETE FROM customers WHERE id = :id"
        );

        return $stmt->execute([
            'id' => $id
        ]);
    }
}

