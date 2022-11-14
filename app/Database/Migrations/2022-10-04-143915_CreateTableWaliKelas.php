<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableWaliKelas extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'walikelas_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'constraint' => 5,
                'auto_increment' => true
            ],
            'guru_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'constraint' => 5
            ],
            'kelas_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'constraint' => 5
            ]
        ]);
        $this->forge->addKey('walikelas_id', true);
        $this->forge->addForeignKey('guru_id', 'guru', 'guru_id', 'cascade', 'cascade');
        $this->forge->addForeignKey('kelas_id', 'kelas', 'kelas_id', 'cascade', 'cascade');
        $this->forge->createTable('walikelas');
    }

    public function down()
    {
        $this->forge->dropTable('walikelas');
    }
}
