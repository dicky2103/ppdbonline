<?php
date_default_timezone_set('Asia/Jakarta');
$cek    = $user;
$nama   = $cek->nama_lengkap;
$email  = '';
$level  = 'Calon Siswa';
$menu 		= strtolower($this->uri->segment(1));
$sub_menu = strtolower($this->uri->segment(2));
$sub_menu3 = strtolower($this->uri->segment(3));
error_reporting(0);
$user = $user; 
?>
    <div class="main-content">
        <section class="section">
            <section class="section-header">
                <h1>Biodata Siswa</h1>
            </section>

            <form method="POST" action="<?php echo base_url('panel_admin/update_downloadupload_aksi') ?>" enctype="multipart/form-data" class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Tingkatan</label> <br>
                                <select name="id_skema_sertifikasi" id="id_skema_sertifikasi" class="custom-select" required>
                                    <?php foreach($skema as $row){ ?>
                                        <option value="<?= $row->id_skema_sertifikasi ?> "<?php if($row->id_skema_sertifikasi == $detail->id_skema_sertifikasi){echo("selected");}?>><?= $row->nama_skema_sertifikasi ?></option>
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
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                <tr>
                                    <input type="hidden" name="id_siswa" value="<?= $detail->id_siswa ?>" >

                                    <th width="20%">Ijazah</th>
                                    <th width="50%">: 
                                        <?php if($detail->ijasah !== ''){ ?>
                                            <a href="<?= base_url() ?>assets/upload/<?= $detail->ijasah ?>" target="_blank">Lihat</a>
                                        <?php } ?>
                                    </th>
                                    
                                </tr>
                                <tr>
                                    <th width="20%">Akte Kelahiran</th>
                                    <th width="50%">: 
                                        <?php if($detail->sertifikat !== ''){ ?>
                                            <a href="<?= base_url() ?>assets/upload/<?= $detail->sertifikat ?>" target="_blank">Download</a>
                                        <?php } ?>
                                    </th>
                                </tr>
                                <tr>
                                    <th width="20%">NISN</th>
                                    <th width="50%">: 
                                        <?php if($detail->cv !== ''){ ?>
                                            <a href="<?= base_url() ?>assets/upload/<?= $detail->cv ?>" target="_blank">Download</a>
                                        <?php } ?>
                                    </th>
                                </tr>
                                <tr>
                                    <th width="20%">Kartu Keluarga</th>
                                    <th width="50%">: 
                                        <?php if($detail->jobdesk !== ''){ ?>
                                            <a href="<?= base_url() ?>assets/upload/<?= $detail->jobdesk ?>" target="_blank">Lihat</a>
                                        <?php } ?>
                                    </th>
                                </tr>
                                <tr>
                                    <th width="20%">Surat Keterangan Lulus</th>
                                    <th width="50%">: 
                                        <?php if($detail->rekomendasi !== ''){ ?>
                                            <a href="<?= base_url() ?>assets/upload/<?= $detail->rekomendasi ?>" target="_blank">Lihat</a>
                                        <?php } ?>
                                    </th>
                                </tr>
                                <!-- <tr>
                                    <th width="20%">Laporan Kerja</th>
                                    <th width="50%">: 
                                        <?php if($detail->laporankerja !== ''){ ?>
                                            <a href="<?= base_url() ?>assets/upload/<?= $detail->laporankerja ?>" target="_blank">Lihat</a>
                                        <?php } ?>
                                    </th>
                                </tr> -->
                                <tr>
                                    <th width="20%">Bukti Pembayaran</th>
                                    <th width="50%">: 
                                        <?php if($detail->ktp !== ''){ ?>
                                            <a href="<?= base_url() ?>assets/upload/<?= $detail->ktp ?>" target="_blank">Lihat</a>
                                        <?php } ?>
                                    </th>
                                </tr>
                                <tr>
                                    <th width="20%">Foto</th>
                                    <th width="50%">: 
                                        <?php if($detail->foto !== ''){ ?>
                                            <a href="<?= base_url() ?>assets/upload/<?= $detail->foto ?>" target="_blank">Lihat</a>
                                        <?php } ?>
                                    </th>
                                </tr>
                                <!-- <tr>
                                    <th width="20%">Surat Pernyataan</th>
                                    <th width="50%">: 
                                        <?php if($detail->suratpernyataan !== ''){ ?>
                                            <a href="<?= base_url() ?>assets/upload/<?= $detail->suratpernyataan ?>" target="_blank">Lihat</a>
                                        <?php } ?>
                                    </th>
                                </tr>
                                <tr>
                                    <th width="20%">APL 01</th>
                                    <th width="50%">: 
                                        <?php if($detail->apl01 !== ''){ ?>
                                            <a href="<?= base_url() ?>assets/upload/<?= $detail->apl01 ?>" target="_blank">Lihat</a>
                                        <?php } ?>
                                    </th>
                                </tr>
                                <tr>
                                    <th width="20%">APL 02</th>
                                    <th width="50%">: 
                                        <?php if($detail->apl02 !== ''){ ?>
                                            <a href="<?= base_url() ?>assets/upload/persyaratan/<?= $detail->apl01 ?>" target="_blank">Lihat</a>
                                        <?php } ?>
                                    </th>
                                </tr> -->
                                <!-- <tr>
                                    <th width="20%">Materi</th>
                                    <th width="50%">: 
                                        <?php if($detail->materi !== ''){ ?>
                                            <a href="<?= base_url() ?>assets/upload/persyaratan/<?= $detail->materi ?>" target="_blank">Download</a>
                                        <?php } ?>
                                    </th>
                                </tr>

                                <tr>
                                    <th width="20%">Upload Sertifikasi</th>
                                    <th width="50%"><input type="file" name="hasil_sertifikat" class="form-control">
                                    <?php if($detail->status_verifikasi == 2 and $detail->status_pendaftaran == 1 and $detail->hasil_sertifikat !== ''){ ?>
                                        <a href="<?= base_url() ?>assets/upload/persyaratan/<?= $detail->hasil_sertifikat ?>" target="_blank">Download</a>
                                    <?php } ?>
                                    <?php echo form_error('hasil_sertifikat', '<div class="text-small text-danger">', '</div>') ?></th>
                                    <td></td>
                                </tr> -->

                                </table>

                                <?php if($detail->status_verifikasi == 2 and $detail->status_pendaftaran == 1){ ?>
                                    <button type="submit" class="btn btn-primary ">Upload Sertifikat</button>
                                    <button type="reset" class="btn btn-danger "> reset</button>
                                <?php } ?>

                            </div>
                        </div>
                    </div>
                </div>
            </form>
                

        </section>
    </div>
