<?php
defined('BASEPATH') or exit('No direct script access allowed');
$user = $this->db->get('tbl_user')->row_array();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="description" content="admin-themes-lab">
  <meta name="author" content="themes-lab">
  <base href="<?php echo base_url(); ?>" />
  <title>AJJ | <?php echo $user['nama_lengkap']; ?></title>
  <link rel="icon" href="<?= base_url('assets/dist/img/Logo-LSP.png') ?>">
  <link href="assets/kitkat/assets/css/style.css" rel="stylesheet">
  <link href="assets/kitkat/assets/css/theme.css" rel="stylesheet">
  <link href="assets/kitkat/assets/css/ui.css" rel="stylesheet">
  <link href="assets/kitkat/assets/css/custom.css" rel="stylesheet">
  <link href="assets/kitkat/assets/plugins/font-awesome-animation/font-awesome-animation.min.css" rel="stylesheet">
  <link href="assets/kitkat/assets/input/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />

  <!-- BEGIN PAGE STYLE -->
  <link href="assets/kitkat/assets/plugins/step-form-wizard/css/step-form-wizard.min.css" rel="stylesheet">
  <!-- END PAGE STYLE -->
  <script src="assets/kitkat/assets/plugins/modernizr/modernizr-2.6.2-respond-1.1.0.min.js"></script>
</head>

<body class="sidebar-hover theme-sltl color-green">
  <div class="main-content">
    <div class="page-content">
      <div class="header" style=" text-align: center;">
        <img src="img/Logo-LSP.png" style="margin-bottom:10px;" width="100"><br>
        <h2 align="center">FORM PENDAFTARAN <strong> <br><?php echo $user['nama_lengkap']; ?></strong></h2>
        <hr style="margin-top:20px;">
      </div>
      <div class="container">
        <div class="row" style="margin-top:-30px;">
          <div class="col-lg-4"></div>
          <div class="col-lg-4">
            <div class="panel">
              <div class="panel-heading" style="background: #6777EF; color: honeydew;">
                <h3 align="center" style="margin-top: 10px;">
                  <b>PENDAFTARAN BERHASIL !!</b>
                </h3>
              </div>
              <div class="panel-body">
                <p class="text-center">
                  <b>Silahkan Cek E-Mail Anda !</b>
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-4"></div>
          <div class="col-lg-12">
            <div class="text-center" style="margin-top: 30px">
              <a href="<?= base_url() ?>" style="line-height: 50px;padding: 16px 30px;border-radius: 3px;border: none;color: #FFF;text-decoration: none;background: #2B2E33;position: relative;">
                BERANDA
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
</body>

</html>