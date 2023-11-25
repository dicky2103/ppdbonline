<?php
date_default_timezone_set('Asia/Jakarta');
$cek    = $user;
$nama   = $cek->nama_lengkap;
$email  = '';
$level  = 'Calon Asesi';
$menu 		= strtolower($this->uri->segment(1));
$sub_menu = strtolower($this->uri->segment(2));
$sub_menu3 = strtolower($this->uri->segment(3));
?>
    <!-- Main Content -->
    <div class="main-content">
      <section class="section">
        <div class="section-header">
          <h1>Beranda</h1>
        </div>
        <!-- <div class="flash-data" data-flashdata="<?= $this->session->flashdata('msg'); ?>"></div>
        <div class="flash-data-login" data-flashdata="<?= $this->session->flashdata('msglogin'); ?>"></div>
        <div class="row"> -->
        <?php if($cek->hasil_sertifikat !== ""){?>
            <div class="col-12 col-sm-12 col-lg-12 col-md-12">
                <div class="card card-success" id="mycard-dimiss">
                  <div class="card-header">
                    <h4 class="text-success">INFO PENGUMUMAN</h4>
                    <div class="card-header-action">
                      <a data-dismiss="#mycard-dimiss" class="btn btn-icon btn-danger" href="#"><i class="fas fa-times"></i></a>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="alert alert-success" role="alert">
                      <p>Anda telah diterima sebagai Asesi LSP Lalinsa. Selalu cek notifikasi pesan dan email agar mengetahui informasi lebih lanjut mengenai proses asesmen.</p>
                    </div>
                    <a href="<?= base_url() ?>assets/upload/persyaratan/<?= $cek->hasil_sertifikat ?>" class="btn btn-sm btn-success" target="_blank">Download Sertifikat</a>
                  </div>
              </div>
        <?php } else { ?>
            <div class="col-12 col-sm-12 col-lg-12 col-md-12">
                <div class="card card-primary" id="mycard-dimiss">
                  <div class="card-header">
                    <h4 class="text-primary">INFO PENGUMUMAN</h4>
                    <div class="card-header-action">
                      <a data-dismiss="#mycard-dimiss" class="btn btn-icon btn-danger" href="#"><i class="fas fa-times"></i></a>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="alert alert-primary" role="alert">
                      <p>Belum ada pengumuman dari Panitia Pendaftaran Sertifikasi Online LSP Lalinsa</p>
                    </div>
                  </div>
            </div>
        <?php } ?>

        <?php if($cek->apl01 == '' ||  $cek->apl02 == '' || $cek->materi == '') {?>
        <div class="row">
          <div class="col-md-12 col-lg-12 col-sm-12">
              <div class="card">
                <div class="card-body">
                    <p>Kamu belum menyelesaikan pendaftaran, silahkan untuk upload terlebih dahulu.</p>
                    <a href="<?= base_url() ?>panel_siswa/downloadupload" class="btn btn-primary">Upload Berkas</a>
                </div>
              </div>
          </div>
        </div>
        <?php }?>

        <!-- <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
              <div class="card card-primary">
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>TINJAU FORM FR APL 01</h4>
                  </div>
                  <div class="card-body">
                      <a href="panel_siswa/tinjau_formapl1">
                      <div class="bg-primary p-5">
                        <center>
                            <i class="fa fa-user center" style="font-size: 1000%; color:#fff;"></i>
                        </center>
                      </a>
                      </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
              <div class="card card-success">
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>TINJAU FORM FR APL 02</h4>
                  </div>
                  <div class="card-body">
                      <a href="panel_siswa/tinjau_formapl2">
                      <div class="bg-success p-5">
                        <center>
                            <i class="fa fa-user center" style="font-size: 1000%; color:#fff;"></i>
                        </center>
                      </a>
                      </div>
                  </div>
                </div>
              </div>
            </div>
        </div> -->

        <div class="row">
          <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="card card-primary">
              <div class="card-body">
                <a href="panel_siswa/download_informasi" class="btn btn-primary">Download Informasi Akun</a>
              </div>
            </div>
          </div>
        </div>

      </section>
    </div>
    </div>
