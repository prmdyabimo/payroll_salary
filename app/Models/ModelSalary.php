<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelSalary extends Model
{
    protected $table            = 'salary';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'employee_id',
        'charge',
        'result_salary'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getSalary()
    {
        $builder = $this->db->table('salary')
            ->select('salary.*, employees.*')
            ->join('employees', 'employees.id = salary.employee_id', 'left')
            ->orderBy('salary.created_at', 'DESC');

        $result = $builder->get()->getResultArray();
        return $result;
    }

    public function getSalaryByMonth($startTime, $endTime)
    {
        $builder = $this->db->table('salary')
            ->select('salary.*, employees.*')
            ->where('salary.created_at >=', $startTime)
            ->where('salary.created_at <=', $endTime)
            ->join('employees', 'employees.id = salary.employee_id', 'left')
            ->orderBy('salary.created_at', 'DESC');

        $result = $builder->get()->getResultArray();
        return $result;
    }
}
