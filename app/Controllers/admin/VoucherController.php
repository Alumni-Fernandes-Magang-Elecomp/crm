<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\VoucherModel;

class VoucherController extends BaseController
{
    protected $voucherModel;

    public function __construct()
    {
        $this->voucherModel = new VoucherModel();
    }

    // Tampilan daftar voucher
    public function index()
    {
        $data = [
            'title' => 'Kelola Voucher',
            'vouchers' => $this->voucherModel->findAll()
        ];

        return view('admin/voucher/index', $data);
    }

    // Tampilan tambah voucher
    public function tambah()
    {
        $data = [
            'title' => 'Tambah Voucher',
            'kategoriOptions' => [
                'digital_marketing' => 'Digital Marketing (Diskon Persentase)', // Perbaikan typo dari 'digital_marketing'
                'web_development' => 'Pembuatan Website (Diskon Nominal)'
            ]
        ];

        return view('admin/voucher/tambah', $data);
    }

    // Proses tambah voucher
    public function proses_tambah()
    {
        if (!$this->validate($this->voucherModel->getValidationRules())) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->voucherModel->save([
            'nama_voucher' => $this->request->getPost('nama_voucher'),
            'kode_voucher' => $this->request->getPost('kode_voucher'),
            'kategori_voucher' => $this->request->getPost('kategori_voucher'),
            'nilai_diskon' => $this->request->getPost('nilai_diskon'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'berlaku_sampai' => $this->request->getPost('berlaku_sampai')
        ]);

        return redirect()->to('/admin/voucher/index')->with('pesan', 'Voucher berhasil ditambahkan');
    }

    // Tampilan edit voucher
    public function edit($id)
    {
        $data = [
            'title' => 'Edit Voucher',
            'voucher' => $this->voucherModel->find($id),
            'kategoriOptions' => [
                'digital_marketing' => 'Digital Marketing (Diskon Persentase)',
                'web_development' => 'Pembuatan Website (Diskon Nominal)'
            ]
        ];

        return view('admin/voucher/edit', $data);
    }

    // Proses edit voucher
    public function proses_edit($id)
    {
        if (!$this->validate($this->voucherModel->getValidationRules())) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->voucherModel->save([
            'id_voucher' => $id,
            'nama_voucher' => $this->request->getPost('nama_voucher'),
            'kode_voucher' => $this->request->getPost('kode_voucher'),
            'kategori_voucher' => $this->request->getPost('kategori_voucher'),
            'nilai_diskon' => $this->request->getPost('nilai_diskon'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'berlaku_sampai' => $this->request->getPost('berlaku_sampai')
        ]);

        return redirect()->to('/admin/voucher/index')->with('pesan', 'Voucher berhasil diperbarui');
    }

    // Hapus voucher
    public function delete($id)
    {
        $this->voucherModel->delete($id);
        return redirect()->to('/admin/voucher/index')->with('pesan', 'Voucher berhasil dihapus');
    }
}
