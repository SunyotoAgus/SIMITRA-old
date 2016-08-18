<?php
session_start();
include 'templates/validasi.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Beranda - SiMitra BA</title>
        <script src="js/jquery.min.js" type="text/javascript"></script>
        <link href="custcss/mycss.css" rel="stylesheet" type="text/css"/>
        <link href="css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>

    </head>
    <body style="background: url(asset/bg.png)">

        <div class="container mycontainer mycard-huge my-bg-white mypaneldock">

            <?php include 'templates/header.php'; ?>

            <div class="container padbottom">

                <?php include 'templates/sidebar.php'; ?>

                <div class="col-lg-9 mysmallfont">
                    <h6><span class="glyphicon glyphicon-th-large"></span> Home</h6>
                    <hr/>
                    <p class='text-center'>
                        <img style='min-width: 40%; max-width: 40%' src="asset/logo.png" alt=""/>
                    </p>
                    <h1>Halo!</h1>
                    <p>Ini adalah aplikasi SI Mitra BA v1. Aplikasi ini di bangun menggunakan bahasa pemrograman PHP, HTML, CSS dan JavaScript. Gunakan salah satu tombol di sebelah kiri untuk melanjutkan.</p>
                    <h3>Buat Data Baru</h3>
                    <p>Jika anda menekan tombol 'Buat Data Baru', anda akan dialihkan menuju sebuah halaman yang dapat anda gunakan untuk meng-<em>input</em> data mitra dan data transaksi.</p>
                    <h3>Data Mitra</h3>
                    <p>Tombol 'Data Mitra' akan membawa anda menuju sebuah halaman yang dapat anda gunakan untuk melihat, mengedit dan menghapus data mitra.</p>
                    <h3>Data Transaksi</h3>
                    <p>Tombol ini akan membawa anda menuju halaman transaksi, pada halamat tersebut anda dapat melihat detail transaksi, data monitoring angsuran, data mitra yang berhubungan dengan sebuah transaksi, dll.</p>
                </div>
            </div>
            <?php include 'templates/footer.php'; ?>

        </div>
    </body>
</html>
