<div class="main-content">
	<section class="section">
		<section class="section-header">
			<h1>Ruang Asesi</h1>
			<div class="section-header-breadcrumb">
				<div class="breadcrumb-item active"><a href="panel_admin">Beranda</a></div>
				<div class="breadcrumb-item">Ruang Asesi</div>
			</div>
		</section>
		<?php if ($this->session->flashdata('error')) : ?>
			<div class="alert alert-danger text-capitalize">
				<?php print_r($this->session->flashdata('error')); ?>
			</div>
		<?php endif; ?>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-striped table-bordered" width="100%">
								<thead>
									<tr>
										<th>No.</th>
										<th>Nomor Pendaftaran</th>
										<th>Skema</th>
										<th>Nama</th>
										<th width="250">Soal Ujian</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$no = 1;
									foreach ($item as $row) : ?>
										<form method="POST" action="<?= base_url('panel_asesor/upload_soal') ?>" enctype="multipart/form-data">
											<tr>
												<td><?= $no++; ?></td>
												<td><?= $row->no_pendaftaran ?></td>
												<td><?= $row->nama_skema_sertifikasi ?></td>
												<td><?= $row->nama_lengkap ?></td>
												<td>
													<div class="custom-file">
														<input type="hidden" name="id_siswa" value="<?= $row->id_siswa ?>">
														<input type="file" name="file_soal" class="custom-file-input" id="file_soal">
														<label class="custom-file-label" for="file_soal">Upload Soal</label>
													</div>
													<?php if ($row->file_soal) : ?>
														<a href="<?= base_url() ?>assets/upload/soal/<?= $row->file_soal ?>">Lihat soal</a>
													<?php endif; ?>
												</td>
												<td>
													<button type="submit" class="btn btn-primary">Kirim</button>
												</td>
											</tr>
										</form>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
	</section>
</div>