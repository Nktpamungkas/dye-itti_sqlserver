<?php
ini_set("error_reporting", 1);
session_start();
include("../koneksi.php");
if($_POST){ 
	extract($_POST);
	$id = $_POST['id'];
	$ket = $_POST['ket'];
	$sts= $_POST['sts_warna'];
	$acc = $_POST['acc'];
	$disposisi = $_POST['disposisi'];
				$sqlupdate=sqlsrv_query($con,"UPDATE db_dying.tbl_potongcelup SET 
				comment_warna='$sts',
				acc='$acc',
				disposisi='$disposisi',
				ket='$ket'
				WHERE id='$id'");
				echo " <script>window.location='?p=Potong-Celup';</script>";
				
		}
		

?>
