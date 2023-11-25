<?php
defined('BASEPATH') or exit('No direct script access allowed');
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'assets/vendor/autoload.php';

class Panel_asesor extends CI_Controller
{
	public function index()
	{
		$sess = $this->session->userdata('id_asesor');
		if ($this->session->userdata('id_asesor') == NULL) {
			$this->load->view('404_content');
		} else {
			$data = array(
				'user'		=> $this->asesor->base('bio', $sess),
				'web_ppdb'	=> $this->asesor->base('status-ppdb'),
				'judul_web'	=> "Beranda",
				'v_thn'		=> date('Y'),

			);
			$data['countpemrogramandasar'] = $this->admin->get_countpemrogramandasar();
			$data['countpemrogramanweb'] = $this->admin->get_countpemrogramanweb();
			$data['countpemrogramanobjek'] = $this->admin->get_countpemrogramanobjek();
			$data['countinstalasi'] = $this->admin->get_countinstalasi();
			$data['countkonfigurasiperangkat'] = $this->admin->get_countkonfigurasiperangkat();
			$data['countkonfigurasirouting'] = $this->admin->get_countkonfigurasirouting();
			$data['countdesaingrafis'] = $this->admin->get_countdesaingrafis();
			$data['countpercetakan'] = $this->admin->get_countpercetakan();
			$data['countanimasi'] = $this->admin->get_countanimasi();
			$data['countpengolahan'] = $this->admin->get_countpengolahan();
			$data['countpengoperasian'] = $this->admin->get_countpengoperasian();
			$data['countpelayanan'] = $this->admin->get_countpelayanan();
			$data['countrpl'] = $this->admin->get_countrpl();
			$data['counttkj'] = $this->admin->get_counttkj();
			$data['countmm'] = $this->admin->get_countmm();
			$data['countpkm'] = $this->admin->get_countpkm();
			$data['asesionline'] = $this->db->query("SELECT * FROM tbl_siswa sis WHERE sis.status = '1'")->result();
			$data['asesioffline'] = $this->db->query("SELECT * FROM tbl_siswa sis WHERE sis.status = '0'")->result();
			$data['asesoronline'] = $this->db->query("SELECT * FROM tbl_user user WHERE user.status = '1'")->result();
			$data['asesoroffline'] = $this->db->query("SELECT * FROM tbl_user user WHERE user.status = '0'")->result();

			$this->load->view('templates_asesor/header', $data);
			$this->load->view('templates_asesor/sidebar', $data);
			$this->load->view('asesor/dashboard', $data);
			$this->load->view('templates_asesor/footer_dashboard_rpl', $data);
		}
	}

	public function log_in()
	{
		$sess = $this->session->userdata('id_asesor');

		if ($sess != NULL) {
			$this->load->view('404_content');
		} else {
			$this->load->view('asesor/login/login');

			if (isset($_POST['btnlogin'])) {
				$send = array(
					'username'	=> $this->input->post('username'),
					'password'	=> $this->input->post('password')
				);
				$auth	= $this->asesor->auth($send);

				if ($auth['sum'] == 0) {
					$this->session->set_flashdata('msg', $this->err->wrong_admin_auth($sess));
					redirect('panel_asesor/log_in');
				} else {
					if ($auth['res']->level == 'asesor') {
						$this->session->set_userdata('asesor', $auth['res']->level);
						$this->session->set_userdata('id_asesor', $auth['res']->username);
						$this->session->set_userdata('idd', $auth['res']->id_user);

						$data = array(
							'status' => '1'
						);

						$where = array(
							'id_user' => $auth['res']->id_user
						);
						$this->web->update_data('tbl_user', $data, $where);
						$this->session->set_flashdata('msglogin', 'Anda Berhasil Login Sebagai Asesor!');
						redirect('panel_asesor');
					} else {
						$this->session->set_flashdata('msg', $this->err->wrong_admin_auth($sess));
						redirect('panel_asesor/log_in');
					}
				}
			}
		}
	}

	public function logs()
	{
		$sess = $this->session->userdata('id_asesor');

		if ($sess != NULL) {
			$this->load->view('404_content');
		} else {
			$this->load->view('asesor/login/header_login');
			$this->load->view('asesor/login/login');
			$this->load->view('asesor/login/footer');

			if (isset($_POST['btnlogin'])) {
				$send = array(
					'username'	=> $this->input->post('username'),
					'password'	=> $this->input->post('password')
				);
				$auth	= $this->asesor->auth($send);

				if ($auth['sum'] == 0) {
					$this->session->set_flashdata('msg', $this->err->wrong_admin_auth($sess));
					redirect('panel_asesor/log_in');
				} else {
					$this->session->set_userdata('asesor', $auth['res']->level);
					$this->session->set_userdata('id_asesor', $auth['res']->username);
					redirect('panel_asesor');
				}
			}
		}
	}

	public function profile()
	{
		$sess = $this->session->userdata('id_asesor');

		if ($sess == NULL) {
			redirect('panel_asesor/log_in');
		} else {
			$data = array(
				'user'		=> $this->asesor->base('bio', $this->session->userdata('id_asesor')),
				'judul_web'	=> "Profil"
			);

			$this->load->view('templates_asesor/header', $data);
			$this->load->view('templates_asesor/sidebar', $data);
			$this->load->view('asesor/profile', $data);
			$this->load->view('templates_asesor/footer');

			if (isset($_POST['btnupdate'])) {

				$data = array(
					'old_user'		=> $this->session->userdata('id_asesor'),
					'username'		=> $this->input->post('username'),
					'nama_lengkap'	=> $this->input->post('nama_lengkap'),
					'alamat'		=> $this->input->post('alamat'),
					'telp'			=> $this->input->post('telp'),
					'email'			=> $this->input->post('email'),
					'kab_sekolah'	=> $this->input->post('kab_sekolah'),
					'ketua_panitia'	=> $this->input->post('ketua_panitia'),
					'nip_ketua'		=> $this->input->post('nip_ketua'),
					'website'		=> $this->input->post('website'),
					'th_pelajaran'	=> $this->input->post('th_pelajaran'),
					'no_surat'		=> $this->input->post('no_surat'),
					'kepsek'		=> $this->input->post('kepsek'),
					'nip_kepsek'	=> $this->input->post('nip_kepsek')
				);

				$acts = $this->asesor->about_me('update', $data);

				$this->session->has_userdata('id_asesor');
				$this->session->set_userdata('id_asesor', $data['username']);

				$this->session->set_flashdata('msg', $this->err->update_admin('username'));

				redirect('panel_asesor/profile');
			}
		}
	}


	public function ubah_pass()
	{
		$sess = $this->session->userdata('id_asesor');
		if ($sess == NULL) {
			redirect('panel_asesor/log_in');
		} else {
			$data = array(
				'user' 		=> $this->asesor->base('bio', $this->session->userdata('id_asesor')),
				'judul_web'	=> "UBAH PASSWORD"
			);

			$this->load->view('asesor/header', $data);
			$this->load->view('asesor/ubah_pass', $data);
			$this->load->view('asesor/footer');

			if (isset($_POST['btnupdate2'])) {
				$send = array(
					'plama'	=> $this->input->post('password_lama'),
					'pbaru'	=> $this->input->post('password'),
					'pconf'	=> $this->input->post('password2')
				);

				if ($data['user']->password != $send['plama']) {
					$this->session->set_flashdata('msg2', $this->err->update_admin('password-notmatch'));
				} else if ($send['pbaru'] != $send['pconf']) {
					$this->session->set_flashdata('msg2', $this->err->update_admin('password-notconfirmed'));
				} else {
					$data = array(
						'old_user'	=> $sess,
						'password'	=> $send['pbaru']
					);
					$acts = $this->asesor->about_me('update-pass', $data);

					$this->session->set_flashdata('msg2', $this->err->update_admin('password-success'));
				}
				redirect('panel_asesor/ubah_pass');
			}
		}
	}

