<?php
ini_set("error_reporting", 1);
session_start();
include("../koneksi.php");
if ($_POST) {
	// Extracting $_POST variables (not recommended, but for simplicity)
	extract($_POST);

	// Validate and sanitize input values
	$id = $_POST['id'];
	$jenis = strtoupper($_POST['jenis']); // Convert jenis to uppercase
	$target = $_POST['target'];

	// Prepare the SQL statement with placeholders
	$sql = "UPDATE db_dying.tbl_std_jam SET 
                jenis = ?,
                target = ?
            WHERE id = ?";

	// Prepare the parameters for the query
	$params = array($jenis, $target, $id);

	// Execute the prepared statement
	$stmt = sqlsrv_query($con, $sql, $params);

	if ($stmt === false) {
		// Handle query error
		echo "<script>swal({
                title: 'Gagal',
                text: 'Data gagal disimpan',
                type: 'error',
                }).then((result) => {
                if (result.value) {
                    window.location='?p=Std-Target';
                }
            });</script>";
	} else {
		// Success message
		echo "<script>swal({
                title: 'Sukses',
                text: 'Data berhasil disimpan',
                type: 'success',
                }).then((result) => {
                if (result.value) {
                    window.location='?p=Std-Target';
                }
            });</script>";
	}

	// Clean up statement resources
	sqlsrv_free_stmt($stmt);
}
