<?php

namespace App\Models;

use CodeIgniter\Model;

class AbsensiModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'absensi';
    protected $primaryKey       = 'absensi_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['absensi_tgl', 'tahunajaran_id'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'absensi_tgl' => 'required|is_unique[absensi.absensi_tgl]',
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

    public function findByTA($tahunajaran_id)
    {
        $this->join('tahunajaran', 'tahunajaran.tahunajaran_id = absensi.tahunajaran_id');
        $this->where('absensi.tahunajaran_id', $tahunajaran_id);
        $this->orderBy('absensi.absensi_tgl', 'desc');
        return $this->findAll();
    }

    public function exist($where)
    {
        $this->where($where);
        $result = $this->first();
        if (!empty($result))
            return true;
        return false;
    }

    public function findAbsenSiswa($siswa_id)
    {
        $sql = "SELECT DISTINCT absensi.tahunajaran_id, tahunajaran.tahunajaran_tahun, tahunajaran.tahunajaran_semester, (SELECT COUNT(detailabsensi.detailabsensi_id) FROM detailabsensi, absensi WHERE detailabsensi.absensi_id = absensi.absensi_id AND detailabsensi.detailabsensi_kehadiran = 'H' AND detailabsensi.siswa_id = '$siswa_id' GROUP BY absensi.tahunajaran_id) as H, (SELECT COUNT(detailabsensi.detailabsensi_id) FROM detailabsensi, absensi WHERE detailabsensi.absensi_id = absensi.absensi_id AND detailabsensi.detailabsensi_kehadiran = 'S' AND detailabsensi.siswa_id = '$siswa_id' GROUP BY absensi.tahunajaran_id) as S, (SELECT COUNT(detailabsensi.detailabsensi_id) FROM detailabsensi, absensi WHERE detailabsensi.absensi_id = absensi.absensi_id AND detailabsensi.detailabsensi_kehadiran = 'I' AND detailabsensi.siswa_id = '$siswa_id' GROUP BY absensi.tahunajaran_id) as I, (SELECT COUNT(detailabsensi.detailabsensi_id) FROM detailabsensi, absensi WHERE detailabsensi.absensi_id = absensi.absensi_id AND detailabsensi.detailabsensi_kehadiran = 'A' AND detailabsensi.siswa_id = '$siswa_id' GROUP BY absensi.tahunajaran_id) as A FROM absensi join tahunajaran on tahunajaran.tahunajaran_id = absensi.tahunajaran_id where EXISTS (SELECT * FROM detailabsensi WHERE detailabsensi.absensi_id = absensi.absensi_id AND detailabsensi.siswa_id = '$siswa_id')";

        $query = $this->db->query($sql);
        return $query->getResultObject();
    }
    public function findSingleAbsenSiswa($siswa_id, $absensi_id)
    {
        $sql = "SELECT DISTINCT absensi.tahunajaran_id, tahunajaran.tahunajaran_tahun, tahunajaran.tahunajaran_semester, (SELECT COUNT(detailabsensi.detailabsensi_id) FROM detailabsensi, absensi WHERE detailabsensi.absensi_id = absensi.absensi_id AND detailabsensi.detailabsensi_kehadiran = 'H' AND detailabsensi.siswa_id = '$siswa_id' GROUP BY absensi.tahunajaran_id) as H, (SELECT COUNT(detailabsensi.detailabsensi_id) FROM detailabsensi, absensi WHERE detailabsensi.absensi_id = absensi.absensi_id AND detailabsensi.detailabsensi_kehadiran = 'S' AND detailabsensi.siswa_id = '$siswa_id' GROUP BY absensi.tahunajaran_id) as S, (SELECT COUNT(detailabsensi.detailabsensi_id) FROM detailabsensi, absensi WHERE detailabsensi.absensi_id = absensi.absensi_id AND detailabsensi.detailabsensi_kehadiran = 'I' AND detailabsensi.siswa_id = '$siswa_id' GROUP BY absensi.tahunajaran_id) as I, (SELECT COUNT(detailabsensi.detailabsensi_id) FROM detailabsensi, absensi WHERE detailabsensi.absensi_id = absensi.absensi_id AND detailabsensi.detailabsensi_kehadiran = 'A' AND detailabsensi.siswa_id = '$siswa_id' GROUP BY absensi.tahunajaran_id) as A FROM absensi join tahunajaran on tahunajaran.tahunajaran_id = absensi.tahunajaran_id where EXISTS (SELECT * FROM detailabsensi WHERE detailabsensi.absensi_id = absensi.absensi_id AND detailabsensi.siswa_id = '$siswa_id') AND detailabsensi.absensi_id = '$absensi_id'";

        $query = $this->db->query($sql);
        return $query->getRowObject();
    }
}
