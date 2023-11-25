<?php
 $now = date_create('now')->format('Y-m-d H:i:s');
 $tgl=date('d-m-Y H:i:s');
 ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Jadwal Kegiatan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="panel_admin">Beranda</a></div>
                <!-- <div class="breadcrumb-item active"><a href="panel_admin/data_asesor">Data Asesor</a></div> -->
                <div class="breadcrumb-item">Jadwal Kegiatan</div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <form method="POST" action="<?php echo base_url('panel_admin/tambah_jadwalevent_aksi') ?>" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Tanggal Kegiatan</label>
                                <input type="date" name="tgl_jadwalevent" class="form-control" required>
                                <?php echo form_error('tgl_jadwalevent', '<div class="text-small text-danger">', '</div>') ?>
                            </div>
                            <div class="form-group">
                                <label>Nama Kegiatan</label>
                                <input type="text" name="nama_jadwalevent" class="form-control">
                                <?php echo form_error('nama_jadwalevent', '<div class="text-small text-danger">', '</div>') ?>
                            </div>

                            <!-- <div class="form-group">
                                <label>Asesor</label> <br>
                                <select name="id_asesor" id="id_asesor" class="custom-select">
                                    <option value="">--Pilih Asesor--</option>
                                    <?php foreach($asesor as $row){ ?>
                                        <option value="<?= $row->id_user ?>"><?= $row->nama_lengkap ?></option>
                                    <?php } ?>
                                </select>
                                <?php echo form_error('id_asesor', '<div class="text-small text-danger">', '</div>') ?>
                            </div> -->

                            <div class="form-group">
                                <label>Siswa</label> <br>
                                <select name="id_asesi" id="id_asesi" class="custom-select">
                                    <option value="">--Pilih Siswa--</option>
                                    <?php foreach($asesi as $row){ ?>
                                        <option value="<?= $row->id_siswa ?>"><?= $row->nama_lengkap ?></option>
                                    <?php } ?>
                                </select>
                                <?php echo form_error('id_asesi', '<div class="text-small text-danger">', '</div>') ?>
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