<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFKtoNilaiSiswa extends Migration
{
    public function up()
    {
        $fields = [

            'CONSTRAINT nilaisiswa_ibfk3 FOREIGN KEY (tahunajaran_id) REFERENCES tahunajaran(tahunajaran_id) on delete cascade on update cascade',
        ];
        $this->forge->addColumn('nilaisiswa', $fields);
    }

    public function down()
    {
        // $this->forge->dropForeignKey('nilaisiswa', 'nilaisiswa_ibfk1');
        // $this->forge->dropForeignKey('nilaisiswa', 'nilaisiswa_ibfk2');
        // $this->forge->dropForeignKey('nilaisiswa', 'nilaisiswa_ibfk3');
    }
}
