<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFKtoSiswa extends Migration
{
    public function up()
    {
        $fields = [
            'CONSTRAINT siswa_ibfk1 FOREIGN KEY (kelas_id) REFERENCES kelas(kelas_id) on delete cascade on update cascade',
        ];
        $this->forge->addColumn('siswa', $fields);
    }

    public function down()
    {
        $this->forge->dropForeignKey('siswa', 'siswa_ibfk1');
    }
}
