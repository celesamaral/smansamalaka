<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GuruModel;
use App\Models\SiswaModel;
use App\Models\UserModel;

class Auth extends BaseController
{
    public function index()
    {
        if (session()->has('user')) {
            return redirect()->to(session()->get('user')->user_type);
        }
        return view('login');
    }

    public function login()
    {
        $model = new UserModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $model->getLoginData($username);
        // dd($user->user_password);
        if ($user == null) {
            return redirect()->to(previous_url())
                ->with('error', 'Username tidak ditemukan!');
        }

        if (!password_verify($password, $user->user_password)) {
            return redirect()->to(previous_url())
                ->with('error', 'Password Salah!');
        }


        switch ($user->user_type) {
            case 'guru':
                $model = new GuruModel();

                $data = [
                    'user' => $user,
                    'guru' => $model->where('user_id', $user->user_id)->first(),
                    'guru_logged_in' => 1,
                ];
                session()->set($data);
                return redirect()->to('guru');
                break;
            case 'admin':
                $data = [
                    'user' => $user,
                    'admin_logged_in' => 1,
                ];
                session()->set($data);
                return redirect()->to('admin');
                break;
            case 'siswa':
                $model = new SiswaModel();

                $data = [
                    'user' => $user,
                    'siswa_logged_in' => 1,
                    'siswa' => $model->where('user_id', $user->user_id)->first(),
                ];
                session()->set($data);
                return redirect()->to('siswa');
                break;
            default:
                return redirect()->to('/');
                break;
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('auth/login');
    }
}
