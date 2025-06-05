<?= $this->extend('admin/template/template'); ?>
<?= $this->Section('content'); ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <div class="row g-3 mb-4 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Pengumpulan Tugas: <?= esc($tugas['judul_tugas']) ?></h1>
            </div>
            <div class="col-auto">
                <a href="<?= base_url('admin/tugas/pelatihan/' . $tugas['id_pelatihan']) ?>" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </div>

        <div class="tab-content" id="orders-table-tab-content">
            <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                <div class="app-card app-card-orders-table shadow-sm mb-5">
                    <div class="app-card-body">
                        <div class="table-responsive">
                            <table class="table app-table-hover mb-0 text-left">
                                <thead>
                                    <tr>
                                        <th class="text-center" valign="middle">No</th>
                                        <th class="text-center" valign="middle">Nama Peserta</th>
                                        <th class="text-center" valign="middle">Waktu Submit</th>
                                        <th class="text-center" valign="middle">Status</th>
                                        <th class="text-center" valign="middle">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($pengumpulan as $submit): ?>
                                        <tr>
                                            <td class="text-center" valign="middle"><?= $i++; ?></td>
                                            <td class="text-center" valign="middle"><?= esc($submit['nama_user']) ?></td>
                                            <td class="text-center" valign="middle"><?= date('d/m/Y H:i', strtotime($submit['updated_at'])) ?></td>
                                            <td class="text-center" valign="middle">
                                                <span class="badge <?=
                                                                    ($submit['status'] == 'terkoreksi') ? 'bg-warning' : (($submit['status'] == 'dinilai') ? 'bg-success' : 'bg-primary')
                                                                    ?>">
                                                    <?= esc($submit['status_text']) ?>
                                                </span>
                                            </td>
                                            <td valign="middle">
                                                <div class="d-grid gap-2">
                                                    <a href="<?= base_url('admin/tugas/detail_pengumpulan/' . $submit['id_jawaban']) ?>" class="btn btn-info">Detail</a>
                                                    <a href="<?= base_url('admin/tugas/nilai/' . $submit['id_jawaban']) ?>" class="btn btn-warning">Nilai</a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div><!--//table-responsive-->
                    </div><!--//app-card-body-->
                </div><!--//app-card-->
            </div><!--//tab-pane-->
        </div><!--//tab-content-->

        <hr class="my-4">
    </div><!--//container-xl-->
</div><!--//app-content-->

<?= $this->endSection(); ?>