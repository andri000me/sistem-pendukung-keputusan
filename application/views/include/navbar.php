<?php
$role = $this->session->userdata('role');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>SPK Prioritas Undangan</title>
  <meta content="" name="descriptison">
  <meta content="" name="keywords">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Montserrat:300,400,500,600,700" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?= base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- <link href="<?= base_url(); ?>assets/vendor/animate.css/animate.min.css" rel="stylesheet"> -->
  <link href="<?= base_url(); ?>assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- <link href="<?= base_url(); ?>assets/vendor/ionicons/css/ionicons.min.css" rel="stylesheet"> -->
  <!-- <link href="<?= base_url(); ?>assets/vendor/venobox/venobox.css" rel="stylesheet"> -->
  <!-- <link href="<?= base_url(); ?>assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet"> -->


  <!-- Template Main CSS File -->
  <link href="<?= base_url(); ?>assets/css/style.css" rel="stylesheet">
  <script src="<?= base_url() ?>assets/vendor/jquery/jquery-3.4.1.js"></script>
  <script src="<?= base_url() ?>assets/vendor/sweetalert/sweetalert.min.js"></script>
</head>

<body>

  <!-- ======= Header ======= -->
  <nav class="navbar">
    <header id="header">
      <div class="container">

        <div class="logo float-left">
          <!-- Uncomment below if you prefer to use an image logo -->
          <h1 class="text-light"><a href="<?= base_url('auth/beranda') ?>"><span><strong>SPK</strong> </span></a></h1>
          <!-- <a href="#header" class="scrollto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a> -->
        </div>

        <nav class="main-nav float-right d-none d-lg-block">
          <ul>
            <?php if ($role == 'admin') { ?>
              <li><a href="<?= base_url('auth/beranda') ?>">Home</a></li>
              <li><a href="<?= base_url('kriteria') ?>">Kriteria</a></li>
              <li><a href="<?= base_url('alternatif') ?>">Alternatif</a></li>
              <li><a href="<?= base_url('rangking') ?>">Rangking</a></li>
              <li><a href="<?= base_url('admin/list_user') ?>">User</a></li>
            <?php } elseif ($role == 'user') { ?>
              <li><a href="<?= base_url('auth/beranda') ?>">Home</a></li>
              <li><a href="<?= base_url('alternatif') ?>">Alternatif</a></li>
              <li><a href="<?= base_url('rangking') ?>">Rangking</a></li>

            <?php } ?>

            <li class="drop-down">
              <a href=""><img class="img-profile rounded-circle" src="<?= base_url('/assets/img/user.png') ?>" height="25px" weight="25px"> <?= $this->session->userdata("username"); ?></a>
              <ul>
                <li><a href="<?= base_url('setting') ?>">Setting</a></li>
                <li><a href="<?= base_url('auth/logout') ?>">Logout</a></li>
              </ul>
            </li>
          </ul>
        </nav><!-- .main-nav -->

      </div>
    </header><!-- #header -->
  </nav>
  <!-- ======= Hero Section ======= -->
  <br><br><br><br>