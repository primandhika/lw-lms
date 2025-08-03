<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCodeToInstitutions extends Migration
{
    public function up()
    {
        $this->forge->addColumn('institutions', [
            'code' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
                'after'      => 'name'
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('institutions', 'code');
    }
}
