<?php

namespace App\Database\Seeds;

use App\Models\SiswaModel;
use CodeIgniter\Database\Seeder;
use Faker\Factory;

class SiswaSeeder extends Seeder
{
    public function run()
    {
        for ($i = 0; $i < 50; $i++) {
            $faker = Factory::create();
            $data = [
                'siswa_nama' => $faker->name(),
                'siswa_nisn' => $faker->unique()->randomNumber(9),
                'siswa_jk' => $faker->randomElement(['Laki-Laki', 'Perempuan']),
                'siswa_tempat_lahir' => $faker->city(),
                'siswa_tgl_lahir' => $faker->date(),
                'siswa_hp' => $faker->e164PhoneNumber(),
                'siswa_goldarah' => 'O',
                'siswa_alamat' => $faker->address(),
                'siswa_email' => $faker->unique()->email(),
                'siswa_masuk' => date('Y'),
                'siswa_status' => 'baru',
                // 'kelas_id' => $faker->numberBetween(3, 4),
            ];
            $model = new SiswaModel();
            $model->insert($data);
        }
    }
}
