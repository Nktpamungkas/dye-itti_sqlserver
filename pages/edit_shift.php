<?php
ini_set("error_reporting", 1);
session_start();
include("../koneksi.php");
if($_POST){ 
	extract($_POST);
	$id 	= $_POST['id'];
	$shift 	= $_POST['shift']; 
				$sqlupdate=sqlsrv_query($con,"UPDATE db_dying.tbl_montemp SET 
				[g_shift]='$shift'
				WHERE [id]='$id'");
				echo " <script>window.location='?p=Monitoring-Tempelan';</script>";
						
		}
		

?>
