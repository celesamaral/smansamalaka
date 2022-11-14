<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ChangeMapelIdAllowNullJadwal extends Migration
{
    public function up()
    {
        $fields = [
            'mapel_id' => [
                'name' => 'mapel_id',
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'null' => true
            ]
        ];
        $this->forge->modifyColumn('jadwal', $fields);
    }

    public function down()
    {
        //
    }
}
