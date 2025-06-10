<?= $this->extend('admin/template/template'); ?>
<?= $this->Section('content'); ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <h1 class="app-page-title">Dashboard</h1>

        <!-- Welcome Card -->
        <div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration" role="alert">
            <div class="inner">
                <div class="app-card-body p-3 p-lg-4">
                    <h3 class="mb-3">Selamat datang, <?= session()->get('nama_user') ?>!</h3>
                    <div class="row gx-5 gy-3">
                        <div class="col-12 col-lg-9">
                            <div>
                                Anda login sebagai <strong><?= session()->get('role') ?></strong>.
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>

        <!-- Statistik Cards -->
        <div class="row g-4 mb-4">
            <!-- Total Users -->
            <div class="col-6 col-lg-3">
                <div class="app-card app-card-stat shadow-sm h-100">
                    <div class="app-card-body p-3 p-lg-4">
                        <h4 class="stats-type mb-1">Total Pengguna</h4>
                        <div class="stats-figure"><?= $total_users ?></div>
                        <div class="stats-meta">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-people-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z" />
                            </svg>
                            Total akun terdaftar
                        </div>
                    </div>
                    <a class="app-card-link-mask" href="<?= base_url('admin/user/index') ?>"></a>
                </div>
            </div>

            <!-- Active Promo -->
            <div class="col-6 col-lg-3">
                <div class="app-card app-card-stat shadow-sm h-100">
                    <div class="app-card-body p-3 p-lg-4">
                        <h4 class="stats-type mb-1">Promo Aktif</h4>
                        <div class="stats-figure"><?= $active_promos ?></div>
                        <div class="stats-meta">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-tag-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M2 1a1 1 0 0 0-1 1v4.586a1 1 0 0 0 .293.707l7 7a1 1 0 0 0 1.414 0l4.586-4.586a1 1 0 0 0 0-1.414l-7-7A1 1 0 0 0 6.586 1H2zm4 3.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                            </svg>
                            <?= $expiring_soon ?> akan berakhir
                        </div>
                    </div>
                    <a class="app-card-link-mask" href="<?= base_url('admin/promo/index') ?>"></a>
                </div>
            </div>

            <!-- Active Trainings -->
            <div class="col-6 col-lg-3">
                <div class="app-card app-card-stat shadow-sm h-100">
                    <div class="app-card-body p-3 p-lg-4">
                        <h4 class="stats-type mb-1">Pelatihan Aktif</h4>
                        <div class="stats-figure"><?= $active_trainings ?></div>
                        <div class="stats-meta">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-book-half" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M8.5 2.687v9.746c.935-.53 2.12-.603 3.213-.493 1.18.12 2.37.461 3.287.811V2.828c-.885-.35-1.976-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z" />
                            </svg>
                            <?= $upcoming_trainings ?> akan datang
                        </div>
                    </div>
                    <a class="app-card-link-mask" href="<?= base_url('admin/pelatihan/index') ?>"></a>
                </div>
            </div>

            <!-- Pending Tasks -->
            <div class="col-6 col-lg-3">
                <div class="app-card app-card-stat shadow-sm h-100">
                    <div class="app-card-body p-3 p-lg-4">
                        <h4 class="stats-type mb-1">Tugas Menunggu</h4>
                        <div class="stats-figure"><?= $pending_tasks ?></div>
                        <div class="stats-meta">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-clipboard-check" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z" />
                                <path fill-rule="evenodd" d="M9.5 1h-3a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3zm4.354 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                            </svg>
                            Perlu penilaian
                        </div>
                    </div>
                    <a class="app-card-link-mask" href="<?= base_url('admin/tugas') ?>"></a>
                </div>
            </div>
        </div>

        <!-- Charts Row -->
        <div class="row g-4 mb-4">
            <div class="col-12 col-lg-6">
                <div class="app-card app-card-chart h-100 shadow-sm">
                    <div class="app-card-header p-3">
                        <h4 class="app-card-title">Statistik Pendaftar Pelatihan</h4>
                    </div>
                    <div class="app-card-body p-3 p-lg-4">
                        <canvas id="trainingChart" height="250"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="app-card app-card-chart h-100 shadow-sm">
                    <div class="app-card-header p-3">
                        <h4 class="app-card-title">Pengumpulan Tugas</h4>
                    </div>
                    <div class="app-card-body p-3 p-lg-4">
                        <canvas id="taskChart" height="250"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Tasks Row -->
        <div class="row g-4 mb-4">
            <div class="col-12 col-lg-6">
                <div class="app-card app-card-orders-table shadow-sm h-100">
                    <div class="app-card-header">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-auto">
                                <h4 class="app-card-title">Tugas Terbaru Perlu Dinilai</h4>
                            </div>
                            <div class="col-auto">
                                <a class="btn btn-sm btn-info" href="<?= base_url('admin/tugas') ?>">Lihat Semua</a>
                            </div>
                        </div>
                    </div>
                    <div class="app-card-body">
                        <div class="table-responsive">
                            <table class="table app-table-hover mb-0 text-left">
                                <thead>
                                    <tr>
                                        <th class="cell">Judul Tugas</th>
                                        <th class="cell">Pelatihan</th>
                                        <th class="cell">Pengumpulan</th>
                                        <th class="cell">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($recent_tasks as $task): ?>
                                        <tr>
                                            <td class="cell"><?= esc($task['judul_tugas']) ?></td>
                                            <td class="cell"><?= esc($task['nama_pelatihan']) ?></td>
                                            <td class="cell">
                                                <span class="badge bg-<?= $task['jumlah_pengumpulan'] > 0 ? 'warning' : 'secondary' ?>">
                                                    <?= $task['jumlah_pengumpulan'] ?> belum dinilai
                                                </span>
                                            </td>
                                            <td class="cell">
                                                <a class="btn btn-sm btn-outline-primary" href="<?= base_url('admin/tugas/pengumpulan/' . $task['id_tugas']) ?>">
                                                    Nilai
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-6">
                <div class="app-card app-card-orders-table shadow-sm h-100">
                    <div class="app-card-header">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-auto">
                                <h4 class="app-card-title">Pelatihan Mendatang</h4>
                            </div>
                            <div class="col-auto">
                                <a class="btn btn-sm btn-info" href="<?= base_url('admin/pelatihan/index') ?>">Lihat Semua</a>
                            </div>
                        </div>
                    </div>
                    <div class="app-card-body">
                        <div class="table-responsive">
                            <table class="table app-table-hover mb-0 text-left">
                                <thead>
                                    <tr>
                                        <th class="cell">Nama Pelatihan</th>
                                        <th class="cell">Tanggal</th>
                                        <th class="cell">Lokasi</th>
                                        <th class="cell">Peserta</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($upcoming_trainings_list as $training): ?>
                                        <tr>
                                            <td class="cell">
                                                <strong><?= esc($training['nama_pelatihan']) ?></strong>
                                                <div class="text-muted small"><?= esc($training['nama_materi']) ?></div>
                                            </td>
                                            <td class="cell">
                                                <?= date('d M Y', strtotime($training['tgl_mulai'])) ?>
                                                <div class="text-muted small">s/d <?= date('d M Y', strtotime($training['tgl_akhir'])) ?></div>
                                            </td>
                                            <td class="cell"><?= esc($training['nama_kota']) ?></td>
                                            <td class="cell">
                                                <span class="badge bg-success"><?= $training['jumlah_peserta'] ?> peserta</span>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Promo Ending Soon -->
        <div class="app-card app-card-orders-table shadow-sm mb-5">
            <div class="app-card-header">
                <div class="row justify-content-between align-items-center">
                    <div class="col-auto">
                        <h4 class="app-card-title">Promo Akan Berakhir</h4>
                    </div>
                    <div class="col-auto">
                        <a class="btn btn-sm btn-info" href="<?= base_url('admin/promo/index') ?>">Lihat Semua</a>
                    </div>
                </div>
            </div>
            <div class="app-card-body">
                <div class="table-responsive">
                    <table class="table app-table-hover mb-0 text-left">
                        <thead>
                            <tr>
                                <th class="cell">Promo</th>
                                <th class="cell">Periode</th>
                                <th class="cell">Sisa Waktu</th>
                                <th class="cell">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($ending_promos as $promo): ?>
                                <tr>
                                    <td class="cell">
                                        <strong><?= esc($promo['judul_promo']) ?></strong>
                                        <div class="text-muted small"><?= esc(substr($promo['deskripsi_promo'], 0, 50)) ?>...</div>
                                    </td>
                                    <td class="cell">
                                        <?= date('d M Y', strtotime($promo['mulai_promo'])) ?>
                                        <div class="text-muted small">s/d <?= date('d M Y', strtotime($promo['akhir_promo'])) ?></div>
                                    </td>
                                    <td class="cell">
                                        <?php
                                        $end_date = new DateTime($promo['akhir_promo']);
                                        $now = new DateTime();
                                        $interval = $now->diff($end_date);
                                        echo $interval->format('%a hari lagi');
                                        ?>
                                    </td>
                                    <td class="cell">
                                        <a class="btn btn-sm btn-outline-primary" href="<?= base_url('admin/promo/edit/' . $promo['id_promo']) ?>">
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Training Registration Chart
    const trainingCtx = document.getElementById('trainingChart').getContext('2d');
    const trainingChart = new Chart(trainingCtx, {
        type: 'bar',
        data: {
            labels: <?= json_encode($training_months) ?>,
            datasets: [{
                label: 'Pendaftar Pelatihan',
                data: <?= json_encode($training_data) ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Task Submission Chart
    const taskCtx = document.getElementById('taskChart').getContext('2d');
    const taskChart = new Chart(taskCtx, {
        type: 'line',
        data: {
            labels: <?= json_encode($activity_days) ?>,
            datasets: [{
                label: 'Tugas Dikumpulkan',
                data: <?= json_encode($task_data) ?>,
                borderColor: 'rgba(153, 102, 255, 1)',
                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                tension: 0.1,
                fill: true
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

<?= $this->endSection('content') ?>