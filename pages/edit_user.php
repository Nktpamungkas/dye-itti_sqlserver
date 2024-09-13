<?php
ini_set("error_reporting", 1);
session_start();
include("../koneksi.php");
if ($_POST) {
	// Ambil nilai dari $_POST
	$id = $_POST['id'];
	$nama = strtoupper($_POST['nama']); // Misalnya, mengubah nama menjadi huruf kapital
	$user = $_POST['username'];
	$pass = $_POST['password'];
	$repass = $_POST['re_password'];
	$level = $_POST['level'];
	$status = $_POST['status'];

	// Validasi bahwa password dan re-password sesuai
	if ($pass != $repass) {
		echo "<script>swal({
                title: 'Gagal',
                text: 'Not Match Re-New Password!!.',
                type: 'error',
                }).then((result) => {
                if (result.value) {
                    window.location='?p=User';
                }
            });</script>";
	} else {
		// Prepare SQL statement
		$query = "UPDATE db_dying.tbl_user SET 
                  nama = ?,
                  username = ?,
                  password = ?,
                  level = ?,
                  status = ?,
                  tgl_update = GETDATE()
                  WHERE id = ?";

		// Prepare parameters for the query
		$params = array($nama, $user, $pass, $level, $status, $id);

		// Execute the prepared statement
		$stmt = sqlsrv_prepare($con, $query, $params);

		if (sqlsrv_execute($stmt)) {
			echo "<script>swal({
                title: 'Sukses',
                text: 'User update successfully!',
                type: 'success',
                }).then((result) => {
                if (result.value) {
                    window.location='?p=User';
                }
            });</script>";
		} else {
			echo "<script>swal({
                title: 'Gagal',
                text: 'Failed to update user. Please try again later.',
                type: 'error',
                }).then((result) => {
                if (result.value) {
                    window.location='?p=User';
                }
            });</script>";
		}
	}
}
