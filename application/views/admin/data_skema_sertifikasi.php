<div class="main-content">
    <section class="section">
        <section class="section-header">
            <h1>Tingkatan Sekolah</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="panel_admin">Beranda</a></div>
                <div class="breadcrumb-item">Tingkatan Sekolah</div>
            </div>
        </section>
        <div class="flash-data" data-flashdata="<?= $this->session->flashdata('msg'); ?>"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <a href="panel_admin/tambah_tingkatan" class="btn btn-primary mb-2 ml-3">Tambah Tingkatan</a>
                        </div>
                        <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Kode</th>
                                    <th>Jenis</th>
                                    <th>Nama Tingkatan Sekolah</th>
                                    <th>APL01</th>
                                    <th>APL02</th>
                                    <th>Materi</th>
                                    <th width="200">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $no = 1;
                            foreach ($data as $baris) { ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $baris->kode_skema_sertifikasi; ?></td>
                                    <td><?php echo $baris->jenis_skema_sertifikasi; ?></td>
                                    <td><?php echo $baris->nama_skema_sertifikasi; ?></td>
                                    <td><a href="<?= base_url() ?>assets/upload/skema/<?= $baris->apl01 ?>" target="_blank">Download</a></td>
                                    <td><a href="<?= base_url() ?>assets/upload/skema/<?= $baris->apl02 ?>" target="_blank">Download</a></td>
                                    <td><a href="<?= base_url() ?>assets/upload/skema/<?= $baris->materi ?>" target="_blank">Download</a></td>
                                    <td align="center">
                                            <a href="<?php echo base_url('panel_admin/delete_skema_sertifikasi/') . $baris->id_skema_sertifikasi ?>" class="btn btn-sm btn-danger tombol-hapus"><i class="fas fa-trash"></i></a>
                                            <a href="<?php echo base_url('panel_admin/update_skema_sertifikasi/') . $baris->id_skema_sertifikasi ?>" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
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