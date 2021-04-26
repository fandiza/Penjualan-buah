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
			<div id="content" data-url="<?= base_url('barangmasuk') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>
					<div class="float-right">
						<a href="<?= base_url('barangmasuk') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-6">
						<div class="card shadow">
							<div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
							<div class="card-body">
								<form action="<?= base_url('barangmasuk/proses_tambah') ?>" id="form-tambah" method="POST">
								<div class="form-row">
										<div class="form-group col-md-4">
											<label for="nama_barang"><strong>Nama Barang</strong></label>
											</div>
											<div class="form-group col-md-8">
                                            <select name="id_barang" id="" class="form-control" required>
											<option value="">Pilih Barang</option>
												<?php foreach ($all_barang as $barang): ?>
													<option value="<?= $barang->id ?>"><?= $barang->nama_barang ?></option>
												<?php endforeach ?>
                                            </select>
										</div>
									</div>
        
									<div class="form-row">
										<div class="form-group col-md-4">
											<label for="harga_beli"><strong>Tanggal Masuk</strong></label>
											</div>
											<div class="form-group col-md-8">
											<input type="date" name="tanggalmasuk" placeholder="Masukkan Tanggal Masuk" autocomplete="off"  class="form-control" required>
										</div>
										<div class="form-group col-md-4">
											<label for="harga_jual"><strong>Kadaluarsa</strong></label>
											</div>
											<div class="form-group col-md-8">
											<input type="date" name="exp" placeholder="Masukkan Kadaluarsa" autocomplete="off"  class="form-control" required>
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-md-4">
											<label for="stok"><strong>Jumlah</strong></label>
											</div>
											<div class="form-group col-md-8">
											<input type="number" name="jumlah" placeholder="Masukkan Jumlah" autocomplete="off"  class="form-control" step="0.00001"  required>
										</div>
                                        </div>
                                        <div class="form-row">
										<div class="form-group col-md-4">
											<label for="stok"><strong>Supplier</strong></label>
											</div>
											<div class="form-group col-md-8">
											<select name="id_supplier" id="" class="form-control" required>
                                            <?php foreach ($all_supplier as $supplier): ?>
													<option value="<?= $supplier->id_supplier ?>"><?= $supplier->nama_sup ?></option>
												<?php endforeach ?>
										</div>
                                        </div>
                                      </div>
									</div>
                                    <input type="hidden" name="id_user" value="<?= $this->session->login['id_user'] ?>">
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
</body>
</html>