<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddYearToClassesTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('classes', [
            'year' => [
                'type'       => 'YEAR',
                'constraint' => 4,
                'null'       => true,
                'after'      => 'description'
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('classes', 'year');
    }
}
