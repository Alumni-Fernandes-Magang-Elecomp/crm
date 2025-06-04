<?php

namespace App\Models;

use CodeIgniter\Model;

class PanduanTambahanModel extends Model
{
    protected $table = "tb_panduan_tambahan";
    protected $primaryKey = "id_panduan";
    protected $returnType = "object";
    protected $allowedFields = ['id_panduan', 'pertanyaan', 'jawaban', 'id_user'];

    public function getPanduanTambahan()
    {
        return $this->db->table('tb_panduan_tambahan')
                ->get()
                ->getResultArray();
    }

    public function getPanduanUserTambahan()
    {
        // Pastikan bahwa $_SESSION['username'] ada dan memiliki nilai
        if (isset($_SESSION['username'])) {
            // Ambil data panduan khusus dari pengguna yang sedang login
            $userData = $this->db->table('tb_user')
                ->select('id_user')
                ->where('username', $_SESSION['username'])
                ->get()
                ->getRow();
    
            if ($userData) {
                // Ambil ID pengguna dari $userData
                $id_user = $userData->id_user;
    
                // Kode untuk mencari panduan yang sesuai
                $panduanSesuai = $this->db->table('tb_panduan_tambahan')
                    ->where("id_user LIKE", "%#{$id_user}#%") // Menggunakan LIKE untuk mencocokkan setidaknya satu ID pengguna
                    ->get()
                    ->getResultArray();
    
                return $panduanSesuai;
            }
        }
    
        return []; // Return array kosong jika tidak ada data pengguna atau $_SESSION['username'] tidak ada
    }
    

    // public function searchPanduan($keyword)
    // {
    //     return $this->table('tb_panduan')
    //             ->where('kategori_panduan', 'umum')
    //            ->like('pertanyaan', $keyword)
    //            ->orLike('jawaban', $keyword)
    //            ->get()
    //            ->getResultArray();
    // }
}
