<?php

use Dompdf\Dompdf;

class Barang extends CI_Controller{
	public function __construct(){
		parent::__construct();
		if($this->session->login['level'] != 'kasir' && $this->session->login['level'] != 'admin') redirect();
		$this->data['aktif'] = 'barang';
		$this->load->model('M_barang', 'm_barang');
		$this->load->model('M_barangmasuk', 'm_barangmasuk');
		$this->load->library('pdf');
	}

	public function index(){
		$this->data['title'] = 'Data Barang';
		$this->data['all_barang'] = [];
		$databarang = $this->m_barang->lihat();
		foreach ($databarang as $key_all_barang => $value_all_barang) {
			$data_pengurangan = 0;
			$value_all_barang->total_barang_masuk = $this->m_barangmasuk->jumlah_barang_masuk_all_by_id($value_all_barang->id);
			$value_all_barang->total_barang_masuk_sudah_exp = $this->m_barangmasuk->jumlah_barang_masuk_sudah_exp_by_id($value_all_barang->id, date('Y-m-d'));
			$value_all_barang->total_barang_masuk_belum_exp = $this->m_barangmasuk->jumlah_barang_masuk_belum_exp_by_id($value_all_barang->id, date('Y-m-d'));

			$value_all_barang->barang_masuk = [];
			$data_value_all_barang = $this->m_barangmasuk->lihat_barang_yang_belum_exp_by_id(date('Y-m-d'), $value_all_barang->id);

			foreach ($data_value_all_barang as $key_barang_masuk => $value_barang_masuk) {
				$value_barang_masuk->sisa_hari = date_diff(date_create($value_barang_masuk->exp), date_create())->d;
				$data_pengurangan = $value_all_barang->stok - $value_barang_masuk->jumlah;
				$value_barang_masuk->jumlah_pengurangan = $data_pengurangan;

				// if ($data_pengurangan > 0) {
					$value_all_barang->barang_masuk[] = $value_barang_masuk;
				// }
			}
			$this->data['all_barang'][] = $value_all_barang;
		}
		$this->data['no'] = 1;

		$this->load->view('barang/lihat', $this->data);
	}

	public function tambah(){
		$this->data['title'] = 'Tambah Barang';

		$this->load->view('barang/tambah', $this->data);
	}

	public function proses_tambah(){
		$data = [
			'id' => $this->input->post('id'),
			'nama_barang' => $this->input->post('nama_barang'),
			'harga_beli' => $this->input->post('harga_beli'),
			'harga_jual' => $this->input->post('harga_jual'),
			'stok' => $this->input->post('stok'),
			'satuan' => $this->input->post('satuan'),
		];

		if($this->m_barang->tambah($data)){
			$this->session->set_flashdata('success', 'Data Barang <strong>Berhasil</strong> Ditambahkan!');
			redirect('barang');
		} else {
			$this->session->set_flashdata('error', 'Data Barang <strong>Gagal</strong> Ditambahkan!');
			redirect('barang');
		}
	}

	public function ubah($id){

		$this->data['title'] = 'Ubah Barang';
		$this->data['barang'] = $this->m_barang->lihat_id($id);

		$this->load->view('barang/ubah', $this->data);
	}

	public function proses_ubah($id){

		$data = [
			'id' => $this->input->post('id'),
			'nama_barang' => $this->input->post('nama_barang'),
			'harga_beli' => $this->input->post('harga_beli'),
			'harga_jual' => $this->input->post('harga_jual'),
			'stok' => $this->input->post('stok'),
			'satuan' => $this->input->post('satuan'),
		];

		if($this->m_barang->ubah($data, $id)){
			$this->session->set_flashdata('success', 'Data Barang <strong>Berhasil</strong> Diubah!');
			redirect('barang');
		} else {
			$this->session->set_flashdata('error', 'Data Barang <strong>Gagal</strong> Diubah!');
			redirect('barang');
		}
	}

	public function hapus($id){
		
		if($this->m_barang->hapus($id)){
			$this->session->set_flashdata('success', 'Data Barang <strong>Berhasil</strong> Dihapus!');
			redirect('barang');
		} else {
			$this->session->set_flashdata('error', 'Data Barang <strong>Gagal</strong> Dihapus!');
			redirect('barang');
		}
	}
	
	public function barang_rusak(){
		$this->data['title'] = 'Tambah Barang Rusak';
		$this->data['all_barang'] = $this->m_barang->lihat();
		$this->load->view('barang/barang_rusak', $this->data);
	}

	public function proses_barang_rusak(){
		$id = $this->input->post('id');
		$data = $this->db->get_where('barang', ['id' => $this->input->post('id')])->row_array();
		$stok = $data['stok'] - $this->input->post('rusakBaru');
		$stokRusak = $data['stok_rusak'] + $this->input->post('rusakBaru');

		$update = [
			'stok' => $stok,
			'stok_rusak' => $stokRusak
		];

		$this->m_barang->ubah($update, $id);
		$this->session->set_flashdata('success', 'Data Barang Rusak <strong>Berhasil</strong> Ditambahkan!');
		redirect('barang');
	}

	public function barangRusak($id){
		$getData = $this->db->get_where('barang', ['id' => $id])->row_array();
		echo json_encode($getData);
	}

	public function pdf(){

			$data['filter_barang'] = $this->m_barang->lihat();
            $data['title'] = "Laporan Daftar Barang";
            $this->pdf->set_option('isRemoteEnabled', true);
            $this->load->library('pdf');
            $this->pdf->setPaper('A4', 'potrait');
            $this->pdf->filename = "Daftar Barang.pdf";
            $this->pdf->load_view('barang/barang_pdf', $data);

	}
}