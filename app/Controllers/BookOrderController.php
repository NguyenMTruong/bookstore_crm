<?php
require_once __DIR__.'/../Services/BookOrderService.php';

class BookOrderController
{
    public function index(): void
    {
        require_login();

        echo "Book Order List";
    }

    public function create(): void
    {
        require_login();

        echo "Create Book Order";
    }

    public function store(): void
    {
    }

    public function edit(): void
    {
        require_login();

        echo "Edit Book Order";
    }

    public function update(): void
    {
    }

    public function delete(): void
    {
    }
}
