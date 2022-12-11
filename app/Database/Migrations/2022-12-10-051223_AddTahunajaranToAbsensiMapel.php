<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTahunajaranToAbsensiMapel extends Migration
{
    public function up()
    {
        $field = [
            'tahunajaran_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true
            ]

        ];
        $this->forge->addColumn('absensimapel', $field);

        $field = [
            'CONSTRAINT absensimapel_tahunajaran FOREIGN KEY (tahunajaran_id) REFERENCES tahunajaran(tahunajaran_id) on delete cascade on update cascade',
        ];
        $this->forge->addColumn('absensimapel', $field);
    }

    public function down()
    {
        //
    }
}
