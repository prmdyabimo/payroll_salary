<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelUsers;

class AuthController extends BaseController
{
    protected $modelUsers;

    public function __construct()
    {
        $this->modelUsers = new ModelUsers();
    }

    public function index()
    {
        helper('form');

        $data = [
            'title' => 'Login Admin | PT Four Best Synergy'
        ];

        return view('pages/auth/login', $data);
    }

    public function login()
    {
        try {
            $username = $this->request->getVar('username');
            $password = $this->request->getVar('password');

            $validationRules = [
                'username' => 'required',
                'password' => 'required',
            ];

            $validationMessages = [
                'username' => [
                    'required' => 'Username harus diisi',
                ],
                'password' => [
                    'required' => 'Password harus diisi',
                ],
            ];

            if (!$this->validate($validationRules, $validationMessages)) {
                return redirect()->back()->withInput()->with('error', 'Data yang anda masukkan tidak valid');
            } 

            $user = $this->modelUsers->where('username', $username)->first();

            if (!$this->isUserValid($user, $password)) {
                return redirect()->back()->withInput()->with('error', 'Username atau password anda salah');
            }

            $userData = [
                'id' => $user['id'],
            ];

            session()->set($userData);
            return redirect()->to('/dashboard')->with('success', 'Anda berhasil login');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat proses login');
        }
    }

    public function logout(int $id)
    {
        $user = $this->modelUsers->find($id);

        if (!$user) {
            return redirect()->to('/dashboard')->with('error', 'Anda gagal logout');
        }

        session()->destroy($id);
        return redirect()->to('/login');
    }

    // CHECK PASSWORD VALIDATION
    private function isUserValid($user, $password)
    {
        return $user && password_verify($password, $user['password']);
    }
}
