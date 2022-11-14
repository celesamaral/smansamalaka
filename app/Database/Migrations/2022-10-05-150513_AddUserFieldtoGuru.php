<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUserFieldtoGuru extends Migration
{
    public function up()
    {
        $fields = [
            'user_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'constraint' => 11
            ],
            'constraint guru_ibfk2 FOREIGN KEY(`user_id`) REFERENCES `user`(`user_id`) on delete cascade on update cascade'
        ];
        $this->forge->addColumn('guru', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('guru', ['user_id']);
    }
}
