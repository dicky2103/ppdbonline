<?php
$cek    = $user;
$jurusan = $cek->jurusan;
?>
<?php if ($jurusan == 'RPL') { ?>
    <div class="main-content">
        <section class="section">
            <section class="section-header">
                <h1>Verifikasi Data Asesi</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="panel_asesor">Beranda</a></div>
                    <div class="breadcrumb-item">Verifikasi Asesi</div>
                </div>
            </section>

            <div class="flash-data" data-flashdata="<?= $this->session->flashdata('msg'); ?>"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body table-responsive">
                            <div class="col-md-3 ml-auto mb-5">
                                <div class="input-group">
                                </div>
                            </div>
                            <table id="example" class="table table-striped table-bordered" width="100%">
                                <thead>
                                    <tr>
                                        <th width="30px;">No.</th>
                                        <th>No. Pendaftaran</th>
                                        <th>Skema Sertifikasi</th>
                                        <th>Tujuan Asessment</th>
                                        <th>NIK</th>
                                        <th>Nama Lengkap</th>
                                        <th>Berkas</th>
                                        <th class="text-center">Status Verifikasi</th>
                                        <th class="text-center" width="180">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($v_siswa as $baris) { ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $baris->no_pendaftaran; ?></td>
                                            <td><?php echo $baris->nama_skema_sertifikasi; ?></td>
                                            <td><?php echo $baris->tujuan_asessment; ?></td>
                                            <td><?php echo $baris->nik; ?></td>
                                            <td><?php echo $baris->nama_lengkap; ?></td>
                                            <td>
                                                <a href="<?php echo base_url('panel_asesor/detail_berkas/') . $baris->id_siswa ?>" class="btn btn-sm btn-success">Lihat Berkas</a>
                                            </td>
                                            <td align="center">
                                                <?php if ($baris->status_verifikasi == 1) { ?>
                                                    <label class="badge badge-danger">Belum di Verifikasi</label>
                                                <?php } else { ?>
                                                    <label class="badge badge-success">Terverifikasi</label>
                                                <?php } ?>

                                                <?php if ($baris->status_verifikasi == 1) { ?>
                                                    <a href="panel_asesor/verifikasi/cek/<?php echo $baris->no_pendaftaran; ?>" class="btn btn-info btn-xs tombol-verifikasi" title="Verifikasi"><i class="fas fa-check"></i></a>
                                                <?php } else { ?>
                                                    <a href="panel_asesor/verifikasi/cek/<?php echo $baris->no_pendaftaran; ?>" class="btn btn-danger btn-xs tombol-batal-verifikasi" title="Batal Verifikasi"><i class="fas fa-times"></i></a>
                                                <?php } ?>

                                            </td>
                                            <td align="center">
                                                <a href="panel_asesor/verifikasi_cetak/<?php echo $baris->no_pendaftaran; ?>" class="btn btn-default btn-xs" title="Cetak Verifikasi" target="_blank"><i class="icon-printer2"></i></a>

                                                <?php if ($baris->status_verifikasi == 2) { ?>
                                                    <a href="panel_asesor/verifikasi/lulus/<?php echo $baris->no_pendaftaran; ?>" class="btn btn-info btn-xs tombol-lulus" title="Lulus">Lulus <i class="fas fa-check"></i></a>
                                                <?php }  ?>

                                            </td>
                                        </tr>
                                    <?php
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        </section>
    </div>
<?php } ?>
<?php if ($jurusan == 'TKJ') { ?>
    <div class="main-content">
        <section class="section">
            <section class="section-header">
                <h1>Verifikasi Data Asesi</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="panel_asesor">Beranda</a></div>
                    <div class="breadcrumb-item">Verifikasi Asesi</div>
                </div>
            </section>

            <div class="flash-data" data-flashdata="<?= $this->session->flashdata('msg'); ?>"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-md-3 ml-auto mb-5">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-calendar-alt"></i>
                                        </div>
                                    </div>
                                    <select class="form-control" name="thn" onchange="thn()">
                                        <?php for ($i = date('Y'); $i >= 2021; $i--) { ?>
                                            <option value="<?php echo $i; ?>" <?php if ($v_thn == $i) {
                                                                                    echo "selected";
                                                                                } ?>>Tahun <?php echo $i; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <table id="example" class="table table-striped table-bordered" width="100%">
                                <thead>
                                    <tr>
                                        <th width="30px;">No.</th>
                                        <th>No. Pendaftaran</th>
                                        <th>NISN</th>
                                        <th>NIK</th>
                                        <th>Nama Lengkap</th>
                                        <th class="text-center">Status Verifikasi</th>
                                        <th class="text-center" width="180">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($v_siswatkj->result() as $baris) { ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $baris->no_pendaftaran; ?></td>
                                            <td><?php echo $baris->nisn; ?></td>
                                            <td><?php echo $baris->nik; ?></td>
                                            <td><?php echo $baris->nama_lengkap; ?></td>
                                            <td align="center">
                                                <?php if ($baris->status_verifikasi == 1) { ?>
                                                    <label class="badge badge-success">Terverifikasi</label>
                                                <?php } else { ?>
                                                    <label class="badge badge-danger">Belum diVerifikasi</label>
                                                <?php } ?>
                                            </td>
                                            <td align="center">
                                                <a href="panel_asesor/verifikasi_cetak/<?php echo $baris->no_pendaftaran; ?>" class="btn btn-default btn-xs" title="Cetak Verifikasi" target="_blank"><i class="icon-printer2"></i></a>
                                                <?php if ($baris->status_verifikasi == 0) { ?>
                                                    <a href="panel_asesor/verifikasi/cek/<?php echo $baris->no_pendaftaran; ?>" class="btn btn-info btn-xs tombol-verifikasi" title="Verifikasi"><i class="fas fa-check"></i></a>
                                                <?php } else { ?>
                                                    <a href="panel_asesor/verifikasi/cek/<?php echo $baris->no_pendaftaran; ?>" class="btn btn-danger btn-xs tombol-batal-verifikasi" title="Batal Verifikasi"><i class="fas fa-times"></i></a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        </section>
    </div>
<?php } ?>
<?php if ($jurusan == 'MM') { ?>
    <div class="main-content">
        <section class="section">
            <section class="section-header">
                <h1>Verifikasi Data Asesi</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="panel_asesor">Beranda</a></div>
                    <div class="breadcrumb-item">Verifikasi Asesi</div>
                </div>
            </section>

            <div class="flash-data" data-flashdata="<?= $this->session->flashdata('msg'); ?>"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-md-3 ml-auto mb-5">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-calendar-alt"></i>
                                        </div>
                                    </div>
                                    <select class="form-control" name="thn" onchange="thn()">
                                        <?php for ($i = date('Y'); $i >= 2021; $i--) { ?>
                                            <option value="<?php echo $i; ?>" <?php if ($v_thn == $i) {
                                                                                    echo "selected";
                                                                                } ?>>Tahun <?php echo $i; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <table id="example" class="table table-striped table-bordered" width="100%">
                                <thead>
                                    <tr>
                                        <th width="30px;">No.</th>
                                        <th>No. Pendaftaran</th>
                                        <th>NISN</th>
                                        <th>NIK</th>
                                        <th>Nama Lengkap</th>
                                        <th class="text-center">Status Verifikasi</th>
                                        <th class="text-center" width="180">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($v_siswamm->result() as $baris) { ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $baris->no_pendaftaran; ?></td>
                                            <td><?php echo $baris->nisn; ?></td>
                                            <td><?php echo $baris->nik; ?></td>
                                            <td><?php echo $baris->nama_lengkap; ?></td>
                                            <td align="center">
                                                <?php if ($baris->status_verifikasi == 1) { ?>
                                                    <label class="badge badge-success">Terverifikasi</label>
                                                <?php } else { ?>
                                                    <label class="badge badge-danger">Belum diVerifikasi</label>
                                                <?php } ?>
                                            </td>
                                            <td align="center">
                                                <a href="panel_asesor/verifikasi_cetak/<?php echo $baris->no_pendaftaran; ?>" class="btn btn-default btn-xs" title="Cetak Verifikasi" target="_blank"><i class="icon-printer2"></i></a>
                                                <?php if ($baris->status_verifikasi == 0) { ?>
                                                    <a href="panel_asesor/verifikasi/cek/<?php echo $baris->no_pendaftaran; ?>" class="btn btn-info btn-xs tombol-verifikasi" title="Verifikasi"><i class="fas fa-check"></i></a>
                                                <?php } else { ?>
                                                    <a href="panel_asesor/verifikasi/cek/<?php echo $baris->no_pendaftaran; ?>" class="btn btn-danger btn-xs tombol-batal-verifikasi" title="Batal Verifikasi"><i class="fas fa-times"></i></a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        </section>
    </div>
<?php } ?>
<?php if ($jurusan == 'PKM') { ?>
    <div class="main-content">
        <section class="section">
            <section class="section-header">
                <h1>Verifikasi Data Asesi</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="panel_asesor">Beranda</a></div>
                    <div class="breadcrumb-item">Verifikasi Asesi</div>
                </div>
            </section>

            <div class="flash-data" data-flashdata="<?= $this->session->flashdata('msg'); ?>"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-md-3 ml-auto mb-5">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-calendar-alt"></i>
                                        </div>
                                    </div>
                                    <select class="form-control" name="thn" onchange="thn()">
                                        <?php for ($i = date('Y'); $i >= 2021; $i--) { ?>
                                            <option value="<?php echo $i; ?>" <?php if ($v_thn == $i) {
                                                                                    echo "selected";
                                                                                } ?>>Tahun <?php echo $i; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <table id="example" class="table table-striped table-bordered" width="100%">
                                <thead>
                                    <tr>
                                        <th width="30px;">No.</th>
                                        <th>No. Pendaftaran</th>
                                        <th>NISN</th>
                                        <th>NIK</th>
                                        <th>Nama Lengkap</th>
                                        <th class="text-center">Status Verifikasi</th>
                                        <th class="text-center" width="180">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($v_siswapkm->result() as $baris) { ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $baris->no_pendaftaran; ?></td>
                                            <td><?php echo $baris->nisn; ?></td>
                                            <td><?php echo $baris->nik; ?></td>
                                            <td><?php echo $baris->nama_lengkap; ?></td>
                                            <td align="center">
                                                <?php if ($baris->status_verifikasi == 1) { ?>
                                                    <label class="badge badge-success">Terverifikasi</label>
                                                <?php } else { ?>
                                                    <label class="badge badge-danger">Belum diVerifikasi</label>
                                                <?php } ?>
                                            </td>
                                            <td align="center">
                                                <a href="panel_asesor/verifikasi_cetak/<?php echo $baris->no_pendaftaran; ?>" class="btn btn-default btn-xs" title="Cetak Verifikasi" target="_blank"><i class="icon-printer2"></i></a>
                                                <?php if ($baris->status_verifikasi == 0) { ?>
                                                    <a href="panel_asesor/verifikasi/cek/<?php echo $baris->no_pendaftaran; ?>" class="btn btn-info btn-xs tombol-verifikasi" title="Verifikasi"><i class="fas fa-check"></i></a>
                                                <?php } else { ?>
                                                    <a href="panel_asesor/verifikasi/cek/<?php echo $baris->no_pendaftaran; ?>" class="btn btn-danger btn-xs tombol-batal-verifikasi" title="Batal Verifikasi"><i class="fas fa-times"></i></a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        </section>
    </div>
<?php } ?>

<script type="text/javascript">
    function thn() {
        var thn = $('[name="thn"]').val();
        window.location = "panel_asesor/verifikasi/thn/" + thn;
    }

    $('[name="thn"]').select2({
        placeholder: "- Tahun -"
    });
</script>