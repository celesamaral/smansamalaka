<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GuruModel;
use App\Models\KelasModel;
use App\Models\WaliKelasModel;

class WaliKelas extends BaseController
{
    public function index()
    {
        helper('form');
        $model = new WaliKelasModel();
        $walikelas  = $model->findWaliKelas();

        $model = new GuruModel();
        $data_guru = $model->findAll();

        $model = new KelasModel();
        $data_kelas = $model->findKelas();
        $data = [
            'walikelas' => $walikelas,
            'title' => 'Wali Kelas',
            'data_guru' => $data_guru,
            'data_kelas' => $data_kelas
        ];

        return view('walikelas/index', $data);
    }

    public function store()
    {
        $data = $this->request->getPost();
        $model = new WaliKelasModel();
        if (!$model->cekWaliKelas($data['guru_id'], $data['kelas_id'])) {
            if ($model->insert($data))
                return redirect()->to(previous_url())
                    ->with('message', 'Data Wali Kelas Berhasil Ditambahkan');
            return redirect()->to(previous_url())
                ->with('errors', $model->errors())
                ->withInput();
        }
        return redirect()->to(previous_url())
            ->with('message', '<span class="text-danger">Data Sudah Ada!!</span>');
    }
    public function update()
    {
        $data = $this->request->getPost();

        $model = new WaliKelasModel();

        $model->save($data);

        return redirect()->to(previous_url())
            ->with('message', 'Data berhasil disimpan!');
    }

    public function delete()
    {
        $walikelas_id = $this->request->getPost('walikelas_id');
        $model = new WaliKelasModel();
        $model->where('walikelas_id', $walikelas_id);
        $model->delete();
        return redirect()->to(previous_url())
            ->with('message', 'Data Berhasil Dihapus');
    }
}
