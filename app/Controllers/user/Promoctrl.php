<?php

namespace App\Controllers\user;

use App\Controllers\user\BaseController;
use App\Models\PromoModel;
use App\Models\UserModel;

class Promoctrl extends BaseController
{
    private $PromoModel;
    private $UserModel;

    public function __construct()
    {
        $this->PromoModel = new PromoModel();
        $this->UserModel = new UserModel();
    }

    public function index()
    {
        // Pengecekan apakah pengguna sudah login atau belum
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        $today = date('Y-m-d');

        // Get active promos (both ongoing and upcoming)
        $promo_terdekat = $this->PromoModel
            ->where('akhir_promo >=', $today)
            ->orderBy('mulai_promo', 'ASC')
            ->findAll();

        // Debugging - uncomment to check what data is being fetched
        // dd($promo_terdekat);

        $data = [
            'promo' => $promo_terdekat,
            'menu' => $this->UserModel->getMenu()
        ];

        return view('user/promo/index', $data);
    }

    public function viewPromo($id_promo)
    {
        // Pengecekan apakah pengguna sudah login atau belum
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
            // Ubah 'login' sesuai dengan halaman login Anda
        }
        $data = [
            'promo' => $this->PromoModel->find($id_promo),
            'promo_lain' => $this->PromoModel->getPromoLainnya($id_promo, 4),
            'menu' => $this->UserModel->getMenu()
        ];


        return view('user/promo/detail', $data);
    }
}
