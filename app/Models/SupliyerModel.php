<?php

namespace App\Models;

use CodeIgniter\Model;

class SupliyerModel extends Model
{
    protected $table = 'tb_supliyer';
    protected $primaryKey = 'id_supliyer';
    protected $returnType = 'object';
    protected $allowedFields = ['id_supliyer', 'hs_code', 'nama_supliyer', 'almt_supliyer', 'no_telp', 'data_diambil_dari'];

    public function getDataSupliyer()
    {
        // Ambil username dari sesi
        $username = $_SESSION['username'];

        // Ambil data user berdasarkan username
        $userQuery = $this->db->table('tb_user')
            ->where('username', $username)
            ->get();

        if ($userQuery->resultID->num_rows > 0) {
            $userData = $userQuery->getRow();
            $userRole = $userData->role;

            // Mulai query dengan join ke tabel tb_hscode
            $builder = $this->db->table('tb_supliyer');
            $builder->select('tb_supliyer.*, tb_hscode.deskripsi as deskripsi_hs');
            $builder->join('tb_hscode', 'tb_supliyer.hs_code = tb_hscode.hs_code', 'left');

            if ($userRole === 'admin') {
                // Admin bisa melihat semua data supliyer
                $query = $builder->get();
            } else {
                // User biasa hanya melihat supliyer berdasarkan hs_code
                $hsCode = $userData->hs_code;
                $query = $builder->like('tb_supliyer.hs_code', $hsCode)->get();
            }

            return $query->getResultArray();
        } else {
            return [];
        }
    }
}
