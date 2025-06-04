<!-- Navbar Start -->
<div class="container-fluid p-0">
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-2 py-lg-0 px-lg-5">
        <a href="/" class="navbar-brand d-block d-lg-none">
            <h1 class="m-0 display-4 text-uppercase text-primary"><span class="text-white font-weight-normal">CRM</span></h1>
        </a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between px-0 px-lg-3" id="navbarCollapse">
            <ul class="navbar-nav mr-auto py-0">
                <?php helper('url'); // Load the URL Helper if not already loaded 
                ?>
                <!--<li class="nav-item">-->
                <!--    <a href="<?= base_url('/') ?>" class="nav-link <?= current_url() === base_url('/') ? 'active' : '' ?>">Beranda</a>-->
                <!--</li>-->
                <li class="nav-item">
                    <a href="<?= base_url('/') ?>" class="nav-link <?= current_url() === base_url('/') ? 'active' : '' ?>">Data Buyers</a>
                </li>

                <li class="nav-item">
                    <a href="<?= base_url('/supliyer') ?>" class="nav-link <?= current_url() === base_url('/supliyer') ? 'active' : '' ?>">Data Supplier</a>
                </li>

                <!-- Delehen Ng nduwur iku gantinen ambek dropdownmu -->
                <?php $userRole = session()->get('role'); ?>
                <!-- Jika User -->
                <?php if ($userRole === 'user') : ?>
                    <!-- Tempate MPM -->
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">MPM</a>
                        <div class="dropdown-menu rounded-0 m-0">
                            <!--<a href="<?= base_url('/mpm') ?>" class="dropdown-item <?= current_url() === base_url('/mpm') ? 'active' : '' ?>">Dashboard MPM</a>-->
                            <a href="<?= base_url('/progress/tambah') ?>" class="dropdown-item <?= current_url() === base_url('/progress/tambah') ? 'active' : '' ?>">Tambah Progress</a>
                            <a href="<?= base_url('/progress') ?>" class="dropdown-item <?= current_url() === base_url('/progress') ? 'active' : '' ?>">Daftar Progress</a>
                            <a href="<?= base_url('/rekapitulasi') ?>" class="dropdown-item <?= current_url() === base_url('/rekapitulasi') ? 'active' : '' ?>">Rekapitulasi</a>
                        </div>
                    </div>
                    <li class="nav-item">
                        <a href="<?= base_url('/promo') ?>" class="nav-link <?= current_url() === base_url('/promo') ? 'active' : '' ?>">Promo</a>
                    </li>

                    <li class="nav-item">
                        <a href="<?= base_url('/voucher') ?>" class="nav-link <?= current_url() === base_url('/voucer') ? 'active' : '' ?>">Voucher</a>
                    </li>

                    <li class="nav-item">
                        <a href="<?= base_url('/pelatihan-saya') ?>" class="nav-link <?= current_url() === base_url('/tugas') ? 'active' : '' ?>">Tugas</a>
                    </li>
                    <!--<li class="nav-item">-->
                    <!--    <a href="whatsapp://send?phone=6285156329671" class="nav-link">Bantuan</a>-->
                    <!--</li>-->
                    <!-- Jika User -->
                <?php elseif ($userRole === 'admin') : ?>
                    <!--<li class="nav-item">-->
                    <!--    <a href="<?= base_url('/panduan') ?>" class="nav-link <?= current_url() === base_url('/panduan') ? 'active' : '' ?>">Panduan</a>-->
                    <!--</li>-->
                    <!--<li class="nav-item">-->
                    <!--    <a href="<?= base_url('/artikel') ?>" class="nav-link <?= current_url() === base_url('/artikel') ? 'active' : '' ?>">Artikel</a>-->
                    <!--</li>-->
                    <!--<li class="nav-item">-->
                    <!--    <a href="<?= base_url('/data_buyers') ?>" class="nav-link <?= current_url() === base_url('/data_buyers') ? 'active' : '' ?>">Data Buyers</a>-->
                    <!--</li>-->
                    <!--<li class="nav-item">-->
                    <!--    <a href="<?= base_url('/promo') ?>" class="nav-link <?= current_url() === base_url('/promo') ? 'active' : '' ?>">Promo</a>-->
                    <!--</li>-->
                    <!--<li class="nav-item">-->
                    <!--    <a href="whatsapp://send?phone=6285156329671" class="nav-link">Bantuan</a>-->
                    <!--</li>-->
                    <!-- Tempate MPM -->
                    <!--<div class="nav-item dropdown">-->
                    <!--    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">MPM</a>-->
                    <!--    <div class="dropdown-menu rounded-0 m-0">-->
                    <!--        <a href="<?= base_url('/mpm') ?>" class="dropdown-item <?= current_url() === base_url('/mpm') ? 'active' : '' ?>">Dashboard MPM</a>-->
                    <!--        <a href="<?= base_url('/progress/tambah') ?>" class="dropdown-item <?= current_url() === base_url('/progress/tambah') ? 'active' : '' ?>">Tambah Progress</a>-->
                    <!--        <a href="<?= base_url('/progress') ?>" class="dropdown-item <?= current_url() === base_url('/progress') ? 'active' : '' ?>">Daftar Progress</a>-->
                    <!--        <a href="<?= base_url('/rekapitulasi') ?>" class="dropdown-item <?= current_url() === base_url('/rekapitulasi') ? 'active' : '' ?>">Rekapitulasi</a>-->
                    <!--    </div>-->
                    <!--</div>-->
                    <li class="nav-item">
                        <a href="<?= base_url('/admin') ?>" class="nav-link">Admin</a>
                    </li>
                <?php endif; ?>

                <!-- Dropdown Mobile-->
                <li class="nav-item dropdown d-block d-lg-none">
                    <a class="nav-link dropdown-toggle" href="<?= base_url('/profil') ?>" class="nav-link <?= current_url() === base_url('/profil') ? 'active' : '' ?>" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Profil
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profileDropdown">
                        <a class="dropdown-item" href="<?= base_url('/profil') ?>" class="nav-link <?= current_url() === base_url('/profil') ? 'active' : '' ?>">Lihat Profil</a>
                        <a class="dropdown-item" href="<?= base_url('/logout') ?>" class="nav-link <?= current_url() === base_url('/logout') ? 'active' : '' ?>">Logout</a>
                    </div>
                </li>
            </ul>

            <!--<form action="<?= base_url('artikel/search') ?>" method="get">-->
            <!--<div class="input-group ml-auto d-none d-lg-flex" style="width: 100%; max-width: 300px;">-->
            <!--    <input type="text" class="form-control border-0" name="q" placeholder="Cari Artikel">-->
            <!--    <div class="input-group-append">-->
            <!--        <button class="input-group-text bg-primary text-dark border-0 px-3" type="submit"><i-->
            <!--                class="fa fa-search"></i></button>-->
            <!--    </div>-->
            <!--</div>-->
            <!--</form>-->

            <!-- Tombol Profil dan Dropdown Dekstop-->
            <div class="nav-item dropdown d-none d-lg-block">
                <a class="nav-link dropdown-toggle" href="<?= base_url('/profil') ?>" class="nav-link <?= current_url() === base_url('/profil') ? 'active' : '' ?>" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-user" style="font-size:38px;color:white"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profileDropdown">
                    <!-- Isi dropdown Anda di sini -->
                    <a class="dropdown-item" href="<?= base_url('/profil') ?>" class="nav-link <?= current_url() === base_url('/profil') ? 'active' : '' ?>">Lihat Profil</a>
                    <a class="dropdown-item" href="<?= base_url('/logout') ?>" class="nav-link <?= current_url() === base_url('/logout') ? 'active' : '' ?>">Logout</a>
                </div>
            </div>

        </div>
    </nav>
</div>
<!-- Navbar End -->