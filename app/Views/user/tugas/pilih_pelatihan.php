<?= $this->extend('user/template/template'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid pt-5 mb-3">
    <div class="container">
        <div class="section-title">
            <h4 class="m-0 text-uppercase font-weight-bold">Pilih Pelatihan</h4>
        </div>
        <?php if (empty($pelatihan)) : ?>
            <div class="alert alert-info">
                <i class="fas fa-info-circle mr-2"></i>Tidak ada pelatihan yang tersedia saat ini.
            </div>
        <?php else : ?>
            <div class="row">
                <?php foreach ($pelatihan as $p) : ?>
                    <div class="col-md-4 pelatihan-item mb-4">
                        <div class="position-relative overflow-hidden rounded shadow-sm" style="height: 300px; background-color: #f8f9fa;">
                            <div class="h-100 d-flex flex-column justify-content-between p-4">
                                <div>
                                    <h5 class="font-weight-bold mb-2"><?= esc($p['nama_pelatihan']) ?></h5>
                                </div>
                                <div class="text-center">
                                    <a href="/tugas/kumpulkan/<?= $p['id_pelatihan'] ?>" class="btn btn-primary btn-sm px-4">
                                        <i class="fas fa-arrow-right mr-2"></i>Pilih
                                    </a>
                                </div>
                            </div>
                            <div class="position-absolute top-0 right-0 bg-primary text-white px-3 py-1 small">
                                <?= !empty($p['kategori']) ? esc($p['kategori']) : 'Pelatihan' ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<style>
    .pelatihan-item {
        transition: transform 0.3s ease;
    }

    .pelatihan-item:hover {
        transform: translateY(-5px);
    }
</style>

<?= $this->endSection(); ?>