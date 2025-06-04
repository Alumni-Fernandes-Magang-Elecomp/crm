<?= $this->extend('admin/template/template'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Pelatihan</h6>
            <a href="/admin/pelatihan/tambah" class="btn btn-primary btn-sm">Tambah Pelatihan</a>
        </div>
        <div class="card-body">
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif; ?>

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pelatihan</th>
                            <th>Tanggal</th>
                            <th>Lokasi</th>
                            <th>Materi</th>
                            <th>Penyelenggara</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($pelatihan as $p) : ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $p['nama_pelatihan']; ?></td>
                                <td><?= date('d M Y', strtotime($p['tgl_mulai'])) . ' - ' . date('d M Y', strtotime($p['tgl_akhir'])); ?></td>
                                <td><?= $p['nama_kota'] . ', ' . $p['nama_provinsi']; ?></td>
                                <td><?= $p['nama_materi']; ?></td>
                                <td><?= $p['id_penyelenggara_1']; ?></td>
                                <td>
                                    <a href="/admin/pelatihan/edit/<?= $p['id_pelatihan']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="/admin/pelatihan/delete/<?= $p['id_pelatihan']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>