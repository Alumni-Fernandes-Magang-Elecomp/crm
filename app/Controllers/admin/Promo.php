<?php

namespace App\Controllers\admin;

use App\Models\PromoModel;

class Promo extends BaseController
{
    public function index()
    {
        // Pengecekan apakah pengguna sudah login atau belum
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
            // Ubah 'login' sesuai dengan halaman login Anda
        }

        $role = session()->get('role');
        if ($role !== 'admin') {
            // Jika peran bukan admin, arahkan ke halaman lain (misal: user)
            return redirect()->to(base_url('/')); // Sesuaikan dengan URL halaman user
        }

        $promo_model = new PromoModel();
        $all_data_promo = $promo_model->findAll();
        $validation = \Config\Services::validation();
        return view('admin/promo/index', [
            'all_data_promo' => $all_data_promo,
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

        $role = session()->get('role');
        if ($role !== 'admin') {
            // Jika peran bukan admin, arahkan ke halaman lain (misal: user)
            return redirect()->to(base_url('/')); // Sesuaikan dengan URL halaman user
        }

        $promo_model = new PromoModel();
        $all_data_promo = $promo_model->findAll();
        $validation = \Config\Services::validation();
        return view('admin/promo/tambah', [
            'all_data_promo' => $all_data_promo,
            'validation' => $validation
        ]);
    }

    public function proses_tambah()
    {
        if (!$this->validate([
            'poster_promo' => [
                'rules' => 'uploaded[poster_promo]|is_image[poster_promo]|max_dims[poster_promo,3000,3000]|mime_in[poster_promo,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Pilih foto terlebih dahulu',
                    'is_image' => 'File yang anda pilih bukan gambar',
                    'max_dims' => 'Maksimal ukuran gambar 572x572 pixels',
                    'mime_in' => 'File yang anda pilih wajib berekstensikan jpg/jpeg/png'
                ]
            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        } else {
            $file_foto = $this->request->getFile('poster_promo');
            $file_foto->move('assets-baru/img/');
            $file_name = $file_foto->getName();
            $promoModel = new PromoModel();
            $data = [
                'judul_promo' => $this->request->getVar("judul_promo"),
                'deskripsi_promo' => $this->request->getVar("deskripsi_promo"),
                'mulai_promo' => $this->request->getVar("mulai_promo"),
                'akhir_promo' => $this->request->getVar("akhir_promo"),
                'poster_promo' => $file_name
            ];
            $promoModel->save($data);

            session()->setFlashdata('success', 'Data berhasil disimpan');
            return redirect()->to(base_url('admin/promo/index'));
        }
    }

    public function edit($id_promo)
    {
        // Pengecekan apakah pengguna sudah login atau belum
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
            // Ubah 'login' sesuai dengan halaman login Anda
        }

        $role = session()->get('role');
        if ($role !== 'admin') {
            // Jika peran bukan admin, arahkan ke halaman lain (misal: user)
            return redirect()->to(base_url('/')); // Sesuaikan dengan URL halaman user
        }

        $promo_model = new PromoModel();
        $promoData = $promo_model->find($id_promo);
        $validation = \Config\Services::validation();

        return view('admin/promo/edit', [
            'promoData' => $promoData,
            'validation' => $validation
        ]);
    }

    // Penulis.php (Controller)
    public function proses_edit($id_promo = null)
    {
        if (!$id_promo) {
            return redirect()->back();
        }

        $promoModel = new PromoModel();
        $promoData = $promoModel->find($id_promo);

        // Check if new 'foto_penulis' file is uploaded
        if ($this->request->getFile('poster_promo')->isValid()) {
            // Delete the old 'foto_penulis' file
            unlink('assets-baru/img/' . $promoData->poster_promo);

            // Upload the new 'foto_penulis' file
            $dataPromo = $this->request->getFile('poster_promo');
            $fotoName = $dataPromo->getRandomName();
            $dataPromo->move('assets-baru/img/', $fotoName);

            // Update the 'foto_penulis' field in the database with a "where" clause
            $promoModel->where('id_promo', $id_promo)->set([
                'poster_promo' => $fotoName,
                'judul_promo' => $this->request->getVar("judul_promo"),
                'deskripsi_promo' => $this->request->getVar("deskripsi_promo"),
                'mulai_promo' => $this->request->getVar("mulai_promo"),
                'akhir_promo' => $this->request->getVar("akhir_promo"),
            ])->update();
        } else {
            // If no new 'foto_penulis' file is uploaded, update only the other fields
            $promoModel->where('id_promo', $id_promo)->set([
                'judul_promo' => $this->request->getVar("judul_promo"),
                'deskripsi_promo' => $this->request->getVar("deskripsi_promo"),
                'mulai_promo' => $this->request->getVar("mulai_promo"),
                'akhir_promo' => $this->request->getVar("akhir_promo"),
            ])->update();
        }

        session()->setFlashdata('success', 'Berkas berhasil diperbarui');
        return redirect()->to(base_url('admin/promo/index'));
    }




    public function delete($id = false)
    {
        // Pengecekan apakah pengguna sudah login atau belum
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
            // Ubah 'login' sesuai dengan halaman login Anda
        }

        $role = session()->get('role');
        if ($role !== 'admin') {
            // Jika peran bukan admin, arahkan ke halaman lain (misal: user)
            return redirect()->to(base_url('/')); // Sesuaikan dengan URL halaman user
        }

        $promoModel = new PromoModel();

        $data = $promoModel->find($id);

        unlink('assets-baru/img/' . $data->poster_promo);

        $promoModel->delete($id);

        return redirect()->to(base_url('admin/promo/index'));
    }
}
