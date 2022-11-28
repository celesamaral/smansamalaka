<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTempKelasToSiswa extends Migration
{
    public function up()
    {
        $fields = [
            'siswa_kelastemp' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'null' => true,
                'default' => null
            ]
        ];
        $this->forge->addColumn('siswa', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('siswa', 'siswa_kelastemp');
    }
}
