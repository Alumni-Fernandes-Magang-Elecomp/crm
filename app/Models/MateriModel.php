<?php

namespace App\Models;

use CodeIgniter\Model;

class MateriModel extends Model
{
    protected $table = 'tb_materi';
    protected $primaryKey = 'id_materi';
    protected $allowedFields = ['nama_materi'];
}
