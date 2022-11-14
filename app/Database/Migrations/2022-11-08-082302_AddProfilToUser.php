<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddProfilToUser extends Migration
{
    public function up()
    {
        $fields = [
            'user_profile' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'default' => 'default.png'
            ]
        ];
        $this->forge->addColumn('user', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('user', 'user_profile');
    }
}
