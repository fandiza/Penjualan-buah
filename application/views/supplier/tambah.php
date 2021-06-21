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
			<div id="content" data-url="<?= base_url('supplier') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>
					<div class="float-right col-md-2">
						<a href="<?= base_url('supplier') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
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
								<form action="<?= base_url('supplier/proses_tambah') ?>" id="form-tambah" method="POST">
									<div class="form-row">
										<div class="form-group col-md-6">
											<label for="nama"><strong>Nama Supplier</strong></label>
											</div>
											<div class="form-group col-md-6">
											<input type="text" name="nama_sup" placeholder="Masukkan Nama supplier" autocomplete="off"  class="form-control" required>
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-md-6">
											<label for="no_telp"><strong>No Telp</strong></label>
											</div>
											<div class="form-group col-md-6">
										<input type="number" name="no_telp" placeholder="Masukkan No Telp" autocomplete="off"  class="form-control" required >
										</div>
										<div class="form-group col-md-6">
											<label for="password_supplier"><strong>Alamat</strong></label>
											</div>
											<div class="form-group col-md-6">
											<input type="text" name="alamat" placeholder="Masukkan alamat" autocomplete="off"  class="form-control" required>
										</div>
									</div>
									<hr>
									<div class="form-group">
										<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
										<button type="reset" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;&nbsp;Batal</button>
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
		$(document).ready(function(){
			let username_supplier = $('input[name="kode_supplier"]').val().split(' - ');
			username_supplier = 'KSR' + username_supplier[1]
			 $('input[name="username_supplier"]').val(username_supplier)
		})
	</script>
</body>
</html>