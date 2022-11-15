<?php

namespace App\Database\Seeds;

use App\Models\UserModel;
use CodeIgniter\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $model = new UserModel();
        $data = [
            'username' => 'admin2',
            'user_type' => 'admin',
            'user_active' => 1,
            'password' => '12345',
            'password_confirmation' => '12345',
        ];
        if (!$model->insert($data)) {
            $errors = $model->errors();
            foreach ($errors as $i => $error) {
                # code...
                log_message('error', $error);
            }
        }
    }
}
