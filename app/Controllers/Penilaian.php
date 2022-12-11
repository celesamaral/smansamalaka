<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\JadwalModel;
use App\Models\KdModel;
use App\Models\KelasModel;
use App\Models\MapelModel;
use App\Models\NilaisiswaModel;
use App\Models\SiswaModel;
use App\Models\TahunAjaranModel;
use Dompdf\Dompdf;
use Dompdf\Options;

class Penilaian extends BaseController
{
    public function index()
    {
        $model = new JadwalModel();
        $data_kelas = $model->findKelasMengajar(session('guru')->guru_id);

        $data = [
            'title' => 'Daftar Kelas Yang diajar.',
            'data_kelas' => $data_kelas
        ];

        return view('guru/penilaian/index', $data);
    }
    public function kelas($kelas_id, $mapel_id)
    {
        helper('form');
        $model =  new KelasModel();
        $kelas = $model->findSingle($kelas_id);

        $model = new MapelModel();
        $mapel = $model->find($mapel_id);

        $model = new KdModel();
        $data_kd = $model->getKD($mapel_id);


        // $model = new SiswaModel();
        // $data_siswa = $model->findAllSiswa($kelas_id);

        $data = [
            'title' => 'Penilaian Kelas ' . $kelas->kelas_tingkat . ' ' . $kelas->jurusan_nama . ' ' . $kelas->kelas_abjad . ' | ' . $mapel->mapel_nama,
            'kelas' => $kelas,
            // 'data_siswa' => $data_siswa,
            'mapel' => $mapel,
            'data_kd' => $data_kd
        ];

        return view('guru/penilaian/kd', $data);
    }

    public function penilaian()
    {
        $data = $this->request->getPost();

        $model = new KdModel();
        $kd = $model->find($data['kd_id']);

        $model = new MapelModel();
        $mapel = $model->find($data['mapel_id']);

        $model = new KelasModel();
        $kelas = $model->findSingle($data['kelas_id']);

        $model = new TahunAjaranModel();
        $tahunajaran = $model->where('tahunajaran.tahunajaran_status', 'aktif')->first();

        if (!empty($tahunajaran)) {
            helper('form');
            $model = new SiswaModel();
            $where = [
                'nilaisiswa.kd_id' => $data['kd_id'],
                'siswa.kelas_id' => $data['kelas_id'],
                'nilaisiswa.tahunajaran_id' => $tahunajaran->tahunajaran_id
            ];
            $nilai = $model->findAllNilai($kd->kd_id, $tahunajaran->tahunajaran_id, $kelas->kelas_id, $kd->kd_jenis);
            // dd($nilai);
            $data = [
                'title' => 'Penilaian Kelas ' . $kelas->kelas_tingkat . ' ' . $kelas->jurusan_nama . ' ' . $kelas->kelas_abjad . ' | ' . $mapel->mapel_nama,
                'kd' => $kd,
                'kelas' => $kelas,
                'tahunajaran' => $tahunajaran,
                'nilaisiswa' => $nilai
            ];

            return view('guru/penilaian/penilaian', $data);
        }
        return redirect()->to(previous_url())
            ->with('message', '<span class="text-danger">Tidak dapat melakukan penilaian saat tahun ajaran belum aktif!</span>"');
    }

