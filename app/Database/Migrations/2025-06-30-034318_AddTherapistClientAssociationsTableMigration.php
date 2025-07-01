<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTherapistClientAssociationsTableMigration extends Migration
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
            'therapist_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'client_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'associated_at' => [
                'type'    => 'DATETIME',
                'null'    => false,
                'default' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'),
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey(['therapist_id', 'client_id']);
        $this->forge->addForeignKey('therapist_id', 'therapists', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('client_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('therapist_client_associations');
    }

    public function down()
    {
        $this->forge->dropTable('therapist_client_associations');
    }
}
