<?php
 $now = date_create('now')->format('Y-m-d H:i:s');
 $tgl=date('d-m-Y H:i:s');
 ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Data Skema Sertifikasi</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="panel_admin">Beranda</a></div>
                <div class="breadcrumb-item active"><a href="panel_admin/skema_sertifikasi">Data Skema Sertifikasi</a></div>
                <div class="breadcrumb-item">Form Edit Skema Sertifikasi</div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <form method="POST" action="<?php echo base_url('panel_admin/update_skema_sertifikasi_aksi') ?>" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Kode</label>
                                <input type="text" name="kode_skema_sertifikasi" class="form-control" value="<?= $skema_sertifikasi->kode_skema_sertifikasi ?>" required>
                                <?php echo form_error('kode_skema_sertifikasi', '<div class="text-small text-danger">', '</div>') ?>
                                <input type="hidden" name="id_skema_sertifikasi" class="form-control" value="<?= $skema_sertifikasi->id_skema_sertifikasi ?>">
                            </div>
                            <div class="form-group">
                                <label>Jenis</label>
                                <input type="text" name="jenis_skema_sertifikasi" class="form-control" value="<?= $skema_sertifikasi->jenis_skema_sertifikasi ?>" required>
                                <?php echo form_error('jenis_skema_sertifikasi', '<div class="text-small text-danger">', '</div>') ?>
                            </div>

                            <div class="form-group">
                                <label>Nama Skema Sertifikasi</label>
                                <input type="text" name="nama_skema_sertifikasi" class="form-control" value="<?= $skema_sertifikasi->nama_skema_sertifikasi ?>" required>
                                <?php echo form_error('nama_skema_sertifikasi', '<div class="text-small text-danger">', '</div>') ?>
                            </div>

                            <div class="form-group">
                                <label>APL 01</label>
                                <br><a href="<?= base_url() ?>assets/upload/skema/<?= $skema_sertifikasi->apl01 ?>" target="_blank">Download</a>
                                <input type="file" name="apl01" class="form-control">
                                <?php echo form_error('apl', '<div class="text-small text-danger">', '</div>') ?>
                            </div>

                            <div class="form-group">
                                <label>APL 02</label>
                                <br><a href="<?= base_url() ?>assets/upload/skema/<?= $skema_sertifikasi->apl02 ?>" target="_blank">Download</a>
                                <input type="file" name="apl02" class="form-control">
                                <?php echo form_error('apl02', '<div class="text-small text-danger">', '</div>') ?>
                            </div>

                            <div class="form-group">
                                <label>Materi</label>
                                <br><a href="<?= base_url() ?>assets/upload/skema/<?= $skema_sertifikasi->materi ?>" target="_blank">Download</a>
                                <input type="file" name="materi" class="form-control">
                                <?php echo form_error('materi', '<div class="text-small text-danger">', '</div>') ?>
                            </div>

                            <button type="submit" class="btn btn-primary ">Simpan</button>
                            <button type="reset" class="btn btn-danger "> reset</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>