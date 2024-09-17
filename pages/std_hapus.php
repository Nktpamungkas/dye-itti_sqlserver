<?php
ini_set("error_reporting", 1);
session_start();
include("../koneksi.php");
$modal_id = $_GET['id'];
$modal1 = sqlsrv_query($con, "DELETE FROM db_dying.tbl_std_jam WHERE id='$modal_id' ");

if ($modal1) {
    echo "<script>swal({
    		title: 'Sukses',
    		text: 'Data berhasil disimpan',
    		type: 'success',
    		}).then((result) => {
    		if (result.value) {
    		window.location='?p=Std-Target';
    		}
    	});</script>";

    // Clean up statement resources
    sqlsrv_free_stmt($modal1);
} else {
    echo "<script>swal({
    		title: 'Sukses',
    		text: 'Data berhasil disimpan',
    		type: 'success',
    		}).then((result) => {
    		if (result.value) {
    		window.location='?p=Std-Target';
    		}
    	});</script>";

    // Clean up statement resources
    sqlsrv_free_stmt($modal1);
}
