<?php
//ini_set("error_reporting", 1);
//session_start();
//include("../koneksi.php");
//if ($_POST) {
//    $nama = ($con,strtoupper($_POST['nama']));
//    $jab = ($con,$_POST['jabatan']);    
//        $sqlupdate=mysqli_query($con,"INSERT INTO `tbl_staff` SET
//				`nama`='$nama',				
//				`jabatan`='$jab'
//				");
//        echo " <script>window.location='?p=Staff';</script>";
//    }


ini_set("error_reporting", 1);
session_start();
include("../koneksi.php");

// Assuming $con is your SQL Server connection
if ($_POST) {
  extract($_POST);
  // Prepare the SQL statement to prevent SQL injection
  $nama = strtoupper($_POST['nama']);
  $jab = $_POST['jabatan'];
  //$sqlid = "SELECT max(id)+1 as id FROM db_dying.tbl_staff";
  //$smtid = sqlsrv_query($con, $sqlid);
  //$rowid = sqlsrv_fetch_array($smtid);

  // Use SQL Server functions
  $sql = "INSERT INTO db_dying.tbl_staff (nama, jabatan) VALUES (?, ?)";
  $params = array($nama, $jab);

  $stmt = sqlsrv_query($con, $sql, $params);

  if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
  }

  // Redirect to the Staff page
  echo "<script>window.location='?p=Staff';</script>";
}
