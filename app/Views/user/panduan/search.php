<?= $this->extend('user/template/template') ?>
<?= $this->Section('content'); ?>

<style>
    .custom-search-input {
        border: 2px solid black !important; /* Ubah warna border menjadi hitam */
    }
</style>

<div class="container mt-5 pt-3">
    <div class="row">
        <div class="col-lg-12">
            <div class="section-title">
                <h4 class="text-uppercase font-weight-bold">Panduan</h4>
                <form action="<?= base_url('panduan/search') ?>" method="get">
                    <div class="input-group" style="width: 100%; max-width: 300px;">
                        <input type="text" class="form-control border-0 custom-search-input" name="p" placeholder="Cari Panduan" style="color: black;">
                        <div class="input-group-append">
                            <button class="input-group-text bg-primary text-dark border-0 px-3" type="submit"><i
                                    class="fa fa-search"></i></button>
                        </div>
                    </div>
                </form>
                <!-- <div class="search-box">
                    <input type="text" id="searchInput" placeholder="Cari Panduan">
                    <button id="searchButton"><i
                                class="fa fa-search"></i></button>
                </div> -->
            </div>
        </div>
    </div>

    <div class="row">
        <?php $count = 0; ?>
        <?php if (!empty($panduan)): ?>
        <?php foreach ($panduan as $row) : ?>
            <div class="col-lg-6 mb-4">
                <div class="bg-white border border-top-0 p-4">
                    <div class="d-flex justify-content-between">
                        <a class="h6 d-block mb-3 text-secondary text-uppercase font-weight-bold toggle-answer" data-toggle-id="<?= $row['id_panduan']; ?>">
                            <?= $row['pertanyaan']; ?>
                        </a>
                        <span class="toggle-icon" data-toggle-id="<?= $row['id_panduan']; ?>"><i class="fas fa-plus"></i></span>
                    </div>
                    <div id="answer-<?= $row['id_panduan']; ?>" class="answer" style="display: none;">
                        <?= $row['jawaban'] ?>
                        <button onclick="window.location.href='<?= base_url('/panduan/detail/' . $row['id_panduan']) ?>'">Baca Selengkapnya</button>
                    </div>
                </div>
            </div>
            <?php $count++; ?>
            <?php if ($count % 2 === 0) : ?>
    </div>
    <div class="row">
    <?php endif; ?>
<?php endforeach; ?>
<?php else : ?>
<div class="col-lg-12" style="height: 350px;">
    <div class="position-relative mb-3">
        <div class="bg-white border border-top-0 p-4 ">
            <p>Tidak ada panduan terkait.</p>
        </div>
    </div>
</div>
<?php endif; ?>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleElements = document.querySelectorAll('.toggle-answer, .toggle-icon');

        toggleElements.forEach(function(element) {
            element.addEventListener('click', function(event) {
                event.preventDefault();
                const answerId = this.getAttribute('data-toggle-id');
                const answerElement = document.getElementById('answer-' + answerId);

                if (answerElement.style.display === 'none') {
                    answerElement.style.display = 'block';
                    const icon = document.querySelector('.toggle-icon[data-toggle-id="' + answerId + '"] i');
                    if (icon) icon.className = 'fas fa-minus';
                } else {
                    answerElement.style.display = 'none';
                    const icon = document.querySelector('.toggle-icon[data-toggle-id="' + answerId + '"] i');
                    if (icon) icon.className = 'fas fa-plus';
                }
            });
        });
    });
</script>

<?= $this->endSection('content') ?>