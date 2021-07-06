<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('partials/head.php') ?>
</head>

<body id="page-top">
	<div id="wrapper">
		
		<?php $this->load->view('partials/sidebar.php') ?>

		<div id="content-wrapper" class="d-flex flex-column">
			<div id="content" data-url="<?= base_url('barang') ?>">
				
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>
					<div class="float-right">
						<a href="<?= base_url('barang') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-8 ">
						<div class="card shadow">
							<div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
							<div class="card-body">
								<form action="<?= base_url('barang/proses_barang_rusak') ?>" id="form-tambah" method="POST">
									<div class="form-row">
										<div class="form-group col-md-4">
											<label for="nama_barang"><strong>Nama Barang</strong></label>
											</div>
											<div class="form-group col-md-8">
                                            <select name="id" id="pilihBarang" class="form-control" required>
											<option value="" disabled selected>Pilih Barang</option>
												<?php foreach ($all_barang as $barang): ?>
													<option value="<?= $barang->id ?>"><?= $barang->nama_barang ?></option>
												<?php endforeach ?>
                                            </select>
											</div>
									</div>
									<div class="form-row" id="stokRusak">
										<div class="form-group col-md-4">
											<label for="stok_rusak"><strong>Jumlah</strong></label>
										</div>
										<div class="form-group col-md-8">
										<div class="input-group">
											<input type="number" id="jumlahRusak"  name="stok_rusak"  autocomplete="off"  class="form-control" value="0" disabled>
											<div class="input-group-append">
												<div class="input-group-text">Kg</div>
											</div>
										</div>
										</div>
                                    </div>
									<div class="form-row" id="rusakBaru">
										<div class="form-group col-md-4">
											<label for=""><strong>Rusak Baru</strong></label>
										</div>
										<div class="form-group col-md-8">
										<div class="input-group">
											<input type="number" name="rusakBaru"  placeholder="Masukkan Rusak Baru" class="form-control" required>
											<div class="input-group-append">
														<div class="input-group-text">Kg</div>
													</div>
										</div>
										</div>
										
									</div>
                        
                                      </div>
									</div>
                                    <input type="hidden" name="id_user" value="<?= $this->session->login['id_user'] ?>">
									<hr>
									<div class="form-group">
										<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
										<button id="batal" type="reset" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;&nbsp;Batal</button>
									</div>
								</form>
							</div>				
						</div>
					</div>
				</div>
				</div>
			</div>
			
			<?php $this->load->view('partials/footer.php') ?>
		</div>
	</div>
	<?php $this->load->view('partials/js.php') ?>

	<script>
		$(document).ready(function(){
			document.getElementById("rusakBaru").style.display = "none";
			$("#pilihBarang").on('change',function(){
				const id = this.value;
				const xmlHttp = new XMLHttpRequest();

				xmlHttp.open("GET","<?= base_url('Barang/barangRusak/') ?>" +id);
				xmlHttp.onload = function(){
					if(this.status == 200){
						const result = JSON.parse(xmlHttp.response);
						console.log(result);
						document.getElementById("jumlahRusak").value = result['stok_rusak'];
					}
				}
				xmlHttp.send();

				if(this.value != null){
					$("#rusakBaru").show();
				}else{
					$("#rusakBaru").hide();
				}
			});

			$("#batal").on('click',function(){
				$("#rusakBaru").hide();
			});
		});
	</script>

</body>
</html>