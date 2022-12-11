<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KelasModel;
use App\Models\JurusanModel;
use App\Models\SiswaModel;
use App\Models\UserModel;
use Dompdf\Dompdf;
use Dompdf\Options;

class Kelas extends BaseController
{
    public function jurusan()
    {
        helper('form');
        $model = new JurusanModel();
        $data = [
            'title' => 'Jurusan',
            'data_jurusan' => $model->findAll()
        ];
        return view('admin/jurusan/index', $data);
    }
    public function store_jurusan()
    {
        $data = $this->request->getPost();
        $model = new JurusanModel();
        if ($model->insert($data)) {
            return redirect()->to('admin/jurusan')
                ->with('message', 'Data berhasil tersimpan');
        }
        return redirect()->to(previous_url())
            ->with('message', 'Data gagal disimpan')
            ->with('errors', $model->errors())
            ->withInput();
    }

    public function edit_jurusan($jurusan_id)
    {
        $model = new JurusanModel();
        $jurusan = $model->find($jurusan_id);
        $data = [
            'title' => 'Edit Jurusan',
            'jurusan' => $jurusan
        ];

        return view('admin/jurusan/edit', $data);
    }

    public function update_jurusan()
    {
        $jurusan_id = $this->request->getPost('jurusan_id');
        $data = $this->request->getPost();
        $model = new JurusanModel();
        if ($model->update($jurusan_id, $data)) {
            return redirect()->to('admin/jurusan')
                ->with('message', 'Data berhasil disimpan');
        }
        return redirect()->to(previous_url())
            ->with('message', 'Data gagal disimpan')
            ->with('errors', $model->errors())
            ->withInput();
    }

    public function hapus_jurusan()
    {
        $model = new JurusanModel();
        $jurusan_id = $this->request->getPost('jurusan_id');
        $model->where('jurusan_id', $jurusan_id);
        $model->delete();
        // dd($model->errors());
        return redirect()->to(previous_url())
            ->with('message', 'Data berhasil dihapus');
    }

    /* -=======================================================================*/

    public function kelas()
    {
        helper('form');
        $model = new KelasModel();
        $data_kelas = $model->findKelas();
        $model = new JurusanModel();
        $data_jurusan = $model->findAll();
        $data = [
            'title' => 'Kelas',
            'data_kelas' => $data_kelas,
            'data_jurusan' => $data_jurusan
        ];

        return view('admin/kelas/index', $data);
    }
    public function cetak_kelas()
    {
        $model = new KelasModel();
        $data_kelas = $model->findKelas();
        $data = [
            'title' => 'Kelas',
            'data_kelas' => $data_kelas,
        ];
        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml(view('admin/kelas/cetak_kelas', $data));
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream();
    }

    public function kelas_jurusan($jurusan_id)
    {
        helper('form');
        $model = new KelasModel();
        $data_kelas = $model->findKelas($jurusan_id);
        $model = new JurusanModel();
        $jurusan = $model->find($jurusan_id);
        $data = [
            'title' => 'Kelas',
            'data_kelas' => $data_kelas,
            'jurusan' => $jurusan
        ];

        return view('admin/kelas/index_jurusan', $data);
    }

    public function store_kelas()
    {
        $data = $this->request->getPost();

        $model = new KelasModel();

        if ($model->insert($data)) {
            return redirect()->to(previous_url())
                ->with('message', 'Data berhasil ditambahkan');
        }
        return redirect()->to(previous_url())
            ->with('message', 'Data gagal disimpan')
            ->with('errors', $model->errors())
            ->withInput();
    }

    public function edit_kelas($kelas_id)
    {
        $model = new KelasModel();
        $kelas = $model->find($kelas_id);
        $data = [
            'title' => 'Edit Kelas',
            'kelas' => $kelas
        ];

        return view('admin/kelas/edit', $data);
    }

    public function update_kelas()
    {
        $kelas_id = $this->request->getPost('kelas_id');
        $data = $this->request->getPost();
        $model = new KelasModel();
        if ($model->update($kelas_id, $data)) {
            return redirect()->to(previous_url())
                ->with('message', 'Data berhasil disimpan');
        }
        return redirect()->to(previous_url())
            ->with('message', 'Data gagal disimpan')
            ->with('errors', $model->errors())
            ->withInput();
    }
    public function hapus_kelas()
    {
        # code...
    }
    // =====================================================
    public function daftar_jurusan()
    {
        $model = new JurusanModel();
        $data_jurusan = $model->findJurusan();

        $data = [
            'title' => 'Pembagian | Pilih Jurusan',
            'data_jurusan' => $data_jurusan
        ];

        return view('kelas/daftar_jurusan', $data);
    }
    public function pembagian()
    {
        helper('form');
        $model = new SiswaModel();
        $siswa = $model->getSiswaBaru();

        $model = new KelasModel();
        $data_kelas = $model->findKelasX();

        $data = [
            'title' => 'Pembagian Kelas Siswa Baru ',
            'siswa_baru' => $siswa,
            'data_kelas' => $data_kelas
        ];

        return view('kelas/pembagian_kelas', $data);
    }

