<?php
date_default_timezone_set('Asia/Jakarta');
$cek    = $user;
$nama   = $cek->nama_lengkap;
$email  = '';
$level  = 'Calon Siswa';
$menu         = strtolower($this->uri->segment(1));
$sub_menu = strtolower($this->uri->segment(2));
$sub_menu3 = strtolower($this->uri->segment(3));
error_reporting(0);
$user = $user;
?>
<div class="main-content">
    <section class="section">
        <section class="section-header">
            <h1>Upload Berkas Siswa</h1>
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

        <form method="POST" action="<?php echo base_url('panel_siswa/update_downloadupload_aksi') ?>" enctype="multipart/form-data" class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Tujuan Pendaftaran</label> <br>
                            <select name="tujuan_asessment" id="tujuan_asessment" class="custom-select" required>
                                <option value="">--Pilih Tujuan--</option>
                                <option value="Sertifikasi" <?php if ($user->tujuan_asessment == 'Sertifikasi') echo ("selected"); ?>>
                                    Daftar Siswa/Siswi Baru
                                </option>
                                <option value="Sertifikasi Ulang" <?php if ($user->tujuan_asessment == 'Sertifikasi Ulang') {
                                                                        echo ("selected");
                                                                    } ?>>Daftar Siswa/Siswi Pindahan</option>

                            </select>
                        </div>

                        <div class="form-group">
                            <label>Tingkatan Sekolah</label> <br>
                            <select name="id_skema_sertifikasi" id="id_skema_sertifikasi" class="custom-select" required>
                                <option value="">--Pilih Tingkatan--</option>
                                <?php foreach ($skema as $row) { ?>
                                    <option value="<?= $row->id_skema_sertifikasi ?> " <?php if ($row->id_skema_sertifikasi == $user->id_skema_sertifikasi) {
                                                                                            echo ("selected");
                                                                                        } ?>><?= $row->nama_skema_sertifikasi ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div id="getskema">

                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card" style="width: 100%;">
                    <div class="card-body">
                        <h5 class="card-title">Upload Lampiran</h5>
                        <p class="text-muted">Max. 2 MB</p>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th width="20%">Ijazah</th>
                                    <th width="50%"><input type="file" name="ijasah" class="form-control">
                                        <?php if ($user->ijasah !== '') { ?>
                                            <a href="<?= base_url() ?>assets/upload/persyaratan/<?= $user->ijasah ?>" target="_blank">Download</a>
                                        <?php } ?>
                                        <?php echo form_error('ijasah', '<div class="text-small text-danger">', '</div>') ?>
                                    </th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th width="20%">Akte Kelahiran</th>
                                    <th width="50%"><input type="file" name="sertifikat" class="form-control">
                                        <?php if ($user->sertifikat !== '') { ?>
                                            <a href="<?= base_url() ?>assets/upload/persyaratan/<?= $user->sertifikat ?>" target="_blank">Download</a>
                                        <?php } ?>
                                        <?php echo form_error('sertifikat', '<div class="text-small text-danger">', '</div>') ?>
                                    </th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th width="20%">NISN</th>
                                    <th width="50%"><input type="file" name="cv" class="form-control">
                                        <?php if ($user->cv !== '') { ?>
                                            <a href="<?= base_url() ?>assets/upload/persyaratan/<?= $user->cv ?>" target="_blank">Download</a>
                                        <?php } ?>
                                        <?php echo form_error('cv', '<div class="text-small text-danger">', '</div>') ?>
                                    </th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th width="20%">Kartu Keluarga</th>
                                    <th width="50%"><input type="file" name="jobdesk" class="form-control">
                                        <?php if ($user->jobdesk !== '') { ?>
                                            <a href="<?= base_url() ?>assets/upload/persyaratan/<?= $user->jobdesk ?>" target="_blank">Download</a>
                                        <?php } ?>
                                        <?php echo form_error('jobdesk', '<div class="text-small text-danger">', '</div>') ?>
                                    </th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th width="20%">Surat Keterangan Lulus </th>
                                    <th width="50%"><input type="file" name="rekomendasi" class="form-control">
                                        <?php if ($user->rekomendasi !== '') { ?>
                                            <a href="<?= base_url() ?>assets/upload/persyaratan/<?= $user->rekomendasi ?>" target="_blank">Download</a>
                                        <?php } ?>
                                        <?php echo form_error('rekomendasi', '<div class="text-small text-danger">', '</div>') ?>
                                    </th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th width="20%">Bukti Pembayaran</th>
                                    <th width="50%"><input type="file" name="laporankerja" class="form-control">
                                        <?php if ($user->laporankerja !== '') { ?>
                                            <a href="<?= base_url() ?>assets/upload/persyaratan/<?= $user->laporankerja ?>" target="_blank">Download</a>
                                        <?php } ?>
                                        <?php echo form_error('laporankerja', '<div class="text-small text-danger">', '</div>') ?>
                                    </th>
                                    <td></td>
                                </tr>
                                <!-- <tr>
                                    <th width="20%">KTP</th>
                                    <th width="50%"><input type="file" name="ktp" class="form-control">
                                        <?php if ($user->ktp !== '') { ?>
                                            <a href="<?= base_url() ?>assets/upload/persyaratan/<?= $user->ktp ?>" target="_blank">Download</a>
                                        <?php } ?>
                                        <?php echo form_error('ktp', '<div class="text-small text-danger">', '</div>') ?>
                                    </th>
                                    <td></td>
                                </tr> -->
                                <tr>
                                    <th width="20%">
                                        Foto
                                        <p class="text-muted">
                                            jpg/jpeg/png/jfif
                                        </p>
                                    </th>
                                    <th width="50%"><input type="file" name="foto" class="form-control">
                                        <?php if ($user->foto !== '') { ?>
                                            <a href="<?= base_url() ?>assets/upload/persyaratan/<?= $user->foto ?>" target="_blank">Download</a>
                                        <?php } ?>
                                        <?php echo form_error('foto', '<div class="text-small text-danger">', '</div>') ?>
                                    </th>
                                    <td></td>
                                </tr>
                                <!-- <tr>
                                    <th width="20%">Surat Pernyataan</th>
                                    <th width="50%"><input type="file" name="suratpernyataan" class="form-control">
                                        <?php if ($user->suratpernyataan !== '') { ?>
                                            <a href="<?= base_url() ?>assets/upload/persyaratan/<?= $user->suratpernyataan ?>" target="_blank">Download</a>
                                        <?php } ?>
                                        <?php echo form_error('suratpernyataan', '<div class="text-small text-danger">', '</div>') ?>
                                    </th>
                                    <td></td>
                                </tr> -->
                                <!-- <tr>
                                    <th width="20%">APL 01</th>
                                    <th width="50%"><input type="file" name="apl01" class="form-control">
                                        <?php if ($user->apl01 !== '') { ?>
                                            <a href="<?= base_url() ?>assets/upload/persyaratan/<?= $user->apl01 ?>" target="_blank">Download</a>
                                        <?php } ?>
                                        <?php echo form_error('apl01', '<div class="text-small text-danger">', '</div>') ?>
                                    </th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th width="20%">APL 02</th>
                                    <th width="50%"><input type="file" name="apl02" class="form-control">
                                        <?php if ($user->apl02 !== '') { ?>
                                            <a href="<?= base_url() ?>assets/upload/persyaratan/<?= $user->apl02 ?>" target="_blank">Download</a>
                                        <?php } ?>
                                        <?php echo form_error('apl02', '<div class="text-small text-danger">', '</div>') ?>
                                    </th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th width="20%">Ujian Tertulis</th>
                                    <th width="50%"><input type="file" name="materi" class="form-control">
                                        <?php if ($user->materi !== '') { ?>
                                            <a href="<?= base_url() ?>assets/upload/persyaratan/<?= $user->materi ?>" target="_blank">Download</a>
                                        <?php } ?>
                                        <?php echo form_error('materi', '<div class="text-small text-danger">', '</div>') ?>
                                    </th>
                                    <td></td>
                                </tr> -->
                            </table>

                            <button type="submit" class="btn btn-primary ">Simpan</button>
                            <button type="reset" class="btn btn-danger "> reset</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>


    </section>
</div>