    public function store()
    {
        $kd_id = $this->request->getPost('kd_id');
        // $nilaisiswa_jenis = $this->request->getPost('jenis');
        $model = new KdModel();
        $kd = $model->find($kd_id);
        $siswa_id = $this->request->getPost('siswa_id');
        $model = new TahunAjaranModel();
        $tahunajaran = $model->where('tahunajaran.tahunajaran_status', 'aktif')->first();
        $gagal = [];
        if (!empty($tahunajaran)) {
            $kelas_id = $this->request->getPost('kelas_id');
            $tahunajaran_id = $tahunajaran->tahunajaran_id;
            $nilaisiswa = $this->request->getPost('nilaisiswa');
            $nilaisiswa_id = $this->request->getPost('nilaisiswa_id');
            foreach ($siswa_id as $key => $siswa) {
                $model = new NilaisiswaModel();
                if ($kd_id != null && $kd_id == 'uas') {
                    $data = [
                        'nilaisiswa_id' => $nilaisiswa_id[$key],
                        'nilaisiswa_jenis' => 'uas',
                        'nilaisiswa_nilai' => $nilaisiswa[$key],
                        'siswa_id' => $siswa,
                        'tahunajaran_id' => $tahunajaran_id
                    ];
                    if (!$model->save($data)) {
                        $model = new SiswaModel();
                        array_push($gagal, ['siswa' => $model->find($siswa)]);
                    }
                } elseif ($kd_id != null && $kd_id == 'uts') {
                    $data = [
                        'nilaisiswa_id' => $nilaisiswa_id[$key],
                        'nilaisiswa_jenis' => 'uts',
                        'nilaisiswa_nilai' => $nilaisiswa[$key],
                        'siswa_id' => $siswa,
                        'tahunajaran_id' => $tahunajaran_id
                    ];
                    if (!$model->save($data)) {
                        $model = new SiswaModel();
                        array_push($gagal, ['siswa' => $model->find($siswa)]);
                    }
                } elseif ($kd_id != null) {
                    $data = [
                        'nilaisiswa_id' => $nilaisiswa_id[$key],
                        'nilaisiswa_jenis' => $this->request->getPost('nilaisiswa_jenis'),
                        'nilaisiswa_nilai' => $nilaisiswa[$key],
                        'siswa_id' => $siswa,
                        'kd_id' => $kd_id,
                        'tahunajaran_id' => $tahunajaran_id
                    ];
                    if (!$model->save($data)) {
                        $model = new SiswaModel();
                        array_push($gagal, ['siswa' => $siswa]);
                    }
                }
            }
            // dd($gagal);
            return redirect()->to('guru/penilaian/' . $kelas_id . '/' . $kd->mapel_id)
                ->with('message', 'Nilai Tersimpan')
                ->with('gagal', $gagal);
        }
        return redirect()->to(previous_url())
            ->with('message', 'Tidak dapat melakukan penilaian. Tahun ajaran belum aktif.');
    }
    public function get_nilaii()
    {
        $content = trim(file_get_contents("php://input"));

        $data = json_decode($content, true);

        $model = new TahunAjaranModel();
        $tahunajaran = $model->where('tahunajaran.tahunajaran_status', 'aktif')->first();
        if (!empty($tahunajaran)) {
            $model = new SiswaModel();
            // $where = [
            //     'nilaisiswa.kd_id' => $data['kd_id'],
            //     'siswa.kelas_id' => $data['kelas_id'],
            //     'nilaisiswa.nilaisiswa_jenis' => $data['nilaisiswa_jenis'],
            //     'nilaisiswa.tahunajaran_id' => $tahunajaran->tahunajaran_id
            // ];
            $nilaisiswa = $model->findAllNilai($data['kd_id'], $tahunajaran->tahunajaran_id, $data['kelas_id'], $data['nilaisiswa_jenis']);


            $form = '<table class="table table-stripped">
                        <thead>
                            <tr>
                                <th>Nama Siswa</th>
                                <th>Nilai</th>
                            </tr>
                        </thead>
                        <tbody>';


            foreach ($nilaisiswa as $i => $nilai) {
                $form .= '<tr>';
                $form .= '<td>' . $nilai->siswa_nama . '</td>';
                $form .= '<td style="width:20%;">';
                $form .= '<input type="hidden" name="nilaisiswa_id[]" value="' . $nilai->nilaisiswa_id . '">';
                $form .= '<input type="hidden" name="siswa_id[]" value="' . $nilai->siswa_id . '">';
                $form .= '<input type="number" step=".1" name="nilaisiswa[]" id="" class="form-control" value="' . $nilai->nilaisiswa_nilai . '">';
                $form .= '</td></tr>';
            }
            $form .= '</tbody>
                    </table>
                    <button type="submit" class="btn btn-primary">Simpan</button>';
            $out['form'] = $form;
            echo json_encode($out);
        }
    }
    public function daftar_siswa()
    {
        helper('form');
        $model = new SiswaModel();
        $data_siswa = $model->findAktif();

        $data = [
            'title' => 'Nilai Siswa Aktif',
            'data_siswa' => $data_siswa
        ];

        return view('admin/nilai/daftar_siswa', $data);
    }
    public function rekapan($kelas_id, $mapel_id)
    {
        helper('form');
        $guru_id = session('guru')->guru_id;

        $model = new MapelModel();
        $mapel = $model->find($mapel_id);

        $model = new KelasModel();
        $kelas = $model->findSingle($kelas_id);

        if (!empty($mapel) && $mapel->guru_id == $guru_id) {
            $model = new TahunAjaranModel();
            $tahunajaran = $model->where('tahunajaran_status', 'aktif')->first();
            if (!empty($tahunajaran)) {
                $model = new KdModel();
                $data_kd = $model->getKDOnly($mapel_id);
                $uts = $model->getUTS($mapel_id);
                $uas = $model->getUAS($mapel_id);
                $akhir = $model->getNilaiAkhir($mapel->mapel_id);
                $nilai_uas = 0;
                $nilai_uts = 0;
                $nilai_akhir = 0;
                $model = new SiswaModel();
                $data_siswa = $model->where('kelas_id', $kelas_id)->find();

                foreach ($data_siswa as $i => $siswa) {
                    $model = new NilaisiswaModel();
                    if (!empty($uas)) {
                        $nilai_uas = $model->getNilai($siswa->siswa_id, $uas->kd_id, $tahunajaran->tahunajaran_id);
                    }
                    if (!empty($uts)) {
                        $nilai_uts = $model->getNilai($siswa->siswa_id, $uts->kd_id, $tahunajaran->tahunajaran_id);
                    }
                    if (!empty($akhir)) {
                        $nilai_akhir = $model->getNilai($siswa->siswa_id, $akhir->kd_id, $tahunajaran->tahunajaran_id);
                    }
                    foreach ($data_kd as $j => $kd) {
                        $nilaisiswa = $model->getNilaiSiswa($siswa->siswa_id, $kd->kd_id, $tahunajaran->tahunajaran_id);
                        $data_siswa[$i]->nilai[$j] = $nilaisiswa;
                    }


                    $data_siswa[$i]->akhir = $nilai_akhir;
                    $data_siswa[$i]->uas = $nilai_uas;
                    $data_siswa[$i]->uts = $nilai_uts;
                }

                $data = [
                    'title' => 'Rekapan Penilaian',
                    'mapel' => $mapel,
                    'data_kd' => $data_kd,
                    'data_siswa' => $data_siswa,
                    'kelas' => $kelas
                ];
                return view('guru/penilaian/rekapan', $data);
            }
            // dd('halo');
        }
    }
    public function cetak_rekapan($kelas_id, $mapel_id)
    {
        $guru_id = session('guru')->guru_id;

        $model = new MapelModel();
        $mapel = $model->find($mapel_id);

        $model = new KelasModel();
        $kelas = $model->findSingle($kelas_id);

        if (!empty($mapel) && $mapel->guru_id == $guru_id) {
            $model = new TahunAjaranModel();
            $tahunajaran = $model->where('tahunajaran_status', 'aktif')->first();
            if (!empty($tahunajaran)) {
                $model = new KdModel();
                $data_kd = $model->getKDOnly($mapel_id);
                $uts = $model->getUTS($mapel_id);
                $uas = $model->getUAS($mapel_id);
                $akhir = $model->getNilaiAkhir($mapel->mapel_id);
                $nilai_uas = 0;
                $nilai_uts = 0;
                $nilai_akhir = 0;
                $model = new SiswaModel();
                $data_siswa = $model->where('kelas_id', $kelas_id)->find();

                foreach ($data_siswa as $i => $siswa) {
                    $model = new NilaisiswaModel();
                    if (!empty($uas)) {
                        $nilai_uas = $model->getNilai($siswa->siswa_id, $uas->kd_id, $tahunajaran->tahunajaran_id);
                    }
                    if (!empty($uts)) {
                        $nilai_uts = $model->getNilai($siswa->siswa_id, $uts->kd_id, $tahunajaran->tahunajaran_id);
                    }
                    if (!empty($akhir)) {
                        $nilai_akhir = $model->getNilai($siswa->siswa_id, $akhir->kd_id, $tahunajaran->tahunajaran_id);
                    }
                    foreach ($data_kd as $j => $kd) {
                        $nilaisiswa = $model->getNilaiSiswa($siswa->siswa_id, $kd->kd_id, $tahunajaran->tahunajaran_id);
                        $data_siswa[$i]->nilai[$j] = $nilaisiswa;
                    }


                    $data_siswa[$i]->akhir = $nilai_akhir;
                    $data_siswa[$i]->uas = $nilai_uas;
                    $data_siswa[$i]->uts = $nilai_uts;
                }

                $data = [
                    'title' => 'Rekapan Penilaian',
                    'mapel' => $mapel,
                    'data_kd' => $data_kd,
                    'data_siswa' => $data_siswa,
                    'kelas' => $kelas
                ];
                $options = new Options();
                $options->set('isRemoteEnabled', true);
                $dompdf = new Dompdf($options);
                $dompdf->loadHtml(view('guru/penilaian/cetak_rekapan', $data));
                $dompdf->setPaper('A4', 'portrait');
                $dompdf->render();
                $dompdf->stream();
            }
            // dd('halo');
        }
    }
    public function hitung_nilai()
    {
        $kelas_id = $this->request->getPost('kelas_id');
        $mapel_id = $this->request->getPost('mapel_id');
        $guru_id = session('guru')->guru_id;

        $model = new MapelModel();
        $mapel = $model->find($mapel_id);

        $model = new KelasModel();
        $kelas = $model->findSingle($kelas_id);

        if (!empty($mapel) && $mapel->guru_id == $guru_id) {
            $model = new TahunAjaranModel();
            $tahunajaran = $model->where('tahunajaran_status', 'aktif')->first();
            if (!empty($tahunajaran)) {
                $model = new KdModel();
                $data_kd = $model->getKDOnly($mapel_id);
                $uts = $model->getUTS($mapel_id);
                $uas = $model->getUAS($mapel_id);
                $akhir = $model->getNilaiAkhir($mapel->mapel_id);
                $nilai_uas = 0;
                $nilai_uts = 0;
                $model = new SiswaModel();
                $data_siswa = $model->where('kelas_id', $kelas_id)->find();

                foreach ($data_siswa as $i => $siswa) {

                    $nilai_kd = 0;
                    $model = new NilaisiswaModel();
                    if (!empty($uas)) {
                        $nilai_uas = $model->getNilai($siswa->siswa_id, $uas->kd_id, $tahunajaran->tahunajaran_id);
                    }
                    if (!empty($uts)) {
                        $nilai_uts = $model->getNilai($siswa->siswa_id, $uts->kd_id, $tahunajaran->tahunajaran_id);
                    }

                    foreach ($data_kd as $j => $kd) {
                        $nilaisiswa = $model->getNilaiSiswa($siswa->siswa_id, $kd->kd_id, $tahunajaran->tahunajaran_id);
                        $nilai_kd += ($nilaisiswa->tugas1 + $nilaisiswa->tugas2 + $nilaisiswa->ulangan1 + $nilaisiswa->ulangan2) / 4;
                    }
                    $nilai_kd = ($nilai_kd / 4);
                    $total = ($nilai_kd + $nilai_uts + $nilai_uas) / 3;

                    $data = [
                        'kd_id' => $akhir->kd_id,
                        'nilaisiswa_jenis' => 'na',
                        'siswa_id' => $siswa->siswa_id,
                        'tahunajaran_id' => $tahunajaran->tahunajaran_id
                    ];
                    $nilaisiswa = $model->cekNilai($data);
                    if (!empty($nilaisiswa)) {
                        $data['nilaisiswa_nilai'] = $total;
                        $model->update($nilaisiswa->nilaisiswa_id, $data);
                    } else {
                        $data['nilaisiswa_nilai'] = $total;
                        $model->insert($data);
                    }
                }
                return redirect()->to(previous_url())
                    ->with('message', 'Berhasil Menghitung Nilai!');
            }
            // dd('halo');
        }
    }
    public function rekapan_siswa($siswa_id = null)
    {
        helper('form');
        if (session('user')->user_type == 'siswa') {
            $siswa_id = session('siswa')->siswa_id;
        } else {
            $model = new SiswaModel();
            $siswa = $model->find($siswa_id);
        }
        $model = new SiswaModel();
        $siswa = $model->find($siswa_id);
        $model = new TahunAjaranModel();
        $tahunajaran = $model->where('tahunajaran_status', 'aktif')->first();
        $model = new MapelModel();
        $data_mapel = $model->findMapelSiswa($siswa_id, $tahunajaran->tahunajaran_id);
        foreach ($data_mapel as $i => $mapel) {
            $model = new KdModel();

            $data_kd  = $model->getKDOnly($mapel->mapel_id);
            $uts = $model->getUTS($mapel->mapel_id);
            $uas = $model->getUAS($mapel->mapel_id);
            $akhir = $model->getNilaiAkhir($mapel->mapel_id);
            $nilai_uas = 0;
            $nilai_uts = 0;
            $nilai_akhir = 0;

            $model = new NilaisiswaModel();
            if (!empty($uas)) {
                $nilai_uas = $model->getNilai($siswa_id, $uas->kd_id, $tahunajaran->tahunajaran_id);
            }
            if (!empty($uts)) {
                $nilai_uts = $model->getNilai($siswa_id, $uts->kd_id, $tahunajaran->tahunajaran_id);
            }
            if (!empty($akhir)) {
                $nilai_akhir = $model->getNilai($siswa->siswa_id, $akhir->kd_id, $tahunajaran->tahunajaran_id);
            }
            $data_mapel[$i]->akhir = $nilai_akhir;
            $data_mapel[$i]->uas = $nilai_uas;
            $data_mapel[$i]->uts = $nilai_uts;

            foreach ($data_kd as $j => $kd) {
                $nilai = $model->getNilaiSiswa($siswa_id, $kd->kd_id, $tahunajaran->tahunajaran_id);
                $data_mapel[$i]->nilai[$j] = $nilai;
            }
        }
        // dd($data_mapel);
        $data = [
            'title' => 'Rekapan Penilaian Siswa',
            'data_mapel' => $data_mapel,
            'tahunajaran' => $tahunajaran,
            'siswa' => $siswa
        ];
        return view('nilai/nilai_siswa', $data);
    }

