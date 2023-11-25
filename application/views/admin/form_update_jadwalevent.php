<?php 
$cek    = $user;
$id_user = $cek->id_user;
?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Ubah Data Jadwal Event</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="panel_admin">Beranda</a></div>
                <div class="breadcrumb-item active"><a href="panel_admin/data_jadwalevent">Data Jadwal Event</a></div>
                <div class="breadcrumb-item">Form Ubah Jadwal Event</div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
            <?php foreach ($jadwalevent as $as) : ?>
                <form action="<?php echo base_url('panel_admin/update_jadwalevent_aksi') ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Tanggal Kegiatan</label>
                    <input type="date" name="tgl_jadwalevent" class="form-control" value="<?= $as->tgl_jadwalevent?>">
                    <?php echo form_error('tgl_jadwalevent', '<div class="text-small text-danger">', '</div>') ?>
                </div>
                <div class="form-group">
                    <label>Nama Kegiatan</label>
                    <input type="hidden" name="id_jadwalevent" class="form-control" value="<?= $as->id_jadwalevent?>">
                    <input type="text" name="nama_jadwalevent" class="form-control" value="<?= $as->nama_jadwalevent?>">
                    <?php echo form_error('nama_jadwalevent', '<div class="text-small text-danger">', '</div>') ?>
                </div>
                <!-- <div class="form-group">
                    <label>Asesor</label> <br>
                    <select name="id_asesor" id="id_asesor" class="custom-select">
                        <option value="">--Pilih Asesor--</option>
                        <?php foreach($asesor as $row){ ?>
                            <option value="<?= $row->id_user ?>" <?php if($row->id_user == $as->id_asesor) echo"selected"; ?>><?= $row->nama_lengkap ?></option>
                        <?php } ?>
                    </select>
                    <?php echo form_error('id_asesor', '<div class="text-small text-danger">', '</div>') ?>
                </div> -->

                <div class="form-group">
                    <label>Siswa</label> <br>
                    <select name="id_asesi" id="id_asesi" class="custom-select">
                        <option value="">--Pilih Siswa--</option>
                        <?php foreach($asesi as $row){ ?>
                            <option value="<?= $row->id_siswa ?>" <?php if($row->id_siswa == $as->id_asesi) echo"selected"; ?>><?= $row->nama_lengkap ?></option>
                        <?php } ?>
                    </select>
                    <?php echo form_error('id_asesi', '<div class="text-small text-danger">', '</div>') ?>
                </div>

                <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                <button type="reset" class="btn btn-sm btn-danger">Reset</button>
        <?php endforeach; ?>
            </div>
        </div>
    </section>
</div>