<?php

namespace App\Controllers\admin;

use App\Models\PanduanTambahanModel;
use App\Models\UserModel;

class Panduan_tambahan extends BaseController
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

        $panduan_model = new PanduanTambahanModel();
        $all_data_panduan = $panduan_model->findAll();
        $validation = \Config\Services::validation();
        return view('admin/panduan_tambahan/index', [
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

        $panduan_model = new PanduanTambahanModel();
        $user = new UserModel();
        $all_data_panduan = $panduan_model->findAll();
        $all_data_user = $user->findAll();
        $validation = \Config\Services::validation();
        return view('admin/panduan_tambahan/tambah', [
            'all_data_panduan' => $all_data_panduan,
            'user' => $all_data_user,
            'validation' => $validation
        ]);
    }

    public function proses_tambah()
    {
        $panduanModel = new PanduanTambahanModel();
        $data = [
            'pertanyaan' => $this->request->getVar("pertanyaan"),
            'jawaban' => $this->request->getVar("jawaban"),
            'kategori_panduan' => $this->request->getVar("kategori_panduan"),
        ];
        if ($this->request->getVar("id_user")) {
            $id_user = $this->request->getVar("id_user");

            // Periksa apakah ada data yang dikirimkan
            if (!empty($id_user)) {
                // Menggunakan implode hanya jika ada data yang dikirimkan
                $idUser = '#' . implode('#,#', $id_user) . '#';
            } else {
                // Atau atur menjadi NULL atau string kosong, sesuai kebutuhan aplikasi Anda
                $idUser = NULL; // atau $panduanKhusus = '';
            }
            
            // Sekarang $panduanKhusus bisa disimpan ke dalam database

            $data['id_user'] = $idUser;
        }

        $panduanModel->save($data);

        session()->setFlashdata('success', 'Data berhasil disimpan');
        return redirect()->to(base_url('admin/panduan_tambahan/index'));
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

        $panduan_model = new PanduanTambahanModel();
        $user = new UserModel();
        $panduanData = $panduan_model->find($id_panduan);
        $validation = \Config\Services::validation();

        return view('admin/panduan_tambahan/edit', [
            'panduanData' => $panduanData,
            'userData' => $user->findAll(),
            'validation' => $validation
        ]);
    }

    // Penulis.php (Controller)
    public function proses_edit($id_panduan = null)
    {
        if (!$id_panduan) {
            return redirect()->back();
        }

        $panduanModel = new PanduanTambahanModel();
        $panduanData = $panduanModel->find($id_panduan);

        // Check if new 'foto_penulis' file is uploaded
        $data = [
                'pertanyaan' => $this->request->getPost("pertanyaan"),
                'jawaban' => $this->request->getPost("jawaban"),
                'kategori_panduan' => $this->request->getVar("kategori_panduan"),
        ];
        // If no new 'foto_penulis' file is uploaded, update only the other fields

        if ($this->request->getVar("id_user")) {
            $id_user = $this->request->getVar("id_user");

            // Periksa apakah ada data yang dikirimkan
            if (!empty($id_user)) {
                // Menggunakan implode hanya jika ada data yang dikirimkan
                $idUser = '#' . implode('#,#', $id_user) . '#';
            } else {
                // Atau atur menjadi NULL atau string kosong, sesuai kebutuhan aplikasi Anda
                $idUser = NULL; // atau $panduanKhusus = '';
            }
            
            // Sekarang $panduanKhusus bisa disimpan ke dalam database

            $data['id_user'] = $idUser;
        }

        $panduanModel->where('id_panduan', $id_panduan)->set($data)->update();

        session()->setFlashdata('success', 'Berkas berhasil diperbarui');
        return redirect()->to(base_url('admin/panduan_tambahan/index'));
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

        $panduanModel = new PanduanTambahanModel();

        $data = $panduanModel->find($id);
        $panduanModel->delete($id);

        return redirect()->to(base_url('admin/panduan_tambahan/index'));
    }
}
