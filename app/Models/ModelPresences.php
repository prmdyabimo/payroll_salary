<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPresences extends Model
{
    protected $table = 'presences';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'employee_id',
        'mode',
        'status',
        'updated_at'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];

    // GET ALL PRESENCES
    public function getAllPresences()
    {
        $builder = $this->db->table('presences')
            ->select('presences.*, employees.*')
            ->join('employees', 'employees.id = presences.employee_id', 'left')
            ->orderBy('presences.created_at', 'DESC');

        $result = $builder->get()->getResultArray();
        return $result;
    }

    public function getAllPresencesByMonth($startTime, $endTime)
    {
        $builder = $this->db->table('presences')
            ->select('presences.*, employees.*')
            ->join('employees', 'employees.id = presences.employee_id', 'left')
            ->where('presences.created_at >=', $startTime)
            ->where('presences.created_at <=', $endTime)
            ->whereIn('presences.id', function ($subQuery) use ($startTime, $endTime) {
                $subQuery->selectMax('id')
                    ->from('presences as sub_presences')
                    ->where('sub_presences.employee_id = presences.employee_id')
                    ->where('sub_presences.created_at >=', $startTime)
                    ->where('sub_presences.created_at <=', $endTime);
            })
            ->orderBy('presences.created_at', 'DESC');

        $result = $builder->get()->getResultArray();
        return $result;
    }
}
