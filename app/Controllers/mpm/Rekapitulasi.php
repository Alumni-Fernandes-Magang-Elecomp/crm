<?php

namespace App\Controllers\mpm;

use CodeIgniter\Controller;
use App\Models\Member_model;
use App\Models\Group_model;
use App\Models\Kirim_email_model;
use App\Models\UserModel;

class Rekapitulasi extends BaseController
{
    private $UserModel;
    public function __construct()
    {
        $this->UserModel = new UserModel();
    }

    public function index()
    {
        // Pengecekan apakah pengguna sudah login atau belum
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }
        session(); // Memulai sesi

        $selectedBulan = $this->request->getGet('bulan') ?? date('m');
        $selectedTahun = $this->request->getGet('tahun') ?? date('Y');

        $kirimEmailModel = new Kirim_email_model();
        // Ambil data laporan berdasarkan bulan dan tahun yang dipilih
        $laporan = $kirimEmailModel->getLaporanByBulanTahunGroup($selectedBulan, $selectedTahun);

        // Get only the current user's data and convert to array
        $currentUser = $this->UserModel->find(session()->get('id_user'));
        $userArray = (array)$currentUser; // Convert object to array

        $data = [
            'title' => 'Rekapitulasi',
            'laporan' => $laporan,
            'current_user' => $userArray, // Pass as array
            'selectedBulan' => $selectedBulan,
            'selectedTahun' => $selectedTahun,
            'menu' => $this->UserModel->getMenu()
        ];

        return view('user/mpm/rekapitulasi/index', $data);
    }

    public function processFilter()
    {
        // Pengecekan apakah pengguna sudah login atau belum
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }
        session(); // Memulai sesi

        // Mengambil nilai opsi filter dari form
        $selectedBulan = $this->request->getPost('bulan') ?? date('m');
        $selectedTahun = $this->request->getPost('tahun') ?? date('Y');

        // Simpan nilai opsi filter dalam sesi
        session()->set('selectedBulan', $selectedBulan);
        session()->set('selectedTahun', $selectedTahun);

        // Redirect kembali ke halaman yang sesuai
        return redirect()->to(base_url('user/mpm/rekapitulasi/index'));
    }

    public function filter()
    {
        // Pengecekan apakah pengguna sudah login atau belum
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }
        session(); // Memulai sesi

        // Memanggil fungsi processFilter untuk memproses pemilihan filter
        return $this->processFilter();
    }
}
