<?php
ini_set("error_reporting", 1);
session_start();
include("../koneksi.php");
if ($_POST) {
	$note = $_POST['note'];
	$mesin = $_POST['no_mesin'];
	$kap = $_POST['kap'];
	$l_r = $_POST['l_r'];
	$kd = $_POST['kode'];
	$sqlupdate = sqlsrv_query($con, "INSERT INTO db_dying.tbl_mesin (no_mesin, l_r, kapasitas, kode, ket) 
          VALUES ('$mesin', '$l_r', $kap, '$kd', '$note')
				");
	if ($sqlupdate) {
		echo "<script>swal({
			title: 'Sukses',
			text: 'Data berhasil disimpan',
			type: 'success',
			}).then((result) => {
			if (result.value) {
			window.location='?p=Mesin';
			}
		});</script>";
	} else {
		echo "<script>swal({
			title: 'Gagal',
			text: 'Data gagal disimpan',
			type: 'error',
			}).then((result) => {
			if (result.value) {
			window.location='?p=Mesin'
			}
		});</script>";
	}


	// Clean up statement resources
	sqlsrv_free_stmt($sqlupdate);
}
