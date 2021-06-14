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
            <h3><b><p style="text-align:center;margin:0;padding:0">Data Penjualan</p></b></h3>
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
                    <th class="text-primary" style=" text-align: center; ">No Penjualan</th>
                    <th class="text-primary" style=" text-align: center; ">Nama Kasir</th>
                    <th class="text-primary" style=" text-align: center; ">Tanggal Penjualan</th>
                    <th class="text-primary" style=" text-align: center; ">Jam Penjualan</th>
                    <th class="text-primary" style=" text-align: center; ">Total</th>
                    
                  
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                        foreach ($filter_penjualan as $fp) : ?>
                <tr>
                    <td style=" text-align: center;"><?= $no++ ?></td>
                    <td style=" text-align: center;"><?= $fp->no_penjualan ?></td>
                    <td style=" text-align: center;"><?= $fp->nama_kasir ?></td>
                    <td style=" text-align: center;"><?= $fp->tgl_penjualan ?></td>
                    <td style=" text-align: center;"><?= $fp->jam_penjualan ?></td>
                    <td style=" text-align: center;"><?= $fp->total ?></td>
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