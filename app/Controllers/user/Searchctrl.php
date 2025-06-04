<?php

namespace App\Controllers\user;

use App\Controllers\user\BaseController;
use App\Models\KategoriModel;
use App\Models\ArtikelModel;
use App\Models\UserModel;

class searchctrl extends BaseController
{
    private $KategoriModel;
    private $ArtikelModel;
    private $UserModel;
    

    public function __construct()
    {
        $this->KategoriModel = new KategoriModel();
        $this->ArtikelModel = new ArtikelModel();
        $this->UserModel = new UserModel();
    }

    public function search()
    {
        $keyword = $this->request->getGet('q');

        // Lakukan pencarian ke database dengan menggunakan model
        $data = [
            'kategori' => $this->KategoriModel->getKategori(),
            'artikel' => $this->ArtikelModel->searchArtikel($keyword),
            'menu' => $this->UserModel->getMenu()
        ];

        // Kirim data hasil pencarian ke tampilan yang sesuai (misalnya, halaman home)
        return view('user/search', $data);
    }
}