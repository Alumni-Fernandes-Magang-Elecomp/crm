<?= $this->extend('user/template/template') ?>
<?= $this->Section('content'); ?>


    <!-- News With Sidebar Start -->
    <div class="container-fluid mt-5 pt-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-12">
                            <div class="section-title">
                                <h4 class="m-0 text-uppercase font-weight-bold">Artikel</h4>
                            </div>
                        </div>
                        <?php foreach ($artikel as $row) :  ?>
                        <div class="col-lg-6">
                            <div class="position-relative mb-3">
                                <!-- <img data-src="<?= base_url('assets-baru') ?>/img/<?= $row['foto_artikel']; ?>" class="lazyload" style="width: 365px; height: 310px;" alt="Lazy-loaded Image"> -->
                                <img class="img-fluid w-100" style="width: 410px; height: 310px; object-fit:cover" src="<?= base_url('assets-baru') ?>/img/<?= $row['foto_artikel']; ?>" style="object-fit: cover;" loading="lazy">
                                <div class="bg-white border border-top-0 p-4 ">
                                    <div class="mb-2">
                                        <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2"
                                        href="<?= base_url('kategori/' . $row['id_kategori']) ?>"><?= $row['nama_kategori']?></a>
                                        <a class="text-body" href="<?= base_url('/artikel/detail/' . $row['id_artikel'] . '/' . $row['slug']) ?>"><?= date('d F Y', strtotime($row['created_at'])); ?></small></a>
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
                        <div class="col-lg-12">
                        </div>
                        <div class="col-lg-6">
                        </div>
                        <div class="col-lg-6">
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <!-- Social Follow Start -->
                    <!-- Social Follow End -->

                    <!-- Ads Start -->
                    <!-- Ads End -->

                    <!-- Popular News Start -->
                    <div class="mb-3">
                        <div class="section-title mb-0">
                            <h4 class="m-0 text-uppercase font-weight-bold">Artikel Popular</h4>
                        </div>
                        <div class="bg-white border border-top-0 p-3">
                            <?php foreach ($artikelpopular as $row) :  ?>
                            <div class="d-flex align-items-center bg-white mb-3" style="height: 110px;">
                                <img class="img-fluid" style= " width: 110px; height: 110px;" src="<?= base_url('assets-baru') ?>/img/<?= $row['foto_artikel']; ?>" alt="" loading="lazy">
                                <div class="w-100 h-100 px-3 d-flex flex-column justify-content-center border border-left-0">
                                    <div class="mb-2">
                                        <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2"
                                        href="<?= base_url('kategori/' . $row['id_kategori']) ?>"><?= $row['nama_kategori']?></a>
                                    </div>
                                    <a class="h6 m-0 text-secondary text-uppercase font-weight-bold" href="<?= base_url('/artikel/detail/' . $row['id_artikel'] . '/' . $row['slug']) ?>"><?= $row['judul_artikel']; ?></a>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <!-- Popular News End -->

                    <!-- Kategori Start -->
                    <div class="mb-3">
                        <div class="section-title mb-0">
                            <h4 class="m-0 text-uppercase font-weight-bold">Kategori</h4>
                        </div>
                        <div class="bg-white border border-top-0 p-3">
                            <ul>
                            <?php foreach ($kategori as $kat) : ?>
                                <li><a href="#" class="btn btn-sm btn-outline-secondary m-1"><?= $kat['nama_kategori'] ?></a></li>
                                <!-- Tambahkan kategori lainnya sesuai kebutuhan -->
                            <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                    <!-- Kategori End -->

                    <!-- Tags Start -->
                    <div class="mb-3">
                        <div class="section-title mb-0">
                            <h4 class="m-0 text-uppercase font-weight-bold">Tags</h4>
                        </div>
                        <div class="bg-white border border-top-0 p-3">
                            <div class="d-flex flex-wrap m-n1">
                                <?php $tags = explode(',', $row['tags']); ?>
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