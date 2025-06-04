<?php

namespace App\Controllers\user;

use App\Controllers\BaseController;
use App\Models\JawabanModel;
use App\Models\TugasModel;

class Jawabanctrl extends BaseController
{
    protected $jawabanModel;
    protected $tugasModel;

    public function __construct()
    {
        $this->jawabanModel = new JawabanModel();
        $this->tugasModel = new TugasModel();
        helper(['form', 'url']);

        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        if (session()->get('role') !== 'user') {
            session()->setFlashdata('error', 'Akses tidak diizinkan');
            return redirect()->to(base_url('login'));
        }
    }

    public function kumpulkan($idTugas)
    {
        $userId = session()->get('id_user');
        $tugas = $this->tugasModel->find($idTugas);

        if (!$tugas) {
            return redirect()->to('/tugas')->with('error', 'Tugas tidak ditemukan');
        }

        $jawaban = $this->jawabanModel->where('id_user', $userId)
            ->where('id_tugas', $idTugas)
            ->first();

        $data = [
            'title' => 'Kumpulkan Jawaban',
            'tugas' => $tugas,
            'jawaban' => $jawaban,
            'validation' => \Config\Services::validation()
        ];

        return view('user/tugas/kumpulkan', $data);
    }

    public function simpan($idTugas)
    {
        $userId = session()->get('id_user');
        $tugas = $this->tugasModel->find($idTugas);

        if (!$tugas) {
            return redirect()->to('/tugas')->with('error', 'Tugas tidak ditemukan');
        }

        $validationRules = [
            'jawaban' => [
                'rules' => 'required|min_length[10]',
                'errors' => [
                    'required' => 'Isi jawaban Anda',
                    'min_length' => 'Jawaban minimal 10 karakter'
                ]
            ]
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()
                ->withInput()
                ->with('validation', $this->validator);
        }

        $existingJawaban = $this->jawabanModel->where('id_user', $userId)
            ->where('id_tugas', $idTugas)
            ->first();

        $data = [
            'id_user' => $userId,
            'id_tugas' => $idTugas,
            'jawaban' => $this->request->getPost('jawaban'),
            'waktu_pengumpulan' => date('Y-m-d H:i:s'),
            'status' => 'terkirim'
        ];

        try {
            if ($existingJawaban) {
                // Update jawaban yang sudah ada
                $data['id_jawaban'] = $existingJawaban['id_jawaban'];
                $this->jawabanModel->save($data);
                $message = 'Jawaban berhasil diperbarui';
            } else {
                // Buat jawaban baru
                $this->jawabanModel->insert($data);
                $message = 'Jawaban berhasil dikumpulkan';
            }

            return redirect()->to('/tugas/daftar_tugas/' . $tugas['id_pelatihan'])
                ->with('success', $message);
        } catch (\Exception $e) {
            log_message('error', 'Gagal menyimpan jawaban: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menyimpan jawaban. Silakan coba lagi.');
        }
    }

    public function detail($idJawaban)
    {
        $userId = session()->get('id_user');
        $jawaban = $this->jawabanModel->getJawabanDetail($idJawaban);

        if (!$jawaban || $jawaban['id_user'] != $userId) {
            return redirect()->to('/tugas')->with('error', 'Jawaban tidak ditemukan');
        }

        $data = [
            'title' => 'Detail Jawaban',
            'jawaban' => $jawaban
        ];

        return view('user/tugas/detail', $data);
    }
}
