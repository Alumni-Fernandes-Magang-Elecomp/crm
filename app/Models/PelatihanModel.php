<?php

namespace App\Models;

use CodeIgniter\Model;

class PelatihanModel extends Model
{
    protected $table = 'tb_pelatihan';
    protected $primaryKey = 'id_pelatihan';
    protected $allowedFields = [
        'nama_pelatihan',
        'tgl_mulai',
        'tgl_akhir',
        'id_kota',
        'lingkup_peserta',
        'id_materi',
        'detail_materi',
        'id_penyelenggara_1',
        'id_penyelenggara_2',
        'id_penyelenggara_3'
    ];

    public function getPelatihanWithRelations()
    {
        return $this->select('tb_pelatihan.*, 
                            tb_materi.nama_materi, 
                            tb_kota.nama_kota, 
                            tb_provinsi.nama_provinsi,
                            penyelenggara1.pihak_penyelenggara as penyelenggara_1,
                            penyelenggara2.pihak_penyelenggara as penyelenggara_2,
                            penyelenggara3.pihak_penyelenggara as penyelenggara_3')
            ->join('tb_materi', 'tb_materi.id_materi = tb_pelatihan.id_materi')
            ->join('tb_kota', 'tb_kota.id_kota = tb_pelatihan.id_kota')
            ->join('tb_provinsi', 'tb_provinsi.id_provinsi = tb_kota.id_provinsi')
            ->join('tb_penyelenggara as penyelenggara1', 'penyelenggara1.id_penyelenggara = tb_pelatihan.id_penyelenggara_1', 'left')
            ->join('tb_penyelenggara as penyelenggara2', 'penyelenggara2.id_penyelenggara = tb_pelatihan.id_penyelenggara_2', 'left')
            ->join('tb_penyelenggara as penyelenggara3', 'penyelenggara3.id_penyelenggara = tb_pelatihan.id_penyelenggara_3', 'left')
            ->findAll();
    }

    public function getAvailablePelatihan($userId = null)
    {
        $builder = $this->select('tb_pelatihan.*, 
                               penyelenggara1.pihak_penyelenggara as penyelenggara_1,
                               penyelenggara2.pihak_penyelenggara as penyelenggara_2,
                               penyelenggara3.pihak_penyelenggara as penyelenggara_3')
            ->join('tb_penyelenggara as penyelenggara1', 'penyelenggara1.id_penyelenggara = tb_pelatihan.id_penyelenggara_1', 'left')
            ->join('tb_penyelenggara as penyelenggara2', 'penyelenggara2.id_penyelenggara = tb_pelatihan.id_penyelenggara_2', 'left')
            ->join('tb_penyelenggara as penyelenggara3', 'penyelenggara3.id_penyelenggara = tb_pelatihan.id_penyelenggara_3', 'left');

        if ($userId !== null) {
            $builder->join('tb_user_pelatihan', 'tb_user_pelatihan.id_pelatihan = tb_pelatihan.id_pelatihan')
                ->where('tb_user_pelatihan.id_user', $userId);
        }

        return $builder->get()->getResultArray();
    }

    public function getPelatihanDetail($idPelatihan)
    {
        return $this->select('tb_pelatihan.*, 
                        tb_materi.nama_materi, 
                        tb_kota.nama_kota, 
                        tb_provinsi.nama_provinsi,
                        p1.pihak_penyelenggara as penyelenggara_1,
                        p2.pihak_penyelenggara as penyelenggara_2,
                        p3.pihak_penyelenggara as penyelenggara_3')
            ->join('tb_materi', 'tb_materi.id_materi = tb_pelatihan.id_materi', 'left')
            ->join('tb_kota', 'tb_kota.id_kota = tb_pelatihan.id_kota', 'left')
            ->join('tb_provinsi', 'tb_provinsi.id_provinsi = tb_kota.id_provinsi', 'left')
            ->join('tb_penyelenggara as p1', 'p1.id_penyelenggara = tb_pelatihan.id_penyelenggara_1', 'left')
            ->join('tb_penyelenggara as p2', 'p2.id_penyelenggara = tb_pelatihan.id_penyelenggara_2', 'left')
            ->join('tb_penyelenggara as p3', 'p3.id_penyelenggara = tb_pelatihan.id_penyelenggara_3', 'left')
            ->where('tb_pelatihan.id_pelatihan', $idPelatihan)
            ->first();
    }
}
