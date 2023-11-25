<div class="main-content">
    <section class="section">
        <section class="section-header">
            <h1>Data Asesi</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="panel_admin">Beranda</a></div>
                <div class="breadcrumb-item">Data Asesi</div>
            </div>
        </section>
        <div class="flash-data" data-flashdata="<?= $this->session->flashdata('msg'); ?>"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>No. Pendaftaran</th>
                                    <th>NIS</th>
                                    <th>NISN</th>
                                    <th>NIK</th>
                                    <th>Nama Lengkap</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Alamat</th>
                                    <th>Kompetensi</th>
                                    <th>Status Lulus</th>
                                    <th width="200">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $no = 1;
                            foreach ($asesi as $baris) { ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $baris->no_pendaftaran; ?></td>
                                    <td><?php echo $baris->nis; ?></td>
                                    <td><?php echo $baris->nisn; ?></td>
                                    <td><?php echo $baris->nik; ?></td>
                                    <td><?php echo $baris->nama_lengkap; ?></td>
                                    <td><?php echo $baris->jk; ?></td>
                                    <td><?php echo $baris->alamat_siswa; ?></td>
                                    <td><?php if($baris->id_komp == 1) {
                                       echo 'PPPA (Penanggungjawab Pengendalian Pencemaran Air )';
                                    } elseif ($baris->id_komp == 2) {
                                        echo 'POPAL (Penanggungjawab Operasional Pengolahan Ai Limbah)';
                                    } elseif ($baris->id_komp == 3) {
                                        echo 'PCUA (Pengambilan Contoh Uji Air)';
                                    } elseif ($baris->id_komp == 4) {
                                        echo 'PPPU (Penanggungjawab Pengendalian Pencemaran Udara)';
                                    } elseif ($baris->id_komp == 5) {
                                        echo 'POPU (Penanggungjawab Operasional Instalasi Pengendalian Pencemaran Udara)';
                                    } elseif ($baris->id_komp == 6) {
                                        echo 'PLB3 (Penanggungjawab Pengendalian Limbah B3)';
                                    } elseif ($baris->id_komp == 7) {
                                        echo 'OLB3 (Penanggungjawab Operasional Limbah B3)';
                                    } elseif ($baris->id_komp == 8) {
                                        echo 'Pemantauan Analisis dan Pengolahan Sampah atau Limbah Padat Non B3';
                                    } elseif ($baris->id_komp == 9) {
                                        echo 'Pengawasan Pengolahan Sampah atau Limbah Padat Non b3';
                                    } elseif ($baris->id_komp == 10) {
                                        echo 'Pengoperasian Instalasi Pengelolaan Sampah atau Limbah Padat Non B3';
                                    } elseif ($baris->id_komp == 11) {
                                        echo '(KPLCA) Keahlian Penghitungan Nilai Daur Hidup';
                                    } elseif ($baris->id_komp == 12) {
                                        echo '(PDLCA) Pengambilan Data Penilaian Daur Hidup';
                                    }?>
                                    </td>
                                    <td align="center">
                                        <?php if ($baris->status_pendaftaran == 'lulus') { ?>
                                        <label class="badge badge-success">Lulus</label>
                                        <?php } elseif ($baris->status_pendaftaran == 'tidak lulus') { ?>
                                        <label class="badge badge-danger">Tidak Lulus</label>
                                        <?php } else { ?>
                                        <label class="badge badge-warning">Proses</label>
                                        <?php } ?>
                                    </td>
                                    <td align="center">
                                            <a href="<?php echo base_url('panel_admin/print_form1_aksi/') . $baris->id_siswa ?>" class="btn btn-sm btn-primary"><i class="fas fa-print"></i></a>
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