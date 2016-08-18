<?php
if (count(get_included_files()) == 1) {
    exit("No direct scripting");
}
?>

<div class="col-lg-3">
    <h6><a href='home.php'><span class="glyphicon glyphicon-home"></span> Beranda</a></h6>
    <hr/>
    <p><b>Saldo :</b> Rp. <?php
    include 'initializedb.php';
    $query='select * from saldo';
    $res = mysqli_query($connection, $query);
    $row = $res->fetch_assoc();
    echo number_format($row['amount']);
    ?></p>
    <form action="buat.php">
        <button class="btn btn-block btn-lg btn-danger" type='submit'><span class="glyphicon glyphicon-plus-sign"></span> Buat Data Baru</button>
    </form>
    <br/>
    <form action="buat.php" method="POST">
        <input type="hidden" name="drop" value="1"/>
        <button class="btn btn-block btn-lg btn-danger" type='submit'><span class="glyphicon glyphicon-plus-sign"></span> Input Data Dropping</button>
    </form>
    <br/>
    <form action="mitra.php">
        <button class="btn btn-block btn-warning" type='submit'><span class="glyphicon glyphicon-user"></span> Data Mitra</button>
    </form>

    <br/>
    <form action='transaksi.php'>
        <button class="btn btn-block btn-warning" type='submit'><span class="glyphicon glyphicon-briefcase"></span> Data Transaksi</button>
    </form>
    <br/>
    <form action='core/pdfcore/examples/report.php' target="_blank">
        <button class="btn btn-block btn-warning" type='submit'><span class="glyphicon glyphicon-record"></span> Laporan Keuangan</button>
    </form>
</div>