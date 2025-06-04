<?= $this->extend('user/template/template'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Tugas Pelatihan</h6>
            <a href="/tugas" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
        <div class="card-body">
            <!-- Card Informasi Pelatihan -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Pelatihan</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?= esc($pelatihan['nama_pelatihan']); ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-book fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        Waktu Pelatihan</div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="text-xs text-muted">Mulai</div>
                                            <div class="h6 mb-1 font-weight-bold text-gray-800">
                                                <?= date('d F Y', strtotime($pelatihan['tgl_mulai'])); ?>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-xs text-muted">Selesai</div>
                                            <div class="h6 mb-1 font-weight-bold text-gray-800">
                                                <?= date('d F Y', strtotime($pelatihan['tgl_akhir'])); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar-alt fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Daftar Tugas -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Tugas-tugas</h6>
                    <div class="text-right">
                        <span class="text-xs font-weight-bold text-muted text-uppercase">Total Tugas</span>
                        <div class="text-dark font-weight-bold">
                            <?= count($tugasList); ?> Tugas
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <?php foreach ($tugasList as $tugas): ?>
                        <div class="card mb-4 border-left-<?= isset($tugas['jawaban']) ? 'success' : 'primary' ?>">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h5 class="font-weight-bold text-primary mb-1"><?= esc($tugas['judul_tugas']); ?></h5>
                                        <?php if (isset($tugas['deadline'])): ?>
                                            <p class="text-muted mb-3">Dikumpulkan: <?= date('d F Y', strtotime($tugas['deadline'])); ?></p>
                                        <?php endif; ?>
                                        <div class="mb-3">
                                            <h6 class="font-weight-bold">Soal:</h6>
                                            <div class="soal-container">
                                                <div class="soal-preview">
                                                    <?= esc(strip_tags(substr($tugas['soal'], 0, 200))); ?>
                                                    <?php if (strlen(strip_tags($tugas['soal'])) > 200): ?>
                                                        <span class="text-muted">...</span>
                                                    <?php endif; ?>
                                                </div>
                                                <?php if (strlen(strip_tags($tugas['soal'])) > 200): ?>
                                                    <div class="soal-full" style="display: none;">
                                                        <?= esc(strip_tags($tugas['soal'])); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="badge badge-<?= isset($tugas['jawaban']) ? 'success' : 'warning' ?> align-self-start">
                                        <?= isset($tugas['jawaban']) ? 'Terkumpul' : 'Belum dikumpulkan' ?>
                                    </span>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <a href="/jawaban/kumpulkan/<?= $tugas['id_tugas']; ?>" class="btn btn-sm btn-primary mr-2">
                                        <i class="fas fa-paper-plane"></i> Kerjakan
                                    </a>
                                    <a href="/tugas/detail/<?= $tugas['id_tugas']; ?>" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function toggleSoal(button) {
        const container = button.closest('.soal-container');
        const preview = container.querySelector('.soal-preview');
        const full = container.querySelector('.soal-full');

        if (full.style.display === 'none') {
            preview.style.display = 'none';
            full.style.display = 'block';
            button.textContent = 'Sembunyikan';
        } else {
            preview.style.display = 'block';
            full.style.display = 'none';
            button.textContent = 'Baca selengkapnya';
        }
    }
</script>

<style>
    .soal-container {
        position: relative;
    }

    .read-more-btn {
        text-decoration: none;
        cursor: pointer;
    }
</style>
<?= $this->endSection(); ?>