<?php

namespace App\Models;

use CodeIgniter\Model;

class KdModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'kd';
    protected $primaryKey       = 'kd_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['kd_nama', 'mapel_id', 'kd_jenis', 'kd_status'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'kd_nama' => 'required',
        'mapel_id' => 'required'
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = ['addNilaiAkhir'];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getKD($mapel_id)
    {
        $this->where('mapel_id', $mapel_id);
        $this->where('kd_jenis !=', 'na');
        return $this->findAll();
    }
    public function getKDOnly($mapel_id)
    {
        $this->where('mapel_id', $mapel_id);
        $this->where('kd_jenis !=', 'uas', true);
        $this->where('kd_jenis !=', 'uts', true);
        $this->where('kd_jenis !=', 'na', true);
        return $this->findAll();
    }
    public function getUTS($mapel_id)
    {
        $this->where('mapel_id', $mapel_id);
        $this->where('kd_jenis', 'uts');
        return $this->first();
    }
    public function getUAS($mapel_id)
    {
        $this->where('mapel_id', $mapel_id);
        $this->where('kd_jenis', 'uas');
        return $this->first();
    }
    public function getNilaiAkhir($mapel_id)
    {
        $this->where('mapel_id', $mapel_id);
        $this->where('kd_jenis', 'na');
        return $this->first();
    }
    protected function addNilaiAkhir(array $data)
    {
        //cek sudah ada nilai akhir atau belum
        // dd($data['data']['mapel_id']);
        $nilaiakhir = $this->where('kd_jenis', 'na')->where('mapel_id', $data['data']['mapel_id'])->first();

        if ($nilaiakhir == null) {
            $data = [
                'kd_nama' => 'NA',
                'mapel_id' => $data['data']['mapel_id'],
                'kd_jenis' => 'na'
            ];
            $this->insert($data);
        }
        return $data;
    }
}
