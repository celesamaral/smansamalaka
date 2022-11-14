<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableNilaiSiswa extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'nilaisiswa_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'constraint' => 11,
                'auto_increment' => true
            ],
            'nilaisiswa_jenis' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
            ],
            'nilaisiswa_nilai' => [
                'type' => 'FLOAT',
            ],
            'siswa_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'kd_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'tahunajaran_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ]
        ]);
        $this->forge->addKey('nilaisiswa_id', true);
        $this->forge->createTable('nilaisiswa');
    }

    public function down()
    {
        $this->forge->dropTable('nilaisiswa');
    }
}
