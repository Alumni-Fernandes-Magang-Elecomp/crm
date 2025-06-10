<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\PromoModel;
use App\Models\PelatihanModel;
use App\Models\TugasModel;
use App\Models\JawabanModel;
use App\Models\PelatihanUserModel;

class Dashboardctrl extends BaseController
{
    protected $userModel;
    protected $promoModel;
    protected $pelatihanModel;
    protected $tugasModel;
    protected $jawabanModel;
    protected $pelatihanUserModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->promoModel = new PromoModel();
        $this->pelatihanModel = new PelatihanModel();
        $this->tugasModel = new TugasModel();
        $this->jawabanModel = new JawabanModel();
        $this->pelatihanUserModel = new PelatihanUserModel();
    }

    public function index()
    {
        // Pengecekan session dan role
        if (!session()->get('logged_in') || session()->get('role') !== 'admin') {
            return redirect()->to(base_url('login'));
        }

        // Data statistik dasar
        $data = [
            'total_users' => $this->userModel->countAll(),
            'active_promos' => $this->promoModel->where('akhir_promo >=', date('Y-m-d'))->countAllResults(),
            'expiring_soon' => $this->promoModel->where('akhir_promo BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 7 DAY)')->countAllResults(),
            'active_trainings' => $this->pelatihanModel->where('tgl_mulai <=', date('Y-m-d'))
                ->where('tgl_akhir >=', date('Y-m-d'))
                ->countAllResults(),
            'upcoming_trainings' => $this->pelatihanModel->where('tgl_mulai >', date('Y-m-d'))
                ->countAllResults(),
            'pending_tasks' => $this->jawabanModel->where('status', 'dikirim')->countAllResults(),

            // Data untuk tabel
            'recent_tasks' => $this->tugasModel->select('tb_tugas.*, tb_pelatihan.nama_pelatihan, COUNT(tb_jawaban.id_jawaban) as jumlah_pengumpulan')
                ->join('tb_pelatihan', 'tb_pelatihan.id_pelatihan = tb_tugas.id_pelatihan')
                ->join('tb_jawaban', 'tb_jawaban.id_tugas = tb_tugas.id_tugas AND tb_jawaban.status = "dikirim"', 'left')
                ->groupBy('tb_tugas.id_tugas')
                ->orderBy('tb_tugas.id_tugas', 'DESC')
                ->limit(5)
                ->findAll(),

            'upcoming_trainings_list' => $this->pelatihanModel->select('tb_pelatihan.*, tb_materi.nama_materi, tb_kota.nama_kota, COUNT(tb_pelatihan_user.id_user) as jumlah_peserta')
                ->join('tb_materi', 'tb_materi.id_materi = tb_pelatihan.id_materi')
                ->join('tb_kota', 'tb_kota.id_kota = tb_pelatihan.id_kota')
                ->join('tb_pelatihan_user', 'tb_pelatihan_user.id_pelatihan = tb_pelatihan.id_pelatihan', 'left')
                ->where('tb_pelatihan.tgl_mulai >=', date('Y-m-d'))
                ->groupBy('tb_pelatihan.id_pelatihan')
                ->orderBy('tb_pelatihan.tgl_mulai', 'ASC')
                ->limit(5)
                ->findAll(),

            'ending_promos' => $this->promoModel->where('akhir_promo >=', date('Y-m-d'))
                ->where('akhir_promo <=', date('Y-m-d', strtotime('+7 days')))
                ->orderBy('akhir_promo', 'ASC')
                ->limit(5)
                ->findAll(),

            // Data untuk chart
            'training_months' => $this->getLast6Months(),
            'training_data' => $this->getTrainingRegistrationData(),
            'activity_days' => $this->getLast7Days(),
            'task_data' => $this->getTaskSubmissionData()
        ];

        return view('admin/dashboard/index', $data);
    }

    public function routetoDashboard()
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'admin') {
            return redirect()->to(base_url('login'));
        }
        return redirect()->to(base_url('admin/dashboard'));
    }

    // Helper methods for charts
    private function getLast6Months()
    {
        $months = [];
        for ($i = 5; $i >= 0; $i--) {
            $months[] = date('M Y', strtotime("-$i months"));
        }
        return $months;
    }

    private function getTrainingRegistrationData()
    {
        $data = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = date('Y-m', strtotime("-$i months"));
            $data[] = $this->pelatihanUserModel->where("DATE_FORMAT(tgl_daftar, '%Y-%m') =", $month)
                ->countAllResults();
        }
        return $data;
    }

    private function getLast7Days()
    {
        $days = [];
        for ($i = 6; $i >= 0; $i--) {
            $days[] = date('D', strtotime("-$i days"));
        }
        return $days;
    }

    private function getTaskSubmissionData()
    {
        $data = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = date('Y-m-d', strtotime("-$i days"));
            $data[] = $this->jawabanModel->where('DATE(waktu_pengumpulan)', $date)
                ->countAllResults();
        }
        return $data;
    }
}
