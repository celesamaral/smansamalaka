<?php

namespace App\Models;

use CodeIgniter\Model;

class MapelModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'mapel';
    protected $primaryKey       = 'mapel_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['mapel_nama', 'mapel_kelompok', 'mapel_kelas', 'guru_id'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'mapel_nama' => 'required',
        'guru_id' => 'required',
        'mapel_kelompok' => 'required',
        'mapel_kelas' => 'required'
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

    public function findMapel()
    {
        $this->join('guru', 'guru.guru_id = mapel.guru_id');
        return $this->findAll();
    }

    public function findMapelKelas($kelas)
    {
        $this->where('mapel.mapel_kelas', $kelas->kelas_tingkat);
        $this->groupStart()
            ->where('mapel.mapel_kelompok', $kelas->jurusan_nama)
            ->orWhere('mapel.mapel_kelompok', 'umum')
            ->groupEnd();

        $this->join('guru', 'guru.guru_id = mapel.guru_id');
        return $this->findAll();
    }
    public function findMapelSiswa($siswa_id, $tahunajaran_id)
    {
        $sql = "SELECT DISTINCT(mapel.mapel_id), mapel.mapel_nama, mapel.mapel_kelas, mapel.mapel_kelompok from mapel, kd, nilaisiswa where mapel.mapel_id = kd.mapel_id AND kd.kd_id = nilaisiswa.kd_id AND nilaisiswa.siswa_id = '$siswa_id' and nilaisiswa.tahunajaran_id = '$tahunajaran_id'";

        $query = $this->db->query($sql);
        $result = $query->getResultObject();
        return $result;
    }
    public function findCount($where = null)
    {
        $this->select('count(mapel_id) as jumlah');
        if ($where != null)
            $this->where($where);
        return $this->first()->jumlah;
    }
}
