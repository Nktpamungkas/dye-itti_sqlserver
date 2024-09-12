<?php
ini_set("error_reporting", 1);
session_start();
include("../koneksi.php");
if ($_POST) {
  extract($_POST);
  $id = $_POST['id'];
  $line = strtoupper($_POST['line_news']);
  $sts = $_POST['sts'];
  $sqlupdate = sqlsrv_query($con, "UPDATE db_dying.tbl_news_line SET
				news_line='$line',
				status='$sts',
				tgl_update=GETDATE()
				WHERE id='$id'");
  //echo " <script>window.location='?p=Line-News';</script>";
  echo "<script>swal({
  title: 'Data Tersimpan',
  text: 'Klik Ok untuk melanjutkan',
  type: 'success',
  }).then((result) => {
  if (result.value) {
    window.location='?p=Line-News';
  }
});</script>";
}
