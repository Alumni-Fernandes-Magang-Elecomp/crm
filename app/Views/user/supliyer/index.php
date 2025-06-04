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
                        <?php if (empty($data_supliyer)) : ?>
                            <p>Data supliyer kosong. Tidak ada HS Code yang terkait dengan supliyer mana pun.</p>
                        <?php else : ?>
                            <div class="table-responsive">
                                <table class="table app-table-hover mb-0 text-left table-white" id="example"
                                    style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th class="text-center" valign="middle">No</th>
                                            <th class="text-center" valign="middle">HS Code</th>
                                            <th class="text-center" valign="middle">Deskripsi HS Code</th>
                                            <th class="text-center" valign="middle">Nama Perusahaan</th>
                                            <th class="text-center" valign="middle">Alamat Perusahaan</th>
                                            <th class="text-center" valign="middle">No.Telepon Perusahaan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($data_supliyer as $row) : ?>
                                            <tr>
                                                <td class="text-center" valign="middle"><?= $i; ?></td>
                                                <td class="text-center" valign="middle"><?= $row['hs_code'] ?></td>
                                                <td class="text-center" valign="middle"><?= $row['deskripsi_hs'] ?? '-' ?></td>
                                                <td class="text-center" valign="middle"><?= $row['nama_supliyer'] ?></td>
                                                <td class="text-center" valign="middle"><?= $row['almt_supliyer'] ?></td>
                                                <td class="text-center" valign="middle"><?= $row['no_telp'] ?></td>
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