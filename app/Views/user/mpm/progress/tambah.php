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
            <form class="form" action="<?= base_url('progress/prosses_tambah'); ?>" method="post">
                <div class="mb-3">
                    <label for="setting-input-1" class="form-label">Tanggal Kirim Email<span class="ms-2" data-bs-container="body" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-placement="top" data-bs-content="This is a Bootstrap popover example. You can use popover to provide extra info."></label>
                    <input type="date" class="form-control" id="tgl_kirim_email" name="tgl_kirim_email" value="<?= date('Y-m-d'); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="id_member" class="form-label" hidden>Nama Member</label>
                    <input type="text" class="form-select" id="id_member" name="id_member" value="<?= $members[0]->id_user; ?>" required hidden>
                </div>
                <div class="mb-3">
                    <label for="nama_perusahaan" class="form-label">Nama Perusahaan</label>
                    <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan" placeholder="Nama Perusahaan">
                </div>
                <?php
                // Sertakan file countries.php
                include 'countries.php';
                ?>
                <div class="mb-3">
                    <label for="negara_perusahaan" class="form-label">Negara Perusahaan</label>
                    <select type="text" class="form-select" id="negara_perusahaan" name="negara_perusahaan" required>
                        <?php foreach ($countries as $country) : ?>
                            <option value="<?= $country; ?>"><?= $country; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="status_terkirim" class="form-label">Status Terkirim</label>
                    <select type="text" class="form-select" id="status_terkirim" name="status_terkirim" required>
                        <option value="Terkirim">Terkirim</option>
                        <option value="Gagal">Gagal</option>
                    </select>
                </div>
                <input type="hidden" id="progress_tambah" name="progress_tambah" value="Mengirim Email Pada Tanggal sesuai kolom tgl_kirim_email">
                <?= csrf_field(); ?>
                <button type="submit" class="btn-primary">Tambah</button>
            </form>
        </div>
    </div><!--//app-card-body-->
    <hr class="my-4">
</div><!--//app-card-->
<?= $this->endSection('content'); ?>