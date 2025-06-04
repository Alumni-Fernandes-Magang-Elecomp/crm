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
            </div>
        </div>
    </div>

    <div class="row">
        <?php $count = 0; ?>
        <?php foreach ($panduan as $row) : ?>
            <div class="col-lg-6 mb-4">
                <div class="bg-white border border-top-0 p-4">
                    <div class="d-flex justify-content-between">
                        <a class="h6 d-block mb-3 text-secondary text-uppercase font-weight-bold toggle-answer" data-toggle-id="<?= $row['id_panduan'] ?>">
                            <?= $row['pertanyaan'] ?>
                        </a>
                        <span class="toggle-icon" data-toggle-id="<?= $row['id_panduan'] ?>"><i class="fas fa-plus"></i></span>
                    </div>
                    <div id="answer-<?= $row['id_panduan'] ?>" class="answer" style="display: none;">
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
    </div>

    <?php if (!empty($panduan_tambahan)) : ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="section-title">
                <h4 class="text-uppercase font-weight-bold">Panduan Tambahan</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <?php $count = 0; ?>
        <?php foreach ($panduan_tambahan as $panduan_tambahan) : ?>
            <div class="col-lg-6 mb-4">
                <div class="bg-white border border-top-0 p-4">
                    <div class="d-flex justify-content-between">
                        <a class="h6 d-block mb-3 text-secondary text-uppercase font-weight-bold toggle-answer-tambahan" data-toggle-id-tambahan="<?= $panduan_tambahan['id_panduan'] ?>">
                            <?= $panduan_tambahan['pertanyaan'] ?>
                        </a>
                        <span class="toggle-icon-tambahan" data-toggle-id-tambahan="<?= $panduan_tambahan['id_panduan'] ?>"><i class="fas fa-plus"></i></span>
                    </div>
                    <div id="answer-tambahan-<?= $panduan_tambahan['id_panduan'] ?>" class="answer" style="display: none;">
                        <?= $panduan_tambahan['jawaban'] ?>
                        <button onclick="window.location.href='<?= base_url('/panduan_tambahan/detail/' . $panduan_tambahan['id_panduan']) ?>'">Baca Selengkapnya</button>
                    </div>
                </div>
            </div>
            <?php $count++; ?>
            <?php if ($count % 2 === 0) : ?>
    </div>
    <div class="row">
    <?php endif; ?>
    <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleElements = document.querySelectorAll('.toggle-answer, .toggle-icon');
        const toggleElementsTambahan = document.querySelectorAll('.toggle-answer-tambahan, .toggle-icon-tambahan');

        toggleElements.forEach(function(element) {
            element.addEventListener('click', function(event) {
                event.preventDefault();
                const answerId = this.getAttribute('data-toggle-id');
                const answerElement = document.getElementById('answer-' + answerId);

                if (answerElement.style.display === 'none' || answerElement.style.display === '') {
                    answerElement.style.display = 'block';
                    const icon = this.querySelector('i');
                    if (icon) icon.className = 'fas fa-minus';
                } else {
                    answerElement.style.display = 'none';
                    const icon = this.querySelector('i');
                    if (icon) icon.className = 'fas fa-plus';
                }
            });
        });

        toggleElementsTambahan.forEach(function(element) {
            element.addEventListener('click', function(event) {
                event.preventDefault();
                const answerIdTambahan = this.getAttribute('data-toggle-id-tambahan');
                const answerElementTambahan = document.getElementById('answer-tambahan-' + answerIdTambahan);

                if (answerElementTambahan.style.display === 'none' || answerElementTambahan.style.display === '') {
                    answerElementTambahan.style.display = 'block';
                    const iconTambahan = this.querySelector('i');
                    if (iconTambahan) iconTambahan.className = 'fas fa-minus';
                } else {
                    answerElementTambahan.style.display = 'none';
                    const iconTambahan = this.querySelector('i');
                    if (iconTambahan) iconTambahan.className = 'fas fa-plus';
                }
            });
        });
    });

</script>

<?= $this->endSection('content') ?>