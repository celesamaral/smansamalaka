<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableKepalaSekolah extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'kepalasekolah_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true
            ],
            'kepalasekolah_nama' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'kepalasekolah_nip' => [
                'type' => 'VARCHAR',
                'constraint' => '16',
            ],
            'kepalasekolah_mulai' => [
                'type' => 'DATE',
                'null' => true,
                'default' => null
            ],
            'kepalasekolah_selesai' => [
                'type' => 'DATE',
                'null' => true,
                'default' => NULL
            ],
            'kepalasekolah_status' => [
                'type' => 'ENUM',
                'constraint' => ['aktif', 'nonaktif'],
                'default' => 'aktif'
            ]
        ]);

        $this->forge->addPrimaryKey('kepalasekolah_id');
        $this->forge->createTable('kepalasekolah');
    }

    public function down()
    {
        $this->forge->dropTable('kepalasekolah');
    }
}
