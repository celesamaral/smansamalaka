<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableSiswa extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'siswa_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'siswa_nisn' => [
                'type' => 'VARCHAR',
                'constraint' => '18',
                'null' => false
            ],
            'siswa_nis' => [
                'type' => 'VARCHAR',
                'constraint' => '5'
            ],
            'siswa_nama' => [
                'type' => 'VARCHAR',
                'constraint' => '150',
            ],
            'siswa_jk' => [
                'type' => 'VARCHAR',
                'constraint' => '30',
            ],
            'siswa_tempat_lahir' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'siswa_tgl_lahir' => [
                'type' => 'DATE'
            ],
            'siswa_hp' => [
                'type' => 'VARCHAR',
                'constraint' => '12',
            ],
            'siswa_goldarah' => [
                'type' => 'VARCHAR',
                'constraint' => '2'
            ],
            'siswa_alamat' => [
                'type' => 'TEXT'
            ],
            'siswa_email' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'siswa_masuk' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'siswa_status' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'kelas_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'constraint' => 5
            ]
        ]);
        $this->forge->addKey('siswa_id', true);
        $this->forge->createTable('siswa');
    }

    public function down()
    {
        $this->forge->dropTable('siswa');
    }
}
