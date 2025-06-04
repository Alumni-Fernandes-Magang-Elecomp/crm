<?= $this->extend('user/template/template') ?>
<?= $this->section('content'); ?>

<div class="container-fluid pt-5 mb-3">
    <div class="container">
        <div class="section-title">
            <h4 class="m-0 text-uppercase font-weight-bold">Promo</h4>
        </div>

        <?php if (empty($promo)) : ?>
            <div class="alert alert-info">Tidak ada promo yang tersedia saat ini.</div>
        <?php else : ?>
            <div class="row">
                <?php foreach ($promo as $row) : ?>
                    <div class="col-md-4 penulis-item mb-4">
                        <div class="position-relative overflow-hidden" style="height: 400px;">
                            <?php if (!empty($row->poster_promo) && file_exists('assets-baru/img/' . $row->poster_promo)) : ?>
                                <img class="img-fluid h-100 w-100" src="<?= base_url('assets-baru/img/' . $row->poster_promo) ?>" style="object-fit: cover;">
                            <?php else : ?>
                                <img class="img-fluid h-100 w-100" src="<?= base_url('assets-baru/img/default-promo.jpg') ?>" style="object-fit: cover;">
                            <?php endif; ?>
                            <div class="overlay">
                                <div class="mb-2">
                                    <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2"
                                        href="<?= base_url('/promo/detail/' . $row->id_promo); ?>">
                                        <?= strlen($row->judul_promo) > 22 ? substr($row->judul_promo, 0, 22) . '...' : $row->judul_promo ?>
                                    </a>
                                </div>
                                <a class="h7 m-0 text-white" href="<?= base_url('/promo/detail/' . $row->id_promo); ?>">
                                    <?= strlen($row->deskripsi_promo) > 17 ? substr($row->deskripsi_promo, 0, 17) . '...' : $row->deskripsi_promo ?>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection('content') ?>