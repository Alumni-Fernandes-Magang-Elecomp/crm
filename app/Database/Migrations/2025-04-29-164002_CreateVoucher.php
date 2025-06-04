<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateVoucher extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_voucher'      => ['type' => 'INT', 'auto_increment' => true],
            'nama_voucher'    => ['type' => 'TEXT'],
            'kode_voucher'    => ['type' => 'VARCHAR', 'constraint' => 20, 'unique' => true],
            'kategori_voucher' => ['type' => 'ENUM', 'constraint' => ['digital_marketing', 'web_development'], 'default' => 'digital_marketing'],
            'nilai_diskon'    => ['type' => 'VARCHAR', 'constraint' => 10],
            'deskripsi'       => ['type' => 'TEXT', 'null' => true],
            'berlaku_sampai'  => ['type' => 'DATETIME'],
            'created_at'      => ['type' => 'DATETIME', 'null' => true],
            'updated_at'      => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id_voucher', true);
        $this->forge->createTable('tb_voucher');
    }

    public function down()
    {
        $this->forge->dropTable('tb_voucher');
    }
}
