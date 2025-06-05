<?= $this->extend('admin/template/template'); ?>
<?= $this->Section('content'); ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <h1 class="app-page-title"><?= $title; ?></h1>
        <hr class="mb-4">
        <div class="row g-4 settings-section">
            <div class="col-12 col-md-8">
                <div class="app-card app-card-settings shadow-sm p-4">
                    <div class="card-body">
                        <?php if (isset($errors)): ?>
                            <div class="alert alert-danger">
                                <ul>
                                    <?php foreach ($errors as $error): ?>
                                        <li><?= $error; ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <form action="<?= base_url('admin/voucher/proses_tambah'); ?>" method="post">
                            <?= csrf_field() ?>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="nama_voucher">Nama Voucher</label>
                                        <input type="text" class="form-control" name="nama_voucher" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="kode_voucher">Kode Voucher</label>
                                        <input type="text" class="form-control" name="kode_voucher" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="kategori_voucher">Kategori Voucher</label>
                                        <select class="form-control" name="kategori_voucher" id="kategori_voucher" required>
                                            <option value="">Pilih Kategori</option>
                                            <?php
                                            $kategoriOptions = $kategoriOptions ?? [
                                                'digital_marketing' => 'Digital Marketing (Diskon Persentase)',
                                                'web_development' => 'Pembuatan Website (Diskon Nominal)'
                                            ];
                                            foreach ($kategoriOptions as $value => $label): ?>
                                                <option value="<?= $value; ?>"><?= $label; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="nilai_diskon">Nilai Diskon</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="nilai_diskon" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="discount_suffix">%</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="deskripsi">Deskripsi</label>
                                        <textarea class="form-control" name="deskripsi" rows="3"></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="berlaku_sampai">Berlaku Sampai</label>
                                        <input type="datetime-local" class="form-control" name="berlaku_sampai" required>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                            <a href="<?= base_url('admin/voucher/index'); ?>" class="btn btn-secondary">Batal</a>
                                        </div>
                                        <div class="col">
                                            <?php if (!empty(session()->getFlashdata('success'))): ?>
                                                <div class="alert alert-success" role="alert">
                                                    <?php echo session()->getFlashdata('success') ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
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

<script>
    document.getElementById('kategori_voucher').addEventListener('change', function() {
        const suffix = this.value === 'web_development' ? 'Rp' : '%';
        document.getElementById('discount_suffix').textContent = suffix;
    });
</script>
<?= $this->endSection(); ?>