<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\TugasModel;
use App\Models\PelatihanModel;
use App\Models\UserModel;
use App\Models\JawabanModel;

class Tugasctrl extends BaseController
{
    protected $tugasModel;
    protected $pelatihanModel;
    protected $userModel;

    public function __construct()
    {
        $this->tugasModel = new TugasModel();
        $this->pelatihanModel = new PelatihanModel();
        $this->userModel = new UserModel();
        helper(['form', 'url']);

        // Validasi session dan role
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        $role = session()->get('role');
        if ($role !== 'admin') {
            return redirect()->to(base_url('/'));
        }
    }

    public function index()
    {
        $data = [
            'title' => 'Pilih Pelatihan - Admin',
            'pelatihanList' => $this->pelatihanModel->select('id_pelatihan, nama_pelatihan, tgl_mulai, tgl_akhir')->findAll(),
        ];

        return view('admin/tugas/index', $data);
    }

    public function tugasByPelatihan($id_pelatihan)
    {
        $pelatihan = $this->pelatihanModel->find($id_pelatihan);

        if (!$pelatihan) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Pelatihan tidak ditemukan');
        }

        $tugasList = $this->tugasModel
            ->where('id_pelatihan', $id_pelatihan)
            ->orderBy('created_at', 'DESC')
            ->findAll();

        $data = [
            'title' => 'Daftar Tugas - ' . esc($pelatihan['nama_pelatihan']),
            'pelatihan' => $pelatihan,
            'tugasList' => $tugasList
        ];

