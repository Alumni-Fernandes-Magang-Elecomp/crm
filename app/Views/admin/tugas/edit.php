<?= $this->extend('admin/template/template'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Tugas - <?= esc($pelatihan['nama_pelatihan']) ?></h6>
        </div>
        <div class="card-body">
            <!-- Tambahkan alert untuk pesan sukses -->
            <?php if(session()->getFlashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Sukses!</strong> <?= session()->getFlashdata('success') ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>

            <!-- Tambahkan alert untuk pesan error -->
            <?php if(session()->getFlashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> <?= session()->getFlashdata('error') ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('admin/tugas/update/' . $tugas['id_tugas']) ?>" method="POST">
                <?= csrf_field() ?>

                <div class="form-group mb-3">
                    <label for="judul_tugas" class="font-weight-bold">Judul Tugas</label>
                    <input type="text" class="form-control <?= ($validation->hasError('judul_tugas')) ? 'is-invalid' : ''; ?>"
                        id="judul_tugas" name="judul_tugas"
                        value="<?= old('judul_tugas', $tugas['judul_tugas']) ?>"
                        placeholder="Masukkan judul tugas">
                    <div class="invalid-feedback">
                        <?= $validation->getError('judul_tugas'); ?>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="soal" class="font-weight-bold">Soal/Instruksi Tugas</label>
                    <textarea class="form-control tiny <?= ($validation->hasError('soal')) ? 'is-invalid' : ''; ?>"
                        id="soal" name="soal" rows="5"
                        placeholder="Masukkan soal atau instruksi tugas"><?= old('soal', $tugas['soal']) ?></textarea>
                    <div class="invalid-feedback">
                        <?= $validation->getError('soal'); ?>
                    </div>
                </div>

                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Tugas
                    </button>
                    <a href="/admin/tugas/pelatihan/<?= $pelatihan['id_pelatihan'] ?>" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Script untuk auto-hide alert setelah 5 detik -->
<script>
$(document).ready(function(){
    // Auto-hide alert setelah 5 detik
    setTimeout(function(){
        $('.alert').fadeOut('slow');
    }, 5000);
    
    // Fungsi untuk close alert
    $('.close').click(function(){
        $(this).parent().fadeOut('slow');
    });
});
</script>
<?= $this->endSection(); ?>