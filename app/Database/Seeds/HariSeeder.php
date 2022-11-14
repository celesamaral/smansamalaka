<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class HariSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['hari_nama' => 'Senin'],
            ['hari_nama' => 'Selasa'],
            ['hari_nama' => 'Rabu'],
            ['hari_nama' => 'Kamis'],
            ['hari_nama' => 'Jumat'],
            ['hari_nama' => 'Sabtu'],
        ];
        $this->db->table('hari')->insertBatch($data);
    }
}
