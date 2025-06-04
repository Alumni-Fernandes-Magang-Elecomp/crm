<?php

namespace App\Models;

use CodeIgniter\Model;

class PromoModel extends Model
{
    protected $table = "tb_promo";
    protected $primaryKey = "id_promo";
    protected $returnType = "object";
    protected $allowedFields = ['id_promo', 'judul_promo', 'poster_promo', 'deskripsi_promo', 'mulai_promo', 'akhir_promo'];


    public function getPromo()
    {
         return $this->db->table('tb_promo');  
    }

    public function getHomePromo($today)
    {
        return $this->db->table('tb_promo')
            ->where('mulai_promo <=', $today)
            ->where('akhir_promo >=', $today)
            // ->where('mulai_promo >=', date('Y-m-d', strtotime('-7 days', strtotime($today))))
            // ->where('akhir_promo <=', date('Y-m-d', strtotime('+7 days', strtotime($today))))    
            // ->orderBy('RAND()')
            ->limit(5)
            ->get()
            ->getResultArray();
    }
    
    public function getRandomPromo()
    {
        return $this->db->table('tb_promo')
                        ->orderBy('RAND()')
                        ->limit(5)
                        ->get()->getResultArray();
    }

    public function getPromoLainnya($id_promo, $limit = 4)
    {
        return $this->where('id_promo !=', $id_promo)
            ->orderBy('RAND()')
            ->limit($limit)
            ->get()->getResultArray();
    }
}