        return view('admin/tugas/detail', $data);
    }

    public function tambah($id_pelatihan)
    {
        $pelatihan = $this->pelatihanModel->find($id_pelatihan);
        $users = $this->userModel->where('role', 'peserta')->findAll();

        $data = [
            'title' => 'Tambah Tugas - ' . esc($pelatihan['nama_pelatihan']),
            'pelatihan' => $pelatihan,
            'users' => $users,
            'validation' => \Config\Services::validation()
        ];

        return view('admin/tugas/tambah', $data);
    }

    public function simpan($id_pelatihan)
    {
        // Validasi input
        if (!$this->validate([
            'judul_tugas' => 'required|max_length[100]',
            'soal' => 'required'
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        try {
            $this->tugasModel->save([
                'id_pelatihan' => $id_pelatihan,
                'judul_tugas' => $this->request->getVar('judul_tugas'),
                'soal' => $this->request->getVar('soal'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            session()->setFlashdata('pesan', 'Tugas berhasil ditambahkan');
            return redirect()->to("/admin/tugas/pelatihan/{$id_pelatihan}");
        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
            session()->setFlashdata('error', 'Gagal menyimpan tugas');
            return redirect()->back()->withInput();
        }
    }

    public function edit($id_tugas)
    {
        // Pengecekan session dan role
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        if (session()->get('role') !== 'admin') {
            return redirect()->to(base_url('/'));
        }

        $tugas = $this->tugasModel->find($id_tugas);
        if (!$tugas) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Tugas tidak ditemukan');
        }

        $pelatihan = $this->pelatihanModel->find($tugas['id_pelatihan']);

        return view('admin/tugas/edit', [
            'tugas' => $tugas,
            'pelatihan' => $pelatihan,
            'validation' => \Config\Services::validation()
        ]);
    }

    public function update($id_tugas)
    {
        // Pengecekan session dan role
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        if (session()->get('role') !== 'admin') {
            return redirect()->to(base_url('/'));
        }

        $tugas = $this->tugasModel->find($id_tugas);
        if (!$tugas) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Tugas tidak ditemukan');
        }

        // Validasi input
        $rules = [
            'judul_tugas' => 'required|max_length[100]',
            'soal' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        try {
            $this->tugasModel->save([
                'id_tugas' => $id_tugas,
                'judul_tugas' => $this->request->getPost('judul_tugas'),
                'soal' => $this->request->getPost('soal'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            session()->setFlashdata('success', 'Soal berhasil diperbarui!');
            return redirect()->to("/admin/tugas/pelatihan/{$tugas['id_pelatihan']}");
        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
            session()->setFlashdata('error', 'Gagal memperbarui soal: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function hapus($id_tugas)
    {
        $tugas = $this->tugasModel->find($id_tugas);
        $this->tugasModel->delete($id_tugas);

        session()->setFlashdata('pesan', 'Tugas berhasil dihapus');
        return redirect()->to("/admin/tugas/pelatihan/{$tugas['id_pelatihan']}");
    }

    public function pengumpulan($id_tugas)
    {
        $tugas = $this->tugasModel->find($id_tugas);
        if (!$tugas) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $jawabanModel = new \App\Models\JawabanModel();
        $pengumpulan = $jawabanModel->select('tb_jawaban.id_jawaban, tb_jawaban.*, tb_user.nama_user, tb_jawaban.waktu_pengumpulan as updated_at')
            ->join('tb_user', 'tb_user.id_user = tb_jawaban.id_user')
            ->where('tb_jawaban.id_tugas', $id_tugas)
            ->findAll();

        // Tambahkan status text
        foreach ($pengumpulan as &$item) {
            $item['status_text'] = $jawabanModel->getStatusText($item['status']);
        }

        return view('admin/tugas/pengumpulan', [
            'title' => 'Pengumpulan Tugas - ' . esc($tugas['judul_tugas']),
            'tugas' => $tugas,
            'pengumpulan' => $pengumpulan,
            'validation' => \Config\Services::validation()
        ]);
    }

    public function detail_pengumpulan($id_jawaban)
    {
        $jawabanModel = new JawabanModel();

        // Ambil data jawaban beserta relasi tugas dan user
        $jawaban = $jawabanModel->select('tb_jawaban.*, tb_tugas.judul_tugas, tb_tugas.soal, tb_tugas.id_pelatihan, tb_user.nama_user')
            ->join('tb_tugas', 'tb_tugas.id_tugas = tb_jawaban.id_tugas')
            ->join('tb_user', 'tb_user.id_user = tb_jawaban.id_user')
            ->where('tb_jawaban.id_jawaban', $id_jawaban)
            ->first();

        if (!$jawaban) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Data pengumpulan tidak ditemukan');
        }

        // Ambil data pelatihan
        $pelatihan = $this->pelatihanModel->find($jawaban['id_pelatihan']);

        return view('admin/tugas/detail_pengumpulan', [
            'title' => 'Detail Pengumpulan Tugas',
            'jawaban' => $jawaban,
            'pelatihan' => $pelatihan
        ]);
    }

    public function nilai($id_jawaban)
    {
        $jawabanModel = new JawabanModel();
        $jawaban = $jawabanModel->select('tb_jawaban.*, tb_tugas.judul_tugas, tb_tugas.soal, tb_tugas.id_pelatihan, tb_user.nama_user')
            ->join('tb_tugas', 'tb_tugas.id_tugas = tb_jawaban.id_tugas')
            ->join('tb_user', 'tb_user.id_user = tb_jawaban.id_user')
            ->where('tb_jawaban.id_jawaban', $id_jawaban)
            ->first();

        if (!$jawaban) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Data pengumpulan tidak ditemukan');
        }

        // Ambil data pelatihan
        $pelatihan = $this->pelatihanModel->find($jawaban['id_pelatihan']);

        return view('admin/tugas/nilai', [
            'title' => 'Beri Nilai Tugas',
            'jawaban' => $jawaban,
            'pelatihan' => $pelatihan,
            'validation' => \Config\Services::validation()
        ]);
    }

    public function proses_nilai($id_jawaban)
    {
        $jawabanModel = new JawabanModel();

        $rules = [
            'nilai' => 'required|numeric|greater_than_equal_to[0]|less_than_equal_to[100]',
            'status' => 'required|in_list[dikirim,dinilai,terkoreksi]',
            'catatan' => 'permit_empty'
        ];

        $data = [
            'nilai' => $this->request->getPost('nilai'),
            'status' => $this->request->getPost('status'), // sebagai string
            'catatan' => $this->request->getPost('catatan')
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        try {
            $data = [
                'nilai' => $this->request->getPost('nilai'),
                'status' => $this->request->getPost('status'),
                'catatan' => $this->request->getPost('catatan')
            ];

            $jawabanModel->update($id_jawaban, $data);

            session()->setFlashdata('success', 'Nilai berhasil disimpan');
            return redirect()->to(base_url('admin/tugas/detail_pengumpulan/' . $id_jawaban));
        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
            session()->setFlashdata('error', 'Gagal menyimpan nilai: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }
}
