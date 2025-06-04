<?= $this->extend('admin/template/template'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Tugas - <?= esc($pelatihan['nama_pelatihan']) ?></h6>
        </div>
        <div class="card-body">
            <form action="/admin/tugas/simpan/<?= $pelatihan['id_pelatihan'] ?>" method="POST">
                <?= csrf_field() ?>

                <div class="form-group mb-3">
                    <label for="judul_tugas" class="font-weight-bold">Judul Tugas</label>
                    <input type="text" class="form-control <?= ($validation->hasError('judul_tugas')) ? 'is-invalid' : ''; ?>"
                        id="judul_tugas" name="judul_tugas" value="<?= old('judul_tugas'); ?>"
                        placeholder="Masukkan judul tugas">
                    <div class="invalid-feedback">
                        <?= $validation->getError('judul_tugas'); ?>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="soal" class="font-weight-bold">Soal/Instruksi Tugas</label>
                    <textarea class="form-control tiny <?= ($validation->hasError('soal')) ? 'is-invalid' : ''; ?>"
                        id="soal" name="soal" rows="5"
                        placeholder="Masukkan soal atau instruksi tugas"><?= old('soal'); ?></textarea>
                    <div class="invalid-feedback">
                        <?= $validation->getError('soal'); ?>
                    </div>
                </div>
                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Tugas
                    </button>
                    <a href="/admin/tugas/pelatihan/<?= $pelatihan['id_pelatihan'] ?>" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>