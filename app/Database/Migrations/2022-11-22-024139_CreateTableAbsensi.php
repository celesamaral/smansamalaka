<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableAbsensi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'absensi_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'constraint' => 11,
                'auto_increment' => true
            ],
            'absensi_tgl' => [
                'type' => 'DATE',
            ],
            'tahunajaran_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'constraint' => 5,
            ]
        ]);
        $this->forge->addPrimaryKey('absensi_id');
        $this->forge->addForeignKey('tahunajaran_id', 'tahunajaran', 'tahunajaran_id', 'cascade', 'cascade');
        $this->forge->createTable('absensi');
    }

    public function down()
    {
        $this->forge->dropForeignKey('absensi', 'tahunajaran_id');
        $this->forge->dropTable('absensi');
    }
}
