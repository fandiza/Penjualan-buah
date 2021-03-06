<?php

class M_penjualan extends CI_Model {
	protected $_table = 'penjualan';

	public function lihat(){
		return $this->db->get($this->_table)->result();
	} 

	public function jumlah(){
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}

	public function lihat_no_penjualan($no_penjualan){
		return $this->db->get_where($this->_table, ['no_penjualan' => $no_penjualan])->row();
	}

	public function tambah($data){
		return $this->db->insert($this->_table, $data);
	}

	public function hapus($no_penjualan){
		return $this->db->delete($this->_table, ['no_penjualan' => $no_penjualan]);
	}

	public function filterbytanggal($tanggalawal, $tanggalakhir){
        $query = $this->db->query("SELECT * FROM penjualan
         WHERE DATE(tgl_penjualan) 
            BETWEEN '$tanggalawal' AND '$tanggalakhir' ORDER BY tgl_penjualan ASC");
        return $query->result_array();
    }

	public function getDataToko(){
		$query = "SELECT email FROM data_toko WHERE id = 1";
		return $this->db->query($query)->row_array();
	}
}