<?php
ini_set("error_reporting", 1);
session_start();
include("../koneksi.php");
if ($_POST) {
  // Extracting $_POST variables (not recommended, but for simplicity)
  extract($_POST);

  // Validate and sanitize input values
  $kode = strtoupper($kode); // Convert kode to uppercase
  $jns = isset($jenis) ? $jenis : '';
  $target = isset($target) ? $target : '';

  // Prepare the SQL statement with placeholders
  $sql = "INSERT INTO db_dying.tbl_std_jam (kode, jenis, target) VALUES (?, ?, ?)";

  // Prepare the parameters for the query
  $params = array($kode, $jns, $target);

  // Execute the prepared statement
  $stmt = sqlsrv_query($con, $sql, $params);

  if ($stmt) {
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
    sqlsrv_free_stmt($stmt);
  } else {
    echo "<script>swal({
			title: 'Gagal',
			text: 'Data gagal disimpan',
			type: 'error',
			}).then((result) => {
			if (result.value) {
			window.location='?p=Std-Target'
			}
		});</script>";

    // Clean up statement resources
    sqlsrv_free_stmt($stmt);
  }
}
