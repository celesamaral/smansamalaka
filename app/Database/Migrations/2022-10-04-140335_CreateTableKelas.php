<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableKelas extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'kelas_id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'kelas_tingkat' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'jurusan_id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
            ],
            'kelas_abjad' => [
                'type' => 'VARCHAR',
                'constraint' => '2'
            ]
        ]);
        $this->forge->addKey('kelas_id', true);
        $this->forge->createTable('kelas');
    }

    public function down()
    {
        $this->forge->dropTable('kelas');
    }
}
