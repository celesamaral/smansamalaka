<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AbsensiMapelModel;
use App\Models\AbsensiModel;
use App\Models\DetailAbsensiMapelModel;
use App\Models\DetailabsensiModel;
use App\Models\JadwalModel;
use App\Models\KelasModel;
use App\Models\MapelModel;
use App\Models\SiswaModel;
use App\Models\TahunAjaranModel;
use App\Models\WaliKelasModel;
use Dompdf\Dompdf;
use Dompdf\Options;
use Mpdf\Mpdf;
use Mpdf\Tag\Option;

// use Dompdf\Options;

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
    public function daftar_kelas($absensi_id)
    {
        $tahunajaran = tahunajaran();
        if ($tahunajaran != null) {
            $model = new KelasModel();
            $data_kelas = $model->findKelas();

            $model = new AbsensiModel();
            $absensi = $model->find($absensi_id);

            $data = [
                'title' => 'Daftar Kelas Absensi',
                'data_kelas' => $data_kelas,
                'absensi' => $absensi,
            ];

            return view('absensi/daftar_kelas', $data);
        }
        return redirect()->to(previous_url())
            ->with('message', '<span class="text-danger">Tidak ada Tahun Ajaran yang sedang aktif!!</span>');
    }
    public function absensi_kelas($absensi_id, $kelas_id)
    {

        $model = new DetailAbsensiModel();
        $data_absensi = $model->getDetail($absensi_id, $kelas_id);
        $model = new AbsensiModel();
        $absensi = $model->find($absensi_id);

        $model = new KelasModel();
        $kelas = $model->findSingle($kelas_id);

        $data = [
            'data_absensi' => $data_absensi,
            'title' => 'Data Absensi Kelas',
            'absensi' => $absensi,
            'kelas' => $kelas
        ];

        return view('absensi/rekapan_harian', $data);
    }
    public function cetak_absensi_kelas($absensi_id, $kelas_id)
    {

        $model = new DetailAbsensiModel();
        $data_absensi = $model->getDetail($absensi_id, $kelas_id);
        $model = new AbsensiModel();
        $absensi = $model->find($absensi_id);

        $model = new KelasModel();
        $kelas = $model->findSingle($kelas_id);


        $data = [
            'data_absensi' => $data_absensi,
            'title' => 'Data Absensi Kelas',
            'absensi' => $absensi,
            'kelas' => $kelas
        ];
        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml(view('absensi/cetak_rekapan_harian', $data));
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream();
        // $mpdf = new Mpdf();
        // $mpdf->WriteHTML(view('absensi/cetak_rekapan_harian', $data));
        // $this->response->setHeader('Content-Type', 'application/pdf');
        // $mpdf->Output('arjun.pdf', 'I');
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

    //===================  ABSENSI MATA PELAJARAN =====================//

    public function absensimapel_kelas()
    {
        $model = new JadwalModel();
        $data_kelas = $model->findKelasMengajar(session('guru')->guru_id);

        $data = [
            'title' => 'Absensi Mata Pelajaran',
            'data_kelas' => $data_kelas
        ];

        return view('absensi/daftar_kelas_mapel', $data);
    }

    public function absensimapel_index($mapel_id, $kelas_id)
    {
        helper('form');
        //cek dulu apakah guru mengajar mata pelajaran di kelas ini
        $model = new JadwalModel();
        if ($model->cekGuruMengajar(guru()->guru_id, $mapel_id, $kelas_id)) {
            $model = new AbsensiMapelModel();
            $tahunajaran = tahunajaran();
            $data_absensi = $model->getAbsensiKelas($tahunajaran->tahunajaran_id, $kelas_id, $mapel_id);

            $model = new KelasModel();
            $kelas = $model->findSingle($kelas_id);

            $model = new MapelModel();
            $mapel = $model->find($mapel_id);
            $data = [
                'title' => 'Absensi Kelas',
                'data_absensi' => $data_absensi,
                'kelas' => $kelas,
                'mapel' => $mapel,
            ];

            return view('absensi/daftar_absensimapel', $data);
        }
    }

    public function store_absensimapel()
    {
        $data = $this->request->getPost();
        $model = new AbsensiMapelModel();
        if (!$model->sudahAda($data['absensimapel_tgl'], $data['kelas_id'], $data['mapel_id'])) {
            $model->insert($data);
            return redirect()->to(previous_url())
                ->with('message', 'Absensi berhasil dibuat!');
        }
        return redirect()->to(previous_url())
            ->with('message', '<span class="text-danger">Data Di Tanggal Tersebut Sudah Ada!</span>')
            ->withInput();
    }

    public function detail_mapel($absensimapel_id)
    {
        $guru = guru();
        //Find Main Absensi Mapel
        $model = new AbsensiMapelModel();
        $absensi = $model->findSingle($absensimapel_id);

        $model = new KelasModel();
        $kelas = $model->findSingle($absensi->kelas_id);
        if (!empty($kelas)) {
            helper('form');

            $model = new SiswaModel();
            $detail_absensi = $model->findAbsensiMapel($absensimapel_id, $kelas->kelas_id);
            // dd($detail_absensi);
            $data = [
                'title' => 'Absensi Kelas ' . $kelas->kelas_tingkat . ' ' . $kelas->jurusan_nama . ' ' . $kelas->kelas_abjad,
                'absensi' => $absensi,
                'detail_absensi' => $detail_absensi
            ];

            return view('absensi/detail_mapel', $data);
        }
    }
    public function cetak_detail_mapel($absensimapel_id)
    {
        $guru = guru();
        //Find Main Absensi Mapel
        $model = new AbsensiMapelModel();
        $absensi = $model->findSingle($absensimapel_id);

        $model = new KelasModel();
        $kelas = $model->findSingle($absensi->kelas_id);
        if (!empty($kelas)) {

            $model = new SiswaModel();
            $detail_absensi = $model->findAbsensiMapel($absensimapel_id, $kelas->kelas_id);
            // dd($detail_absensi);
            $data = [
                'absensi' => $absensi,
                'detail_absensi' => $detail_absensi,
                'kelas' => $kelas
            ];
            $options = new Options();
            $options->set('isRemoteEnabled', true);
            $dompdf = new Dompdf($options);
            $dompdf->loadHtml(view('absensi/cetak_detail_mapel', $data));
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();
            $dompdf->stream();
        }
    }
    public function absensimapel_absen()
    {
        $siswa_id = $this->request->getPost('siswa_id');
        $absensimapel_id = $this->request->getPost('absensimapel_id');
        $kehadiran = $this->request->getPost('kehadiran');
        $detail_absensimapel = $this->request->getPost('detail_absensimapel');

        foreach ($siswa_id as $i => $siswa) {
            $data = [
                'detailabsensimapel_id' => $detail_absensimapel[$siswa],
                'siswa_id' => $siswa,
                'detailabsensimapel_kehadiran' => $kehadiran[$siswa],
                'absensimapel_id' => $absensimapel_id
            ];

            $model = new DetailAbsensiMapelModel();
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

    public function absensimapel_rekap($mapel_id, $kelas_id)
    {
        $model = new JadwalModel();
        if ($model->cekGuruMengajar(guru()->guru_id, $mapel_id, $kelas_id)) {
            $tahunajaran = tahunajaran();
            $tahunajaran_id = $tahunajaran->tahunajaran_id;
            $model = new SiswaModel();
            $data_siswa = $model->findAllSiswa($kelas_id);

            foreach ($data_siswa as $i => $siswa) {
                $model = new AbsensiMapelModel();
                $absensi = $model->findRekapan($siswa->siswa_id, $mapel_id, $tahunajaran_id);
                $data_siswa[$i]->absensi = $absensi;
            }
            $model = new KelasModel();
            $kelas = $model->findSingle($kelas_id);

            $model = new MapelModel();
            $mapel = $model->find($mapel_id);
            $data = [
                'title' => 'Rekapan Absensi Mata Pelajaran',
                'data_siswa' => $data_siswa,
                'kelas' => $kelas,
                'mapel' => $mapel,
            ];
            return view('absensi/rekapan_mapel_guru', $data);
        }
    }
    public function cetak_absensimapel_rekap($mapel_id, $kelas_id)
    {
        $model = new JadwalModel();
        if ($model->cekGuruMengajar(guru()->guru_id, $mapel_id, $kelas_id)) {
            $tahunajaran = tahunajaran();
            $tahunajaran_id = $tahunajaran->tahunajaran_id;
            $model = new SiswaModel();
            $data_siswa = $model->findAllSiswa($kelas_id);

            foreach ($data_siswa as $i => $siswa) {
                $model = new AbsensiMapelModel();
                $absensi = $model->findRekapan($siswa->siswa_id, $mapel_id, $tahunajaran_id);
                $data_siswa[$i]->absensi = $absensi;
            }
            $model = new KelasModel();
            $kelas = $model->findSingle($kelas_id);

            $model = new MapelModel();
            $mapel = $model->findSingle($mapel_id);
            $data = [
                'title' => 'Rekapan Absensi Mata Pelajaran',
                'data_siswa' => $data_siswa,
                'kelas' => $kelas,
                'mapel' => $mapel,
            ];
            $options = new Options();
            $options->set('isRemoteEnabled', true);
            $dompdf = new Dompdf($options);
            $dompdf->loadHtml(view('absensi/cetak_rekapan_mapel_guru', $data));
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();
            $dompdf->stream();
        }
    }
}
