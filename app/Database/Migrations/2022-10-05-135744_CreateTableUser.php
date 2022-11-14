<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableUser extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => '16',
            ],
            'user_password' => [
                'type' => 'TEXT',
            ],
            'user_type' => [
                'type' => 'VARCHAR',
                'constraint' => '10'
            ],
            'user_active' => [
                'type' => 'INT',
                'constraint' => 1
            ]
        ]);
        $this->forge->addKey('user_id', true);
        $this->forge->createTable('user');
    }

    public function down()
    {
        $this->forge->dropTable('user');
    }
}
