<?php

namespace App\Models;

use CodeIgniter\Model;

class NilaisiswaModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'nilaisiswa';
    protected $primaryKey       = 'nilaisiswa_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nilaisiswa_jenis', 'nilaisiswa_nilai', 'siswa_id', 'kd_id', 'tahunajaran_id'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'nilaisiswa_jenis' => 'required',
        'nilaisiswa_nilai' => 'required|numeric',
        'siswa_id' => 'required',
        'tahunajaran_id' => 'required'
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function findAllNilai($where = null)
    {
        if ($where != null) {
            $this->where($where);
        }
        $this->join('siswa', 'sisw.siswa_id = nilaisiswa.siswa_id', 'right');
        return $this->findAll();
    }

    public function getNilaiSiswa($siswa_id, $kd_id, $tahunajaran_id)
    {
        $query = "SELECT DISTINCT(siswa.siswa_id) as siswaID, siswa.siswa_nama, kd.kd_id as kdID, (Select nilaisiswa.nilaisiswa_nilai from nilaisiswa WHERE nilaisiswa.kd_id = kdID AND nilaisiswa.nilaisiswa_jenis = 'tugas 1' AND nilaisiswa.siswa_id = siswaID AND nilaisiswa.tahunajaran_id = " . $tahunajaran_id . ") as tugas1, (Select nilaisiswa.nilaisiswa_nilai from nilaisiswa WHERE nilaisiswa.kd_id = kdID AND nilaisiswa.nilaisiswa_jenis = 'tugas 2' AND nilaisiswa.siswa_id = siswaID AND nilaisiswa.tahunajaran_id = " . $tahunajaran_id . ") as tugas2, (Select nilaisiswa.nilaisiswa_nilai from nilaisiswa WHERE nilaisiswa.kd_id = kdID AND nilaisiswa.nilaisiswa_jenis = 'ulangan 1' AND nilaisiswa.siswa_id = siswaID AND nilaisiswa.tahunajaran_id = " . $tahunajaran_id . ") as ulangan1, (Select nilaisiswa.nilaisiswa_nilai from nilaisiswa WHERE nilaisiswa.kd_id = kdID AND nilaisiswa.nilaisiswa_jenis = 'ulangan 2' AND nilaisiswa.siswa_id = siswaID AND nilaisiswa.tahunajaran_id = " . $tahunajaran_id . ") as ulangan2 from siswa, kd WHERE siswa.siswa_id = " . $siswa_id . " AND kd.kd_id = " . $kd_id;

        $query = $this->db->query($query);
        $result = $query->getRowObject();
        return $result;
    }
    public function getNilai($siswa_id, $kd_id, $tahunajaran_id)
    {
        $this->where('siswa_id', $siswa_id);
        $this->where('kd_id', $kd_id);
        $this->where('tahunajaran_id', $tahunajaran_id);
        $result = $this->first();
        if (!empty($result))
            return $result->nilaisiswa_nilai;
        return 0;
    }
    public function cekNilai($where)
    {
        $this->where($where);
        $result = $this->first();
        return $result;
    }
}
