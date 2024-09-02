<?php
// ini_set("error_reporting", 1);
session_start();
include("../koneksi.php");
function cek($value)
{
	if ($value == NULL || $value == '') {
		return NULL;
	}
	if ($value instanceof DateTime) {
		if ($value->format('Y-m-d') != '1900-01-01') {
			return $value->format('Y-m-d');
		} else {
			return NULL;
		}
	}
	if ($value == '1900-01-01') {
		return NULL;
	}
	return $value;
}


if ($_POST) {
	extract($_POST);
	$id	= $_POST['id'];
	if(!empty($_POST['tgl_stop']) AND !empty($_POST['jam_stop'])){
		$stop = $_POST['tgl_stop'] . " " . $_POST['jam_stop'] . ":00.000";
	}else{
		$stop = NULL;
	}
	if (!empty($_POST['tgl_stop2']) AND !empty($_POST['jam_stop2'])) {
		$stop2 = $_POST['tgl_stop2'] . " " . $_POST['jam_stop2'] . ":00.000";
	} else {
		$stop2 = NULL;
	}
	if (!empty($_POST['tgl_stop3']) AND !empty($_POST['jam_stop3'])) {
		$stop3 = $_POST['tgl_stop3'] . " " . $_POST['jam_stop3'] . ":00.000";
	} else {
		$stop3 = NULL;
	}
	if (!empty($_POST['tgl_stop4']) AND !empty($_POST['jam_stop4'])) {
		$stop4 = $_POST['tgl_stop4'] . " " . $_POST['jam_stop4'] . ":00.000";
	} else {
		$stop4 = NULL;
	}

	// $stop   	= $_POST['tgl_stop'] . " " . $_POST['jam_stop'].":00.000";
	// $stop2   	= $_POST['tgl_stop2'] . " " . $_POST['jam_stop2'] . ":00.000";
	// $stop3   	= $_POST['tgl_stop3'] . " " . $_POST['jam_stop3'] . ":00.000";
	// $stop4   	= $_POST['tgl_stop4'] . " " . $_POST['jam_stop4'] . ":00.000";

	if (($_POST['tgl_mulai'] != '' or $_POST['tgl_mulai'] != NULL) && ($_POST['jam_mulai'] != '' or $_POST['jam_mulai'] != NULL)) {
		$mulai = $_POST['tgl_mulai'] . " " . $_POST['jam_mulai'] . ":00.000";
	} else {
		$mulai = NULL;
	}
	if (($_POST['tgl_mulai2'] != '' or $_POST['tgl_mulai2'] != NULL) && ($_POST['jam_mulai2'] != '' or $_POST['jam_mulai2'] != NULL)) {
		$mulai2 = $_POST['tgl_mulai2'] . " " . $_POST['jam_mulai2'] . ":00.000";
	} else {
		$mulai2 = NULL;
	}
	if (($_POST['tgl_mulai3'] != '' or $_POST['tgl_mulai3'] != NULL) && ($_POST['jam_mulai3'] != '' or $_POST['jam_mulai3'] != NULL)) {
		$mulai3 = $_POST['tgl_mulai3'] . " " . $_POST['jam_mulai3'] . ":00.000";
	} else {
		$mulai3 = NULL;
	}
	if (($_POST['tgl_mulai4'] != '' or $_POST['tgl_mulai4'] != NULL) && ($_POST['jam_mulai4'] != '' or $_POST['jam_mulai4'] != NULL)) {
		$mulai4 = $_POST['tgl_mulai4'] . " " . $_POST['jam_mulai4'] . ":00.000";
	} else {
		$mulai4 = NULL;
	}

	// $mulai  	= $_POST['tgl_mulai'] . " " . $_POST['jam_mulai']. ":00.000";
	// $mulai2  	= $_POST['tgl_mulai2'] . " " . $_POST['jam_mulai2']. ":00.000";
	// $mulai3  	= $_POST['tgl_mulai3'] . " " . $_POST['jam_mulai3']. ":00.000";
	// $mulai4 	= $_POST['tgl_mulai4'] . " " . $_POST['jam_mulai4']. ":00.000";

	if($_POST['sisa_waktu']!= NULL or $_POST['sisa_waktu']!= ''){
	$sisa		= $_POST['sisa_waktu'];
	}else{$sisa = NULL;}

	$qCek 		= sqlsrv_query($con, "SELECT TOP 1 * FROM db_dying.tbl_montemp WHERE [id]='$id'");
	$rCek 		= sqlsrv_fetch_array($qCek);
	$lama		= $rCek['sisa_waktu'];

	// Inisiasi untuk insert tanggal stop
	if ($_POST['tgl_stop'] != "" or $_POST['jam_stop'] != "") {
		// $qstop = ", `tgl_stop`='$stop' , `tgl_target` = ADDDATE('$stop', INTERVAL '$lama' HOUR_MINUTE ) ";
		$qstop = "tgl_stop='$stop',";
	} else {
		$qstop = "";
	}
	if ($_POST['tgl_stop2'] != "" or $_POST['jam_stop2'] != "") {
		// $qstop = ", `tgl_stop2`='$stop' , `tgl_target` = ADDDATE('$stop', INTERVAL '$lama' HOUR_MINUTE ) ";
		$qstop2 = "tgl_stop2='$stop2',";
	} else {
		$qstop2 = "";
	}
	if ($_POST['tgl_stop3'] != "" or $_POST['jam_stop3'] != "") {
		// $qstop = ", `tgl_stop3`='$stop' , `tgl_target` = ADDDATE('$stop', INTERVAL '$lama' HOUR_MINUTE ) ";
		$qstop3 = "tgl_stop3='$stop3',";
	} else {
		$qstop3 = "";
	}
	if ($_POST['tgl_stop4'] != "" or $_POST['jam_stop4'] != "") {
		// $qstop = ", `tgl_stop4`='$stop' , `tgl_target` = ADDDATE('$stop', INTERVAL '$lama' HOUR_MINUTE ) ";
		$qstop4 = "tgl_stop4='$stop4',";
	} else {
		$qstop4 = "";
	}

// Inisiasi untuk insert tanggal mulai
	if ($_POST['tgl_mulai'] != "" or $_POST['jam_mulai'] != "") {
		// $qmulai = ", `tgl_mulai`='$mulai' , `tgl_target` = ADDDATE('$mulai', INTERVAL '$lama' HOUR_MINUTE ) ";
		$qmulai = "tgl_mulai='$mulai',";
	} else {
		$qmulai = "";
	}
	if ($_POST['tgl_mulai2'] != "" or $_POST['jam_mulai2'] != "") {
		// $qmulai = ", `tgl_mulai2`='$mulai' , `tgl_target` = ADDDATE('$mulai', INTERVAL '$lama' HOUR_MINUTE ) ";
		$qmulai2 = "tgl_mulai2='$mulai2',";
	} else {
		$qmulai2 = "";
	}
	if ($_POST['tgl_mulai3'] != "" or $_POST['jam_mulai3'] != "") {
		// $qmulai = ", `tgl_mulai3`='$mulai' , `tgl_target` = ADDDATE('$mulai', INTERVAL '$lama' HOUR_MINUTE ) ";
		$qmulai3 = "tgl_mulai3='$mulai3',";
	} else {
		$qmulai3 = "";
	}
	if ($_POST['tgl_mulai4'] != "" or $_POST['jam_mulai4'] != "") {
		// $qmulai = ", `tgl_mulai4`='$mulai' , `tgl_target` = ADDDATE('$mulai', INTERVAL '$lama' HOUR_MINUTE ) ";
		$qmulai4 = "tgl_mulai4='$mulai4',";
	} else {
		$qmulai4 = "";
	}


	$sqlupdate = sqlsrv_query($con, "UPDATE db_dying.tbl_montemp SET 
											[ket_stopmesin] = '$_POST[ket_stopmesin]',
											[ket_stopmesin2] = '$_POST[ket_stopmesin2]',
											[ket_stopmesin3] = '$_POST[ket_stopmesin3]',
											[ket_stopmesin4] = '$_POST[ket_stopmesin4]',
											$qstop
											$qstop2
											$qstop3
											$qstop4
											$qmulai
											$qmulai2
											$qmulai3
											$qmulai4
											[sisa_waktu]='$sisa'
											WHERE id='$id'");
	if($sqlupdate){
		echo "<script>swal({
					title: 'Data Tersimpan',
					type: 'success',
					allowOutsideClick: false, 
            		allowEscapeKey: false,
					}).then((result) => {
					if (result.value) {
						
						window.location.href='?p=Monitoring-Tempelan'; 
					}
					});</script>";
	}else{
		echo "UPDATE db_dying.tbl_montemp SET 
		[ket_stopmesin]= '$_POST[ket_stopmesin]',
		[ket_stopmesin2] = '$_POST[ket_stopmesin2]',
		[ket_stopmesin3] = '$_POST[ket_stopmesin3]',
		[ket_stopmesin4] = '$_POST[ket_stopmesin4]',
		$qstop
		$qstop2
		$qstop3
		$qstop4
		$qmulai
		$qmulai2
		$qmulai3
		$qmulai4
		[sisa_waktu]='$sisa'
		WHERE id='$id'";
	}
}
