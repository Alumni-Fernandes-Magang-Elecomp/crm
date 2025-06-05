<?= $this->extend('admin/template/template'); ?>
<?= $this->Section('content'); ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <h1 class="app-page-title">Tambah Pelatihan</h1>
        <hr class="mb-4">
        <div class="row g-4 settings-section">
            <div class="col-12 col-md-8">
                <div class="app-card app-card-settings shadow-sm p-4">
                    <div class="card-body">
                        <form action="/admin/pelatihan/proses_tambah" method="POST">
                            <?= csrf_field() ?>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="nama_pelatihan">Nama Pelatihan</label>
                                        <input type="text" class="form-control <?= ($validation->hasError('nama_pelatihan')) ? 'is-invalid' : ''; ?>"
                                            id="nama_pelatihan" name="nama_pelatihan" value="<?= old('nama_pelatihan'); ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('nama_pelatihan'); ?>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label" for="tgl_mulai">Tanggal Mulai</label>
                                            <input type="date" class="form-control <?= ($validation->hasError('tgl_mulai')) ? 'is-invalid' : ''; ?>"
                                                id="tgl_mulai" name="tgl_mulai" value="<?= old('tgl_mulai'); ?>">
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('tgl_mulai'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="tgl_akhir">Tanggal Akhir</label>
                                            <input type="date" class="form-control <?= ($validation->hasError('tgl_akhir')) ? 'is-invalid' : ''; ?>"
                                                id="tgl_akhir" name="tgl_akhir" value="<?= old('tgl_akhir'); ?>">
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('tgl_akhir'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="id_kota">Lokasi Kota</label>
                                        <select class="form-control <?= ($validation->hasError('id_kota')) ? 'is-invalid' : ''; ?>"
                                            id="id_kota" name="id_kota">
                                            <option value="">-- Pilih Kota --</option>
                                            <?php foreach ($kota as $k) : ?>
                                                <option value="<?= $k['id_kota']; ?>" <?= (old('id_kota') == $k['id_kota']) ? 'selected' : ''; ?>>
                                                    <?= $k['nama_kota'] . ' - ' . $k['nama_provinsi']; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('id_kota'); ?>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="lingkup_peserta">Lingkup Peserta</label>
                                        <textarea class="form-control" id="lingkup_peserta" name="lingkup_peserta" rows="3"><?= old('lingkup_peserta'); ?></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="id_materi">Materi Pelatihan</label>
                                        <select class="form-control <?= ($validation->hasError('id_materi')) ? 'is-invalid' : ''; ?>"
                                            id="id_materi" name="id_materi">
                                            <option value="">-- Pilih Materi --</option>
                                            <?php foreach ($materi as $m) : ?>
                                                <option value="<?= $m['id_materi']; ?>" <?= (old('id_materi') == $m['id_materi']) ? 'selected' : ''; ?>>
                                                    <?= $m['nama_materi']; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('id_materi'); ?>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="detail_materi">Detail Materi</label>
                                        <textarea class="form-control" id="detail_materi" name="detail_materi" rows="3"><?= old('detail_materi'); ?></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="id_penyelenggara_1">Penyelenggara 1</label>
                                        <select class="form-control <?= ($validation->hasError('id_penyelenggara_1')) ? 'is-invalid' : ''; ?>"
                                            id="id_penyelenggara_1" name="id_penyelenggara_1" required>
                                            <option value="">-- Pilih Penyelenggara Utama --</option>
                                            <?php foreach ($penyelenggara as $p) : ?>
                                                <option value="<?= $p['id_penyelenggara']; ?>" <?= (old('id_penyelenggara_1') == $p['id_penyelenggara']) ? 'selected' : ''; ?>>
                                                    <?= $p['pihak_penyelenggara'] ?? $p['nama_penyelenggara'] ?? 'Nama Tidak Tersedia'; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('id_penyelenggara_1'); ?>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="id_penyelenggara_2">Penyelenggara 2</label>
                                        <select class="form-control" id="id_penyelenggara_2" name="id_penyelenggara_2">
                                            <option value="">-- Pilih Penyelenggara Tambahan --</option>
                                            <?php foreach ($penyelenggara as $p) : ?>
                                                <option value="<?= $p['id_penyelenggara']; ?>" <?= (old('id_penyelenggara_2') == $p['id_penyelenggara']) ? 'selected' : ''; ?>>
                                                    <?= $p['pihak_penyelenggara'] ?? $p['nama_penyelenggara'] ?? 'Nama Tidak Tersedia'; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="id_penyelenggara_3">Penyelenggara 3</label>
                                        <select class="form-control" id="id_penyelenggara_3" name="id_penyelenggara_3">
                                            <option value="">-- Pilih Penyelenggara Tambahan --</option>
                                            <?php foreach ($penyelenggara as $p) : ?>
                                                <option value="<?= $p['id_penyelenggara']; ?>" <?= (old('id_penyelenggara_3') == $p['id_penyelenggara']) ? 'selected' : ''; ?>>
                                                    <?= $p['pihak_penyelenggara'] ?? $p['nama_penyelenggara'] ?? 'Nama Tidak Tersedia'; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                            <a href="/admin/pelatihan/index" class="btn btn-secondary">Batal</a>
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

<?= $this->endSection(); ?>