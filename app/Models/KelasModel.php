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
        $this->select('kelas.*, jurusan.*,guru.*');
        $this->where('kelas.kelas_tingkat !=', 'umum');
        $this->join('jurusan', 'jurusan.jurusan_id = kelas.jurusan_id');
        $this->join('walikelas', 'walikelas.kelas_id = kelas.kelas_id', 'left');
        $this->join('guru', 'guru.guru_id = walikelas.guru_id', 'left');
        return $this->findAll();
    }
    public function findSingle($kelas_id)
    {
        $this->select('kelas.*, jurusan.*,guru.*');
        $this->join('jurusan', 'jurusan.jurusan_id = kelas.jurusan_id');
        $this->join('walikelas', 'walikelas.kelas_id = kelas.kelas_id', 'left');
        $this->join('guru', 'guru.guru_id = walikelas.guru_id', 'left');
        $this->where('kelas.kelas_id', $kelas_id);
        return $this->first();
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
    public function findUnderXII()
    {
        $this->where('kelas_tingkat !=', 'XII', true);
        $this->join('jurusan', 'jurusan.jurusan_id = kelas.jurusan_id');
        $this->orderBy('kelas_tingkat', 'asc');
        return $this->findAll();
    }
    public function findKelasAtas($kelas_tingkat, $jurusan_id)
    {
        $kelas_atas = 'XI';
        if ($kelas_tingkat == 'XI')
            $kelas_atas = 'XII';
        $model = new JurusanModel();
        $jurusan = $model->find($jurusan_id);
        $this->where('kelas.kelas_tingkat', $kelas_atas);

        if ($jurusan->jurusan_nama != 'Umum')
            $this->where('kelas.jurusan_id', $jurusan_id);
        $this->join('jurusan', 'jurusan.jurusan_id = kelas.jurusan_id');
        return $this->find();
    }
}
