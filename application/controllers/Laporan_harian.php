<?php

class Laporan_harian extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if($this->session->login['level'] != 'kasir' && $this->session->login['level'] != 'admin') redirect();
		$this->data['aktif'] = 'laporan_harian';
		$this->load->model("M_laporanharian", "m_laporanharian");
		$this->load->helper("Tanggal_Helper");
	}
	public function index(){
		$this->data['title'] = 'Laporan Per Hari';
		$this->data['total_pendapatan'] = $this->m_laporanharian->totalpendapatan();
		$this->data["barang_terjual"] = $this->m_laporanharian->totbarangterjual();
		$this->data["total_penjualan"] = $this->m_laporanharian->totpenjualan();
		$this->data["barang_laris"] = $this->m_laporanharian->baranglaris();
		$this->data['chart'] = $this->m_laporanharian->getIncomeBasedDay();
		$this->load->view('laporan/laporan_harian', $this->data);
	}
}