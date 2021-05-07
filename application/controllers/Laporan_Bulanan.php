<?php

class Laporan_Bulanan extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if($this->session->login['level'] != 'kasir' && $this->session->login['level'] != 'admin') redirect();
		$this->data['aktif'] = 'laporan_bulanan';
		$this->load->model("M_Laporanbulanan", "m_laporanbulanan");
		$this->load->helper("Tanggal_Helper");
	}
	public function index(){
		$this->data['title'] = 'Laporan Bulanan';
		$this->data['total_pendapatanbulanan'] = $this->m_laporanbulanan->totalpendapatan();
		$this->data["barang_terjualbulanan"] = $this->m_laporanbulanan->totbarangterjual();
		$this->data["total_penjualanbulanan"] = $this->m_laporanbulanan->totpenjualan();
		$this->data["barang_larisbulanan"] = $this->m_laporanbulanan->baranglaris();
		$this->data['chart'] = $this->m_laporanbulanan->getIncomeBasedMonth();
		$this->load->view('laporan/laporan_bulanan', $this->data);
	}
}