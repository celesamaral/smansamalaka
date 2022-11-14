<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddKelasSementaraToSiswa extends Migration
{
    public function up()
    {
        $fields = [
            'siswa_kelas_temp' => [
                'type' => 'INT',
                'constraint' => 2,
                'unsigned' => true,
                'null' => true
            ]
        ];
        $this->forge->addColumn('siswa', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('siswa', 'siswa_kelas_temp');
    }
}
