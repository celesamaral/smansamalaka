<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AbsensiModel;
use App\Models\DetailabsensiModel;
use App\Models\SiswaModel;
use App\Models\TahunAjaranModel;
use App\Models\WaliKelasModel;

class Absensi extends BaseController
{
    public function index()
    {
        $model = new TahunAjaranModel();
        $tahunajaran = $model->where('tahunajaran_status', 'aktif')->first();
        if (!empty($tahunajaran)) {
            helper('form');
            $model = new AbsensiModel();
            $absensi = $model->findByTA($tahunajaran->tahunajaran_id);
            $data = [
                'title' => ' Absensi',
                'tahunajaran' => $tahunajaran,
                'absensi' => $absensi
            ];
            return view('absensi/index_admin', $data);
        }
        $data = [
            'title' => 'No Access'
        ];
        return view('absensi/no_ta', $data);
    }
    public function index_guru()
    {
        $model = new TahunAjaranModel();
        $tahunajaran = $model->where('tahunajaran_status', 'aktif')->first();
        if (!empty($tahunajaran)) {
            helper('form');
            $model = new AbsensiModel();
            $absensi = $model->findByTA($tahunajaran->tahunajaran_id);
            $data = [
                'title' => ' Absensi',
                'tahunajaran' => $tahunajaran,
                'absensi' => $absensi
            ];
            return view('absensi/index_guru', $data);
        }
        $data = [
            'title' => 'No Access'
        ];
        return view('absensi/no_ta', $data);
    }
    public function store()
    {
        $model = new TahunAjaranModel();
        $tahunajaran = $model->where('tahunajaran_status', 'aktif')->first();
        if (!empty($tahunajaran)) {
            $tgl = $this->request->getPost('absensi_tgl');
            $data = [
                'absensi_tgl' => $tgl,
                'tahunajaran_id' => $tahunajaran->tahunajaran_id
            ];

            $model = new AbsensiModel();

            if (!$model->exist(['absensi_tgl' => $tgl])) {
                if ($model->insert($data)) {
                    return redirect()->to(previous_url())
                        ->with('message', 'Data berhasil disimpan!');
                }
                return redirect()->to(previous_url())
                    ->with('message', '<span class="text-danger">Data gagal disimpan!</span>')
                    ->with('errors', $model->errors())
                    ->withInput();
            }
            return redirect()->to(previous_url())
                ->with('message', '<span class="text-danger">Absensi di tanggal ini sudah ada!</span>');
        }
        return redirect()->to(previous_url())
            ->with('message', '<span class="text-danger">Tidak ada Tahun ajaran aktif!</span>');
    }

    public function hapus()
    {
        $absensi_id  = $this->request->getPost('absensi_id');
        $model = new AbsensiModel();
        $model->where('absensi_id', $absensi_id);
        $model->delete();

        return redirect()->to(previous_url())
            ->with('message', 'Data berhasil dihapus');
    }

    public function detail($absensi_id)
    {
        $guru = guru();
        $model = new WaliKelasModel();
        $kelas = $model->findKelasWaliSingle($guru->guru_id);
        if (!empty($kelas)) {
            helper('form');
            $model = new AbsensiModel();
            $absensi = $model->find($absensi_id);

            $model = new SiswaModel();
            $detail_absensi = $model->findAbsensi($absensi_id, $kelas->kelas_id);
            // dd($detail_absensi);
            $data = [
                'title' => 'Absensi Kelas ' . $kelas->kelas_tingkat . ' ' . $kelas->jurusan_nama . ' ' . $kelas->kelas_abjad,
                'absensi' => $absensi,
                'detail_absensi' => $detail_absensi
            ];

            return view('absensi/detail_kelas', $data);
        }
    }

    public function absen()
    {
        $siswa_id = $this->request->getPost('siswa_id');
        $absensi_id = $this->request->getPost('absensi_id');
        $kehadiran = $this->request->getPost('kehadiran');
        $detail_absensi = $this->request->getPost('detail_absensi');

        foreach ($siswa_id as $i => $siswa) {
            $data = [
                'detailabsensi_id' => $detail_absensi[$siswa],
                'siswa_id' => $siswa,
                'detailabsensi_kehadiran' => $kehadiran[$siswa],
                'absensi_id' => $absensi_id
            ];

            $model = new DetailabsensiModel();
            if (!$model->save($data)) {
                return redirect()->to(previous_url())
                    ->with('message', 'Gagal!!')
                    ->with('errors', $model->errors())
                    ->withInput();
            }
        }
        return redirect()->to(previous_url())
            ->with('message', 'Berhasil disimpan!');
    }

    public function rekap_absen_siswa()
    {
        $siswa = siswa();
        $model = new AbsensiModel();
        $data_absensi = $model->findAbsenSiswa($siswa->siswa_id);
        $data = [
            'title' => 'Absensi',
            'data_absensi' => $data_absensi
        ];

        return view('absensi/rekapan_siswa', $data);
    }
}
