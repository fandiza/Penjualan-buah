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
	public function filter(){
		$tanggalawal = $this->input->post('tanggalawal');
        $tanggalakhir = $this->input->post('tanggalakhir');

			$data['filter_barangmasuk'] = $this->m_barangmasuk->filterbytanggal($tanggalawal,$tanggalakhir);
            $data['title'] = "Laporan Barang Masuk Filter Berdasarkan Tanggal";
            $data['subtitle'] = "Dari tanggal : ".$tanggalawal.' Sampai tanggal : '.$tanggalakhir;
            $this->pdf->set_option('isRemoteEnabled', true);
            $this->load->library('pdf');
            $this->pdf->setPaper('A4', 'potrait');
            $this->pdf->filename = "Laporan Barang Masuk.pdf";
            $this->pdf->load_view('barangmasuk/barangmasuk_pdf', $data);
	}
	public function filterByDay($start, $end){
		$getDay = $this->m_laporanharian->filterByDate($start , $end);
		echo json_encode($getDay);
	}

	public function getDataByDay($start, $end){
		$getData = $this->m_laporanharian->getDataByDate($start, $end);
		echo json_encode($getData);
	}
}