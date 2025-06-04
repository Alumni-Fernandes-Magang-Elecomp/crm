<?php

namespace App\Controllers\mpm;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\Kirim_email_model; 

class Dashboard extends BaseController
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
                // Ubah 'login' sesuai dengan halaman login Anda
        }
        session(); // Memulai sesi

        $userModel = new UserModel();
        $username = session()->get('username');
        $memberEmails = $userModel->getProgressByMemberGroup();
        $members = $userModel->where('username', $username)->findAll();

        // Sertakan Kirim_email_model jika diperlukan
        $kirimemailModel = new Kirim_email_model();
        // $id_group = session()->get('username');
        $kirimEmails = $kirimemailModel->getTotalNegara();

        // Fungsi untuk mengurutkan data secara descending (dari terbesar ke terkecil) berdasarkan kirim_emails_count
        usort($memberEmails, function ($a, $b) {
            return $b['kirim_emails_count'] - $a['kirim_emails_count'];
        });

        $data = [
            'title' => 'Dashboard',
            'nama_user' => $members,
            'memberEmails' => $memberEmails,
            'kirimEmails' => $kirimEmails, // Pastikan Anda telah mendefinisikan $kirimEmails
            'menu' => $this->UserModel->getMenu()
        ];
        
        // print_r($data);
        // die;
        
        return view('user/mpm/dashboard/index', $data);

    }
}
