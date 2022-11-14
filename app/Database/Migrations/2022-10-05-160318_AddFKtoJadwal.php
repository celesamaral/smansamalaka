<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFKtoJadwal extends Migration
{
    public function up()
    {
        $fields = [
            'CONSTRAINT jadwal_ibfk1 FOREIGN KEY (kelas_id) REFERENCES kelas(kelas_id) on delete cascade on update cascade',
            'CONSTRAINT jadwal_ibfk2 FOREIGN KEY (mapel_id) REFERENCES mapel(mapel_id) on delete cascade on update cascade',
        ];
        $this->forge->addColumn('jadwal', $fields);
    }

    public function down()
    {
        $this->forge->dropForeignKey('jadwal', 'jadwal_ibfk1');
        $this->forge->dropForeignKey('jadwal', 'jadwal_ibfk2');
    }
}
