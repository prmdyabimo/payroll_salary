<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ModelEmployees;
use CodeIgniter\I18n\Time;

class EmployeeController extends BaseController
{
    protected $modelEmployees;

    public function __construct()
    {
        $this->modelEmployees = new ModelEmployees();
    }

    public function index()
    {
        helper(['form']);

        $employees = $this->modelEmployees->getAllEmployes();

        $data = [
            'title' => 'Pegawai | PT Four Best Synergy',
            'employees' => $employees
        ];

        return view('pages/admin/employee/index', $data);
    }

    public function store()
    {
        try {
            $nik = $this->request->getVar('nik');
            $name = $this->request->getVar('name');
            $position = $this->request->getVar('position');
            $salary = $this->request->getVar('salary');

            $validationRules = [
                'nik' => 'required|numeric|is_unique[employees.nik]',
                'name' => 'required',
                'position' => 'required',
                'salary' => 'required|numeric',
            ];

            $validationMessages = [
                'nik' => [
                    'required' => 'NIK harus diisi',
                    'numeric' => 'NIK harus berupa angka',
                    'is_unique' => 'NIK sudah terdaftar',
                ],
                'name' => [
                    'required' => 'Nama harus diisi',
                ],
                'position' => [
                    'required' => 'Posisi harus diisi',
                ],
                'salary' => [
                    'required' => 'Gaji harus diisi',
                    'numeric' => 'Gaji harus berupa angka',
                ],
            ];

            if (!$this->validate($validationRules, $validationMessages)) {
                return redirect()->back()->withInput()->with('error', 'Data yang anda masukkan tidak valid');
            }

            $data = [
                'nik' => $nik,
                'name' => $name,
                'position' => $position,
                'salary' => $salary,
            ];

            $this->modelEmployees->save($data);
            return redirect()->to('/employee')->with('success', 'Anda berhasil menambahkan data pegawai');

        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data');
        }
    }

    public function edit(int $id)
    {
        helper('form');

        $employee = $this->modelEmployees->find($id);

        $data = [
            'title' => 'Edit Pegawai | PT Four Best Synergy',
            'employee' => $employee
        ];

        return view('pages/admin/employee/edit', $data);
    }

    public function update(int $id)
    {
        try {
            $nik = $this->request->getVar('nik');
            $name = $this->request->getVar('name');
            $position = $this->request->getVar('position');
            $salary = $this->request->getVar('salary');

            $validationRules = [
                'nik' => 'required|numeric',
                'name' => 'required',
                'position' => 'required',
                'salary' => 'required|numeric',
            ];

            $validationMessages = [
                'nik' => [
                    'required' => 'NIK harus diisi',
                    'numeric' => 'NIK harus berupa angka',
                ],
                'name' => [
                    'required' => 'Nama harus diisi',
                ],
                'position' => [
                    'required' => 'Posisi harus diisi',
                ],
                'salary' => [
                    'required' => 'Gaji harus diisi',
                    'numeric' => 'Gaji harus berupa angka',
                ],
            ];

            if (!$this->validate($validationRules, $validationMessages)) {
                return redirect()->back()->withInput()->with('error', 'Data yang anda masukkan tidak valid');
            }

            $data = [
                'nik' => $nik,
                'name' => $name,
                'position' => $position,
                'salary' => $salary,
                'updated_at' => Time::now()
            ];

            $this->modelEmployees->update($id, $data);
            return redirect()->to('/employee')->with('success', 'Anda berhasil mengubah data pegawai');

        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data');
        }
    }

    public function delete(int $id)
    {
        $employee = $this->modelEmployees->find($id);

        if (!$employee) {
            return redirect()->back()->withInput()->with('error', 'Data pegawai gagal dihapus');
        }

        $this->modelEmployees->delete($id);    
        return redirect()->to('/employee')->with('success', 'Data pegawai berhasil dihapus');
    }

}
