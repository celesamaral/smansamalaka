<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFKtoNSiswa extends Migration
{
    public function up()
    {
        $fields = [
            'CONSTRAINT nilaisiswa_ibfk4 FOREIGN KEY (siswa_id) REFERENCES siswa(siswa_id) on delete cascade on update cascade',
            'CONSTRAINT nilaisiswa_ibfk5 FOREIGN KEY (kd_id) REFERENCES kd(kd_id) on delete cascade on update cascade',
        ];
        $this->forge->addColumn('nilaisiswa', $fields);
    }

    public function down()
    {
        //
    }
}
