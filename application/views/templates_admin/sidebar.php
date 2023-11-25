<?php
date_default_timezone_set('Asia/Jakarta');
$cek    = $user;
$nama   = $cek->nama_lengkap;
$foto   = $cek->foto;
$email  = '';
$level  = 'Calon Asesi';
$menu     = strtolower($this->uri->segment(1));
$sub_menu = strtolower($this->uri->segment(2));
$sub_menu3 = strtolower($this->uri->segment(3));
?>

<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
          </ul>
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
              <img alt="image" src="img/asesor/<?= $foto ?>" class="rounded-circle mr-1">
              <div class="d-sm-none d-lg-inline-block">Hi, <?= $nama ?></div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <a href="<?= base_url('panel_admin/profile'); ?>" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Profil
              </a>
              <div class="dropdown-divider"></div>
              <a href="<?= base_url('panel_admin/logout'); ?>" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Keluar
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="<?php echo base_url('panel_admin') ?>">AJJ Lalinsa</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="<?php echo base_url('panel_admin') ?>">AJJ</a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Utama</li>
            <li class="beranda"><a class="nav-link" href="<?php echo base_url('panel_admin') ?>"><i class="fas fa-home"></i> <span>Beranda</span></a></li>
            <li class="verifikasi"><a class="nav-link" href="<?php echo base_url('panel_admin/verifikasi') ?>"><i class="fas fa-user-check"></i> <span>Verifikasi</span></a></li>
            <li class="kelulusan"><a class="nav-link" href="<?php echo base_url('panel_admin/set_pengumuman') ?>"><i class="fas fa-user-graduate"></i> <span>Hasil Pendaftaran</span></a></li>
            <li><a class="nav-link" href="<?php echo base_url('panel_admin/kirim_pesan') ?>"><i class="fas fa-envelope"></i> <span>Kirim Pesan</span></a></li>

            <li><a class="nav-link" href="<?php echo base_url('panel_admin/jadwalevent') ?>"><i class="fas fa-calendar"></i> <span>Jadwal Kegiatan</span></a></li>

            <li class="menu-header">Data Master</li>
            <li><a class="nav-link" href="<?php echo base_url('panel_admin/data_siswa') ?>"><i class="fas fa-users"></i> <span>Data Siswa</span></a></li>
            <!-- <li><a class="nav-link" href="<?php echo base_url('panel_admin/data_asesor') ?>"><i class="fas fa-chalkboard-teacher"></i> <span>Data Asesor</span></a></li> -->
            <li><a class="nav-link" href="<?php echo base_url('panel_admin/data_pesan') ?>"><i class="fas fa-envelope-open-text"></i> <span>Data Pesan</span></a></li>
            <!-- <li><a class="nav-link" href="<?php echo base_url('panel_admin/form_asessement') ?>"><i class="fas fa-list"></i> <span>Form Asessement</span></a></li> -->
            <li><a class="nav-link" href="<?php echo base_url('panel_admin/ruang_asesi') ?>"><i class="fas fa-chalkboard"></i> <span>Ruang Asesi</span></a></li>
            <li><a class="nav-link" href="<?php echo base_url('panel_admin/tingkatan') ?>"><i class="fas fa-bookmark"></i> <span>Tingkatan</span></a></li>
            <li><a class="nav-link" href="<?php echo base_url('/smptq/manage/auth/login?location=%2Fci3_lsplalinsa%2Fsmptq%2Fmanage') ?>"><i class="fas fa-bookmark"></i> <span>Data SPP</span></a></li>

            <li class="menu-header">Lainnya</li>
            <li class="nav-item dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-cog"></i><span>Pengaturan</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="<?= base_url('panel_admin/profile'); ?>">Profil</a></li>
                <li><a class="nav-link" href="<?= base_url('panel_admin/ubah_pass'); ?>">Ubah Password</a></li>
              </ul>
            </li>
            <li><a class="nav-link" href="<?= base_url('panel_admin/logout'); ?>"><i class="fas fa-sign-out-alt text-danger"></i> <span class="text-danger">Keluar</span></a></li>
          </ul>
          <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <button class="btn btn-primary btn-lg btn-block btn-icon-split" id="modal-1">
              <i class="fas fa-rocket"></i> Versi
            </button>
          </div>


        </aside>
      </div>