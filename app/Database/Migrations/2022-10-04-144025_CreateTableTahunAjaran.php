<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableTahunAjaran extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'tahunajaran_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'tahunajaran_tahun' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
            ],
            'tahunajaran_semester' => [
                'type' => 'VARCHAR',
                'constraint' => '10'
            ]
        ]);
        $this->forge->addKey('tahunajaran_id', true);
        $this->forge->createTable('tahunajaran');
    }

    public function down()
    {
        $this->forge->dropTable('tahunajaran');
    }
}
