<?php

namespace App\Models;

use CodeIgniter\Model;

class AbsensiMapelModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'absensimapel';
    protected $primaryKey       = 'absensimapel_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['absensimapel_tgl', 'kelas_id', 'mapel_id', 'tahunajaran_id'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'absensimapel_tgl' => 'required',
        'kelas_id' => 'required',
        'mapel_id' => 'required',
        'tahunajaran_id' => 'required',
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

    public function sudahAda($absensimapel_tgl, $kelas_id, $mapel_id)
    {
        $where = [
            'absensimapel_tgl' => $absensimapel_tgl,
            'kelas_id' => $kelas_id,
            'mapel_id' => $mapel_id,
        ];
        $this->where($where);
        $result = $this->first();

        if ($result != null)
            return true;
        return false;
    }
    public function findSingle($absensimapel_id)
    {
        $this->where('absensimapel.absensimapel_id', $absensimapel_id);
        $this->join('kelas', 'kelas.kelas_id = absensimapel.kelas_id');
        $this->join('mapel', 'mapel.mapel_id = absensimapel.mapel_id');
        $this->join('tahunajaran', 'tahunajaran.tahunajaran_id = absensimapel.tahunajaran_id');
        return $this->first();
    }

    public function getAbsensiKelas($tahunajaran_id, $kelas_id, $mapel_id)
    {
        $where = [
            'tahunajaran_id' => $tahunajaran_id,
            'kelas_id' => $kelas_id,
            'mapel_id' => $mapel_id,
        ];
        $this->where($where);
        $this->orderBy('absensimapel_tgl', 'desc');
        return $this->find();
    }

    public function findRekapan($siswa_id, $mapel_id, $tahunajaran_id)
    {
        $sql = "SELECT DISTINCT absensimapel.tahunajaran_id, tahunajaran.tahunajaran_tahun, tahunajaran.tahunajaran_semester, (SELECT COUNT(detailabsensimapel.detailabsensimapel_id) FROM detailabsensimapel, absensimapel WHERE detailabsensimapel.absensimapel_id = absensimapel.absensimapel_id AND detailabsensimapel.detailabsensimapel_kehadiran = 'H' AND detailabsensimapel.siswa_id = '$siswa_id' GROUP BY absensimapel.tahunajaran_id) as H, (SELECT COUNT(detailabsensimapel.detailabsensimapel_id) FROM detailabsensimapel, absensimapel WHERE detailabsensimapel.absensimapel_id = absensimapel.absensimapel_id AND detailabsensimapel.detailabsensimapel_kehadiran = 'S' AND detailabsensimapel.siswa_id = '$siswa_id' GROUP BY absensimapel.tahunajaran_id) as S, (SELECT COUNT(detailabsensimapel.detailabsensimapel_id) FROM detailabsensimapel, absensimapel WHERE detailabsensimapel.absensimapel_id = absensimapel.absensimapel_id AND detailabsensimapel.detailabsensimapel_kehadiran = 'I' AND detailabsensimapel.siswa_id = '$siswa_id' GROUP BY absensimapel.tahunajaran_id) as I, (SELECT COUNT(detailabsensimapel.detailabsensimapel_id) FROM detailabsensimapel, absensimapel WHERE detailabsensimapel.absensimapel_id = absensimapel.absensimapel_id AND detailabsensimapel.detailabsensimapel_kehadiran = 'A' AND detailabsensimapel.siswa_id = '$siswa_id' GROUP BY absensimapel.tahunajaran_id) as A FROM absensimapel join tahunajaran on tahunajaran.tahunajaran_id = absensimapel.tahunajaran_id where EXISTS (SELECT * FROM detailabsensimapel WHERE detailabsensimapel.absensimapel_id = absensimapel.absensimapel_id AND detailabsensimapel.siswa_id = '$siswa_id') AND absensimapel.mapel_id = '$mapel_id'  AND absensimapel.tahunajaran_id = '$tahunajaran_id'";

        $query = $this->db->query($sql);
        return $query->getRowObject();
    }
}
