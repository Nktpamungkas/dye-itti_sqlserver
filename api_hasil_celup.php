<?php
include_once "koneksi.php";
$_noprod    = $_GET['noprod'];
$sql_schedule = "SELECT
                            *
                        FROM 
                            db_dying.tbl_schedule 
                        WHERE 
                            nokk = '$_noprod'";
$query_schedule  = sqlsrv_query($con, $sql_schedule);
$dt_schedule     = sqlsrv_fetch_array($query_schedule);

$sqlTopping = sqlsrv_query($con, "SELECT TOP 1 jml_topping FROM db_dying.tbl_hasilcelup WHERE nokk='$_noprod' ORDER BY id DESC");
$rTopping = sqlsrv_fetch_array($sqlTopping);

//Menampung data yang dihasilkan
$json = array(
    'ID'                    => $dt_schedule['id'],
    'PRODUCTIONORDERCODE'   => $dt_schedule['nokk'],
    'DEAMAND'               => $dt_schedule['nodemand'],
    'LANGGANAN'             => $dt_schedule['langganan'],
    'BUYER'                 => $dt_schedule['buyer'],
    'ORDER'                 => $dt_schedule['no_order'],
    'PO'                    => $dt_schedule['po'],
    'HANGER'                => $dt_schedule['no_hanger'],
    'ITEM'                  => $dt_schedule['no_item'],
    'JENIS_KAIN'            => $dt_schedule['jenis_kain'],
    'TGL_DELIVERY'          => $dt_schedule['tgl_delivery'],
    'LEBAR_PERMINTAAN'      => $dt_schedule['lebar'],
    'GRAMASI_PERMINTAAN'    => $dt_schedule['gramasi'],
    'WARNA'                 => $dt_schedule['warna'],
    'NO_WARNA'              => $dt_schedule['no_warna'],
    'QTY_ORDER'             => $dt_schedule['qty_order'],
    'PANJANG_ORDER'         => $dt_schedule['pjng_order'],
    'SATUAN_ORDER'          => $dt_schedule['satuan_order'],
    'LOT'                   => $dt_schedule['lot'],
    'LOT_LEGACY'            => $dt_schedule['lotlgcy'],
    'ROL'                   => $dt_schedule['rol'],
    'BRUTO'                 => $dt_schedule['bruto'],
    'KAPASITAS'             => $dt_schedule['kapasitas'],
    'NO_MESIN'              => $dt_schedule['no_mesin'],
    'JML_TOPING'            => $rTopping['jml_topping'],
    'DYESTUFF'              => $dt_schedule['dyestuff'],

    'LOADING'               => $dt_schedule['loading'],
    'NO_RESEP'              => $dt_schedule['no_resep'],
    'SUFFIX'                => $dt_schedule['suffix'],
    'NO_RESEP2'             => $dt_schedule['no_resep2'],
    'WKT'                   => '',
    'OPER_SHIFT'            => '',
    'WT_DES'                => '',
    'PEMAKAIAN_AIR'         => '',
);

//Merubah data kedalam bentuk JSON
header('Content-Type: application/json');
echo json_encode($json);
