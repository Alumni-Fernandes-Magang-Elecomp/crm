<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>AFR - Alumni Fernandes Raymond</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="<?= base_url('assets-baru') ?>/img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <!--<link href="<?= base_url('assets-baru') ?>/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">-->

    <!-- Customized Bootstrap Stylesheet -->

    <link href="<?= base_url('assets-baru') ?>plugins/fontawesome/js/all.min.js" rel="stylesheet">
    <link href="<?= base_url('assets-baru') ?>/css/style.css" rel="stylesheet">
    <link href="<?= base_url('assets-baru') ?>/css/datatables-custom.css" rel="stylesheet">

    <script src="https://unpkg.com/lazysizes@5.3.2/lazysizes.js"></script>
</head>

<body>
    <!-- Topbar Start -->
    <?= $this->include('user/layout/header'); ?>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <?= $this->include('user/layout/nav'); ?>
    <!-- Navbar End -->



    <?= $this->renderSection('content'); ?>

    <!-- Javascript -->
    <script src="<?= base_url('assets-baru') ?>/plugins/popper.min.js"></script>
    <script src="<?= base_url('assets-baru') ?>/plugins/bootstrap/js/bootstrap.min.js"></script>

    <!-- Page Specific JS -->
    <script src="<?= base_url('assets-baru') ?>/js/app.js"></script>

    <!-- Main News Slider Start -->

    <!-- Main News Slider End -->


    <!-- Breaking News Start -->

    <!-- Breaking News End -->


    <!-- Featured News Slider Start -->

    <!-- Featured News Slider End -->


    <!-- News With Sidebar Start -->

    <!-- News With Sidebar End -->


    <!-- Footer Start -->
    <?= $this->include('user/layout/footer');  ?>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary btn-square back-to-top"><i class="fa fa-arrow-up"></i></a>

    <!-- Javascript -->
    <script src="<?= base_url('assets2/plugins/popper.min.js') ?>"></script>
    <script src="<?= base_url('assets2/plugins/bootstrap/js/bootstrap.min.js') ?>"></script>

    <!-- Page Specific JS -->
    <script src="<?= base_url('assets2/js/app.js') ?>"></script>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <!--<script src="<?= base_url('assets-baru') ?>/lib/easing/easing.min.js"></script>-->
    <!--<script src="<?= base_url('assets-baru') ?>/lib/owlcarousel/owl.carousel.min.js"></script>-->
    <script src="<?= base_url('assets/js/tinymce.min.js') ?>"></script>
    <script>
        tinymce.init({
            selector: 'textarea.tiny',
            plugins: 'powerpaste advcode table lists checklist link image media',
            toolbar: 'undo redo | blocks | bold italic | bullist numlist checklist | code | table | link image media'
        });
    </script>

    <script>
        new DataTable('#example', {
            scrollX: true,
            scrollY: true
        });
        // $(document).ready(function() {
        //     $('#example').dataTable({
        //         "sScrollY": "500px",
        //         "bPaginate": true,
        //         "bScrollCollapse": false
        //     });
        // });
    </script>


    <!-- Template Javascript -->
    <!--<script src="<?= base_url('assets-baru') ?>/js/main.js"></script>-->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Menandai tautan aktif dengan kelas "show"
            const activeLink = document.querySelector(".nav-link.active");
            if (activeLink) {
                activeLink.classList.add("show");
            }
        });
    </script>
</body>

</html>