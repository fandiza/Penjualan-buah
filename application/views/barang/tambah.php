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
			<div id="content" data-url="<?= base_url('barang') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
					<div class="clearfix">
						<div class="float-left">
							<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>
					
					<div class="float-right col-md-2">
						<a href="<?= base_url('barang') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
					</div>
					<div class="float-right">
						<a href="<?= base_url('barangmasuk/tambah') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah Stok</a>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-6">
						<div class="card shadow">
							<div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
							<div class="card-body">
								<form action="<?= base_url('barang/proses_tambah') ?>" id="form-tambah" method="POST">
								<div class="form-row">
										<div class="form-group col-md-4">
											<label for="nama_barang"><strong>Nama Barang</strong></label>
											</div>
											<div class="form-group col-md-8">
											<input type="text" name="nama_barang" placeholder="Masukkan Nama Barang" autocomplete="off"  class="form-control" required>
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-md-4">
											<label for="harga_beli"><strong>Harga Beli</strong></label>
											</div>
											<div class="form-group col-md-8">
											<input type="number" name="harga_beli" placeholder="Masukkan Harga Beli" autocomplete="off"  class="form-control" required>
										</div>
										<div class="form-group col-md-4">
											<label for="harga_jual"><strong>Harga Jual</strong></label>
											</div>
											<div class="form-group col-md-8">
											<input type="number" name="harga_jual" placeholder="Masukkan Harga Jual" autocomplete="off"  class="form-control" required>
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-md-4">
											<label for="stok"><strong>Stok</strong></label>
										</div>
										<div class="form-group col-md-8">
											<input type="number" name="stok" placeholder="" autocomplete="off"  class="form-control" required readonly>
										</div>
										<div class="form-group col-md-4">
											<label for="satuan"><strong>Satuan</strong></label>
										</div>
										<div class="form-group col-md-8">
											<select name="satuan" id="satuan" class="form-control" required>
												<option value="">-- Silahkan Pilih --</option>
												<option value="pcs">PCS</option>
												<option value="pak">PAK</option>
												<option value="kg">KILOGRAM</option>
											</select>
										</div>
									<hr>
									<div class="form-group">
										<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
										<button type="reset" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;&nbsp;Reset</button>
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
</body>
</html>