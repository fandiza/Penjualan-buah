<?php

use Dompdf\Dompdf;

class admin extends CI_Controller{
	public function __construct(){
		parent::__construct();
		// if($this->session->login['level'] != 'kasir' && $this->session->login['level'] != 'admin') redirect();
		$this->data['aktif'] = 'admin';
		$this->load->model('M_user', 'm_user');
	}

	public function index(){
		$this->data['title'] = 'Data admin';
		$this->data['all_admin'] = $this->m_user->lihat();
		$this->data['no'] = 1;

		$this->load->view('admin/lihat', $this->data);
	}

	public function tambah(){
		if ($this->session->login['level'] == 'kasir'){
			$this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
			redirect('penjualan');
		}

		$this->data['title'] = 'Tambah admin';

		$this->load->view('admin/tambah', $this->data);
	}

	public function proses_tambah(){
		if ($this->session->login['level'] == 'kasir'){
			$this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
			redirect('penjualan');
		}

		$data = [
			
			'nama' => $this->input->post('nama'),
			'username' => $this->input->post('username'),
			'password' => md5($this->input->post('password')),
			'level' => $this->input->post('level'),
		];

		if($this->m_user->tambah($data)){
			$this->session->set_flashdata('success', 'Data admin <strong>Berhasil</strong> Ditambahkan!');
			redirect('admin');
		} else {
			$this->session->set_flashdata('error', 'Data admin <strong>Gagal</strong> Ditambahkan!');
			redirect('admin');
		}
	}

	public function ubah($id){
		if ($this->session->login['level'] == 'kasir'){
			$this->session->set_flashdata('error', 'Ubah data hanya untuk admin!');
			redirect('penjualan');
		}

		$this->data['title'] = 'Ubah admin';
		$this->data['admin'] = $this->m_user->lihat_id($id);

		$this->load->view('admin/ubah', $this->data);
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
			$this->session->set_flashdata('success', 'Data admin <strong>Berhasil</strong> Diubah!');
			redirect('admin');
		} else {
			$this->session->set_flashdata('error', 'Data admin <strong>Gagal</strong> Diubah!');
			redirect('admin');
		}
	}

	public function hapus($id){
		if ($this->session->login['level'] == 'kasir'){
			$this->session->set_flashdata('error', 'Hapus data hanya untuk admin!');
			redirect('penjualan');
		}

		if($this->m_user->hapus($id)){
			$this->session->set_flashdata('success', 'Data admin <strong>Berhasil</strong> Dihapus!');
			redirect('admin');
		} else {
			$this->session->set_flashdata('error', 'Data admin <strong>Gagal</strong> Dihapus!');
			redirect('admin');
		}
	}

	public function export(){
		$dompdf = new Dompdf();
	
		$this->data['all_admin'] = $this->m_user->lihat();
		$this->data['title'] = 'Laporan Data admin';
		$this->data['no'] = 1;

		$dompdf->setPaper('A4', 'Landscape');
		$html = $this->load->view('admin/report', $this->data, true);
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream('Laporan Data admin Tanggal ' . date('d F Y'), array("Attachment" => false));
	}
}