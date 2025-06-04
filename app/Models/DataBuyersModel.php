<?php

namespace App\Models;

use CodeIgniter\Model;

class DataBuyersModel extends Model
{
    protected $table = "data_buyers";
    protected $primaryKey = "id_buyers";
    protected $returnType = "object";
    protected $allowedFields = ['id_buyers', 'negara_buyers', 'nama_perusahaan_buyers', 'email_buyers', 'website', 'produk_buyers', 'data_diambil_dari'];

    public function getDataBuyers()
    {
        // Ambil username dari sesi
        $username = $_SESSION['username'];

        // Query untuk mengambil data pengguna dari tabel tb_user berdasarkan username
        $userQuery = $this->db->table('tb_user')
            ->where('username', $username)
            ->get();

        if ($userQuery->resultID->num_rows > 0) {
            $userData = $userQuery->getRow();
            $userRole = $userData->role;


            if ($userRole === 'admin') {
                $query = $this->db->table('data_buyers')
                    ->get();
            } else {
                $hsCode = $userData->hs_code;
                $query = $this->db->table('data_buyers')
                    ->like('produk_buyers', $hsCode)
                    ->get();
            }



            return $query->getResultArray();
        } else {
            return [];
        }
    }
}
