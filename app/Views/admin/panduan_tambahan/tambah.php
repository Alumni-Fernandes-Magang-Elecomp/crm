<?= $this->extend('admin/template/template'); ?>
<?= $this->Section('content'); ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <h1 class="app-page-title">Tambahkan Panduan Tambahan</h1>
        <hr class="mb-4">
        <div class="row g-4 settings-section">
            <div class="col-12 col-md-8">
                <div class="app-card app-card-settings shadow-sm p-4">
                    <div class="card-body">
                        <form action="<?= base_url('admin/panduan_tambahan/proses_tambah') ?>" method="POST" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Pertanyaan</label>
                                        <input type="text" class="form-control" id="pertanyaan" name="pertanyaan" value="<?= old('pertanyaan') ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Jawaban</label>
                                        <textarea class="form-control tiny" id="jawaban" name="jawaban" row="5" value="<?= old('jawaban') ?>"></textarea>
                                    </div>
                                    <div class="mb-3">
                                            <label class="form-label">ID User</label>
                                                </br>
                                                <?php foreach ($user as $user) :  ?>
                                                <input type="checkbox" id="id_user" name="id_user[]" value="<?= $user->id_user ?>">
                                                <label for="id_user">[<?= $user->id_user ?>]<?= $user->nama_user ?></label><br>
                                                <?php endforeach; ?>
                                        </div>
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

<?= $this->endSection('content'); ?>