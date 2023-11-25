<?php
$cek    = $user;
$jurusan = $cek->jurusan;
?>

<?php if ($jurusan == 'RPL') { ?>
    <div class="main-content">
        <section class="section">
            <section class="section-header">
                <h1>Data Asesi</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="panel_asesor">Beranda</a></div>
                    <div class="breadcrumb-item">Data Asesi</div>
                </div>
            </section>
            <div class="flash-data" data-flashdata="<?= $this->session->flashdata('msg'); ?>"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body table-responsive">
                            <table id="example" class="table table-striped table-bordered w-100">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>No. Pendaftaran</th>
                                        <th>Tujuan</th>
                                        <th>Skema</th>
                                        <th>NIK</th>
                                        <th>Nama Lengkap</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Alamat</th>
                                        <th>Status Lulus</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($asesi as $baris) { ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $baris->no_pendaftaran; ?></td>
                                            <td><?php echo $baris->tujuan_asessment; ?></td>
                                            <td><?php echo $baris->nama_skema_sertifikasi; ?></td>
                                            <td><?php echo $baris->nik; ?></td>
                                            <td><?php echo $baris->nama_lengkap; ?></td>
                                            <td><?php echo $baris->jk; ?></td>
                                            <td><?php echo $baris->alamat_siswa; ?></td>
                                            <td align="center">
                                                <?php if ($baris->status_pendaftaran == 1) { ?>
                                                    <label class="badge badge-success">Lulus</label>
                                                <?php } elseif ($baris->status_pendaftaran == 2) { ?>
                                                    <label class="badge badge-danger">Tidak Lulus</label>
                                                <?php } else { ?>
                                                    <label class="badge badge-warning">Proses</label>
                                                <?php } ?>
                                            </td>
                                            <td align="center">
                                                <a href="<?php echo base_url('panel_asesor/detail_asesi/') . $baris->id_siswa ?>" class="btn btn-sm btn-success"><i class="fas fa-eye"></i></a>
                                            </td>
                                        </tr>
                                    <?php
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php } ?>