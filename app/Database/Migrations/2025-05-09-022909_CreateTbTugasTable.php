<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTbTugasTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_tugas' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_user' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'  => true,
            ],
            'id_pelatihan' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'  => true,
            ],
            'hasil' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'waktu_pengumpulan' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addPrimaryKey('id_tugas');

        // Tambahkan foreign key untuk id_user
        $this->forge->addForeignKey('id_user', 'tb_user', 'id_user', 'CASCADE', 'CASCADE');

        // Tambahkan foreign key untuk id_pelatihan
        $this->forge->addForeignKey('id_pelatihan', 'tb_pelatihan', 'id_pelatihan', 'CASCADE', 'CASCADE');

        $this->forge->createTable('tb_tugas');
    }

    public function down()
    {
        $this->forge->dropTable('tb_tugas');
    }
}
