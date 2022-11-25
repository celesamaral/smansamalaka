<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDetailAbsensi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'detailabsensi_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'siswa_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'absensi_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'detailabsensi_kehadiran' => [
                'type' => 'ENUM',
                'constraint' => ['H', 'A', 'S', 'I'],
                'default' => 'H'
            ]
        ]);
        $this->forge->addPrimaryKey('detailabsensi_id');
        $this->forge->addForeignKey('siswa_id', 'siswa', 'siswa_id', 'cascade', 'cascade');
        $this->forge->addForeignKey('absensi_id', 'absensi', 'absensi_id', 'cascade', 'cascade');
        $this->forge->createTable('detailabsensi');
    }

    public function down()
    {
        $this->forge->dropTable('detailabsensi');
    }
}
