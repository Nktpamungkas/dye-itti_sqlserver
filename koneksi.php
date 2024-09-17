<?php
date_default_timezone_set('Asia/Jakarta');

$hostSVR19 = "10.0.0.221";
$usernameSVR19 = "sa";
$passwordSVR19 = "Ind@taichen2024";
$dying = "db_dying";
$qc = "db_qc";
$nowprd = "nowprd";
$lab = "db_laborat";

$db_dying = array("Database" => $dying, "UID" => $usernameSVR19, "PWD" => $passwordSVR19);
$db_qc = array("Database" => $qc, "UID" => $usernameSVR19, "PWD" => $passwordSVR19);
$nowprd = array("Database" => $nowprd, "UID" => $usernameSVR19, "PWD" => $passwordSVR19);
$dbLab = array("Database" => $lab, "UID" => $usernameSVR19, "PWD" => $passwordSVR19);

$con     = sqlsrv_connect($hostSVR19, $db_dying);
$cond     = sqlsrv_connect($hostSVR19, $db_qc);
// $con_nowprd = sqlsrv_connect($hostSVR19, $nowprd);
$conLab = sqlsrv_connect($hostSVR19, $dbLab);

if ($con) {
} else {
    exit("SQLSVR19 Connection failed to con");
}
if ($cond) {
} else {
    exit("SQLSVR19 Connection failed to cond");
}
// if ($con_nowprd) {
// } else {
//     exit("SQLSVR19 Connection failed to con_nowprd");
// }
if ($conLab) {
} else {
    exit("SQLSVR19 Connection failed to conLab");
}

$hostname = "10.0.0.21";
$database = "NOWPRD";
$user = "db2admin";
$passworddb2 = "Sunkam@24809";
$port = "25000";
$conn_string = "DRIVER={IBM ODBC DB2 DRIVER}; HOSTNAME=$hostname; PORT=$port; PROTOCOL=TCPIP; UID=$user; PWD=$passworddb2; DATABASE=$database;";
$conn2 = db2_connect($conn_string, '', '');
if ($conn2) {
} else {
    exit("DB2 Connection failed");
}
