<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableKd extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'kd_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'constraint' => 5,
                'auto_increment' => true
            ],
            'kd_nama' => [
                'type' => 'VARCHAR',
                'constraint' => '255'
            ],
            'mapel_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'constraint' => 5,
            ]
        ]);
        $this->forge->addKey('kd_id', true);
        $this->forge->addForeignKey('mapel_id', 'mapel', 'mapel_id', 'cascade', 'cascade');
        $this->forge->createTable('kd');
    }

    public function down()
    {
        $this->forge->dropTable('kd');
    }
}
