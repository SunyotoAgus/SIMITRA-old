<?php

include '../templates/initializedb.php';
$tgl = $_POST['tgl'];
$jml = $_POST['jml'];

if ($connection != null) {
    $insert = "insert into dropping values(0, '$jml', '$tgl')";
    if ($connection->query($insert) === TRUE) {
        $querysaldo = 'select * from saldo';
        $res = mysqli_query($connection, $querysaldo);
        $saldo = $res->fetch_assoc();
        $newsaldo = $jml + $saldo['amount'];
        $update = "update saldo set amount = $newsaldo";
        if ($connection->query($update) === TRUE){
            echo $connection->insert_id;
        }
        
    } else {
        echo "Error: " . $insert . "<br>" . $connection->error;
    }
}