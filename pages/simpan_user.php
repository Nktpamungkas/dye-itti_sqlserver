<?php
ini_set("error_reporting", 1);
session_start();
include("../koneksi.php");

if ($_POST) {
	// Validate and sanitize input values (jika diperlukan)
	$nama = strtoupper($_POST['nama']);
	$user = $_POST['username'];
	$pass = $_POST['password'];
	$repass = $_POST['re_password'];
	$level = $_POST['level'];
	$status = $_POST['status'];

	// Check if username already exists
	$query_check_user = "SELECT COUNT(*) as jml FROM db_dying.tbl_user WHERE username = ?";
	$stmt_check_user = sqlsrv_prepare($con, $query_check_user, array(&$user));
	sqlsrv_execute($stmt_check_user);
	$row = sqlsrv_fetch_array($stmt_check_user, SQLSRV_FETCH_ASSOC);

	if ($row['jml'] > 0) {
		echo "<script>swal({
                title: 'Gagal',
                text: 'Someone already has this username!.',
                type: 'error',
                }).then((result) => {
                if (result.value) {
                    window.location='?p=User';
                }
            });</script>";
	} else if ($pass != $repass) {
		echo "<script>swal({
                title: 'Gagal',
                text: 'Passwords do not match!.',
                type: 'error',
                }).then((result) => {
                if (result.value) {
                    window.location='?p=User';
                }
            });</script>";
	} else {
		// Insert user data into database
		$query_insert_user = "INSERT INTO db_dying.tbl_user (nama, username, password, level, status, foto, dept, tgl_update) 
                              VALUES (?, ?, ?, ?, ?, 'avatar', 'DYE', GETDATE())";
		$params = array($nama, $user, $pass, $level, $status);
		$stmt_insert_user = sqlsrv_prepare($con, $query_insert_user, $params);

		if (sqlsrv_execute($stmt_insert_user)) {
			echo "<script>swal({
                title: 'Sukses',
                text: 'User added successfully!',
                type: 'success',
                }).then((result) => {
                if (result.value) {
                    window.location='?p=User';
                }
            });</script>";
		} else {
			echo "<script>swal({
			    title: 'Gagal',
			    text: 'Failed to add user. Please try again later.',
			    type: 'error',
			    }).then((result) => {
			    if (result.value) {
			        window.location='?p=User';
			    }
			});</script>";
		}
	}
}
