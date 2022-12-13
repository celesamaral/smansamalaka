<?php

namespace App\Models;

use CodeIgniter\Model;

class KepalaSekolahModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'kepalasekolah';
    protected $primaryKey       = 'kepalasekolah_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['kepalasekolah_nama', 'kepalasekolah_nip', 'kepalasekolah_mulai', 'kepalasekolah_selesai', 'kepalasekolah_status'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'kepalasekolah_nama' => 'required',
        'kepalasekolah_nip' => 'required',
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
}
