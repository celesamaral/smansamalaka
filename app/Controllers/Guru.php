<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GuruModel;
use App\Models\KelasModel;
use App\Models\SiswaModel;
use App\Models\UserModel;
use App\Models\WaliKelasModel;

class Guru extends BaseController
{
    public function index()
    {
        helper('form');
        $model = new GuruModel();
        $data['title'] = 'Guru';
        $data['data_guru'] = $model->findAll();

        return view('admin/guru/index', $data);
    }

    public function tambah()
    {
        helper('form');
        $data['title'] = 'Tambah Guru';
        $data['action'] = 'store_guru';
        $data['guru'] = new GuruModel();
        return view('admin/guru/tambah', $data);
    }

    public function store_guru()
    {
        $model = new UserModel();
        $data = [
            'username' => $this->request->getPost('guru_nip'),
            'user_type' => 'guru',
            'user_active' => 1,
            'password' => '12345',
            'password_confirmation' => '12345'
        ];
        if ($model->insert($data)) {
            $user_id = $model->getInsertID();

            $model = new GuruModel();
            $data = $this->request->getPost();
            $data['user_id'] = $user_id;

            if ($model->insert($data)) {
                return redirect()->to('admin/guru')
                    ->with('message', 'Data berhasil disimpan!');
            } else {
                // dd(previous_url());
                return redirect()->to(previous_url())
                    ->with('errors', $model->errors())
                    ->withInput();
            }
        }
        dd($model->errors());
    }

    public function edit($guru_id)
    {
        helper('form');
        $model = new GuruModel();
        $guru = $model->find($guru_id);

        if (!empty($guru)) {
            $data = [
                'action' => 'update',
                'title' => 'Edit Data Guru',
                'guru' => $guru
            ];
            return view('admin/guru/tambah', $data);
        } else {
            return redirect()->to('admin/guru')
                ->with('message', 'Data guru tidak ditemukan');
        }
    }

    public function update()
    {
        $guru_id = $this->request->getPost('guru_id');
        $data = $this->request->getPost();
        $model = new GuruModel();
        $guru = $model->find($guru_id);
        if ($model->update($guru_id, $data)) {
            $model = new UserModel();
            $user['username'] = $data['guru_nip'];
            $model->update($guru->user_id, $user);
            return redirect()->to('admin/guru')
                ->with('message', 'Data berhasil diupdate');
        } else {
            return redirect()->to(previous_url())
                ->with('errors', $model->errors())
                ->withInput();
        }
    }

    public function hapus()
    {
        $guru_id = $this->request->getPost('guru_id');
        $model = new GuruModel();
        $model->where('guru_id', $guru_id);
        $model->delete();
        return redirect()->to(previous_url())->with('message', 'data berhasil dihapus');
    }

    public function wali_kelas($kelas_id = null)
    {
        $guru_id = session('guru')->guru_id;

        $model = new WaliKelasModel();
        if ($kelas_id == null) {
            $data_kelas = $model->findKelasWali($guru_id);

            $data = [
                'title' => 'Daftar Kelas Wali',
                'data_kelas' => $data_kelas
            ];
            if (empty($data_kelas))
                session()->setFlashdata('message', 'Anda Bukan Wali Kelas!');
            return view('walikelas/kelas', $data);
        }

        if (!$model->cekWaliKelas($guru_id, $kelas_id)) {
            return redirect()->to(previous_url())
                ->with('message', '<span class="text-danger">Anda Tidak Memiliki Akses!</span>');
        }
        $model = new KelasModel();
        $kelas = $model->findSingle($kelas_id);

        $model = new SiswaModel();
        $data_siswa = $model->findAllSiswa($kelas_id);

        $data = [
            'title' => 'Daftar Siswa Kelas ' . $kelas->kelas_tingkat . ' ' . $kelas->jurusan_nama . ' ' . $kelas->kelas_abjad,
            'data_siswa' => $data_siswa
        ];
        return view('walikelas/siswa', $data);
    }
}
