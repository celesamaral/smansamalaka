<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PengumumanModel;

class Pengumuman extends BaseController
{
    public function index()
    {
        helper('form');
        $model = new PengumumanModel();
        if (session('user')->user_type == 'admin') {
            $data_pengumuman = $model->findAll();
        } else {
            $data_pengumuman = $model->findPengumuman('tampil');
        }

        $data = [
            'title' => 'Pengumuman',
            'data_pengumuman' => $data_pengumuman
        ];
        // dd($data_pengumuman);
        return view('pengumuman/index', $data);
    }

    public function store()
    {
        $data = $this->request->getPost();
        $data['pengumuman_tgl'] = date('Y-m-d');
        $data['pengumuman_status'] = 'tampil';

        $model = new PengumumanModel();
        if ($model->insert($data)) {
            return redirect()->to(previous_url())
                ->with('message', 'Pengumuman berhasil disimpan!');
        }
        return redirect()->to(previous_url())
            ->with('message', 'Pengumuman gagal disimpan')
            ->with('errors', $model->errors())
            ->withInput();
    }

    public function edit($pengumuman_id)
    {
        helper('form');
        $model = new PengumumanModel();
        $pengumuman = $model->find($pengumuman_id);

        $data = [
            'title' => 'Edit Pengumuman',
            'pengumuman' => $pengumuman
        ];

        return view('pengumuman/edit', $data);
    }

    public function update()
    {
        $data = $this->request->getPost();

        $model = new PengumumanModel();
        $model->save($data);

        return redirect()->to(previous_url())
            ->with('message', 'Pengumuman berhasil diupdate!');
    }

    public function drop()
    {
        $pengumuman_id = $this->request->getPost('pengumuman_id');

        $model = new PengumumanModel();
        $model->update($pengumuman_id, ['pengumuman_status' => 'no tampil']);

        return redirect()->to(previous_url())
            ->with('message', 'Pengumuman dropped!');
    }

    public function tampilkan()
    {
        $pengumuman_id = $this->request->getPost('pengumuman_id');

        $model = new PengumumanModel();
        $model->update($pengumuman_id, ['pengumuman_status' => 'tampil']);

        return redirect()->to(previous_url())
            ->with('message', 'Pengumuman ditampilkan!');
    }

    public function delete()
    {
        $pengumuman_id = $this->request->getPost('pengumuman_id');

        $model = new PengumumanModel();

        $model->where('pengumuman_id', $pengumuman_id);
        $model->delete();

        return redirect()->to(previous_url())
            ->with('message', 'Pengumuman terhapus');
    }
}
