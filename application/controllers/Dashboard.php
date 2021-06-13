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

	public function ceknotif()
	{
		header('Content-Type: application/json');
		$data['stok'] = $this->m_barang->lihat_stok(['stok < '=> 20]);
		$data['kadaluarsa'] = $this->m_barangmasuk->lihat_barang_yang_belum_exp(date('Y-m-d'));

		$data['kadaluarsa'] = [];
		$data_kadaluarsa = $this->m_barangmasuk->lihat_barang_yang_belum_exp(date('Y-m-d'));

		foreach ($data_kadaluarsa as $key_barang_masuk => $value_barang_masuk) {
			$value_barang_masuk->sisa_hari = date_diff(date_create($value_barang_masuk->exp), date_create())->d;
			$value_barang_masuk->nama_barang = $this->db->get_where('barang',['id'=> $value_barang_masuk->id_barang])->row()->nama_barang;
			if ($value_barang_masuk->sisa_hari <= 2) {
				$data['kadaluarsa'][] = $value_barang_masuk;
			}
		}
		
		echo json_encode($data);
	}
}