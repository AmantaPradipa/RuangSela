<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateQuestionOptionsTable extends Migration
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
            'question_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'option_text' => [
                'type' => 'TEXT',
            ],
            'score' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('question_id', 'test_questions', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('question_options');
    }

    public function down()
    {
        $this->forge->dropTable('question_options');
    }
}
