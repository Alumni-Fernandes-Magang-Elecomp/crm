<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;

class Dashboardctrl extends BaseController
{
    public function index()
    {
        // Pengecekan apakah pengguna sudah login atau belum
        if (!session()->get('logged_in')) {
            // Jika pengguna belum login, arahkan ke halaman login
            return redirect()->to(base_url('login'));
        }

        // Periksa peran pengguna
        $role = session()->get('role');
        if ($role !== 'admin') {
            // Jika peran bukan admin, arahkan ke halaman lain (misal: user)
            return redirect()->to(base_url('/')); // Sesuaikan dengan URL halaman user
        }

        return view('admin/dashboard/index');
    }

    public function routetoDashboard()
    {
        // Pengecekan apakah pengguna sudah login atau belum
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
            // Ubah 'login' sesuai dengan halaman login Anda
        }

        // Periksa peran pengguna
        $role = session()->get('role');
        if ($role !== 'admin') {
            // Jika peran bukan admin, arahkan ke halaman lain (misal: user)
            return redirect()->to(base_url('/')); // Sesuaikan dengan URL halaman user
        }

        return redirect()->to(base_url('admin/dashboard'));
    }
}
