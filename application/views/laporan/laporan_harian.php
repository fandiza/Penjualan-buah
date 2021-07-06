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
								<h1 class="h3 m-0 text-gray-800">Laporan Harian</h1>
							</div>
						</div>
						<div class="col-7">
							<p class="float-right" id="notice"></p>
						</div>
						<div class="col-2">
						<div class="float-right">
							<button type="button" data-toggle="modal" data-target="#filterHari" class="btn btn-success">Filter</button>
						</div>
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
		                      <div id="pendapatan" class="h5 mb-0 font-weight-bold text-gray-800">Rp <?= 
							  number_format($total_pendapatan['harian'],0,',','.') ?></div>
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
		                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Barang Terjual</div>
		                      <div id="barangTerjual" class="h5 mb-0 font-weight-bold text-gray-800"><?= $barang_terjual['totbarang'] ?></div>
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
		                          <div id="totalTransaksi" class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $total_penjualan['total'] ?></div>
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
		                      <div id="namabuah" class="h5 mb-0 font-weight-bold text-gray-800"><?= $barang_laris['namabuah'] ?></div>
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
						<div class="col-xl-12 mx-auto">
							<div class="card shadow mb-4">
								<!-- Card Header - Dropdown -->
								<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
									<h6 class="m-0 font-weight-bold text-primary">Pendapatan Harian</h6>
								</div>
								<!-- Card Body -->
								<div class="card-body" id="grafik">
									<div class="chart-area">
										<canvas id="myAreaChart"></canvas>
									</div>
								</div>
								<div class="card-body" id="tableDataDay">
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
	<div class="modal fade" id="filterHari" tabindex="-1" role="dialog" aria-labelledby="filter" aria-hidden="false"> 
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-tittle" id="filter">Filter Hari</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
					<div class="col-lg-12 mx-auto">
						<div class="form-row">
							<div class="col-5">
								<input id="start" class="form-control" type="date">
							</div>
							<div class="col-2"> 
								<p>Sampai</p>
							</div>
							<div class="col-5">
								<input id="end" class="form-control" type="date">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" id="aturHari" class="btn btn-success" data-dismiss="modal">Atur</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
				</div>
			</div>
		</div>
	</div>
	<?php $this->load->view('partials/js.php') ?>
	<script>
		$(document).ready(function() {
			$("#tableDataDay").hide();
			$(document).on('click', '#aturHari', function(e) {
				var start = document.getElementById("start").value;
				var end = document.getElementById("end").value;
				if (end == null || end == "") {
					end = document.getElementById("start").value;
				} else if (start == null || start == "") {
					start = document.getElementById("end").value;
				}
				const xmlHttp = new XMLHttpRequest();
				const xmlHttp2 = new XMLHttpRequest();
				xmlHttp.open("GET", "<?= base_url('Laporan_harian/filterByDay/') ?>" + `${start}/${end}`)
				xmlHttp2.open("GET", "<?= base_url('Laporan_harian/getDataByDay/') ?>" + `${start}/${end}`)

				xmlHttp.onload = function(){
					if(this.status == 200){
						const result = JSON.parse(xmlHttp.response);
						console.log(result);
						document.getElementById("pendapatan").innerHTML = "Rp. " + result['harian'];
						document.getElementById("barangTerjual").innerHTML = result['totbarang'];
						document.getElementById("totalTransaksi").innerHTML = result['total'];
						document.getElementById("namabuah").innerHTML = result['namabuah'];
						document.getElementById("notice").innerHTML = "Data Dari Tanggal: " + start + " Sampai: " + end;
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
				$("#grafik").hide();
				$("#tableDataDay").show();
			})
		})
	</script>
	<script>
		var ctx = document.getElementById('myAreaChart').getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'line',
			data: {
				labels: [
					<?php
					foreach ($chart as $key) {
						echo "'" . format_indo($key['day']) . "', ";
					}
					?>
				],
				datasets: [{
					label: "Pendapatan",
					lineTension: 0.3,
					backgroundColor: "rgba(78, 115, 223, 0.05)",
					borderColor: "rgba(78, 115, 223, 1)",
					pointRadius: 3,
					pointBackgroundColor: "rgba(78, 115, 223, 1)",
					pointBorderColor: "rgba(78, 115, 223, 1)",
					pointHoverRadius: 3,
					pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
					pointHoverBorderColor: "rgba(78, 115, 223, 1)",
					pointHitRadius: 10,
					pointBorderWidth: 2,
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
							color: "rgb(234, 236, 244)",
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
	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
	<script src="<?= base_url('sb-admin/js/demo/datatables-demo.js') ?>"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
</body>
</html>