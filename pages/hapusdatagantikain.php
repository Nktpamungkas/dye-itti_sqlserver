<?php
ini_set("error_reporting", 1);
session_start();
include("../koneksi.php");
$modal_id = $_GET['id'];
$modal = sqlsrv_query($con, "DELETE FROM db_dying.tbl_gantikain WHERE id='$modal_id' ");
if ($modal) {
    echo "<script>window.location='index1.php?p=Lap-Bon';</script>";
} else {
    echo "<script>alert('Gagal Hapus');window.location='index1.php?p=Lap-Bon';</script>";
}