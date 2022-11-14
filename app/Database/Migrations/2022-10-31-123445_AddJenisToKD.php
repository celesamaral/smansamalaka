<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddJenisToKD extends Migration
{
    public function up()
    {
        $fields = [
            'kd_jenis' => [
                'type' => 'VARCHAR',
                'constraint' => '4',
                'default' => 'kd'
            ],
            'kd_deleted' => [
                'type' => 'INT',
                'constraint' => 1,
                'default' => 0
            ]
        ];
        $this->forge->addColumn('kd', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('kd', 'kd_jenis');
        $this->forge->dropColumn('kd', 'kd_deleted');
    }
}
