<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('partials/head.php') ?>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.css" type="text/css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
</head>

<body id="page-top">
	<div id="wrapper">
		<!-- load sidebar -->
		<?php $this->load->view('partials/sidebar.php') ?>

		<div id="content-wrapper" class="d-flex flex-column">
			<div id="content" data-url="<?= base_url('kasir') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
				<div class="row">
						<div class="col-3">
							<div class="float-left">
								<h1 class="h3 m-0 text-gray-800">Laporan Bulanan</h1>
							</div>
						</div>
						<div class="col-8">
							<p class="float-right" id="noticeBulan"></p>
						</div>
						<div class="col-1">
						<div class="float-right">
							<button type="button" data-toggle="modal" data-target="#filterBulan" class="btn btn-success">Filter</button>
						</div>
						</div>
				</div>
				<hr>
				<?php if ($this->session->flashdata('success')) : ?>
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<?= $this->session->flashdata('success') ?>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				<?php elseif($this->session->flashdata('error')) : ?>
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<?= $this->session->flashdata('error') ?>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				<?php endif ?>
				<div class="row">

		            <!-- Earnings (Monthly) Card Example -->
		            <div class="col-xl-3 col-md-6 mb-4">
		              <div class="card border-left-primary shadow h-100 py-2">
		                <div class="card-body">
		                  <div class="row no-gutters align-items-center">
		                    <div class="col mr-2">
		                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Pendapatan</div>
		                      <div id="pendapatan" class="h5 mb-0 font-weight-bold text-gray-800">Rp <?= number_format($total_pendapatanbulanan['harian'],0,',','.') ?></div>
		                    </div>
		                    <div class="col-auto">
		                      <i class="fas fa-box fa-2x text-gray-300"></i>
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
		                      <div  class="text-xs font-weight-bold text-success text-uppercase mb-1">Barang Terjual</div>
		                      <div id="barangTerjual" class="h5 mb-0 font-weight-bold text-gray-800"><?= $barang_terjualbulanan['totbarang'] ?></div>
		                    </div>
		                    <div class="col-auto">
		                      <i class="fas fa-user fa-2x text-gray-300"></i>
							  
		                    </div>
		                  </div>
		                </div>
		              </div>
		            </div>

		            <!-- Earnings (Monthly) Card Example -->
		            <div class="col-xl-3 col-md-6 mb-4">
		              <div class="card border-left-info shadow h-100 py-2">
		                <div class="card-body">
		                  <div class="row no-gutters align-items-center">
		                    <div class="col mr-2">
		                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Transaksi</div>
		                      <div class="row no-gutters align-items-center">
		                        <div class="col-auto">
		                          <div id="totalTransaksi" class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $total_penjualanbulanan['total'] ?></div>
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

		            <!-- Pending Requests Card Example -->
		            <div class="col-xl-3 col-md-6 mb-4">
		              <div class="card border-left-warning shadow h-100 py-2">
		                <div class="card-body">
		                  <div class="row no-gutters align-items-center">
		                    <div class="col mr-2">
		                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Barang Terlaris</div>
		                      <div id="namabuah" class="h5 mb-0 font-weight-bold text-gray-800"><?= $barang_larisbulanan['namabuah'] ?></div>
		                    </div>
		                    <div class="col-auto">
		                      <i class="fas fa-file-invoice fa-2x text-gray-300"></i>
		                    </div>
		                  </div>
		                </div>
		              </div>
		            </div>
		          </div>
				  <div class="row">
						<div class="col-xl-10 mx-auto">
							<div class="card shadow mb-4">
								<!-- Card Header - Dropdown -->
								<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
									<h6 class="m-0 font-weight-bold text-primary">Grafik Pendapatan Bulanan</h6>
								</div>
								<!-- Card Body -->
								<div class="card-body">
									<div class="chart-area" id=grafikMonth>
										<canvas id="myAreaChart"></canvas>
									</div>
								</div>
								<div class="card-body" id="tableDataMonth">
									<div class="table-responsive">
										<table class="table table-bordered display" id="dataDay" width="100%" cellspacing="0">
											<thead>
												<tr>
													<th>Nama Barang</th>
													<th>Tanggal</th>
													<th>Harga</th>
													<th>Jumlah</th>
													<th>Total</th>
												</tr>
											</thead>
											<tbody>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>

		        
			<!-- load footer -->
			<?php $this->load->view('partials/footer.php') ?>
		</div>
	</div>
	<div class="modal fade" id="filterBulan" tabindex="-1" role="dialog" aria-labelledby="filter" aria-hidden="false"> 
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-tittle" id="filter">Filter Bulan</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
					<div class="col-lg-12 mx-auto">
						<div class="form-row">
							<div class="col-5">
								<!-- <input id="start" class="form-control" type="month"> -->
								<select id="start" class="custom-select">
									<option selected disabled value="">Pilih Bulan</option>
									<option value="1">Januari</option>
									<option value="2">Februari</option>
									<option value="3">Maret</option>
									<option value="4">April</option>
									<option value="5">Mei</option>
									<option value="6">Juni</option>
									<option value="7">Juli</option>
									<option value="8">Agustus</option>
									<option value="9">September</option>
									<option value="10">Oktober</option>
									<option value="11">November</option>
									<option value="12">Desember</option>
								</select>
							</div>
							<div class="col-2"> 
								<p>Sampai</p>
							</div>
							<div class="col-5">
							<!-- <input id="end" class="form-control" type="month"> -->
								<select id="end" class="custom-select">
									<option selected disabled value="">Pilih Bulan</option>
									<option value="1">Januari</option>
									<option value="2">Februari</option>
									<option value="3">Maret</option>
									<option value="4">April</option>
									<option value="5">Mei</option>
									<option value="6">Juni</option>
									<option value="7">Juli</option>
									<option value="8">Agustus</option>
									<option value="9">September</option>
									<option value="10">Oktober</option>
									<option value="11">November</option>
									<option value="12">Desember</option>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" id="aturBulan" class="btn btn-success" data-dismiss="modal">Atur</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
				</div>
			</div>
		</div>
	</div>
	<?php $this->load->view('partials/js.php') ?>
	<script>
		$(document).ready(function(){
			$(document).on('click', '#aturBulan', function(e) {
				var start = document.getElementById("start").value;
				var end = document.getElementById("end").value;
				if (end == null || end == "") {
					end = document.getElementById("start").value;
				} else if (start == null || start == "") {
					start = document.getElementById("end").value;
				}
				const xmlHttp = new XMLHttpRequest();
				const xmlHttp2 = new XMLHttpRequest();
				xmlHttp.open("GET", "<?= base_url('Laporan_Bulanan/filterByMonth/') ?>" + `${start}/${end}`)
				xmlHttp2.open("GET", "<?= base_url('Laporan_Bulanan/getDataByMonth/') ?>" + `${start}/${end}`)

				xmlHttp.onload = function(){
					if(this.status == 200){
						const result = JSON.parse(xmlHttp.response);
						console.log(result);
						if (result['harian'] == null && result['totbarang'] == null && result['total'] == 0 && result['namabuah'] == null) {
							document.getElementById("pendapatan").innerHTML = "Data Tidak Ada"	
							document.getElementById("barangTerjual").innerHTML = "0"
							document.getElementById("totalTransaksi").innerHTML = "0"
							document.getElementById("namabuah").innerHTML = "Tidak Ada"
							document.getElementById("noticeBulan").innerHTML = "Data Dari Bulan: " + start + " Sampai: " + end + " Tidak Ditemukan";
						} else {
							document.getElementById("pendapatan").innerHTML = "Rp. " + result['harian'];
							document.getElementById("barangTerjual").innerHTML = result['totbarang'];
							document.getElementById("totalTransaksi").innerHTML = result['total'];
							document.getElementById("namabuah").innerHTML = result['namabuah'];
							document.getElementById("noticeBulan").innerHTML = "Data Dari Bulan: " + start + " Sampai: " + end;
						}
						
					}
				}
				xmlHttp2.onload = function() {
					if (this.status == 200) {
						const result = JSON.parse(xmlHttp2.response);
						console.log(result);
						$('#dataDay').DataTable({
							responsive: true,
							data: result,
							columns: [
								{ data: "nama_barang" },
								{ data: "tanggal_penjualan" },
								{ data: "harga_barang" },
								{ data: "jumlah" },
								{ data: "total" }
							],
							"bDestroy": true,
							"order": [[1,"DESC"]],
							"searchable": false,
							"pagingType": "simple_numbers",
    					});
					}
				}
				xmlHttp.send();
				xmlHttp2.send();
				$("#grafikMonth").hide();
				$("#tableDataMonth").show();
			})
		})


		var ctx = document.getElementById('myAreaChart').getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: [
					<?php
					foreach ($chart as $key) {
						echo "'" . bulan($key['month']) . "', ";
					}
					?>
				],
				datasets: [{
					label: "Pendapatan",
					backgroundColor: 
					'rgba(75, 192, 192, 0.2)',
					borderColor: 
					'rgb(75, 192, 192)',
					borderWidth: 1,
					data: [
						<?php
						foreach ($chart as $value) {
							echo  "'" . $value['revenue'] . "', ";
						}
						?>
					],
				}],
			},
			options: {
				maintainAspectRatio: false,
				layout: {
					padding: {
						left: 10,
						right: 25,
						top: 25,
						bottom: 0
					}
				},
				scales: {
					xAxes: [{
						time: {
							unit: 'date'
						},
						gridLines: {
							display: false,
							drawBorder: false
						},
						ticks: {
							maxTicksLimit: 7
						}
					}],
					yAxes: [{
						ticks: {
							maxTicksLimit: 7,
							padding: 10,
							beginAtZero: true
						},
						gridLines: {
							color: "rgb(239, 236, 244)",
							zeroLineColor: "rgb(234, 236, 244)",
							drawBorder: false,
							borderDash: [2],
							zeroLineBorderDash: [2]
						}
					}]
				}
			}
		});
	</script>
	<script src="<?= base_url('sb-admin/js/demo/datatables-demo.js') ?>"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
</body>
</html>