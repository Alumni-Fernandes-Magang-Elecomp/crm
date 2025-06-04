<?php

namespace App\Controllers\user;

use App\Controllers\user\BaseController;
use App\Models\ArtikelModel;
use App\Models\KategoriModel;
use App\Models\UserModel;

class Artikelctrl extends BaseController
{
    private $ArtikelModel;
    private $KategoriModel;
    private $UserModel;


    public function __construct()
    {
        $this->ArtikelModel = new ArtikelModel();
        $this->KategoriModel = new KategoriModel();
        $this->UserModel = new UserModel();
    }

    public function index()
    {
        // Pengecekan apakah pengguna sudah login atau belum
        if (!session()->get('logged_in')) {
                return redirect()->to(base_url('login')); 
                // Ubah 'login' sesuai dengan halaman login Anda
        }

        $data = [
            'artikel' => $this->ArtikelModel->getArtikel(),
            'artikelpopular' => $this->ArtikelModel->getPopularArtikel(),
            'kategori' => $this->KategoriModel->getKategori(),
            'menu' => $this->UserModel->getMenu()
        ];

        // if (session('lang') === 'in') {
        //     $data['title_in'] = 'Beranda';
        // } else {
        //     $data['title_en'] = 'Home';
        // }

        return view('user/artikel/index', $data);
    }

    public function viewArtikel($id_artikel, $slug)
	{
                // Pengecekan apakah pengguna sudah login atau belum
        if (!session()->get('logged_in')) {
                return redirect()->to(base_url('login')); 
                // Ubah 'login' sesuai dengan halaman login Anda
        }
        $detail_artikel = $this->ArtikelModel->getDetailArtikel($id_artikel, $slug);

        // Tambah jumlah views
        $this->ArtikelModel->incrementViews($id_artikel);
        
        $data = [
            'artikel' => $detail_artikel[0],
            'artikel_lain' => $this->ArtikelModel->getArtikelLainnya($id_artikel, 4),
            'menu' => $this->UserModel->getMenu()
        ];

        // tampilkan 404 error jika data tidak ditemukan
		if (!$data['artikel']) {
			throw PageNotFoundException::forPageNotFound();
		}
        // var_dump($data);
        

		return view('user/artikel/detail', $data);
	}

    public function artikelKategori($id_kategori)
    {
                // Pengecekan apakah pengguna sudah login atau belum
        if (!session()->get('logged_in')) {
                return redirect()->to(base_url('login')); 
                // Ubah 'login' sesuai dengan halaman login Anda
        }

        $data = [
            'artikel' => $this->ArtikelModel->getKategoriArtikel($id_kategori),
            'judul_kategori' => $this->KategoriModel->find($id_kategori),
            'menu' => $this->UserModel->getMenu()
        ];

        // if (session('lang') === 'in') {
        //     $data['title_in'] = 'Beranda';
        // } else {
        //     $data['title_en'] = 'Home';
        // }

        return view('user/artikel/kategori', $data);
    }

}
