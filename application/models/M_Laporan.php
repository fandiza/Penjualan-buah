<?php

class M_Laporan extends CI_Model {

	
    public function penghasilan_GetAll(){
        $query = "SELECT SUM(stok_utama - stok) as barang_terjual, SUM((stok_utama - stok) * harga_jual) as laba_kotor, SUM((stok_utama - stok) * harga_beli) as modal , SUM(((stok_utama - stok) * harga_jual) - ((stok_utama - stok) * harga_beli )) as laba_bersih FROM barang";

        return $this->db->query($query)->row_array();
    }
    
    public function penghasilan_ById($data){
        $query = "SELECT (stok_utama - stok) as barang_terjual, ((stok_utama - stok) * harga_jual) as laba_kotor,((stok_utama - stok) * harga_beli) as modal , (((stok_utama - stok) * harga_jual) - ((stok_utama - stok) * harga_beli )) as laba_bersih
        FROM barang WHERE id = $data";

        return $this->db->query($query)->row_array();
    }

}