<?php

class M_laporanharian extends CI_Model {

	public function totalpendapatan(){
        $query = "SELECT SUM(case when tgl_penjualan = date(current_date) then total else 0 end) as harian FROM penjualan";

        return $this->db->query($query)->row_array();
    }

    public function totbarangterjual(){
        $query = "SELECT SUM(CASE WHEN p.tgl_penjualan = DATE(CURRENT_DATE) THEN dp.jumlah_barang else 0 end) as totbarang FROM detail_penjualan as dp 
        INNER JOIN penjualan as p ON dp.no_penjualan = p.no_penjualan";

        return $this->db->query($query)->row_array();
    }

    public function totpenjualan(){
        $query = "SELECT COUNT(id) as total FROM penjualan WHERE tgl_penjualan = date(CURRENT_DATE)";

        return $this->db->query($query)->row_array();
    }

    public function baranglaris(){
        $query = "SELECT dp.nama_barang as namabuah, COUNT(dp.nama_barang) as nama FROM detail_penjualan as dp INNER JOIN penjualan as p ON dp.no_penjualan = p.no_penjualan WHERE p.tgl_penjualan = DATE(CURRENT_DATE) GROUP BY dp.nama_barang ORDER BY nama DESC LIMIT 1";

        return $this->db->query($query)->row_array();
    }

    public function getIncomeBasedDay() {
        $query = "SELECT Date(tgl_penjualan) as day, SUM(CASE WHEN EXTRACT(DAY FROM tgl_penjualan) 
        = EXTRACT(DAY FROM tgl_penjualan) THEN total ELSE 0 END) as revenue 
        FROM penjualan GROUP BY day ORDER BY id ASC ";

        return $this->db->query($query)->result_array();
    }
    
}