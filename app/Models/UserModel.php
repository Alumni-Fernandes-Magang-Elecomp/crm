<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = "tb_user";
    protected $primaryKey = "id_user";
    protected $returnType = "object";
    protected $allowedFields = ['id_user', 'nama_user', 'username', 'password', 'id_group', 'alamat_user', 'telp_user', 'email_user', 'role', 'menu_tampil', 'hs_code', 'id_kota'];

    public function getProfil()
    {
        if (isset($_SESSION['username'])) {
            // Ambil data user beserta relasi kota (id_pelatihan dihapus dari join)
            $userData = $this->db->table('tb_user')
                ->select('tb_user.*, tb_kota.nama_kota, tb_provinsi.nama_provinsi')
                ->join('tb_kota', 'tb_kota.id_kota = tb_user.id_kota', 'left')
                ->join('tb_provinsi', 'tb_provinsi.id_provinsi = tb_kota.id_provinsi', 'left')
                ->where('tb_user.username', $_SESSION['username'])
                ->get()
                ->getResultArray();

            return $userData;
        }
    }

    // Method getMenu() tetap sama
    public function getMenu()
    {
        if (session()->has('username')) {
            $username = session()->get('username');

            $query = $this->db->table('tb_user')
                ->where('username', $username)
                ->get();

            if ($query->getNumRows() > 0) {
                $userData = $query->getRow();
                $menuTampil = explode(',', $userData->menu_tampil);
                return $menuTampil;
            } else {
                return [];
            }
        } else {
            return [];
        }
    }

    public function group()
    {
        return $this->belongsTo(Group_model::class, 'id_group');
    }

    // Method lainnya tetap sama tanpa perubahan
    public function getMembersWithKirimEmail()
    {
        return $this->join('tb_kirim_email', 'tb_kirim_email.id_user = tb_user.id_user', 'left')
            ->findAll();
    }

    public function getMemberById($id_user)
    {
        return $this->where('id_user', $id_user)->first();
    }

    public function getMemberByGroup()
    {
        $username = session()->get('username');

        $query = $this->db->table('tb_user')
            ->select('id_group')
            ->where('username', $username)
            ->get();

        if ($query->getNumRows() > 0) {
            $row = $query->getRow();
            $id_group = $row->id_group;

            $progressQuery = $this->db->table('tb_user')
                ->where('tb_user.id_group', $id_group)
                ->get();

            return $progressQuery->getResultArray();
        } else {
            return array();
        }
    }

    public function getProgressByMemberId($username)
    {
        return $this->db->table('tb_user')
            ->join('tb_kirim_email', 'tb_user.id_user = tb_kirim_email.id_user')
            ->where('tb_user.username', $username)
            ->orderBy('tb_kirim_email.id_kirim_email', 'DESC')
            ->get()
            ->getResultArray();
    }

    public function getProgressByMemberGroup()
    {
        $username = session()->get('username');

        $query = $this->db->table('tb_user')
            ->select('id_group')
            ->where('username', $username)
            ->get();

        if ($query->getNumRows() > 0) {
            $row = $query->getRow();
            $id_group = $row->id_group;

            $progressQuery = $this->db->table('tb_user')
                ->join('tb_kirim_email', 'tb_user.id_user = tb_kirim_email.id_user')
                ->where('tb_user.id_group', $id_group)
                ->select('tb_user.id_user, tb_user.nama_user, COUNT(tb_kirim_email.id_user) AS kirim_emails_count', false)
                ->groupBy('tb_user.id_user, tb_user.nama_user')
                ->get();

            return $progressQuery->getResultArray();
        } else {
            return array();
        }
    }

    public function getMemberEmails()
    {
        $query = $this->db->table('tb_user')
            ->join('tb_kirim_email', 'tb_user.id_user = tb_kirim_email.id_user', 'left')
            ->select('tb_user.id_user, tb_user.nama_user, COUNT(tb_kirim_email.id_user) AS kirim_emails_count', false)
            ->groupBy('tb_user.id_user, tb_user.nama_user')
            ->get();

        return $query->getResult();
    }
}
