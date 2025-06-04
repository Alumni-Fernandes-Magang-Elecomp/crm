<?= $this->extend('admin/template/template'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Detail Pengumpulan Tugas: <?= esc($jawaban['judul_tugas'] ?? 'Detail Pengumpulan'); ?></h6>
            <a href="<?= base_url('admin/tugas/pengumpulan/' . $jawaban['id_tugas']) ?>" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Peserta</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?= esc($jawaban['nama_user'] ?? '-'); ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-user fa-2x text-gray-300"></i>
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
                                        Status Tugas</div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="text-xs text-muted">Status</div>
                                            <div class="h6 mb-1 font-weight-bold text-gray-800">
                                                <?= isset($jawaban['status']) ? ucfirst($jawaban['status']) : 'Belum dinilai'; ?>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-xs text-muted">Nilai</div>
                                            <div class="h6 mb-1 font-weight-bold text-gray-800">
                                                <?= $jawaban['nilai'] ?? '-'; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Detail Pengumpulan</h6>
                    <?php if (isset($jawaban['waktu_pengumpulan'])): ?>
                        <div class="text-right">
                            <span class="text-xs font-weight-bold text-muted text-uppercase">Waktu Pengumpulan</span>
                            <div class="text-dark font-weight-bold">
                                <?= date('d/m/Y H:i', strtotime($jawaban['waktu_pengumpulan'])); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="card-body">
                    <!-- Bagian Soal Tugas -->
                    <div class="mb-5">
                        <h5 class="font-weight-bold mb-3">Soal Tugas:</h5>
                        <div class="mb-4 pl-3">
                            <?= $jawaban['soal'] ?? 'Soal tidak tersedia'; ?>
                        </div>
                    </div>

                    <!-- Bagian Jawaban Peserta -->
                    <h5 class="font-weight-bold mb-3">Jawaban Peserta:</h5>
                    <div class="form-group">
                        <textarea class="form-control tiny"
                            style="min-height: 150px"
                            readonly
                            disabled
                            onfocus="this.blur()"><?= esc($jawaban['jawaban'] ?? 'Belum mengumpulkan jawaban'); ?></textarea>
                    </div>

                    <!-- Bagian Catatan Penilai -->
                    <?php if (!empty($jawaban['catatan'])): ?>
                        <div class="mt-4">
                            <h5 class="font-weight-bold mb-3">Catatan Penilai:</h5>
                            <div class="card bg-light p-3">
                                <?= nl2br(esc($jawaban['catatan'])); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>