<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?= $this->renderSection('title') ?></title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?= base_url() ?>assets/img/favicon.png" rel="icon">
  <link href="<?= base_url() ?>assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <link href="<?= base_url() ?>/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= base_url() ?>/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?= base_url() ?>/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <!-- <link href="<?= base_url() ?>/assets/vendor/quill/quill.snow.css" rel="stylesheet"> -->
  <!-- <link href="<?= base_url() ?>/assets/vendor/quill/quill.bubble.css" rel="stylesheet"> -->
  <link href="<?= base_url() ?>/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="<?= base_url() ?>/assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?= base_url() ?>/assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin - v2.4.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">SMAN 1 MALAKA</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="<?= base_url('assets/img/profile/' . user()->user_profile) ?>" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"><?= siswa()->siswa_nama ?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?= siswa()->siswa_nama ?></h6>
              <span><?= strtoupper(session('user')->user_type) ?></span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="<?= base_url('siswa/profil') ?>">
                <i class="bi bi-person"></i>
                <span>Profil</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <form action="<?= base_url('auth/logout') ?>" method="POST">
                <button class="dropdown-item d-flex align-items-center" type="submit">
                  <i class="bi bi-box-arrow-right"></i>
                  <span>Sign Out</span>
                </button>
              </form>

            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="<?= base_url('admin') ?>">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <!-- Menu Collapse -->
      <!-- <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Forms</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="forms-elements.html">
              <i class="bi bi-circle"></i><span>Form Elements</span>
            </a>
          </li>
          <li>
            <a href="forms-layouts.html">
              <i class="bi bi-circle"></i><span>Form Layouts</span>
            </a>
          </li>
        </ul>
      </li> -->
      <!-- End Forms Nav -->


      <li class="nav-item">
        <a class="nav-link collapsed" href="<?= base_url('siswa/pengumuman') ?>">
          <i class="bi bi-card-text"></i>
          <span>Pengumuman</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?= base_url('siswa/jadwal') ?>">
          <i class="bi bi-clock"></i>
          <span>Jadwal Pelajaran</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?= base_url('siswa/absensi') ?>">
          <i class="bi bi-clipboard"></i>
          <span>Absensi</span>
        </a>
      </li>


      <li class="nav-heading">Nilai</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?= base_url('siswa/nilai') ?>">
          <i class="bi bi-clipboard"></i>
          <span>Nilai</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?= base_url('siswa/riwayat_nilai') ?>">
          <i class="bi bi-clock-history"></i>
          <span>Riwayat Nilai</span>
        </a>
      </li><!-- End F.A.Q Page Nav -->

    </ul>


  </aside><!-- End Sidebar-->

  <main id="main" class="main">
    <?= $this->renderSection('content'); ?>
  </main><!-- End #main -->

  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- <script src="<?= base_url() ?>/assets/vendor/apexcharts/apexcharts.min.js"></script> -->
  <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
  <?= $this->renderSection('scripts'); ?>
  <script src="<?= base_url() ?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- <script src="<?= base_url() ?>/assets/vendor/chart.js/chart.min.js"></script> -->
  <!-- <script src="<?= base_url() ?>/assets/vendor/echarts/echarts.min.js"></script> -->
  <!-- <script src="<?= base_url() ?>/assets/vendor/quill/quill.min.js"></script> -->
  <script src="<?= base_url() ?>/assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="<?= base_url() ?>/assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="<?= base_url() ?>/assets/vendor/php-email-form/validate.js"></script>


  <!-- Template Main JS File -->
  <script src="<?= base_url() ?>/assets/js/main.js"></script>
  <?= $this->renderSection('scripts'); ?>
</body>

</html>