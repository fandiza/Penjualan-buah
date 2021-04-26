<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Toko Buah Bening</title>
	<link href="<?= base_url('sb-admin') ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
	<link href="<?= base_url('sb-admin') ?>/css/sb-admin-2.min.css" rel="stylesheet">
	<link href="<?= base_url('sb-admin') ?>/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>
<!-- <link rel="icon" href="<?php echo base_url() . 'assets/buah.png' ?>"> -->
<div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image">
                        </div>
                        <hr>
                        <div class="col-lg -9">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h5 text-primary">Masuk</h1>
                                </div>
                                <div class="nav-link">
                                    <!-- <center>
                                        <img src="<?= base_url(); ?>assets/buah.png" alt="" width="50%">
                                    </center> -->
                                    <br>
									<form class="user" method="POST" action="<?= base_url('login/proses_login') ?>">
										<div class="form-group">
											<input type="text" class="form-control" id="username" placeholder="Masukkan Username" autocomplete="off" required name="username">
										</div>
										<div class="form-group">
											<input type="password" class="form-control" id="password" placeholder="Masukkan Password" required name="password">
										</div>
										<button type="submit" class="btn btn-primary btn-block" name="login">
											Login
										</button>
									</form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="<?= base_url('beranda'); ?>">Beranda</a>
                                    </div>
                                    <!-- <div class="text-center">
                                        <a class="small" href="<?= base_url('auth/forgotPassword'); ?>">Lupa
                                            Kata Sandi ?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="<?= base_url('auth/registration'); ?>">Buat akun baru
                                        </a>
                                    </div> -->


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
	<script src="<?= base_url('sb-admin') ?>/vendor/jquery/jquery.min.js"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/jquery-easing/jquery.easing.min.js"></script>
	<script src="<?= base_url('sb-admin') ?>/js/sb-admin-2.min.js"></script>
</body>
<body background="<?= base_url(); ?>./assets/batik2.png">

<style>
    .bg-login-image {
        background-image: url("<?= base_url('assets/buah.png'); ?>");
        background-repeat: no-repeat;
        background-size: 80%;
    }
    </style>
</html>
