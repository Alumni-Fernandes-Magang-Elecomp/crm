<<?= $this->extend('user/template/template') ?>
<?= $this->Section('content'); ?>

    <!-- News With Sidebar Start -->
    <div class="container-fluid pt-5 mb-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <!-- News Detail Start -->
                    <div class="position-relative mb-3">
                        <img class="img-fluid w-100" src="<?= base_url('assets-baru') ?>/img/<?= $artikel['foto_artikel']; ?>" style="object-fit: cover;">
                        <div class="bg-white border border-top-0 p-4">
                            <div class="mb-3">
                                <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2"
                                href="<?= base_url('kategori/' . $artikel['id_kategori']) ?>"><?= $artikel['nama_kategori']?></a>
                                <a class="text-body"><?= date('d F Y', strtotime($artikel['created_at']));  ?></a>
                            </div>
                            <h1 class="mb-3 text-secondary text-uppercase font-weight-bold"><?= $artikel['judul_artikel']; ?></h1>
                            <p><?= $artikel['deskripsi_artikel']; ?></p>
                        </div>
                        <div class="d-flex justify-content-between bg-white border border-top-0 p-4">
                            <div class="d-flex align-items-center">
                                <span class="ml-3"><i class="far fa-eye mr-2"></i><?= $artikel['views']; ?></span>
                                <!-- <span class="ml-3"><i class="far fa-comment mr-2"></i>123</span> -->
                            </div>
                        </div>
                    </div>
                    <!-- News Detail End -->
                </div>

                <div class="col-lg-4">
                    <!-- Popular News Start -->
                    <div class="mb-3">
                        <div class="section-title mb-0">
                            <h4 class="m-0 text-uppercase font-weight-bold">Baca Juga</h4>
                        </div>
                        <div class="bg-white border border-top-0 p-3">
                            <div class="d-flex align-items-center bg-white mb-3" style="height: 110px;">
                                <img class="img-fluid" style= "  width: 110px; height: 110px;" src="<?= base_url('assets-baru') ?>/img/<?= $artikel['foto_artikel']; ?>" alt="">
                                <div class="w-100 h-100 px-3 d-flex flex-column justify-content-center border border-left-0">
                                    <div class="mb-2">
                                    <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2"
                                        href="<?= base_url('kategori/' . $artikel['id_kategori']) ?>"><?= $artikel['nama_kategori']?></a>
                                    </div>
                                    <a class="h6 m-0 text-secondary text-uppercase font-weight-bold" href="<?= base_url('/artikel/detail/' . $artikel['id_artikel'] . '/' . $artikel['slug']) ?>"><?= $artikel['judul_artikel']; ?></a>
                                </div>
                            </div>
                            <?php foreach ($artikel_lain as $artikel_item) : ?>
                            <div class="d-flex align-items-center bg-white mb-3" style="height: 110px;">
                                <img class="img-fluid" style= "  width: 110px; height: 110px;" src="<?= base_url('assets-baru') ?>/img/<?= $artikel_item['foto_artikel']; ?>" alt="">
                                <div class="w-100 h-100 px-3 d-flex flex-column justify-content-center border border-left-0">
                                    <div class="mb-2">
                                    <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2"
                                        href="<?= base_url('kategori/' . $artikel_item['id_kategori']) ?>"><?= $artikel_item['nama_kategori']?></a>
                                    </div>
                                    <a class="h6 m-0 text-secondary text-uppercase font-weight-bold" href="<?= base_url('/artikel/detail/' . $artikel_item['id_artikel'] . '/' . $artikel_item['slug']) ?>"><?= $artikel_item['judul_artikel']; ?></a>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <!-- Popular News End -->

                    <!-- Newsletter Start -->
                    <!-- Newsletter End -->

                    <!-- Tags Start -->
                    <div class="mb-3">
                        <div class="section-title mb-0">
                            <h4 class="m-0 text-uppercase font-weight-bold">Tags</h4>
                        </div>
                        <div class="bg-white border border-top-0 p-3">
                            <div class="d-flex flex-wrap m-n1">
                                <?php $tags = explode(',', $artikel['tags']); ?>
                                <?php foreach ($tags as $tag) : ?>
                                    <a href="<?= base_url('/artikel/search?q=' . urlencode(trim($tag))) ?>" class="btn btn-sm btn-outline-secondary m-1"><?= $tag ?></a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <!-- Tags End -->
                </div>
            </div>
        </div>
    </div>
    <!-- News With Sidebar End -->


<?= $this->endSection('content'); ?>