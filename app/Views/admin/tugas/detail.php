<?= $this->extend('admin/template/template'); ?>
<?= $this->Section('content'); ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <div class="row g-3 mb-4 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Daftar Tugas - <?= esc($pelatihan['nama_pelatihan']) ?></h1>
            </div>
            <div class="col-auto">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="<?= base_url('admin/tugas/tambah/' . $pelatihan['id_pelatihan']) ?>" class="btn btn-primary me-md-2">
                        <i class="fas fa-plus"></i> Tambah Tugas
                    </a>
                </div>
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
                                        <th class="text-center" valign="middle">Judul Tugas</th>
                                        <th class="text-center" valign="middle">Soal</th>
                                        <th class="text-center" valign="middle">Dibuat</th>
                                        <th class="text-center" valign="middle">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($tugasList as $tugas) : ?>
                                        <tr>
                                            <td class="text-center" valign="middle"><?= $i++; ?></td>
                                            <td valign="middle"><?= esc($tugas['judul_tugas']) ?></td>
                                            <td valign="middle"><?= esc(substr(strip_tags($tugas['soal']), 0, 50)) ?>...</td>
                                            <td class="text-center" valign="middle"><?= date('d M Y H:i', strtotime($tugas['created_at'])) ?></td>
                                            <td valign="middle">
                                                <div class="d-grid gap-2">
                                                    <a href="<?= base_url('admin/tugas/edit/' . $tugas['id_tugas']) ?>" class="btn btn-primary">
                                                        <i class="fas fa-edit"></i> Ubah
                                                    </a>
                                                    <a href="<?= base_url('admin/tugas/hapus/' . $tugas['id_tugas']) ?>"
                                                        class="btn btn-danger"
                                                        onclick="return confirm('Yakin ingin menghapus?')">
                                                        <i class="fas fa-trash"></i> Hapus
                                                    </a>
                                                    <a href="<?= base_url('admin/tugas/pengumpulan/' . $tugas['id_tugas']) ?>" class="btn btn-info">
                                                        <i class="fas fa-users"></i> Pengumpulan
                                                    </a>
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