<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTestQuestionsTable extends Migration
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
            'psychotest_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'question' => [
                'type' => 'TEXT',
            ],
            'question_order' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('psychotest_id', 'psychotests', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('test_questions');
    }

    public function down()
    {
        $this->forge->dropTable('test_questions');
    }
}
