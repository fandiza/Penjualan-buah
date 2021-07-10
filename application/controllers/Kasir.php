<?php

use Dompdf\Dompdf;

class Kasir extends CI_Controller{
	public function __construct(){
		parent::__construct();
		if($this->session->login['level'] != 'kasir' && $this->session->login['level'] != 'admin') redirect();
		$this->data['aktif'] = 'kasir';
		$this->load->model('M_user', 'm_user');
	}

	public function index(){
		$this->data['title'] = 'Data Karyawan';
		$this->data['all_kasir'] = $this->m_user->lihat();
		$this->data['no'] = 1;

		$this->load->view('kasir/lihat', $this->data);
	}

	public function tambah(){
		if ($this->session->login['level'] == 'kasir'){
			$this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
			redirect('penjualan');
		}

		$this->data['title'] = 'Tambah Karyawan';

		$this->load->view('kasir/tambah', $this->data);
	}

	public function proses_tambah(){
		if ($this->session->login['level'] == 'kasir'){
			$this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
			redirect('penjualan');
		}

		$data = [
			
			'nama' => $this->input->post('nama'),
			'username' => $this->input->post('username'),
			'password' => $this->input->post('password'),
			'level' => $this->input->post('level'),
		];

		if($this->m_user->tambah($data)){
			$this->session->set_flashdata('success', 'Data Kasir <strong>Berhasil</strong> Ditambahkan!');
			redirect('kasir');
		} else {
			$this->session->set_flashdata('error', 'Data Kasir <strong>Gagal</strong> Ditambahkan!');
			redirect('kasir');
		}
	}

	public function ubah($id){
		if ($this->session->login['level'] == 'kasir'){
			$this->session->set_flashdata('error', 'Ubah data hanya untuk admin!');
			redirect('penjualan');
		}

		$this->data['title'] = 'Ubah Karyawan';
		$this->data['kasir'] = $this->m_user->lihat_id($id);

		$this->load->view('kasir/ubah', $this->data);
	}

	public function proses_ubah($id_user){
		if ($this->session->login['level'] == 'kasir'){
			$this->session->set_flashdata('error', 'Ubah data hanya untuk admin!');
			redirect('penjualan');
		}

		$data = [
			'nama' => $this->input->post('nama'),
			'username' => $this->input->post('username'),
			'password' => $this->input->post('password'),
			'level' => $this->input->post('level'),
		];

		if($this->m_user->ubah($data, $id_user)){
			$this->session->set_flashdata('success', 'Data Kasir <strong>Berhasil</strong> Diubah!');
			redirect('kasir');
		} else {
			$this->session->set_flashdata('error', 'Data Kasir <strong>Gagal</strong> Diubah!');
			redirect('kasir');
		}
	}

	public function hapus($id){
		if ($this->session->login['level'] == 'kasir'){
			$this->session->set_flashdata('error', 'Hapus data hanya untuk admin!');
			redirect('penjualan');
		}

		if($this->m_user->hapus($id)){
			$this->session->set_flashdata('success', 'Data Kasir <strong>Berhasil</strong> Dihapus!');
			redirect('kasir');
		} else {
			$this->session->set_flashdata('error', 'Data Kasir <strong>Gagal</strong> Dihapus!');
			redirect('kasir');
		}
	}

	public function export(){
		$dompdf = new Dompdf();
	
		$this->data['all_kasir'] = $this->m_user->lihat();
		$this->data['title'] = 'Laporan Data Kasir';
		$this->data['no'] = 1;

		$dompdf->setPaper('A4', 'Landscape');
		$html = $this->load->view('kasir/report', $this->data, true);
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream('Laporan Data Kasir Tanggal ' . date('d F Y'), array("Attachment" => false));
	}
}