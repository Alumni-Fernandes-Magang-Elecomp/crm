<?= $this->extend('admin/template/template'); ?>
<?= $this->Section('content'); ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <h1 class="app-page-title">Edit User</h1>
        <hr class="mb-4">
        <div class="row g-4 settings-section">
            <div class="col-12 col-md-8">
                <div class="app-card app-card-settings shadow-sm p-4">
                    <div class="card-body">
                        <form action="<?= base_url('admin/user/proses_edit/' . $userData->id_user) ?>" method="POST" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Nama Perusahaan</label>
                                        <input type="text" class="form-control" id="nama_user" name="nama_user" value="<?= $userData->nama_user; ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Role</label>
                                        <select class="form-select" id="role" name="role">
                                            <option value="admin" <?= ($userData->role == 'admin') ? 'selected' : '' ?>>Admin</option>
                                            <option value="user" <?= ($userData->role == 'user') ? 'selected' : '' ?>>User</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">HS Code</label>
                                        <input type="text" class="form-control" id="hs_code" name="hs_code" value="<?= $userData->hs_code; ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Menu Tampil</label><br>
                                        <?php 
                                        $menu_tampil = $userData->menu_tampil ? explode(',', $userData->menu_tampil) : [];
                                        $options = ['artikel', 'panduan', 'promo', 'data_buyers'];
                                        foreach ($options as $option): ?>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" 
                                                       id="menu_<?= $option ?>" 
                                                       name="menu_tampil[]" 
                                                       value="<?= $option ?>"
                                                       <?= in_array($option, $menu_tampil) ? 'checked' : '' ?>>
                                                <label class="form-check-label" for="menu_<?= $option ?>">
                                                    <?= ucfirst($option) ?>
                                                </label>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Pelatihan yang Diikuti</label>
                                        <div class="card border-0" style="max-height: 200px; overflow-y: auto;">
                                            <?php
                                            // Get all pelatihan options from database
                                            $db = \Config\Database::connect();
                                            $pelatihan_options = $db->table('tb_pelatihan')->get()->getResultArray();
                                            
                                            // Get user's current pelatihan
                                            $pelatihanUserModel = new \App\Models\PelatihanUserModel();
                                            $userPelatihan = $pelatihanUserModel->where('id_user', $userData->id_user)->findAll();
                                            $currentPelatihan = array_column($userPelatihan, 'id_pelatihan');
                                            
                                            foreach ($pelatihan_options as $pelatihan): ?>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="pelatihan_<?= $pelatihan['id_pelatihan'] ?>"
                                                        name="id_pelatihan[]"
                                                        value="<?= $pelatihan['id_pelatihan'] ?>"
                                                        <?= in_array($pelatihan['id_pelatihan'], $currentPelatihan) ? 'checked' : '' ?>>
                                                    <label class="form-check-label" for="pelatihan_<?= $pelatihan['id_pelatihan'] ?>">
                                                        <?= $pelatihan['nama_pelatihan'] ?>
                                                    </label>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                        <div class="border-top mt-2 pt-2">
                                            <small class="text-muted">Pilih satu atau lebih pelatihan</small>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" value="<?= $userData->username; ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Password</label>
                                        <input type="text" class="form-control" id="password" name="password" value="<?= $userData->password; ?>">
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

<?= $this->endSection('content') ?>