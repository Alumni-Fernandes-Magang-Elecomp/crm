<?= $this->extend('user/template/template'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?= $title; ?></h6>
        </div>
        <div class="card-body">
            <form action="/tugas/proses_edit/<?= $tugas['id_tugas']; ?>" method="PUT">
                <?= csrf_field(); ?>

                <div class="form-group">
                    <label for="pelatihan">Pelatihan</label>
                    <select class="form-control <?= ($validation->hasError('id_pelatihan')) ? 'is-invalid' : ''; ?>"
                        name="id_pelatihan" required>
                        <option value="">Pilih Pelatihan</option>
                        <?php foreach ($pelatihan as $p) : ?>
                            <option value="<?= $p['id_pelatihan']; ?>"
                                <?= ($p['id_pelatihan'] == $tugas['id_pelatihan']) ? 'selected' : ''; ?>>
                                <?= esc($p['nama_pelatihan']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback">
                        <?= $validation->getError('id_pelatihan'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="hasil">Hasil Tugas</label>
                    <textarea class="form-control <?= ($validation->hasError('hasil')) ? 'is-invalid' : ''; ?>"
                        id="hasil" name="hasil" rows="10" required><?= old('hasil', $tugas['hasil']); ?></textarea>
                    <div class="invalid-feedback">
                        <?= $validation->getError('hasil'); ?>
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="/tugas" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>