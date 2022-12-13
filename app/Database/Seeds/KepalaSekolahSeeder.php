<?php

namespace App\Database\Seeds;

use App\Models\KepalaSekolahModel;
use CodeIgniter\Database\Seeder;

class KepalaSekolahSeeder extends Seeder
{
    public function run()
    {
        $model = new KepalaSekolahModel();
        $data = [
            'kepalasekolah_nama' => 'Antonius Atok Tahuk, S.Pd',
            'kepalasekolah_nip' => '1969080119980210',
            'kepalasekolah_mulai' => date('Y-m-d'),
        ];
        $model->insert($data);
    }
}
