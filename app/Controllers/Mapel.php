<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GuruModel;
use App\Models\MapelModel;
use App\Models\KdModel;

class Mapel extends BaseController
{
    public function index()
    {
        helper('form');
        $model = new MapelModel();
        $data_mapel = $model->findMapel();
        $model = new GuruModel();
        $data_guru = $model->findAll();
        $data = [
            'title' => 'Mata Pelajaran',
            'data_mapel' => $data_mapel,
            'data_guru' => $data_guru
        ];

        return view('admin/mapel/index', $data);
    }

    public function index_guru()
    {
        $guru_id = session()->get('guru')->guru_id;
        $model = new MapelModel();
        $data_mapel = $model->where('guru_id', $guru_id)->findAll();
        $data = [
            'title' => 'Mata Pelajaran',
            'data_mapel' => $data_mapel
        ];
        return view('guru/mapel/index', $data);
    }



    public function store_mapel()
    {
        $data = $this->request->getPost();
        $model = new MapelModel();
        if ($model->insert($data)) {
            return redirect()->to('admin/mapel')
                ->with('message', 'Data berhasil disimpan!');
        }
        return redirect()->to(previous_url())
            ->with('message', 'Data gagal ditambahkan')
            ->with('errors', $model->errors())
            ->withInput();
    }

    public function update_mapel()
    {
        $mapel_id = $this->request->getPost('mapel_id');
        $data = $this->request->getPost();
        $model = new MapelModel();
        if ($model->update($mapel_id, $data)) {
            return redirect('admin/mapel')
                ->with('message', 'Data berhasil disimpan');
        }
        return redirect()->to(previous_url())
            ->with('message', 'Gagal menyimpan data')
            ->with('errors', $model->errors())
            ->withInput();
    }

    public function hapus_mapel()
    {
        $mapel_id = $this->request->getPost('mapel_id');
        $model = new MapelModel();
        $model->where('mapel_id', $mapel_id);
        $model->delete();

        return redirect('admin/mapel')
            ->with('message', 'Data berhasil dihapus');
    }

    public function kd($mapel_id)
    {
        helper('form');
        $model = new KdModel();
        $data_kd = $model->getKD($mapel_id);
        $model = new MapelModel();
        $mapel = $model->find($mapel_id);

        $data = [
            'title' => 'Kompetensi Dasar',
            'mapel' => $mapel,
            'data_kd' => $data_kd
        ];
        return view('guru/mapel/kd_index', $data);
    }

    public function store_kd()
    {
        $data = $this->request->getPost();
        $model = new KdModel();

        if ($model->insert($data)) {
            return redirect()->to(previous_url())
                ->with('message', 'Data berhasil disimpan');
        }
        return redirect()->to(previous_url())
            ->with('message', 'Data gagal disimpan')
            ->with('errors', $model->errors())
            ->withInput();
    }

    public function update_kd()
    {
        $data = $this->request->getPost();
        $kd_id = $this->request->getPost('kd_id');

        $model = new KdModel();
        if ($model->update($kd_id, $data)) {
            return redirect()->to(previous_url())
                ->with('message', 'data berhasil disimpan');
        }
        return redirect()->to(previous_url())
            ->with('message', 'Data gagal disimpan')
            ->with('errors', $model->errors())
            ->withInput();
    }

    public function hapus_kd()
    {
        $kd_id = $this->request->getPost('kd_id');

        $model = new KdModel();
        $model->delete($kd_id);

        return redirect()->to(previous_url())
            ->with('message', 'data berhasil dihapus');
    }
}
