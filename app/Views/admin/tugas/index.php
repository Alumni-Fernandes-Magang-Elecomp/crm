<?= $this->extend('admin/template/template'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Pilih Pelatihan</h6>
        </div>
        <div class="card-body">
            <div class="list-group">
                <?php foreach ($pelatihanList as $pelatihan) : ?>
                    <a href="<?= base_url('admin/tugas/pelatihan/' . $pelatihan['id_pelatihan']) ?>"
                        class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1"><?= esc($pelatihan['nama_pelatihan']) ?></h5>
                            <small><?= date('d M Y', strtotime($pelatihan['tgl_mulai'])) ?> - <?= date('d M Y', strtotime($pelatihan['tgl_akhir'])) ?></small>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>