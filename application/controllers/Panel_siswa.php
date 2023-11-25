<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Panel_siswa extends CI_Controller
{

	public function index()
	{
		date_default_timezone_set("Asia/Jakarta");
		if ($this->session->userdata('no_pendaftaran') == NULL) {
			redirect('');
		} else {
			$data = array(
				'user'		=> $this->siswa->base_biodata($this->session->userdata('no_pendaftaran')),
				'judul_web'	=> "Beranda"
			);
			$id = $this->session->userdata('no_pendaftaran');
			$data['pesan'] = $this->db->query("SELECT * FROM tbl_pesan INNER JOIN tbl_user ON tbl_pesan.id_user = tbl_user.id_user WHERE tbl_pesan.no_pendaftaran = '$id' ORDER BY tbl_pesan.waktu DESC")->result();
			$data['cekform'] = $this->db->query("SELECT 'ANIM' as Source,anim.no_pendaftaran 
			FROM tbl_animasi2d anim 
			WHERE anim.no_pendaftaran IN  ('$id','$id','$id','$id','$id','$id','$id','$id','$id')
			UNION ALL
			SELECT 'AUD' as Source,aud.no_pendaftaran 
			FROM tbl_audiovideo aud
			WHERE aud.no_pendaftaran IN  ('$id','$id','$id','$id','$id','$id','$id','$id','$id')
			UNION ALL
			SELECT 'GRAF' as Source,graf.no_pendaftaran 
			FROM tbl_desaingrafis graf
			WHERE graf.no_pendaftaran IN  ('$id','$id','$id','$id','$id','$id','$id','$id','$id')
			UNION ALL
			SELECT 'CETAK' as Source,cetak.no_pendaftaran 
			FROM tbl_desainpercetakan cetak
			WHERE cetak.no_pendaftaran IN  ('$id','$id','$id','$id','$id','$id','$id','$id','$id')
			UNION ALL
			SELECT 'JAR' as Source,jar.no_pendaftaran 
			FROM tbl_instalasijaringan jar
			WHERE jar.no_pendaftaran IN  ('$id','$id','$id','$id','$id','$id','$id','$id','$id')
			UNION ALL
			SELECT 'PER' as Source,per.no_pendaftaran 
			FROM tbl_konfigurasiperangkat per
			WHERE per.no_pendaftaran IN  ('$id','$id','$id','$id','$id','$id','$id','$id','$id')
			UNION ALL
			SELECT 'ROUT' as Source,rout.no_pendaftaran 
			FROM tbl_konfigurasirouting rout
			WHERE rout.no_pendaftaran IN  ('$id','$id','$id','$id','$id','$id','$id','$id','$id')
			UNION ALL
			SELECT 'PEL' as Source,pel.no_pendaftaran 
			FROM tbl_pelayananperbankan pel
			WHERE pel.no_pendaftaran IN  ('$id','$id','$id','$id','$id','$id','$id','$id','$id')
			UNION ALL
			SELECT 'APL' as Source,apl.no_pendaftaran 
			FROM tbl_pengoperasianaplikasi apl
			WHERE apl.no_pendaftaran IN  ('$id','$id','$id','$id','$id','$id','$id','$id','$id')
			UNION ALL
			SELECT 'OBJEK' as Source,objek.no_pendaftaran 
			FROM tbl_pbo objek
			WHERE objek.no_pendaftaran IN  ('$id','$id','$id','$id','$id','$id','$id','$id','$id')
			UNION ALL
			SELECT 'WEB' as Source,web.no_pendaftaran 
			FROM tbl_pemweb web
			WHERE web.no_pendaftaran IN  ('$id','$id','$id','$id','$id','$id','$id','$id','$id')
			UNION ALL
			SELECT 'DAS' as Source,das.no_pendaftaran 
			FROM tbl_pemdas das
			WHERE das.no_pendaftaran IN  ('$id','$id','$id','$id','$id','$id','$id','$id','$id')")->row();

			$this->load->view('templates_asesi/header', $data);
			$this->load->view('templates_asesi/sidebar', $data);
			$this->load->view('asesi/dashboard', $data);
			$this->load->view('templates_asesi/footer');
		}
	}

	public function test()
	{
		$data = array(
			'user'		=> $this->siswa->base_biodata($this->session->userdata('no_pendaftaran')),
			'judul_web'	=> "HOME"
		);
		$id = $this->session->userdata('no_pendaftaran');
		$data['pesan'] = $this->db->query("SELECT * FROM tbl_pesan INNER JOIN tbl_user ON tbl_pesan.id_user = tbl_user.id_user WHERE tbl_pesan.no_pendaftaran = '$id' ORDER BY tbl_pesan.waktu DESC")->result();
		$this->load->view('siswa/header', $data);
		$this->load->view('siswa/dashboard', $data);
		$this->load->view('siswa/footer');
	}

	public function pengumuman()
	{
		if ($this->session->userdata('no_pendaftaran') == NULL) {
			redirect('');
		} else {
			$data = array(
				'user'		=> $this->siswa->base_biodata($this->session->userdata('no_pendaftaran')),
				'judul_web'	=> "PENGUMUMAN"
			);

			$this->load->view('siswa/header', $data);
			$this->load->view('siswa/pengumuman', $data);
			$this->load->view('siswa/footer');
		}
	}

	public function biodata()
	{
		date_default_timezone_set("Asia/Jakarta");
		if ($this->session->userdata('no_pendaftaran') == NULL) {
			redirect('logcs');
		} else {
			$sess = $this->session->userdata('no_pendaftaran');
			$base_bio 	= $this->siswa->base_biodata($sess);
			$data = array(
				'user'		=> $this->siswa->base_biodata($sess),
				'judul_web'	=> "Biodata"
			);
			$data['join_tblsiswa'] = $this->db->query("SELECT * FROM tbl_siswa INNER JOIN tbl_komp ON tbl_siswa.id_komp = tbl_komp.id_komp")->result();
			$id = $this->session->userdata('no_pendaftaran');
			$data['pesan'] = $this->db->query("SELECT * FROM tbl_pesan INNER JOIN tbl_user ON tbl_pesan.id_user = tbl_user.id_user WHERE tbl_pesan.no_pendaftaran = '$id' ORDER BY tbl_pesan.waktu DESC")->result();
			$this->load->view('templates_asesi/header', $data);
			$this->load->view('templates_asesi/sidebar', $data);
			$this->load->view('asesi/biodata', $data);
			$this->load->view('templates_asesi/footer');
		}
	}


	public function cetak()
	{
		if ($this->session->userdata('no_pendaftaran') == NULL) {
			redirect('logcs');
		}
		$sess 		= $this->session->userdata('no_pendaftaran');
		$base_bio 	= $this->siswa->base_biodata($sess);
		$data = array(
			'user'			=> $base_bio,
			'judul_web'		=> ucwords($base_bio->no_pendaftaran) . '-' . ucwords($base_bio->nama_lengkap),
			'thn_ppdb'		=> date('Y', strtotime($base_bio->tgl_siswa))
		);

		$this->load->view('siswa/cetak', $data);
	}


	public function logout()
	{
		if ($this->session->userdata('no_pendaftaran') != '') {
			$data = array(
				'status' => '0'
			);

			$where = array(
				'no_pendaftaran' => $this->session->userdata('no_pendaftaran')
			);
			$this->web->update_data('tbl_siswa', $data, $where);
			$this->session->sess_destroy();
		}
		$this->session->set_flashdata('msg', 'Logout');
		redirect('');
	}

	public function chat()
	{
		if ($this->session->userdata('no_pendaftaran') == NULL) {
			redirect('');
		} else {
			$data = array(
				'user'		=> $this->siswa->base_biodata($this->session->userdata('no_pendaftaran')),
				'judul_web'	=> "Pesan"
			);
			$id = $this->session->userdata('no_pendaftaran');
			$data['asesionline'] = $this->db->query("SELECT * FROM tbl_siswa sis WHERE sis.status = '1'")->result();
			$data['asesioffline'] = $this->db->query("SELECT * FROM tbl_siswa sis WHERE sis.status = '0'")->result();
			$data['pesan'] = $this->db->query("SELECT * FROM tbl_pesan INNER JOIN tbl_user ON tbl_pesan.id_user = tbl_user.id_user WHERE tbl_pesan.no_pendaftaran = '$id' ORDER BY tbl_pesan.waktu DESC")->result();
			$this->load->view('templates_asesi/header', $data);
			$this->load->view('templates_asesi/sidebar', $data);
			$this->load->view('asesi/chat', $data);
			$this->load->view('templates_asesi/footer');
		}
	}

	public function tinjau_formapl2()
	{
		if ($this->session->userdata('no_pendaftaran') == NULL) {
			redirect('');
		} else {
			$data = array(
				'user'		=> $this->siswa->base_biodata($this->session->userdata('no_pendaftaran')),
				'judul_web'	=> "Tinjau Form APL 02"
			);
			$id = $this->session->userdata('no_pendaftaran');
			$data['signature'] = $this->db->query("SELECT * FROM tbl_signature sig INNER JOIN tbl_siswa sis ON sig.no_pendaftaran = sis.no_pendaftaran WHERE sis.no_pendaftaran='$id'")->result();
			$data['asesi'] = $this->db->query("SELECT * FROM tbl_siswa WHERE tbl_siswa.no_pendaftaran='$id'")->row();
			$data['kompetensi_pemdas'] = $this->db->query("SELECT * FROM tbl_pemdas INNER JOIN tbl_siswa ON tbl_siswa.no_pendaftaran = tbl_pemdas.no_pendaftaran WHERE tbl_pemdas.no_pendaftaran='$id'")->result();
			$data['kompetensi_pemweb'] = $this->db->query("SELECT * FROM tbl_pemweb INNER JOIN tbl_siswa ON tbl_siswa.no_pendaftaran = tbl_pemweb.no_pendaftaran WHERE tbl_pemweb.no_pendaftaran='$id'")->result();
			$data['kompetensi_pbo'] = $this->db->query("SELECT * FROM tbl_pbo INNER JOIN tbl_siswa ON tbl_siswa.no_pendaftaran = tbl_pbo.no_pendaftaran WHERE tbl_pbo.no_pendaftaran='$id'")->result();
			$data['kompetensi_audiovideo'] = $this->db->query("SELECT * FROM tbl_audiovideo INNER JOIN tbl_siswa ON tbl_siswa.no_pendaftaran = tbl_audiovideo.no_pendaftaran WHERE tbl_audiovideo.no_pendaftaran='$id'")->result();
			$data['kompetensi_animasi2d'] = $this->db->query("SELECT * FROM tbl_animasi2d INNER JOIN tbl_siswa ON tbl_siswa.no_pendaftaran = tbl_animasi2d.no_pendaftaran WHERE tbl_animasi2d.no_pendaftaran='$id'")->result();
			$data['kompetensi_desainpercetakan'] = $this->db->query("SELECT * FROM tbl_desainpercetakan INNER JOIN tbl_siswa ON tbl_siswa.no_pendaftaran = tbl_desainpercetakan.no_pendaftaran WHERE tbl_desainpercetakan.no_pendaftaran='$id'")->result();
			$data['kompetensi_desaingrafis'] = $this->db->query("SELECT * FROM tbl_desaingrafis INNER JOIN tbl_siswa ON tbl_siswa.no_pendaftaran = tbl_desaingrafis.no_pendaftaran WHERE tbl_desaingrafis.no_pendaftaran='$id'")->result();
			$data['kompetensi_konfigurasirouting'] = $this->db->query("SELECT * FROM tbl_konfigurasirouting INNER JOIN tbl_siswa ON tbl_siswa.no_pendaftaran = tbl_konfigurasirouting.no_pendaftaran WHERE tbl_konfigurasirouting.no_pendaftaran='$id'")->result();
			$data['kompetensi_konfigurasiperangkat'] = $this->db->query("SELECT * FROM tbl_konfigurasiperangkat INNER JOIN tbl_siswa ON tbl_siswa.no_pendaftaran = tbl_konfigurasiperangkat.no_pendaftaran WHERE tbl_konfigurasiperangkat.no_pendaftaran='$id'")->result();
			$data['kompetensi_instalasijaringan'] = $this->db->query("SELECT * FROM tbl_instalasijaringan INNER JOIN tbl_siswa ON tbl_siswa.no_pendaftaran = tbl_instalasijaringan.no_pendaftaran WHERE tbl_instalasijaringan.no_pendaftaran='$id'")->result();
			$data['kompetensi_pengoperasianaplikasi'] = $this->db->query("SELECT * FROM tbl_pengoperasianaplikasi INNER JOIN tbl_siswa ON tbl_siswa.no_pendaftaran = tbl_pengoperasianaplikasi.no_pendaftaran WHERE tbl_pengoperasianaplikasi.no_pendaftaran='$id'")->result();
			$data['kompetensi_pelayananperbankan'] = $this->db->query("SELECT * FROM tbl_pelayananperbankan INNER JOIN tbl_siswa ON tbl_siswa.no_pendaftaran = tbl_pelayananperbankan.no_pendaftaran WHERE tbl_pelayananperbankan.no_pendaftaran='$id'")->result();
			$this->load->view('admin/header2', $data);
			$this->load->view('asesi/hasilformapl2', $data);
		}
	}

	public function tinjau_formapl1()
	{
		if ($this->session->userdata('no_pendaftaran') == NULL) {
			redirect('');
		} else {
			$data = array(
				'user'		=> $this->siswa->base_biodata($this->session->userdata('no_pendaftaran')),
				'judul_web'	=> "Tinjau Form APL 01"
			);
			$id = $this->session->userdata('no_pendaftaran');
			$data['signature'] = $this->db->query("SELECT * FROM tbl_signature sig INNER JOIN tbl_siswa sis ON sig.no_pendaftaran = sis.no_pendaftaran WHERE sis.no_pendaftaran='$id'")->row();
			$data['asesi'] = $this->db->query("SELECT * FROM tbl_siswa INNER JOIN tbl_pdd ON tbl_pdd.id_pdd = tbl_siswa.pd_terakhir WHERE tbl_siswa.no_pendaftaran='$id'")->row();
			$data['kompetensi_pemdas'] = $this->db->query("SELECT * FROM tbl_pemdas INNER JOIN tbl_siswa ON tbl_siswa.no_pendaftaran = tbl_pemdas.no_pendaftaran WHERE tbl_pemdas.no_pendaftaran='$id'")->result();
			$data['kompetensi_pemweb'] = $this->db->query("SELECT * FROM tbl_pemweb INNER JOIN tbl_siswa ON tbl_siswa.no_pendaftaran = tbl_pemweb.no_pendaftaran WHERE tbl_pemweb.no_pendaftaran='$id'")->result();
			$data['kompetensi_pbo'] = $this->db->query("SELECT * FROM tbl_pbo INNER JOIN tbl_siswa ON tbl_siswa.no_pendaftaran = tbl_pbo.no_pendaftaran WHERE tbl_pbo.no_pendaftaran='$id'")->result();
			$data['kompetensi_audiovideo'] = $this->db->query("SELECT * FROM tbl_audiovideo INNER JOIN tbl_siswa ON tbl_siswa.no_pendaftaran = tbl_audiovideo.no_pendaftaran WHERE tbl_audiovideo.no_pendaftaran='$id'")->result();
			$data['kompetensi_animasi2d'] = $this->db->query("SELECT * FROM tbl_animasi2d INNER JOIN tbl_siswa ON tbl_siswa.no_pendaftaran = tbl_animasi2d.no_pendaftaran WHERE tbl_animasi2d.no_pendaftaran='$id'")->result();
			$data['kompetensi_desainpercetakan'] = $this->db->query("SELECT * FROM tbl_desainpercetakan INNER JOIN tbl_siswa ON tbl_siswa.no_pendaftaran = tbl_desainpercetakan.no_pendaftaran WHERE tbl_desainpercetakan.no_pendaftaran='$id'")->result();
			$data['kompetensi_desaingrafis'] = $this->db->query("SELECT * FROM tbl_desaingrafis INNER JOIN tbl_siswa ON tbl_siswa.no_pendaftaran = tbl_desaingrafis.no_pendaftaran WHERE tbl_desaingrafis.no_pendaftaran='$id'")->result();
			$data['kompetensi_konfigurasirouting'] = $this->db->query("SELECT * FROM tbl_konfigurasirouting INNER JOIN tbl_siswa ON tbl_siswa.no_pendaftaran = tbl_konfigurasirouting.no_pendaftaran WHERE tbl_konfigurasirouting.no_pendaftaran='$id'")->result();
			$data['kompetensi_konfigurasiperangkat'] = $this->db->query("SELECT * FROM tbl_konfigurasiperangkat INNER JOIN tbl_siswa ON tbl_siswa.no_pendaftaran = tbl_konfigurasiperangkat.no_pendaftaran WHERE tbl_konfigurasiperangkat.no_pendaftaran='$id'")->result();
			$data['kompetensi_instalasijaringan'] = $this->db->query("SELECT * FROM tbl_instalasijaringan INNER JOIN tbl_siswa ON tbl_siswa.no_pendaftaran = tbl_instalasijaringan.no_pendaftaran WHERE tbl_instalasijaringan.no_pendaftaran='$id'")->result();
			$data['kompetensi_pengoperasianaplikasi'] = $this->db->query("SELECT * FROM tbl_pengoperasianaplikasi INNER JOIN tbl_siswa ON tbl_siswa.no_pendaftaran = tbl_pengoperasianaplikasi.no_pendaftaran WHERE tbl_pengoperasianaplikasi.no_pendaftaran='$id'")->result();
			$data['kompetensi_pelayananperbankan'] = $this->db->query("SELECT * FROM tbl_pelayananperbankan INNER JOIN tbl_siswa ON tbl_siswa.no_pendaftaran = tbl_pelayananperbankan.no_pendaftaran WHERE tbl_pelayananperbankan.no_pendaftaran='$id'")->result();
			if ($data['asesi']->id_komp == 12) {
				$this->load->view('asesi/tinjau_formapl01/pelayananperbankan', $data);
			}
			if ($data['asesi']->id_komp == 11) {
				$this->load->view('asesi/tinjau_formapl01/pengoperasianaplikasi', $data);
			}
			if ($data['asesi']->id_komp == 10) {
				$this->load->view('asesi/tinjau_formapl01/audiovideo', $data);
			}
			if ($data['asesi']->id_komp == 9) {
				$this->load->view('asesi/tinjau_formapl01/animasi2d', $data);
			}
			if ($data['asesi']->id_komp == 8) {
				$this->load->view('asesi/tinjau_formapl01/desainpercetakan', $data);
			}
			if ($data['asesi']->id_komp == 7) {
				$this->load->view('asesi/tinjau_formapl01/desaingrafis', $data);
			}
			if ($data['asesi']->id_komp == 6) {
				$this->load->view('asesi/tinjau_formapl01/konfigurasirouting', $data);
			}
			if ($data['asesi']->id_komp == 5) {
				$this->load->view('asesi/tinjau_formapl01/konfigurasiperangkat', $data);
			}
			if ($data['asesi']->id_komp == 4) {
				$this->load->view('asesi/tinjau_formapl01/instalasijaringan', $data);
			}
			if ($data['asesi']->id_komp == 3) {
				$this->load->view('asesi/tinjau_formapl01/pbo', $data);
			}
			if ($data['asesi']->id_komp == 2) {
				$this->load->view('asesi/tinjau_formapl01/pemweb', $data);
			}
			if ($data['asesi']->id_komp == 1) {
				$this->load->view('asesi/tinjau_formapl01/pemdas', $data);
			}
		}
	}

	public function download_informasi()
	{
		$sess 		= $this->session->userdata('no_pendaftaran');
		$data = array(
			'user'		=> $this->siswa->base_biodata($sess),
			'judul_web'	=> "Download"
		);
		$this->load->helper('download');
		$isi = '==================================' . "\r\n" . 'Nomor Pendaftaran ' . ':' . $data['user']->no_pendaftaran . "\r\n" . 'Password          ' . ':' . $data['user']->nisn . "\r\n" . '==================================' . "\r\n" . '*jaga file agar tidak hilang';
		$nama_file = $data['user']->nama_lengkap . '.txt';
		force_download($nama_file, $isi);
	}

	public function jadwalevent($aksi = '', $id = '')
	{
		$sess = $this->session->userdata('no_pendaftaran');
		$idd = $this->session->userdata('idd');
		if ($sess == NULL) {
			redirect('panel_siswa/log_in');
		} else {
			$data = array(
				'user'		=> $this->siswa->base_biodata($sess),
				'judul_web'	=> "Data Jadwal Event"
			);
			$data['pesan'] = $this->db->query("SELECT * FROM tbl_pesan INNER JOIN tbl_user ON tbl_pesan.id_user = tbl_user.id_user WHERE tbl_pesan.no_pendaftaran = '$id' ORDER BY tbl_pesan.waktu DESC")->result();
			$data['jadwalevent'] = $this->db->join('tbl_user', 'tbl_user.id_user=tbl_jadwalevent.id_asesor')->get_where('tbl_jadwalevent', ['id_asesi' => $idd])->result();

			$this->load->view('templates_asesi/header', $data);
			$this->load->view('templates_asesi/sidebar', $data);
			$this->load->view('asesi/data_jadwalevent', $data);
			$this->load->view('templates_asesi/footer');
		}
	}

	public function pilih_jadwal()
	{
		$input = $this->input->post();

		$data = [
			'nama_event' => $input['nama_event'],
			'tgl_event' => $input['tgl_event'],
			// 'nama_asesor' => $input['nama_asesor'],
		];

		$where['id_siswa'] = $input['id_siswa'];

		$this->web->update_data('tbl_siswa', $data, $where);

		$this->session->set_flashdata('msg', 'Berhasil disimpan');
		redirect('panel_siswa/jadwalevent');
	}

	public function downloadupload($aksi = '', $id = '')
	{
		$sess = $this->session->userdata('no_pendaftaran');
		$idd = $this->session->userdata('idd');

		if ($sess == NULL) {
			redirect('panel_siswa/log_in');
		} else {
			$data = array(
				'user'		=> $this->siswa->base_biodata($sess),
				'judul_web'	=> "Data Jadwal Event"
			);
			$data['pesan'] = $this->db->query("SELECT * FROM tbl_pesan INNER JOIN tbl_user ON tbl_pesan.id_user = tbl_user.id_user WHERE tbl_pesan.no_pendaftaran = '$id' ORDER BY tbl_pesan.waktu DESC")->result();

			$data['skema'] = $this->db->query("SELECT * FROM tbl_skema_sertifikasi")->result();

			$this->load->view('templates_asesi/header', $data);
			$this->load->view('templates_asesi/sidebar', $data);
			$this->load->view('asesi/downloadupload', $data);
			$this->load->view('templates_asesi/footer');
		}
	}

	private function _uploadConfig($type = "pdf")
	{
		$config['upload_path']		= './assets/upload/persyaratan/';
		$config['allowed_types']	= $type;
		$config['max_size']				= '4096';
		$config['encrypt_name'] 	= TRUE;
		return $config;
	}

	public function update_downloadupload_aksi()
	{
		$sess = $this->session->userdata('no_pendaftaran');
		$idd = $this->session->userdata('idd');

		if (!$idd || !$sess) redirect('panel_siswa/log_in');

		$where = ['id_siswa' => $idd];

		$id_skema_sertifikasi		= $this->input->post('id_skema_sertifikasi');
		$tujuan_asessment				= $this->input->post('tujuan_asessment');

		$data = [
			'id_skema_sertifikasi' => $id_skema_sertifikasi,
			'tujuan_asessment' => $tujuan_asessment,
			'status_verifikasi'		=> 1
		];

		$this->upload->initialize($this->_uploadConfig());

		$items = [
			'ijasah', 'sertifikat', 'cv', 'jobdesk', 'rekomendasi', 'laporankerja', 'ktp', 'foto', 'materi', 'suratpernyataan', 'apl01', 'apl02'
		];

		foreach ($items as $item) {
			if ($item == 'foto') {
				$this->upload->initialize($this->_uploadConfig('jpg|jpeg|png|jfif'));
			} else {
				$this->upload->initialize($this->_uploadConfig());
			}

			if ($_FILES[$item]['name']) {
				if (!$this->upload->do_upload($item)) {
					$error = "File {$item}: " . $this->upload->display_errors('', '');
					$this->session->set_flashdata('error', $error);
					redirect('panel_siswa/downloadupload');
				} else {
					$data[$item] = $this->upload->data('file_name');
				}
			}
		}

		$this->web->update_data('tbl_siswa', $data, $where);
		$this->session->set_flashdata('success', 'Data Persyaratan Berhasil di Upload!');
		redirect('panel_siswa/downloadupload');
	}

	public function getskema()
	{
		$id = $this->input->post('id');
		$skema_sertifikasi = $this->db->query("SELECT * FROM tbl_skema_sertifikasi WHERE id_skema_sertifikasi = '$id'")->row();
		echo '
			<div class="form-group">
				<label>Format APL 01</label> <br>
				<label><a href="' . base_url() . 'assets/upload/skema/' . $skema_sertifikasi->apl01 . '" target="_blank">Download</a></label> 
			</div>

			<div class="form-group">
				<label>Format APL 02</label> <br>
				<label><a href="' . base_url() . 'assets/upload/skema/' . $skema_sertifikasi->apl02 . '" target="_blank">Download</a></label> 
			</div>

			<div class="form-group">
				<label>Materi</label> <br>
				<label><a href="' . base_url() . 'assets/upload/skema/' . $skema_sertifikasi->materi . '" target="_blank">Download</a></label> 
			</div>
		';
	}

	public function soal_ujian($aksi = '', $id = '')
	{
		$sess = $this->session->userdata('no_pendaftaran');
		$idd = $this->session->userdata('idd');

		if ($sess == NULL) {
			redirect('panel_siswa/log_in');
		} else {
			$data = array(
				'user'		=> $this->siswa->base_biodata($sess),
				'judul_web'	=> "Soal Ujian"
			);

			$data['pesan'] 	= $this->db->query("SELECT * FROM tbl_pesan INNER JOIN tbl_user ON tbl_pesan.id_user = tbl_user.id_user WHERE tbl_pesan.no_pendaftaran = '$id' ORDER BY tbl_pesan.waktu DESC")->result();
			$data['skema'] 	= $this->db->query("SELECT * FROM tbl_skema_sertifikasi")->result();
			$data['item']		=	$this->db->join('tbl_skema_sertifikasi', 'id_skema_sertifikasi')
				->get_where('tbl_siswa', [
					'no_pendaftaran' => $sess
				])->result();

			$this->load->view('templates_asesi/header', $data);
			$this->load->view('templates_asesi/sidebar', $data);
			$this->load->view('asesi/soal_ujian', $data);
			$this->load->view('templates_asesi/footer');
		}
	}

	public function update_soal($id)
	{
		$this->web->update_data('tbl_siswa', [
			'status_soal' => 1
		], [
			'id_siswa' => $id
		]);

		redirect('panel_siswa/soal_ujian');
	}
}
