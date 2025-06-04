<?php

namespace App\Controllers\mpm;

use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\Kirim_email_model;



class Progress extends Controller
{
    
    public function index()
    {
        // Pengecekan apakah pengguna sudah login atau belum
        if (!session()->get('logged_in')) {
                return redirect()->to(base_url('login')); 
                // Ubah 'login' sesuai dengan halaman login Anda
        }
        session(); // Memulai sesi

        $memberModel = new UserModel();
        $username = session()->get('username');
        $members = $memberModel->getProgressByMemberId($username);
        $data = [
            'title' => 'Daftar Progress',
            'members' => $members,

        ];
        
        // print_r($username);
        // die;

        return view('user/mpm/progress/index', $data);
    }

    public function tambah()
    {
        // Pengecekan apakah pengguna sudah login atau belum
        if (!session()->get('logged_in')) {
                return redirect()->to(base_url('login')); 
                // Ubah 'login' sesuai dengan halaman login Anda
        }

        $username = session()->get('username');

        $memberModel = new UserModel();
        $nama_members = $memberModel->where('username', $username)->find();
        $data = [
            'title' => 'Tambah Progress',
            'members' => $nama_members,
        ];
        
        // print_r($data);
        // die;

        return view('user/mpm/progress/tambah', $data);
    }

    public function prosses_tambah()
    {
        $request = service('request');


        $validationRules = [
            'tgl_kirim_email' => 'required|valid_date',
            'id_member' => 'required',
            'nama_perusahaan' => 'required|max_length[100]',
            'negara_perusahaan' => 'required',
            'status_terkirim' => 'required|in_list[Terkirim,Gagal]',
        ];

        $validationMessages = [
            'tgl_kirim_email' => [
                'required' => 'Tanggal Kirim Email harus diisi.',
                'valid_date' => 'Tanggal Kirim Email tidak valid.',
            ],
            'id_member' => [
                'required' => 'ID Member harus diisi.',
            ],
            'nama_perusahaan' => [
                'required' => 'Nama Perusahaan harus diisi.',
                'max_length' => 'Nama Perusahaan maksimal 100 karakter.',
            ],
            'negara_perusahaan' => [
                'required' => 'Negara Perusahaan harus diisi.',
            ],
            'status_terkirim' => [
                'required' => 'Status Terkirim harus diisi.',
                'in_list' => 'Status Terkirim harus berupa "Terkirim" atau "Gagal".',
            ],
        ];

        if (!$this->validate($validationRules, $validationMessages)) {
            // Jika validasi gagal, kembali ke halaman kirim.php dengan pesan error
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $tgl_kirim_email = $request->getPost('tgl_kirim_email');
        $id_member = $request->getPost('id_member');
        $nama_perusahaan = $request->getPost('nama_perusahaan');
        $negara_perusahaan = $request->getPost('negara_perusahaan');
        $status_terkirim = $request->getPost('status_terkirim');
        $progress = "<ol> <li>Mengirim email pada Tanggal " . $tgl_kirim_email . "</li></ol>";

        // Data kirim email yang akan disimpan
        $dataKirimEmail = [
            'tgl_kirim_email' => $tgl_kirim_email,
            'id_user' => $id_member,
            'nama_perusahaan' => $nama_perusahaan,
            'negara_perusahaan' => $negara_perusahaan,
            'status_terkirim' => $status_terkirim,
            'progress' => $progress,
        ];

        // Simpan data kirim email ke dalam tabel tb_kirim_email
        $kirimEmailModel = new Kirim_email_model();
        $kirimEmailModel->insert($dataKirimEmail);

        return redirect()->to(base_url('progress/daftar'))->with('success', 'Data progress berhasil ditambahkan');
    }

    public function edit($id_kirim_email)
    {
        // Pengecekan apakah pengguna sudah login atau belum
        if (!session()->get('logged_in')) {
                return redirect()->to(base_url('login')); 
                // Ubah 'login' sesuai dengan halaman login Anda
        }
        
        $kirimEmailModel = new Kirim_email_model();
        // $data['kirim_email'] = $kirimEmailModel->find($id_kirim_email);
        $kirim_email = $kirimEmailModel->find($id_kirim_email);
        
        $username = session()->get('username');

        $memberModel = new UserModel();
        $nama_members = $memberModel->where('username', $username)->find();

        $data = [
            'title' => 'Edit Progress',
            'kirim_email' => $kirim_email,
            'nama_members' => $nama_members,
        ];
        
        // print_r($data);
        // die;

        if (!$data['kirim_email']) {
            return redirect()->to(base_url('user/mpm/member/index'))->with('error', 'Data progress tidak ditemukan.');
        }

        return view('user/mpm/progress/edit', $data);
    }

    public function proses_edit($id_kirim_email)
    {
        $request = service('request');
    
        // Validasi data (sama seperti pada simpan_kirim_email)
        $validationRules = [
            'tgl_kirim_email' => 'required|valid_date',
            'id_user' => 'required',
            'nama_perusahaan' => 'required|min_length[2]|max_length[100]',
            'negara_perusahaan' => 'required|min_length[3]|max_length[50]',
            'status_terkirim' => 'required|in_list[Terkirim,Gagal]',
        ];
    
        $validationMessages = [
            'tgl_kirim_email' => [
                'required' => 'Tanggal Kirim Email harus diisi.',
                'valid_date' => 'Tanggal Kirim Email tidak valid.',
            ],
            'id_user' => [
                'required' => 'ID Member harus diisi.',
            ],
            'nama_perusahaan' => [
                'required' => 'Nama Perusahaan harus diisi.',
                'min_length' => 'Nama Perusahaan minimal 2 karakter.',
                'max_length' => 'Nama Perusahaan maksimal 100 karakter.',
            ],
            'negara_perusahaan' => [
                'required' => 'Negara Perusahaan harus diisi.',
                'min_length' => 'Negara Perusahaan minimal 3 karakter.',
                'max_length' => 'Negara Perusahaan maksimal 50 karakter.',
            ],
            'status_terkirim' => [
                'required' => 'Status Terkirim harus diisi.',
                'in_list' => 'Status Terkirim harus berupa "Terkirim" atau "Gagal".',
            ],
        ];
    
        if (!$this->validate($validationRules, $validationMessages)) {
            // Jika validasi gagal, kembali ke halaman edit dengan pesan error
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    
        $tgl_kirim_email = $request->getPost('tgl_kirim_email');
        $id_user = $request->getPost('id_user');
        $nama_perusahaan = $request->getPost('nama_perusahaan');
        $negara_perusahaan = $request->getPost('negara_perusahaan');
        $status_terkirim = $request->getPost('status_terkirim');
        $progress = $request->getPost('progress');
    
        // Data kirim email yang akan diupdate
        $dataKirimEmail = [
            'tgl_kirim_email' => $tgl_kirim_email,
            'id_user' => $id_user,
            'nama_perusahaan' => $nama_perusahaan,
            'negara_perusahaan' => $negara_perusahaan,
            'status_terkirim' => $status_terkirim,
            'progress' => $progress,
        ];
    
        // Simpan perubahan ke dalam tabel tb_kirim_email
        $kirimEmailModel = new Kirim_email_model();
        $kirimEmailModel->update($id_kirim_email, $dataKirimEmail);
    
        return redirect()->to(base_url('progress/daftar'))->with('success', 'Data progress berhasil diperbarui.');
    }


    public function delete($id)
    {
        $memberModel = new UserModel();
        $memberModel->deleteMember($id);

        return redirect()->to('user/mpm/member')->with('success', 'Member deleted successfully');
    }
}
