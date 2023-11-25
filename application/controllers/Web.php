<?php
defined('BASEPATH') or exit('No direct script access allowed');
ob_start();

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'assets/vendor/autoload.php';
class Web extends CI_Controller
{

	public function index()
	{
		$data['web_ppdb']	 = $this->web->web_utama();
		$this->load->view('web/index', $data);
	}

	public function idbaru($value = '')
	{
		return $this->web->pendaftaran('id_baru');
	}

	public function pendaftaran()
	{
		$data = [
			'id_daftar'			=> $this->web->pendaftaran('id_baru'),
			'web_ppdb'			=> $this->web->pendaftaran('status_ppdb'),
			'v_pdd'				=> $this->web->pendaftaran('v_pdd'),
			'v_komp'			=> $this->web->pendaftaran('v_komp')
		];

		if ($data['web_ppdb']->status_ppdb == 'tutup') {
			redirect('404');
		}

		$this->load->view('web/pendaftaran', $data);

		if (isset($_POST['btndaftar'])) {
			// var_dump($this->input->post()); exit();
			$acts = $this->web->pendaftaran('daftar', $this->input);
			// 

			$this->session->set_userdata('no_pendaftaran', $this->input->post('nis'));

			$id = $this->session->userdata('no_pendaftaran');
			$data['asesi'] = $this->db->query("SELECT * FROM tbl_siswa WHERE no_pendaftaran='$id'")->row();

			//Server settings
			$mail = new PHPMailer(true);
			$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
			$mail->isSMTP();                                            // Send using SMTP
			$mail->Host       = 'smtp.elasticemail.com';                    // Set the SMTP server to send through
			$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
			// $mail->Username   = 'hernuwandicky@gmail.com';                     // SMTP username
			// $mail->Password   = 'qsixlwvxiggevixs';                               // SMTP password
			$mail->Username   = 'lsplalinsa23@gmail.com';                     // SMTP username
			$mail->Password   = '89C426C6D4D815729A937E7EA23D184DE0F6';                            // SMTP password
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
			$mail->Port       = 2525;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

			//Recipients
			$mail->setFrom('lsplalinsa23@gmail.com', 'LSP Lalinsa');
			$mail->addAddress($data['asesi']->email);     // Add a recipient
			$mail->addReplyTo('lsplalinsa23@gmail.com', 'LSP Lalinsa');
			$mail->isHTML(true);                                  // Set email format to HTML
			$mail->Subject = 'Pesan dari LSP Lalinsa';
			$mail->Body    = $this->load->view('mail/daftar', [
				'nama_lengkap' 		=> $data['asesi']->nama_lengkap,
				'nama_perusahaan' => $data['asesi']->nama_perusahaan,
				'no_pendaftaran' 	=> $data['asesi']->no_pendaftaran,
				'password'				=> $data['asesi']->password,
			], TRUE);

			if ($mail->send()) {
				$data = ['status' => '1'];
				// $where = [
				// 	'no_pendaftaran' => $this->session->userdata('no_pendaftaran')
				// ];

				$this->web->update_data('tbl_siswa', $data, $where);
				$this->session->set_flashdata('msglogin', 'Silahkan untuk mengisi form apl-02 untuk melanjutkan proses pra-asesmen');
				redirect('success_register');
			}
		}
	}

	public function success_register()
	{
		return $this->load->view('web/success_register');
	}

	public function logcs()
	{
		$data['web_ppdb']	 = $this->web->pendaftaran('status_ppdb');
		if ($data['web_ppdb']->status_ppdb == 'tutup') {
			redirect('404');
		}

		if ($this->session->userdata('no_pendaftaran') != NULL) {
			redirect('panel_siswa');
		} else {
			$this->load->view('web/login', $data);

			if (isset($_POST['btnlogin'])) {
				$send = array(
					'username' => $this->input->post('username'),
					'password' => $this->input->post('password')
				);
				$auth = $this->web->auth('cek-masuk', $send);

				if ($auth['sum'] == 0) {
					$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">
					No. Pendaftaran dan NISN tidak cocok!
					</div>');
					redirect('logcs');
				} else {
					$this->session->set_userdata('no_pendaftaran', $auth['res']->no_pendaftaran);
					$this->session->set_userdata('idd', $auth['res']->id_siswa);

					$data = array(
						'status' => '1'
					);

					$where = array(
						'no_pendaftaran' => $this->session->userdata('no_pendaftaran')
					);
					$this->web->update_data('tbl_siswa', $data, $where);
					$this->session->set_flashdata('msglogin', 'Jangan pernah memberikan nomor pendaftaran dan NISN ke orang lain.');
					redirect('panel_siswa');
				}
			}
		}
	}

	public function cari()
	{
		$data['siswa'] = $this->SiswaModel->view();
		$this->load->view('web/cari', $data);
	}


	function error_not_found()
	{
		$this->load->view('404_content');
	}
}
