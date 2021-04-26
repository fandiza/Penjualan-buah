<?php

class M_supplier extends CI_Model{
	protected $_table = 'supplier';

	public function lihat(){
		$query = $this->db->get($this->_table);
		return $query->result();
	}

	public function jumlah(){
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}

	public function lihat_id($id_supplier){
		$query = $this->db->get_where($this->_table, ['id_supplier' => $id_supplier]);
		return $query->row();
	}

	public function lihat_username($id_supplier){
		$query = $this->db->get_where($this->_table, ['id_supplier' => $id_supplier]);
		return $query->row();
	}

	public function tambah($data){
		return $this->db->insert($this->_table, $data);
	}

	public function ubah($data, $id_supplier){
		$query = $this->db->set($data);
		$query = $this->db->where(['id_supplier' => $id_supplier]);
		$query = $this->db->update($this->_table);
		return $query;
	}

	public function hapus($id_supplier){
		$this->db->delete(barang_masuk, ['id_supplier' => $id_supplier]);
		return $this->db->delete($this->_table, ['id_supplier' => $id_supplier]);
		
	}
}