<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Homectrl');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

//ADMIN
$routes->get('login', 'Login::index');
$routes->post('login/process', 'Login::process');
$routes->get('logout', 'Login::logout');


// $routes->group('admin', ['filter' => 'usersAuth'], function ($routes) {
// Daftarkan rute-rute admin di sini
$routes->get('admin', 'admin\Dashboardctrl::routetoDashboard');
$routes->get('admin/dashboard', 'admin\Dashboardctrl::index');

$routes->get('admin/kategori/index', 'admin\Kategori::index');
$routes->get('admin/kategori/tambah', 'admin\Kategori::tambah');
$routes->post('admin/kategori/proses_tambah', 'admin\Kategori::proses_tambah');
$routes->get('admin/kategori/edit/(:num)', 'admin\Kategori::edit/$1');
$routes->post('admin/kategori/proses_edit/(:num)', 'admin\Kategori::proses_edit/$1');
$routes->get('admin/kategori/delete/(:any)', 'admin\Kategori::delete/$1');

$routes->get('admin/artikel/index', 'admin\Artikel::index');
$routes->get('admin/artikel/detail/(:num)/(:any)', 'admin\Artikel::viewArtikel/$1/$2');
$routes->get('admin/artikel/tambah', 'admin\Artikel::tambah');
$routes->post('admin/artikel/proses_tambah', 'admin\Artikel::proses_tambah');
$routes->get('/admin/artikel/edit/(:num)', 'admin\Artikel::edit/$1');
$routes->post('admin/artikel/proses_edit/(:num)', 'admin\Artikel::proses_edit/$1');
$routes->get('admin/artikel/delete/(:any)', 'admin\Artikel::delete/$1');

$routes->get('admin/promo/index', 'admin\Promo::index');
$routes->get('admin/promo/tambah', 'admin\Promo::tambah');
$routes->post('admin/promo/proses_tambah', 'admin\Promo::proses_tambah');
$routes->get('/admin/promo/edit/(:num)', 'admin\Promo::edit/$1');
$routes->post('admin/promo/proses_edit/(:num)', 'admin\Promo::proses_edit/$1');
$routes->get('admin/promo/delete/(:any)', 'admin\Promo::delete/$1');

$routes->get('admin/panduan/index', 'admin\Panduan::index');
$routes->get('admin/panduan/tambah', 'admin\Panduan::tambah');
$routes->post('admin/panduan/proses_tambah', 'admin\Panduan::proses_tambah');
$routes->get('/admin/panduan/edit/(:num)', 'admin\Panduan::edit/$1');
$routes->post('admin/panduan/proses_edit/(:num)', 'admin\Panduan::proses_edit/$1');
$routes->get('admin/panduan/delete/(:any)', 'admin\Panduan::delete/$1');

$routes->get('admin/panduan_tambahan/index', 'admin\Panduan_tambahan::index');
$routes->get('admin/panduan_tambahan/tambah', 'admin\Panduan_tambahan::tambah');
$routes->post('admin/panduan_tambahan/proses_tambah', 'admin\Panduan_tambahan::proses_tambah');
$routes->get('/admin/panduan_tambahan/edit/(:num)', 'admin\Panduan_tambahan::edit/$1');
$routes->post('admin/panduan_tambahan/proses_edit/(:num)', 'admin\Panduan_tambahan::proses_edit/$1');
$routes->get('admin/panduan_tambahan/delete/(:any)', 'admin\Panduan_tambahan::delete/$1');

$routes->get('admin/user/index', 'admin\User::index');
$routes->get('admin/user/tambah', 'admin\User::tambah');
$routes->post('admin/user/proses_tambah', 'admin\User::proses_tambah');
$routes->get('/admin/user/edit/(:num)', 'admin\User::edit/$1');
$routes->post('admin/user/proses_edit/(:num)', 'admin\User::proses_edit/$1');
$routes->get('admin/user/delete/(:any)', 'admin\User::delete/$1');

$routes->get('admin/voucher/index', 'admin\VoucherController::index');
$routes->get('admin/voucher/tambah', 'admin\VoucherController::tambah');
$routes->post('admin/voucher/proses_tambah', 'admin\VoucherController::proses_tambah');
$routes->get('/admin/voucher/edit/(:num)', 'admin\VoucherController::edit/$1');
$routes->post('admin/voucher/proses_edit/(:num)', 'admin\VoucherController::proses_edit/$1');
$routes->get('admin/voucher/delete/(:any)', 'admin\VoucherController::delete/$1');

$routes->get('admin/pelatihan/index', 'admin\Pelatihancrl::index');
$routes->get('admin/pelatihan/tambah', 'admin\Pelatihancrl::tambah');
$routes->post('admin/pelatihan/proses_tambah', 'admin\Pelatihancrl::proses_tambah');
$routes->get('admin/pelatihan/edit/(:num)', 'admin\Pelatihancrl::edit/$1');
$routes->post('admin/pelatihan/proses_edit/(:num)', 'admin\Pelatihancrl::proses_edit/$1');
$routes->get('admin/pelatihan/delete/(:num)', 'admin\Pelatihancrl::delete/$1');

