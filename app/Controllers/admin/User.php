<?php

namespace App\Controllers\admin;

use App\Models\UserModel;
use App\Models\PelatihanUserModel;

class User extends BaseController
{
    public function index()
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

        $user_model = new UserModel();
        $all_data_user = $user_model->findAll();
        $validation = \Config\Services::validation();
        return view('admin/user/index', [
            'all_data_user' => $all_data_user,
            'validation' => $validation
        ]);
    }

    public function tambah()
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

        $user_model = new UserModel();
        $all_data_user = $user_model->findAll();

        // Get pelatihan options from database
        $db = \Config\Database::connect();
        $pelatihan_options = $db->table('tb_pelatihan')->get()->getResultArray();

        $validation = \Config\Services::validation();
        return view('admin/user/tambah', [
            'all_data_user' => $all_data_user,
            'validation' => $validation,
            'pelatihan_options' => $pelatihan_options
        ]);
    }

    public function proses_tambah()
    {
        $userModel = new UserModel();
        $pelatihanUserModel = new PelatihanUserModel();

        $data = [
            'nama_user' => $this->request->getVar("nama_user"),
            'username' => $this->request->getVar("username"),
            'role' => $this->request->getVar("role"),
            'password' => $this->request->getVar("password"),
            'hs_code' => $this->request->getVar("hs_code"),
        ];

        // Handle menu_tampil
        if ($this->request->getVar("menu_tampil")) {
            $menu_tampil = $this->request->getVar("menu_tampil");
            $data['menu_tampil'] = !empty($menu_tampil) ? implode(',', $menu_tampil) : null;
        }

        // Save user data
        $user_id = $userModel->insert($data);

        // Handle multiple pelatihan
        $pelatihan_ids = $this->request->getVar("id_pelatihan");
        if (!empty($pelatihan_ids)) {
            foreach ($pelatihan_ids as $pelatihan_id) {
                $pelatihanUserModel->insert([
                    'id_pelatihan' => $pelatihan_id,
                    'id_user' => $user_id,
                    'tgl_daftar' => date('Y-m-d H:i:s'),
                    'status' => 'aktif'
                ]);
            }
        }

        session()->setFlashdata('success', 'Data berhasil disimpan');
        return redirect()->to(base_url('admin/user/index'));
    }

    public function edit($id_user)
    {
        // Pengecekan apakah pengguna sudah login atau belum
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        // Periksa peran pengguna
        $role = session()->get('role');
        if ($role !== 'admin') {
            return redirect()->to(base_url('/'));
        }

        $user_model = new UserModel();
        $userData = $user_model->find($id_user);
        $validation = \Config\Services::validation();

        // Get pelatihan options from database
        $db = \Config\Database::connect();
        $pelatihan_options = $db->table('tb_pelatihan')->get()->getResultArray();

        return view('admin/user/edit', [
            'userData' => $userData,
            'validation' => $validation,
            'pelatihan_options' => $pelatihan_options
        ]);
    }

    // Penulis.php (Controller)
    public function proses_edit($id_user = null)
    {
        if (!$id_user) {
            return redirect()->back();
        }

        $userModel = new UserModel();
        $pelatihanUserModel = new PelatihanUserModel();

        $data = [
            'nama_user' => $this->request->getVar("nama_user"),
            'username' => $this->request->getVar("username"),
            'role' => $this->request->getVar("role"),
            'password' => $this->request->getVar("password"),
            'hs_code' => $this->request->getVar("hs_code"),
        ];

        // Handle menu_tampil
        if ($this->request->getVar("menu_tampil")) {
            $menu_tampil = $this->request->getVar("menu_tampil");
            $data['menu_tampil'] = !empty($menu_tampil) ? implode(',', $menu_tampil) : null;
        }

        // Update user data
        $userModel->update($id_user, $data);

        // Handle multiple pelatihan
        $pelatihan_ids = $this->request->getVar("id_pelatihan");

        // First, remove all existing pelatihan associations
        $pelatihanUserModel->where('id_user', $id_user)->delete();

        // Then add the new selections
        if (!empty($pelatihan_ids)) {
            foreach ($pelatihan_ids as $pelatihan_id) {
                $pelatihanUserModel->insert([
                    'id_pelatihan' => $pelatihan_id,
                    'id_user' => $id_user,
                    'tgl_daftar' => date('Y-m-d H:i:s'),
                    'status' => 'aktif'
                ]);
            }
        }

        session()->setFlashdata('success', 'Data berhasil diperbarui');
        return redirect()->to(base_url('admin/user/index'));
    }

    public function delete($id = false)
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

        $userModel = new UserModel();

        $data = $userModel->find($id);
        $userModel->delete($id);

        return redirect()->to(base_url('admin/user/index'));
    }
}
