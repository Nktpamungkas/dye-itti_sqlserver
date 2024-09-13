<?php
ini_set("error_reporting", 1);
include_once '../koneksi.php';
if ($_POST) {
	extract($_POST);
	$id = $_POST['id'];
	$awal = $_POST['awal'];
	$akhir = $_POST['akhir'];
	$analisa = $_POST['analisa_penyebab'];
	$sqlupdate = sqlsrv_query($con, "UPDATE db_dying.tbl_ncp_memo SET 
				analisa_penyebab='$analisa'
				WHERE id='$id'");
	echo " <script>window.location='?p=Lap-NCPMemo&awal=$awal&akhir=$akhir';</script>";
}
