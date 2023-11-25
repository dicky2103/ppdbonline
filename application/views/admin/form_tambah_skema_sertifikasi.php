<?php
 $now = date_create('now')->format('Y-m-d H:i:s');
 $tgl=date('d-m-Y H:i:s');
 ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Data Skema Sertifikasi</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="panel_admin">Beranda</a></div>
                <div class="breadcrumb-item active"><a href="panel_admin/skema_sertifikasi">Data Skema Sertifikasi</a></div>
                <div class="breadcrumb-item">Form Tambah Skema Sertifikasi</div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <form method="POST" action="<?php echo base_url('panel_admin/tambah_skema_sertifikasi_aksi') ?>" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Kode</label>
                                <input type="text" name="kode_skema_sertifikasi" class="form-control" required>
                                <?php echo form_error('kode_skema_sertifikasi', '<div class="text-small text-danger">', '</div>') ?>
                            </div>
                            <div class="form-group">
                                <label>Jenis</label>
                                <input type="text" name="jenis_skema_sertifikasi" class="form-control" required>
                                <?php echo form_error('jenis_skema_sertifikasi', '<div class="text-small text-danger">', '</div>') ?>
                            </div>

                            <div class="form-group">
                                <label>Nama Skema Sertifikasi</label>
                                <input type="text" name="nama_skema_sertifikasi" class="form-control" required>
                                <?php echo form_error('nama_skema_sertifikasi', '<div class="text-small text-danger">', '</div>') ?>
                            </div>

                            <div class="form-group">
                                <label>APL 01</label>
                                <input type="file" name="apl01" class="form-control" required>
                                <?php echo form_error('apl', '<div class="text-small text-danger">', '</div>') ?>
                            </div>

                            <div class="form-group">
                                <label>APL 02</label>
                                <input type="file" name="apl02" class="form-control" required>
                                <?php echo form_error('apl02', '<div class="text-small text-danger">', '</div>') ?>
                            </div>

                            <div class="form-group">
                                <label>Materi</label>
                                <input type="file" name="materi" class="form-control" required>
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