<?php
ini_set("error_reporting", 1);
session_start();
include("../koneksi.php");
    $modal_id=$_GET['id'];
    $modal1=sqlsrv_query($con, "UPDATE db_dying.tbl_schedule SET high_temp = null WHERE id='$modal_id' ");
    if ($modal1) {
        echo "<script>window.location='?p=Schedule';</script>";
    } else {
        echo "<script>alert('Gagal High Temp');window.location='?p=Schedule';</script>";
    }
