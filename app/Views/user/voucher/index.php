<?= $this->extend('user/template/template') ?>
<?= $this->section('content'); ?>

<div class="container mt-4">
    <h1 class="mb-4"><?= $title; ?></h1>

    <div class="row mb-4">
        <div class="col-md-12">
            <div class="btn-group" role="group">
                <a href="<?= base_url('voucher'); ?>" class="btn btn-outline-primary">Semua Voucher</a>
                <a href="<?= base_url('voucher/digital-marketing'); ?>" class="btn btn-outline-primary">Digital Marketing</a>
                <a href="<?= base_url('voucher/web-development'); ?>" class="btn btn-outline-primary">Pembuatan Website</a>
            </div>
        </div>
    </div>

    <?php if (empty($vouchers)): ?>
        <div class="alert alert-info">Tidak ada voucher yang tersedia saat ini.</div>
    <?php else: ?>
        <div class="row">
            <?php foreach ($vouchers as $voucher): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-header <?= $voucher['kategori_voucher'] == 'digital_marketing' ? 'bg-primary' : 'bg-success' ?> text-white">
                            <h5 class="card-title mb-0">
                                <?= $voucher['nama_voucher']; ?>
                                <span class="badge badge-light float-right">
                                    <?= $voucher['kategori_voucher'] == 'digital_marketing' ? 'Digital Marketing' : 'Web Development'; ?>
                                </span>
                            </h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                <strong>Kode:</strong> <?= $voucher['kode_voucher']; ?><br>
                                <strong>Diskon:</strong>
                                <?= $voucher['jenis_diskon'] == 'persentase' ?
                                    $voucher['nilai_diskon'] . '%' :
                                    'Rp ' . number_format($voucher['nilai_diskon'], 0, ',', '.')
                                ?>
                            </p>
                            <p class="card-text"><?= $voucher['deskripsi']; ?></p>
                            <p class="card-text"><small class="text-muted">Berlaku sampai: <?= date('d M Y H:i', strtotime($voucher['berlaku_sampai'])); ?></small></p>
                        </div>
                        <div class="card-footer">
                            <a href="<?= base_url('voucher/' . $voucher['kode_voucher']); ?>" class="btn btn-sm <?= $voucher['kategori_voucher'] == 'digital_marketing' ? 'btn-primary' : 'btn-success' ?>">Detail</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
<?= $this->endSection(); ?>