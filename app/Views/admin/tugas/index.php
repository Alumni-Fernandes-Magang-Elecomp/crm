<?= $this->extend('admin/template/template'); ?>
<?= $this->Section('content'); ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <div class="row g-3 mb-4 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Daftar Pelatihan</h1>
            </div>
            </br>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="<?= base_url('admin/pelatihan/tambah') ?>" class="btn btn-primary me-md-2"> + Tambah Pelatihan</a>
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
                                        <th class="text-center" valign="middle">Nama Pelatihan</th>
                                        <th class="text-center" valign="middle">Tanggal Mulai</th>
                                        <th class="text-center" valign="middle">Tanggal Akhir</th>
                                        <th class="text-center" valign="middle">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($pelatihanList as $pelatihan) : ?>
                                        <tr>
                                            <td class="text-center" valign="middle"><?= $i ?></td>
                                            <td class="text-center" valign="middle"><?= esc($pelatihan['nama_pelatihan']) ?></td>
                                            <td class="text-center" valign="middle"><?= date('d M Y', strtotime($pelatihan['tgl_mulai'])) ?></td>
                                            <td class="text-center" valign="middle"><?= date('d M Y', strtotime($pelatihan['tgl_akhir'])) ?></td>
                                            <td class="text-center" valign="middle">
                                                <div class="d-grid gap-2">
                                                    <a href="<?= base_url('admin/tugas/pelatihan/' . $pelatihan['id_pelatihan']) ?>" class="btn btn-primary">Lihat Tugas</a>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php $i++; ?>
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