<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFKtoKelas extends Migration
{
    public function up()
    {
        $fields = [
            'CONSTRAINT kelas_ibfk2 FOREIGN KEY (jurusan_id) REFERENCES jurusan(jurusan_id) on update cascade on delete cascade'
        ];
        $this->forge->addColumn('kelas', $fields);
    }

    public function down()
    {
        $this->forge->dropForeignKey('kelas', 'kelas_ibfk1');
    }
}
