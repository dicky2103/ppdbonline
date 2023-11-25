
    <div class="main-content">
        <section class="section">
            <section class="section-header">
                <h1>Biodata Asesi</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="panel_admin">Beranda</a></div>
                    <div class="breadcrumb-item active"><a href="panel_admin/data_asesi">Data Asesi</a></div>
                    <div class="breadcrumb-item">Detail Asesi</div>
                </div>
            </section>
            
            <div class="row">
                <div class="col-md-12">
                    <div class="card" style="width: 100%;">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                <tr>
                                    <th>Serifikasi</th>
                                    <th>:</th>
                                    <td><?php echo $detail->nama_skema_sertifikasi; ?></td>
                                </tr>
                                <tr>
                                    <th width="20%">NO. PENDAFTARAN</th>
                                    <th width="1%">:</th>
                                    <td><?php echo $detail->no_pendaftaran; ?></td>
                                </tr>
                                <tr>
                                    <th>NIK</th>
                                    <th>:</th>
                                    <td><?php echo $detail->nik; ?></td>
                                </tr>
                                <tr>
                                    <th>Nama Lengkap</th>
                                    <th>:</th>
                                    <td><?php echo ucwords($detail->nama_lengkap); ?></td>
                                </tr>
                                <tr>
                                    <th>Jenis Kelamin</th>
                                    <th>:</th>
                                    <td><?php echo $detail->jk; ?></td>
                                </tr>
                                <tr>
                                    <th>Tempat, Tgl Lahir</th>
                                    <th>:</th>
                                    <td><?php echo "$detail->tempat_lahir, " . $this->lib_data->tgl_id($detail->tgl_lahir); ?></td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <th>:</th>
                                    <td><?php echo $detail->alamat_siswa; ?> , <?php echo $detail->desa; ?> <?php echo $detail->kec; ?> <?php echo $detail->kab; ?> <?php echo $detail->kode_pos; ?></td>
                                </tr>
                                <tr>
                                    <th>Jenis Tinggal</th>
                                    <th>:</th>
                                    <td><?php echo $detail->alamat_siswa; ?></td>
                                </tr>
                                <tr>
                                    <th>No. Handphone</th>
                                    <th>:</th>
                                    <td><?php echo $detail->no_hp_siswa; ?></td>
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
                            <i class="icon-library2"></i> <h5>Data Pekerjaan</h5>
                            <hr><br>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                <tr>
                                    <th width="30%">Nama Perusahaan</th>
                                    <th width="1%">:</th>
                                    <td><?php echo $detail->nama_perusahaan; ?></td>
                                </tr>
                                <tr>
                                    <th width="30%">Jabatan</th>
                                    <th width="1%">:</th>
                                    <td><?php echo $detail->jabatan; ?></td>
                                </tr>
                                <tr>
                                    <th>Alamat Perusahaan</th>
                                    <th>:</th>
                                    <td><?php echo $detail->alamat_perusahaan; ?></td>
                                </tr>
                                <tr>
                                <tr>
                                    <th>Email Perusahaan</th>
                                    <th>:</th>
                                    <td><?php echo $detail->email_perusahaan; ?></td>
                                </tr>
                                <tr>
                                    <th>No Telp Perusahaan</th>
                                    <th>:</th>
                                    <td><?php echo $detail->no_telp_perusahaan; ?></td>
                                </tr>
                                <tr>
                                    <th>No Fax Perusahaan</th>
                                    <th>:</th>
                                    <td><?php echo $detail->no_fax; ?></td>
                                </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
