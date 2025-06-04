<?= $this->extend('user/template/template') ?>
<?= $this->Section('content'); ?>

<div class="container-fluid pt-5 mb-3">
    <div class="container">
        <div class="section-title">
            <h4 class="m-0 text-uppercase font-weight-bold"><?= $title ?></h4>
            <form method="get">
                <div class="row g-2 justify-content-start justify-content-md-end align-items-center">

                    <div class="col-auto">
                        <select class="form-select w-auto" name="bulan" id="bulan">
                            <option value="all" <?= $selectedBulan === 'all' ? 'selected' : ''; ?>>Semua Bulan</option>
                            <?php for ($bulan = 1; $bulan <= 12; $bulan++) : ?>
                                <option value="<?= $bulan; ?>" <?= $bulan == $selectedBulan ? 'selected' : ''; ?>>
                                    <?= date('F', mktime(0, 0, 0, $bulan, 1)); ?>
                                </option>
                            <?php endfor; ?>
                        </select>
                    </div>

                    <div class="col-auto">
                        <select class="form-select w-auto" name="tahun" id="tahun">
                            <option value="all" <?= $selectedTahun === 'all' ? 'selected' : ''; ?>>Semua Tahun</option>
                            <?php for ($tahun = 2022; $tahun <= date('Y'); $tahun++) : ?>
                                <option value="<?= $tahun; ?>" <?= $tahun == $selectedTahun ? 'selected' : ''; ?>>
                                    <?= $tahun; ?>
                                </option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    <div class="col-auto">
                        <input class="btn app-btn-secondary" type="submit" value="Filter">
                    </div>
                </div><!--//row-->
            </form>
        </div>

        <div class="tab-content" id="orders-table-tab-content">
            <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                <div class="app-card app-card-orders-table shadow-sm mb-5">
                    <div class="app-card-body">
                        <div class="table-responsive">
                            <table class="table app-table-hover mb-0 text-left table-white">
                                <thead>
                                    <tr>
                                        <th>Nama Member</th>
                                        <?php for ($i = 1; $i <= 31; $i++) : ?>
                                            <th><?= $i; ?></th>
                                        <?php endfor; ?>
                                        <th>Total</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php if (empty($laporan)) : ?>
                                        <tr>
                                            <td class="text-center" colspan="33">Tidak ada data kirim email</td>
                                        </tr>
                                    <?php else : ?>
                                        <tr>
                                            <td><?= $current_user['nama_user'] ?></td>
                                            <?php
                                            $total = 0;
                                            for ($i = 1; $i <= 31; $i++) :
                                                // Access data properly
                                                $count = isset($laporan[$current_user['nama_user']]['tgl_' . $i]) ?
                                                    $laporan[$current_user['nama_user']]['tgl_' . $i] : 0;
                                                $total += $count;
                                            ?>
                                                <td class="text-center"><?= $count; ?></td>
                                            <?php endfor; ?>
                                            <td class="text-center"><strong><?= $total; ?></strong></td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer spacing remains the same -->
<?= $this->endSection('content'); ?>