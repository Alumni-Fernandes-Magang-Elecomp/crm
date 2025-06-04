<?= $this->extend('user/template/template') ?>
<?= $this->section('content'); ?>

<div class="container-fluid pt-5 mb-3">
    <div class="container">
        <div class="section-title">
            <h4 class="m-0 text-uppercase font-weight-bold">Edit Profil</h4>
        </div>
        <div class="bg-white border border-top-0 p-4 mb-3">
            <div class="row gy-4">
                <form action="<?= base_url('/profil/proses_edit') ?>" method="POST">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label for="nama_user" class="form-label mt-4">Nama Perusahaan</label>
                        <input type="text" class="form-control" id="nama_user" name="nama_user" value="<?= $profil_pengguna[0]['nama_user']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="nama_user" class="form-label mt-4">Alamat Perusahaan</label>
                        <textarea type="text" class="form-control tiny" id="alamat_user" name="alamat_user" rows="4" cols="50" style="height:100%;"><?= $profil_pengguna[0]['alamat_user']; ?></textarea>
                    </div>

                    <!-- Tambahkan field pelatihan -->
                    <div class="mb-3">
                        <label for="id_pelatihan" class="form-label mt-4">Pelatihan</label>
                        <select class="form-control" id="id_pelatihan" name="id_pelatihan">
                            <option value="">-- Pilih Pelatihan --</option>
                            <?php foreach ($daftar_pelatihan as $pelatihan): ?>
                                <option value="<?= $pelatihan['id_pelatihan'] ?>" <?= ($pelatihan['id_pelatihan'] == $profil_pengguna[0]['id_pelatihan']) ? 'selected' : '' ?>>
                                    <?= $pelatihan['nama_pelatihan'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Tambahkan field kota -->
                    <div class="mb-3">
                        <label for="id_kota" class="form-label mt-4">Kota/Kabupaten</label>
                        <select class="form-control" id="id_kota" name="id_kota">
                            <option value="">-- Pilih Kota/Kabupaten --</option>
                            <?php foreach ($daftar_kota as $kota): ?>
                                <option value="<?= $kota['id_kota'] ?>" <?= ($kota['id_kota'] == $profil_pengguna[0]['id_kota']) ? 'selected' : '' ?>>
                                    <?= $kota['nama_kota'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="nama_user" class="form-label mt-4">Nomor Telepon</label>
                        <input type="text" class="form-control" id="telp_user" name="telp_user" value="<?= $profil_pengguna[0]['telp_user']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="nama_user" class="form-label mt-4">Email Perusahaan</label>
                        <input type="text" class="form-control" id="email_user" name="email_user" value="<?= $profil_pengguna[0]['email_user']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="nama_user" class="form-label mt-4">HS Code</label>
                        <input type="text" class="form-control" id="hs_code" name="hs_code" value="<?= $profil_pengguna[0]['hs_code']; ?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label mt-4">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?= $profil_pengguna[0]['username']; ?>">
                        <small class="text-muted">* Jika Anda merubah username, silakan login kembali.</small>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label mt-4">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="password" name="password" value="<?= $profil_pengguna[0]['password']; ?>">
                            <div class="input-group-append">
                                <span class="input-group-text bg-transparent border-0" id="togglePassword">
                                    <i class="fa fa-eye"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="input-group-text bg-primary text-dark border-0 px-3">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const passwordInput = document.getElementById('password');
        const togglePassword = document.getElementById('togglePassword');

        togglePassword.addEventListener('click', function() {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
            } else {
                passwordInput.type = 'password';
            }
        });
    });
</script>

<?= $this->endSection('content') ?>