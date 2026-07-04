<?php
class DashboardController
{
    public function index(): void
    {
        view('dashboard/index', [
            'title'=>'Bookstore CRM',
            'view'=>'dashboard/index'
        ]);
    }
}

