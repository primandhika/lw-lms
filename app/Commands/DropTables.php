<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class DropTables extends BaseCommand
{
    protected $group       = 'Database';
    protected $name        = 'db:drop_tables';
    protected $description = 'Drops the users and roles tables.';

    public function run(array $params)
    {
        $forge = \Config\Database::forge();
        $forge->dropTable('users', true);
        $forge->dropTable('roles', true);

        CLI::write('Tables dropped successfully.', 'green');
    }
}
