<?php

namespace App\Controllers\user;

use App\Controllers\user\BaseController;
use App\Models\PanduanModel;
use App\Models\PanduanTambahanModel;
use App\Models\UserModel;

class Panduanctrl extends BaseController
{
    private $PanduanModel;
    private $PanduanTambahanModel;
    private $UserModel;

    public function __construct()
    {
        $this->PanduanModel = new PanduanModel();
        $this->PanduanTambahanModel = new PanduanTambahanModel();
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

            'panduan' => $this->PanduanModel->getPanduanUser(),
            'panduan_tambahan' => $this->PanduanTambahanModel->getPanduanUserTambahan(),
            'menu' => $this->UserModel->getMenu()
        ];

        return view('user/panduan/index', $data);
    }

    public function viewPanduan($id_panduan)
    {
                // Pengecekan apakah pengguna sudah login atau belum
        if (!session()->get('logged_in')) {
                return redirect()->to(base_url('login')); 
                // Ubah 'login' sesuai dengan halaman login Anda
        }
        $data = [
            'panduan' => $this->PanduanModel->find($id_panduan),
            'menu' => $this->UserModel->getMenu()
        ];


        return view('user/panduan/detail', $data);
    }
    
    public function viewPanduanTambahan($id_panduan)
    {
                // Pengecekan apakah pengguna sudah login atau belum
        if (!session()->get('logged_in')) {
                return redirect()->to(base_url('login')); 
                // Ubah 'login' sesuai dengan halaman login Anda
        }
        $data = [
            'panduan_tambahan' => $this->PanduanTambahanModel->find($id_panduan),
            'menu' => $this->UserModel->getMenu()
        ];


        return view('user/panduan/detail_tambahan', $data);
    }

    public function search()
    {
                // Pengecekan apakah pengguna sudah login atau belum
        if (!session()->get('logged_in')) {
                return redirect()->to(base_url('login')); 
                // Ubah 'login' sesuai dengan halaman login Anda
        }
        $keyword = $this->request->getGet('p');

        // Lakukan pencarian ke database dengan menggunakan model
        $data = [
            'panduan' => $this->PanduanModel->searchPanduan($keyword),
            'menu' => $this->UserModel->getMenu()
        ];

        // Kirim data hasil pencarian ke tampilan yang sesuai (misalnya, halaman home)
        return view('user/panduan/search', $data);
    }
}
