<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SetKelasIDtoNULL extends Migration
{
    public function up()
    {
        $field = [
            'kelas_id' => [
                'name' => 'kelas_id',
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'NULL' => true
            ]
        ];
        $this->forge->modifyColumn('siswa', $field);
    }

    public function down()
    {
        //
    }
}
