<?= $this->extend('admin/template/template'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Penilaian Tugas: <?= esc($jawaban['judul_tugas'] ?? 'Penilaian Tugas'); ?></h6>
            <a href="<?= base_url('admin/tugas/detail_pengumpulan/' . $jawaban['id_jawaban']) ?>" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
        <div class="card-body">
            <form action="<?= base_url('admin/tugas/proses_nilai/' . $jawaban['id_jawaban']) ?>" method="post">
                <?= csrf_field(); ?>

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
                                            Status Saat Ini</div>
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
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Form Penilaian</h6>
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

                        <!-- Form Input Nilai -->
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nilai">Nilai (0-100)</label>
                                    <input type="number" class="form-control" id="nilai" name="nilai"
                                        min="0" max="100" value="<?= old('nilai', $jawaban['nilai'] ?? ''); ?>"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control" id="status" name="status" required>
                                        <option value="dikirim" <?= ($jawaban['status'] == 'dikirim') ? 'selected' : '' ?>>Dikirim</option>
                                        <option value="dinilai" <?= ($jawaban['status'] == 'dinilai') ? 'selected' : '' ?>>Dinilai</option>
                                        <option value="terkoreksi" <?= ($jawaban['status'] == 'terkoreksi') ? 'selected' : '' ?>>Terkoreksi</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Catatan -->
                        <div class="form-group">
                            <label for="catatan">Catatan untuk Peserta</label>
                            <textarea class="form-control" id="catatan" name="catatan" rows="3"><?= old('catatan', $jawaban['catatan'] ?? ''); ?></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">
                            <i class="fas fa-save"></i> Simpan Nilai
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>