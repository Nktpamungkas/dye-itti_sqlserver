<?php
ini_set("error_reporting", 1);
session_start();
include("../koneksi.php");
$modal_id = $_GET['id'];
$qry = sqlsrv_query($con, "SELECT id_nsp FROM db_dying.tbl_bonkain WHERE id='$modal_id'");
$r = sqlsrv_fetch_array($qry);
$id = $r['id_nsp'];
$modal = sqlsrv_query($con, "DELETE FROM db_dying.tbl_bonkain WHERE id='$modal_id' ");
if ($modal) {
    echo "<script>window.location='index1.php?p=input-bon-kain&id=$id';</script>";
} else {
    echo "<script>alert('Gagal Hapus');window.location='index1.php?p=input-bon-kain&id=$id';</script>";
}