<?php
class BookOrderRepository
{
    public function __construct(private PDO $pdo) {}

    public function countAll(string $keyword = ''): int
    {
        $sql = "
            SELECT COUNT(*) total
            FROM book_orders bo
            INNER JOIN customers c
                ON c.id=bo.customer_id
            ";

        $params = [];

        if ($keyword != '') {
            $sql .= "
                WHERE
                    bo.order_code LIKE :code
                    OR c.name LIKE :name
                    OR bo.book_title LIKE :title
                ";

            $searchs = '%' . $keyword . '%';

            $params = [
                'code' => $searchs,
                'name' => $searchs,
                'title' => $searchs
            ];
        }

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);

        return (int)$stmt->fetch()['total'];
    }

    public function getCustomers(): array
    {
        $stmt = $this->pdo->query("SELECT id, name FROM customers  ORDER BY name");

        return $stmt->fetchAll();
    }

    public function getPaginated(
        string $keyword,
        int $limit,
        int $offset,
        string $sort,
        string $direction
    ): array {
        $allowedSorts = ['order_code', 'book_title', 'quantity', 'status', 'created_at'];

        $allowedDirection = ['asc', 'desc'];

        if (!in_array($sort, $allowedSorts, true)) {
            $sort = 'created_at';
        }

        if (!in_array(strtolower($direction), $allowedDirection, true)) {
            $direction = 'desc';
        }

        $sql = "
            SELECT
                bo.*,
                c.name customer_name
            FROM book_orders bo
            INNER JOIN customers c
                ON c.id=bo.customer_id
            ";

        $params = [];

        if ($keyword != '') {
            $sql .= "
                WHERE
                    bo.order_code LIKE :code
                    OR c.name LIKE :name
                    OR bo.book_title LIKE :title
                ";

            $searchs = '%' . $keyword . '%';

            $params = [
                'code' => $searchs,
                'name' => $searchs,
                'title' => $searchs
            ];
        }

        $sql .= "ORDER BY {$sort} {$direction} LIMIT :limit OFFSET :offset";

        $stmt = $this->pdo->prepare($sql);

        foreach ($params as $k => $v) {

            $stmt->bindValue(
                ':' . $k,
                $v,
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
        $stmt = $this->pdo->prepare(
            "SELECT * FROM book_orders WHERE id=:id"
        );

        $stmt->execute(['id' => $id]);

        return $stmt->fetch() ?: null;
    }

    public function create(array $data): bool
    {
        $sql = "INSERT INTO book_orders 
            (order_code,customer_id,book_title,quantity,unit_price,total_amount,status)
            VALUES
            (:order_code,:customer_id,:book_title,:quantity,:unit_price,:total_amount,:status)
        ";

        try {
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute($data);
        } catch (PDOException $e) {
            if (($e->errorInfo[1] ?? 0) == 1062) {
                throw new DuplicateRecordException(
                    "Order code already exists."
                );
            }
            throw $e;
        }
    }

    public function update(int $id, array $data): bool
    {
        $sql = "UPDATE book_orders SET
                customer_id=:customer_id,
                book_title=:book_title,
                quantity=:quantity,
                unit_price=:unit_price,
                total_amount=:total_amount,
                status=:status,
                updated_at=NOW()
            WHERE id=:id
        ";
        $stmt = $this->pdo->prepare($sql);
        $data['id'] = $id;
        return $stmt->execute($data);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare(
            "DELETE FROM book_orders WHERE id=:id"
        );

        return $stmt->execute(['id' => $id]);
    }
}

