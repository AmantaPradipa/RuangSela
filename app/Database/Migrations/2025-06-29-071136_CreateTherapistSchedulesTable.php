<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTherapistSchedulesTable extends Migration
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
            'day_of_week' => [
                'type'       => 'ENUM',
                'constraint' => ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
            ],
            'start_time' => [
                'type' => 'TIME',
            ],
            'end_time' => [
                'type' => 'TIME',
            ],
            'is_available' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey(['therapist_id', 'day_of_week']);
        $this->forge->addForeignKey('therapist_id', 'therapists', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('therapist_schedules');
    }

    public function down()
    {
        $this->forge->dropTable('therapist_schedules');
    }
}