// Routes untuk Tugas Admin
$routes->get('admin/tugas', 'admin\Tugasctrl::index');
$routes->get('admin/tugas/pelatihan/(:num)', 'admin\Tugasctrl::tugasByPelatihan/$1');
$routes->get('admin/tugas/tambah/(:num)', 'admin\Tugasctrl::tambah/$1');
$routes->post('admin/tugas/simpan/(:num)', 'admin\Tugasctrl::simpan/$1');
$routes->get('admin/tugas/edit/(:num)', 'admin\Tugasctrl::edit/$1');
$routes->post('admin/tugas/update/(:num)', 'admin\Tugasctrl::update/$1');
$routes->get('admin/tugas/hapus/(:num)', 'admin\Tugasctrl::hapus/$1');

// Tambahkan ini di bagian admin routes
$routes->get('admin/tugas/detail/(:num)', 'admin\Tugasctrl::detail/$1');
$routes->get('admin/tugas/pengumpulan/(:num)', 'admin\Tugasctrl::pengumpulan/$1');
$routes->get('admin/tugas/detail_pengumpulan/(:num)', 'admin\Tugasctrl::detail_pengumpulan/$1');
$routes->get('admin/tugas/nilai/(:num)', 'admin\Tugasctrl::nilai/$1');
$routes->post('admin/tugas/proses_nilai/(:num)', 'admin\Tugasctrl::proses_nilai/$1');



//USER
// start frond end routes
$routes->get('/', 'user\Homectrl::index');
// route halaman artikel
$routes->get('/artikel', 'user\Artikelctrl::index');
$routes->get('/artikel/detail/(:num)/(:any)', 'user\Artikelctrl::viewArtikel/$1/$2');
$routes->get('/artikel/search', 'user\Searchctrl::search');
// route halaman kategori
$routes->get('/kategori/(:num)', 'user\Artikelctrl::artikelKategori/$1');
// route halaman panduan
$routes->get('/panduan', 'user\Panduanctrl::index');
$routes->get('/panduan/search', 'user\Panduanctrl::search');
$routes->get('/panduan/detail/(:any)', 'user\Panduanctrl::viewPanduan/$1');
$routes->get('/panduan_tambahan/detail/(:any)', 'user\Panduanctrl::viewPanduanTambahan/$1');
// route halaman promo
$routes->get('/promo', 'user\Promoctrl::index');
$routes->get('/promo/detail/(:any)', 'user\Promoctrl::viewPromo/$1');
$routes->get('/promo/artikel_promo/(:any)', 'user\Promoctrl::artikelPromo/$1');
// route halaman data buyers
$routes->get('/data_buyers', 'user\DataBuyersctrl::index');
// route halaman data suplier
$routes->get('/supliyer', 'user\Supliyerctrl::index');
// route halaman profil
$routes->get('/profil', 'user\Profilctrl::edit');
$routes->post('/profil/proses_edit', 'user\Profilctrl::edit');
// route voucher
$routes->get('/voucher/digital-marketing', 'user\VoucherController::digitalMarketing');
$routes->get('/voucher/web-development', 'user\VoucherController::webDevelopment');
$routes->get('/voucher', 'user\VoucherController::index');
$routes->get('/voucher/(:any)', 'user\VoucherController::detail/$1');
//tugas
$routes->get('/tugas', 'user\Tugasctrl::index');
$routes->get('/tugas/kumpulkan', 'user\Tugasctrl::kumpulkan');
$routes->get('/tugas/kumpulkan/(:num)', 'user\Tugasctrl::kumpulkan/$1');
$routes->post('/tugas/proses_kumpulkan', 'user\Tugasctrl::proses_kumpulkan');
$routes->get('/tugas/daftar_tugas/(:num)', 'user\Tugasctrl::daftar/$1');
$routes->get('/tugas/edit/(:num)', 'user\Tugasctrl::edit/$1');
$routes->put('/tugas/proses_edit/(:num)', 'user\Tugasctrl::edit/$1');
$routes->get('tugas/detail/(:num)', 'user\Tugasctrl::detail/$1');
// end frond end routes

// jawaban
$routes->get('/jawaban/kumpulkan/(:num)', 'user\Jawabanctrl::kumpulkan/$1');
$routes->post('/jawaban/simpan/(:num)', 'user\Jawabanctrl::simpan/$1');
$routes->get('jawaban/detail/(:num)', 'user\Jawabanctrl::detail/$1');
// end frond end routes

// pelatihan
$routes->get('/pelatihan-saya', 'user\PelatihanUserctrl::index');

//NPM
// Dashboard
$routes->get('/mpm', 'mpm\Dashboard::index');
$routes->get('/dashboardmpm/index', 'mpm\Dashboard::index');

// Progress
$routes->get('/progress', 'mpm\Progress::index');
$routes->get('/progress/daftar', 'mpm\Progress::index');
// Tambah Progress
$routes->get('/progress/tambah', 'mpm\Progress::tambah');
$routes->post('/progress/prosses_tambah', 'mpm\Progress::prosses_tambah');
// Edit Progress
$routes->get('/progress/edit/(:num)', 'mpm\Progress::edit/$1');
$routes->post('/progress/proses_edit/(:num)', 'mpm\Progress::proses_edit/$1');
// Delete Progress
$routes->get('/member/delete/(:num)', 'mpm\Progress::delete/$1');

// Rekapitulasi
$routes->get('/rekapitulasi', 'mpm\Rekapitulasi::index');


// route language home
// $routes->get('lang/{locale}', 'user\Homectrl::language');
// $routes->get('lang/(:segment)', 'user\Homectrl::language/$1');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
