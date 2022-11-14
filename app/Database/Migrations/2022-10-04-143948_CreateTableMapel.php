<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableMapel extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'mapel_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'constraint' => 5,
                'auto_increment' => true
            ],
            'mapel_nama' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'guru_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'constraint' => 5
            ]
        ]);

        $this->forge->addKey('mapel_id', true);
        $this->forge->addForeignKey('guru_id', 'guru', 'guru_id', 'cascade', 'cascade');
        $this->forge->createTable('mapel');
    }

    public function down()
    {
        $this->forge->dropTable('mapel');
    }
}
