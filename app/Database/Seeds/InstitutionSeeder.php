<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class InstitutionSeeder extends Seeder
{
    public function run()
    {
        // Update existing records with codes
        $this->db->table('institutions')->where('id', 1)->update(['code' => 'UI']);
        $this->db->table('institutions')->where('id', 2)->update(['code' => 'ITB']);
        $this->db->table('institutions')->where('id', 3)->update(['code' => 'UGM']);
        $this->db->table('institutions')->where('id', 4)->update(['code' => 'SMAN1JKT']);
        $this->db->table('institutions')->where('id', 5)->update(['code' => 'SMKN1MLG']);
    }
}
