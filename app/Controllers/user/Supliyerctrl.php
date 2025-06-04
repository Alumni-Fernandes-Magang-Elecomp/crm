<?php

namespace App\Controllers\user;

use App\Controllers\user\BaseController;
use App\Models\SupliyerModel;
use App\Models\UserModel;

class Supliyerctrl extends BaseController
{
    private $SupliyerModel;
    private $UserModel;

    public function __construct()
    {
        $this->SupliyerModel = new SupliyerModel();
        $this->UserModel = new UserModel();
    }

    public function index()
    {
        // Cek apakah user sudah login
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        $data = [
            'data_supliyer' => $this->SupliyerModel->getDataSupliyer(),
            'menu' => $this->UserModel->getMenu(),
        ];

        return view('user/supliyer/index', $data);
    }
}
