<?= $this->extend('admin/template/template'); ?>
<?= $this->Section('content'); ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <div class="row g-3 mb-4 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Pilih Pelatihan</h1>
            </div>
        </div>

        <div class="tab-content" id="orders-table-tab-content">
            <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                <div class="app-card app-card-orders-table shadow-sm mb-5">
                    <div class="app-card-body">
                        <div class="table-responsive">
                            <div class="list-group">
                                <?php foreach ($pelatihanList as $pelatihan) : ?>
                                    <a href="<?= base_url('admin/tugas/pelatihan/' . $pelatihan['id_pelatihan']) ?>"
                                        class="list-group-item list-group-item-action">
                                        <div class="d-flex w-100 justify-content-between align-items-center">
                                            <h5 class="mb-1"><?= esc($pelatihan['nama_pelatihan']) ?></h5>
                                            <small class="text-muted">
                                                <?= date('d M Y', strtotime($pelatihan['tgl_mulai'])) ?> -
                                                <?= date('d M Y', strtotime($pelatihan['tgl_akhir'])) ?>
                                            </small>
                                        </div>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div><!--//table-responsive-->
                    </div><!--//app-card-body-->
                </div><!--//app-card-->
            </div><!--//tab-pane-->
        </div><!--//tab-content-->

        <hr class="my-4">
    </div><!--//container-xl-->
</div><!--//app-content-->

<?= $this->endSection(); ?>