<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTestResultsTable extends Migration
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
            'psychotest_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'total_score' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'result_summary' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'taken_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('psychotest_id', 'psychotests', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('test_results');
    }

    public function down()
    {
        $this->forge->dropTable('test_results');
    }
}
