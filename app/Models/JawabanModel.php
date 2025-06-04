<?php

namespace App\Models;

use CodeIgniter\Model;

class JawabanModel extends Model
{
    protected $table = 'tb_jawaban';
    protected $primaryKey = 'id_jawaban';
    protected $allowedFields = ['id_user', 'id_tugas', 'jawaban', 'waktu_pengumpulan', 'status', 'nilai', 'catatan'];
    protected $useTimestamps = false;

    protected $validationRules = [
        'id_user' => 'required|numeric',
        'id_tugas' => 'required|numeric',
        'jawaban' => 'required|min_length[10]',
    ];

    protected $statusMap = [
        'dikirim' => 'Dikirim',
        'dinilai' => 'Dinilai',
        'terkoreksi' => 'Terkoreksi'
    ];

    protected $validationMessages = [
        'jawaban' => [
            'required' => 'Jawaban harus diisi',
            'min_length' => 'Jawaban minimal 10 karakter'
        ]
    ];

    public function getStatusText($statusValue)
    {
        return $this->statusMap[strtolower($statusValue)] ?? 'Unknown';
    }

    public function getJawabanByUserAndTugas($userId, $tugasId)
    {
        return $this->where('id_user', $userId)
            ->where('id_tugas', $tugasId)
            ->first();
    }

    public function getJawabanWithDetail($idJawaban)
    {
        return $this->select('tb_jawaban.*, tb_tugas.judul_tugas, tb_tugas.soal, tb_user.nama')
            ->join('tb_tugas', 'tb_tugas.id_tugas = tb_jawaban.id_tugas')
            ->join('tb_user', 'tb_user.id_user = tb_jawaban.id_user')
            ->where('id_jawaban', $idJawaban)
            ->first();
    }

    public function getJawabanDetail($idJawaban)
    {
        return $this->select('tb_jawaban.*, tb_tugas.judul_tugas, tb_tugas.soal, tb_tugas.id_pelatihan, tb_pelatihan.nama_pelatihan')
            ->join('tb_tugas', 'tb_tugas.id_tugas = tb_jawaban.id_tugas')
            ->join('tb_pelatihan', 'tb_pelatihan.id_pelatihan = tb_tugas.id_pelatihan')
            ->where('tb_jawaban.id_jawaban', $idJawaban)
            ->first();
    }

    public function getPengumpulanByTugas($id_tugas)
    {
        return $this->select('tb_jawaban.*, tb_user.nama_lengkap, tb_user.email')
            ->join('tb_user', 'tb_user.id_user = tb_jawaban.id_user')
            ->where('id_tugas', $id_tugas)
            ->orderBy('waktu_pengumpulan', 'DESC')
            ->findAll();
    }
}
