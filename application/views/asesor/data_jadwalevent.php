<div class="main-content">
    <section class="section">
        <section class="section-header">
            <h1>Data Jadwal Event</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="panel_admin">Beranda</a></div>
                <div class="breadcrumb-item">Data Jadwal Event</div>
            </div>
        </section>
        <div class="flash-data" data-flashdata="<?= $this->session->flashdata('msg'); ?>"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                        </div>
                        <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Event</th>
                                    <th>Nama Event</th>
                                    <th>Asesor</th>
                                    <th>No Pendaftaran</th>
                                    <th>Asesi</th>
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
                                    <td><?php echo $baris->nama_asesor; ?></td>
                                    <td><?php echo $baris->no_pendaftaran; ?></td>
                                    <td><?php echo $baris->nama_asesi; ?></td>
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