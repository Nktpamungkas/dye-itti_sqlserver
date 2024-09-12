<?php
ini_set("error_reporting", 1);
session_start();
include("../koneksi.php");
if ($_POST) {
	$id = $_POST['id'];
	$nama = strtoupper($_POST['nama']);
	$jab = $_POST['jabatan'];
	$sqlupdate = sqlsrv_query($con, "UPDATE db_dying.tbl_staff SET 
				nama='$nama', 
				jabatan='$jab'
				WHERE id='$id'");
	echo " <script>window.location='?p=Staff';</script>";
}
