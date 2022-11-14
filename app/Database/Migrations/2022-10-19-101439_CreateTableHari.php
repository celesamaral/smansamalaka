<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableHari extends Migration
{
    public function up()
    {
        $this->forge->addField(
            [
                'hari_id' => [
                    'type' => 'INT',
                    'constraint' => 2,
                    'unsigned' => true,
                    'auto_increment' => true
                ],
                'hari_nama' => [
                    'type' => 'VARCHAR',
                    'constraint' => '10'
                ]
            ]
        );
        $this->forge->addKey('hari_id');
        $this->forge->createTable('hari');
    }

    public function down()
    {
        $this->forge->dropTable('hari');
    }
}
