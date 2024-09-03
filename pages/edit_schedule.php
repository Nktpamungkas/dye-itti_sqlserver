<?php
ini_set("error_reporting", 1);
session_start();
include("../koneksi.php");
function cekDesimal($angka)
{
	$bulat = round($angka);
	if ($bulat > $angka) {
		$jam = $bulat - 1;
		$waktu = $jam . ":30";
	} else {
		$jam = $bulat;
		$waktu = $jam . ":00";
	}
	return $waktu;
}
if ($_POST) {
	extract($_POST);
	$id = $_POST['id'];
	$urut = $_POST['no_urut'];
	$ketkain = $_POST['ket_kain'];
	$ket = $_POST['ket'];
	$personil = $_POST['personil'];
	$mesin =  $_POST['no_mesin'];
	$mcfrom = $_POST['mc_from'];
	$proses = $_POST['proses'];
	$target = $_POST['target'];
	$resep =  $_POST['no_resep'];
	$resep2 =  $_POST['no_resep2'];
	$target1 = cekDesimal($target);
	$status = $_POST['status'];
	if ($status != "") {
		$sts = ", status = '$status' ";
	} else {
		$sts = null;
	}
	if ($_POST['kk_kestabilan'] == "1") {
		$kk_kestabilan = "1";
	} else {
		$kk_kestabilan = "0";
	}
	if ($_POST['kk_normal'] == "1") {
		$kk_normal = "1";
	} else {
		$kk_normal = "0";
	}
	$Qrycek = sqlsrv_query($con, "SELECT TOP 1 * FROM db_dying.tbl_mesin WHERE no_mesin='$mesin' ");
	$rCek = sqlsrv_fetch_array($Qrycek);
	$kapasitas = $rCek['kapasitas'];
	$sqlupdate = sqlsrv_query($con, "UPDATE db_dying.tbl_schedule SET 
				no_mesin='$mesin',
				kapasitas='$kapasitas',
				mc_from='$mcfrom',
				target='$target',
				proses='$proses',
				no_urut='$urut',
				no_sch='$urut',
				no_resep='$resep',
				no_resep2='$resep2',
				ket_kain='$ketkain',
				ket_status='$ket',
				kk_kestabilan='$kk_kestabilan',
		 	 	kk_normal='$kk_normal',
				personil='$personil'
				$sts
				WHERE id='$id' ");
	$sqlupdate1 = sqlsrv_query($con, "UPDATE db_dying.tbl_montemp
								SET tgl_target = DATEADD(MINUTE, 
														CAST(SUBSTRING(target1, 1, CHARINDEX(':', target1) - 1) AS INT) * 60 +
														CAST(SUBSTRING(target1, CHARINDEX(':', target1) + 1, LEN(target1)) AS INT), 
														tgl_buat)
								WHERE id_schedule ='$id'");
	echo " <script>window.location='?p=Schedule';</script>";
}
