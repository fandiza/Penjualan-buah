<?php

use Dompdf\Dompdf;

class Penjualan extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if($this->session->login['level'] != 'kasir' && $this->session->login['level'] != 'admin') redirect();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->helper('tanggal_helper');
		$this->load->model('M_barang', 'm_barang');
		$this->load->model('M_barangmasuk', 'm_barangmasuk');
		$this->load->model('M_penjualan', 'm_penjualan');
		$this->load->model('M_detail_penjualan', 'm_detail_penjualan');
		$this->load->model('M_toko','m_toko');
		$this->load->model('M_laporanharian','m_laporanharian');
		$this->load->library('pdf');
		$this->data['aktif'] = 'penjualan';
	}

	public function index(){
		$this->data['title'] = 'Data Penjualan';
		$this->data['all_penjualan'] = $this->m_penjualan->lihat();

		$this->load->view('penjualan/lihat', $this->data);
	}

	public function tambah(){
		$this->data['title'] = 'Tambah Transaksi';
		$this->data['all_barang'] = $this->m_barang->lihat_stok();

		$this->load->view('penjualan/tambah', $this->data);
	}

	public function proses_tambah(){
		$jumlah_barang_dibeli = count($this->input->post('nama_barang_hidden'));
		$this->load->view('penjualan/cetak_detail',$this->data);
		
		$data_penjualan = [
			'no_penjualan' => $this->input->post('no_penjualan'),
			'nama_kasir' => $this->input->post('nama_kasir'),
			'tgl_penjualan' => date('Y-m-d'),
			'jam_penjualan' => $this->input->post('jam_penjualan'),
			'potongan' => $this->input->post('potongan'),
			'total' => $this->input->post('total_hidden'),
		];

		$data_detail_penjualan = [];

		for ($i=0; $i < $jumlah_barang_dibeli ; $i++) { 
			array_push($data_detail_penjualan, ['nama_barang' => $this->input->post('nama_barang_hidden')[$i]]);
			$data_detail_penjualan[$i]['no_penjualan'] = $this->input->post('no_penjualan');
			$data_detail_penjualan[$i]['harga_barang'] = $this->input->post('harga_barang_hidden')[$i];
			$data_detail_penjualan[$i]['jumlah_barang'] = $this->input->post('jumlah_hidden')[$i];
			$data_detail_penjualan[$i]['satuan'] = $this->input->post('satuan_hidden')[$i];
			$data_detail_penjualan[$i]['diskon'] = $this->input->post('diskon_hidden')[$i];
			$data_detail_penjualan[$i]['sub_total'] = $this->input->post('sub_total_hidden')[$i];
		}

		if($this->m_penjualan->tambah($data_penjualan) && $this->m_detail_penjualan->tambah($data_detail_penjualan)){
			for ($i=0; $i < $jumlah_barang_dibeli ; $i++) { 
				$this->m_barang->min_stok($data_detail_penjualan[$i]['jumlah_barang'], $data_detail_penjualan[$i]['nama_barang']) or die('gagal min stok');
			}
			$this->session->set_flashdata('success', 'Invoice <strong>Penjualan</strong> Berhasil Dibuat!');
			redirect('penjualan/detail/'.$data_penjualan['no_penjualan']);
		} else {
			$this->session->set_flashdata('success', 'Invoice <strong>Penjualan</strong> Berhasil Dibuat!');
			redirect('penjualan');
		}
	}

	public function detail($no_penjualan){
		$this->data['title'] = 'Detail Penjualan';
		$this->data['penjualan'] = $this->m_penjualan->lihat_no_penjualan($no_penjualan);
		$this->data['all_detail_penjualan'] = $this->m_detail_penjualan->lihat_no_penjualan($no_penjualan);
		$this->data['no'] = 1;

		$this->load->view('penjualan/detail', $this->data);
	}

	public function hapus($no_penjualan){
		if($this->m_penjualan->hapus($no_penjualan) && $this->m_detail_penjualan->hapus($no_penjualan)){
			$this->session->set_flashdata('success', 'Invoice Penjualan <strong>Berhasil</strong> Dihapus!');
			redirect('penjualan');
		} else {
			$this->session->set_flashdata('error', 'Invoice Penjualan <strong>Gagal</strong> Dihapus!');
			redirect('penjualan');
		}
	}


	public function get_all_barang(){
		$data = $this->m_barang->lihat_nama_barang($_POST['nama_barang']);
		$data->barang_masuk = $this->m_barangmasuk->lihat_satu_barang_yang_akan_exp_by_id(date('Y-m-d'), $data->id);
		if (!empty($data->barang_masuk)) {
			$data->barang_masuk->sisa_hari = date_diff(date_create($data->barang_masuk->exp), date_create())->d;
		}
		echo json_encode($data);
	}

	public function keranjang_barang(){
		$this->load->view('penjualan/keranjang');
	}

	public function export_detail($no_penjualan){
		$data['dataToko'] = $this->m_toko->lihat();
		$data['penjualan'] = $this->m_penjualan->lihat_no_penjualan($no_penjualan);
		$data['all_detail_penjualan'] = $this->m_detail_penjualan->lihat_no_penjualan($no_penjualan);

        $this->load->view('penjualan/cetak_detail', $data);

		$html = $this->output->get_output();

		$this->load->library('pdf');
		$this->pdf->load_html($html);
		$this->pdf->render();
		$this->pdf->stream("cetak-nota".".pdf",array('Attachment' => 0));
		
	}

	public function filter(){

		$tanggalawal = $this->input->post('tanggalawal');
        $tanggalakhir = $this->input->post('tanggalakhir');
		
		if (isset($_POST['sendEmail'])) {
			$this->sendMail($tanggalawal,$tanggalakhir);
		}
		
		$data['filter_penjualan'] = $this->m_penjualan->filterbytanggal($tanggalawal,$tanggalakhir);
		$data['total_pendapatan'] = $this->m_laporanharian->filterByDate($tanggalawal,$tanggalakhir);
        $data['title'] = "Laporan Penjualan";
        $data['subtitle'] = "Dari tanggal : ".format_indo($tanggalawal).' Sampai tanggal : '.format_indo($tanggalakhir);
        $this->pdf->set_option('isRemoteEnabled', true);
        $this->load->library('pdf');
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "Laporan Penjualan.pdf";
        $this->pdf->load_view('penjualan/penjualan_pdf', $data);

	}
	private function sendMail($tanggalawal,$tanggalakhir)
	{	
		$singleSendMail = true;
		$emailtoko = $this->m_penjualan->getDataToko();
		$item = $emailtoko;
		$singleSendMail = $this->singleSendMail($item,$tanggalawal,$tanggalakhir);

		if ($singleSendMail) {
			$this->session->set_flashdata('success', 'Sukses! email berhasil dikirim.');
			redirect('penjualan');
		} else {
			$this->session->set_flashdata('error', 'Email gagal dikirim.');
			redirect('penjualan');
		}
	}

	private function singleSendMail($item,$dateawal,$dateakhir)
	{
		$data['no'] = 1;
        $data['title'] = "Laporan Penjualan";
		$data['email_penjualan'] = $this->m_penjualan->filterbytanggal($dateawal,$dateakhir);
        $data['subtitle'] = "Dari tanggal : ".format_indo($tanggalawal).' Sampai tanggal : '.format_indo($tanggalakhir);

		$msgpdf = $this->load->view('penjualan/penjualan_email', $data, true);

		$this->load->library('pdf');
		$dompdf = new Dompdf();
		$dompdf->loadHtml($msgpdf);
		$dompdf->set_option('isRemoteEnabled', true);
		$dompdf->set_option('isHtml5ParserEnabled', true);
		$dompdf->setPaper('A4', 'portrait');
		$dompdf->render();
		$output = $dompdf->output();
		$filename = '';
		$filename = 'Laporan Penjualan.pdf';
		if (file_exists(base_url('assets/pdf/') . $filename)) {
			unlink($filename);
		}
		file_put_contents('assets/pdf/' . $filename, $output);

		$config = [
			'mailtype'  => 'html',
			'charset'   => 'utf-8',
			'protocol'  => 'smtp',
			'smtp_host' => 'smtp.gmail.com',
			'smtp_user' => 'noviaruhu@gmail.com',
			'smtp_pass'   => 'noviaruhu@gmail',
			'smtp_crypto' => 'tls',
			'smtp_port'   => 587,
			'crlf'    => "\r\n",
			'newline' => "\r\n"
		];
		$this->email->initialize($config);
		$this->email->clear(TRUE);
		$this->email->from('noviaruhu@gmail.com', 'akuntugas');
		$this->email->to($item);
		$this->email->subject('Laporan Harian');
		$this->email->message('Laporan Penjualan');
		$this->email->attach('assets/pdf/' . $filename);

		if ($this->email->send()) {
			return true;
		} else {
			echo $this->email->print_debugger();
			die;
		}
	}
}