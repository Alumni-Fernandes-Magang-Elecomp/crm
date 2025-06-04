<?= $this->extend('admin/template/template'); ?>
<?= $this->Section('content'); ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <h1 class="app-page-title">Tambahkan User</h1>
        <hr class="mb-4">
        <div class="row g-4 settings-section">
            <div class="col-12 col-md-8">
                <div class="app-card app-card-settings shadow-sm p-4">
                    <div class="card-body">
                        <form action="<?= base_url('admin/user/proses_tambah') ?>" method="POST" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <div class="row">
                                <div class="col">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label">Nama Perusahaan</label>
                                            <input type="text" class="form-control" id="nama_user" name="nama_user" value="<?= old('nama_user') ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Role</label>
                                            <select class="form-select" id="role" name="role">
                                                <option value="admin">Admin</option>
                                                <option value="user">User</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">HS Code</label>
                                            <input type="text" class="form-control" id="hs_code" name="hs_code" value="<?= old('hs_code') ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Menu Tampil</label>
                                            </br>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="menu_artikel" name="menu_tampil[]" value="artikel">
                                                <label class="form-check-label" for="menu_artikel">Artikel</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="menu_panduan" name="menu_tampil[]" value="panduan">
                                                <label class="form-check-label" for="menu_panduan">Panduan</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="menu_promo" name="menu_tampil[]" value="promo">
                                                <label class="form-check-label" for="menu_promo">Promo</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="menu_data_buyers" name="menu_tampil[]" value="data_buyers">
                                                <label class="form-check-label" for="menu_data_buyers">Data Buyers</label>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Pelatihan yang Diikuti</label>
                                            <div class="card border-0" style="max-height: 200px; overflow-y: auto;">
                                                <?php foreach ($pelatihan_options as $pelatihan): ?>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="pelatihan_<?= $pelatihan['id_pelatihan'] ?>"
                                                            name="id_pelatihan[]"
                                                            value="<?= $pelatihan['id_pelatihan'] ?>">
                                                        <label class="form-check-label" for="pelatihan_<?= $pelatihan['id_pelatihan'] ?>">
                                                            <?= $pelatihan['nama_pelatihan'] ?>
                                                        </label>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                            <div class="border-top mt-2 pt-2"> <!-- Garis atas dan padding -->
                                                <small class="text-muted">Pilih satu atau lebih pelatihan</small>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Username</label>
                                            <input type="text" class="form-control" id="username" name="username" value="<?= old('username') ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Password</label>
                                            <input type="text" class="form-control" id="password" name="password" value="<?= old('password') ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                    <div class="col">
                                        <?php if (!empty(session()->getFlashdata('success'))) : ?>
                                            <div class="alert alert-success" role="alert">
                                                <?php echo session()->getFlashdata('success') ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div><!--//app-card-->
            </div>
        </div><!--//row-->

        <hr class="my-4">
    </div><!--//container-fluid-->
</div><!--//app-content-->

<?= $this->endSection('content'); ?>