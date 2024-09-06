<?php
    header("Content-type: application/octet-stream");
    header("Content-Disposition: attachment; filename= Report Matching Dyeing.xls"); //ganti nama sesuai keperluan
    header("Pragma: no-cache");
    header("Expires: 0");
    //disini script laporan anda
?>
<?PHP
	session_start();
    include "../../koneksi.php";
    include "../../utils/helper.php";

    $Awal   = isset($_GET['awal']) ? $_GET['awal'] : '';
    $Akhir  = isset($_GET['akhir']) ? $_GET['akhir'] : '';
    $jamA   = isset($_GET['jam_awal']) ? $_GET['jam_awal'] : '';
    $jamAr  = isset($_GET['jam_akhir']) ? $_GET['jam_akhir'] : '';
    $GShift = isset($_GET['gshift']) ? $_GET['gshift'] : '';
    
    // Format start_date based on the length of $jamA
    if (strlen($jamA) == 5) {
        $start_date = $Awal . ' ' . $jamA;
    } elseif (strlen($jamA) == 4) {
        $start_date = $Awal . ' 0' . $jamA;
    } else {
        $start_date = $Awal . ' 00:00';
    }

    // Format stop_date based on the length of $jamAr
    if (strlen($jamAr) == 5) {
        $stop_date = $Akhir . ' ' . $jamAr;
    } elseif (strlen($jamAr) == 4) {
        $stop_date = $Akhir . ' 0' . $jamAr;
    } else {
        $stop_date = $Akhir . ' 23:59';
    }

    // Determine the WHERE clause for shift filtering
    if ($GShift == 'ALL') {
        $where_gshift = "";
    } else {
        $where_gshift = "AND gshift = '$GShift'";
    }
?>
<table border="1" style="width:100%">
    <thead>
        <tr>
            <th>No.</th>
            <th>No. Kartu Kerja</th>
            <th>No. Demand</th>
            <th>Pelanggan</th>
            <th>Buyer</th>
            <th>No. Order</th>
            <th>Jenis Kain</th>
            <th>Warna</th>
            <th>Jam Terima</th>
            <th>Operator Penerima</th>
            <th>Jam Proses</th>
            <th>Operator Matcher</th>
            <th>Pemberi Resep</th>
            <th>Acc Resep</th>
            <th>Oke Ke</th>
            <th>Operator Matcher</th>
            <th>Note</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $q_matching_dye    = sqlsrv_query($con, "SELECT * FROM db_dying.tbl_matching_dyeing WHERE FORMAT(createdatetime, 'yyyy-MM-dd HH:mm:ss') BETWEEN '$start_date' AND '$stop_date' $where_gshift ORDER BY id DESC");
            $no = 1;
        ?>
        <?php while ($row_matching_dye = sqlsrv_fetch_array($q_matching_dye, SQLSRV_FETCH_ASSOC)) { ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $row_matching_dye['nokk'] ?></td>
                <td><?= $row_matching_dye['nodemand'] ?></td>
                <td><?= $row_matching_dye['langganan'] ?></td>
                <td><?= $row_matching_dye['buyer'] ?></td>
                <td><?= $row_matching_dye['no_order'] ?></td>
                <td><?= $row_matching_dye['jenis_kain'] ?></td>
                <td><?= $row_matching_dye['warna'] ?></td>
                <td><?= cek($row_matching_dye['jam_terima'], "Y/m/d H:i:s") ?></td>
                <td><?= $row_matching_dye['operator_penerima'] ?></td>
                <td><?= cek($row_matching_dye['createdatetime_proses'], "Y/m/d H:i:s") ?></td>
                <td><?= $row_matching_dye['operator_matcher'] ?></td>
                <td><?= $row_matching_dye['pemberi_resep'] ?></td>
                <td><?= $row_matching_dye['acc_resep'] ?></td>
                <td><?= $row_matching_dye['ok_ke'] ?></td>
                <td><?= $row_matching_dye['operator_matcher'] ?></td>
                <td><?= $row_matching_dye['note'] ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
                                