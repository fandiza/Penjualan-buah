<?php

class Logout extends CI_Controller{
	public function __construct()
    {
        //memanggil method kosntrukter di CI Controller
        parent::__construct();
        $this->load->model('M_user');
       
    }
	public function index(){
		$this->M_user->set_lastLogin();
		$this->session->sess_destroy();
		redirect();
	}
	
}