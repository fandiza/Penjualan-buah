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
			<div id="content" data-url="<?= base_url('kasir') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>
					<div class="float-right">
						<?php if ($this->session->login['level'] == 'admin'): ?>
							
							<a href="<?= base_url('kasir/tambah') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah</a>
						<?php endif ?>
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
				<div class="card shadow">
					<div class="card-header"><strong>Daftar Kasir</strong></div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
								<thead>
									<tr>
										<td>No</td>
										<td>Nama Karyawan</td>
										<td>Username</td>
										<td>Terakhir Login</td>
										<?php if ($this->session->login['level'] == 'admin'): ?>
											<!-- <td>Password</td> -->
											<td>Aksi</td>
										<?php endif ?>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($all_kasir as $kasir): ?>
										<?php if($kasir->level == 'kasir') { ?>
										<tr>
											<td><?= $no++ ?></td>
											<td><?= $kasir->nama ?></td>
											<td><?= $kasir->username ?></td>
											<td><?= $kasir->last_login ?></td>
											<?php if ($this->session->login['level'] == 'admin'): ?>
												<!-- <td><?= $kasir->password ?></td> -->
												<td>
													<a href="<?= base_url('kasir/ubah/' . $kasir->id_user) ?>" class="btn btn-success btn-sm"><i class="fa fa-pen"></i></a>
													<a onclick="return confirm('apakah anda yakin?')" href="<?= base_url('kasir/hapus/' . $kasir->id_user) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
												</td>	
											<?php endif ?>
										</tr>
										<?php } ?>
									<?php endforeach ?>
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
	<?php $this->load->view('partials/js.php') ?>
	<script src="<?= base_url('sb-admin/js/demo/datatables-demo.js') ?>"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
</body>
</html>