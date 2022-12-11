<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableDetailAbsensiMapel extends Migration
{
    public function up()
    {
        // siswa, kehadiran
        $this->forge->addField([
            'detailabsensimapel_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'siswa_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true
            ],
            'detailabsensimapel_kehadiran' => [
                'type' => 'ENUM',
                'constraint' => ['H', 'I', 'S', 'A'],
                'default' => 'H'
            ],
            'absensimapel_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ]
        ]);
        $this->forge->addPrimaryKey('detailabsensimapel_id');
        $this->forge->addForeignKey('siswa_id', 'siswa', 'siswa_id', 'cascade', 'cascade');
        $this->forge->addForeignKey('absensimapel_id', 'absensimapel', 'absensimapel_id', 'cascade', 'cascade');
        $this->forge->createTable('detailabsensimapel');
    }

    public function down()
    {
        $this->forge->dropForeignKey('detailabsensimapel', 'siswa_id');
        $this->forge->dropTable('detailabsensimapel');
    }
}