    public function cetak_nilai()
    {
        $siswa_id = $this->request->getPost('siswa_id');
        $model = new SiswaModel();
        $siswa = $model->find($siswa_id);
        $model = new TahunAjaranModel();
        $tahunajaran = $model->where('tahunajaran_status', 'aktif')->first();
        $model = new MapelModel();
        $data_mapel = $model->findMapelSiswa($siswa_id, $tahunajaran->tahunajaran_id);
        foreach ($data_mapel as $i => $mapel) {
            $model = new KdModel();
            $data_kd = $model->getKDOnly($mapel->mapel_id);
            $uts = $model->getUTS($mapel->mapel_id);
            $uas = $model->getUAS($mapel->mapel_id);
            $akhir = $model->getNilaiAkhir($mapel->mapel_id);
            $nilai_uas = 0;
            $nilai_uts = 0;
            $nilai_akhir = 0;

            $model = new NilaisiswaModel();

            if (!empty($uas)) {
                $nilai_uas = $model->getNilai($siswa_id, $uas->kd_id, $tahunajaran->tahunajaran_id);
            }
            if (!empty($uts)) {
                $nilai_uts = $model->getNilai($siswa_id, $uts->kd_id, $tahunajaran->tahunajaran_id);
            }
            if (!empty($akhir)) {
                $nilai_akhir = $model->getNilai($siswa_id, $akhir->kd_id, $tahunajaran->tahunajaran_id);
            }

            $data_mapel[$i]->uas = $nilai_uas;
            $data_mapel[$i]->uts = $nilai_uts;
            $data_mapel[$i]->akhir = $nilai_akhir;

            foreach ($data_kd as $j => $kd) {
                $nilai = $model->getNilaiSiswa($siswa_id, $kd->kd_id, $tahunajaran->tahunajaran_id);
                $data_mapel[$i]->nilai[$j] = $nilai;
            }
        }
        // dd($data_mapel);
        $data = [
            'data_mapel' => $data_mapel,
            'tahunajaran' => $tahunajaran,
            'siswa' => $siswa
        ];
        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml(view('nilai/cetak_nilai', $data));
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream();
        // return view('nilai/cetak_nilai', $data);
    }

