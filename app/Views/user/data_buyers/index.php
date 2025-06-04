<?= $this->extend('user/template/template') ?>
<?= $this->section('content'); ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <div class="section-title">
            <h4 class="m-0 text-uppercase font-weight-bold">Data Buyers</h4>
        </div>
        <div class="tab-content" id="orders-table-tab-content">
            <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                <div class="app-card app-card-orders-table shadow-sm mb-5">
                    <div class="app-card-body">
                        <?php if (empty($data_buyers)) : ?>
                            <p>Jika data buyers kosong, tidak ada HS Code yang terkait dengan produk apa pun.</p>
                        <?php else : ?>
                            <div class="table-responsive">
                                <table class="table app-table-hover mb-0 text-left table-white " id="example"
                                    style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th class="text-center" valign="middle">No</th>
                                            <th class="text-center" valign="middle">Negara Buyers</th>
                                            <th class="text-center" valign="middle">Nama Perusahaan Buyers</th>
                                            <th class="text-center" valign="middle">E-Mail Buyers</th>
                                            <th class="text-center" valign="middle">Website Buyers</th>
                                            <th class="text-center" valign="middle">Produk Buyers</th>
                                            <th class="text-center" valign="middle">Data Diambil dari</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($data_buyers as $row) : ?>
                                            <tr>
                                                <td class="text-center" valign="middle"><?= $i; ?></td>
                                                <td class="text-center" valign="middle"><?= $row['negara_buyers'] ?></td>
                                                <td class="text-center" valign="middle"><?= $row['nama_perusahaan_buyers'] ?></td>
                                                <td class="text-center" valign="middle"><?= $row['email_buyers'] ?></td>
                                                <td class="text-center" valign="middle"><?= $row['website'] ?></td>
                                                <td class="text-center" valign="middle"><?= $row['produk_buyers'] ?></td>
                                                <td class="text-center" valign="middle"><?= $row['data_diambil_dari'] ?></td>
                                            </tr>
                                            <?php $i++; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div><!--//table-responsive-->
                        <?php endif; ?>
                    </div><!--//app-card-body-->
                </div><!--//app-card-->
            </div><!--//tab-pane-->
        </div><!--//container-fluid-->
    </div><!--//app-content-->
</div><!--//app-wrapper-->

<?= $this->endSection('content') ?>