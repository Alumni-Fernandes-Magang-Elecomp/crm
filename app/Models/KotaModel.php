<?php

namespace App\Models;

use CodeIgniter\Model;

class KotaModel extends Model
{
    protected $table = 'tb_kota';
    protected $primaryKey = 'id_kota';
    protected $allowedFields = ['id_provinsi', 'nama_kota'];

    public function getWithProvinsi()
    {
        return $this->select('tb_kota.*, tb_provinsi.nama_provinsi')
            ->join('tb_provinsi', 'tb_provinsi.id_provinsi = tb_kota.id_provinsi')
            ->findAll();
    }
}
