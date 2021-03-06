<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view('partials/head.php') ?>
</head>

<body id="page-top">
	<div id="wrapper">
		<!-- load sidebar -->
		<?php $this->load->view('partials/sidebar.php') ?>

		<div id="content-wrapper" class="d-flex flex-column">
			<div id="content" data-url="<?= base_url('penjualan') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
					<div class="clearfix">
						<div class="float-left">
							<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
						</div>
						<div class="float-right">
							<a href="<?= base_url('penjualan') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col">
							<div class="card shadow">
								<div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
								<div class="card-body">
									<form action="<?= base_url('penjualan/proses_tambah') ?>" id="form-tambah" method="POST">
										<h5>Data Kasir</h5>
										<hr>
										<div class="form-row">
											<div class="form-group col-2">
												<label>No. Penjualan</label>
												<input type="text" name="no_penjualan" value="<?= date('Hisdmy') ?>" readonly class="form-control">
											</div>

											<div class="form-group col-2">
												<label>Nama Kasir</label>
												<input type="text" name="nama_kasir" value="<?= $this->session->login['nama'] ?>" readonly class="form-control">
											</div>
											<div class="form-group col-2">
												<label>Tanggal Penjualan</label>
												<input type="text" name="tgl_penjualan" value="<?= date('d/m/Y') ?>" readonly class="form-control">
											</div>
											<div class="form-group col-2">
												<label>Jam</label>
												<input type="text" name="jam_penjualan" value="<?= date('H:i:s') ?>" readonly class="form-control">
											</div>
										</div>
										<div class="form-row">
										
										<div class="form-group col-3">
											<label>Atur Potongan</label>
												<div class="input-group col-12">
													<input type="number" class="form-control" id="potongankg" value="20" disabled>
													<div class="input-group-append">
														<div class="input-group-text">Kg</div>
													</div>
												</div>
										</div>
										<div class="form-group col-3">
											<label>Atur Potongan</label>
												<div class="input-group col-12">
													<input type="number" class="form-control" id="potonganpersen" value="5" disabled>
													<div class="input-group-append">
														<div class="input-group-text">%</div>
													</div>
												</div>
										</div>

										</div>
										
									
										<h5>Data Barang</h5>
										<hr>
										<div class="form-row">
											<div class="form-group col-3">
												<label for="nama_barang">Nama Barang</label>
												<select name="nama_barang" id="nama_barang" class="form-control">
													<option value="">Pilih Barang</option>
													<?php foreach ($all_barang as $barang) : ?>
														<option value="<?= $barang->nama_barang ?>"><?= $barang->nama_barang ?></option>
													<?php endforeach ?>
												</select>
											</div>

											<div class="form-group col-2">
												<label>Harga Barang</label>
												<input type="text" name="harga_barang" value="" readonly class="form-control">
											</div>
											<div class="form-group col-2">
												<label>Jumlah</label>
												<input type="number" name="jumlah" value="" class="form-control" readonly min='1'>
											</div>
											<div class="form-group col-2">
												<label>Diskon Kadaluarsa<span id="ket_diskon"></span></label>
												<input type="text" name="diskon" value="" class="form-control" readonly min='0'>
											</div>
											<div class="form-group col-2">
												<label>Sub Total</label>
												<input type="number" name="sub_total" value="" class="form-control" readonly>
											</div>
											<div class="form-group col-1">
												<label for="">&nbsp;</label>
												<button disabled type="button" class="btn btn-primary btn-block" id="tambah"><i class="fa fa-plus"></i></button>
											</div>
											<input type="hidden" name="satuan" value="">
										</div>
										<div class="keranjang">
											<h5>Detail Pembelian</h5>
											<hr>
											<table class="table table-bordered" id="keranjang">
												<thead>
													<tr>
														<td width="20%">Nama Barang</td>
														<td width="15%">Harga</td>
														<td width="15%">Jumlah</td>
														<td width="10%">Satuan</td>
														<td width="10%">Diskon Kadaluarsa</td>
														<td width="10%">Sub Total</td>
														<td width="10%">Aksi</td>
													</tr>
												</thead>
												<tbody>

												</tbody>
												<tfoot>
													<tr>
														<td colspan="5" align="right"><strong>Total : </strong></td>
														<td id="total"></td>

														<td rowspan = "3">
															<input type="hidden" name="total_hidden" value="">
															<input type="hidden" name="max_hidden" value="">
															<button disabled id="simpan_total" type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
														</td>
													</tr>
													<tr>
														<td colspan="5" align="right"><strong>Potongan :</strong></td>
														<input type="hidden" name="potongan" value="">
														<td id="potongan"></td>
													</tr>
													<tr>
														<td colspan="5" align="right"><strong>Total Bayar :</strong></td>
														<td id="total_bayar"></td>
													</tr>
												</tfoot>
											</table>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- load footer -->
			<?php $this->load->view('partials/footer.php') ?>
		</div>
	</div>
	<?php $this->load->view('partials/js.php') ?>
	<script>
		$(document).ready(function() {
			$('input[id="potongankg"]').prop('disabled', false);
			$('input[id="potonganpersen"]').prop('disabled', false);
			// $('tfoot').hide()

			// $(document).keypress(function(event) {
			// 	if (event.which == '13') {
			// 		event.preventDefault();
			// 	}
			// })

			$('#nama_barang').on('change', function() {

				if ($(this).val() == '') reset()
				else {
					const url_get_all_barang = $('#content').data('url') + '/get_all_barang'
					$.ajax({
						url: url_get_all_barang,
						type: 'POST',
						dataType: 'json',
						data: {
							nama_barang: $(this).val()
						},
						success: function(data) {
							let diskon_sh = data.barang_masuk == null ? 0 : data.barang_masuk.sisa_hari;
							let diskon = 0;
							let diskonNum = 0;
							if (diskon_sh == 3 || diskon_sh == 2 || diskon_sh == 1) {
								diskon = "10%";
								diskonNum = 10;
							} else {
								diskon = "0%";
							}
							$('input[name="kode_barang"]').val(data.kode_barang)
							$('input[name="harga_barang"]').val(data.harga_jual)
							$('input[name="jumlah"]').val(1)
							$('input[name="diskon"]').val(diskon)
							$('input[name="satuan"]').val(data.satuan)
							$('input[name="max_hidden"]').val(data.stok)
							$('input[name="jumlah"]').prop('readonly', false)
							$('button#tambah').prop('disabled', false)

							$('input[name="sub_total"]').val(($('input[name="jumlah"]').val() * $('input[name="harga_barang"]').val()) - (($('input[name="jumlah"]').val() * $('input[name="harga_barang"]').val()) * diskonNum/100))

							$('input[name="jumlah"]').on('keydown keyup change blur', function() {
								$('input[name="sub_total"]').val(($('input[name="jumlah"]').val() * $('input[name="harga_barang"]').val()) - (($('input[name="jumlah"]').val() * $('input[name="harga_barang"]').val()) * diskonNum/100))
							})
						}
					})
				}
			})
			
			var jumlahTemp = 0 ;
			$(document).on('click', '#tambah', function(e) {
				const url_keranjang_barang = $('#content').data('url') + '/keranjang_barang'
				const data_keranjang = {
					nama_barang: $('select[name="nama_barang"]').val(),
					harga_barang: $('input[name="harga_barang"]').val(),
					jumlah: $('input[name="jumlah"]').val(),
					diskon: $('input[name="diskon"]').val(),
					satuan: $('input[name="satuan"]').val(),
					sub_total: $('input[name="sub_total"]').val(),
				}
				jumlahTemp += parseInt(data_keranjang.jumlah)
				$('button#simpan_total').prop('disabled', false)

				if (parseInt($('input[name="max_hidden"]').val()) <= parseInt(data_keranjang.jumlah)) {
					alert('stok tidak tersedia! stok tersedia : ' + parseInt($('input[name="max_hidden"]').val()))
				} else {
					$.ajax({
						url: url_keranjang_barang,
						type: 'POST',
						data: data_keranjang,
						success: function(data) {
							if ($('select[name="nama_barang"]').val() == data_keranjang.nama_barang) $('option[value="' + data_keranjang.nama_barang + '"]').hide()
							reset()

							$('table#keranjang tbody').append(data)
							$('tfoot').show()

							$('#total').html('<strong>' + hitung_total() + '</strong>')
							$('#potongan').html('<strong>'+ potongan()+'</strong>')
							$('#total_bayar').html('<strong>'+ total_bayar()+'</strong>')
							$('input[name="total_hidden"]').val(total_bayar())
							$('input[name="potongan"]').val(potongan())
						}
					})
				}
				$('input[id="potongankg"]').prop('disabled', true);
				$('input[id="potonganpersen"]').prop('disabled', true);
			})


			$(document).on('click', '#tombol-hapus', function() {
				$(this).closest('.row-keranjang').remove()

				$('option[value="' + $(this).data('nama-barang') + '"]').show()

				if ($('tbody').children().length == 0){
					$('input[id="potongankg"]').prop('disabled', false);
					$('input[id="potonganpersen"]').prop('disabled', false);
				}
				$('#total').html(hitung_total())
				$('#potongan').html(potongan())
				$('#total_bayar').html(total_bayar())
				if (total_bayar() != 0 && hitung_total() != 0) {
					$('button#simpan_total').prop('disabled', false)
				} else {
					$('button#simpan_total').prop('disabled', true)

				}
			})

			$('button[type="submit"]').on('click', function() {
				$('input[name="kode_barang"]').prop('disabled', true)
				$('select[name="nama_barang"]').prop('disabled', true)
				$('input[name="harga_barang"]').prop('disabled', true)
				$('input[name="jumlah"]').prop('disabled', true)
				$('input[name="diskon"]').prop('disabled', true)
				$('input[name="sub_total"]').prop('disabled', true)
				$('input[id="potongankg"]').prop('disabled', false);
				$('input[id="potonganpersen"]').prop('disabled', false);
			})

			function hitung_total() {
				let total = 0;
				$('.sub_total').each(function() {
					total += parseInt($(this).text())
				})

				return total;
			}

			function potonganPersen() {
				const potonganpersen = document.getElementById("potonganpersen").value;
				$('#potonganpersen').on('keydown keyup', function() {
					potonganpersen = document.getElementById("potonganpersen").value;
				})
				return potonganpersen;
			}

			function potongan(){
				let potongan = 0;
				var potonganKg = document.getElementById("potongankg").value;
				$('#potongankg').on('keydown keyup', function() {
					potonganKg = document.getElementById("potongankg").value;
				})
				if(jumlahTemp > potonganKg) {
					potongan = hitung_total() * (parseInt(potonganPersen())/100)
					
				}else{
					potongan = 0;
				}
				
				return potongan;
			}
			function total_bayar(){
				return hitung_total() - potongan();
			}

			function reset() {
				$('#nama_barang').val('')
				$('input[name="kode_barang"]').val('')
				$('input[name="harga_barang"]').val('')
				$('input[name="jumlah"]').val('')
				$('input[name="sub_total"]').val('')
				$('input[name="diskon"]').val('')
				$('input[name="jumlah"]').prop('readonly', true)
				$('button#tambah').prop('disabled', true)
			}
		})
	</script>
</body>

</html>