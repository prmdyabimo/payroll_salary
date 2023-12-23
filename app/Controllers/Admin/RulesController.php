<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ModelRules;

class RulesController extends BaseController
{
    protected $modelRules;

    public function __construct()
    {
        $this->modelRules = new ModelRules();
    }

    public function index()
    {
        helper('form');

        $rules = $this->modelRules->orderBy('created_at', 'DESC')->findAll();

        $data = [
            'title' => 'Peraturan Absen | PT Four Best Synergy',
            'rules' => $rules
        ];

        return view('pages/admin/rules/index', $data);
    }

    public function store()
    {
        try {
            $day = $this->request->getVar('day');
            $status = $this->request->getVar('status');
            $time = $this->request->getVar('time');

            $validationRules = [
                'day' => 'required',
                'status' => 'required',
                'time' => 'required',
            ];

            $validationMessages = [
                'day' => [
                    'required' => 'Hari harus diisi',
                ],
                'status' => [
                    'required' => 'Status harus diisi',
                ],
                'time' => [
                    'required' => 'Waktu harus diisi',
                ],
            ];

            if (!$this->validate($validationRules, $validationMessages)) {
                return redirect()->back()->withInput()->with('error', 'Data yang anda masukkan tidak valid');
            }

            $data = [
                'day' => strtoupper($day),
                'status' => strtoupper($status),
                'time' => $time,
            ];

            $this->modelRules->save($data);
            return redirect()->to('/rules')->with('success', 'Anda berhasil menambahkan data peraturan absen');

        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data');
        }
    }

    public function edit(int $id)
    {
        helper('form');

        $rules = $this->modelRules->find($id);

        $data = [
            'title' => 'Edit Peraturan Absen | PT Four Best Synergy',
            'rule' => $rules
        ];

        return view('pages/admin/rules/edit', $data);
    }

    public function update(int $id)
    {
        try {
            $day = $this->request->getVar('day');
            $status = $this->request->getVar('status');
            $time = $this->request->getVar('time');

            $validationRules = [
                'day' => 'required',
                'status' => 'required',
                'time' => 'required',
            ];

            $validationMessages = [
                'day' => [
                    'required' => 'Hari harus diisi',
                ],
                'status' => [
                    'required' => 'Status harus diisi',
                ],
                'time' => [
                    'required' => 'Waktu harus diisi',
                ],
            ];

            if (!$this->validate($validationRules, $validationMessages)) {
                return redirect()->back()->withInput()->with('error', 'Data yang anda masukkan tidak valid');
            }

            $data = [
                'day' => strtoupper($day),
                'status' => strtoupper($status),
                'time' => $time,
            ];

            $this->modelRules->update($id, $data);
            return redirect()->to('/rules')->with('success', 'Anda berhasil mengubah data peraturan absen');

        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data');
        }
    }

    public function delete(int $id)
    {
        $rule = $this->modelRules->find($id);

        if (!$rule) {
            return redirect()->back()->withInput()->with('error', 'Data peraturan absen gagal dihapus');
        }

        $this->modelRules->delete($id);
        return redirect()->to('/rules')->with('success', 'Data peraturan absen berhasil dihapus');
    }
}
