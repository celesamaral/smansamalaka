<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KelasModel;
use App\Models\SiswaModel;

class Siswa extends BaseController
{
    public function index()
    {
        helper('form');
        $model = new SiswaModel();
        $data_siswa = $model->getSiswaBaru();

        $model = new KelasModel();
        $data_kelas = $model->findKelasBaru();
        $data = [
            'title' => 'Siswa Baru',
            'data_siswa' => $data_siswa,
            'data_kelas' => $data_kelas
        ];
        // dd($data_siswa);
        return view('siswa/index', $data);
    }

    public function detail($siswa_id)
    {
        $model = new SiswaModel();
        $siswa = $model->findProfil($siswa_id);
        $data = [
            'title' => 'Data Siswa',
            'siswa' => $siswa
        ];
        return view('siswa/detail', $data);
    }

    public function store()
    {
        $data = $this->request->getPost();
        $data['siswa_masuk'] = date('YY');
        $data['siswa_status'] = 'baru';
        $model = new SiswaModel();
        if ($model->insert($data)) {
            return redirect()->to(previous_url())
                ->with('message', 'Data berhasil ditambahkan');
        }
        // dd($model->errors());
        return redirect()->to(previous_url())
            ->with('message', 'Data gagal disimpan')
            ->with('errors', $model->errors())
            ->withInput();
    }

    public function edit($siswa_id)
    {
        helper('form');
        $model = new SiswaModel();
        $siswa = $model->find($siswa_id);

        $model = new KelasModel();
        $data_kelas = $model->findAll();

        $data = [
            'title' => 'Edit Siswa',
            'siswa' => $siswa,
            'data_kelas' => $data_kelas
        ];

        return view('siswa/edit', $data);
    }
    public function update()
    {
        $siswa_id = $this->request->getPost('siswa_id');
        $data = $this->request->getPost();

        $model = new SiswaModel();

        if ($model->update($siswa_id, $data)) {
            $path = 'admin/siswa';
            $siswa = $model->find($siswa_id);
            if ($siswa->siswa_status = 'aktif')
                $path .= '/aktif';
            else
                $path .= '/baru';
            return redirect()->to($path)
                ->with('message', 'Data berhasil disimpan');
        }
        return redirect()->to(previous_url())
            ->with('message', 'Data gagal disimpan')
            ->with('errors', $model->errors())
            ->withInput();
    }
    public function hapus()
    {
        $siswa_id = $this->request->getPost('siswa_id');
        $model = new SiswaModel();
        $model->where('siswa_id', $siswa_id);
        $model->delete();
        return redirect()->to(previous_url())
            ->with('message', 'Data berhasil dihapus');
    }
    public function siswa_aktif()
    {
        $model = new SiswaModel();
        $data_siswa = $model->findAktif();
        $data = [
            'title' => 'Siswa Aktif',
            'data_siswa' => $data_siswa
        ];

        return view('siswa/aktif', $data);
    }
}
