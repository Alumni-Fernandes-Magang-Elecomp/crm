<<?= $this->extend('user/template/template') ?>
<?= $this->Section('content'); ?>

    <!-- News With Sidebar Start -->
    <div class="container-fluid pt-5 mb-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <!-- News Detail Start -->
                    <div class="position-relative mb-3">
                        <img class="img-fluid w-100" src="<?= base_url('assets-baru') ?>/img/<?= $promo->poster_promo; ?>" style="object-fit: cover;">
                        <div class="bg-white border border-top-0 p-4">
                            <h1 class="mb-3 text-secondary text-uppercase font-weight-bold"><?= $promo->judul_promo; ?></h1>
                            <p><?= $promo->deskripsi_promo; ?></p>
                        </div>
                        <div class="d-flex justify-content-between bg-white border border-top-0 p-4">
                        </div>
                    </div>
                    <!-- News Detail End -->
                </div>
                <div class="col-lg-4">
                        <div class="mb-3">
                            <div class="section-title mb-0">
                                <h4 class="m-0 text-uppercase font-weight-bold">Promo Lainnya</h4>
                            </div>
                            <div class="bg-white border border-top-0 p-3">
                                <?php foreach ($promo_lain as $promo_item) : ?>
                                    <div class="d-flex align-items-center bg-white mb-3" style="height: 110px;">
                                        <img class="img-fluid" style="width: 110px; height: 110px;" src="<?= base_url('assets-baru') ?>/img/<?= $promo_item['poster_promo']; ?>" alt="">
                                        <div class="w-100 h-100 px-3 d-flex flex-column justify-content-center border border-left-0">
                                            <a class="h6 m-0 text-secondary text-uppercase font-weight-bold" href="<?= base_url('/promo/detail/' . $promo_item['id_promo']) ?>"><?= $promo_item['judul_promo']; ?></a>
                                            <div class="mb-2">
                                                <a class="text-body" href="<?= base_url('/promo/detail/' . $promo_item['id_promo']) ?>"><?= substr($promo_item['deskripsi_promo'], 0, 30) ?>...</a>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <!-- News With Sidebar End -->


<?= $this->endSection('content'); ?>