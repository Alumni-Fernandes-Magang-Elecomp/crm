<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriModel extends Model
{

    protected $table = "tb_kategori";
    protected $primaryKey = "id_kategori";
    protected $returnType = "object";
    protected $allowedFields = ['id_kategori', 'nama_kategori'];


    public function getKategori()
    {
         return $this->db->table('tb_kategori')->get()->getResultArray();  
    }
}
