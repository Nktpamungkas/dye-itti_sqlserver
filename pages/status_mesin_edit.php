<?php
ini_set("error_reporting", 1);
session_start();
include("../koneksi.php");
if (isset($_POST['ubah'])) {
    extract($_POST);
    //tangkap data array dari form
    $urut   = $_POST['no_urut'];
    $personil = $_POST['personil'];
    //foreach
    foreach ($urut as $urut_key => $urut_value) {
        $query = "UPDATE db_dying.tbl_schedule 
                    SET no_urut  =  '$urut_value',
                        personil =  '$personil'
                    WHERE id = '$urut_key'";
        $result = sqlsrv_query($con, $query);
    }

    if (!$result) {
        echo "<script> swal({
              title: 'Gagal Update',
              text: ' Klik Ok untuk Login kembali',
              type: 'error'
          }, function(){
              window.location='?p=Schedule';
          });</script>";
    } else {
        echo " <script>window.location='?p=Schedule';</script>";
    }
} elseif (isset($_POST['ubah_stdtarget'])) {
    extract($_POST);
    //tangkap data array dari form
    $urut               = $_POST['no_urut'];
    $personil           = $_POST['personil'];
    //foreach
    foreach ($urut as $urut_key => $urut_value) {
        $target = $_POST['target'][$urut_key];

        $query = "UPDATE db_dying.tbl_schedule
                    SET target  = '$target',
                        personil_stdtarget = '$personil',
                        lastupdatetime_stdtarget = GETDATE()
                    WHERE id = '$urut_key'";
        $result = sqlsrv_query($con, $query);
    }

    if (!$result) {
        echo "<script> swal({
              title: 'Gagal Update',
              text: ' Klik Ok untuk Login kembali',
              type: 'error'
          }, function(){
              window.location='?p=Schedule';
          });</script>";
    } else {
        echo " <script>window.location='?p=Schedule';</script>";
    }
}
