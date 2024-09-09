<?php

    $modal_id=$_GET['id'];
    $modal=sqlsrv_query($con,"DELETE FROM db_dying.tbl_datatest WHERE id='$modal_id' ");
    if ($modal) {
        echo "<script>window.location='index1.php?p=Lap-DataTest-Proses';</script>";
    } else {
        echo "<script>alert('Gagal Hapus');window.location='index1.php?p=Lap-DataTest-Proses';</script>";
    }