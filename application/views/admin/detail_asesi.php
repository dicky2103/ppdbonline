<div class="main-content">
    <section class="section">
        <section class="section-header">
            <h1>Biodata Siswa</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="panel_admin">Beranda</a></div>
                <div class="breadcrumb-item active"><a href="panel_admin/data_asesi">Data Siswa</a></div>
                <div class="breadcrumb-item">Detail Siswa</div>
            </div>
        </section>

        <div class="row">
            <div class="col-md-12">
                <div class="card" style="width: 100%;">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th>Tingkatan</th>
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
                                    <th>NISN</th>
                                    <th>:</th>
                                    <td><?php echo$detail->desa; ?></td>
                                </tr>
                                <tr>
                                    <th>No Kartu Keluarga</th>
                                    <th>:</th>
                                    <td><?php echo$detail->pd_terakhir; ?></td>
                                </tr>
                                <tr>
                                    <th>Nama Lengkap</th>
                                    <th>:</th>
                                    <td><?php echo ucwords($detail->nama_lengkap); ?></td>
                                </tr>
                                <tr>
                                    <th>Jenis Kelamin</th>
                                    <th>:</th>
                                    <td><?php echo$detail->jk; ?></td>
                                </tr>
                                <tr>
                                    <th>Tempat, Tgl Lahir</th>
                                    <th>:</th>
                                    <td><?php echo "$detail->tempat_lahir, " . $this->lib_data->tgl_id($detail->tgl_lahir); ?></td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <th>:</th>
                                    <td><?php echo$detail->kebangsaan; ?></td>
                                </tr>
                               
                                <tr>
                                    <th>No. Handphone</th>
                                    <th>:</th>
                                    <td><?php echo$detail->no_hp_siswa; ?></td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <th>:</th>
                                    <td><?php echo$detail->email; ?></td>
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
                            <i class="icon-library2"></i> <h5>Data Orang Tua</h5>
                            <hr><br>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                
                                <tr>
                                    <th>Nama Ayah</th>
                                    <th width="1%">:</th>
                                    
                                    <td><?php echo$detail->alamat_perusahaan; ?></td>
                                </tr>

                                <tr>
                                    <th width="30%">Nama Ibu</th>
                                    <th width="1%">:</th>
                                    
                                    <td><?php echo$detail->no_telp_perusahaan; ?></td>
                                </tr>

                                <tr>
                                    <th width="30%">No. Telpon Ayah</th>
                                    <th width="1%">:</th>
                                    
                                    <td><?php echo$detail->no_fax; ?></td>
                                </tr>

                                <tr>
                                    <th width="30%">No Telpon Ibu</th>
                                    <th width="1%">:</th>
                                    
                                    <td><?php echo$detail->email_perusahaan; ?></td>
                                </tr>

                                <tr>
                                    <th width="30%">Pekerjaan Ayah</th>
                                    <th width="1%">:</th>
                                    
                                    <td><?php echo$detail->kec; ?></td>
                                </tr>

                                <tr>
                                    <th width="30%">Pekerjaan Ibu</th>
                                    <th width="1%">:</th>
                                    
                                    <td><?php echo$detail->kab; ?></td>
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
                        <i class="icon-library2"></i>
                        <h5>Data Sekolah</h5>
                        <hr><br>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th width="30%">Nama Sekolah</th>
                                    <th width="1%">:</th>
                                    <td><?php echo $detail->nama_perusahaan; ?></td>
                                </tr>
                                <tr>
                                    <th width="30%">NPSN</th>
                                    <th width="1%">:</th>
                                    <td><?php echo $detail->jabatan; ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>