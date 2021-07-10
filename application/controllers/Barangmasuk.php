<?php


class Barangmasuk extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if($this->session->login['level'] != 'kasir' && $this->session->login['level'] != 'admin') redirect();
		
		$this->load->model('M_barang', 'm_barang');
		$this->load->model('M_barangmasuk', 'm_barangmasuk');
		$this->load->model('M_supplier', 'm_supplier');
		$this->load->helper('Tanggal_Helper');
		$this->load->library('pdf');
		$this->data['aktif'] = 'barangmasuk';
	}

	public function index(){
		$this->data['title'] = 'Data Barang Masuk';
		$this->data['all_barangmasuk'] = $this->m_barangmasuk->lihat();
		$this->data['no'] = 1;
		$this->load->view('barangmasuk/lihat', $this->data);
	}
	public function tambah(){
		// if ($this->session->login['level'] == 'kasir'){
		// 	$this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
		// 	redirect('penjualan');
		// }

		$this->data['title'] = 'Tambah Barang Masuk';
		$this->data['all_barang'] = $this->m_barang->lihat();
		$this->data['all_supplier'] = $this->m_supplier->lihat();
		$this->load->view('barangmasuk/tambah', $this->data);
	}

	public function proses_tambah(){
		// if ($this->session->login['level'] == 'kasir'){
		// 	$this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
		// 	redirect('penjualan');
		// }

		$data = [
			'tanggalmasuk' => $this->input->post('tanggalmasuk'),
			'exp' => $this->input->post('exp'),
			'jumlah' => $this->input->post('jumlah'),
			'id_supplier' => $this->input->post('id_supplier'),
			'id_barang' => $this->input->post('id_barang'),
			'id_user' => $this->input->post('id_user'),
		];

		if($this->m_barangmasuk->tambah($data)){
			$id_barang = $this->input->post('id_barang');
			$jumlah = $this->input->post('jumlah');
			$stok = $this->m_barang->get_stok_by_id($id_barang);
			
			$total = $stok + $jumlah;
			$this->m_barang->ubah_stok_barang($total, $id_barang);
			$this->session->set_flashdata('success', 'Data Barang Masuk <strong>Berhasil</strong> Ditambahkan!');
			redirect('barangmasuk');
		} else {
			$this->session->set_flashdata('error', 'Data Barang Masuk <strong>Gagal</strong> Ditambahkan!');
			redirect('barangmasuk');
		}
	}

	public function ubah($id_barang_masuk){
		// if ($this->session->login['level'] == 'kasir'){
		// 	$this->session->set_flashdata('error', 'Ubah data hanya untuk admin!');
		// 	redirect('penjualan');
		// }

		$this->data['title'] = 'Ubah Barang Masuk';
		$this->data['barangmasuk'] = $this->m_barangmasuk->lihat_id($id_barang_masuk);
		$this->data['all_supplier'] = $this->m_supplier->lihat();

		$this->load->view('barangmasuk/ubah', $this->data);
	}

	public function proses_ubah($id_barang_masuk){
		// if ($this->session->login['level'] == 'kasir'){
		// 	$this->session->set_flashdata('error', 'Ubah data hanya untuk admin!');
		// 	redirect('penjualan');
		// }

		$data = [
			'tanggalmasuk' => $this->input->post('tanggalmasuk'),
			'exp' => $this->input->post('exp'),
			'jumlah' => $this->input->post('jumlah'),
			'id_supplier' => $this->input->post('id_supplier'),
			'id_barang' => $this->input->post('id_barang'),
			'id_user' => $this->input->post('id_user'),
		];

		if($this->m_barangmasuk->ubah($data, $id_barang_masuk)){
			$id_barang = $this->input->post('id_barang');
			$jumlah_baru = $this->input->post('jumlah');
			$jumlah_lama = $this->input->post('jumlah_lama');
			$stok = $this->m_barang->get_stok_by_id($id_barang);
			$selisih = $jumlah_baru - $jumlah_lama;
			$total = $stok + $selisih;
			$this->m_barang->ubah_stok_barang($total, $id_barang);
			$this->session->set_flashdata('success', 'Data Barang <strong>Berhasil</strong> Diubah!');
			redirect('barangmasuk');
		} else {
			$this->session->set_flashdata('error', 'Data Barang <strong>Gagal</strong> Diubah!');
			redirect('barangmasuk');
		}
	}
	public function hapus($id_barang_masuk){
		// if ($this->session->login['level'] == 'kasir'){
		// 	$this->session->set_flashdata('error', 'Hapus data hanya untuk admin!');
		// 	redirect('penjualan');
		// }

		// Logika Pengurangan Stok
		$id_barang = $this->m_barangmasuk->get_id_barang($id_barang_masuk);
		$jumlah = $this->m_barangmasuk->get_jumlah($id_barang_masuk);
		$stok = $this->m_barang->get_stok_by_id($id_barang);
		$total = $stok - $jumlah;
		$this->m_barang->ubah_stok($total, $id_barang);

		if($this->m_barangmasuk->hapus($id_barang_masuk)){
			
			$this->session->set_flashdata('success', 'Data admin <strong>Berhasil</strong> Dihapus!');
			redirect('barangmasuk');
		} else {
			$this->session->set_flashdata('error', 'Data admin <strong>Gagal</strong> Dihapus!');
			redirect('barangmasuk');
		}
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
}