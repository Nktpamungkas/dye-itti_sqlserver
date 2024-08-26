<?php
session_start();
include_once "koneksi.php";
$_noprod    = sprintf("%08d", $_GET['noprod']);
$query_br1       = sqlsrv_query($conn2, "SELECT TOP 1
                                            TRIM(CAST(PRODUCTIONRESERVATION.PRODUCTIONORDERCODE AS VARCHAR)) AS PRODUCTIONORDERCODE,
                                            TRIM(CAST(PRODUCTIONRESERVATION.PRODUCTIONORDERCODE AS VARCHAR)) + '-' + TRIM(CAST(PRODUCTIONRESERVATION.GROUPLINE AS VARCHAR)) AS BONRESEP1,
                                            TRIM(CAST(SUFFIXCODE AS VARCHAR)) AS SUFFIXCODE
                                        FROM
                                            DB2ADMIN.PRODUCTIONRESERVATION  
                                        WHERE
                                            PRODUCTIONRESERVATION.ITEMTYPEAFICODE = 'RFF' 
                                            AND PRODUCTIONRESERVATION.PRODRESERVATIONLINKGROUPCODE = 'CBL1'
                                            AND PRODUCTIONRESERVATION.PRODUCTIONORDERCODE = $_noprod
                                        ORDER BY
                                            PRODUCTIONRESERVATION.GROUPLINE ASC");
$row_br1        = sqlsrv_fetch_array($query_br1);
if (!empty($row_br1['BONRESEP1'])) {
    $bonresep1      = $row_br1['BONRESEP1'];
} else {
    $bonresep1      = '';
}
if (!empty($row_br1['SUFFIXCODE'])) {
    $suffixcode     = $row_br1['SUFFIXCODE'];
} else {
    $suffixcode     = '';
}

$query_br2      = sqlsrv_query($conn2, "SELECT TOP 1
                                            TRIM(CAST(PRODUCTIONRESERVATION.PRODUCTIONORDERCODE AS VARCHAR)) AS PRODUCTIONORDERCODE,
                                            TRIM(CAST(PRODUCTIONRESERVATION.PRODUCTIONORDERCODE AS VARCHAR)) + '-' + TRIM(CAST(PRODUCTIONRESERVATION.GROUPLINE AS VARCHAR)) AS BONRESEP2
                                        FROM
                                            DB2ADMIN.PRODUCTIONRESERVATION  
                                        WHERE
                                            (PRODUCTIONRESERVATION.ITEMTYPEAFICODE = 'RFF' AND PRODUCTIONRESERVATION.PRODRESERVATIONLINKGROUPCODE  = 'CBL1')
                                            AND PRODUCTIONRESERVATION.PRODUCTIONORDERCODE = '$_noprod' 
                                        ORDER BY
                                            PRODUCTIONRESERVATION.GROUPLINE DESC");
$row_br2        = sqlsrv_fetch_array($query_br2);
if (!empty($row_br2['BONRESEP2'])) {
    $bonresep2      = $row_br2['BONRESEP2'];
} else {
    $bonresep2      = '';
}

//Menampung data yang dihasilkan
$json = array(
    'CB_BONRESEP1'             => $bonresep1,
    'CB_SUFFIX'                => $suffixcode,
    'CB_BONRESEP2'             => $bonresep2
);

header('Content-Type: application/json');
echo json_encode($json);
