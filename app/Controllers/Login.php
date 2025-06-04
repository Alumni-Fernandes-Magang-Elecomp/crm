<?php

namespace App\Controllers;

use App\Models\UserModel;

class Login extends BaseController
{
    public function index()
    {
        // Pengecekan jika pengguna sudah login
        if (session()->get('logged_in')) {
            // Jika pengguna sudah login, arahkan ke halaman dashboard
            return redirect()->to(base_url('admin/dashboard'));
        }

        // Tampilkan halaman login jika pengguna belum login
        return view('admin/login/index');
    }

    public function process()
    {
        $users = new UserModel();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        // Find user with case-insensitive username comparison
        $dataUser = $users->where('LOWER(username)', strtolower($username))->first();

        if ($dataUser) {
            // Check password - first try direct comparison (for legacy)
            // Then try password_verify if using hashed passwords
            if ($password === $dataUser->password || password_verify($password, $dataUser->password)) {
                // Password matches, set session
                session()->set([
                    'id_user' => $dataUser->id_user,
                    'username' => $dataUser->username,
                    'logged_in' => true,
                    'role' => $dataUser->role
                ]);

                // Role-based redirect
                if ($dataUser->role == 'admin') {
                    return redirect()->to(base_url('admin'));
                } else {
                    return redirect()->to(base_url('/'));
                }
            } else {
                session()->setFlashdata('error', 'Username & Password Salah');
                return redirect()->to(base_url('login'));
            }
        } else {
            session()->setFlashdata('error', 'Username & Password Salah');
            return redirect()->to(base_url('login'));
        }
    }


    public function logout()
    {
        // Hapus semua data sesi dan arahkan ke halaman login
        session()->destroy();
        return redirect()->to(base_url('login'));
    }
}