    public function riwayat_nilai($tahunajaran_id = null)
    {
        helper('form');
        $model = new SiswaModel();
        $siswa = $model->find(session('siswa')->siswa_id);

        $model = new TahunAjaranModel();
        if ($tahunajaran_id == null) {
            $tahunajaran = $model->where('tahunajaran_status !=', 'aktif', true)->findAll();

            $data = [
                'title' => 'Pilih Tahun Ajaran',
                'tahunajaran' => $tahunajaran
            ];
            return view('nilai/tahunajaran', $data);
        }

        $siswa_id = session('siswa')->siswa_id;
        $model = new MapelModel();
        $data_mapel = $model->findMapelSiswa($siswa_id, $tahunajaran_id);
        $model = new TahunAjaranModel();
        $tahunajaran = $model->find($tahunajaran_id);
        foreach ($data_mapel as $i => $mapel) {
            $model = new KdModel();
            $data_kd = $model->getKDOnly($mapel->mapel_id);
            $uts = $model->getUTS($mapel->mapel_id);
            $uas = $model->getUAS($mapel->mapel_id);
            $akhir = $model->getNilaiAkhir($mapel->mapel_id);
            $nilai_uas = 0;
            $nilai_uts = 0;
            $nilai_akhir = 0;

            $model = new NilaisiswaModel();

            if (!empty($uas)) {
                $nilai_uas = $model->getNilai($siswa_id, $uas->kd_id, $tahunajaran_id);
            }
            if (!empty($uts)) {
                $nilai_uts = $model->getNilai($siswa_id, $uts->kd_id, $tahunajaran_id);
            }
            if (!empty($akhir)) {
                $nilai_akhir = $model->getNilai($siswa_id, $akhir->kd_id, $tahunajaran_id);
            }

            $data_mapel[$i]->uas = $nilai_uas;
            $data_mapel[$i]->uts = $nilai_uts;
            $data_mapel[$i]->akhir = $nilai_akhir;

            foreach ($data_kd as $j => $kd) {
                $model = new NilaisiswaModel();
                $nilai = $model->getNilaiSiswa($siswa_id, $kd->kd_id, $tahunajaran_id);
                $data_mapel[$i]->nilai[$j] = $nilai;
            }
        }
        $data = [
            'title' => 'Nilai Mata Pelajaran ',
            'data_mapel' => $data_mapel,
            'tahunajaran' => $tahunajaran,
            'siswa' => $siswa
        ];

        return view('nilai/nilai_siswa', $data);
    }
}
