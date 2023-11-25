<?php
$cek    = $user;
$id_asesor = $cek->id_user;
?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Ubah Data Asesi</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="panel_admin">Beranda</a></div>
                <div class="breadcrumb-item active"><a href="panel_admin/data_asesi">Data Asesi</a></div>
                <div class="breadcrumb-item">Form Ubah Asesi</div>
            </div>
        </div>

        <form action="<?php echo base_url('panel_admin/update_asesi_aksi') ?>" method="post">
            <input type="hidden" name="id_siswa" value="<?= $detail->id_siswa ?>">
            <div class="row">
                <div class="col-md-12">
                    <div class="card" style="width: 100%;">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <th>Serifikasi</th>
                                        <th>:</th>
                                        <td>
                                            <select name="id_skema_sertifikasi" id="id_skema_sertifikasi" class="form-control">
                                                <option value="">--- Pilih Sertifikasi ---</option>
                                                <?php foreach ($sertifikasi as $s) : ?>
                                                    <option <?= $s->id_skema_sertifikasi === $detail->id_skema_sertifikasi ? 'selected' : '' ?> value="<?= $s->id_skema_sertifikasi ?>"><?= $s->nama_skema_sertifikasi ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <?= form_error('id_skema_sertifikasi', '<span class="text-danger">', '</span>') ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th width="20%">NO. PENDAFTARAN</th>
                                        <th width="1%">:</th>
                                        <td>
                                            <input class="form-control" type="text" name="no_pendaftaran" value="<?= set_value('no_pendaftaran', $detail->no_pendaftaran) ?>">
                                            <?= form_error('no_pendaftaran', '<span class="text-danger">', '</span>') ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>NIK</th>
                                        <th>:</th>
                                        <td>
                                            <input class="form-control" type="text" name="nik" value="<?= set_value('nik', $detail->nik) ?>">
                                            <?= form_error('nik', '<span class="text-danger">', '</span>') ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Nama Lengkap</th>
                                        <th>:</th>
                                        <td>
                                            <input class="form-control" type="text" name="nama_lengkap" value="<?= set_value('nama_lengkap', $detail->nama_lengkap) ?>">
                                            <?= form_error('nama_lengkap', '<span class="text-danger">', '</span>') ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>No. Handphone</th>
                                        <th>:</th>
                                        <td>
                                            <input class="form-control" type="text" name="no_hp_siswa" value="<?= set_value('no_hp_siswa', $detail->no_hp_siswa) ?>">
                                            <?= form_error('no_hp_siswa', '<span class="text-danger">', '</span>') ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <i class="icon-library2"></i>
                            <h5>Data Pekerjaan</h5>
                            <hr><br>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <th width="20%">Nama Perusahaan</th>
                                        <th width="1%">:</th>
                                        <td>
                                            <input class="form-control" type="text" name="nama_perusahaan" value="<?= set_value('nama_perusahaan', $detail->nama_perusahaan) ?>">
                                            <?= form_error('nama_perusahaan', '<span class="text-danger">', '</span>') ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Jabatan</th>
                                        <th>:</th>
                                        <td>
                                            <input class="form-control" type="text" name="jabatan" value="<?= set_value('jabatan', $detail->jabatan) ?>">
                                            <?= form_error('jabatan', '<span class="text-danger">', '</span>') ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="<?= base_url() ?>/panel_admin/data_asesi" class="btn btn-danger">Batal</a>
        </form>
    </section>
</div>