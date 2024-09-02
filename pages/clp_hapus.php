<?php
ini_set("error_reporting", 1);
session_start();
include("../koneksi.php");
    $modal_id=$_GET['id'];
	$cek=sqlsrv_query($con,"SELECT * FROM db_dying.tbl_hasilcelup WHERE id='$modal_id' ");
	$r=sqlsrv_fetch_array($cek);
    $cek1=sqlsrv_query($con,"SELECT * FROM db_dying.tbl_montemp WHERE id='$r[id_montemp]' ");
	$r1=sqlsrv_fetch_array($cek1);
	$qCek=sqlsrv_query($con,"SELECT * FROM db_dying.tbl_schedule WHERE id='$r1[id_schedule]' LIMIT 1");
	$rCek=sqlsrv_fetch_array($qCek);
    $modal1=sqlsrv_query($con,"DELETE FROM db_dying.tbl_hasilcelup WHERE id='$modal_id' ");
    if ($modal1) {
		$qSCH=sqlsrv_query($con,"UPDATE db_dying.tbl_schedule SET [status]='sedang jalan' WHERE id='$r1[id_schedule]' ");
		$qMTP=sqlsrv_query($con,"UPDATE db_dying.tbl_montemp SET [status]='sedang jalan' WHERE id='$r[id_montemp]' ");
		$qMTP=sqlsrv_query($con,"UPDATE db_dying.tbl_schedule 
		  SET no_urut = no_urut + 1 
		  WHERE no_mesin = '$rCek[no_mesin]' 
		  AND [status] = 'antri mesin' ");
        echo "<script>window.location='?p=Hasil-Celup';</script>";
    } else {
        echo "<script>alert('Gagal Hapus');window.location='?p=Hasil-Celup';</script>";
    }
