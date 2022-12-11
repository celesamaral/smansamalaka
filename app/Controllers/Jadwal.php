<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\HariModel;
use App\Models\JadwalModel;
use App\Models\KelasModel;
use App\Models\MapelModel;
use App\Models\TahunAjaranModel;
use Dompdf\Dompdf;
use Dompdf\Options;

class Jadwal extends BaseController
{
    public function index($kelas_id = null)
    {
        helper('form');
        if ($kelas_id != null) {
            $model = new JadwalModel();
            $data_jadwal = $model->findJadwal($kelas_id);

            $model = new HariModel();
            $data_hari = $model->findAll();

            $model = new KelasModel();
            $kelas = $model->findSingle($kelas_id);

            $model = new MapelModel();
            $data_mapel = $model->findMapelKelas($kelas);
            $data = [
                'data_jadwal' => $data_jadwal,
                'title' => 'Jadwal Pelajaran ' . $kelas->kelas_tingkat . ' ' . $kelas->jurusan_nama . ' ' . $kelas->kelas_abjad,
                'hari' => $data_hari,
                'data_mapel' => $data_mapel,
                'kelas' => $kelas
            ];

            return view('jadwal/index', $data);
        }

        $model = new KelasModel();
        $data_kelas = $model->findKelas();
        $data = [
            'title' => 'Jadwal Pelajaran',
            'data_kelas' => $data_kelas
        ];
        return view('jadwal/index_kelas', $data);
    }

    public function cetak($kelas_id)
    {
        $model = new JadwalModel();
        $data_jadwal = $model->findJadwal($kelas_id);

        $model = new HariModel();
        $data_hari = $model->findAll();

        $model = new KelasModel();
        $kelas = $model->findSingle($kelas_id);

        $model = new MapelModel();
        $data_mapel = $model->findMapelKelas($kelas);
        $data = [
            'data_jadwal' => $data_jadwal,
            'title' => 'Jadwal Pelajaran ' . $kelas->kelas_tingkat . ' ' . $kelas->jurusan_nama . ' ' . $kelas->kelas_abjad,
            'hari' => $data_hari,
            'data_mapel' => $data_mapel,
            'kelas' => $kelas
        ];
        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml(view('jadwal/cetak_jadwal', $data));
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream();
    }

    public function store()
    {
        $data = $this->request->getPost();
        $model = new JadwalModel();

        if ($model->insert($data)) {
            return redirect()->to(previous_url())
                ->with('message', 'Data berhasil ditambahkan!');
        }
        dd($model->errors());
        return redirect()->to(previous_url())
            ->with('message', 'Data gagal ditambahkan')
            ->with('errors', $model->errors())
            ->withInput();
    }
    public function update()
    {
        $jadwal_id = $this->request->getPost('jadwal_id');
        $data = $this->request->getPost();
        $model = new JadwalModel();

        if ($model->update($jadwal_id, $data)) {
            return redirect()->to(previous_url())
                ->with('message', 'Data berhasil disimpan!');
        }
        return redirect()->to(previous_url())
            ->with('message', 'Data gagal disimpan')
            ->with('errors', $model->errors())
            ->withInput();
    }

    public function hapus()
    {
        $jadwal_id = $this->request->getPost('jadwal_id');
        $model = new JadwalModel();
        $model->where('jadwal_id', $jadwal_id);
        $model->delete();

        return redirect()->to(previous_url())
            ->with('message', 'Data terhapus');
    }

    public function bersihkan()
    {
        //Cek Apakah Tahun Ajaran ada yang aktif.
        $model = new TahunAjaranModel();
        $model->where('tahunajaran_status', 'aktif');
        $ta = $model->first();

        if (!empty($ta)) {
            return redirect()->to(previous_url())
                ->with('message', 'Tahun Ajaran Sedang Aktif. Tidak dapat membersihkan Jadwal');
        }
        $model = new JadwalModel();
        $model->truncate();
        return redirect()->to(previous_url())
            ->with('message', 'Data terhapus');
    }

    public function jadwal_kelas()
    {
        $kelas_id = session('siswa')->kelas_id;
        $model = new HariModel();
        $data_hari = $model->findAll();

        $model = new JadwalModel();

        foreach ($data_hari as $i => $hari) {
            $data_jadwal = $model->findJadwal($kelas_id, $hari->hari_nama);
            $data_hari[$i]->jadwal = $data_jadwal;
        }


        $data = [
            'title' => 'Jadwal Pelajaran',
            'data_hari' => $data_hari
        ];

        return view('jadwal/index_siswa', $data);
    }

    public function cetak_jadwal_kelas()
    {
        $kelas_id = session('siswa')->kelas_id;
        $model = new HariModel();
        $data_hari = $model->findAll();

        $model = new JadwalModel();

        foreach ($data_hari as $i => $hari) {
            $data_jadwal = $model->findJadwal($kelas_id, $hari->hari_nama);
            $data_hari[$i]->jadwal = $data_jadwal;
        }

        $data = [
            'title' => 'Jadwal Pelajaran',
            'data_hari' => $data_hari
        ];
        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml(view('jadwal/cetak_jadwal_kelas', $data));
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream();
    }

    public function jadwal_guru()
    {
        $guru_id = session('guru')->guru_id;

        $model = new JadwalModel();
        $data_jadwal = $model->findJadwalGuru($guru_id);

        $data = [
            'title' => 'Jadwal Mengajar',
            'data_jadwal' => $data_jadwal
        ];

        return view('jadwal/index_guru', $data);
    }
    public function cetak_jadwal_guru()
    {
        $guru_id = session('guru')->guru_id;

        $model = new JadwalModel();
        $data_jadwal = $model->findJadwalGuru($guru_id);

        $data = [
            'title' => 'Jadwal Mengajar',
            'data_jadwal' => $data_jadwal
        ];

        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml(view('jadwal/cetak_jadwal_guru', $data));
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream();
    }
}
