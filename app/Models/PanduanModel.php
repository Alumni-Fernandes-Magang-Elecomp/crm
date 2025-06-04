<?php

namespace App\Models;

use CodeIgniter\Model;

class PanduanModel extends Model
{
    protected $table = "tb_panduan";
    protected $primaryKey = "id_panduan";
    protected $returnType = "object";
    protected $allowedFields = ['id_panduan', 'pertanyaan', 'jawaban'];


    public function getPanduan()
    {
        return $this->db->table('tb_panduan');
    }

    public function getPanduanUser()
    {
        return $this->db->table('tb_panduan')
                ->get()
                ->getResultArray();
    }

    public function searchPanduan($keyword)
    {
        return $this->table('tb_panduan')
               ->like('pertanyaan', $keyword)
               ->orLike('jawaban', $keyword)
               ->get()
               ->getResultArray();
    }
}
