<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\PelatihanModel;
use App\Models\MateriModel;
use App\Models\KotaModel;
use App\Models\PenyelenggaraModel;

class Pelatihancrl extends BaseController
{
    protected $pelatihanModel;
    protected $materiModel;
    protected $kotaModel;
    protected $penyelenggaraModel;

    public function __construct()
    {
        $this->pelatihanModel = new PelatihanModel();
        $this->materiModel = new MateriModel();
        $this->kotaModel = new KotaModel();
        $this->penyelenggaraModel = new PenyelenggaraModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Pelatihan',
            'pelatihan' => $this->pelatihanModel->getPelatihanWithRelations(),
            'active' => 'pelatihan'
        ];
        return view('admin/pelatihan/index', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Tambah Pelatihan',
            'materi' => $this->materiModel->findAll(),
            'kota' => $this->kotaModel->getWithProvinsi(),
            'penyelenggara' => $this->penyelenggaraModel->findAll(), // Daftar semua penyelenggara
            'active' => 'pelatihan',
            'validation' => \Config\Services::validation()
        ];
        return view('admin/pelatihan/tambah', $data);
    }

    public function proses_tambah()
    {
        if (!$this->validate([
            'nama_pelatihan' => 'required',
            'tgl_mulai' => 'required',
            'tgl_akhir' => 'required',
            'id_kota' => 'required',
            'id_materi' => 'required',
            'id_penyelenggara_1' => 'required' // Hanya penyelenggara utama yang wajib
        ])) {
            return redirect()->to('/admin/pelatihan/tambah')->withInput();
        }

        $this->pelatihanModel->save([
            'nama_pelatihan' => $this->request->getVar('nama_pelatihan'),
            'tgl_mulai' => $this->request->getVar('tgl_mulai'),
            'tgl_akhir' => $this->request->getVar('tgl_akhir'),
            'id_kota' => $this->request->getVar('id_kota'),
            'lingkup_peserta' => $this->request->getVar('lingkup_peserta'),
            'id_materi' => $this->request->getVar('id_materi'),
            'detail_materi' => $this->request->getVar('detail_materi'),
            'id_penyelenggara_1' => $this->request->getVar('id_penyelenggara_1'),
            'id_penyelenggara_2' => $this->request->getVar('id_penyelenggara_2'),
            'id_penyelenggara_3' => $this->request->getVar('id_penyelenggara_3')
        ]);

        session()->setFlashdata('pesan', 'Data pelatihan berhasil ditambahkan.');
        return redirect()->to('/admin/pelatihan/index');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Pelatihan',
            'pelatihan' => $this->pelatihanModel->find($id),
            'materi' => $this->materiModel->findAll(),
            'kota' => $this->kotaModel->getWithProvinsi(),
            'penyelenggara' => $this->penyelenggaraModel->findAll(), // Daftar semua penyelenggara
            'active' => 'pelatihan',
            'validation' => \Config\Services::validation()
        ];
        return view('admin/pelatihan/edit', $data);
    }

    public function proses_edit($id)
    {
        if (!$this->validate([
            'nama_pelatihan' => 'required',
            'tgl_mulai' => 'required',
            'tgl_akhir' => 'required',
            'id_kota' => 'required',
            'id_materi' => 'required',
            'id_penyelenggara_1' => 'required' // Hanya penyelenggara utama yang wajib
        ])) {
            return redirect()->to('/admin/pelatihan/edit/' . $id)->withInput();
        }

        $this->pelatihanModel->save([
            'id_pelatihan' => $id,
            'nama_pelatihan' => $this->request->getVar('nama_pelatihan'),
            'tgl_mulai' => $this->request->getVar('tgl_mulai'),
            'tgl_akhir' => $this->request->getVar('tgl_akhir'),
            'id_kota' => $this->request->getVar('id_kota'),
            'lingkup_peserta' => $this->request->getVar('lingkup_peserta'),
            'id_materi' => $this->request->getVar('id_materi'),
            'detail_materi' => $this->request->getVar('detail_materi'),
            'id_penyelenggara_1' => $this->request->getVar('id_penyelenggara_1'),
            'id_penyelenggara_2' => $this->request->getVar('id_penyelenggara_2'),
            'id_penyelenggara_3' => $this->request->getVar('id_penyelenggara_3')
        ]);

        session()->setFlashdata('pesan', 'Data pelatihan berhasil diubah.');
        return redirect()->to('/admin/pelatihan/index');
    }

    public function delete($id)
    {
        $this->pelatihanModel->delete($id);
        session()->setFlashdata('pesan', 'Data pelatihan berhasil dihapus.');
        return redirect()->to('/admin/pelatihan/index');
    }
}
