<?= $this->extend('user/template/template'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid pt-5 mb-3">
    <div class="container">
        <div class="section-title">
            <h4 class="m-0 text-uppercase font-weight-bold">Pelatihan Saya</h4>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><?= $title; ?></h6>
            </div>
            <div class="card-body">
                <?php if (session('success')) : ?>
                    <div class="alert alert-success"><?= session('success'); ?></div>
                <?php endif; ?>

                <?php if (session('error')) : ?>
                    <div class="alert alert-danger"><?= session('error'); ?></div>
                <?php endif; ?>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="bg-light">
                            <tr>
                                <th width="5%">No</th>
                                <th>Nama Pelatihan</th>
                                <th>Kota</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                                <th>Status</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($pelatihan)) : ?>
                                <tr>
                                    <td colspan="7" class="text-center py-4">
                                        <div class="text-muted">Anda belum terdaftar dalam pelatihan apapun</div>
                                    </td>
                                </tr>
                            <?php else : ?>
                                <?php foreach ($pelatihan as $i => $plthn) : ?>
                                    <tr>
                                        <td><?= $i + 1; ?></td>
                                        <td><?= esc($plthn['nama_pelatihan']); ?></td>
                                        <td><?= esc($plthn['nama_kota']); ?></td>
                                        <td><?= date('d/m/Y', strtotime($plthn['tgl_mulai'])); ?></td>
                                        <td><?= date('d/m/Y', strtotime($plthn['tgl_akhir'])); ?></td>
                                        <td>
                                            <span class="badge badge-<?=
                                                                        $plthn['status'] == 'aktif' ? 'success' : ($plthn['status'] == 'selesai' ? 'primary' : ($plthn['status'] == 'dropout' ? 'danger' : 'warning'))
                                                                        ?>">
                                                <?= ucfirst($plthn['status']) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <a href="/tugas/daftar_tugas/<?= $plthn['id_pelatihan']; ?>" class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i> Detail
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>