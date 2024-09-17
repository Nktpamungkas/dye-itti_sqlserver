<?php
ini_set("error_reporting", 1);
session_start();
include("../koneksi.php");
if ($_POST) {
	// Validasi dan ambil nilai dari $_POST
	$id = isset($_POST['id']) ? $_POST['id'] : '';
	$kap = isset($_POST['kap']) ? $_POST['kap'] : '';
	$l_r = isset($_POST['l_r']) ? $_POST['l_r'] : '';
	$kd = isset($_POST['kode']) ? $_POST['kode'] : '';
	$nomesin = isset($_POST['no_mesin']) ? $_POST['no_mesin'] : '';
	$note = isset($_POST['note']) ? $_POST['note'] : '';

	// Prepare the SQL statement with placeholders
	$sqlupdate = "UPDATE db_dying.tbl_mesin SET 
                    kapasitas = ?,
                    l_r = ?,
                    kode = ?,
                    ket = ?,
                    no_mesin = ?
                  WHERE id = ?";

	// Prepare the parameters for the query
	$params = array($kap, $l_r, $kd, $note, $nomesin, $id);

	// Execute the prepared statement
	$stmt = sqlsrv_query($con, $sqlupdate, $params);

	if ($stmt === false) {
		// Handle query error
		echo "<script>swal({
                title: 'Gagal',
                text: 'Data gagal disimpan.',
                type: 'error',
                }).then((result) => {
                if (result.value) {
                    window.location='?p=Mesin';
                }
            });</script>";
	} else {
		// Handle query error
		echo "<script>swal({
                title: 'Sukses',
                text: 'Data berhasil disimpan.',
                type: 'success',
                }).then((result) => {
                if (result.value) {
                    window.location='?p=Mesin';
                }
            });</script>";
	}

	// Clean up statement resources
	sqlsrv_free_stmt($stmt);
}
