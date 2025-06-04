<?php

namespace App\Controllers\admin;

use App\Models\ArtikelModel;
use App\Models\KategoriModel;
use App\Models\PenulisModel;

class Artikel extends BaseController
{

    private $ArtikelModel;
    private $KategoriModel;
    private $PenulisModel;


    public function __construct()
    {
        $this->ArtikelModel = new ArtikelModel();
        $this->KategoriModel = new KategoriModel();
    }

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

        $all_data_artikel = $this->ArtikelModel->getArtikelAdmin();
        $validation = \Config\Services::validation();
        return view('admin/artikel/index', [
            'all_data_artikel' => $all_data_artikel,
            'validation' => $validation
        ]);
    }

    public function viewArtikel($id_artikel, $slug)
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
        $detail_artikel = $this->ArtikelModel->getDetailArtikel($id_artikel, $slug);
        
        $data = [
            'artikel' => $detail_artikel[0],
            'artikel_lain' => $this->ArtikelModel->getArtikelLainnya($id_artikel, 4),
            'kategori' => $this->KategoriModel->getKategori()
        ];

        // tampilkan 404 error jika data tidak ditemukan
		if (!$data['artikel']) {
			throw PageNotFoundException::forPageNotFound();
		}
        // var_dump($data);
        

		return view('user/home/detail', $data);
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
        $all_data_artikel = $this->ArtikelModel->findAll();
        $all_data_kategori = $this->KategoriModel->findAll();
        $validation = \Config\Services::validation();
        return view('admin/artikel/tambah', [
            'all_data_artikel' => $all_data_artikel,
            'all_data_kategori' => $all_data_kategori,
            'validation' => $validation
        ]);
    }

    public function proses_tambah()
    {
        if (!$this->validate([
            'foto_artikel' => [
                'rules' => 'uploaded[foto_artikel]|is_image[foto_artikel]|mime_in[foto_artikel,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Pilih foto terlebih dahulu',
                    'is_image' => 'File yang anda pilih bukan gambar',
                    // 'min_dims' => 'Minimal ukuran gambar 572x572 pixels',
                    'mime_in' => 'File yang anda pilih wajib berekstensikan jpg/jpeg/png'
                ]
            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        } else {
            $file_foto = $this->request->getFile('foto_artikel');
            $file_foto->move('assets-baru/img/');
            $file_name = $file_foto->getName();
            $data = [
                'judul_artikel' => $this->request->getPost("judul_artikel"),
                'id_kategori' => $this->request->getPost("id_kategori"),
                'deskripsi_artikel' => $this->request->getPost("deskripsi_artikel"),
                'tags' => $this->request->getPost("tags"),
                'foto_artikel' => $file_name,
                'slug' => url_title($this->request->getPost('judul_artikel'), '-', TRUE)
            ];
            $this->ArtikelModel->insert($data);

            session()->setFlashdata('success', 'Data berhasil disimpan');
            return redirect()->to(base_url('admin/artikel/index'));
        }
    }

    public function edit($id_artikel)
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
        $artikelData = $this->ArtikelModel->find($id_artikel);

        $validation = \Config\Services::validation();

        return view('admin/artikel/edit', [
            'artikelData' => $artikelData,
            'validation' => $validation
        ]);
    }

    // Artikel.php (Controller)
    public function proses_edit($id_artikel = null)
    {
        if (!$id_artikel) {
            return redirect()->back();
        }

        $artikelData = $this->ArtikelModel->find($id_artikel);

        // Check if new 'foto_artikel' file is uploaded
        if ($this->request->getFile('foto_artikel')->isValid()) {
            // Delete the old 'foto_artikel' file
            unlink('assets-baru/img/' . $artikelData->foto_artikel);

            // Upload the new 'foto_artikel' file
            $dataArtikel = $this->request->getFile('foto_artikel');
            $fotoName = $dataArtikel->getName();
            $dataArtikel->move('assets-baru/img/', $fotoName);

            // Update the 'foto_artikel' field in the database with a "where" clause
            $this->ArtikelModel->where('id_artikel', $id_artikel)->set([
                'foto_artikel' => $fotoName,
                'judul_artikel' => $this->request->getPost("judul_artikel"),
                'deskripsi_artikel' => $this->request->getPost("deskripsi_artikel"),
                'tags' => $this->request->getPost("tags"),
                'slug' => url_title($this->request->getPost('judul_artikel'), '-', TRUE)
            ])->update();

        } else {
            // If no new 'foto_artikel' file is uploaded, update only the other fields
            $this->ArtikelModel->where('id_artikel', $id_artikel)->set([
                'judul_artikel' => $this->request->getPost("judul_artikel"),
                'deskripsi_artikel' => $this->request->getPost("deskripsi_artikel"),
                'tags' => $this->request->getPost("tags"),
                'slug' => url_title($this->request->getPost('judul_artikel'), '-', TRUE)
            ])->update();
        }

        session()->setFlashdata('success', 'Berkas berhasil diperbarui');
        return redirect()->to(base_url('admin/artikel/index'));
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
        $artikelModel = new ArtikelModel();

        $data = $artikelModel->find($id);

        unlink('assets-baru/img/' . $data->foto_artikel);

        $artikelModel->delete($id);

        return redirect()->to(base_url('admin/artikel/index'));
    }
}
