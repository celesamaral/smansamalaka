<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GuruModel;
use App\Models\SiswaModel;
use App\Models\UserModel;

class Profil extends BaseController
{
    public function profil_admin()
    {
        helper('form');
        $user_id = session('user')->user_id;
        $model = new UserModel();
        $admin = $model->find($user_id);
        $data = [
            'title' => 'Profil',
            'admin' => $admin
        ];

        return view('profil/admin', $data);
    }

    public function profil_guru()
    {
        helper('form');
        $guru_id = session('guru')->guru_id;
        $model = new GuruModel();
        $guru = $model->findProfil($guru_id);
        // dd($guru);
        $data = [
            'title' => 'Profil',
            'guru' => $guru
        ];

        return view('profil/guru', $data);
    }

    public function profil_siswa()
    {
        helper('form');
        $siswa_id = session('siswa')->siswa_id;
        $model = new SiswaModel();
        $siswa = $model->findProfil($siswa_id);

        $data = [
            'title' => 'Profil',
            'siswa' => $siswa
        ];

        return view('profil/siswa', $data);
    }

    public function update_profile()
    {
        $user_id = $this->request->getPost('user_id');
        $file = $this->request->getFile('userfile');
        // dd($file);
        if (!empty($file)) {
            $filename = 'profile_' . $user_id . '.' . $file->getExtension();
            $path = './assets/img/profile';
            if ($file->move($path, $filename, true)) {
                $data['user_profile'] = $filename;
                $model = new UserModel();
                // dd('here');
                $model->update($user_id, $data);

                return redirect()->to(previous_url())
                    ->with('message', 'Foto Profil Diganti');
            }
            return redirect()->to(previous_url())
                ->with('message', '<span class="text-danger">Foto Gagal Diupload 1!</span>');
        }
        return redirect()->to(previous_url())
            ->with('message', '<span class="text-danger">Foto Gagal Diupload 2!</span>');
    }

    public function ganti_username()
    {
        $data = $this->request->getPost();
        $model = new UserModel();
        if ($model->update($data['user_id'], $data)) {
            return redirect()->to(previous_url())
                ->with('message', 'Profil berhasil diupdate');
        }
        return redirect()->to(previous_url())
            ->with('message', 'Gagal Update Profil')
            ->with('errors', $model->errors())
            ->withInput();
    }

    public function ganti_password()
    {
        $password_lama = $this->request->getPost('password_lama');
        $user_id = $this->request->getPost('user_id');
        $model = new UserModel();
        $user = $model->find($user_id);

        if (password_verify($password_lama, $user->user_password)) {
            $data = [
                'password' => $this->request->getPost('password'),
                'password_confirmation' => $this->request->getPost('confirmation_password')
            ];
            if ($model->update($user_id, $data)) {
                return redirect()->to(previous_url())
                    ->with('message', 'Password Berhasil Diubah');
            }
            return redirect()->to(previous_url())
                ->with('errors', $model->errors());
        }

        return redirect()->to(previous_url())
            ->with('errors', ['password' => 'Password salah!']);
    }
}
