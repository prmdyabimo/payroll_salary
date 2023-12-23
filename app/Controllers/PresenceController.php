<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelEmployees;
use App\Models\ModelPresences;
use App\Models\ModelRules;
use App\Models\ModelSalary;
use CodeIgniter\I18n\Time;

class PresenceController extends BaseController
{
    protected $modelPresences;
    protected $modelEmployees;
    protected $modelRules;
    protected $modelSalary;

    public function __construct()
    {
        $this->modelPresences = new ModelPresences();
        $this->modelEmployees = new ModelEmployees();
        $this->modelRules = new ModelRules();
        $this->modelSalary = new ModelSalary();
    }

    public function index()
    {
        helper('form');

        $employees = $this->modelEmployees->getAllEmployes();

        $data = [
            'title' => 'Absensi Kehadiran | PT Four Best Synergy',
            'employees' => $employees
        ];

        return view('pages/presences/index', $data);
    }

    public function store()
    {
        try {
            $mode = $this->request->getVar('mode');
            $employee_id = $this->request->getVar('employee_id');

            $validationRules = [
                'employee_id' => 'required',
                'mode' => 'required',
            ];

            $validationMessages = [
                'mode' => [
                    'required' => 'Mode absen harus diisi',
                ],
                'employee_id' => [
                    'required' => 'Nama harus diisi',
                ],
            ];

            if (!$this->validate($validationRules, $validationMessages)) {
                return redirect()->back()->withInput()->with('error', 'Data yang anda masukkan tidak valid');
            }


            $time = Time::now();
            $newTime = $time->addMinutes(15);

            // GET DAY NAME
            $dayName = strtoupper($this->getDayName($time));

            // GET RULES BY DAY NAME AND MODE
            $rules = $this->modelRules->where('day', $dayName)->where('status', $mode)->first();

            // GET PRESENCES TODAY
            $presences = $this->modelPresences
                ->where('employee_id', $employee_id)
                ->where('mode', $mode)
                ->where('DATE(created_at)', $time->toDateString())
                ->findAll();

            // DATA EMPLOYEE
            $employee = $this->modelEmployees->find($employee_id);

            // DEFAULT RESULT SALARY
            $resultSalary = $employee['salary'];

            if ($mode == "MASUK") {
                $status = ($newTime > $rules['time']) ? "Terlambat" : "Tepat Waktu";
                // FOR LATE
            } else if ($mode == "PULANG") {
                if ($time > $rules['time']) {
                    $status = "Tepat Waktu";
                } else {
                    return redirect()->back()->withInput()->with('error', 'Gagal absen, belum waktu pulang');
                }
            }

            // CHECK PRESENCES
            if (count($presences) > 0 && $rules['status'] == $mode) {
                return redirect()->back()->withInput()->with('error', 'Anda sudah melakukan absen ' . $mode);
            }
            
            if ($status == "Terlambat") {
                // CHARGE FOR LATE
                $chargeLate = 10000;

                // Kurangkan gaji dengan biaya terlambat
                $resultSalary -= $chargeLate;

                $dataSalary = [
                    'employee_id' => $employee_id,
                    'charge' => $chargeLate,
                    'result_salary' => $resultSalary
                ];

                $this->modelSalary->save($dataSalary);
            }

            $data = [
                'employee_id' => $employee_id,
                'mode' => $mode,
                'status' => $status
            ];

            $this->modelPresences->save($data);
            return redirect()->to('/')->with('success', 'Anda Berhasil Absen ' . $mode);

        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan, saat melakukan absen');
        }
    }

    // GET DAY NAME
    public function getDayName($date)
    {
        $dayNumber = date('N', strtotime($date));

        switch ($dayNumber) {
            case 1:
                return "Senin";
            case 2:
                return "Selasa";
            case 3:
                return "Rabu";
            case 4:
                return "Kamis";
            case 5:
                return "Jumat";
            case 6:
                return "Sabtu";
            case 7:
                return "Minggu";
            default:
                return "Hari tidak valid";
        }
    }


}
