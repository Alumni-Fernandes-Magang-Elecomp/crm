<?= $this->extend('admin/template/template'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-tasks mr-1"></i> Pengumpulan Tugas: <?= esc($tugas['judul_tugas']) ?>
            </h6>
            <a href="<?= base_url('admin/tugas/pelatihan/' . $tugas['id_pelatihan']) ?>" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="25%">Nama Peserta</th>
                            <th width="20%">Waktu Submit</th>
                            <th width="15%">Status</th>
                            <th width="20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($pengumpulan as $submit): ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= esc($submit['nama_user']) ?></td>
                                <td><?= date('d/m/Y H:i', strtotime($submit['updated_at'])) ?></td>
                                <td>
                                    <span class="badge <?=
                                                        ($submit['status'] == 'terkoreksi') ? 'badge-success' : (($submit['status'] == 'dinilai') ? 'badge-warning' : 'badge-primary')
                                                        ?>">
                                        <?= esc($submit['status_text']) ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="<?= base_url('admin/tugas/detail_pengumpulan/' . $submit['id_jawaban']) ?>" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="<?= base_url('admin/tugas/nilai/' . $submit['id_jawaban']) ?>" class="btn btn-sm btn-warning">
                                        <i class="fas fa-check-circle"></i>
                                    </a>
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