<div class="main-content">
    <section class="section">
        <section class="section-header">
            <h1>Data Pembayaran</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="panel_admin">Beranda</a></div>
                <div class="breadcrumb-item">Data Pembayaran</div>
            </div>
        </section>
        <div class="flash-data" data-flashdata="<?= $this->session->flashdata('msg'); ?>"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <a href="panel_admin/tambah_jadwalevent" class="btn btn-primary mb-2 ml-3">Tambah Jadwal Event</a>
                        </div>
                        <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Kegiatan</th>
                                    <th>Nama Kegiatan</th>
                                    
                                    <th>No Pendaftaran</th>
                                    <th>Siswa</th>
                                    <th width="200">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $no = 1;
                            foreach ($asesor as $baris) { ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $baris->tgl_jadwalevent; ?></td>
                                    <td><?php echo $baris->nama_jadwalevent; ?></td>
                                    <td><?php echo $baris->no_pendaftaran; ?></td>
                                    <td><?php echo $baris->nama_asesi; ?></td>
                                    <td align="center">
                                            <a href="<?php echo base_url('panel_admin/delete_jadwalevent/') . $baris->id_jadwalevent ?>" class="btn btn-sm btn-danger tombol-hapus"><i class="fas fa-trash"></i></a>
                                            <a href="<?php echo base_url('panel_admin/update_jadwalevent/') . $baris->id_jadwalevent ?>" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
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