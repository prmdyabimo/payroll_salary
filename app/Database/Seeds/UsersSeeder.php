<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'username' => 'administrator',
            'password' => password_hash('admin@12345', PASSWORD_DEFAULT)
        ];

        $this->db->table('users')->insert($data);
    }
}
