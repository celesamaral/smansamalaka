<?php

namespace App\Models;

use CodeIgniter\Model;

class KelasModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'kelas';
    protected $primaryKey       = 'kelas_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['kelas_tingkat', 'kelas_abjad', 'jurusan_id'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'kelas_tingkat' => 'required',
        'kelas_abjad' => 'required',
        'jurusan_id' => 'required'
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

    public function findKelas($jurusan_id = null)
    {
        if ($jurusan_id != null)
            $this->where('kelas.jurusan_id', $jurusan_id);
        $this->where('kelas.kelas_tingkat !=', 'umum');
        $this->join('jurusan', 'jurusan.jurusan_id = kelas.jurusan_id');
        return $this->findAll();
    }
    public function findSingle($kelas_id)
    {
        $this->join('jurusan', 'jurusan.jurusan_id = kelas.jurusan_id');
        return $this->find($kelas_id);
    }
    public function findKelasBaru()
    {
        $this->distinct('kelas.jurusan_id');
        $this->where('kelas.kelas_tingkat', 'umum');
        $this->join('jurusan', 'jurusan.jurusan_id = kelas.jurusan_id');
        $this->groupBy('kelas.jurusan_id');
        return $this->findAll();
    }
    public function findKelasX($jurusan_id = null)
    {
        $this->where('kelas_tingkat', 'X');
        if ($jurusan_id != null)
            $this->where('kelas.jurusan_id', $jurusan_id);
        $this->where('jurusan.jurusan_nama', 'Umum');
        $this->join('jurusan', 'jurusan.jurusan_id = kelas.jurusan_id');
        return $this->findAll();
    }
}
