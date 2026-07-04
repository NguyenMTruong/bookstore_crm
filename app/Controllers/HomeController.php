<?php
class HomeController
{
    public function index(): void
    {
        view('home/index', [
            'title'=>'Bookstore CRM',
            'view'=>'home/index'
        ]);
    }
}

