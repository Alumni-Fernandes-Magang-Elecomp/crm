<?php

namespace App\Models;

use CodeIgniter\Model;

class VoucherModel extends Model
{
    protected $table = 'tb_voucher';
    protected $primaryKey = 'id_voucher';
    protected $allowedFields = ['nama_voucher', 'kode_voucher', 'kategori_voucher', 'nilai_diskon', 'deskripsi', 'berlaku_sampai'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Menentukan jenis diskon berdasarkan kategori
    public function getJenisDiskon($kategori)
    {
        $rules = [
            'digital_marketing' => 'persentase',
            'web_development' => 'nominal'
        ];
        return $rules[$kategori] ?? 'persentase';
    }

    // Validasi input
    protected $validationRules = [
        'nama_voucher'   => 'required',
        'kode_voucher'   => 'required|is_unique[tb_voucher.kode_voucher,id_voucher,{id_voucher}]',
        'kategori_voucher' => 'required',
        'nilai_diskon'   => 'required|numeric',
        'berlaku_sampai' => 'required|valid_date'
    ];

    protected $validationMessages = [
        'nilai_diskon' => [
            'numeric' => 'Nilai diskon harus berupa angka'
        ]
    ];
}
