<?php

namespace App\Controllers\user;

use App\Controllers\user\BaseController;
use App\Models\PelatihanModel;
use App\Models\PelatihanUserModel;
use App\Models\UserModel;

class PelatihanUserctrl extends BaseController
{
    private $PelatihanModel;
    private $PelatihanUserModel;
    private $UserModel;

    public function __construct()
    {
        $this->PelatihanModel = new PelatihanModel();
        $this->PelatihanUserModel = new PelatihanUserModel();
        $this->UserModel = new UserModel();
    }

    public function index()
    {
        // Cek session login
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        // Ambil ID user dari session
        $userId = session()->get('id_user');

        // Ambil data pelatihan yang diikuti user
        $pelatihanUser = $this->PelatihanUserModel->getPelatihanByUser($userId);

        $data = [
            'pelatihan' => $pelatihanUser,
            'menu' => $this->UserModel->getMenu(),
            'title' => 'Daftar Pelatihan Saya'
        ];

        return view('user/tugas/index', $data);
    }
}
