<?php
ini_set("error_reporting", 1); // Aktifkan pelaporan kesalahan
session_start();
include("../koneksi.php");

if ($_POST) {
    $pesan = $_POST['line_news'];

    // Ambil ID terakhir dan tambah 1
    //$sqlid = "SELECT ISNULL(MAX(id), 0) + 1 AS id FROM db_dying.tbl_news_line";
    $sqlid = "SELECT id FROM db_dying.tbl_news_line";
    $smtid = sqlsrv_query($con, $sqlid);
    $rowid = sqlsrv_fetch_array($smtid, SQLSRV_FETCH_ASSOC);
    //$newId = $rowid['id'];

    // Insert data baru
    $sqlupdate = "INSERT INTO db_dying.tbl_news_line (gedung, news_line, tgl_update) 
                  VALUES ('LT 1', ?, GETDATE())";
    
    $params = array($pesan);
    $stmt = sqlsrv_query($con, $sqlupdate, $params);

    if ($stmt) {
        echo "<script>window.location='?p=Line-News';</script>";
    } else {
        echo "Kesalahan saat menyimpan data.";
    }
}
?>
