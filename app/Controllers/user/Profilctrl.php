<?php

namespace App\Controllers\user;

use App\Models\UserModel;
use App\Models\PelatihanModel;
use App\Models\KotaModel;

class Profilctrl extends BaseController
{
    public function edit()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        $userModel = new UserModel();
        $pelatihanModel = new PelatihanModel();
        $kotaModel = new KotaModel();

        $data['profil_pengguna'] = $userModel->getProfil();
        $data['menu'] = $userModel->getMenu();

        // Tambahkan data untuk dropdown
        $data['daftar_pelatihan'] = $pelatihanModel->findAll();
        $data['daftar_kota'] = $kotaModel->findAll();

        $username_sebelum = $_SESSION['username'];

        if ($this->request->getMethod() === 'post') {
            $data = [
                'nama_user' => $this->request->getPost('nama_user'),
                'alamat_user' => $this->request->getPost('alamat_user'),
                'telp_user' => $this->request->getPost('telp_user'),
                'email_user' => $this->request->getPost('email_user'),
                'hs_code' => $this->request->getPost('hs_code'),
                'username' => $this->request->getPost('username'),
                'password' => $this->request->getPost('password'),
                'id_pelatihan' => $this->request->getPost('id_pelatihan'),
                'id_kota' => $this->request->getPost('id_kota'),
            ];

            $userModel->where('username', $username_sebelum);
            $userModel->set($data);
            $userModel->update();

            if ($userModel->affectedRows() > 0) {
                session()->setFlashdata('success', 'Profil berhasil diubah.');

                if ($data['username'] !== $username_sebelum) {
                    return redirect()->to(base_url('logout'));
                } else {
                    return redirect()->to(base_url('profil'));
                }
            } else {
                session()->setFlashdata('error', 'Terjadi kesalahan dalam pembaruan profil.');
            }
        }

        return view('user/profil/edit', $data);
    }
}
