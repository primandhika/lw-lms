<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddBioAndContactToUsers extends Migration
{
    public function up()
    {
        $this->forge->addColumn('users', [
            'bio' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'nomor_kontak' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => true,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('users', ['bio', 'nomor_kontak']);
    }
}
