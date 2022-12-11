<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddKelasIDtoAbsensiMapel extends Migration
{
    public function up()
    {
        $field = [
            'kelas_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true
            ]

        ];
        $this->forge->addColumn('absensimapel', $field);

        $field = [
            'CONSTRAINT absensimapel_kelas FOREIGN KEY (kelas_id) REFERENCES kelas(kelas_id) on delete cascade on update cascade',
        ];
        $this->forge->addColumn('absensimapel', $field);
    }

    public function down()
    {
        //
    }
}
