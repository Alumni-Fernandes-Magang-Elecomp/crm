<?= $this->extend('user/template/template') ?>
<?= $this->Section('content'); ?>

<style>
    .d-flex.align-items-center.bg-white.mb-3 {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 20px; /* Menambahkan margin hanya ke atas */
        margin-bottom: 20px; /* Menambahkan margin hanya ke bawah */
    }
</style>

<div class="container-fluid pt-5 mb-3">
    <div class="container">
        <div class="section-title">
            <h4 class="m-0 text-uppercase font-weight-bold"><?= $title ?></h4>
        </div>
        <hr class="mb-4">
        <?php if (session()->get('success')) : ?>
            <div class="alert alert-success">
                <?= session()->get('success') ?>
            </div>
        <?php endif; ?>
        <div class="d-flex align-items-center bg-white mb-3">
                <form class="form" action="<?= base_url('progress/proses_edit/' . $kirim_email['id_kirim_email']); ?>" method="post">
                    <?= csrf_field(); ?>
                    <div class="mb-3">
                        <label for="tgl_kirim_email" class="form-label">Tanggal Kirim Email</label>
                        <input type="date" class="form-control" id="tgl_kirim_email" name="tgl_kirim_email" value="<?= $kirim_email['tgl_kirim_email']; ?>" required readonly>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-select" id="id_user" name="id_user" value="<?= $kirim_email['id_user']; ?>" required hidden>
                    </div>
                    <div class="mb-3">
                        <label for="nama_perusahaan" class="form-label">Nama Perusahaan</label>
                        <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan" placeholder="Perusahaan" value="<?= $kirim_email['nama_perusahaan']; ?>" required readonly>
                    </div>
                    <div class="mb-3">
                        <label for="negara_perusahaan" class="form-label">Negara Perusahaan</label>
                        <input type="text" class="form-control" id="negara_perusahaan" name="negara_perusahaan" placeholder="Negara Perusahaan" value="<?= $kirim_email['negara_perusahaan']; ?>" required readonly>
                    </div>
                    <div class="mb-3">
                        <label for="status_terkirim" class="form-label">Status Terkirim</label>
                        <input type="text" class="form-control" id="status_terkirim" name="status_terkirim" placeholder="Status Terkirim" value="<?= $kirim_email['status_terkirim']; ?>" required readonly>
                    </div>
                    <div class="mb-3">
                        <label for="progress" class="form-label">Progress</label>
                        <textarea class="form-control tiny" id="progress" name="progress" rows="4" cols="50" style="height:100%;"><?= $kirim_email['progress']; ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>

        </div>
    </div><!--//app-card-body-->

    <hr class="my-4">
</div><!--//container-fluid-->


<?= $this->endSection('content'); ?>