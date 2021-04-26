<?php

class Login extends CI_Controller{
	public function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		if($this->session->login) redirect('dashboard');
		$this->load->model('M_user');
	
	}

	public function index(){
		$this->load->view('login');
	}

	public function proses_login(){
		$get_user = $this->M_user->lihat_username($this->input->post('username'));
		if($get_user){
			if($get_user->password == md5($this->input->post('password'))){
				$session = [
					'id_user' => $get_user->id_user,
					'nama' => $get_user->nama,
					'username' => $get_user->username,
					'password' => $get_user->password,
					'level' => $get_user->level,
					'jam_masuk' => date('H:i:s')
				];

				$this->session->set_userdata('login', $session);
				$this->session->set_userdata('id_user', $session);
				$this->session->set_flashdata('success', '<strong>Login</strong> Berhasil!');
				redirect('dashboard');
			} else {
				$this->session->set_flashdata('error', 'Password Salah!');
				redirect();
			}
		} else {
			$this->session->set_flashdata('error', 'Username Salah!');
			redirect();
		}
	}
}