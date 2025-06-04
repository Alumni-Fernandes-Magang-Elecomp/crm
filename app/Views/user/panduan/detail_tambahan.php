<?= $this->extend('user/template/template') ?>
<?= $this->Section('content'); ?>

<div class="container-fluid mt-1 pt-3">
    <div class="container h-100">
        <div class="row h-100">
            <!-- section 1 -->
            <div class="col-md-12 h-100 d-flex flex-column justify-content-center">
                <div class="section-title mb-0">
                    <h5 class="m-0 text-uppercase font-weight-bold">Buku Panduan Tambahan</h5>
                </div>
                <div class="bg-white border border-top-0 p-4 mb-5">
                    <div class="mb-4">
                        <h6 class="text-uppercase font-weight-bold"><?= $panduan_tambahan->pertanyaan ?></h6>
                    </div>
                    <div class="deskripsi-manual pt-3 pl-3">
                        <?= $panduan_tambahan->jawaban ?>
                    </div>
                </div>
            </div>
            <!-- end section -->
        </div>
    </div>
</div>

<?= $this->endSection('content'); ?>
