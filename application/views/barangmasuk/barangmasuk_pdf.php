<!DOCTYPE html>
<html>


<!-- <head>
    <title></title>
    <h6 style="font-size:3rem;text-align:center;margin:0;padding:0">Baiti Jannati</h6><br>
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
</head> -->
<style type="text/css">
.kop-surat {
    line-height: 50%;
}

table {
    margin: auto;


}
</style>

<body>
    <table>
        <tr>
           
            <td>
                <div class="kop-surat">
                    <center>
                        <a><b><h1>Toko Buah Bening</h1></b></a>
                        <p>
                            <a>Jl. Raya Bening No.29, Beru, Kec. Wlingi, Blitar, Jawa Timur 66184</a>
                        <p>
                            <a>Telp : 081252400952</a>
                        
                    </center>
                </div>
            </td>
        </tr>
    </table>
    <hr>
    <div>


        <b>
            <h3><b><p style="text-align:center;margin:0;padding:0">Data Barang Masuk</p></b></h3>
        </b>
        <br>
        <center>
            <b>
                <?php echo $title ?> <br>
                <?php echo $subtitle ?> <br>
            </b>
        </center>
        <br>
        <table width="100%" cellspacing="0" border="1">
            <thead>
                <tr>
                    <th class="text-primary" style=" text-align: center; ">No</th>
                    <th class="text-primary" style=" text-align: center; ">Barang</th>
                    <th class="text-primary" style=" text-align: center; ">Tgl. Masuk</th>
                    <th class="text-primary" style=" text-align: center; ">Kadaluarsa</th>
                    <th class="text-primary" style=" text-align: center; ">Jumlah</th>
                    <th class="text-primary" style=" text-align: center; ">Supplier</th>
                    <th class="text-primary" style=" text-align: center; ">User</th>
                  
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                        foreach ($filter_barangmasuk as $bm) : ?>
                <tr>
                    <td style=" text-align: center;"><?= $no++ ?></td>
                    <td style=" text-align: center;"><?= $bm->nama_barang ?></td>
                    <td style=" text-align: center;">
                        <?=  date('d-m-Y ', strtotime($bm->tanggalmasuk)); ?></td>
                    </td>
                    <td style=" text-align: center;">
                        <?=  date('d-m-Y ', strtotime($bm->exp)); ?></td>
                    </td>
                    <td style=" text-align: center;"><?= $bm->jumlah ?> Kg</td>
                    <td style=" text-align: center;"><?= $bm->nama_sup ?></td>
                    <td style=" text-align: center;"><?= $bm->nama ?></td>
                </tr>

                <?php endforeach ?>

            </tbody>


        </table>





    </div>
    </div>
</body>

</html>
<!-- Bootstrap core JavaScript-->
<script src="<?= base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url(); ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url(); ?>/assets/js/sb-admin-2.min.js"></script>

<!-- DataTables -->
<!-- Page level plugins -->
<script src="<?= base_url(); ?>assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?= base_url(); ?>assets/js/demo/datatables-demo.js"></script>