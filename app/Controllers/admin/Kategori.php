<?php

namespace App\Controllers\admin;

use App\Models\KategoriModel;

class Kategori extends BaseController
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

        $kategori_model = new KategoriModel();
        $all_data_kategori = $kategori_model->findAll();
        $validation = \Config\Services::validation();
        return view('admin/kategori/index', [
            'all_data_kategori' => $all_data_kategori,
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

        $kategori_model = new KategoriModel();
        $all_data_kategori = $kategori_model->findAll();
        $validation = \Config\Services::validation();
        return view('admin/kategori/tambah', [
            'all_data_kategori' => $all_data_kategori,
            'validation' => $validation
        ]);
    }
    public function proses_tambah()
    {
        $kategoriModel = new KategoriModel();
        $data = [
            'nama_kategori' => $this->request->getVar("nama_kategori"),
        ];
        $kategoriModel->save($data);

        session()->setFlashdata('success', 'Data berhasil disimpan');
        return redirect()->to(base_url('admin/kategori/index'));
    }

    public function edit($id_kategori)
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

        $kategori_model = new KategoriModel();
        $kategoriData = $kategori_model->find($id_kategori);
        $validation = \Config\Services::validation();

        return view('admin/kategori/edit', [
            'kategoriData' => $kategoriData,
            'validation' => $validation
        ]);
    }

    public function proses_edit($id_kategori = null)
    {
        if (!$id_kategori) {
            return redirect()->back();
        }

        $kategoriModel = new KategoriModel();
        $kategoriData = $kategoriModel->find($id_kategori);

        // Update the 'foto_produk' field in the database with a "where" clause
        $kategoriModel->where('id_kategori', $id_kategori)->set([
            'nama_kategori' => $this->request->getPost("nama_kategori"),
        ])->update();

        session()->setFlashdata('success', 'Berkas berhasil diperbarui');
        return redirect()->to(base_url('admin/kategori/index'));
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

        $kategoriModel = new KategoriModel();

        $data = $kategoriModel->find($id);

        $kategoriModel->delete($id);

        return redirect()->to(base_url('admin/kategori/index'));
    }
}
