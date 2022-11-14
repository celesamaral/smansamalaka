<?php

namespace App\Controllers;

use App\Models\GuruModel;
use App\Models\JadwalModel;
use App\Models\KelasModel;
use App\Models\MapelModel;
use App\Models\PengumumanModel;
use App\Models\SiswaModel;
use App\Models\TahunAjaranModel;

class Home extends BaseController
{
    public function index()
    {
        if (session()->has('user')) {
            return redirect()->to(session()->get('user')->user_type);
        }
        return redirect()->to('auth/login');
    }

    public function dashboard_admin()
    {
        $model = new SiswaModel();
        $where = [
            'siswa_status' => 'aktif'
        ];
        $siswa_aktif = $model->findCount($where);

        $where = [
            'siswa_status' => 'aktif',
            'siswa_jk' => 'Laki-Laki'
        ];
        $siswa_l = $model->findCount($where);

        $where = [
            'siswa_status' => 'aktif',
            'siswa_jk' => 'Perempuan'
        ];
        $siswa_p = $model->findCount($where);

        $model = new GuruModel();
        $guru = $model->findCount();

        $data = [
            'title' => 'Dashboard',
            'siswa_aktif' => $siswa_aktif,
            'siswa_l' => $siswa_l,
            'siswa_p' => $siswa_p,
            'guru' => $guru,
        ];

        return view('dashboard_admin', $data);
    }

    public function dashboard_guru()
    {
        $model = new MapelModel();
        $where = ['guru_id' => session('guru')->guru_id];
        $mapel_ajar = $model->findCount($where);

        $model = new JadwalModel();
        $kelas_ajar = $model->findCount();

        $model = new TahunAjaranModel();
        $where = ['tahunajaran_status' => 'aktif'];
        $tahunajaran = $model->where($where)->first();

        $model = new PengumumanModel();
        $data_pengumuman = $model->where('pengumuman_status', 'tampil')->findAll();

        $data = [
            'title' => 'Dashboard',
            'mapel_ajar' => $mapel_ajar,
            'kelas_ajar' => $kelas_ajar,
            'tahunajaran' => $tahunajaran,
            'data_pengumuman' => $data_pengumuman,
        ];

        return view('dashboard_guru', $data);
    }
    public function dashboard_siswa()
    {
        $model = new TahunAjaranModel();
        $tahunajaran = $model->where('tahunajaran.tahunajaran_status', 'aktif')->first();

        $model = new PengumumanModel();
        $data_pengumuman = $model->where('pengumuman_status', 'tampil')->findAll();

        $kelas_id = siswa()->kelas_id;
        $model = new KelasModel();
        $kelas = $model->findSingle($kelas_id);

        $data = [
            'title' => 'Dashboard',
            'tahunajaran' => $tahunajaran,
            'data_pengumuman' => $data_pengumuman,
            'kelas' => $kelas
        ];

        return view('dashboard_siswa', $data);
    }
}
