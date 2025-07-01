<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTherapistsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'expertise' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'experience_years' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
            ],
            'education' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'license_number' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            'license_file' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'verification_status' => [
                'type'       => 'ENUM',
                'constraint' => ['unverified', 'pending', 'verified', 'rejected'],
                'default'    => 'unverified',
            ],
            'verification_notes' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'bio' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'is_available' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1,
            ],
            'created_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
            'updated_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('therapists');
    }

    public function down()
    {
        $this->forge->dropTable('therapists');
    }
}
