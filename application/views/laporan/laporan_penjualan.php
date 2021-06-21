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
			<div id="content" data-url="<?= base_url('laporan_penghasilan') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800">Laporan Penghasilan Tahunan</h1>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="form-group col-5">
					<label for="nama_barang">Nama Barang</label>
					<select name="nama_barang" id="nama_barang" class="form-control" onchange="fetchdata(this.value);">

					<option value="">Total Pendapatan Keseluruhan</option>
					<?php foreach ($all_barang as $barang): ?>
					<option value="<?= $barang['id']?>"><?= $barang['nama_barang'] ?></option>
					<?php endforeach ?>

					</select>
					</div>

					<div class="form-group col-3">
						<label>Filter Tahun</label>
						<div class="row">
						<div class="col-1 my-auto">
							<a id="btnDecrement"><i class="fas fa-caret-left"></i></a>
						</div>
						<div class="col-5">
							<input type="text" id="year" class="form-control" value="<?= date("Y"); ?>" disabled>
						</div>
						<div class="col-1 my-auto">
							<a id="btnIncrement"><i class="fas fa-caret-right"></i></a>
						</div>
						</div>
					</div>
				</div>

				<div class="row">
				<div class="col-xl-3 col-md-6 mb-4">
		              <div class="card border-left-warning shadow h-100 py-2">
		                <div class="card-body">
		                  <div class="row no-gutters align-items-center">
		                    <div class="col mr-2">
		                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Modal</div>
		                      <div id="stok" class="h5 mb-0 font-weight-bold text-gray-800">Rp <?= number_format($total['modal'],0,',','.')?></div>
		                    </div>
		                    <div class="col-auto">
		                      <i class="fas fa-file-invoice fa-2x text-gray-300"></i>
		                    </div>
		                  </div>
		                </div>
		              </div>
		    		</div>
		            <!-- Earnings (Monthly) Card Example -->
		            <div class="col-xl-3 col-md-6 mb-4">
		              <div class="card border-left-primary shadow h-100 py-2">
		                <div class="card-body">
		                  <div class="row no-gutters align-items-center">
		                    <div class="col mr-2">
		                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Pendapatan Kotor</div>
		                      <div id="laba_kotor" class="h5 mb-0 font-weight-bold text-gray-800">Rp <?= number_format($total['laba_kotor'],0,',','.') ?></div>
		                    </div>
		                    <div class="col-auto">
		                      <i class="fas fa-box fa-2x text-gray-300"></i>
		                    </div>
		                  </div>
		                </div>
		              </div>
		            </div>

					<div class="col-xl-3 col-md-6 mb-4">
		              <div class="card border-left-info shadow h-100 py-2">
		                <div class="card-body">
		                  <div class="row no-gutters align-items-center">
		                    <div class="col mr-2">
		                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Barang Terjual</div>
		                      <div class="row no-gutters align-items-center">
		                        <div class="col-auto">
		                          <div id="total_penjualan" class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $total['barang_terjual']?></div>
		                        </div>
		                      </div>
		                    </div>
		                    <div class="col-auto">
		                      <i class="fas fa-cash-register fa-2x text-gray-300"></i>
							 
		                    </div>
		                  </div>
		                </div>
		              </div>
		          	 </div>

		            <!-- Earnings (Monthly) Card Example -->
		            <div class="col-xl-3 col-md-6 mb-4">
		              <div class="card border-left-success shadow h-100 py-2">
		                <div class="card-body">
		                  <div class="row no-gutters align-items-center">
		                    <div class="col mr-2">
		                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Pendapatan Bersih</div>
		                      <div id="laba_bersih" class="h5 mb-0 font-weight-bold text-gray-800">Rp <?= number_format($total['laba_bersih'],0,',','.')?></div>
		                    </div>
		                    <div class="col-auto">
		                      <i class="fas fa-user fa-2x text-gray-300"></i>
							  
		                    </div>
		                  </div>
		                </div>
		              </div>
		            </div>
		            <!-- Earnings (Monthly) Card Example -->
		            

		            	<!-- Pending Requests Card Example -->
		            
		        	</div>
				</div>
			</div>
			
			<!-- load footer -->
			<?php $this->load->view('partials/footer.php') ?>
		</div>
	</div>
	<?php $this->load->view('partials/js.php') ?>
	<script src="<?= base_url('sb-admin/js/demo/datatables-demo.js') ?>"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>

	<script>
		function fetchdata(x){
			var year = document.getElementById("year").value;
			const xmlHttp = new XMLHttpRequest();
			if(x.length == 0 && x == ""){
				xmlHttp.open("GET","<?= base_url('Laporan_Penghasilan/getAll') ?>" , true );
				xmlHttp.onload = function(){
					if(this.status = 200){
						const result = JSON.parse(xmlHttp.response);
						document.getElementById("laba_kotor").innerHTML = "Rp. " + result['laba_kotor'];
						document.getElementById("laba_bersih").innerHTML = "Rp. " + result['laba_bersih'];
						document.getElementById("total_penjualan").innerHTML = result['barang_terjual'];
						document.getElementById("stok").innerHTML = "Rp. " + result['modal'];
					}
				}
				xmlHttp.send();
			}
			else{
				xmlHttp.open("GET","<?= base_url('Laporan_Penghasilan/getDataById/') ?>" + x , true );
				xmlHttp.onload = function(){
					if(this.status = 200){
						const result = JSON.parse(xmlHttp.response);
						document.getElementById("laba_kotor").innerHTML = "Rp. " + result['laba_kotor'];
						document.getElementById("laba_bersih").innerHTML = "Rp. " + result['laba_bersih'];
						document.getElementById("total_penjualan").innerHTML = result['barang_terjual'];
						document.getElementById("stok").innerHTML = "Rp. " + result['modal'];
					}
				}
				xmlHttp.send();
			}
		}

		$("#btnDecrement").on('click', function() {
			var x = document.getElementById("year").value = decrement();
			const xmlHttp = new XMLHttpRequest();
			xmlHttp.open("GET","<?= base_url('Laporan_Penghasilan/getDataByYear/') ?>" + x , true );
				xmlHttp.onload = function(){
					if(this.status = 200){
						const result = JSON.parse(xmlHttp.response);
						console.log(result);
						document.getElementById("laba_kotor").innerHTML = "Rp. " + result['laba_kotor'];
						document.getElementById("laba_bersih").innerHTML = "Rp. " + result['laba_bersih'];
						document.getElementById("total_penjualan").innerHTML = result['barang_terjual'];
						document.getElementById("stok").innerHTML = "Rp. " + result['modal'];
					}
				}
				xmlHttp.send();
		});

		$("#btnIncrement").on('click', function() {
			var x = document.getElementById("year").value = increment();
			const xmlHttp = new XMLHttpRequest();
			xmlHttp.open("GET","<?= base_url('Laporan_Penghasilan/getDataByYear/') ?>" + x , true );
				xmlHttp.onload = function(){
					if(this.status = 200){
						const result = JSON.parse(xmlHttp.response);
						console.log(result);
						document.getElementById("laba_kotor").innerHTML = "Rp. " + result['laba_kotor'];
						document.getElementById("laba_bersih").innerHTML = "Rp. " + result['laba_bersih'];
						document.getElementById("total_penjualan").innerHTML = result['barang_terjual'];
						document.getElementById("stok").innerHTML = "Rp. " + result['modal'];
					}
				}
				xmlHttp.send();
		})

		function decrement() {
			let value = parseInt(document.getElementById("year").value);
			value -= 1;
			return value
		}

		function increment() {
			let value = parseInt(document.getElementById("year").value);
			value += 1;
			return value;
		}
	</script>
</body>

</html>