<?php

class Dashboard extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if($this->session->login['level'] != 'kasir' && $this->session->login['level'] != 'admin') redirect();
		$this->data['aktif'] = 'dashboard';
		$this->load->model('M_barang', 'm_barang');
		$this->load->model('M_user', 'm_user');
		$this->load->model('M_penjualan', 'm_penjualan');
		$this->load->model('M_barangmasuk', 'm_barangmasuk');
		$this->load->model('M_toko', 'm_toko');
	}
	public function index(){
		$this->data['title'] = 'Halaman Dashboard';
		$this->data['jumlah_barang'] = $this->m_barang->jumlah();
		$this->data['jumlah_kasir'] = $this->m_user->jumlah();
		$this->data['jumlah_penjualan'] = $this->m_penjualan->jumlah();
		$this->data['jumlah_pengguna'] = $this->m_user->jumlah();
		$this->data['jumlah_barangmasuk'] = $this->m_barangmasuk->jumlahbm();
		$this->data['toko'] = $this->m_toko->lihat();
		$this->load->view('dashboard', $this->data);
	}
}