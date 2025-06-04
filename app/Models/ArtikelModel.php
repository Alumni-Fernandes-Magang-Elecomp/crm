<?php

namespace App\Models;

use CodeIgniter\Model;

class ArtikelModel extends Model
{
    protected $table = "tb_artikel";
    protected $primaryKey = "id_artikel";
    protected $returnType = "object";
    protected $allowedFields = ['id_artikel', 'id_kategori', 'judul_artikel', 'foto_artikel', 'deskripsi_artikel', 'tags', 'views', 'slug'];


    public function getArtikel()
    {
         return $this->db->table('tb_artikel')
         ->join('tb_kategori','tb_kategori.id_kategori=tb_artikel.id_kategori')
         ->orderBy('RAND()')
         ->get()->getResultArray();  
    }

    public function getArtikelAdmin()
    {
         return $this->db->table('tb_artikel')
         ->join('tb_kategori','tb_kategori.id_kategori=tb_artikel.id_kategori')
         ->orderBy('id_artikel', 'desc')
         ->get()->getResultArray();  
    }

    public function getArtikelRandom()
    {
         return $this->db->table('tb_artikel')
         ->join('tb_kategori','tb_kategori.id_kategori=tb_artikel.id_kategori')
         ->orderBy('RAND()')
         ->limit(5)
         ->get()->getResultArray();  
    }

    public function getDetailArtikel($id_artikel, $slug)
    {
         return $this->db->table('tb_artikel')
         ->join('tb_kategori','tb_kategori.id_kategori=tb_artikel.id_kategori')
         ->where('tb_artikel.id_artikel', $id_artikel)
         ->where('tb_artikel.slug', $slug)
         ->get()->getResultArray();  
    }

    public function getArtikelLainnya($id_artikel)
    {
        return $this->db->table('tb_artikel')
            ->join('tb_kategori','tb_kategori.id_kategori=tb_artikel.id_kategori')
            ->where('id_artikel !=', $id_artikel)
            ->orderBy('RAND()')
            ->limit(4)
            ->get()->getResultArray();
    }
    

    public function getArtikelTerbaru()
    {
         return $this->db->table('tb_artikel')
         ->join('tb_kategori','tb_kategori.id_kategori=tb_artikel.id_kategori')
         ->orderBy('id_artikel', 'desc')
         ->limit(6)
         ->get()->getResultArray();  
    }

    public function getPopularArtikel()
    {
         return $this->db->table('tb_artikel')
         ->join('tb_kategori','tb_kategori.id_kategori=tb_artikel.id_kategori')
         ->orderBy('views', 'desc')
         ->limit(4)
         ->get()->getResultArray();  
    }

    public function getKategoriArtikel($id_kategori)
    {
         return $this->db->table('tb_artikel')
         ->join('tb_kategori','tb_kategori.id_kategori=tb_artikel.id_kategori')
         ->where('tb_artikel.id_kategori', $id_kategori)
         ->orderBy('RAND()')
         ->get()->getResultArray();  
    }

    public function searchArtikel($keyword)
    {
        return $this->table('tb_artikel')
               ->join('tb_kategori','tb_kategori.id_kategori=tb_artikel.id_kategori')
               ->like('nama_kategori', $keyword)
               ->orLike('judul_artikel', $keyword)
               ->orLike('deskripsi_artikel', $keyword)
               ->orLike('tags', $keyword)
               ->orderBy('views', 'desc')
               ->get()
               ->getResultArray();
    }

    public function incrementViews($id_artikel) 
    {
          $this->db->table('tb_artikel')
              ->where('id_artikel', $id_artikel)
              ->set('views', 'views+1', FALSE)
              ->update();
     }
}


