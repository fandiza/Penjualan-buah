<?php

class M_user extends CI_Model{
	protected $_table = 'user';

	public function lihat(){
		$query = $this->db->get($this->_table);
		return $query->result();
	}

	public function jumlah(){
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}

	public function lihat_id($id_user){
		$query = $this->db->get_where($this->_table, ['id_user' => $id_user]);
		return $query->row();
	}

	public function lihat_username($username){
		$query = $this->db->get_where($this->_table, ['username' => $username]);
		return $query->row();
	}

	public function tambah($data){
		return $this->db->insert($this->_table, $data);
	}

	public function ubah($data, $id_user){
		$query = $this->db->set($data);
		$query = $this->db->where(['id_user' => $id_user]);
		$query = $this->db->update($this->_table);
		return $query;
	}

	public function set_lastLogin(){
		date_default_timezone_set("ASIA/JAKARTA");
		$now = date('Y-m-d H:i:s');
		$id_user = $this->session->login['id_user'];
		$data = array('last_login' => $now);
		$this->db->set($data);
		$this->db->where(['id_user' => $id_user]);
		$this->db->update($this->_table);
	}

	public function hapus($id_user){
		return $this->db->delete($this->_table, ['id_user' => $id_user]);
	}
}