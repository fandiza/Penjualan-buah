<!DOCTYPE html>
<html>

<style type="text/css">
.kop-surat {
    line-height: 50%;
}

table {
    margin: auto;


}
.table-one{
    position: relative;
    float: left;
    width: 45%;
}

</style>

<body>
    <table>
        <tr>
           
            <td>
                <div class="kop-surat">
                    <center>
                        <a><b><h1>Toko Buah Bening</h1></b></a>
                        <p>
                            <a>Jl. Raya Bening No.29, Beru, Kec. Wlingi, Blitar, Jawa Timur 66184</a>
                        <p>
                            <a>Telp : 081252400952</a>
                        
                    </center>
                </div>
            </td>
        </tr>
    </table>
    <hr>
							<div class="table-one">
								<table>
									<tr>
										<td><strong>No Penjualan</strong></td>
										<td>:</td>
										<td><?= $penjualan->no_penjualan ?></td>
									</tr>
									<tr>
										<td><strong>Nama Kasir</strong></td>
										<td>:</td>
										<td><?= $penjualan->nama_kasir ?></td>
									</tr>
									<tr>
										<td><strong>Waktu Penjualan</strong></td>
										<td>:</td>
										<td><?= format_indo($penjualan->tgl_penjualan) ?> - <?= $penjualan->jam_penjualan ?></td>
									</tr>
								</table>
							</div>
						<br><br><br><br>
                            <div>
								<table width="100%" cellspacing="0" border="0">
									<thead>
										<tr>
											<td><strong>No</strong></td>
											<td><strong>Nama Barang</strong></td>
											<td><strong>Harga Barang</strong></td>
											<td><strong>Jumlah</strong></td>
											<td><strong>Diskon</strong></td>
											<td><strong>Sub Total</strong></td>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($all_detail_penjualan as $detail_penjualan): ?>
											<tr>
												<td><?= $no++ ?></td>
												<td><?= $detail_penjualan->nama_barang ?></td>
												<td>Rp <?= number_format($detail_penjualan->harga_barang, 0, ',', '.') ?></td>
												<td><?= $detail_penjualan->jumlah_barang ?> <?= strtoupper($detail_penjualan->satuan) ?></td>
												<td><?= $detail_penjualan->diskon ?>%</td>
												<td>Rp <?= number_format($detail_penjualan->sub_total, 0, ',', '.') ?></td>
											</tr>
										<?php endforeach ?>
									</tbody>
									<tfoot>
										<tr>
											<td colspan="5" align="right"><strong>Total : </strong></td>
											<td>Rp <?= number_format($penjualan->total, 0, ',', '.') ?></td>
										</tr>
									</tfoot>
								</table>
                            </div>

                                <center>
                        <a><b><h4>Terima Kasih</h4></b></a>
                    </center>
    
    
</body>

<script>
	windows.print();
</script>

</html>

<script src="<?= base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url(); ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="<?= base_url(); ?>/assets/js/sb-admin-2.min.js"></script>
<script src="<?= base_url(); ?>assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>assets/js/demo/datatables-demo.js"></script>