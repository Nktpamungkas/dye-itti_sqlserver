<?php
ini_set("error_reporting", 1);
session_start();
include("../koneksi.php");
if($_POST){ 
	extract($_POST);
	$id = mysqli_real_escape_string($con,$_POST['id']);
	$nama = mysqli_real_escape_string($con,strtoupper($_POST['nama'])); 
	$jab = mysqli_real_escape_string($con,$_POST['jabatan']); 
				$sqlupdate=mysqli_query($con,"UPDATE `tbl_staff` SET 
				`nama`='$nama', 
				`jabatan`='$jab'
				WHERE `id`='$id' LIMIT 1");
				echo " <script>window.location='?p=Staff';</script>";
						
		}
		

?>
