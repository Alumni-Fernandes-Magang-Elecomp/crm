<?php

namespace App\Models;

use CodeIgniter\Model;

class Kirim_email_model extends Model
{
    protected $table = 'tb_kirim_email';
    protected $primaryKey = 'id_kirim_email';
    protected $allowedFields = ['tgl_kirim_email', 'id_user', 'nama_perusahaan', 'negara_perusahaan', 'status_terkirim', 'progress'];

    public function getLaporan()
    {
        $query = $this->select('nama_user, DATE_FORMAT(tgl_kirim_email, "%e") as day, COUNT(*) as jumlah')
            ->join('tb_user', 'tb_user.id_user = tb_kirim_email.id_user')
            ->groupBy('nama_user, day')
            ->orderBy('nama_user, day')
            ->findAll();

        $laporan = [];
        foreach ($query as $row) {
            $laporan[$row['nama_user']]['nama_user'] = $row['nama_user'];
            $laporan[$row['nama_user']]['tgl_' . $row['day']] = $row['jumlah'];
        }

        return $laporan;
    }

    public function getLaporanByBulanTahunGroup($bulan, $tahun)
    {
        // Dapatkan username dari sesi pengguna (asumsi Anda telah memasang CodeIgniter session library)
        $username = session()->get('username');

        // Query untuk mengambil id_group berdasarkan username
        $query = $this->db->table('tb_user')
            ->select('id_group')
            ->where('username', $username)
            ->get();

        // Periksa apakah query berhasil dan apakah id_group ditemukan
        if ($query->getNumRows() > 0) {
            $row = $query->getRow();
            $id_group = $row->id_group;

            $builder = $this->db->table('tb_kirim_email');
            $builder->select('nama_user, DATE_FORMAT(tgl_kirim_email, "%e") as day, COUNT(*) as jumlah', false);
            $builder->join('tb_user', 'tb_user.id_user = tb_kirim_email.id_user'); // Mengubah 'tb_member' menjadi 'tb_user'
            $builder->join('tb_group', 'tb_group.id_group = tb_user.id_group'); // Mengubah 'tb_member' menjadi 'tb_user'
            if (!empty($bulan) && $bulan !== "all") {
                $builder->where('MONTH(tgl_kirim_email)', $bulan);
            }

            if (!empty($tahun) && $tahun !== "all") {
                $builder->where('YEAR(tgl_kirim_email)', $tahun);
            }

            if (!empty($id_group && $id_group !== "all")) {
                $builder->where('tb_group.id_group', $id_group);
            }
            $builder->groupBy('nama_user, day');
            $builder->orderBy('nama_user, day');

            $query = $builder->get();

            $laporan = [];
            foreach ($query->getResultArray() as $row) {
                $laporan[$row['nama_user']]['nama_user'] = $row['nama_user'];
                $laporan[$row['nama_user']]['tgl_' . $row['day']] = $row['jumlah'];
            }

            return $laporan;
        } else {
            // Handle jika id_group tidak ditemukan
            return array();
        }
    }


    public function getTotalNegara()
    {
        // Dapatkan username dari sesi pengguna (asumsi Anda telah memasang CodeIgniter session library)
        $username = session()->get('username');

        // Query untuk mengambil id_group berdasarkan username
        $query = $this->db->table('tb_user')
            ->select('id_group')
            ->where('username', $username)
            ->get();

        // Periksa apakah query berhasil dan apakah id_group ditemukan
        if ($query->getNumRows() > 0) {
            $row = $query->getRow();
            $id_group = $row->id_group;

            $negaraQuery = $this->db->table('tb_kirim_email')
                ->select('tb_kirim_email.negara_perusahaan, COUNT(tb_kirim_email.negara_perusahaan) AS total_negara', false)
                ->join('tb_user', 'tb_user.id_user = tb_kirim_email.id_user') // Mengubah 'tb_member' menjadi 'tb_user'
                ->join('tb_group', 'tb_group.id_group = tb_user.id_group') // Mengubah 'tb_member' menjadi 'tb_user'
                ->where('tb_group.id_group', $id_group)
                ->groupBy('tb_kirim_email.negara_perusahaan')
                ->get();

            // return $query->get()->getResult();
            return $negaraQuery->getResultArray();
        } else {
            // Handle jika id_group tidak ditemukan
            return array();
        }
    }
}
