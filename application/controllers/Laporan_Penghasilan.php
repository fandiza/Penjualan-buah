<?php

class Laporan_Penghasilan extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if($this->session->login['level'] != 'kasir' && $this->session->login['level'] != 'admin') redirect();
		$this->data['aktif'] = 'laporan';
		$this->load->model("M_Laporan", "m_Laporan");
		$this->load->helper("Tanggal_Helper");
	}
	public function index(){
		$this->data['title'] = 'Laporan Penghasilan';
		$this->data['all_barang'] = $this->db->get('barang')->result_array() ;
		$this->data['total'] = $this->m_Laporan->penghasilan_GetAll();
		$this->load->view('laporan/laporan_penjualan', $this->data);
	}
	public function getDataById($dataId){
		$fetch = $this->m_Laporan->penghasilan_ById($dataId);
		echo json_encode($fetch);
	}

	public function getAll(){
		$data = $this->m_Laporan->penghasilan_GetAll();
		echo json_encode($data);
	}

	public function getDataByYear($start){
		$getData = $this->m_Laporan->filterByYear($start);
		echo json_encode($getData);
	}
}