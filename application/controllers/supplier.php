<?php

use Dompdf\Dompdf;

class supplier extends CI_Controller{
	public function __construct(){
		parent::__construct();
		if($this->session->login['level'] != 'kasir' && $this->session->login['level'] != 'admin') redirect();
		$this->data['aktif'] = 'supplier';
		$this->load->model('M_supplier', 'm_supplier');
	}

	public function index(){
		$this->data['title'] = 'Data supplier';
		$this->data['all_supplier'] = $this->m_supplier->lihat();
		$this->data['no'] = 1;

		$this->load->view('supplier/lihat', $this->data);
	}

	public function tambah(){
		$this->data['title'] = 'Tambah supplier';

		$this->load->view('supplier/tambah', $this->data);
	}

	public function proses_tambah(){

		$data = [
			
			'nama_sup' => $this->input->post('nama_sup'),
			'no_telp' => $this->input->post('no_telp'),
			'alamat' => $this->input->post('alamat'),
		];

		if($this->m_supplier->tambah($data)){
			$this->session->set_flashdata('success', 'Data supplier <strong>Berhasil</strong> Ditambahkan!');
			redirect('supplier');
		} else {
			$this->session->set_flashdata('error', 'Data supplier <strong>Gagal</strong> Ditambahkan!');
			redirect('supplier');
		}
	}

	public function ubah($id_supplier){

		$this->data['title'] = 'Ubah supplier';
		$this->data['supplier'] = $this->m_supplier->lihat_id($id_supplier);

		$this->load->view('supplier/ubah', $this->data);
      
	}

	public function proses_ubah($id_supplier){
		$data = [
			
            'nama_sup' => $this->input->post('nama_sup'),
			'no_telp' => $this->input->post('no_telp'),
			'alamat' => $this->input->post('alamat'),
		];

		if($this->m_supplier->ubah($data, $id_supplier)){
			$this->session->set_flashdata('success', 'Data supplier <strong>Berhasil</strong> Diubah!');
			redirect('supplier');
		} else {
			$this->session->set_flashdata('error', 'Data supplier <strong>Gagal</strong> Diubah!');
			redirect('supplier');
		}
	}

	public function hapus($id_supplier){
		if($this->m_supplier->hapus($id_supplier)){
			$this->session->set_flashdata('success', 'Data supplier <strong>Berhasil</strong> Dihapus!');
			redirect('supplier');
		} else {
			$this->session->set_flashdata('error', 'Data supplier <strong>Gagal</strong> Dihapus!');
			redirect('supplier');
		}
	}

	public function export(){
		$dompdf = new Dompdf();
	
		$this->data['all_supplier'] = $this->m_supplier->lihat();
		$this->data['title'] = 'Laporan Data supplier';
		$this->data['no'] = 1;

		$dompdf->setPaper('A4', 'Landscape');
		$html = $this->load->view('supplier/report', $this->data, true);
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream('Laporan Data supplier Tanggal ' . date('d F Y'), array("Attachment" => false));
	}
}