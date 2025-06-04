<?php

namespace App\Controllers\admin;

use App\Models\PanduanModel;

class Panduan extends BaseController
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

        $panduan_model = new PanduanModel();
        $all_data_panduan = $panduan_model->findAll();
        $validation = \Config\Services::validation();
        return view('admin/panduan/index', [
            'all_data_panduan' => $all_data_panduan,
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

        $panduan_model = new PanduanModel();
        $all_data_panduan = $panduan_model->findAll();
        $validation = \Config\Services::validation();
        return view('admin/panduan/tambah', [
            'all_data_panduan' => $all_data_panduan,
            'validation' => $validation
        ]);
    }

    public function proses_tambah()
    {
        $panduanModel = new PanduanModel();
        $data = [
            'pertanyaan' => $this->request->getVar("pertanyaan"),
            'jawaban' => $this->request->getVar("jawaban"),
        ];
        $panduanModel->save($data);

        session()->setFlashdata('success', 'Data berhasil disimpan');
        return redirect()->to(base_url('admin/panduan/index'));
    }

    public function edit($id_panduan)
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

        $panduan_model = new PanduanModel();
        $panduanData = $panduan_model->find($id_panduan);
        $validation = \Config\Services::validation();

        return view('admin/panduan/edit', [
            'panduanData' => $panduanData,
            'validation' => $validation
        ]);
    }

    // Penulis.php (Controller)
    public function proses_edit($id_panduan = null)
    {
        if (!$id_panduan) {
            return redirect()->back();
        }

        $panduanModel = new PanduanModel();
        $panduanData = $panduanModel->find($id_panduan);

        // Check if new 'foto_penulis' file is uploaded

        // If no new 'foto_penulis' file is uploaded, update only the other fields
        $panduanModel->where('id_panduan', $id_panduan)->set([
            'pertanyaan' => $this->request->getPost("pertanyaan"),
            'jawaban' => $this->request->getPost("jawaban"),
        ])->update();

        session()->setFlashdata('success', 'Berkas berhasil diperbarui');
        return redirect()->to(base_url('admin/panduan/index'));
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

        $panduanModel = new PanduanModel();

        $data = $panduanModel->find($id);
        $panduanModel->delete($id);

        return redirect()->to(base_url('admin/panduan/index'));
    }
}
