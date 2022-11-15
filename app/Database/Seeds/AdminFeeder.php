<?php

namespace App\Database\Seeds;

use App\Models\UserModel;
use CodeIgniter\Database\Seeder;

class AdminFeeder extends Seeder
{
    public function run()
    {
        $model = new UserModel();
        $data = [
            'username' => 'admin',
            'user_type' => 'admin',
            'user_active' => 1,
            'password' => '12345',
            'password_confirmation' => '12345'
        ];
        $model->insert($data);
    }
}
