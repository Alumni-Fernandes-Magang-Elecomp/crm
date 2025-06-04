<?php

namespace App\Models;

use CodeIgniter\Model;

class PelatihanUserModel extends Model
{
    protected $table = "tb_pelatihan_user";
    protected $primaryKey = "id_pelatihan_user";
    protected $returnType = "object";
    protected $allowedFields = ['id_user', 'id_pelatihan', 'tgl_daftar', 'status'];

    public function getPelatihanByUser($userId)
    {
        return $this->db->table('tb_pelatihan_user pu')
            ->select('p.id_pelatihan, p.nama_pelatihan, p.tgl_mulai, p.tgl_akhir, k.nama_kota, 
                      pu.tgl_daftar, pu.status')
            ->join('tb_pelatihan p', 'p.id_pelatihan = pu.id_pelatihan')
            ->join('tb_kota k', 'k.id_kota = p.id_kota')
            ->where('pu.id_user', $userId)
            ->orderBy('pu.tgl_daftar', 'DESC')
            ->get()
            ->getResultArray();
    }
}
