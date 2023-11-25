<?php
date_default_timezone_set('Asia/Jakarta');
$cek    = $user;
$nama   = $cek->nama_lengkap;
$email  = '';
$level  = 'Soal Ujian';
$menu         = strtolower($this->uri->segment(1));
$sub_menu = strtolower($this->uri->segment(2));
$sub_menu3 = strtolower($this->uri->segment(3));
error_reporting(0);
$user = $user;
?>
<div class="main-content">
  <section class="section">
    <section class="section-header">
      <h1>Soal Ujian</h1>
    </section>

    <?php if ($this->session->flashdata('error')) : ?>
      <div class="alert alert-danger text-capitalize">
        <?php print_r($this->session->flashdata('error')); ?>
      </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('success')) : ?>
      <div class="alert alert-success">
        <?= $this->session->flashdata('success'); ?>
      </div>
    <?php endif; ?>
    <div class="card" style="width: 100%;">
      <div class="card-body">
        <p class="text-muted">*) Silahkan Kerjakan Soal pada tabel berikut, klik tombol "KERJAKAN"</p>
        <table class="table table-striped table-bordered w-100">
          <thead>
            <tr>
              <th>No.</th>
              <th>Skema</th>
              <th>Asesor</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            foreach ($item as $row) : ?>
              <tr>
                <td><?= $no++; ?></td>
                <td><?= $row->nama_skema_sertifikasi ?></td>
                <td><?= $row->nama_asesor ?></td>
                <td>
                  <?php if ($row->status_soal) : ?>
                    <a href="#" class="btn btn-success">Sudah Kerjakan</a>
                  <?php else : ?>
                    <a onclick="return confirm('Yakin kerjakan soal?')" href="<?= base_url() ?>/panel_siswa/update_soal/<?= $row->id_siswa ?>" class="btn btn-primary">Kerjakan</a>
                  <?php endif; ?>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>


  </section>
</div>