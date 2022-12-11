<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableAbsensiMapel extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'absensimapel_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true
            ],
            'absensimapel_tgl' => [
                'type' => 'DATE'
            ],
            'mapel_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true
            ]
        ]);

        $this->forge->addPrimaryKey('absensimapel_id');
        $this->forge->addForeignKey('mapel_id', 'mapel', 'mapel_id', 'cascade', 'cascade');
        $this->forge->createTable('absensimapel');
    }

    public function down()
    {
        $this->forge->dropForeignKey('absensimapel', 'mapel_id');
        $this->forge->dropTable('absensimapel');
    }
}
