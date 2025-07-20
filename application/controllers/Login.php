<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends MY_Controller
{

	public function index()
	{
		$this->load->view('v_login');
	}

	public function auth_process()
	{
		$this->form_validation->set_rules('inputEmail', 'Email', 'required|trim|valid_email');
		$this->form_validation->set_rules('inputPassword', 'Password', 'required|trim|min_length[3]');

		if ($this->form_validation->run() == false) {
			// Validasi gagal, tampilkan kembali halaman login dengan pesan kesalahan
			$error_message = "Data tidak valid, Harap lengkapi form dengan benar!";
			$this->Flasher_model->flashdata($error_message, 'Gagal', 'danger');
			redirect('login');
		} else {
			// Validasi sukses
			$email = $this->input->post('inputEmail', true); // Terapkan XSS filtering dengan 'true' sebagai parameter kedua
			$password = $this->input->post('inputPassword', true); // Terapkan XSS filtering dengan 'true' sebagai parameter kedua
			$rememberMe = $this->input->post('rememberMe');

			log_message('error', 'Step: Checking Cookies or Sessions');

			if ($this->auth->validate($email, $password, $rememberMe)) {
				$this->Flasher_model->flashdata('Selamat Datang di ' . APP_NAME, 'Berhasil login', 'success');
				log_message('error', 'valid');
				redirect('dashboard');
			} else {
				$error_message = $this->auth->getMessage();
				if ($error_message == null) {
					$error_message = $this->auth->getError();
				}
				$this->Flasher_model->flashdata($error_message, 'Gagal', 'danger');
				redirect('login');
			}
		}
	}

	public function logout()
	{
		if ($this->auth->logout()) {
			redirect('login');
		}
	}
}