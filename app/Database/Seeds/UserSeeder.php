<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'username' => 'admin',
                'email' => 'admin@lms.local',
                'password' => password_hash('admin123', PASSWORD_DEFAULT),
                'full_name' => 'System Administrator',
                'role_id' => 1,
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
        ];

        // Simple Queries
        $this->db->table('users')->insertBatch($data);
    }
}
