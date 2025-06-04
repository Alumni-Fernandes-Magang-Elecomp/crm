<?= $this->extend('admin/template/template'); ?>
<?= $this->Section('content'); ?>


<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <div class="row g-3 mb-4 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Daftar Artikel</h1>
            </div>
            </br>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="<?php echo base_url() . "admin/artikel/tambah" ?>" class="btn btn-primary me-md-2"> + Tambah Artikel</a>
            </div>
        </div>
        <div class="tab-content" id="orders-table-tab-content">
            <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                <div class="app-card app-card-orders-table shadow-sm mb-5">
                    <div class="app-card-body">
                        <div class="table-responsive">
                            <table class="table app-table-hover mb-0 text-left">
                                <thead>
                                    <tr>
                                        <th class="text-center" valign="middle">No</th>
                                        <th class="text-center" valign="middle">Judul Artikel</th>
                                        <th class="text-center" valign="middle">Kategori Artikel</th>
                                        <th class="text-center" valign="middle">Deskripsi Artikel</th>
                                        <th class="text-center" valign="middle">Tags</th>
                                        <th class="text-center" valign="middle">Views</th>
                                        <th class="text-center" valign="middle">Foto Artikel</th>
                                        <th class="text-center" valign="middle">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($all_data_artikel as $tampilArtikel) : ?>
                                        <tr>
                                            <td class="text-center" valign="middle"><?php echo $i; ?></td>
                                            <td class="text-center" valign="middle"><?= $tampilArtikel['judul_artikel'] ?></td>
                                            <td class="text-center" valign="middle"><?= $tampilArtikel['nama_kategori'] ?></td>
                                            <td class="text-center col-4" valign="middle"><?= substr($tampilArtikel['deskripsi_artikel'], 0, 60) ?>...</td>
                                            <td class="text-center" valign="middle"><?= $tampilArtikel['tags'] ?></td>
                                            <td class="text-center" valign="middle"><?= $tampilArtikel['views'] ?></td>
                                            <td class="text-center col-2" valign="middle"><img src="<?= base_url() . 'assets-baru/img/' . $tampilArtikel['foto_artikel'] ?>" class="img-fluid" alt="Foto Artikel"></td>
                                            <td valign="middle">
                                                <div class="d-grid gap-2">
                                                    <a href="<?= base_url('admin/artikel/delete') . '/' . $tampilArtikel['id_artikel'] ?>" class="btn btn-danger">Hapus</a>
                                                    <a href="<?= base_url('admin/artikel/edit') . '/' . $tampilArtikel['id_artikel'] ?>" class="btn btn-primary">Ubah</a>
                                                    <a href="<?= base_url('admin/artikel/detail/' . $tampilArtikel['id_artikel'] . '/' . $tampilArtikel['slug']) ?>" class="btn btn-info" target="_blank">Preview</a>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php $i++; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div><!--//table-responsive-->
                    </div><!--//app-card-body-->
                </div><!--//app-card-->
            </div><!--//tab-pane-->
        </div><!--//container-fluid-->
    </div><!--//app-content-->
</div><!--//app-wrapper-->

<?= $this->endSection('content') ?>