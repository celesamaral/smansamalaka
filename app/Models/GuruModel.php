<?php

namespace App\Models;

use CodeIgniter\Model;

class GuruModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'guru';
    protected $primaryKey       = 'guru_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['guru_nip', 'guru_nama', 'guru_jk', 'guru_tempat_lahir', 'guru_tgl_lahir', 'guru_hp', 'user_id'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'guru_nip' => 'required|is_unique[guru.guru_nip,guru_id,{guru_id}]',
        'guru_nama' => 'required',
        'guru_jk' => 'required',
        'guru_tempat_lahir' => 'required',
        'guru_tgl_lahir' => 'required',
        'guru_hp' => 'required',
        'user_id' => 'is_unique[guru.user_id]'
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

    public function findProfil($guru_id)
    {
        $this->join('user', 'user.user_id = guru.user_id');
        $this->where('guru.guru_id', $guru_id);

        $result = $this->first();
        return $result;
    }
    public function findCount($where = null)
    {
        if ($where != null)
            $this->where($where);
        $this->select('count(guru_id) as jumlah');
        return $this->first()->jumlah;
    }
}
