<?= $this->extend('admin/template/template'); ?>
<?= $this->Section('content'); ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <h1 class="app-page-title">Tambah Tugas - <?= esc($pelatihan['nama_pelatihan']) ?></h1>
        <hr class="mb-4">

        <div class="row g-4 settings-section">
            <div class="col-12 col-md-8">
                <div class="app-card app-card-settings shadow-sm p-4">
                    <div class="card-body">
                        <form action="/admin/tugas/simpan/<?= $pelatihan['id_pelatihan'] ?>" method="POST">
                            <?= csrf_field() ?>

                            <div class="mb-3">
                                <label class="form-label" for="judul_tugas">Judul Tugas</label>
                                <input type="text"
                                    class="form-control <?= ($validation->hasError('judul_tugas')) ? 'is-invalid' : ''; ?>"
                                    id="judul_tugas"
                                    name="judul_tugas"
                                    value="<?= old('judul_tugas'); ?>"
                                    placeholder="Masukkan judul tugas">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('judul_tugas'); ?>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="soal">Soal/Instruksi Tugas</label>
                                <textarea class="form-control tiny <?= ($validation->hasError('soal')) ? 'is-invalid' : ''; ?>"
                                    id="soal"
                                    name="soal"
                                    rows="5"
                                    placeholder="Masukkan soal atau instruksi tugas"><?= old('soal'); ?></textarea>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('soal'); ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Simpan Tugas
                                    </button>
                                    <a href="/admin/tugas/pelatihan/<?= $pelatihan['id_pelatihan'] ?>" class="btn btn-secondary">
                                        <i class="fas fa-times"></i> Batal
                                    </a>
                                </div>
                                <div class="col">
                                    <?php if (!empty(session()->getFlashdata('success'))): ?>
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
    </div><!--//container-xl-->
</div><!--//app-content-->

<?= $this->endSection(); ?>