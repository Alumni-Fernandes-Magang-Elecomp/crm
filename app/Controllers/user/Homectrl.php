<?php

namespace App\Controllers\user;

use App\Controllers\user\BaseController;
use App\Models\ArtikelModel;
use App\Models\PromoModel;
use App\Models\DataBuyersModel;
use App\Models\UserModel;


class Homectrl extends BaseController
{

    private $ArtikelModel;
    private $UserModel;
    private $PromoModel;
    private $DataBuyersModel;


    public function __construct()
    {
        $this->ArtikelModel = new ArtikelModel();
        $this->PromoModel = new PromoModel();
        $this->UserModel = new UserModel();
        $this->DataBuyersModel = new DataBuyersModel();
    }

    // protected $filters = ['usersAuth'];

    public function index()
    {
        // Pengecekan apakah pengguna sudah login atau belum
        if (!session()->get('logged_in')) {
                return redirect()->to(base_url('login')); 
                // Ubah 'login' sesuai dengan halaman login Anda
        }
        $today = date('Y-m-d');
        // $userRole = session()->get('role');
        // var_dump($userRole);
        // die;
        // $sevenDaysAgo = date('Y-m-d', strtotime('-7 days'));
        // $sevenDaysAfter = date('Y-m-d', strtotime('+7 days'));
        // Dalam controller Homectrl
        // $session = session();
        // echo 'Is User Logged In: ' . ($session->get('logged_in') ? 'Yes' : 'No');

        $data = [
            'artikelterbaru' => $this->ArtikelModel->getArtikelTerbaru(),
            'promo' => $this->PromoModel->getHomePromo($today),
            'data_buyers' => $this->DataBuyersModel->getDataBuyers(),
            'menu' => $this->UserModel->getMenu()
        ];

        // print_r($data);
        // die;

        return view('user/data_buyers/index', $data);
    }

    public function redirectToHome()
    {
        return redirect()->to('/');
    }
}
