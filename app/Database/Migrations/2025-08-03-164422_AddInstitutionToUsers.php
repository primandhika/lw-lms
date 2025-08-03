<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddInstitutionToUsers extends Migration
{
    public function up()
    {
        $this->forge->addColumn('users', [
            'institution_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
                'after'      => 'role_id'
            ]
        ]);
        
        // Add foreign key constraint
        $this->forge->addForeignKey('institution_id', 'institutions', 'id', 'SET NULL', 'CASCADE');
    }

    public function down()
    {
        $this->forge->dropForeignKey('users', 'users_institution_id_foreign');
        $this->forge->dropColumn('users', 'institution_id');
    }
}
