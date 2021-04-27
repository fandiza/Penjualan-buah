<?php

class M_barangmasuk extends CI_Model {
	protected $_table = 'barang_masuk';

	public function lihat(){
	 $this->db->select('barang_masuk.*, barang.nama_barang, supplier.nama_sup, user.nama');
        $this->db->join('supplier', 'barang_masuk.id_supplier = supplier.id_supplier');
        $this->db->join('barang', 'barang_masuk.id_barang = barang.id');
		$this->db->join('user', 'barang_masuk.id_user = user.id_user');
		return $this->db->get($this->_table)->result();
		
	} 
    public function jumlah(){
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}

	public function lihat_stok(){
		$query = $this->db->get_where($this->_table, 'stok > 1');
		return $query->result();
	}

	public function lihat_id($id_barang_masuk){
		$this->db->select('barang_masuk.*, barang.nama_barang, supplier.nama_sup');
        $this->db->join('supplier', 'barang_masuk.id_supplier = supplier.id_supplier');
        $this->db->join('barang', 'barang_masuk.id_barang = barang.id');
		
		$query = $this->db->get_where($this->_table, ['id_barang_masuk' => $id_barang_masuk]);
		return $query->row();
	}

	public function lihat_nama_barang($nama_barang){
		$query = $this->db->select('*');
		$query = $this->db->where(['nama_barang' => $nama_barang]);
		$query = $this->db->get($this->_table);
		return $query->row();
	}
	public function jumlahbm(){
		$query = $this->db->get($this->_table);
		return $query->num_rows();
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

	public function ubah($data, $id_barang_masuk){
		$query = $this->db->set($data);
		$query = $this->db->where(['id_barang_masuk' => $id_barang_masuk]);
		$query = $this->db->update($this->_table);
		return $query;
	}

	public function hapus($id_barang_masuk){
		return $this->db->delete($this->_table, ['id_barang_masuk' => $id_barang_masuk]);
	}

	public function get_id_barang($id_barang_masuk){
		$query = $this->db->select($id_barang);
		$query = $this->db->where(['id_barang_masuk' => $id_barang_masuk]);
		$query = $this->db->get($this->_table);
		$hasil = $query->row();
		return $hasil->id_barang;
	} 

	public function get_jumlah($id_barang_masuk){
		$query = $this->db->select($jumlah);
		$query = $this->db->where(['id_barang_masuk' => $id_barang_masuk]);
		$query = $this->db->get($this->_table);
		$hasil = $query->row();
		return $hasil->jumlah;
	}
}