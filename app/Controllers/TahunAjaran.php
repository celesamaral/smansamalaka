<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TahunAjaranModel;

class TahunAjaran extends BaseController
{
    public function index()
    {
        helper('form');
        $model = new TahunAjaranModel();
        $data_ta = $model->findAll();

        $data = [
            'title' => 'Tahun Ajaran',
            'data_ta' => $data_ta
        ];

        return view('tahunajaran/index', $data);
    }

    public function store()
    {
        $data = $this->request->getPost();
        $model = new TahunAjaranModel();
        if ($model->insert($data)) {
            return redirect()->to(previous_url())
                ->with('message', 'Data berhasil ditambahkan');
        }
        return redirect()->to(previous_url())
            ->with('message', 'Data gagal ditambahkan!!')
            ->with('errors', $model->errors())
            ->withInput();
    }

    public function update()
    {
        $tahunajaran_id = $this->request->getPost('tahunajaran_id');
        $data = $this->request->getPost();
        $model = new TahunAjaranModel();
        if ($model->update($tahunajaran_id, $data)) {
            return redirect()->to(previous_url())
                ->with('message', 'Data berhasil disimpan');
        }
        return redirect()->to(previous_url())
            ->with('message', 'Data gagal disimpan!!')
            ->with('errors', $model->errors())
            ->withInput();
    }

    public function ubah_status()
    {
        $tahunajaran_id = $this->request->getPost('tahunajaran_id');

        $status = $this->request->getPost('status');

        if ($status == 'aktifkan') {
            $data['tahunajaran_status'] = 'aktif';
        } elseif ($status == 'nonaktifkan') {
            $data['tahunajaran_status'] = 'nonaktif';
        } elseif ($status == 'selesai') {
            $data['tahunajaran_status'] = 'selesai';
        }
        $model = new TahunAjaranModel();
        if ($model->update($tahunajaran_id, $data)) {
            return redirect()->to(previous_url())
                ->with('message', 'Data berhasil disimpan');
        }
        return redirect()->to(previous_url())
            ->with('message', 'Data gagal disimpan!!')
            ->with('errors', $model->errors())
            ->withInput();
    }
}