	public function verifikasi($aksi = '', $id = '')
	{
		$idd = $this->session->userdata('idd');
		$sess = $this->session->userdata('id_asesor');
		if ($sess == NULL) {
			redirect('panel_asesor/log_in');
		} else {
			switch ($aksi) {
				case 'cek':
					$cek_status = $this->siswa->base_biodata($id);
					$data = array(
						'id'				=> $id,
						'status_verifikasi'	=> ($cek_status->status_verifikasi == 2) ? 1 : 2
					);
					$acts = $this->asesor->update('change-stu-verif', $data);
					redirect('panel_asesor/verifikasi');
					break;

				case 'lulus':
					$cek_status = $this->siswa->base_biodata($id);
					$data = array(
						'id'					=> $id,
						'status_pendaftaran'	=> ($cek_status->status_pendaftaran == NULL) ? 1 : NULL
					);
					$acts = $this->asesor->update('change-lulus-verif', $data);
					$this->session->set_flashdata('msg', 'Data berhasil diubah!');
					redirect('panel_asesor/verifikasi');
					break;

				default:
					$thn = date('Y');
					break;
			}

			$data = array(
				'user' 		=> $this->asesor->base('bio', $this->session->userdata('id_asesor')),
				'judul_web'	=> "VERIFIKASI",
				'v_siswarpl'	=> $this->db->query("SELECT * FROM tbl_siswa WHERE id_komp >= '1' AND id_komp <='3' ORDER BY id_siswa DESC"),
				'v_siswatkj'	=> $this->db->query("SELECT * FROM tbl_siswa WHERE id_komp >= '4' AND id_komp <='6' ORDER BY id_siswa DESC"),
				'v_siswamm'		=> $this->db->query("SELECT * FROM tbl_siswa WHERE id_komp >= '7' AND id_komp <='10' ORDER BY id_siswa DESC"),
				'v_siswapkm'	=> $this->db->query("SELECT * FROM tbl_siswa WHERE id_komp >= '11' AND id_komp <='12' ORDER BY id_siswa DESC"),
				'v_thn'		=> $thn
			);

			$data['v_siswa'] = $this->db->query("SELECT * FROM tbl_jadwalevent 
			inner join tbl_siswa on tbl_jadwalevent.id_asesi = tbl_siswa.id_siswa
			inner join tbl_skema_sertifikasi on tbl_siswa.id_skema_sertifikasi = tbl_skema_sertifikasi.id_skema_sertifikasi 
			WHERE tbl_siswa.status_verifikasi = '1' and tbl_siswa.status_pendaftaran IS null and tbl_jadwalevent.id_asesor = '$idd' or tbl_siswa.status_verifikasi = '2' and tbl_siswa.status_pendaftaran IS null and tbl_jadwalevent.id_asesor = '$idd' ORDER BY tbl_siswa.id_siswa DESC ")->result();

			$this->load->view('templates_asesor/header', $data);
			$this->load->view('templates_asesor/sidebar', $data);
			$this->load->view('asesor/verifikasi/verifikasi', $data);
			$this->load->view('templates_asesor/footer');
		}
	}

	public function edit_materi($aksi = '', $id = '')
	{
		$sess = $this->session->userdata('id_asesor');
		if ($sess == NULL) {
			redirect('panel_asesor/log_in');
		} else {
			$data = array(
				'user'		=> $this->asesor->base('bio', $sess),
				'judul_web'	=> "MATERI & UJIAN",
				'v_materi'	=> $this->asesor->verifikasi('materi')
			);

			$this->load->view('asesor/header', $data);
			$this->load->view('asesor/verifikasi/verifikasi_edit_materi&jadwal', $data);
			$this->load->view('asesor/footer');

			if (isset($_POST['btnupdate'])) {
				$data = array(
					'isi'	=> $this->input->post('isi')
				);
				$acts = $this->asesor->update('teks-verifikasi', $data);

				$this->session->set_flashdata('msg', $this->err->update_admin('materi'));
				redirect('panel_asesor/verifikasi');
			}
		}
	}

	public function verifikasi_cetak($id = '')
	{
		$sess = $this->session->userdata('id_asesor');
		if ($sess == NULL) {
			redirect('panel_asesor/log_in');
		}
		$data = array(
			'user'			=> $this->siswa->base_biodata($id),
			'judul_web'		=> "CETAK_VERIFIKASI_" . ucwords($this->siswa->base_biodata($id)->no_pendaftaran),
			'thn_ppdb'		=> date('Y', strtotime($this->siswa->base_biodata($id)->tgl_siswa)),
			'v_materi'		=> $this->asesor->verifikasi('materi')
		);

		$this->load->view('asesor/verifikasi/cetak', $data);
	}

	public function edit($aksi = '', $id = '')
	{
		$sess = $this->session->userdata('id_asesor');
		if ($sess == NULL) {
			redirect('panel_asesor/log_in');
		} else {
			switch ($aksi) {
				case 'cek':
					$cek_status = $this->siswa->base_biodata($id);
					$data = array(
						'id'				=> $id,
						'status_verifikasi'	=> ($cek_status->status_verifikasi == 1) ? 0 : 1
					);
					$acts = $this->asesor->update('change-stu-verif', $data);
					redirect('panel_asesor/edit');
					break;

				case 'thn':
					$thn = $id;
					break;

				default:
					$thn = date('Y');
					break;
			}

			$data = array(
				'user' 		=> $this->asesor->base('bio', $this->session->userdata('id_asesor')),
				'judul_web'	=> "EDIT ASESOR",
				'v_siswa'	=> $this->asesor->verifikasi('siswa', $thn)->ori,
				'v_thn'		=> $thn
			);
			$data['asesor'] = $this->web->get_data('tbl_user')->result();

			$this->load->view('asesor/header', $data);
			$this->load->view('asesor/edit/edit', $data);
			$this->load->view('asesor/footer');
		}
	}

	public function sertifikasi_mandiri($id)
	{
		$data['signature'] = $this->db->query("SELECT * FROM tbl_signature sig INNER JOIN tbl_siswa sis ON sig.no_pendaftaran = sis.no_pendaftaran WHERE sis.id_siswa='$id'")->result();
		$data['siswa'] = $this->db->query("SELECT * FROM tbl_siswa WHERE tbl_siswa.id_siswa='$id'")->row();
		$data['kompetensi_pemdas'] = $this->db->query("SELECT * FROM tbl_pemdas INNER JOIN tbl_siswa ON tbl_siswa.id_siswa = tbl_pemdas.id_siswa WHERE tbl_pemdas.id_siswa='$id'")->result();
		$data['kompetensi_pemweb'] = $this->db->query("SELECT * FROM tbl_pemweb INNER JOIN tbl_siswa ON tbl_siswa.id_siswa = tbl_pemweb.id_siswa WHERE tbl_pemweb.id_siswa='$id'")->result();
		$data['kompetensi_pbo'] = $this->db->query("SELECT * FROM tbl_pbo INNER JOIN tbl_siswa ON tbl_siswa.id_siswa = tbl_pbo.id_siswa WHERE tbl_pbo.id_siswa='$id'")->result();
		$data['kompetensi_audiovideo'] = $this->db->query("SELECT * FROM tbl_audiovideo INNER JOIN tbl_siswa ON tbl_siswa.id_siswa = tbl_audiovideo.id_siswa WHERE tbl_audiovideo.id_siswa='$id'")->result();
		$data['kompetensi_animasi2d'] = $this->db->query("SELECT * FROM tbl_animasi2d INNER JOIN tbl_siswa ON tbl_siswa.id_siswa = tbl_animasi2d.id_siswa WHERE tbl_animasi2d.id_siswa='$id'")->result();
		$data['kompetensi_desainpercetakan'] = $this->db->query("SELECT * FROM tbl_desainpercetakan INNER JOIN tbl_siswa ON tbl_siswa.id_siswa = tbl_desainpercetakan.id_siswa WHERE tbl_desainpercetakan.id_siswa='$id'")->result();
		$data['kompetensi_desaingrafis'] = $this->db->query("SELECT * FROM tbl_desaingrafis INNER JOIN tbl_siswa ON tbl_siswa.id_siswa = tbl_desaingrafis.id_siswa WHERE tbl_desaingrafis.id_siswa='$id'")->result();
		$data['kompetensi_konfigurasirouting'] = $this->db->query("SELECT * FROM tbl_konfigurasirouting INNER JOIN tbl_siswa ON tbl_siswa.id_siswa = tbl_konfigurasirouting.id_siswa WHERE tbl_konfigurasirouting.id_siswa='$id'")->result();
		$data['kompetensi_konfigurasiperangkat'] = $this->db->query("SELECT * FROM tbl_konfigurasiperangkat INNER JOIN tbl_siswa ON tbl_siswa.id_siswa = tbl_konfigurasiperangkat.id_siswa WHERE tbl_konfigurasiperangkat.id_siswa='$id'")->result();
		$data['kompetensi_instalasijaringan'] = $this->db->query("SELECT * FROM tbl_instalasijaringan INNER JOIN tbl_siswa ON tbl_siswa.id_siswa = tbl_instalasijaringan.id_siswa WHERE tbl_instalasijaringan.id_siswa='$id'")->result();
		$data['kompetensi_pengoperasianaplikasi'] = $this->db->query("SELECT * FROM tbl_pengoperasianaplikasi INNER JOIN tbl_siswa ON tbl_siswa.id_siswa = tbl_pengoperasianaplikasi.id_siswa WHERE tbl_pengoperasianaplikasi.id_siswa='$id'")->result();
		$data['kompetensi_pelayananperbankan'] = $this->db->query("SELECT * FROM tbl_pelayananperbankan INNER JOIN tbl_siswa ON tbl_siswa.id_siswa = tbl_pelayananperbankan.id_siswa WHERE tbl_pelayananperbankan.id_siswa='$id'")->result();
		if ($data['siswa']->id_komp == 12) {
			$this->load->view('asesor/formapl02/pelayananperbankan', $data);
		}
		if ($data['siswa']->id_komp == 11) {
			$this->load->view('asesor/formapl02/pengoperasianaplikasi', $data);
		}
		if ($data['siswa']->id_komp == 10) {
			$this->load->view('asesor/formapl02/audiovideo', $data);
		}
		if ($data['siswa']->id_komp == 9) {
			$this->load->view('asesor/formapl02/animasi2d', $data);
		}
		if ($data['siswa']->id_komp == 8) {
			$this->load->view('asesor/formapl02/desainpercetakan', $data);
		}
		if ($data['siswa']->id_komp == 7) {
			$this->load->view('asesor/formapl02/desaingrafis', $data);
		}
		if ($data['siswa']->id_komp == 6) {
			$this->load->view('asesor/formapl02/konfigurasirouting', $data);
		}
		if ($data['siswa']->id_komp == 5) {
			$this->load->view('asesor/formapl02/konfigurasiperangkat', $data);
		}
		if ($data['siswa']->id_komp == 4) {
			$this->load->view('asesor/formapl02/instalasijaringan', $data);
		}
		if ($data['siswa']->id_komp == 3) {
			$this->load->view('asesor/formapl02/pbo', $data);
		}
		if ($data['siswa']->id_komp == 2) {
			$this->load->view('asesor/formapl02/pemweb', $data);
		}
		if ($data['siswa']->id_komp == 1) {
			$this->load->view('asesor/formapl02/pemdas', $data);
		}
	}

	public function download_kartupelajar($id)
	{
		$this->load->helper('download');
		$filebukti = $this->download->download_bukti($id);
		$files = 'assets/upload/' . $filebukti['kartu_pelajar'];
		force_download($files, NULL);
	}

	public function download_raport($id)
	{
		$this->load->helper('download');
		$filebukti = $this->download->download_bukti($id);
		$files = 'assets/upload/' . $filebukti['raport'];
		force_download($files, NULL);
	}

	public function download_kartukeluarga($id)
	{
		$this->load->helper('download');
		$filebukti = $this->download->download_bukti($id);
		$files = 'assets/upload/' . $filebukti['kartu_keluarga'];
		force_download($files, NULL);
	}

	public function download_pasphoto($id)
	{
		$this->load->helper('download');
		$filebukti = $this->download->download_bukti($id);
		$files = 'assets/upload/' . $filebukti['pas_photo'];
		force_download($files, NULL);
	}

	public function download_sertifikatpendukung($id)
	{
		$this->load->helper('download');
		$filebukti = $this->download->download_bukti($id);
		$files = 'assets/upload/' . $filebukti['sertifikat_pendukung'];
		force_download($files, NULL);
	}

	public function set_pengumuman($aksi = '', $id = '')
	{
		$idd = $this->session->userdata('idd');
		$sess = $this->session->userdata('id_asesor');
		if ($sess == NULL) {
			redirect('panel_asesor/log_in');
		} else {

			switch ($aksi) {
				case 'lulus':
					$this->asesor->set_announce($aksi, $id);
					$this->session->set_flashdata('msg', 'Di Lulus kan');
					redirect('panel_asesor/set_pengumuman');
					break;

				case 'tdk_lulus':
					$this->asesor->set_announce($aksi, $id);
					$this->session->set_flashdata('msg', 'Di Tidak Lulus kan');
					redirect('panel_asesor/set_pengumuman');
					break;

				case 'batal':
					$this->asesor->set_announce($aksi, $id);
					$this->session->set_flashdata('msg', 'Kelulusan berhasil dibatalkan!');
					redirect('panel_asesor/set_pengumuman');
					break;

				default:
					$thn = $this->asesor->set_announce($aksi, $id);
					break;
			}



			$data = array(
				'user'		    => $this->asesor->base('bio', $sess),
				'judul_web'	    => "KELULUSAN",
				'v_siswarpl'	=> $this->asesor->verifikasirpl('siswa', $id)->ori,
				'v_siswatkj'	=> $this->asesor->verifikasitkj('siswa', $id)->ori,
				'v_siswamm'	    => $this->asesor->verifikasimm('siswa', $id)->ori,
				'v_siswapkm'	=> $this->asesor->verifikasipkm('siswa', $id)->ori,
				'v_thn'		    => $thn,
				'asesor'        => $this->web->get_data('tbl_user')->result()
			);

			$data['v_siswa'] = $this->db->query("SELECT * FROM tbl_jadwalevent 
			inner join tbl_siswa on tbl_jadwalevent.id_asesi = tbl_siswa.id_siswa
			inner join tbl_skema_sertifikasi on tbl_siswa.id_skema_sertifikasi = tbl_skema_sertifikasi.id_skema_sertifikasi 
			WHERE tbl_siswa.status_verifikasi = '2' and tbl_siswa.status_pendaftaran = '1' and tbl_jadwalevent.id_asesor = '$idd' ORDER BY tbl_siswa.id_siswa DESC ")->result();

			$this->load->view('templates_asesor/header', $data);
			$this->load->view('templates_asesor/sidebar', $data);
			$this->load->view('asesor/set_pengumuman/set_pengumuman', $data);
			$this->load->view('templates_asesor/footer');
		}
	}

	public function edit_ket($aksi = '', $id = '')
	{
		$sess = $this->session->userdata('id_asesor');
		if ($sess == NULL) {
			redirect('panel_asesor/log_in');
		} else {
			$data = array(
				'user'		=> $this->asesor->base('bio', $sess),
				'judul_web'	=> "KETERANGAN LULUS",
				'v_ket'		=> $this->asesor->get_announce(),
				'asesor'    => $this->web->get_data('tbl_user')->result()
			);

			$this->load->view('asesor/header', $data);
			$this->load->view('asesor/set_pengumuman/set_keterangan', $data);
			$this->load->view('asesor/footer');

			if (isset($_POST['btnupdate'])) {
				$this->asesor->update('announce-edited', $this->input);

				$this->session->set_flashdata('msg', $this->err->update_admin('announce-edited'));
				redirect('panel_asesor/set_pengumuman');
			}
		}
	}

	public function logout()
	{
		if ($this->session->has_userdata('id_asesor') != '' and $this->session->has_userdata('asesor') != '') {
			$data = array(
				'status' => '0'
			);

			$where = array(
				'username' => $this->session->userdata('id_asesor')
			);
			$this->web->update_data('tbl_user', $data, $where);
			$this->session->sess_destroy();
		}
		redirect('panel_asesor/log_in');
	}

	public function delete($id_siswa)
	{
		$this->asesor->delete($id_siswa);
		// return redirect()->to('/panel_admin/verifikasi');
	}

	public function data_asesi()
	{
		$sess = $this->session->userdata('id_asesor');
		$idd = $this->session->userdata('idd');
		if ($sess == NULL) {
			redirect('panel_asesor/log_in');
		} else {
			$data = array(
				'user'		=> $this->asesor->base('bio', $sess),
				'judul_web'	=> "DATA ASESI"
			);
			$data['asesor'] = $this->web->get_data('tbl_user')->result();

			$data['asesi'] = $this->db->query("SELECT *  FROM tbl_jadwalevent 
		inner join tbl_siswa on tbl_jadwalevent.id_asesi = tbl_siswa.id_siswa 
		inner join tbl_skema_sertifikasi on tbl_siswa.id_skema_sertifikasi = tbl_skema_sertifikasi.id_skema_sertifikasi 
		where tbl_jadwalevent.id_asesor = '$idd'")->result();

			$this->load->view('templates_asesor/header', $data);
			$this->load->view('templates_asesor/sidebar', $data);
			$this->load->view('asesor/data_asesi', $data);
			$this->load->view('templates_asesor/footer');
		}
	}

	public function detail_asesi($id)
	{
		$sess = $this->session->userdata('id_asesor');
		if ($sess == NULL) {
			redirect('panel_asesor/log_in');
		} else {
			$data = array(
				'user'		=> $this->asesor->base('bio', $sess),
				'judul_web'	=> "DETAIL ASESI"
			);

			$data['detail'] = $this->db->query("SELECT * FROM tbl_siswa 
		left join tbl_skema_sertifikasi on tbl_siswa.id_skema_sertifikasi = tbl_skema_sertifikasi.id_skema_sertifikasi
		 WHERE tbl_siswa.id_siswa = '$id'")->row();
			$this->load->view('templates_asesor/header', $data);
			$this->load->view('templates_asesor/sidebar', $data);
			$this->load->view('asesor/detail_asesi', $data);
			$this->load->view('templates_asesor/footer');
		}
	}

	public function update_asesi($id)
	{
		$where = array('id_siswa' => $id);
		$sess = $this->session->userdata('id_asesor');
		if ($sess == NULL) {
			redirect('panel_asesor/log_in');
		} else {
			$data = array(
				'user'		=> $this->asesor->base('bio', $sess),
				'judul_web'	=> "UBAH DATA ASESI"
			);

			$data['asesi'] = $this->db->query("SELECT * FROM tbl_siswa INNER JOIN tbl_komp ON tbl_siswa.id_komp = tbl_komp.id_komp WHERE id_siswa = '$id'")->result();
			$data['kompetensi'] = $this->db->query("SELECT * FROM tbl_komp")->result();
			$this->load->view('templates_asesor/header', $data);
			$this->load->view('templates_asesor/sidebar', $data);
			$this->load->view('asesor/form_update_asesi', $data);
			$this->load->view('templates_asesor/footer');
		}
	}


	public function _rules()
	{
		$this->form_validation->set_rules('id_siswa', 'No Pendaftaran', 'required');
		$this->form_validation->set_rules('tgl_siswa', 'No Pendaftaran', 'required');
		$this->form_validation->set_rules('no_pendaftaran', 'Pendaftaran', 'required');
		$this->form_validation->set_rules('password', 'Pendaftaran', 'required');
		$this->form_validation->set_rules('nis', 'Pendaftaran', 'required');
		$this->form_validation->set_rules('nisn', 'Pendaftaran', 'required');
		$this->form_validation->set_rules('nik', 'Pendaftaran', 'required');
		$this->form_validation->set_rules('nama_lengkap', 'Pendaftaran', 'required');
		$this->form_validation->set_rules('jk', 'Pendaftaran', 'required');
		$this->form_validation->set_rules('tempat_lahir', 'Pendaftaran', 'required');
		$this->form_validation->set_rules('tgl_lahir', 'Pendaftaran', 'required');
		$this->form_validation->set_rules('alamat_siswa', 'Pendaftaran', 'required');
		$this->form_validation->set_rules('jenis_tinggal', 'Pendaftaran', 'required');
		$this->form_validation->set_rules('desa', 'Pendaftaran', 'required');
		$this->form_validation->set_rules('kec', 'Pendaftaran', 'required');
		$this->form_validation->set_rules('kab', 'Pendaftaran', 'required');
		$this->form_validation->set_rules('prov', 'Pendaftaran', 'required');
		$this->form_validation->set_rules('kode_pos', 'Pendaftaran', 'required');
		$this->form_validation->set_rules('no_hp_siswa', 'Pendaftaran', 'required');
		$this->form_validation->set_rules('email', 'Pendaftaran', 'required');
		$this->form_validation->set_rules('id_komp', 'Pendaftaran', 'required');
		$this->form_validation->set_rules('nama_perusahaan', 'Pendaftaran', 'required');
		$this->form_validation->set_rules('alamat_perusahaan', 'Pendaftaran', 'required');
		$this->form_validation->set_rules('email_perusahaan', 'Pendaftaran', 'required');
		$this->form_validation->set_rules('jabatan', 'Pendaftaran', 'required');
		$this->form_validation->set_rules('no_fax', 'Pendaftaran', 'required');
		$this->form_validation->set_rules('no_telp_perusahaan', 'Pendaftaran', 'required');
		$this->form_validation->set_rules('tujuan_asesmen', 'Pendaftaran', 'required');
	}

	public function update_asesi_aksi()
	{
		$id = $this->input->post('id_siswa');
		$this->_rules();
		if ($this->form_validation->run() == FALSE) {
			$this->update_asesi($id);
		} else {
			$id = $this->input->post('id_siswa');
			$no_pendaftaran = $this->input->post('no_pendaftaran');
			$password = $this->input->post('password');
			$nis = $this->input->post('nis');
			$nisn = $this->input->post('nisn');
			$nik = $this->input->post('nik');
			$nama_lengkap = $this->input->post('nama_lengkap');
			$jk = $this->input->post('jk');
			$pd_terakhir = $this->input->post('pd_terakhir');
			$tempat_lahir = $this->input->post('tempat_lahir');
			$tgl_lahir = $this->input->post('tgl_lahir');
			$agama = $this->input->post('agama');
			$alamat_siswa = $this->input->post('alamat_siswa');
			$jenis_tinggal = $this->input->post('jenis_tinggal');
			$desa = $this->input->post('desa');
			$kec = $this->input->post('kec');
			$kab = $this->input->post('kab');
			$prov = $this->input->post('prov');
			$kode_pos = $this->input->post('kode_pos');
			$no_hp_siswa = $this->input->post('no_hp_siswa');
			$email = $this->input->post('email');
			$id_komp = $this->input->post('id_komp');
			$tgl_siswa = $this->input->post('tgl_siswa');
			$status_verifikasi = $this->input->post('status_verifikasi');
			$status_pendaftaran = $this->input->post('status_pendaftaran');
			$kartu_pelajar = $this->input->post('kartu_pelajar');
			$raport = $this->input->post('raport');
			$kartu_keluarga = $this->input->post('kartu_keluarga');
			$pas_photo = $this->input->post('pas_photo');
			$sertifikat_pendukung = $this->input->post('sertifikat_pendukung');
			$nama_perusahaan = $this->input->post('nama_perusahaan');
			$jabatan = $this->input->post('jabatan');
			$alamat_perusahaan = $this->input->post('alamat_perusahaan');
			$no_telp_perusahaan = $this->input->post('no_telp_perusahaan');
			$no_fax = $this->input->post('no_fax');
			$email_perusahaan = $this->input->post('email_perusahaan');
			$tujuan_asesmen = $this->input->post('tujuan_asesmen');

			$data = array(
				'no_pendaftaran' => $no_pendaftaran,
				'password' => $password,
				'nis' => $nis,
				'nisn' => $nisn,
				'nik' => $nik,
				'nama_lengkap' => $nama_lengkap,
				'jk' => $jk,
				'pd_terakhir' => $pd_terakhir,
				'tempat_lahir' => $tempat_lahir,
				'tgl_lahir' => $tgl_lahir,
				'agama' => $agama,
				'alamat_siswa' => $alamat_siswa,
				'jenis_tinggal' => $jenis_tinggal,
				'desa' => $desa,
				'kec' => $kec,
				'kab' => $kab,
				'prov' => $prov,
				'kode_pos' => $kode_pos,
				'no_hp_siswa' => $no_hp_siswa,
				'email' => $email,
				'id_komp' => $id_komp,
				'tgl_siswa' => $tgl_siswa,
				'status_verifikasi' => $status_verifikasi,
				'status_pendaftaran' => $status_pendaftaran,
				'kartu_pelajar' => $kartu_pelajar,
				'raport' => $raport,
				'kartu_keluarga' => $kartu_keluarga,
				'pas_photo' => $pas_photo,
				'sertifikat_pendukung' => $sertifikat_pendukung,
				'nama_perusahaan' => $nama_perusahaan,
				'no_telp_perusahaan' => $no_telp_perusahaan,
				'no_fax' => $no_fax,
				'email_perusahaan' => $email_perusahaan,
				'tujuan_asesmen' => $tujuan_asesmen
			);

			$where = array(
				'id_siswa' => $id
			);
			$this->web->update_data('tbl_siswa', $data, $where);
			$this->session->set_flashdata('msg', 'Data Asesi Berhasil Diubah!');
			redirect('panel_asesor/data_asesi');
		}
	}

	public function delete_asesi($id)
	{
		$where = array('id_siswa' => $id);
		$this->web->delete_data($where, 'tbl_siswa');
		$this->session->set_flashdata('msg', 'Data Asesi Berhasil Dihapus!');
		redirect('panel_asesor/data_asesi');
	}

	public function kirim_pesan($aksi = '', $id = '')
	{
		$sess = $this->session->userdata('id_asesor');
		if ($sess == NULL) {
			redirect('panel_asesor/log_in');
		} else {
			$data = array(
				'user'		=> $this->asesor->base('bio', $sess),
				'judul_web'	=> "Kirim Pesan"
			);
			$data['asesirpl'] = $this->db->query("SELECT * FROM tbl_siswa WHERE id_komp >= '1' AND id_komp <= '3' ORDER BY id_siswa DESC")->result();
			$data['asesitkj'] = $this->db->query("SELECT * FROM tbl_siswa WHERE id_komp >= '4' AND id_komp <= '6' ORDER BY id_siswa DESC")->result();
			$data['asesimm'] = $this->db->query("SELECT * FROM tbl_siswa WHERE id_komp >= '7' AND id_komp <= '10' ORDER BY id_siswa DESC")->result();
			$data['asesipkm'] = $this->db->query("SELECT * FROM tbl_siswa WHERE id_komp >= '11' AND id_komp <= '12' ORDER BY id_siswa DESC")->result();
			$this->load->view('templates_asesor/header', $data);
			$this->load->view('templates_asesor/sidebar', $data);
			$this->load->view('asesor/kirim_pesan', $data);
			$this->load->view('templates_asesor/footer');
		}
	}

	public function kirim_pesan_asesi($id)
	{
		$where = array('id_siswa' => $id);
		$sess = $this->session->userdata('id_asesor');
		if ($sess == NULL) {
			redirect('panel_asesor/log_in');
		} else {
			$data = array(
				'user'		=> $this->asesor->base('bio', $sess),
				'judul_web'	=> "Kirim Pesan ke Asesi"
			);

			$data['asesi'] = $this->db->query("SELECT * FROM tbl_siswa WHERE id_siswa = '$id'")->result();
			$this->load->view('templates_asesor/header', $data);
			$this->load->view('templates_asesor/sidebar', $data);
			$this->load->view('asesor/form_kirim_pesan', $data);
			$this->load->view('templates_asesor/footer');
		}
	}

	public function kirim_pesan_aksi()
	{
		date_default_timezone_set("Asia/Jakarta");
		$id_user = $this->input->post('id_user');
		$id_siswa = $this->input->post('id_siswa');
		$no_pendaftaran = $this->input->post('no_pendaftaran');
		$nama_lengkap = $this->input->post('nama_lengkap');
		$nama_lengkap_asesi = $this->input->post('nama_lengkap_asesi');
		$pesan = $this->input->post('pesan');
		$email = $this->input->post('email');
		$waktu = date_create('now')->format('Y-m-d H:i:s');

		// Instantiation and passing `true` enables exceptions
		$mail = new PHPMailer(true);
		//Server settings
		// $mail->SMTPDebug = SMTP::DEBUG_SERVER;                   // Enable verbose debug output
		$mail->isSMTP();                                            // Send using SMTP
		$mail->Host       = 'smtp.gmail.com';                    	// Set the SMTP server to send through
		$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
		$mail->Username   = 'hernuwandicky@gmail.com';            // SMTP username
		$mail->Password   = 'qsixlwvxiggevixs';                         // SMTP password
		// $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;      // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
		$mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

		//Recipients
		$mail->setFrom($email, 'LSP Lalinsa');
		$mail->addAddress($email, $nama_lengkap_asesi);     // Add a recipient

		$mail->addReplyTo($email, 'LSP Lalinsa');
		// $mail->addCC('cc@example.com');
		// $mail->addBCC('bcc@example.com');

		// Attachments
		// $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

		// Content
		$mail->isHTML(true);                                  // Set email format to HTML
		$mail->Subject = 'Pesan Dari Asesor ' . $nama_lengkap . ' LSP Lalinsa';
		$mail->Body    = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
			<head>
			<!--[if gte mso 9]>
			<xml>
			  <o:OfficeDocumentSettings>
				<o:AllowPNG/>
				<o:PixelsPerInch>96</o:PixelsPerInch>
			  </o:OfficeDocumentSettings>
			</xml>
			<![endif]-->
			  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
			  <meta name="viewport" content="width=device-width, initial-scale=1.0">
			  <meta name="x-apple-disable-message-reformatting">
			  <!--[if !mso]><!--><meta http-equiv="X-UA-Compatible" content="IE=edge"><!--<![endif]-->
			  <title></title>
			  
				<style type="text/css">
				  table, td { color: #000000; } a { color: #e67e23; text-decoration: underline; } @media (max-width: 480px) { #u_content_image_1 .v-src-width { width: auto !important; } #u_content_image_1 .v-src-max-width { max-width: 36% !important; } #u_content_button_1 .v-size-width { width: 93% !important; } }
			@media only screen and (min-width: 620px) {
			  .u-row {
				width: 600px !important;
			  }
			  .u-row .u-col {
				vertical-align: top;
			  }
			
			  .u-row .u-col-100 {
				width: 600px !important;
			  }
			
			}
			
			@media (max-width: 620px) {
			  .u-row-container {
				max-width: 100% !important;
				padding-left: 0px !important;
				padding-right: 0px !important;
			  }
			  .u-row .u-col {
				min-width: 320px !important;
				max-width: 100% !important;
				display: block !important;
			  }
			  .u-row {
				width: calc(100% - 40px) !important;
			  }
			  .u-col {
				width: 100% !important;
			  }
			  .u-col > div {
				margin: 0 auto;
			  }
			}
			body {
			  margin: 0;
			  padding: 0;
			  font-family: "Lato";
			}
			
			table,
			tr,
			td {
			  vertical-align: top;
			  border-collapse: collapse;
			}
			
			p {
			  margin: 0;
			}
			
			.ie-container table,
			.mso-container table {
			  table-layout: fixed;
			}
			
			* {
			  line-height: inherit;
			}
			
			a[x-apple-data-detectors="true"] {
			  color: inherit !important;
			  text-decoration: none !important;
			}
			
			</style>
			  
			  
			
			<!--[if !mso]><!--><link href="https://fonts.googleapis.com/css?family=Lato:400,700&display=swap" rel="stylesheet" type="text/css"><link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&display=swap" rel="stylesheet" type="text/css"><!--<![endif]-->
			
			</head>
			
			<body class="clean-body u_body" style="margin: 0;padding: 0;-webkit-text-size-adjust: 100%;background-color: #081933;color: #000000">
			  <!--[if IE]><div class="ie-container"><![endif]-->
			  <!--[if mso]><div class="mso-container"><![endif]-->
			  <table style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;min-width: 320px;Margin: 0 auto;background-color: #081933;width:100%" cellpadding="0" cellspacing="0">
			  <tbody>
			  <tr style="vertical-align: top">
				<td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
				<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td align="center" style="background-color: #081933;"><![endif]-->
				
			
			<div class="u-row-container" style="padding: 0px;background-color: transparent">
			  <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
				<div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
				  <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px;"><tr style="background-color: transparent;"><![endif]-->
				  
			<!--[if (mso)|(IE)]><td align="center" width="600" style="width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;" valign="top"><![endif]-->
			<div class="u-col u-col-100" style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
			  <div style="width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
			  <!--[if (!mso)&(!IE)]><!--><div style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;"><!--<![endif]-->
			  
			<table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
			  <tbody>
				<tr>
				  <td style="overflow-wrap:break-word;word-break:break-word;padding:10px;" align="left">
					
			  <table height="0px" align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;border-top: 0px solid #BBBBBB;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
				<tbody>
				  <tr style="vertical-align: top">
					<td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;font-size: 0px;line-height: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
					  <span>&#160;</span>
					</td>
				  </tr>
				</tbody>
			  </table>
			
				  </td>
				</tr>
			  </tbody>
			</table>
			
			  <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
			  </div>
			</div>
			<!--[if (mso)|(IE)]></td><![endif]-->
				  <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
				</div>
			  </div>
			</div>
			
			
			
			<div class="u-row-container" style="padding: 0px;background-color: transparent">
			  <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
				<div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
				  <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px;"><tr style="background-color: transparent;"><![endif]-->
				  
			<!--[if (mso)|(IE)]><td align="center" width="600" style="width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;" valign="top"><![endif]-->
			<div class="u-col u-col-100" style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
			  <div style="width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
			  <!--[if (!mso)&(!IE)]><!--><div style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;"><!--<![endif]-->
			  
			<table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
			  <tbody>
				<tr>
				  <td style="overflow-wrap:break-word;word-break:break-word;padding:0px;" align="left">
					
			<table width="100%" cellpadding="0" cellspacing="0" border="0">
			  <tr>
				<td style="padding-right: 0px;padding-left: 0px;" align="center">
				  
				  <img align="center" border="0" src="https://cdn.templates.unlayer.com/assets/1636434047367-bb.png" alt="border" title="border" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 100%;max-width: 600px;" width="600" class="v-src-width v-src-max-width"/>
				  
				</td>
			  </tr>
			</table>
			
				  </td>
				</tr>
			  </tbody>
			</table>
			
			  <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
			  </div>
			</div>
			<!--[if (mso)|(IE)]></td><![endif]-->
				  <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
				</div>
			  </div>
			</div>
			
			
			
			<div class="u-row-container" style="padding: 0px;background-color: transparent">
			  <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ffffff;">
				<div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
				  <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px;"><tr style="background-color: #ffffff;"><![endif]-->
				  
			<!--[if (mso)|(IE)]><td align="center" width="600" style="width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
			<div class="u-col u-col-100" style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
			  <div style="width: 100% !important;">
			  <!--[if (!mso)&(!IE)]><!--><div style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;"><!--<![endif]-->
			  
			<table id="u_content_image_1" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
			  <tbody>
				<tr>
				  <td style="overflow-wrap:break-word;word-break:break-word;padding:5px 10px 30px;" align="left">
					
			<table width="100%" cellpadding="0" cellspacing="0" border="0">
			  <tr>
				<td style="padding-right: 0px;padding-left: 0px;" align="center">
				  <a href="https://unlayer.com" target="_blank">
				  <img align="center" border="0" src="https://i.pinimg.com/originals/87/40/0d/87400d94f257e820c4a8191056a47cda.png" alt="Logo" title="Logo" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 20%;max-width: 116px;" width="116" class="v-src-width v-src-max-width"/>
				  </a>
				</td>
			  </tr>
			</table>
			
				  </td>
				</tr>
			  </tbody>
			</table>
			
			  <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
			  </div>
			</div>
			<!--[if (mso)|(IE)]></td><![endif]-->
				  <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
				</div>
			  </div>
			</div>
			
			
			
			<div class="u-row-container" style="padding: 0px;background-color: transparent">
			  <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ffffff;">
				<div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
				  <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px;"><tr style="background-color: #ffffff;"><![endif]-->
				  
			<!--[if (mso)|(IE)]><td align="center" width="600" style="background-color: #f7f7f7;width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;" valign="top"><![endif]-->
			<div class="u-col u-col-100" style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
			  <div style="background-color: #f7f7f7;width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
			  <!--[if (!mso)&(!IE)]><!--><div style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;"><!--<![endif]-->
			  
			<table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
			  <tbody>
				<tr>
				  <td style="overflow-wrap:break-word;word-break:break-word;padding:15px 10px 40px;" align="left">
					
			  <h1 style="margin: 0px; line-height: 140%; text-align: center; word-wrap: break-word; font-weight: normal; font-size: 28px;">
				<strong>Pesan Dari Asesor ' . $nama_lengkap . '</strong>
			  </h1>
			
				  </td>
				</tr>
			  </tbody>
			</table>
			
			  <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
			  </div>
			</div>
			<!--[if (mso)|(IE)]></td><![endif]-->
				  <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
				</div>
			  </div>
			</div>
			
			
			
			<div class="u-row-container" style="padding: 0px;background-color: transparent">
			  <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #f7f7f7;">
				<div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
				  <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px;"><tr style="background-color: #f7f7f7;"><![endif]-->
				  
			<!--[if (mso)|(IE)]><td align="center" width="600" style="width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;" valign="top"><![endif]-->
			<div class="u-col u-col-100" style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
			  <div style="width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
			  <!--[if (!mso)&(!IE)]><!--><div style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;"><!--<![endif]-->
			  
			<table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
			  <tbody>
				<tr>
				  <td style="overflow-wrap:break-word;word-break:break-word;padding:10px 44px 30px;" align="center">
					
			  <div style="color: #333333; line-height: 200%; text-align: left; word-wrap: break-word;">
			<p style="line-height: 200%; font-size: 14px; text-align:center"><span style="font-size: 26px; line-height: 32px;">"<i>' . $pesan . '</i>"</span></p>
			<p style="line-height: 200%; font-size: 14px; text-align:center"><span style="font-size: 14px; line-height: 32px;">"<i>' . $waktu . '</i>"</span></p>
			  </div>
			
				  </td>
				</tr>
			  </tbody>
			</table>
			
			
			
			<table id="u_content_button_1" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
			  <tbody>
				<tr>
				  <td style="overflow-wrap:break-word;word-break:break-word;padding:10px;" align="left">
					
			<div align="center">
			  <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-spacing: 0; border-collapse: collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;"><tr><td align="center"><v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="https://unlayer.com" style="height:60px; v-text-anchor:middle; width:372px;" arcsize="5%" stroke="f" fillcolor="#2a74f1"><w:anchorlock/><center style="color:#FFFFFF;"><![endif]-->
				<a href="https://unlayer.com" target="_blank" class="v-size-width" style="box-sizing: border-box;display: inline-block;text-decoration: none;-webkit-text-size-adjust: none;text-align: center;color: #FFFFFF; background-color: #2a74f1; border-radius: 3px;-webkit-border-radius: 3px; -moz-border-radius: 3px; width:64%; max-width:100%; overflow-wrap: break-word; word-break: break-word; word-wrap:break-word; mso-border-alt: none;">
				  <span style="display:block;padding:19px 30px;line-height:120%;"><span style="font-size: 18px; line-height: 21.6px;"><strong><span style="line-height: 21.6px; font-size: 18px;">LOGIN</span></strong></span></span>
				</a>
			  <!--[if mso]></center></v:roundrect></td></tr></table><![endif]-->
			</div>
			
				  </td>
				</tr>
			  </tbody>
			</table>
			
			<table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
			  <tbody>
				<tr>
				  <td style="overflow-wrap:break-word;word-break:break-word;padding:30px 30px 70px;" align="left">
					
			  <div style="color: #333333; line-height: 190%; text-align: left; word-wrap: break-word;">
				<p style="font-size: 14px; line-height: 190%;"><span style="font-size: 16px; line-height: 30.4px;">Hormat kami,</span></p>
			<p style="font-size: 14px; line-height: 190%;"><span style="font-size: 16px; line-height: 30.4px;"><strong>Lalinsa</strong></span></p>
			<p style="font-size: 14px; line-height: 190%;"><span style="font-size: 16px; line-height: 30.4px;"><strong>Lembaga Sertifikasi Profesi Lalinsa</strong></span></p>
			  </div>
			
				  </td>
				</tr>
			  </tbody>
			</table>
			
			  <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
			  </div>
			</div>
			<!--[if (mso)|(IE)]></td><![endif]-->
				  <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
				</div>
			  </div>
			</div>
			
			
			
			<div class="u-row-container" style="padding: 0px;background-color: transparent">
			  <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ffffff;">
				<div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
				  <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px;"><tr style="background-color: #ffffff;"><![endif]-->
				  
			<!--[if (mso)|(IE)]><td align="center" width="600" style="width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;" valign="top"><![endif]-->
			<div class="u-col u-col-100" style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
			  <div style="width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
			  <!--[if (!mso)&(!IE)]><!--><div style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;"><!--<![endif]-->
			  
			<table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
			  <tbody>
				<tr>
				  <td style="overflow-wrap:break-word;word-break:break-word;padding:0px;" align="left">
					
			<table width="100%" cellpadding="0" cellspacing="0" border="0">
			  <tr>
				<td style="padding-right: 0px;padding-left: 0px;" align="center">
				  
				  <img align="center" border="0" src="https://cdn.templates.unlayer.com/assets/1636435417479-ggg.jpg" alt="border" title="border" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 100%;max-width: 600px;" width="600" class="v-src-width v-src-max-width"/>
				  
				</td>
			  </tr>
			</table>
			
				  </td>
				</tr>
			  </tbody>
			</table>
			
			<table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
			  <tbody>
				<tr>
				  <td style="overflow-wrap:break-word;word-break:break-word;padding:30px 10px 10px;" align="left">
					
			<div align="center">
			  <div style="display: table; max-width:95px;">
			  <!--[if (mso)|(IE)]><table width="95" cellpadding="0" cellspacing="0" border="0"><tr><td style="border-collapse:collapse;" align="center"><table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse; mso-table-lspace: 0pt;mso-table-rspace: 0pt; width:95px;"><tr><![endif]-->
			  
				
				<!--[if (mso)|(IE)]><td width="32" style="width:32px; padding-right: 16px;" valign="top"><![endif]-->
				<table align="left" border="0" cellspacing="0" cellpadding="0" width="32" height="32" style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;margin-right: 16px">
				  <tbody><tr style="vertical-align: top"><td align="left" valign="middle" style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
					<a href="https://id.linkedin.com/in/marketing-lsp-lalinsa-8679a9264" title="LinkedIn" target="_blank">
					  <img src="https://i.pinimg.com/564x/22/7c/5c/227c5cc96b0e77302c09e4797b18089b.jpg" alt="LinkedIn" title="LinkedIn" width="32" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: block !important;border: none;height: auto;float: none;max-width: 32px !important">
					</a>
				  </td></tr>
				</tbody></table>
				<!--[if (mso)|(IE)]></td><![endif]-->
				
				<!--[if (mso)|(IE)]><td width="32" style="width:32px; padding-right: 0px;" valign="top"><![endif]-->
				<table align="left" border="0" cellspacing="0" cellpadding="0" width="32" height="32" style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;margin-right: 0px">
				  <tbody><tr style="vertical-align: top"><td align="left" valign="middle" style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
					<a href="https://www.instagram.com/lsp.lalinsa/" title="Instagram" target="_blank">
					  <img src="https://i.pinimg.com/564x/85/84/ba/8584bab434a376e6df23c92e69da62eb.jpg" alt="Instagram" title="Instagram" width="32" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: block !important;border: none;height: auto;float: none;max-width: 32px !important">
					</a>
				  </td></tr>
				</tbody></table>
				<!--[if (mso)|(IE)]></td><![endif]-->
				
				
				<!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
			  </div>
			</div>
			
				  </td>
				</tr>
			  </tbody>
			</table>
			
			<table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
			  <tbody>
				<tr>
				  <td style="overflow-wrap:break-word;word-break:break-word;padding:15px 10px;" align="left">
					
			  <table height="0px" align="center" border="0" cellpadding="0" cellspacing="0" width="55%" style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;border-top: 1px solid #BBBBBB;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
				<tbody>
				  <tr style="vertical-align: top">
					<td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;font-size: 0px;line-height: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
					  <span>&#160;</span>
					</td>
				  </tr>
				</tbody>
			  </table>
			
				  </td>
				</tr>
			  </tbody>
			</table>
			
			<table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
			  <tbody>
				<tr>
				  <td style="overflow-wrap:break-word;word-break:break-word;padding:10px 10px 20px;" align="left">
					
			  <div style="color: #8d8c8c; line-height: 190%; text-align: center; word-wrap: break-word;">
				<p style="font-size: 14px; line-height: 190%;">Jika kamu memiliki pertanyaan, bisa hubungi kami lewat <span style="text-decoration: underline; font-size: 14px; line-height: 26.6px;"><span style="color: #f1602a; font-size: 14px; line-height: 26.6px; text-decoration: underline;"><span style="font-size: 14px; line-height: 26.6px;">administrasi@lsplalinsa.com</span>. </span></span><br />081802838383<br />Ruko Italian Walk Blok i/20, Mall of Indonesia, Kelapa Gading, Jakarta UtaraKota, RT.18/RW.8, Klp. Gading Bar., Klp. Gading, Kota Jkt Utara, Daerah Khusus Ibukota Jakarta 14240<br /><span style="text-decoration: underline; font-size: 14px; line-height: 26.6px;">Terms of use</span> | <span style="text-decoration: underline; font-size: 14px; line-height: 26.6px;">Privacy Policy</span></p>
			  </div>
			
				  </td>
				</tr>
			  </tbody>
			</table>
			
			  <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
			  </div>
			</div>
			<!--[if (mso)|(IE)]></td><![endif]-->
				  <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
				</div>
			  </div>
			</div>
			
			
			
			<div class="u-row-container" style="padding: 0px;background-color: transparent">
			  <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
				<div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
				  <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px;"><tr style="background-color: transparent;"><![endif]-->
				  
			<!--[if (mso)|(IE)]><td align="center" width="600" style="width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;" valign="top"><![endif]-->
			<div class="u-col u-col-100" style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
			  <div style="width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
			  <!--[if (!mso)&(!IE)]><!--><div style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;"><!--<![endif]-->
			  
			<table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
			  <tbody>
				<tr>
				  <td style="overflow-wrap:break-word;word-break:break-word;padding:0px;" align="left">
					
			<table width="100%" cellpadding="0" cellspacing="0" border="0">
			  <tr>
				<td style="padding-right: 0px;padding-left: 0px;" align="center">
				  
				  <img align="center" border="0" src="https://cdn.templates.unlayer.com/assets/1636435800013-footer%20curve.png" alt="border" title="border" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 100%;max-width: 600px;" width="600" class="v-src-width v-src-max-width"/>
				  
				</td>
			  </tr>
			</table>
			
				  </td>
				</tr>
			  </tbody>
			</table>
			
			  <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
			  </div>
			</div>
			<!--[if (mso)|(IE)]></td><![endif]-->
				  <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
				</div>
			  </div>
			</div>
			
			
			
			<div class="u-row-container" style="padding: 0px;background-color: transparent">
			  <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
				<div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
				  <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px;"><tr style="background-color: transparent;"><![endif]-->
				  
			<!--[if (mso)|(IE)]><td align="center" width="600" style="width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;" valign="top"><![endif]-->
			<div class="u-col u-col-100" style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
			  <div style="width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
			  <!--[if (!mso)&(!IE)]><!--><div style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;"><!--<![endif]-->
			  
			<table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
			  <tbody>
				<tr>
				  <td style="overflow-wrap:break-word;word-break:break-word;padding:10px;" align="left">
					
			  <table height="0px" align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;border-top: 0px solid #BBBBBB;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
				<tbody>
				  <tr style="vertical-align: top">
					<td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;font-size: 0px;line-height: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
					  <span>&#160;</span>
					</td>
				  </tr>
				</tbody>
			  </table>
			
				  </td>
				</tr>
			  </tbody>
			</table>
			
			  <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
			  </div>
			</div>
			<!--[if (mso)|(IE)]></td><![endif]-->
				  <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
				</div>
			  </div>
			</div>
			
			
				<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
				</td>
			  </tr>
			  </tbody>
			  </table>
			  <!--[if mso]></div><![endif]-->
			  <!--[if IE]></div><![endif]-->
			</body>
			
			</html>';

		if ($mail->send()) {
			$id_user = $this->input->post('id_user');
			$id_siswa = $this->input->post('id_siswa');
			$no_pendaftaran = $this->input->post('no_pendaftaran');
			$pesan = $this->input->post('pesan');
			$waktu = date_create('now')->format('Y-m-d H:i:s');

			$data = array(
				'id_user' => $id_user,
				'id_siswa' => $id_siswa,
				'no_pendaftaran' => $no_pendaftaran,
				'pesan' => $pesan,
				'waktu' => $waktu,
			);

			$this->web->insert_data($data, 'tbl_pesan');
			$this->session->set_flashdata('msg', 'Pesan berhasil terkirim!');
			redirect('panel_asesor/kirim_pesan');
		} else {
			echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}
	}

	public function data_pesan($aksi = '', $id = '')
	{
		$sess = $this->session->userdata('id_asesor');
		if ($sess == NULL) {
			redirect('panel_asesor/log_in');
		} else {
			$data = array(
				'user'		=> $this->asesor->base('bio', $sess),
				'judul_web'	=> "Data Pesan"
			);
			$user = $this->asesor->base('bio', $sess);
			$id_user = $user->id_user;
			$data['pesan'] = $this->db->query("SELECT sis.nama_lengkap,user.nama_lengkap AS pengirim,psn.pesan,psn.waktu,user.jurusan,psn.id_pesan FROM tbl_pesan psn INNER JOIN tbl_siswa sis ON psn.no_pendaftaran = sis.no_pendaftaran INNER JOIN tbl_user user ON psn.id_user = user.id_user WHERE psn.id_user = '$id_user' ORDER BY psn.id_pesan DESC")->result();
			$this->load->view('templates_asesor/header', $data);
			$this->load->view('templates_asesor/sidebar', $data);
			$this->load->view('asesor/data_pesan', $data);
			$this->load->view('templates_asesor/footer');
		}
	}

	public function delete_pesan($id)
	{
		$where = array('id_pesan' => $id);
		$this->web->delete_data($where, 'tbl_pesan');
		$this->session->set_flashdata('msg', 'Data Pesan berhasil dihapus');
		redirect('panel_asesor/data_pesan');
	}

	public function update_pesan($id)
	{
		$where = array('id_pesan' => $id);
		$sess = $this->session->userdata('id_asesor');
		if ($sess == NULL) {
			redirect('panel_asesor/log_in');
		} else {
			$data = array(
				'user'		=> $this->asesor->base('bio', $sess),
				'judul_web'	=> "Ubah Pesan"
			);

			$data['pesan'] = $this->db->query("SELECT * FROM tbl_pesan WHERE id_pesan = '$id'")->result();
			$this->load->view('templates_asesor/header', $data);
			$this->load->view('templates_asesor/sidebar', $data);
			$this->load->view('asesor/form_update_pesan', $data);
			$this->load->view('templates_asesor/footer');
		}
	}

	public function update_pesan_aksi()
	{
		$id = $this->input->post('id_pesan');
		$this->_rulespesan();
		if ($this->form_validation->run() == FALSE) {
			$this->update_pesan($id);
		} else {
			$id = $this->input->post('id_pesan');
			$id_user = $this->input->post('id_user');
			$id_siswa = $this->input->post('id_siswa');
			$no_pendaftaran = $this->input->post('no_pendaftaran');
			$pesan = $this->input->post('pesan');
			$waktu = $this->input->post('waktu');

			$data = array(
				'id_user' => $id_user,
				'id_siswa' => $id_siswa,
				'no_pendaftaran' => $no_pendaftaran,
				'pesan' => $pesan,
				'waktu' => $waktu
			);

			$where = array(
				'id_pesan' => $id
			);
			$this->web->update_data('tbl_pesan', $data, $where);
			$this->session->set_flashdata('msg', 'Data Pesan berhasil diubah!');
			redirect('panel_asesor/data_pesan');
		}
	}

	public function _rulespesan()
	{
		$this->form_validation->set_rules('id_user', 'ID User', 'required');
		$this->form_validation->set_rules('id_siswa', 'ID Siswa', 'required');
		$this->form_validation->set_rules('no_pendaftaran', 'No Pendaftaran', 'required');
		$this->form_validation->set_rules('pesan', 'Pesan', 'required');
		$this->form_validation->set_rules('waktu', 'Waktu', 'required');
	}

	public function submit_tinjauan()
	{
		$id = $this->input->post('id_siswa');
		$this->_rulestinjauan();
		if ($this->form_validation->run() == FALSE) {
			$this->sertifikasi_mandiri($id);
		} else {
			$id = $this->input->post('id_siswa');
			$nama_asesor = $this->input->post('nama_asesor');
			$tgl_asesor = $this->input->post('tgl_asesor');

			$data = array(
				'nama_asesor' => $nama_asesor,
				'tgl_asesor' => $tgl_asesor
			);

			$where = array(
				'id_siswa' => $id
			);
			$this->web->update_data('tbl_siswa', $data, $where);
			$this->session->set_flashdata('msg', 'Data Asesi berhasil diubah!');
			redirect('panel_asesor/sertifikasi_mandiri/' . $id);
		}
	}

	public function _rulestinjauan()
	{
		$this->form_validation->set_rules('nama_asesor', 'Nama Asesor', 'required');
	}



	public function printDocument()
	{
		$sess = $this->session->userdata('id_asesor');
		if ($sess == NULL) {
			redirect('panel_asesor/log_in');
		} else {
			$data = array(
				'user'		=> $this->asesor->base('bio', $sess),
				'judul_web'	=> "Print"
			);
			$this->load->view('templates_asesor/header', $data);
			$this->load->view('templates_asesor/sidebar', $data);
			$this->load->view('asesor/print', $data);
			$this->load->view('templates_asesor/footer');
		}
	}

	public function print_form_apl_01()
	{
		$sess = $this->session->userdata('id_asesor');
		if ($sess == NULL) {
			redirect('panel_asesor/log_in');
		} else {
			$data = array(
				'user'		=> $this->asesor->base('bio', $sess),
				'judul_web'	=> "Print FORM APL 01"
			);
			$data['asesi'] = $this->web->get_data('tbl_siswa')->result();
			$data['asesi_rpl'] = $this->db->query("SELECT * FROM tbl_siswa WHERE tbl_siswa.id_komp >='1' AND tbl_siswa.id_komp <='3' ORDER BY id_siswa DESC")->result();
			$data['asesi_tkj'] = $this->db->query("SELECT * FROM tbl_siswa WHERE tbl_siswa.id_komp >='4' AND tbl_siswa.id_komp <='6' ORDER BY id_siswa DESC")->result();
			$data['asesi_mm'] = $this->db->query("SELECT * FROM tbl_siswa WHERE tbl_siswa.id_komp >='7'  AND tbl_siswa.id_komp <='10' ORDER BY id_siswa DESC")->result();
			$data['asesi_pkm'] = $this->db->query("SELECT * FROM tbl_siswa WHERE tbl_siswa.id_komp >='11' AND tbl_siswa.id_komp <='12' ORDER BY id_siswa DESC")->result();
			$this->load->view('templates_asesor/header', $data);
			$this->load->view('templates_asesor/sidebar', $data);
			$this->load->view('asesor/print_form_apl_01', $data);
			$this->load->view('templates_asesor/footer');
		}
	}

	public function print_form_apl_02()
	{
		$sess = $this->session->userdata('id_asesor');
		if ($sess == NULL) {
			redirect('panel_asesor/log_in');
		} else {
			$data = array(
				'user'		=> $this->asesor->base('bio', $sess),
				'judul_web'	=> "Print FORM APL 02"
			);
			$data['asesi'] = $this->web->get_data('tbl_siswa')->result();
			$data['asesi_rpl'] = $this->db->query("SELECT * FROM tbl_siswa WHERE tbl_siswa.id_komp >='1' AND tbl_siswa.id_komp <='3' ORDER BY id_siswa DESC")->result();
			$data['asesi_tkj'] = $this->db->query("SELECT * FROM tbl_siswa WHERE tbl_siswa.id_komp >='4' AND tbl_siswa.id_komp <='6' ORDER BY id_siswa DESC")->result();
			$data['asesi_mm'] = $this->db->query("SELECT * FROM tbl_siswa WHERE tbl_siswa.id_komp >='7'  AND tbl_siswa.id_komp <='10' ORDER BY id_siswa DESC")->result();
			$data['asesi_pkm'] = $this->db->query("SELECT * FROM tbl_siswa WHERE tbl_siswa.id_komp >='11' AND tbl_siswa.id_komp <='12' ORDER BY id_siswa DESC")->result();
			$this->load->view('templates_asesor/header', $data);
			$this->load->view('templates_asesor/sidebar', $data);
			$this->load->view('asesor/print_form_apl_02', $data);
			$this->load->view('templates_asesor/footer');
		}
	}

	public function print_form2_aksi($id)
	{
		$sess = $this->session->userdata('id_asesor');
		if ($sess == NULL) {
			redirect('panel_asesor/log_in');
		} else {
			$data = array(
				'user'		=> $this->asesor->base('bio', $sess),
				'judul_web'	=> "Print FORM APL 02"
			);
			$data['signature'] = $this->db->query("SELECT * FROM tbl_signature sig INNER JOIN tbl_siswa sis ON sig.no_pendaftaran = sis.no_pendaftaran WHERE sis.id_siswa='$id'")->result();
			$data['asesi'] = $this->db->query("SELECT * FROM tbl_siswa WHERE tbl_siswa.id_siswa='$id'")->row();
			$data['kompetensi_pemdas'] = $this->db->query("SELECT * FROM tbl_pemdas INNER JOIN tbl_siswa ON tbl_siswa.id_siswa = tbl_pemdas.id_siswa WHERE tbl_pemdas.id_siswa='$id'")->result();
			$data['kompetensi_pemweb'] = $this->db->query("SELECT * FROM tbl_pemweb INNER JOIN tbl_siswa ON tbl_siswa.id_siswa = tbl_pemweb.id_siswa WHERE tbl_pemweb.id_siswa='$id'")->result();
			$data['kompetensi_pbo'] = $this->db->query("SELECT * FROM tbl_pbo INNER JOIN tbl_siswa ON tbl_siswa.id_siswa = tbl_pbo.id_siswa WHERE tbl_pbo.id_siswa='$id'")->result();
			$data['kompetensi_audiovideo'] = $this->db->query("SELECT * FROM tbl_audiovideo INNER JOIN tbl_siswa ON tbl_siswa.id_siswa = tbl_audiovideo.id_siswa WHERE tbl_audiovideo.id_siswa='$id'")->result();
			$data['kompetensi_animasi2d'] = $this->db->query("SELECT * FROM tbl_animasi2d INNER JOIN tbl_siswa ON tbl_siswa.id_siswa = tbl_animasi2d.id_siswa WHERE tbl_animasi2d.id_siswa='$id'")->result();
			$data['kompetensi_desainpercetakan'] = $this->db->query("SELECT * FROM tbl_desainpercetakan INNER JOIN tbl_siswa ON tbl_siswa.id_siswa = tbl_desainpercetakan.id_siswa WHERE tbl_desainpercetakan.id_siswa='$id'")->result();
			$data['kompetensi_desaingrafis'] = $this->db->query("SELECT * FROM tbl_desaingrafis INNER JOIN tbl_siswa ON tbl_siswa.id_siswa = tbl_desaingrafis.id_siswa WHERE tbl_desaingrafis.id_siswa='$id'")->result();
			$data['kompetensi_konfigurasirouting'] = $this->db->query("SELECT * FROM tbl_konfigurasirouting INNER JOIN tbl_siswa ON tbl_siswa.id_siswa = tbl_konfigurasirouting.id_siswa WHERE tbl_konfigurasirouting.id_siswa='$id'")->result();
			$data['kompetensi_konfigurasiperangkat'] = $this->db->query("SELECT * FROM tbl_konfigurasiperangkat INNER JOIN tbl_siswa ON tbl_siswa.id_siswa = tbl_konfigurasiperangkat.id_siswa WHERE tbl_konfigurasiperangkat.id_siswa='$id'")->result();
			$data['kompetensi_instalasijaringan'] = $this->db->query("SELECT * FROM tbl_instalasijaringan INNER JOIN tbl_siswa ON tbl_siswa.id_siswa = tbl_instalasijaringan.id_siswa WHERE tbl_instalasijaringan.id_siswa='$id'")->result();
			$data['kompetensi_pengoperasianaplikasi'] = $this->db->query("SELECT * FROM tbl_pengoperasianaplikasi INNER JOIN tbl_siswa ON tbl_siswa.id_siswa = tbl_pengoperasianaplikasi.id_siswa WHERE tbl_pengoperasianaplikasi.id_siswa='$id'")->result();
			$data['kompetensi_pelayananperbankan'] = $this->db->query("SELECT * FROM tbl_pelayananperbankan INNER JOIN tbl_siswa ON tbl_siswa.id_siswa = tbl_pelayananperbankan.id_siswa WHERE tbl_pelayananperbankan.id_siswa='$id'")->result();
			if ($data['asesi']->id_komp == 12) {
				$this->load->view('asesor/print_formapl02/pelayananperbankan', $data);
			}
			if ($data['asesi']->id_komp == 11) {
				$this->load->view('asesor/print_formapl02/pengoperasianaplikasi', $data);
			}
			if ($data['asesi']->id_komp == 10) {
				$this->load->view('asesor/print_formapl02/audiovideo', $data);
			}
			if ($data['asesi']->id_komp == 9) {
				$this->load->view('asesor/print_formapl02/animasi2d', $data);
			}
			if ($data['asesi']->id_komp == 8) {
				$this->load->view('asesor/print_formapl02/desainpercetakan', $data);
			}
			if ($data['asesi']->id_komp == 7) {
				$this->load->view('asesor/print_formapl02/desaingrafis', $data);
			}
			if ($data['asesi']->id_komp == 6) {
				$this->load->view('asesor/print_formapl02/konfigurasirouting', $data);
			}
			if ($data['asesi']->id_komp == 5) {
				$this->load->view('asesor/print_formapl02/konfigurasiperangkat', $data);
			}
			if ($data['asesi']->id_komp == 4) {
				$this->load->view('asesor/print_formapl02/instalasijaringan', $data);
			}
			if ($data['asesi']->id_komp == 3) {
				$this->load->view('asesor/print_formapl02/pbo', $data);
			}
			if ($data['asesi']->id_komp == 2) {
				$this->load->view('asesor/print_formapl02/pemweb', $data);
			}
			if ($data['asesi']->id_komp == 1) {
				$this->load->view('asesor/print_formapl02/pemdas', $data);
			}
		}
	}

	public function print_form1_aksi($id)
	{
		$sess = $this->session->userdata('id_asesor');
		if ($sess == NULL) {
			redirect('panel_asesor/log_in');
		} else {
			$data = array(
				'user'		=> $this->asesor->base('bio', $sess),
				'judul_web'	=> "Print FORM APL 01"
			);
			$data['signature'] = $this->db->query("SELECT * FROM tbl_signature sig INNER JOIN tbl_siswa sis ON sig.no_pendaftaran = sis.no_pendaftaran WHERE sis.id_siswa='$id'")->row();
			$data['asesi'] = $this->db->query("SELECT * FROM tbl_siswa INNER JOIN tbl_pdd ON tbl_pdd.id_pdd = tbl_siswa.pd_terakhir WHERE tbl_siswa.id_siswa='$id'")->row();
			$data['asesi_rpl'] = $this->db->query("SELECT * FROM tbl_siswa WHERE tbl_siswa.id_komp >='1' AND tbl_siswa.id_komp <='3' ORDER BY id_siswa DESC")->result();
			$data['asesi_tkj'] = $this->db->query("SELECT * FROM tbl_siswa WHERE tbl_siswa.id_komp >='4' AND tbl_siswa.id_komp <='6' ORDER BY id_siswa DESC")->result();
			$data['asesi_mm'] = $this->db->query("SELECT * FROM tbl_siswa WHERE tbl_siswa.id_komp >='7'  AND tbl_siswa.id_komp <='10' ORDER BY id_siswa DESC")->result();
			$data['asesi_pkm'] = $this->db->query("SELECT * FROM tbl_siswa WHERE tbl_siswa.id_komp >='11' AND tbl_siswa.id_komp <='12' ORDER BY id_siswa DESC")->result();
			$data['kompetensi_pemdas'] = $this->db->query("SELECT * FROM tbl_pemdas INNER JOIN tbl_siswa ON tbl_siswa.id_siswa = tbl_pemdas.id_siswa WHERE tbl_pemdas.id_siswa='$id'")->result();
			$data['kompetensi_pemweb'] = $this->db->query("SELECT * FROM tbl_pemweb INNER JOIN tbl_siswa ON tbl_siswa.id_siswa = tbl_pemweb.id_siswa WHERE tbl_pemweb.id_siswa='$id'")->result();
			$data['kompetensi_pbo'] = $this->db->query("SELECT * FROM tbl_pbo INNER JOIN tbl_siswa ON tbl_siswa.id_siswa = tbl_pbo.id_siswa WHERE tbl_pbo.id_siswa='$id'")->result();
			$data['kompetensi_audiovideo'] = $this->db->query("SELECT * FROM tbl_audiovideo INNER JOIN tbl_siswa ON tbl_siswa.id_siswa = tbl_audiovideo.id_siswa WHERE tbl_audiovideo.id_siswa='$id'")->result();
			$data['kompetensi_animasi2d'] = $this->db->query("SELECT * FROM tbl_animasi2d INNER JOIN tbl_siswa ON tbl_siswa.id_siswa = tbl_animasi2d.id_siswa WHERE tbl_animasi2d.id_siswa='$id'")->result();
			$data['kompetensi_desainpercetakan'] = $this->db->query("SELECT * FROM tbl_desainpercetakan INNER JOIN tbl_siswa ON tbl_siswa.id_siswa = tbl_desainpercetakan.id_siswa WHERE tbl_desainpercetakan.id_siswa='$id'")->result();
			$data['kompetensi_desaingrafis'] = $this->db->query("SELECT * FROM tbl_desaingrafis INNER JOIN tbl_siswa ON tbl_siswa.id_siswa = tbl_desaingrafis.id_siswa WHERE tbl_desaingrafis.id_siswa='$id'")->result();
			$data['kompetensi_konfigurasirouting'] = $this->db->query("SELECT * FROM tbl_konfigurasirouting INNER JOIN tbl_siswa ON tbl_siswa.id_siswa = tbl_konfigurasirouting.id_siswa WHERE tbl_konfigurasirouting.id_siswa='$id'")->result();
			$data['kompetensi_konfigurasiperangkat'] = $this->db->query("SELECT * FROM tbl_konfigurasiperangkat INNER JOIN tbl_siswa ON tbl_siswa.id_siswa = tbl_konfigurasiperangkat.id_siswa WHERE tbl_konfigurasiperangkat.id_siswa='$id'")->result();
			$data['kompetensi_instalasijaringan'] = $this->db->query("SELECT * FROM tbl_instalasijaringan INNER JOIN tbl_siswa ON tbl_siswa.id_siswa = tbl_instalasijaringan.id_siswa WHERE tbl_instalasijaringan.id_siswa='$id'")->result();
			$data['kompetensi_pengoperasianaplikasi'] = $this->db->query("SELECT * FROM tbl_pengoperasianaplikasi INNER JOIN tbl_siswa ON tbl_siswa.id_siswa = tbl_pengoperasianaplikasi.id_siswa WHERE tbl_pengoperasianaplikasi.id_siswa='$id'")->result();
			$data['kompetensi_pelayananperbankan'] = $this->db->query("SELECT * FROM tbl_pelayananperbankan INNER JOIN tbl_siswa ON tbl_siswa.id_siswa = tbl_pelayananperbankan.id_siswa WHERE tbl_pelayananperbankan.id_siswa='$id'")->result();
			if ($data['asesi']->id_komp == 12) {
				$this->load->view('asesor/print_formapl01/pelayananperbankan', $data);
			}
			if ($data['asesi']->id_komp == 11) {
				$this->load->view('asesor/print_formapl01/pengoperasianaplikasi', $data);
			}
			if ($data['asesi']->id_komp == 10) {
				$this->load->view('asesor/print_formapl01/audiovideo', $data);
			}
			if ($data['asesi']->id_komp == 9) {
				$this->load->view('asesor/print_formapl01/animasi2d', $data);
			}
			if ($data['asesi']->id_komp == 8) {
				$this->load->view('asesor/print_formapl01/desainpercetakan', $data);
			}
			if ($data['asesi']->id_komp == 7) {
				$this->load->view('asesor/print_formapl01/desaingrafis', $data);
			}
			if ($data['asesi']->id_komp == 6) {
				$this->load->view('asesor/print_formapl01/konfigurasirouting', $data);
			}
			if ($data['asesi']->id_komp == 5) {
				$this->load->view('asesor/print_formapl01/konfigurasiperangkat', $data);
			}
			if ($data['asesi']->id_komp == 4) {
				$this->load->view('asesor/print_formapl01/instalasijaringan', $data);
			}
			if ($data['asesi']->id_komp == 3) {
				$this->load->view('asesor/print_formapl01/pbo', $data);
			}
			if ($data['asesi']->id_komp == 2) {
				$this->load->view('asesor/print_formapl01/pemweb', $data);
			}
			if ($data['asesi']->id_komp == 1) {
				$this->load->view('asesor/print_formapl01/pemdas', $data);
			}
		}
	}

	public function jadwalevent($aksi = '', $id = '')
	{
		$sess = $this->session->userdata('id_asesor');
		$idd = $this->session->userdata('idd');
		if ($sess == NULL) {
			redirect('panel_asesor/log_in');
		} else {
			$data = array(
				'user'		=> $this->asesor->base('bio', $sess),
				'judul_web'	=> "Data Jadwal Event"
			);
			$data['asesor'] = $this->db->query("SELECT tbl_jadwalevent.*, tbl_user.nama_lengkap as nama_asesor, tbl_siswa.nama_lengkap as nama_asesi, tbl_siswa.no_pendaftaran as no_pendaftaran FROM tbl_jadwalevent 
		inner join tbl_user on tbl_jadwalevent.id_asesor = tbl_user.id_user 
		inner join tbl_siswa on tbl_jadwalevent.id_asesi = tbl_siswa.id_siswa 
		where tbl_jadwalevent.id_asesor = '$idd'")->result();
			$this->load->view('templates_asesor/header', $data);
			$this->load->view('templates_asesor/sidebar', $data);
			$this->load->view('asesor/data_jadwalevent', $data);
			$this->load->view('templates_asesor/footer');
		}
	}

	public function detail_berkas($id)
	{
		$sess = $this->session->userdata('id_asesor');
		$idd = $this->session->userdata('idd');
		if ($sess == NULL) {
			redirect('panel_asesor/log_in');
		} else {
			$data = array(
				'user'		=> $this->asesor->base('bio', $sess),
				'judul_web'	=> "Detail Asesi"
			);

			$data['detail'] = $this->db->query("SELECT * FROM tbl_siswa WHERE tbl_siswa.id_siswa = '$id'")->row();
			$data['skema'] = $this->db->query("SELECT * FROM tbl_skema_sertifikasi")->result();
			$this->load->view('templates_asesor/header', $data);
			$this->load->view('templates_asesor/sidebar', $data);
			$this->load->view('asesor/downloadupload', $data);
			$this->load->view('templates_asesor/footer');
		}
	}

	public function update_downloadupload_aksi()
	{
		$id_siswa       = $this->input->post('id_siswa');

		if ($_FILES["hasil_sertifikat"]['name'] !== "") {
			$nama1 								= str_replace("_", "", $_FILES["hasil_sertifikat"]['name']);
			$nama2 								= str_replace(" ", "", $nama1);
			$nama_hasil_sertifikat 				= time() . '-' . $nama2;
			$config['upload_path'] 				= './assets/upload/persyaratan/';
			$config['allowed_types'] 			= 'pdf|jpg|jpeg|png';
			$config['max_size']  				= '250000';
			$config['file_name']  				= $nama_hasil_sertifikat;

			$this->upload->initialize($config);
			$this->upload->do_upload('hasil_sertifikat');
			$data = array(
				'hasil_sertifikat' => $nama_hasil_sertifikat
			);
			$where = array(
				'id_siswa' => $id_siswa
			);
			$this->web->update_data('tbl_siswa', $data, $where);
			$this->session->set_flashdata('msg', 'Data Persyaratan Berhasil di Upload!');
			redirect('panel_asesor/set_pengumuman');
		} else {
			redirect('panel_asesor/set_pengumuman');
		}
	}

	public function ruang_asesi()
	{
		$sess = $this->session->userdata('id_asesor');
		if ($sess == NULL) {
			redirect('panel_asesor/log_in');
		} else {
			$data = [
				'user'		=> $this->admin->base('bio', $sess),
				'judul_web'	=> "Ruang Asesi"
			];

			$data['item'] = $this->db->join('tbl_skema_sertifikasi', 'tbl_siswa.id_skema_sertifikasi=tbl_skema_sertifikasi.id_skema_sertifikasi')
				->get_where('tbl_siswa', ['status_verifikasi' => 2])->result();

			$this->load->view('templates_asesor/header', $data);
			$this->load->view('templates_asesor/sidebar', $data);
			$this->load->view('asesor/ruang_asesi', $data);
			$this->load->view('templates_asesor/footer');
		}
	}

	public function upload_soal()
	{
		$where['id_siswa'] = $this->input->post('id_siswa');

		$config['upload_path']		= './assets/upload/soal/';
		$config['allowed_types']	= 'doc|docx|pdf';
		$config['max_size']				= '10240';
		$config['encrypt_name'] 	= TRUE;

		$this->upload->initialize($config);

		if ($_FILES['file_soal']['name']) {
			if (!$this->upload->do_upload('file_soal')) {
				$error = "File soal: " . $this->upload->display_errors('', '');
				$this->session->set_flashdata('error', $error);
			} else {
				$data['file_soal'] = $this->upload->data('file_name');

				$this->web->update_data('tbl_siswa', $data, $where);
				$this->session->set_flashdata('success', 'Soal berhasil diUpload!');
			}
		}

		redirect('panel_asesor/ruang_asesi');
	}
}
