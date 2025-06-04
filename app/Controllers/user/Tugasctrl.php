<?php

namespace App\Controllers\user;

use App\Controllers\BaseController;
use App\Models\TugasModel;
use App\Models\PelatihanModel;
use App\Models\UserModel;
use App\Models\JawabanModel;

class Tugasctrl extends BaseController
{
    protected $tugasModel;
    protected $pelatihanModel;
    protected $userModel;

    public function __construct()
    {
        $this->tugasModel = new TugasModel();
        $this->pelatihanModel = new PelatihanModel();
        $this->userModel = new UserModel();
        helper(['form', 'url']);

        // Verify session in constructor
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        // Additional verification for user role
        if (session()->get('role') !== 'user') {
            session()->setFlashdata('error', 'Unauthorized access');
            return redirect()->to(base_url('login'));
        }
    }

    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        $userId = session()->get('id_user');
        $members = $this->tugasModel->getTugasByUser($userId);

        $data = [
            'title' => 'Tugas',
            'members' => $members,
            'validation' => \Config\Services::validation()
        ];

        return view('user/tugas/index', $data);
    }

    public function daftar($id_pelatihan)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        $userId = session()->get('id_user');

        // Get pelatihan details
        $pelatihan = $this->pelatihanModel->find($id_pelatihan);
        if (!$pelatihan) {
            return redirect()->to('/tugas')->with('error', 'Pelatihan tidak ditemukan');
        }

        // Get tugas list for this pelatihan with user's submission status
        $tugasModel = new TugasModel();
        $jawabanModel = new JawabanModel();

        $tugasList = $tugasModel->where('id_pelatihan', $id_pelatihan)->findAll();

        // Add submission status to each tugas
        foreach ($tugasList as &$tugas) {
            $jawaban = $jawabanModel->where('id_tugas', $tugas['id_tugas'])
                ->where('id_user', $userId)
                ->first();
            if ($jawaban) {
                $tugas['jawaban'] = $jawaban;
            }
        }

        $data = [
            'title' => 'Daftar Tugas Pelatihan',
            'pelatihan' => $pelatihan,
            'tugasList' => $tugasList
        ];

        return view('user/tugas/daftar_tugas', $data);
    }

    public function kumpulkan($idPelatihan = null)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        $userId = session()->get('id_user');

        // Get user's pelatihan ID - pastikan hasilnya array
        $userModel = new UserModel();
        $user = $userModel->find($userId);

        // Konversi ke array jika hasilnya object
        if (is_object($user)) {
            $user = (array)$user;
        }

        $userPelatihanId = $user['id_pelatihan'] ?? null;

        if ($idPelatihan === null) {
            // Only show pelatihan that matches user's id_pelatihan
            $pelatihanData = $this->pelatihanModel->where('id_pelatihan', $userPelatihanId)->findAll();

            // Konversi setiap item ke array jika perlu
            $pelatihan = [];
            foreach ($pelatihanData as $item) {
                $pelatihan[] = is_object($item) ? (array)$item : $item;
            }

            $data = [
                'title' => 'Pilih Pelatihan',
                'pelatihan' => $pelatihan,
                'validation' => \Config\Services::validation()
            ];
            return view('user/tugas/pilih_pelatihan', $data);
        }

        // Verify the requested pelatihan matches user's assigned pelatihan
        if ($idPelatihan != $userPelatihanId) {
            return redirect()->to('/tugas/kumpulkan')->with('error', 'Anda tidak memiliki akses ke pelatihan ini');
        }

        $pelatihan = $this->pelatihanModel->find($idPelatihan);
        // Konversi ke array jika hasilnya object
        if (is_object($pelatihan)) {
            $pelatihan = (array)$pelatihan;
        }

        if (!$pelatihan) {
            return redirect()->to('/tugas/kumpulkan')->with('error', 'Pelatihan tidak ditemukan');
        }

        $data = [
            'title' => 'Kumpulkan Tugas - ' . $pelatihan['nama_pelatihan'],
            'pelatihan' => $pelatihan,
            'validation' => \Config\Services::validation()
        ];

        return view('user/tugas/kumpulkan', $data);
    }

    public function proses_kumpulkan()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'))->with('error', 'Session expired, please login again');
        }

        $userId = session()->get('id_user');

        // Verify user exists in database
        $user = $this->userModel->find($userId);
        if (!$user) {
            session()->destroy();
            return redirect()->to(base_url('login'))->with('error', 'User not found, please login again');
        }

        // Rest of your validation and processing...
        $validationRules = [
            'id_pelatihan' => [
                'rules' => 'required|is_not_unique[tb_pelatihan.id_pelatihan]',
                'errors' => [
                    'required' => 'Pilih pelatihan terlebih dahulu',
                    'is_not_unique' => 'Pelatihan tidak valid'
                ]
            ],
            'hasil' => [
                'rules' => 'required|min_length[10]',
                'errors' => [
                    'required' => 'Isi hasil tugas Anda',
                    'min_length' => 'Hasil tugas minimal 10 karakter'
                ]
            ]
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()
                ->withInput()
                ->with('validation', $this->validator);
        }

        $data = [
            'id_user' => $userId,
            'id_pelatihan' => $this->request->getPost('id_pelatihan'),
            'hasil' => $this->request->getPost('hasil'),
            'waktu_pengumpulan' => date('Y-m-d H:i:s')
        ];

        try {
            $saveResult = $this->tugasModel->save($data);

            if (!$saveResult) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Gagal mengumpulkan tugas. Silakan coba lagi.');
            }

            return redirect()->to('/tugas')->with('success', 'Tugas berhasil dikumpulkan');
        } catch (\Exception $e) {
            log_message('error', 'Exception when saving tugas: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal mengumpulkan tugas. Silakan coba lagi.');
        }
    }

    public function detail($idTugas)
    {
        $userId = session()->get('id_user');

        $tugas = $this->tugasModel->getTugasDetail($idTugas, $userId);

        if (!$tugas) {
            return redirect()->back()->with('error', 'Tugas tidak ditemukan');
        }

        $data = [
            'title' => 'Detail Tugas - ' . $tugas['judul_tugas'],
            'tugas' => $tugas
        ];

        return view('user/tugas/detail', $data);
    }

    public function edit($idTugas)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        $userId = session()->get('id_user');
        $tugas = $this->tugasModel->find($idTugas);

        if (!$tugas || $tugas['id_user'] != $userId) {
            return redirect()->to('/tugas')->with('error', 'Tugas tidak ditemukan');
        }

        $data = [
            'title' => 'Edit Tugas',
            'tugas' => $tugas,
            'pelatihan' => $this->pelatihanModel->findAll(),
            'validation' => \Config\Services::validation()
        ];

        return view('user/tugas/edit', $data);
    }

    public function proses_edit($idTugas)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        $userId = session()->get('id_user');
        $tugas = $this->tugasModel->find($idTugas);

        if (!$tugas || $tugas['id_user'] != $userId) {
            return redirect()->to('/tugas')->with('error', 'Tugas tidak ditemukan');
        }

        $validationRules = [
            'id_pelatihan' => [
                'rules' => 'required|is_not_unique[tb_pelatihan.id_pelatihan]',
                'errors' => [
                    'required' => 'Pilih pelatihan terlebih dahulu',
                    'is_not_unique' => 'Pelatihan tidak valid'
                ]
            ],
            'hasil' => [
                'rules' => 'required|min_length[10]',
                'errors' => [
                    'required' => 'Isi hasil tugas Anda',
                    'min_length' => 'Hasil tugas minimal 10 karakter'
                ]
            ]
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'id_tugas' => $idTugas,
            'id_pelatihan' => $this->request->getPost('id_pelatihan'),
            'hasil' => $this->request->getPost('hasil')
        ];

        try {
            $this->tugasModel->save($data);
            return redirect()->to('/tugas')->with('success', 'Tugas berhasil diperbarui');
        } catch (\Exception $e) {
            log_message('error', 'Gagal mengupdate tugas: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui tugas. Silakan coba lagi.');
        }
    }

    public function delete($idTugas)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        $userId = session()->get('id_user');
        $tugas = $this->tugasModel->find($idTugas);

        if (!$tugas || $tugas['id_user'] != $userId) {
            return redirect()->to('/tugas')->with('error', 'Tugas tidak ditemukan');
        }

        try {
            $this->tugasModel->delete($idTugas);
            return redirect()->to('/tugas')->with('success', 'Tugas berhasil dihapus');
        } catch (\Exception $e) {
            log_message('error', 'Gagal menghapus tugas: ' . $e->getMessage());
            return redirect()->to('/tugas')->with('error', 'Gagal menghapus tugas');
        }
    }

    // Add this method to your existing Tugasctrl controller
    public function submitJawaban($idTugas)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        $userId = session()->get('id_user');
        $jawabanModel = new JawabanModel();

        // Check if tugas exists
        $tugas = $this->tugasModel->find($idTugas);
        if (!$tugas) {
            return redirect()->to('/tugas')->with('error', 'Tugas tidak ditemukan');
        }

        // Check if user has already submitted
        $existingJawaban = $jawabanModel->getJawabanByUserAndTugas($userId, $idTugas);

        $data = [
            'title' => 'Kumpulkan Jawaban',
            'tugas' => $tugas,
            'jawaban' => $existingJawaban,
            'validation' => \Config\Services::validation()
        ];

        return view('user/tugas/submit_jawaban', $data);
    }

    public function prosesSubmitJawaban($idTugas)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        $userId = session()->get('id_user');
        $jawabanModel = new JawabanModel();

        // Validation rules
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

        // Check if tugas exists
        $tugas = $this->tugasModel->find($idTugas);
        if (!$tugas) {
            return redirect()->to('/tugas')->with('error', 'Tugas tidak ditemukan');
        }

        // Prepare data
        $data = [
            'id_user' => $userId,
            'id_tugas' => $idTugas,
            'jawaban' => $this->request->getPost('jawaban'),
            'waktu_pengumpulan' => date('Y-m-d H:i:s'),
            'status' => 'terkirim'
        ];

        // Check if user has already submitted
        $existingJawaban = $jawabanModel->getJawabanByUserAndTugas($userId, $idTugas);

        try {
            if ($existingJawaban) {
                // Update existing jawaban
                $data['id_jawaban'] = $existingJawaban['id_jawaban'];
                $jawabanModel->save($data);
                $message = 'Jawaban berhasil diperbarui';
            } else {
                // Insert new jawaban
                $jawabanModel->insert($data);
                $message = 'Jawaban berhasil dikumpulkan';
            }

            return redirect()->to('/tugas/daftar/' . $tugas['id_pelatihan'])->with('success', $message);
        } catch (\Exception $e) {
            log_message('error', 'Error submitting jawaban: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal mengumpulkan jawaban. Silakan coba lagi.');
        }
    }
}
