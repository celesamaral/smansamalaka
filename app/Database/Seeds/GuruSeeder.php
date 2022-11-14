<?php

namespace App\Database\Seeds;

use App\Models\GuruModel;
use App\Models\UserModel;
use CodeIgniter\Database\Seeder;
use Faker\Factory;

class GuruSeeder extends Seeder
{
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            $faker = Factory::create();
            $nip = $faker->unique()->randomNumber(9);

            $model = new UserModel();
            $data = [
                'username' => $nip,
                'user_type' => 'guru',
                'user_active' => 1,
                'password' => '12345',
                'password_confirmation' => '12345'
            ];
            if ($model->insert($data)) {
                $user_id = $model->getInsertID();

                $model = new GuruModel();
                $data = [
                    'guru_nip' => $nip,
                    'guru_nama' => $faker->name(),
                    'guru_jk' => $faker->randomElement(['Laki-Laki', 'Perempuan']),
                    'guru_tempat_lahir' => $faker->city(),
                    'guru_tgl_lahir' => $faker->date(),
                    'guru_hp' => $faker->e164PhoneNumber(),
                ];
                $data['user_id'] = $user_id;

                $model->insert($data);
            }
        }
    }
}
