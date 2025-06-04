<?= $this->extend('user/template/template') ?>
<?= $this->Section('content'); ?>
<!-- <?php
print_r($promo);
?> -->
    <!-- Main News Slider Start -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 px-0">
                <div class="owl-carousel main-carousel position-relative">
                <?php foreach ($promo as $row) :  ?>
                    <div class="position-relative overflow-hidden" style="height: 500px;">
                        <img class="img-fluid h-100" src="<?= base_url('assets-baru') ?>/img/<?= $row['poster_promo']; ?>" style="object-fit: cover;" loading="lazy">
                        <div class="overlay">
                            <div class="mb-2">
                                <a class="text-white" href="<?= base_url('/promo/detail/' . $row['id_promo']) ?>"><?= date('d F Y', strtotime($row['mulai_promo'])); ?> s/d <?= date('d F Y', strtotime($row['akhir_promo'])); ?></a>
                            </div>
                            <a class="h2 m-0 text-white text-uppercase font-weight-bold" href="<?= base_url('/promo/detail/' . $row['id_promo']) ?>"><?= $row['judul_promo']; ?></a>
                        </div>
                    </div>
                <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Main News Slider End -->


    <!-- News With Sidebar Start -->
    <div class="container-fluid mt-5 pt-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h4 class="m-0 text-uppercase font-weight-bold">Artikel</h4>
                        <a class="text-secondary font-weight-medium text-decoration-none" href="<?= base_url('/artikel') ?>">Lihat Semua</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php foreach ($artikelterbaru as $row) : ?>
                    <div class="col-lg-4">
                        <div class="position-relative mb-3">
                            <img class="img-fluid w-100" style="width: 410px; height: 310px; object-fit:cover" src="<?= base_url('assets-baru') ?>/img/<?= $row['foto_artikel']; ?>" loading="lazy">
                            <div class="bg-white border border-top-0 p-4">
                                <div class="mb-2">
                                    <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2"
                                    href="<?= base_url('kategori/' . $row['id_kategori']) ?>"><?= $row['nama_kategori']?></a>
                                    <a class="text-body" href="<?= base_url('/artikel/detail/' . $row['id_artikel'] . '/' . $row['slug']) ?>"><?= date('d F Y', strtotime($row['created_at'])); ?></a>
                                </div>
                                <a class="h4 d-block mb-3 text-secondary text-uppercase font-weight-bold" href="<?= base_url('/artikel/detail/' . $row['id_artikel'] . '/' . $row['slug']) ?>"><?= $row['judul_artikel']; ?></a>
                                <!-- <p><?= substr($row['deskripsi_artikel'], 0, 30) ?>...</p> -->
                            </div>
                            <div class="d-flex justify-content-between bg-white border border-top-0 p-4">
                                <div class="d-flex align-items-center">
                                    <small class="ml-3"><i class="far fa-eye mr-2"></i><?= $row['views']; ?></small>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <!-- News With Sidebar End -->

<?= $this->endSection('content'); ?>