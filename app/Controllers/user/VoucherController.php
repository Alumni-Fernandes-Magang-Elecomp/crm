<?php

namespace App\Controllers\user;

use App\Controllers\BaseController;
use App\Models\VoucherModel;

class VoucherController extends BaseController
{
    protected $voucherModel;

    public function __construct()
    {
        $this->voucherModel = new VoucherModel();
    }

    // Tampilan semua voucher
    public function index()
    {
        $vouchers = $this->voucherModel->where('berlaku_sampai >=', date('Y-m-d H:i:s'))->findAll();

        // Tambahkan jenis diskon berdasarkan kategori
        foreach ($vouchers as &$voucher) {
            $voucher['jenis_diskon'] = $this->voucherModel->getJenisDiskon($voucher['kategori_voucher']);
        }

        $data = [
            'title' => 'Daftar Voucher',
            'vouchers' => $vouchers
        ];

        return view('user/voucher/index', $data);
    }

    // Tampilan detail voucher
    public function detail($kode_voucher)
    {
        $voucher = $this->voucherModel->where('kode_voucher', $kode_voucher)->first();

        if (!$voucher) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Tambahkan jenis diskon
        $voucher['jenis_diskon'] = $this->voucherModel->getJenisDiskon($voucher['kategori_voucher']);

        $data = [
            'title' => 'Detail Voucher',
            'voucher' => $voucher
        ];

        return view('user/voucher/detail', $data);
    }

    // Filter voucher digital marketing
    public function digitalMarketing()
    {
        $vouchers = $this->voucherModel
            ->where('kategori_voucher', 'digital_marketing')
            ->where('berlaku_sampai >=', date('Y-m-d H:i:s'))
            ->findAll();

        foreach ($vouchers as &$voucher) {
            $voucher['jenis_diskon'] = 'persentase';
        }

        $data = [
            'title' => 'Voucher Digital Marketing',
            'vouchers' => $vouchers
        ];

        return view('user/voucher/index', $data);
    }

    // Filter voucher web development
    public function webDevelopment()
    {
        $vouchers = $this->voucherModel
            ->where('kategori_voucher', 'web_development')
            ->where('berlaku_sampai >=', date('Y-m-d H:i:s'))
            ->findAll();

        foreach ($vouchers as &$voucher) {
            $voucher['jenis_diskon'] = 'nominal';
        }

        $data = [
            'title' => 'Voucher Pembuatan Website',
            'vouchers' => $vouchers
        ];

        return view('user/voucher/index', $data);
    }
}
