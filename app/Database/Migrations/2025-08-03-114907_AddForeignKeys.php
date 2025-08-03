<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddForeignKeys extends Migration
{
    public function up()
    {
        // Add foreign key for users.role_id
        $this->forge->addForeignKey('role_id', 'roles', 'id', 'CASCADE', 'CASCADE', 'fk_users_role_id');
        $this->forge->processIndexes('users');
        
        // Add foreign key for classes.teacher_id
        $this->forge->addForeignKey('teacher_id', 'users', 'id', 'SET NULL', 'CASCADE', 'fk_classes_teacher_id');
        $this->forge->processIndexes('classes');
        
        // Add foreign key for criteria.class_id
        $this->forge->addForeignKey('class_id', 'classes', 'id', 'CASCADE', 'CASCADE', 'fk_criteria_class_id');
        $this->forge->processIndexes('criteria');
        
        // Add foreign keys for weightings
        $this->forge->addForeignKey('class_id', 'classes', 'id', 'CASCADE', 'CASCADE', 'fk_weightings_class_id');
        $this->forge->addForeignKey('criteria_id', 'criteria', 'id', 'CASCADE', 'CASCADE', 'fk_weightings_criteria_id');
        $this->forge->processIndexes('weightings');
    }

    public function down()
    {
        // Drop foreign keys
        $this->forge->dropForeignKey('users', 'fk_users_role_id');
        $this->forge->dropForeignKey('classes', 'fk_classes_teacher_id');
        $this->forge->dropForeignKey('criteria', 'fk_criteria_class_id');
        $this->forge->dropForeignKey('weightings', 'fk_weightings_class_id');
        $this->forge->dropForeignKey('weightings', 'fk_weightings_criteria_id');
    }
}
