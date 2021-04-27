<ul class="navbar-nav bg-gradient sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color:#317745">
			<a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('dashboard') ?>">
				<div class="sidebar-brand-icon rotate-n-10">
				<img src="<?= base_url(); ?>assets/buah.png" alt="" width="90%">
				</div>
				<div class="sidebar-brand-text mx-3 mt">    </div>
			</a>
			<hr class="sidebar-divider my-2">
			<li class="nav-item <?= $aktif == 'dashboard' ? 'active' : '' ?>">
				<a class="nav-link" href="<?= base_url('dashboard') ?>">
				<!-- <hr class="sidebar-divider my-1"> -->
					<i class="fas fa-fw fa-tachometer-alt"></i>
					<span>Dashboard</span></a>
			</li>
			<hr class="sidebar-divider my-2s">

			<div class="sidebar-heading">
				MANAJEMEN
			</div>

			<li class="nav-item <?= $aktif == 'barang' ? 'active' : '' ?>">
				<a class="nav-link" href="<?= base_url('barang') ?>">
					<i class="fas fa-fw fa-box"></i>
					<span>Barang</span></a>
			</li>

			<li class="nav-item <?= $aktif == 'supplier' ? 'active' : '' ?>">
				<a class="nav-link" href="<?= base_url('supplier') ?>">
					<i class="fas fa-fw fa-people-carry"></i>
					<span>Supplier</span></a>
			</li>

			<li class="nav-item <?= $aktif == 'kasir' ? 'active' : '' ?>">
				<a class="nav-link" href="<?= base_url('kasir') ?>">
					<i class="fas fa-fw fa-user"></i>
					<span>Kasir</span></a>
			</li>

			<!-- Divider -->
			<hr class="sidebar-divider">
	
			<div class="sidebar-heading">
				Transaksi
			</div>

			<li class="nav-item <?= $aktif == 'penjualan' ? 'active' : '' ?>">
				<a class="nav-link" href="<?= base_url('penjualan') ?>">
					<i class="fas fa-fw fa-cash-register"></i>
					<span>Transaksi Penjualan</span></a>
			</li>

			<li class="nav-item <?= $aktif == 'barangmasuk' ? 'active' : '' ?>">
				<a class="nav-link" href="<?= base_url('barangmasuk') ?>">
					<i class="fas fa-fw fa-file-invoice"></i>
					<span>Barang Masuk</span></a>
			</li>

			<hr class="sidebar-divider">
			<?php if ($this->session->login['level'] == 'admin'): ?>
				<!-- Heading -->
				<div class="sidebar-heading">
					Pengaturan
				</div>

				<li class="nav-item <?= $aktif == 'admin' ? 'active' : '' ?>">
					<a class="nav-link" href="<?= base_url('admin') ?>">
						<i class="fas fa-fw fa-user-cog"></i>
						<span>Manajemen Admin</span></a>
				</li>

				<li class="nav-item <?= $aktif == 'toko' ? 'active' : '' ?>">
					<a class="nav-link" href="<?= base_url('toko') ?>">
						<i class="fas fa-store"></i>
						<span>Profil Toko</span></a>
				</li>
				<!-- Divider -->
				<hr class="sidebar-divider d-none d-md-block">
			<?php endif; ?>

			<!-- Sidebar Toggler (Sidebar) -->
			<div class="text-center d-none d-md-inline">
				<button class="rounded-circle border-0" id="sidebarToggle"></button>
			</div>
		</ul>