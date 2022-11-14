<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddfileduserIdTosiswa extends Migration
{
    public function up()
    {
        $fields = [
            'user_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'constraint' => 11,
                'null' => true
            ],
            'constraint siswa_user_id_fk FOREIGN KEY(`user_id`) REFERENCES `user`(`user_id`) on delete cascade on update cascade'
        ];
        $this->forge->addColumn('siswa', $fields);
    }

    public function down()
    {
        $this->forge->dropForeignKey('siswa', 'siswa_user_id_fk');
        $this->forge->dropColumn('siswa', ['user_id']);
    }
}
