<?= $this->extend('admin/template/login'); ?>
<?= $this->Section('content'); ?>

<div class="row g-0 app-auth-wrapper">
    <div class="col-12 col-md-7 col-lg-6 auth-main-col text-center p-5">
        <div class="d-flex flex-column align-content-end">
            <div class="app-auth-body mx-auto">
                <div class="app-auth-branding mb-4"><a class="app-logo" href=""><img class="logo-icon me-2" src="<?php echo base_url('assets-baru/img/Logo_Fernandes-Raymond_23092023042412.jpg'); ?>" alt="logo"></a></div>
                <h2 class="auth-heading text-center mb-5">Daftar Akun Alumni Fernandes</h2>
                <div class="auth-form-container text-start">
                    <form class="auth-form register-form">
                        <?= csrf_field(); ?>

                        <div class="mb-3">
                            <label for="nama">Nama Lengkap <span class="text-danger">*</span></label>
                            <input id="nama" name="nama" type="text" class="form-control" placeholder="Nama lengkap" required>
                        </div>

                        <div class="mb-3">
                            <label for="perusahaan">Nama Perusahaan</label>
                            <input id="perusahaan" name="perusahaan" type="text" class="form-control" placeholder="Nama perusahaan">
                        </div>

                        <div class="mb-3">
                            <label for="produk">Produk <span class="text-danger">*</span></label>
                            <input id="produk" name="produk" type="text" class="form-control" placeholder="Produk yang dihasilkan" required>
                        </div>

                        <div class="mb-3">
                            <label for="jenis_kelamin">Jenis Kelamin <span class="text-danger">*</span></label>
                            <select id="jenis_kelamin" name="jenis_kelamin" class="form-control" required>
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="alamat">Alamat</label>
                            <textarea id="alamat" name="alamat" class="form-control" rows="2" placeholder="Alamat lengkap"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="kota">Kota/Kabupaten <span class="text-danger">*</span></label>
                            <select id="kota" name="id_kota_kabupaten" class="form-control" required>
                                <option value="">Pilih Kota/Kabupaten</option>
                                <!-- Options akan diisi dari database -->
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="email">Email <span class="text-danger">*</span></label>
                            <input id="email" name="email" type="email" class="form-control" placeholder="Email aktif" required>
                        </div>

                        <div class="mb-3">
                            <label for="website">Website</label>
                            <input id="website" name="website" type="url" class="form-control" placeholder="https://contoh.com">
                        </div>

                        <div class="mb-3">
                            <label for="instagram">Instagram</label>
                            <input id="instagram" name="instagram" type="text" class="form-control" placeholder="@username">
                        </div>

                        <div class="mb-3">
                            <label for="username">Username <span class="text-danger">*</span></label>
                            <input id="username" name="username" type="text" class="form-control" placeholder="Username untuk login" required>
                        </div>

                        <div class="mb-3">
                            <label for="password">Password <span class="text-danger">*</span></label>
                            <input id="password" name="password" type="password" class="form-control" placeholder="Password minimal 8 karakter" required>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn app-btn-primary w-100 theme-btn mx-auto">Daftar</button>
                        </div>

                        <div class="auth-option text-center pt-3">
                            Sudah punya akun? <a class="text-link" href="<?= base_url('login') ?>">Login disini</a>
                        </div>
                    </form>
                </div><!--//auth-form-container-->
            </div><!--//auth-body-->
        </div><!--//flex-column-->
    </div><!--//auth-main-col-->
    <div class="col-12 col-md-5 col-lg-6 h-100 auth-background-col">
        <div class="auth-background-holder"></div>
        <div class="auth-background-mask"></div>
        <div class="auth-background-overlay p-3 p-lg-5">
            <div class="d-flex flex-column align-content-end h-100">
                <div class="h-100"></div>
            </div>
        </div><!--//auth-background-overlay-->
    </div><!--//auth-background-col-->
</div><!--//row-->

<?= $this->endSection('content'); ?>