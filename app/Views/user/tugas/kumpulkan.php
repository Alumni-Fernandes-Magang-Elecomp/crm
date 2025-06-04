<?= $this->extend('user/template/template'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid pt-5 mb-3">
    <div class="container">
        <div class="section-title">
            <h4 class="m-0 text-uppercase font-weight-bold">Kumpulkan Tugas</h4>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Soal Tugas: <?= esc($tugas['judul_tugas']) ?></h6>
            </div>
            <div class="card-body">
                <!-- Bagian Soal Tugas -->
                <div class="mb-5">
                    <h5 class="font-weight-bold">Pelatihan: <?= esc($tugas['nama_pelatihan'] ?? '') ?></h5>
                    <div class="mb-4">
                        <h6 class="font-weight-bold">Soal:</h6>
                        <div class="pl-3">
                            <?= $tugas['soal'] ?>
                        </div>
                    </div>
                </div>

                <!-- Bagian Form Pengumpulan -->
                <?php if (session('error')): ?>
                    <div class="alert alert-danger"><?= session('error') ?></div>
                <?php endif; ?>

                <?php if (session('success')): ?>
                    <div class="alert alert-success"><?= session('success') ?></div>
                <?php endif; ?>

                <form action="<?= base_url('jawaban/simpan/' . $tugas['id_tugas']) ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="id_tugas" value="<?= $tugas['id_tugas'] ?>">

                    <div class="form-group">
                        <label for="jawaban" class="font-weight-bold text-muted">Jawaban Anda</label>
                        <?php if (isset($validation) && $validation->hasError('jawaban')): ?>
                            <div class="text-danger small mb-2">
                                <?= $validation->getError('jawaban'); ?>
                            </div>
                        <?php endif; ?>
                        <textarea class="form-control tiny <?= (isset($validation) && $validation->hasError('jawaban')) ? 'is-invalid' : ''; ?>"
                            id="jawaban" name="jawaban" rows="8"
                            placeholder="Tulis jawaban Anda disini..."><?= old('jawaban', $jawaban['jawaban'] ?? '') ?></textarea>
                        <small class="form-text text-muted">
                            Minimal 10 karakter. Jelaskan secara detail jawaban Anda.
                        </small>
                    </div>

                    <!-- File Upload Section - Minimalist Version -->
                    <div class="form-group mt-4">
                        <label class="font-weight-bold text-muted mb-2">Lampiran File</label>

                        <?php if (isset($validation) && $validation->hasError('file_uploads')): ?>
                            <div class="text-danger small mb-2">
                                <?= $validation->getError('file_uploads'); ?>
                            </div>
                        <?php endif; ?>

                        <!-- File Upload Area -->
                        <div class="border rounded p-3 bg-light">
                            <div class="d-flex align-items-center">
                                <div class="mr-3">
                                    <span class="btn btn-sm btn-dark px-3 py-1"> <!-- Changed to btn-dark -->
                                        <i class="fas fa-paperclip mr-1"></i> Pilih File
                                        <input type="file" id="file_uploads" name="file_uploads[]" multiple
                                            class="position-absolute" style="opacity: 0; width: 100px;"
                                            accept=".jpg,.jpeg,.png,.pdf,.doc,.docx,.xls,.xlsx">
                                    </span>
                                </div>
                                <div class="small text-muted" id="file-info">
                                    Format: JPG, PDF, DOC, XLS (maks. 10MB)
                                </div>
                            </div>
                            <div id="file-preview" class="mt-2 small"></div>
                        </div>

                        <!-- Existing Files -->
                        <?php if (isset($jawaban['lampiran']) && !empty($jawaban['lampiran'])): ?>
                            <div class="mt-3">
                                <h6 class="font-weight-bold text-muted small">File Terlampir:</h6>
                                <div class="pl-2">
                                    <?php
                                    $files = json_decode($jawaban['lampiran'], true);
                                    foreach ($files as $file): ?>
                                        <div class="d-flex align-items-center mb-1">
                                            <a href="<?= base_url('uploads/tugas/' . $file) ?>" target="_blank" class="text-primary small mr-2">
                                                <i class="fas fa-file-alt mr-1"></i><?= $file ?>
                                            </a>
                                            <button type="button" class="btn btn-link text-danger p-0 small delete-file" data-file="<?= $file ?>">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="d-flex justify-content-between mt-5 pt-3 border-top">
                        <a href="<?= base_url('tugas/daftar_tugas/' . $tugas['id_pelatihan']) ?>" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left mr-1"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-paper-plane mr-1"></i> <?= $jawaban ? 'Update Jawaban' : 'Kumpulkan Jawaban' ?>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<script>
    // File selection handler
    document.getElementById('file_uploads').addEventListener('change', function(e) {
        const files = e.target.files;
        const filePreview = document.getElementById('file-preview');
        const fileInfo = document.getElementById('file-info');

        filePreview.innerHTML = '';

        if (files.length > 0) {
            fileInfo.textContent = files.length + ' file dipilih';

            if (files.length <= 3) {
                for (let i = 0; i < files.length; i++) {
                    filePreview.innerHTML += `
                        <div class="d-flex align-items-center mb-1">
                            <i class="fas fa-file text-muted mr-2"></i>
                            <span class="text-truncate" style="max-width: 200px;">${files[i].name}</span>
                            <small class="text-muted ml-2">(${(files[i].size/1024/1024).toFixed(2)} MB)</small>
                        </div>`;
                }
            } else {
                filePreview.innerHTML = `<div class="text-muted">${files.length} file dipilih</div>`;
            }
        } else {
            fileInfo.textContent = 'Format: JPG, PDF, DOC, XLS (maks. 10MB)';
        }
    });

    // File deletion handler
    document.querySelectorAll('.delete-file').forEach(btn => {
        btn.addEventListener('click', function() {
            if (confirm('Hapus file ini?')) {
                const file = this.getAttribute('data-file');
                fetch('<?= base_url('jawaban/hapus_file/') ?>' + file, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        id_tugas: '<?= $tugas['id_tugas'] ?>',
                        _token: '<?= csrf_hash() ?>'
                    })
                }).then(r => r.json()).then(data => {
                    if (data.success) this.closest('.d-flex').remove();
                });
            }
        });
    });
</script>
<?= $this->endSection(); ?>