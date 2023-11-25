<div class="main-content">
    <section class="section">
        <section class="section-header">
            <h1>Kelulusan Calon Siswa</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="panel_admin">Beranda</a></div>
                <div class="breadcrumb-item">Kelulusan</div>
            </div>
        </section>
        
        <div class="flash-data" data-flashdata="<?= $this->session->flashdata('msg'); ?>"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="col-md-3 ml-auto mb-5">
                            <div class="input-group">
                            </div>
                        </div>
                        <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th width="30px;">No.</th>
                                    <th>No. Pendaftaran</th>
                                    <th>Tingkatan</th>
                                    <th>Tujuan</th>
                                    <th>NIK</th>
                                    <th>NISN</th>
                                    <th>No KK</th>
                                    <th>Nama Lengkap</th>
                                    <th class="text-center">Berkas</th>
                                    <th class="text-center">Status Lulus</th>
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
                                <td><?php echo $baris->desa; ?></td>
                                <td><?php echo $baris->pd_terakhir; ?></td>
                                <td><?php echo $baris->nama_lengkap; ?></td>
                                <td>
                                    <a href="<?php echo base_url('panel_admin/detail_berkas/') . $baris->id_siswa ?>" class="btn btn-sm btn-success">Lihat Berkas</a>
                                </td>
                                <td>
                                    <center>
                                    <?php if ($baris->status_pendaftaran == '1') { ?>
                                        <label class="badge badge-success">Lulus</label>
                                    <?php } elseif ($baris->status_pendaftaran == 'tidak lulus') { ?>
                                        <label class="badge badge-danger">Tidak Lulus</label>
                                    <?php } else { ?>
                                        <label class="badge badge-warning">Proses</label>
                                    <?php } ?>
                                    </center>
                                </td>
                                <td>
                                    <center>
                                    <?php if ($baris->status_pendaftaran == '') { ?>
                                        <a href="panel_admin/set_pengumuman/tdk_lulus/<?php echo $baris->no_pendaftaran; ?>" class="btn btn-danger btn-xs tombol-tidak-lulus" title="Tidak Lulus"><i class="icon-cross3"></i> Tidak Lulus</a>
                                        <a href="panel_admin/set_pengumuman/lulus/<?php echo $baris->no_pendaftaran; ?>" class="btn btn-success btn-xs tombol-lulus" title="Lulus"><i class="icon-checkmark4"></i> Lulus</a>
                                    <?php } else { ?>
                                        <a href="panel_admin/set_pengumuman/batal/<?php echo $baris->no_pendaftaran; ?>" class="btn btn-danger btn-xs tombol-batal" title="Batalkan"><i class="icon-cross3"></i> Batal Lulus</a>
                                    <?php } ?>
                                    </center>
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

<script type="text/javascript">
      function thn() {
        var thn = $('[name="thn"]').val();
        window.location = "panel_admin/set_pengumuman/thn/" + thn;
      }

      $('[name="thn"]').select2({
        placeholder: "- Tahun -"
      });
</script>