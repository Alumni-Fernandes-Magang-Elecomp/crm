<?php

namespace App\Models;

use CodeIgniter\Model;

class PenyelenggaraModel extends Model
{
    protected $table = 'tb_penyelenggara';
    protected $primaryKey = 'id_penyelenggara';
    protected $allowedFields = ['nama_penyelenggara'];

    /**
     * Mendapatkan data penyelenggara beserta pelatihan yang terkait
     */
    public function getWithPelatihan()
    {
        return $this->select('tb_penyelenggara.*, 
                            GROUP_CONCAT(DISTINCT p1.nama_pelatihan SEPARATOR ", ") as pelatihan_1,
                            GROUP_CONCAT(DISTINCT p2.nama_pelatihan SEPARATOR ", ") as pelatihan_2,
                            GROUP_CONCAT(DISTINCT p3.nama_pelatihan SEPARATOR ", ") as pelatihan_3')
            ->join('tb_pelatihan p1', 'p1.id_penyelenggara_1 = tb_penyelenggara.id_penyelenggara', 'left')
            ->join('tb_pelatihan p2', 'p2.id_penyelenggara_2 = tb_penyelenggara.id_penyelenggara', 'left')
            ->join('tb_pelatihan p3', 'p3.id_penyelenggara_3 = tb_penyelenggara.id_penyelenggara', 'left')
            ->groupBy('tb_penyelenggara.id_penyelenggara')
            ->findAll();
    }

    /**
     * Mendapatkan penyelenggara berdasarkan ID dengan detail pelatihan
     */
    public function getByIdWithPelatihan($id)
    {
        return $this->select('tb_penyelenggara.*, 
                            p1.id_pelatihan as id_pelatihan_1, p1.nama_pelatihan as nama_pelatihan_1,
                            p2.id_pelatihan as id_pelatihan_2, p2.nama_pelatihan as nama_pelatihan_2,
                            p3.id_pelatihan as id_pelatihan_3, p3.nama_pelatihan as nama_pelatihan_3')
            ->join('tb_pelatihan p1', 'p1.id_penyelenggara_1 = tb_penyelenggara.id_penyelenggara', 'left')
            ->join('tb_pelatihan p2', 'p2.id_penyelenggara_2 = tb_penyelenggara.id_penyelenggara', 'left')
            ->join('tb_pelatihan p3', 'p3.id_penyelenggara_3 = tb_penyelenggara.id_penyelenggara', 'left')
            ->where('tb_penyelenggara.id_penyelenggara', $id)
            ->first();
    }

    /**
     * Mendapatkan semua penyelenggara dengan hitung jumlah pelatihan
     */
    public function getAllWithPelatihanCount()
    {
        return $this->select('tb_penyelenggara.*, 
                            COUNT(DISTINCT p1.id_pelatihan) + 
                            COUNT(DISTINCT p2.id_pelatihan) + 
                            COUNT(DISTINCT p3.id_pelatihan) as total_pelatihan')
            ->join('tb_pelatihan p1', 'p1.id_penyelenggara_1 = tb_penyelenggara.id_penyelenggara', 'left')
            ->join('tb_pelatihan p2', 'p2.id_penyelenggara_2 = tb_penyelenggara.id_penyelenggara', 'left')
            ->join('tb_pelatihan p3', 'p3.id_penyelenggara_3 = tb_penyelenggara.id_penyelenggara', 'left')
            ->groupBy('tb_penyelenggara.id_penyelenggara')
            ->findAll();
    }
}
