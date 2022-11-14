<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Addkelompokdankelastomapel extends Migration
{
    public function up()
    {
        $fields = [
            'mapel_kelompok' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'mapel_kelas' => [
                'type' => 'VARCHAR',
                'constraint' => '10'
            ]
        ];
        $this->forge->addColumn('mapel', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('mapel', 'mapel_kelompok');
        $this->forge->dropColumn('mapel', 'mapel_kelas');
    }
}
