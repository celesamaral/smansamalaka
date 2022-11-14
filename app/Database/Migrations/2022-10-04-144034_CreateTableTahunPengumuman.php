<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableTahunPengumuman extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'pengumuman_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'pengumuman_judul' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'pengumuman_tgl' => [
                'type' => 'DATE'
            ],
            'pengumuman_isi' => [
                'type' => 'TEXT'
            ],
            'pengumuman_status' => [
                'type' => 'VARCHAR',
                'constraint' => '10'
            ]
        ]);
        $this->forge->addKey('pengumuman_id', true);
        $this->forge->createTable('pengumuman');
    }

    public function down()
    {
        $this->forge->dropTable('pengumuman');
    }
}
