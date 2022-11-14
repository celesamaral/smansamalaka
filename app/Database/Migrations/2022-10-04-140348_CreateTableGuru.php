<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableGuru extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'guru_id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'guru_nip' => [
                'type'           => 'VARCHAR',
                'constraint'     => '16',
                'null' => false,
            ],
            'guru_nama' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'guru_jk' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'guru_tempat_lahir' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'guru_tgl_lahir' => [
                'type'       => 'DATE',
            ],
            'guru_hp' => [
                'type'       => 'VARCHAR',
                'constraint' => '12',
            ],
        ]);
        $this->forge->addKey('guru_id', true);
        $this->forge->createTable('guru');
    }

    public function down()
    {
        $this->forge->dropTable('guru');
    }
}
