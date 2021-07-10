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
			<div id="content" data-url="<?= base_url('ubahpassword') ?>">
				<!-- load Topbar -->
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>
					<div class="float-right">
						<a href="<?= base_url('dashboard') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
					</div>
				</div>
    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-6">
            <?= $this->session->flashdata('message'); ?>

            <?= form_error('username', '<div class="alert alert-danger alert-dismissible fade show" role="alert">', '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>'); ?>
            <?= form_error('nama', '<div class="alert alert-danger alert-dismissible fade show" role="alert">', '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>'); ?>
            <div class="card">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Ubah Profile</h6>
                </div>

                <di class="card-body">
                    <form method="post" action="<?= base_url('ubahProfile/ubahProfile'); ?>">

                        <div class="form-group">
                            <label for="username">Username</label>
                            
                            <input value="<?= $this->session->userdata('login')['username'] ?>" type="text" class="form-control" id="new_password1" name="username">
                           
                        </div>

                        <div class="form-group">
                            <label for="nama">Nama Pengguna</label>
                            <input value="<?= $this->session->userdata('login')['nama'] ?>" type="text" class="form-control" id="nama" name="nama">
                        </div>

                        <div class="form-group">
                         
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
							<button type="reset" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;&nbsp;Batal</button>
                        

                       <!-- load footer -->
		
                    </form>
            </div>
            <br>
        </div>
    </div>
</div>
</div>
			<!-- load footer -->
			
            
		</div>
        <?php $this->load->view('partials/footer.php') ?>
            
</div>