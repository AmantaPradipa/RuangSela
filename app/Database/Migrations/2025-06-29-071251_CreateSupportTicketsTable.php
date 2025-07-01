<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSupportTicketsTable extends Migration
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
            'category' => [
                'type'       => 'ENUM',
                'constraint' => ['bug', 'feedback', 'payment', 'other'],
                'default'    => 'other',
            ],
            'subject' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'description' => [
                'type' => 'TEXT',
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['open', 'in_progress', 'resolved', 'closed'],
                'default'    => 'open',
            ],
            'priority' => [
                'type'       => 'ENUM',
                'constraint' => ['low', 'medium', 'high'],
                'default'    => 'medium',
            ],
            'created_at' => [
                'type'    => 'DATETIME',
                'null'    => false,
                'default' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'),
            ],
            'updated_at' => [
                'type'    => 'DATETIME',
                'null'    => false,
                'default' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'),
                'on_update' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'),
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE', 'fk_ticket_user');
        $this->forge->addKey('status', false, true, 'idx_ticket_status');
        $this->forge->addKey('priority', false, true, 'idx_ticket_priority');
        $this->forge->addKey('user_id', false, true, 'idx_ticket_user_id');
        $this->forge->addKey('category', false, true, 'idx_ticket_category');
        $this->forge->createTable('support_tickets');
    }

    public function down()
    {
        $this->forge->dropTable('support_tickets');
    }
}

