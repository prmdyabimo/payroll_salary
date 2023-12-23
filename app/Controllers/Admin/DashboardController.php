<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ModelEmployees;
use App\Models\ModelPresences;

class DashboardController extends BaseController
{
    protected $modelEmployess;
    protected $modelPresences;

    public function __construct()
    {
        $this->modelEmployess = new ModelEmployees();
        $this->modelPresences = new ModelPresences();
    }

    public function index()
    {
        $employees = $this->modelEmployess->getAllEmployes();
        $presences = $this->modelPresences->orderBy('created_at', 'DESC')->findAll();

        $data = [
            'title' => 'Beranda | PT Four Best Synergy',
            'employees' => $employees,
            'presences' => $presences
        ];

        return view('pages/admin/dashboard', $data);
    }
}
