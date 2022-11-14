<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddStatustoTahunajaran extends Migration
{
    public function up()
    {
        $fields = [
            'tahunajaran_status' => [
                'type' => 'VARCHAR',
                'constraint' => '10',
                'default' => 'nonaktif'
            ]
        ];
        $this->forge->addColumn('tahunajaran', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('tahunajaran', 'tahunajaran_status');
    }
}
