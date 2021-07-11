<?php

class M_barang extends CI_Model{
	protected $_table = 'barang';

	public function lihat(){
		$query = $this->db->get($this->_table);
		return $query->result();
	}

	public function jumlah(){
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}

	public function lihat_stok($custom_where = null){
		if (empty($custom_where)) {
			$query = $this->db->get_where($this->_table, 'stok > 1');
			return $query->result();
		}else{
			$query = $this->db
					->where('stok > 1')
					->where($custom_where)
					->get($this->_table);
			return $query->result();
		}
	}

	public function lihat_id($id){
		$query = $this->db->get_where($this->_table, ['id' => $id]);
		return $query->row();
	}

	public function lihat_nama_barang($nama_barang){
		$query = $this->db->select('*');
		$query = $this->db->where(['nama_barang' => $nama_barang]);
		$query = $this->db->get($this->_table);
		return $query->row();
	}

	public function get_stok_by_id($id){
		$query = $this->db->select('stok');
		$query = $this->db->where(['id' => $id]);
		$query = $this->db->get($this->_table);
		$hasil = $query->row();
		return $hasil->stok;
	}

	public function getStokAwal($id){
		$query = $this->db->select('stok_awal');
		$query = $this->db->where(['id' => $id]);
		$query = $this->db->get($this->_table);
		$hasil = $query->row();
		return $hasil->stok;
	}

	public function tambah($data){
		return $this->db->insert($this->_table, $data);
	}

	public function min_stok($stok, $nama_barang){
		$query = $this->db->set('stok', 'stok-' . $stok, false);
		$query = $this->db->where('nama_barang', $nama_barang);
		$query = $this->db->update($this->_table);
		return $query;
	}

	public function ubah($data, $id){
		$query = $this->db->set($data);
		$query = $this->db->where(['id' => $id]);
		$query = $this->db->update($this->_table);
		return $query;
	}

	public function ubah_stok_barang($stok, $stok_awal, $id){
		$query = $this->db->set('stok', $stok);	
		$query = $this->db->set('stok_awal', $stok_awal);
		$query = $this->db->where(['id' => $id]);
		$query = $this->db->update($this->_table);
		return $query;
	}

	public function ubah_stok($stok,$jumlah, $id){
		$query = $this->db->set('stok', $stok);
		$query = $this->db->set('stok_rusak', $jumlah);		
		$query = $this->db->where(['id' => $id]);
		$query = $this->db->update($this->_table);
		return $query;
	}

	public function hapus($id){
		$this->db->delete(barang_masuk, ['id_barang' => $id]);
		return $this->db->delete($this->_table, ['id' => $id]);
	}
}