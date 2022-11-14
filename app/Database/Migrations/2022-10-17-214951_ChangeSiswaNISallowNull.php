<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ChangeSiswaNISallowNull extends Migration
{
    public function up()
    {
        $fields = [
            'siswa_nis' => [
                'name' => 'siswa_nis',
                'type' => 'VARCHAR',
                'constraint' => '5',
                'null' => true,

            ]
        ];
        $this->forge->modifyColumn('siswa', $fields);
    }

    public function down()
    {
        //
    }
}
