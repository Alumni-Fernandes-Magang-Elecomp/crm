<?php

namespace App\Controllers\user;

use App\Controllers\BaseController;
use App\Models\PelatihanUserModel;
use App\Models\PelatihanModel;

class Pelatihan extends BaseController // Ubah nama class
{
    protected $pelatihanUserModel;
    protected $pelatihanModel;

    public function __construct()
    {
        $this->pelatihanUserModel = new PelatihanUserModel();
        $this->pelatihanModel = new PelatihanModel();
    }

    public function index()
    {
        $userId = session()->get('id_user');

        // Tambahkan validasi jika user belum login
        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu');
        }

        $data = [
            'title' => 'Pelatihan Saya',
            'pelatihan' => $this->pelatihanUserModel->getPelatihanByUser($userId),
            'active' => 'pelatihan'
        ];

        return view('user/tugas/index', $data);
    }

    public function detail($idPelatihan)
    {
        $userId = session()->get('id_user');

        // Validasi apakah user benar mengikuti pelatihan ini
        $pelatihan = $this->pelatihanUserModel->where([
            'id_pelatihan' => $idPelatihan,
            'id_user' => $userId
        ])->first();

        if (!$pelatihan) {
            return redirect()->to('/pelatihan')->with('error', 'Anda tidak terdaftar pada pelatihan ini');
        }

        $data = [
            'title' => 'Detail Pelatihan',
            'pelatihan' => $this->pelatihanModel->getPelatihanDetail($idPelatihan),
            'active' => 'pelatihan'
        ];

        return view('user/pelatihan/detail', $data);
    }
}
