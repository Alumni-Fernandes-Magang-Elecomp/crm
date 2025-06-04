<?= $this->extend('admin/template/template'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Tugas - <?= esc($pelatihan['nama_pelatihan']) ?></h6>
            <a href="<?= base_url('admin/tugas/tambah/' . $pelatihan['id_pelatihan']) ?>" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Tugas
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul Tugas</th>
                            <th>Soal</th>
                            <th>Dibuat</th>
                            <th width="20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($tugasList as $tugas) : ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= esc($tugas['judul_tugas']) ?></td>
                                <td><?= esc(substr(strip_tags($tugas['soal']), 0, 50)) ?>...</td>
                                <td><?= date('d M Y H:i', strtotime($tugas['created_at'])) ?></td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="<?= base_url('admin/tugas/edit/' . $tugas['id_tugas']) ?>" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="<?= base_url('admin/tugas/hapus/' . $tugas['id_tugas']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                        <a href="<?= base_url('admin/tugas/pengumpulan/' . $tugas['id_tugas']) ?>" class="btn btn-info btn-sm">
                                            <i class="fas fa-users"></i> Pengumpulan
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>