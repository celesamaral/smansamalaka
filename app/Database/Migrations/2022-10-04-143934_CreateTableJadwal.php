<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableJadwal extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'jadwal_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'jadwal_hari' => [
                'type' => 'VARCHAR',
                'constraint' => '6',
            ],
            'jadwal_jenis' => [
                'type' => 'VARCHAR',
                'constraint' => '20'
            ],
            'jadwal_mulai' => [
                'type' => 'TIME',
                'null' => false
            ],
            'jadwal_selesai' => [
                'type' => 'TIME',
                'null' => false
            ],
            'mapel_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'constraint' => 5
            ],
            'kelas_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true
            ]
        ]);
        $this->forge->addKey('jadwal_id', true);
        $this->forge->createTable('jadwal');
    }

    public function down()
    {
        $this->forge->dropTable('jadwal');
    }
}
