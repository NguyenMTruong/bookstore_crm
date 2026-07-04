<?php
class DashboardController
{
    public function index(): void
    {
        require_login();
        view('dashboard/index', [
            'title'=>'Bookstore CRM',
            'view'=>'dashboard/index'
        ]);
    }
}

