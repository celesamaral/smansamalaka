<?php

namespace App\Models;

use CodeIgniter\Model;

class WaliKelasModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'walikelas';
    protected $primaryKey       = 'walikelas_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['guru_id', 'kelas_id'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'guru_id' => 'required',
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

    public function findKelasWali($guru_id)
    {
        $this->where('walikelas.guru_id', $guru_id);
        $this->join('guru', 'guru.guru_id = walikelas.guru_id');
        $this->join('kelas', 'kelas.kelas_id = walikelas.kelas_id');
        $this->join('jurusan', 'jurusan.jurusan_id = kelas.jurusan_id');
        return $this->find();
    }

    public function cekWaliKelas($guru_id, $kelas_id)
    {
        $this->where('guru_id', $guru_id);
        $this->where('kelas_id', $kelas_id);
        $result = $this->first();
        if (empty($result))
            return false;
        return true;
    }

    public function findWaliKelas()
    {
        $this->join('guru', 'guru.guru_id = walikelas.guru_id');
        $this->join('kelas', 'kelas.kelas_id = walikelas.kelas_id');
        $this->join('jurusan', 'jurusan.jurusan_id = kelas.jurusan_id');
        return $this->findAll();
    }
}
