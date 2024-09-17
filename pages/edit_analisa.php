<?php
ini_set("error_reporting", 1);
if ($_POST) {
	extract($_POST);
	$id = $_POST['id'];
	$awal = $_POST['awal'];
	$akhir = $_POST['akhir'];
	$analisa = $_POST['analisa_penyebab'];
	$sqlupdate = sqlsrv_query($cond, "UPDATE db_qc.tbl_ncp_qcf SET 
				analisa_penyebab ='$analisa'
				WHERE id='$id'");
	echo " <script>window.location='?p=Lap-NCP&awal=$awal&akhir=$akhir';</script>";
}
