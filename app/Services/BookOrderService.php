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

    
}

