<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterTableSiswaChangeNIS extends Migration
{
    public function up()
    {
        $field = [
            'siswa_nis' => [
                'name' => 'siswa_nis',
                'type' => 'VARCHAR',
                'constraint' => '11'
            ],
        ];
        $this->forge->modifyColumn('siswa', $field);
    }

    public function down()
    {
        //
    }
}
