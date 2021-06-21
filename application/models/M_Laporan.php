<?php

class M_Laporan extends CI_Model {

	
    public function penghasilan_GetAll(){
            $query = "SELECT ROUND((b.harga_beli * ROUND(SUM(bm.jumlah),1)),0) AS modal, (ROUND(SUM(bm.jumlah),1) - b.stok) AS barang_terjual,((b.harga_jual) * (ROUND(SUM(bm.jumlah),1) - b.stok)) AS laba_kotor , (((b.harga_jual) * (ROUND(SUM(bm.jumlah),1) - b.stok)) - ROUND((b.harga_beli * ROUND(SUM(bm.jumlah),1)),0)) AS laba_bersih FROM barang AS b INNER JOIN barang_masuk AS bm ON b.id = bm.id_barang WHERE YEAR(bm.tanggalmasuk) = YEAR(NOW())";
        

        return $this->db->query($query)->row_array();
    }
    
    public function penghasilan_ById($data){
        $query = "SELECT ROUND((b.harga_beli * ROUND(SUM(bm.jumlah),1)),0) AS modal, (ROUND(SUM(bm.jumlah),1) - b.stok) AS barang_terjual,((b.harga_jual) * (ROUND(SUM(bm.jumlah),1) - b.stok)) AS laba_kotor , (((b.harga_jual) * (ROUND(SUM(bm.jumlah),1) - b.stok)) - (b.harga_beli * ROUND(SUM(bm.jumlah),1))) AS laba_bersih FROM barang AS b INNER JOIN barang_masuk AS bm ON b.id = bm.id_barang WHERE id = $data AND YEAR(bm.tanggalmasuk) = YEAR(NOW())";

        return $this->db->query($query)->row_array();
    }
    public function filterByYear($year){
        $query ="SELECT ROUND((b.harga_beli * ROUND(SUM(bm.jumlah),1)),0) AS modal, (ROUND(SUM(bm.jumlah),1) - b.stok) AS barang_terjual,((b.harga_jual) * (ROUND(SUM(bm.jumlah),1) - b.stok)) AS laba_kotor , (((b.harga_jual) * (ROUND(SUM(bm.jumlah),1) - b.stok)) - ROUND((b.harga_beli * ROUND(SUM(bm.jumlah),1)),0)) AS laba_bersih FROM barang AS b INNER JOIN barang_masuk AS bm ON b.id = bm.id_barang WHERE YEAR(bm.tanggalmasuk) = $year";

        return $this->db->query($query)->row_array();
    }
}