<?php
ini_set("error_reporting", 1);
session_start();
include("../koneksi.php");
    $modal_id=$_GET['id'];
	$cek=sqlsrv_query($con,"SELECT id_schedule FROM db_dying.tbl_montemp WHERE id='$modal_id' ");
	$r=sqlsrv_fetch_array($cek);
	$cek1=sqlsrv_query($con,"SELECT no_mesin FROM db_dying.tbl_schedule WHERE id='$r[id_schedule]' ");
	$r1=sqlsrv_fetch_array($cek1);
    $modal1=sqlsrv_query($con,"DELETE FROM db_dying.tbl_montemp WHERE id='$modal_id' ");
    if ($modal1) {
		$qSCH=sqlsrv_query($con,"UPDATE db_dying.tbl_schedule SET [status]='antri mesin' WHERE id='$r[id_schedule]' ");
		$qSCH1=sqlsrv_query($con,"UPDATE db_dying.tbl_schedule SET [status]='antri mesin' WHERE no_mesin='$r1[no_mesin]' AND [status]='sedang jalan' ");
        echo "<script>window.location='?p=Monitoring-Tempelan';</script>";
    } else {
        echo "<script>alert('Gagal Hapus');window.location='?p=Monitoring-Tempelan';</script>";
    }
