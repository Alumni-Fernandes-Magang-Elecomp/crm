<?= $this->extend('user/template/template') ?>

<?= $this->section('content'); ?>
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h2 class="mb-0"><?= $voucher['nama_voucher']; ?></h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Kode Voucher:</strong></p>
                    <div class="alert alert-secondary">
                        <h4 class="text-center mb-0"><?= $voucher['kode_voucher']; ?></h4>
                    </div>
                </div>
                <div class="col-md-6">
                    <p><strong>Jenis Diskon:</strong> <?= ucfirst($voucher['jenis_diskon']); ?></p>
                    <p><strong>Nilai Diskon:</strong>
                        <?= $voucher['jenis_diskon'] == 'persentase' ?
                            $voucher['nilai_diskon'] . '%' :
                            'Rp ' . number_format($voucher['nilai_diskon'], 0, ',', '.')
                        ?>
                    </p>
                    <p><strong>Berlaku Sampai:</strong> <?= date('d M Y H:i', strtotime($voucher['berlaku_sampai'])); ?></p>
                </div>
            </div>

            <hr>

            <h4>Deskripsi:</h4>
            <p><?= $voucher['deskripsi']; ?></p>

            <div class="mt-4">
                <button class="btn btn-primary" onclick="copyVoucherCode('<?= $voucher['kode_voucher']; ?>')">Salin Kode</button>
                <a href="<?= base_url('voucher'); ?>" class="btn btn-secondary">Kembali ke Daftar Voucer</a>
            </div>
        </div>
    </div>
</div>

<script>
    function copyVoucherCode(code) {
        navigator.clipboard.writeText(code).then(function() {
            alert('Kode voucher "' + code + '" telah disalin!');
        }, function() {
            alert('Gagal menyalin kode voucher');
        });
    }
</script>
<?= $this->endSection(); ?>