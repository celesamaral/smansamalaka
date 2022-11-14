<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableJurusan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'jurusan_id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'jurusan_nama' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ]
        ]);
        $this->forge->addKey('jurusan_id', true);
        $this->forge->createTable('jurusan');
    }

    public function down()
    {
        $this->forge->dropTable('jurusan');
    }
}
