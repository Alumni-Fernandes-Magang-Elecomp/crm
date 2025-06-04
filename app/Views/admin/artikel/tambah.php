<?= $this->extend('admin/template/template'); ?>
<?= $this->Section('content'); ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <h1 class="app-page-title">Tambahkan Artikel</h1>
        <hr class="mb-4">
        <div class="row g-4 settings-section">
            <div class="col-12 col-md-8">
                <div class="app-card app-card-settings shadow-sm p-4">
                    <div class="card-body">
                        <form action="<?= base_url('admin/artikel/proses_tambah') ?>" method="POST" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <!-- Dropdown untuk memilih kategori -->
                                        <label class="form-label" for="kategori">Kategori</label>
                                        <select class="form-control" name="id_kategori" id="id_kategori">
                                            <?php foreach ($all_data_kategori as $kategori) : ?>
                                                <option value="<?= $kategori->id_kategori; ?>"><?= $kategori->nama_kategori; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <!-- Dropdown untuk memilih penulis -->
                                    <div class="mb-3">
                                        <label class="form-label">Judul Artikel</label>
                                        <input type="text" class="form-control" id="judul_artikel" name="judul_artikel" value="<?= old('judul_artikel') ?>">
                                    </div>

                                    <div class="mb-3">
                                        <label for="deskripsi_artikel" class="form-label">Deskripsi Artikel</label>
                                        <textarea type="text" class="form-control tiny" id="deskripsi_artikel" name="deskripsi_artikel" rows="5" value="<?= old('deskripsi_artikel') ?>"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Tags</label>
                                        <input type="text" class="form-control" id="tags" name="tags" value="<?= old('tags') ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Foto Artikel</label>
                                        <input class="form-control <?= ($validation->hasError('foto_artikel')) ? 'is-invalid' : '' ?>" type="file" id="foto_artikel" name="foto_artikel">
                                        <?= $validation->getError('foto_artikel') ?>
                                    </div>
                                    <p>*Ukuran foto minimal 572x572 pixels</p>
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

<?= $this->endSection('content'); ?>