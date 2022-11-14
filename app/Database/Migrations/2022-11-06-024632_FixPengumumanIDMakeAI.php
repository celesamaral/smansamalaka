<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FixPengumumanIDMakeAI extends Migration
{
    public function up()
    {
        $field = [
            'pengumuman_id' => [
                'name' => 'pengumuman_id',
                'type' => 'INT',
                'unsigned' => true,
                'constraint' => 5,
                'auto_increment' => true
            ]
        ];
        $this->forge->modifyColumn('pengumuman', $field);
    }

    public function down()
    {
        //
    }
}
