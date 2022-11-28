<?php

namespace App\Models;

use CodeIgniter\Model;

class SiswaModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'siswa';
    protected $primaryKey       = 'siswa_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['siswa_nisn', 'siswa_nis', 'siswa_nama', 'siswa_jk', 'siswa_tempat_lahir', 'siswa_tgl_lahir', 'siswa_hp', 'siswa_goldarah', 'siswa_alamat', 'siswa_email', 'siswa_masuk', 'siswa_status', 'kelas_id', 'user_id', 'siswa_kelastemp'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'siswa_nisn' => 'required',
        'siswa_nama' => 'required',
        'siswa_jk' => 'required',
        'siswa_tempat_lahir' => 'required',
        'siswa_tgl_lahir' => 'required|valid_date',
        'siswa_hp' => 'required|numeric',
        'siswa_goldarah' => 'required',
        'siswa_alamat' => 'required',
        'siswa_email' => 'required|valid_email',
        'siswa_masuk' => 'required',
        // 'kelas_id' => 'required',
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = ['generateNIS'];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function findAllSiswa($kelas_id = null)
    {
        if ($kelas_id != null)
            $this->where('siswa.kelas_id', $kelas_id);
        $this->join('kelas', 'kelas.kelas_id = siswa.kelas_id', 'left');
        $this->join('jurusan', 'jurusan.jurusan_id = kelas.jurusan_id', 'left');
        $this->where('siswa.siswa_status', 'aktif');
        return $this->findAll();
    }
    protected function generateNIS(array $data)
    {
        $year = date('Y');
        $this->where('siswa_masuk', $year);
        $count = $this->countAllResults();
        $year = date('y');
        $npsn = '09603';
        $nis = $year . $npsn . (str_pad(($count + 1), 4, '0', STR_PAD_LEFT));
        $data['data']['siswa_nis'] = $nis;
        return $data;
    }

    public function getSiswaBaru($jurusan_id = null)
    {
        $this->where('siswa.siswa_status', 'baru');
        if ($jurusan_id != null)
            $this->where('kelas.jurusan_id', $jurusan_id);
        $this->join('kelas', 'kelas.kelas_id = siswa.kelas_id', 'left');
        $this->join('jurusan', 'jurusan.jurusan_id = kelas.jurusan_id', 'left');
        return $this->findAll();
    }
    public function findAllNilai($kd_id, $tahunajaran_id, $kelas_id = null, $nilaisiswa_jenis = null)
    {
        if ($kelas_id != null) {
            $this->where('siswa.kelas_id', $kelas_id);
        }
        $this->distinct('siswa.siswa_id');
        $this->select('siswa.siswa_id, siswa.siswa_nama, nilaisiswa.nilaisiswa_nilai, nilaisiswa.nilaisiswa_id');
        $this->join('nilaisiswa', 'siswa.siswa_id = nilaisiswa.siswa_id AND nilaisiswa.kd_id = ' . $kd_id . ' AND nilaisiswa.tahunajaran_id = ' . $tahunajaran_id . " AND nilaisiswa.nilaisiswa_jenis = '" . $nilaisiswa_jenis . "'", 'left');
        return $this->findAll();
    }

    public function findRekapan($kelas_id, $mapel_id, $tahunajaran_id)
    {
        $query = "SELECT DISTINCT(siswa.siswa_id) as siswaID, siswa.siswa_nama, (Select nilaisiswa.nilaisiswa_nilai from nilaisiswa, kd, mapel, siswa WHERE nilaisiswa.kd_id = kd.kd_id and siswa.siswa_id = nilaisiswa.siswa_id AND kd.mapel_id = mapel.mapel_id AND mapel.mapel_id = " . $mapel_id . " AND nilaisiswa.nilaisiswa_jenis = 'tugas 1' AND siswa.siswa_id = siswaID AND nilaisiswa.tahunajaran_id = " . $tahunajaran_id . ") as tugas1, (Select nilaisiswa.nilaisiswa_nilai from nilaisiswa, kd, mapel, siswa WHERE nilaisiswa.kd_id = kd.kd_id and siswa.siswa_id = nilaisiswa.siswa_id AND kd.mapel_id = mapel.mapel_id AND mapel.mapel_id = " . $mapel_id . " AND nilaisiswa.nilaisiswa_jenis = 'tugas 2' AND siswa.siswa_id = siswaID AND nilaisiswa.tahunajaran_id = " . $tahunajaran_id . ") as tugas2, (Select nilaisiswa.nilaisiswa_nilai from nilaisiswa, kd, mapel, siswa WHERE nilaisiswa.kd_id = kd.kd_id and siswa.siswa_id = nilaisiswa.siswa_id AND kd.mapel_id = mapel.mapel_id AND mapel.mapel_id = " . $mapel_id . " AND nilaisiswa.nilaisiswa_jenis = 'ulangan 1' AND siswa.siswa_id = siswaID AND nilaisiswa.tahunajaran_id = " . $tahunajaran_id . ") as ulangan1, (Select nilaisiswa.nilaisiswa_nilai from nilaisiswa, kd, mapel, siswa WHERE nilaisiswa.kd_id = kd.kd_id and siswa.siswa_id = nilaisiswa.siswa_id AND kd.mapel_id = mapel.mapel_id AND mapel.mapel_id = " . $mapel_id . " AND nilaisiswa.nilaisiswa_jenis = 'ulangan 2' AND siswa.siswa_id = siswaID AND nilaisiswa.tahunajaran_id = " . $tahunajaran_id . ") as ulangan2  from siswa WHERE siswa.kelas_id = " . $kelas_id;

        $query = $this->db->query($query);
        $result = $query->getResultObject();
        return $result;
    }

    public function findProfil($siswa_id)
    {
        $this->join('user', 'user.user_id = siswa.user_id', 'left');
        $this->where('siswa.siswa_id', $siswa_id);

        $result = $this->first();
        return $result;
    }
    public function findCount($where = null)
    {
        if ($where != null)
            $this->where($where);
        $this->select('count(siswa_id) as jumlah');
        return $this->first()->jumlah;
    }
    public function findAktif()
    {
        $this->where('siswa_status', 'aktif');
        $this->join('kelas', 'kelas.kelas_id = siswa.kelas_id', 'left');
        $this->join('jurusan', 'jurusan.jurusan_id = kelas.jurusan_id', 'left');
        return $this->findAll();
    }

    public function findsiswa($siswa_id)
    {
        $this->join('kelas', 'kelas.kelas_id = siswa.kelas_id');
        $this->join('jurusan', 'jurusan.jurusan_id = kelas.jurusan_id');
        $this->where('siswa.siswa_id', $siswa_id);
        return $this->first();
    }
    public function findAbsensi($absensi_id, $kelas_id)
    {
        $this->select('siswa.siswa_id as siswaId, siswa.siswa_nama, detailabsensi.*, absensi.*');
        $this->where('kelas_id', $kelas_id);
        $this->join('detailabsensi', 'siswa.siswa_id = detailabsensi.siswa_id AND detailabsensi.absensi_id = ' . $absensi_id, 'left');
        $this->join('absensi', 'absensi.absensi_id = detailabsensi.absensi_id', 'left');
        return $this->findAll();
    }
    public function findBelumMutasi($kelas_id)
    {
        $this->where('kelas_id', $kelas_id);
        $this->where('siswa_kelastemp =', null, true);
        return $this->find();
    }
    public function findMutasi($kelas_id = null)
    {
        if ($kelas_id != null)
            $this->where('siswa.kelas_id', $kelas_id);
        $this->where('siswa_kelastemp is', null, true);
        $this->join('kelas', 'kelas.kelas_id = siswa.siswa_kelastemp');
        $this->join('jurusan', 'jurusan.jurusan_id = kelas.jurusan_id');
        return $this->find();
    }
    public function countSiswa($where = null)
    {
        $this->select('count(siswa_id) as jumlah');
        if ($where != null)
            $this->where($where, true);
        return $this->first()->jumlah;
    }
}
