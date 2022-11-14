<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'jadwal';
    protected $primaryKey       = 'jadwal_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['jadwal_hari', 'jadwal_jenis', 'jadwal_mulai', 'jadwal_selesai', 'mapel_id', 'kelas_id'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'jadwal_hari' => 'required',
        'jadwal_jenis' => 'required',
        'jadwal_mulai' => 'required',
        'jadwal_selesai' => 'required',
        // 'mapel_id' => 'required',
        'kelas_id' => 'required'
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

    public function findJadwal($kelas_id, $hari_nama = null)
    {
        $this->join('mapel', 'mapel.mapel_id = jadwal.mapel_id', 'left');
        $this->join('kelas', 'kelas.kelas_id = jadwal.kelas_id');
        $this->where('kelas.kelas_id', $kelas_id);
        if ($hari_nama != null)
            $this->where('jadwal.jadwal_hari', $hari_nama);
        return $this->findAll();
    }
    public function findKelasMengajar($guru_id)
    {
        $this->join('kelas', 'kelas.kelas_id = jadwal.kelas_id');
        $this->join('jurusan', 'jurusan.jurusan_id = kelas.jurusan_id');
        $this->join('mapel', 'mapel.mapel_id = jadwal.mapel_id');
        $this->join('guru', 'guru.guru_id = mapel.guru_id');
        $this->where('guru.guru_id', $guru_id);
        return $this->findAll();
    }

    public function findMapel($kelas_id)
    {
        $this->distinct('mapel.mapel_id');
        $this->select('mapel.mapel_id, mapel.mapel_nama, mapel.mapel_kelas, mapel.mapel_kelompok');
        $this->join('mapel', 'mapel.mapel_id = jadwal.mapel_id');
        $this->where('jadwal.kelas_id', $kelas_id);
        return $this->find();
    }

    public function findJadwalGuru($guru_id)
    {
        $this->join('mapel', 'mapel.mapel_id = jadwal.mapel_id');
        $this->join('kelas', 'kelas.kelas_id = jadwal.kelas_id');
        $this->join('jurusan', 'jurusan.jurusan_id = kelas.jurusan_id');
        $this->where('mapel.guru_id', $guru_id);
        $this->orderBy('jadwal.mapel_id');
        $this->orderBy('jadwal.jadwal_id');
        return $this->find();
    }

    public function findCount()
    {
        $this->select('count(distinct(jadwal.mapel_id)) as jumlah');
        $this->join('mapel', 'mapel.mapel_id = jadwal.mapel_id');
        $this->where('mapel.guru_id', session('guru')->guru_id);
        // dd($this->getCompiledSelect());
        return $this->first()->jumlah;
    }
}