    public function store_pembagian()
    {
        $siswa = $this->request->getPost('siswa_id');
        $kelas_id = $this->request->getPost('kelas_id');


        if (!empty($siswa)) {
            foreach ($siswa as $i => $siswa_id) {
                $model = new SiswaModel();
                $data['kelas_id'] = $kelas_id;
                $data['siswa_status'] = 'aktif';

                //Buat Akun
                if ($model->update($siswa_id, $data)) {
                    // dd('here');
                    $_siswa = $model->find($siswa_id);
                    $model = new UserModel();
                    $data = [
                        'username' => $_siswa->siswa_nis,
                        'user_type' => 'siswa',
                        'password' => '101010',
                        'password_confirmation' => '101010',
                        'user_active' => 1
                    ];
                    //update user_id di tabel siswa
                    if ($model->insert($data)) {
                        $user_id = $model->getInsertID();

                        $model = new SiswaModel();
                        $data['user_id'] = $user_id;
                        // dd('here');

                        $model->update($siswa_id, $data);
                    }
                }
            }
        }

        return redirect()->to(previous_url())
            ->with('message', 'Pembagian kelas berhasil');
    }
    //====================MUTASI===========================
    public function mutasi_daftarkelas()
    {
        helper('form');
        $model = new KelasModel();
        $data_kelas = $model->findUnderXII();
        foreach ($data_kelas as $key => $kelas) {
            $model = new SiswaModel();
            $jumlah_siswa = $model->countSiswa(['kelas_id' => $kelas->kelas_id]);
            $jumlah_mutasi = $model->countSiswa(['kelas_id' => $kelas->kelas_id, 'siswa_kelastemp !=' => null]);
            $data_kelas[$key]->jumlah_siswa = $jumlah_siswa;
            $data_kelas[$key]->jumlah_mutasi = $jumlah_mutasi;
        }
        $data = [
            'title' => 'Mutasi Kelas',
            'data_kelas' => $data_kelas
        ];

        return view('mutasi/daftar_kelas', $data);
    }

    public function mutasi_daftarsiswa($kelas_id)
    {
        helper('form');
        $model = new KelasModel();
        $kelas_sekarang = $model->findSingle($kelas_id);
        $kelas_atas = $model->findKelasAtas($kelas_sekarang->kelas_tingkat, $kelas_sekarang->jurusan_id);

        $model = new SiswaModel();
        $siswa_sekarang = $model->findBelumMutasi($kelas_id);
        $siswa_mutasi = $model->findMutasi($kelas_id);

        $data = [
            'title' => 'Mutasi Kelas Siswa',
            'kelas_sekarang' => $kelas_sekarang,
            'kelas_atas' => $kelas_atas,
            'siswa_sekarang' => $siswa_sekarang,
            'siswa_mutasi' => $siswa_mutasi,
        ];

        return view('mutasi/daftar_siswa', $data);
    }

    public function mutasi_sementara()
    {
        $siswa = $this->request->getPost('siswa');
        $kelas = $this->request->getPost('kelas');
        // dd($kelas);
        $model = new SiswaModel();
        foreach ($siswa as $siswa_id) {
            $data = [
                'siswa_kelastemp' => $kelas
            ];
            $model->update($siswa_id, $data);
        }
        return redirect()->to(previous_url())
            ->with('message', 'Berhasil!');
    }

    public function cancel_mutasi()
    {
        $siswa_id = $this->request->getPost('siswa_id');
        $model = new SiswaModel();
        $model->update($siswa_id, ['siswa_kelastemp' => null]);
        return redirect()->to(previous_url())
            ->with('message', 'Berhasil dibatalkan');
    }

    public function error_mutasi()
    {
        $data['title'] = 'No Access!';
        return view('mutasi/error_ta', $data);
    }

    public function store_mutasi()
    {
        $model = new SiswaModel();
        $siswa_mutasi = $model->findMutasi();
        foreach ($siswa_mutasi as $siswa) {
            $data = [
                'kelas_id' => $siswa->siswa_kelastemp,
                'siswa_kelastemp' => null
            ];
            $model->update($siswa->siswa_id, $data);
        }
        return redirect()->to(previous_url())
            ->with('message', 'Berhasil!');
    }
}
