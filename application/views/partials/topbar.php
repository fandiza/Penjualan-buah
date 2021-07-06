<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

	<!-- Sidebar Toggle (Topbar) -->
	<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
		<i class="fa fa-bars"></i>
	</button>

	<!-- Topbar Navbar -->
	<ul class="navbar-nav ml-auto">
		<!-- Nav Item - Search Dropdown (Visible Only XS) -->
		<li class="nav-item dropdown no-arrow d-sm-none">
			<a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<i class="fas fa-search fa-fw"></i>
			</a>
			<!-- Dropdown - Messages -->
			<div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
				<form class="form-inline mr-auto w-100 navbar-search">
					<div class="input-group">
						<input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
						<div class="input-group-append">
							<button class="btn btn-primary" type="button">
								<i class="fas fa-search fa-sm"></i>
							</button>
						</div>
					</div>
				</form>
			</div>
		</li>

		<!-- Nav Item - Alerts -->
		<li class="nav-item dropdown no-arrow mx-1">
			<a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<i class="fas fa-bell fa-fw"></i>
				<!-- Counter - Alerts -->
				<div id="jumlahnotif"></div>
			</a>
			<!-- Dropdown - Alerts -->
			<div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
				<h6 class="dropdown-header">
					Pemberitahuan
				</h6>
				<div id="notif_id" style="height: 300px;overflow: auto;">

				</div>
				<a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
			</div>
		</li>

		<div class="topbar-divider d-none d-sm-block"></div>
		<!-- Nav Item - User Information -->
		<li class="nav-item dropdown no-arrow">
			<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $this->session->login['nama'] ?></span>
			</a>
			<!-- Dropdown - User Information -->
			<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
				<a class="dropdown-item" href="<?= base_url('ubahProfile') ?>">
					<i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
					Profile
				</a>
				<a class="dropdown-item" href="<?= base_url('ubahpassword') ?>">
					<i class="fas fa-lock fa-sm fa-fw mr-2 text-gray-400"></i>
					Ubah Password
				</a>
				<a class="dropdown-item" href="<?= base_url('logout') ?>">
					<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
					Logout
				</a>
			</div>
		</li>
	</ul>
</nav>

<script>
	$(document).ready(function() {
		$.get("<?= base_url('dashboard/ceknotif') ?>", function(data) {
			let html = '';
			let jumlahnotif = data.stok.length + data.kadaluarsa.length;

			$.each(data.stok, function(i, item) {
				html += `
					<div class="dropdown-item d-flex align-items-center">
						<div class="mr-3">
							<div class="icon-circle bg-success">
								<i class="fas fa-file-alt text-white"></i>
							</div>
						</div>
						<div>
							<div class="small text-gray-500 font-weight-bold">Stok Menipis</div>
							Stok <span class="badge badge-success">${item.nama_barang}</span> kurang dari <span class="badge badge-danger">20</span>
						</div>
					</div>
				`;
			});

			$.each(data.kadaluarsa, function(i, item) {
				html += `
					<div class="dropdown-item d-flex align-items-center">
						<div class="mr-3">
							<div class="icon-circle bg-warning">
								<i class="fas fa-file-alt text-white"></i>
							</div>
						</div>
						<div>
							<div class="small text-gray-500 font-weight-bold">Kadaluarsa</div>
							Beberapa <span class="badge badge-warning">${item.nama_barang}</span> akan kadaluarasa dalam <span class="badge badge-danger">${item.sisa_hari} hari.</span>
						</div>
					</div>
				`;
			});

			$('#notif_id').html(html);

			if (jumlahnotif > 0) {
				$('#jumlahnotif').html(`
					<span class="badge badge-danger badge-counter">${jumlahnotif}</span>
				`);
			}

			console.log(data.stok)
		});
	});
</script>