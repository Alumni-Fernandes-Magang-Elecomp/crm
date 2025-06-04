<?php

namespace App\Models;

use CodeIgniter\Model;

class TugasModel extends Model
{
    protected $table = 'tb_tugas';
    protected $primaryKey = 'id_tugas';
    protected $allowedFields = ['id_pelatihan', 'judul_tugas', 'soal', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function pelatihan()
    {
        return $this->belongsTo('App\Models\PelatihanModel', 'id_pelatihan');
    }

    public function jawaban()
    {
        return $this->hasMany('App\Models\JawabanModel', 'id_tugas');
    }

    public function getTugasWithJawaban($idTugas, $userId)
    {
        return $this->select('tb_tugas.*, tb_jawaban.jawaban, tb_jawaban.waktu_pengumpulan, tb_jawaban.status, tb_jawaban.nilai, tb_jawaban.catatan')
            ->join('tb_jawaban', 'tb_jawaban.id_tugas = tb_tugas.id_tugas AND tb_jawaban.id_user = ' . $userId, 'left')
            ->where('tb_tugas.id_tugas', $idTugas)
            ->first();
    }

    public function getTugasDetail($idTugas, $userId)
    {
        return $this->select('tb_tugas.*, tb_pelatihan.nama_pelatihan, tb_jawaban.jawaban, 
                         tb_jawaban.waktu_pengumpulan, tb_jawaban.status, tb_jawaban.nilai, 
                         tb_jawaban.catatan, tb_jawaban.id_jawaban')
            ->join('tb_pelatihan', 'tb_pelatihan.id_pelatihan = tb_tugas.id_pelatihan')
            ->join('tb_jawaban', 'tb_jawaban.id_tugas = tb_tugas.id_tugas AND tb_jawaban.id_user = ' . $userId, 'left')
            ->where('tb_tugas.id_tugas', $idTugas)
            ->first();
    }
}
