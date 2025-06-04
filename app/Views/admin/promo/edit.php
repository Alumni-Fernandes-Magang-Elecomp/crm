<?= $this->extend('admin/template/template'); ?>
<?= $this->Section('content'); ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <h1 class="app-page-title">Edit Promo</h1>
        <hr class="mb-4">
        <div class="row g-4 settings-section">
            <div class="col-12 col-md-8">
                <div class="app-card app-card-settings shadow-sm p-4">
                    <div class="card-body">
                        <form action="<?= base_url('admin/promo/proses_edit/' . $promoData->id_promo) ?>" method="POST" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Judul Promo</label>
                                        <input type="text" class="form-control" id="judul_promo" name="judul_promo" value="<?= $promoData->judul_promo; ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Deskripsi Promo</label>
                                        <textarea class="form-control tiny" id="deskripsi_promo" name="deskripsi_promo"><?= $promoData->deskripsi_promo; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Mulai Promo</label>
                                        <input type="date" class="form-control" id="mulai_promo" name="mulai_promo" value="<?= $promoData->mulai_promo; ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Akhir Promo</label>
                                        <input type="date" class="form-control" id="akhir_promo" name="akhir_promo" value="<?= $promoData->akhir_promo; ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Poster Promo</label>
                                        <input type="file" class="form-control" id="poster_promo" name="poster_promo">
                                        <img width="150px" class="img-thumbnail" src="<?= base_url() . "assets-baru/img/" . $promoData->poster_promo; ?>">
                                        <?= $validation->getError('poster_promo') ?>
                                    </div>
                                    <p>*Ukuran foto maksimal 572x572 pixels</p>
                                    <p>*Foto harus berekstensi jpg/png/jpeg</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                                <div class="col">
                                    <?php if (!empty(session()->getFlashdata('success'))) : ?>
                                        <div class="alert alert-success" role="alert">
                                            <?php echo session()->getFlashdata('success') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </form>
                    </div>
                </div><!--//app-card-->

            </div>
        </div><!--//row-->

        <hr class="my-4">
    </div><!--//container-fluid-->
</div><!--//app-content-->

<?= $this->endSection('content') ?>