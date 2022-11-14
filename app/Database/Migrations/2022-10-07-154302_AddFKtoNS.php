<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFKtoNS extends Migration
{
    public function up()
    {
        $fields = [
            'CONSTRAINT nilaisiswa_ibfk6 FOREIGN KEY (siswa_id) REFERENCES siswa(siswa_id) on delete cascade on update cascade',
        ];
        $this->forge->addColumn('nilaisiswa', $fields);
    }

    public function down()
    {
        //
    }
}
