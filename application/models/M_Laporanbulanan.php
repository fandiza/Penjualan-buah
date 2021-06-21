<?php

class M_Laporanbulanan extends CI_Model {

	public function totalpendapatan(){
        $query = "SELECT SUM(case when extract(month from tgl_penjualan) = extract(month from current_date) then total else 0 end) as harian FROM penjualan WHERE YEAR(tgl_penjualan) = YEAR(NOW())";

        return $this->db->query($query)->row_array();
    }

    public function totbarangterjual(){
        $query = "SELECT ROUND(SUM(CASE WHEN extract(month from p.tgl_penjualan) = extract(month from CURRENT_DATE) THEN dp.jumlah_barang else 0 end)) as totbarang FROM detail_penjualan as dp 
        INNER JOIN penjualan as p ON dp.no_penjualan = p.no_penjualan WHERE YEAR(p.tgl_penjualan) = YEAR(NOW())";

        return $this->db->query($query)->row_array();
    }

    public function totpenjualan(){
        $query = "SELECT ROUND(COUNT(id)) as total FROM penjualan WHERE month(tgl_penjualan) = month(CURRENT_DATE) AND YEAR(tgl_penjualan) = YEAR(NOW())";

        return $this->db->query($query)->row_array();
    }

    public function baranglaris(){
        $query = "SELECT dp.nama_barang as namabuah, COUNT(dp.nama_barang) as nama 
        FROM detail_penjualan as dp INNER JOIN penjualan as p ON dp.no_penjualan = p.no_penjualan 
        WHERE month(p.tgl_penjualan) = month(CURRENT_DATE) AND YEAR(p.tgl_penjualan) = YEAR(NOW())
        GROUP BY dp.nama_barang ORDER BY nama DESC LIMIT 1";

        return $this->db->query($query)->row_array();
    }

    public function getIncomeBasedmonth() {
        $query = "SELECT MONTH(tgl_penjualan) as month, ROUND(SUM(CASE WHEN EXTRACT(MONTH FROM tgl_penjualan) 
        = EXTRACT(MONTH FROM tgl_penjualan) THEN total ELSE 0 END)) as revenue 
        FROM penjualan GROUP BY month ORDER BY id ASC LIMIT 7";

        return $this->db->query($query)->result_array();
    }

    public function filterByMonth($start, $end){
        $query = "SELECT ROUND(SUM(p.total)) as harian, ROUND(SUM(dp.jumlah_barang)) as totbarang, COUNT(p.id) as total, dp.nama_barang as namabuah, COUNT(dp.nama_barang) as nama
        FROM penjualan as p
        INNER JOIN detail_penjualan as dp ON p.no_penjualan = dp.no_penjualan
        WHERE YEAR(NOW()) = YEAR(NOW()) AND MONTH(p.tgl_penjualan) BETWEEN $start AND $end
        ";

        return $this->db->query($query)->row_array();
    }
    public function getDataByMonth($start, $end){
        $query = "SELECT dp.nama_barang as nama_barang , p.tgl_penjualan as tanggal_penjualan,  dp.harga_barang as harga_barang, dp.jumlah_barang as jumlah, dp.sub_total as total FROM detail_penjualan as dp INNER JOIN penjualan as p ON dp.no_penjualan = p.no_penjualan  WHERE YEAR(NOW()) = YEAR(NOW()) AND MONTH(p.tgl_penjualan) BETWEEN $start AND $end";

        return $this->db->query($query)->result_array();
    }
}