<?PHP
// ini_set("error_reporting", 1);

$Awal   = isset($_POST['awal']) ? $_POST['awal'] : '';
$Akhir  = isset($_POST['akhir']) ? $_POST['akhir'] : '';
$jamA   = isset($_POST['jam_awal']) ? $_POST['jam_awal'] : '';
$jamAr  = isset($_POST['jam_akhir']) ? $_POST['jam_akhir'] : '';
$GShift = isset($_POST['gshift']) ? $_POST['gshift'] : '';

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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>laporan Harian Matching Dyeing</title>
</head>

<body>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"> Filter Laporan Harian Dyeing</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <form method="post" enctype="multipart/form-data" name="form1" class="form-horizontal">
                    <div class="box-body">
                        <div class="form-group">
                            <div class="col-sm-3">
                                <div class="input-group date">
                                    <div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>
                                    <input name="awal" type="text" class="form-control pull-right" id="datepicker" placeholder="Tanggal Awal" value="<?php echo $Awal; ?>" autocomplete="off" />
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="input-group">
                                    <input type="text" class="form-control timepicker" name="jam_awal" placeholder="00:00" value="<?php echo $jamA; ?>" autocomplete="off">

                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-3">
                                <div class="input-group date">
                                    <div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>
                                    <input name="akhir" type="text" class="form-control pull-right" id="datepicker1" placeholder="Tanggal Akhir" value="<?php echo $Akhir;  ?>" autocomplete="off" />
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="input-group">
                                    <input type="text" class="form-control timepicker" name="jam_akhir" placeholder="00:00" value="<?php echo $jamAr; ?>" autocomplete="off">
                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-3">
                                <select name="gshift" class="form-control pull-right">
                                    <option value="ALL">ALL</option>
                                    <option value="A" <?php if ($GShift == "A") {
                                                            echo "SELECTED";
                                                        } ?>>A</option>
                                    <option value="B" <?php if ($GShift == "B") {
                                                            echo "SELECTED";
                                                        } ?>>B</option>
                                    <option value="C" <?php if ($GShift == "C") {
                                                            echo "SELECTED";
                                                        } ?>>C</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="col-sm-2">
                            <button type="submit" class="btn btn-block btn-social btn-linkedin btn-sm" name="submit" style="width: 60%">Search <i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </form>
                <?php if (isset($_POST['submit'])) : ?>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Data Laporan Harian Dyeing</h3><br><br>
                                    <div class="pull-right">
                                        <!-- <a href="pages/cetak/reports-buka-resep-print.php?&awal=<?= $Awal; ?>&akhir=<?= $Akhir; ?>&jam_awal=<?= $jamA; ?>&jam_akhir=<?= $jamAr; ?>&gshift=<?= $GShift; ?>" class="btn btn-primary" target="_blank" data-toggle="tooltip" data-html="true" title="Form Laporan Harian Buka Bon Resep">
                                            <i class="fa fa-print"></i> print
                                        </a> -->
                                        <a href="pages/cetak/reports-matching-dyeing-excel.php?&awal=<?= $Awal; ?>&akhir=<?= $Akhir; ?>&jam_awal=<?= $jamA; ?>&jam_akhir=<?= $jamAr; ?>&gshift=<?= $GShift; ?>" class="btn btn-success" target="_blank" data-toggle="tooltip" data-html="true" title="Form Laporan Harian Buka Bon Resep">
                                            <i class="fa fa-file-excel-o"></i> Cetak
                                        </a>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <table id="example1" class="table table-bordered table-hover table-striped">
                                        <thead class="bg-blue">
                                            <tr>
                                                <th>
                                                    <div align="center">No.</div>
                                                </th>
                                                <th>
                                                    <div align="center">Tgl.</div>
                                                </th>
                                                <th>
                                                    <div align="center">No. Order</div>
                                                </th>
                                                <th>
                                                    <div align="center">No. Demand</div>
                                                </th>
                                                <th>
                                                    <div align="center">Proses</div>
                                                </th>
                                                <th>
                                                    <div align="center">Jam Terima</div>
                                                </th>
                                                <th>
                                                    <div align="center">Jenis Kain</div>
                                                </th>
                                                <th>
                                                    <div align="center">Warna</div>
                                                </th>
                                                <th>
                                                    <div align="center">ID Matching</div>
                                                </th>
                                                <th>
                                                    <div align="center">Pemberi Resep</div>
                                                </th>
                                                <th>
                                                    <div align="center">Acc Resep</div>
                                                </th>
                                                <th>
                                                    <div align="center">Percobaan Ke</div>
                                                </th>
                                                <th>
                                                    <div align="center">Operator Matcher</div>
                                                </th>
                                                <th>
                                                    <div align="center">Note</div>
                                                </th>
                                                <th>
                                                    <div align="center">Tanggal Dibuat</div>
                                                </th>
                                                <th>
                                                    <div align="center">Tahapan Ke</div>
                                                </th>
                                                <th>
                                                    <div align="center">Operator Matcher (Tahapan)</div>
                                                </th>
                                                <th>
                                                    <div align="center">Tanggal Tahapan</div>
                                                </th>
                                                <th>
                                                    <div align="center">Tanggal Acc</div>
                                                </th>
                                                <th>
                                                    <div align="center">Waktu Pengerjaan</div>
                                                </th>
                                                <th>
                                                    <div align="center">Std</div>
                                                </th>
                                            </tr>
                                        </thead>
                                        <?php
                                        $q_matching_dye = sqlsrv_query($con, "SELECT 
                                            mh.ok_ke,
                                            mh.operator_matcher,
                                            mh.note,
                                            mh.acc_creationdatetime,
                                            mh.creationdatetime,
                                            mh.acc_resep,
                                            mh.pemberi_resep,
                                            md.id,
                                            md.warna,
                                            md.createdatetime,
                                            md.no_order,
                                            md.nodemand,
                                            md.jenis_kain,
                                            md.jenis_prosses,
                                            md.jam_terima,
                                            md.std_waktu_prosses
                                        FROM 
                                            db_dying.tbl_matching_history mh
                                        JOIN 
                                            db_dying.tbl_matching_dyeing md ON mh.id_matching = md.id 
                                        WHERE 
                                            FORMAT(md.createdatetime, 'yyyy-MM-dd HH:mm:ss') BETWEEN '$start_date' AND '$stop_date' 
                                        ORDER BY 
                                            md.id DESC, mh.ok_ke ASC");

                                        // Mengelompokkan data berdasarkan id_matching
                                        $matching_data = [];
                                        while ($row = sqlsrv_fetch_array($q_matching_dye, SQLSRV_FETCH_ASSOC)) {
                                            $matching_data[$row['id']][] = $row;
                                        }

                                        // Fungsi untuk menghitung selisih waktu dalam jam
                                        function calculate_time_diff($start, $end)
                                        {
                                            $start_time = new DateTime($start);
                                            $end_time = new DateTime($end);
                                            $interval = $start_time->diff($end_time);
                                            return $interval->format('%h:%i:%s');
                                        }

                                        $no = 1;
                                        ?>

                                        <tbody>
                                            <?php foreach ($matching_data as $id_matching => $rows) {
                                                $count = count($rows);
                                                for ($i = 0; $i < $count; $i++) {
                                                    $row = $rows[$i];
                                                    if ($count > 1 && $i > 0) {
                                                        // Jika ada lebih dari satu record dengan id_matching yang sama
                                                        $prev_row = $rows[$i - 1];
                                                        $waktu_pengerjaan = calculate_time_diff(cek($prev_row['creationdatetime'], "Y-m-d H:i:s"), cek($row['creationdatetime'], "Y-m-d H:i:s"));
                                                    } else {
                                                        // Jika hanya ada satu record dengan id_matching yang sama
                                                        $waktu_pengerjaan = calculate_time_diff(cek($row['creationdatetime'], "Y-m-d H:i:s"), cek($row['jam_terima'], "Y-m-d H:i:s"));
                                                    }

                                                    $id_matching = $row['id'];
                                                    $ok_ke = $row['ok_ke'];

                                                    // Mengambil tahapan dan operator matcher dari tabel tbl__tahapan_matching_history
                                                    $q_tahapan_matching = sqlsrv_query($con, "SELECT TOP 1 tahapan, operator_matcher,created_at
                                                    FROM db_dying.tbl_tahapan_matching_history 
                                                    WHERE id_matching = $id_matching AND percobaan_ke = $ok_ke
                                                    ");

                                                    $matching_dye_row = sqlsrv_fetch_array($q_tahapan_matching, SQLSRV_FETCH_ASSOC);
                                            ?>
                                                    <tr bgcolor="antiquewhite">
                                                        <td align="center"><?= $no++; ?></td>
                                                        <td align="center"><?= cek($row['jam_terima'], "d") ?></td>
                                                        <td align="center"><?= $row['no_order'] ?></td>
                                                        <td align="center"><?= $row['nodemand'] ?></td>
                                                        <td align="center"><?= $row['jenis_prosses'] ?></td>
                                                        <td align="center"><?= cek($row['jam_terima'], "Y-m-d H:i:s") ?></td>
                                                        <td align="center"><?= $row['jenis_kain'] ?></td>
                                                        <td align="center"><?= $row['warna'] ?></td>
                                                        <td align="center"><?= $row['id'] ?></td>
                                                        <td align="center"><?= $row['pemberi_resep'] ?></td>
                                                        <td align="center"><?= $row['acc_resep'] ?></td>
                                                        <td align="center"><?= $row['ok_ke'] ?></td>
                                                        <td align="center"><?= $row['operator_matcher'] ?></td>
                                                        <td align="center"><?= $row['note'] ?></td>
                                                        <td align="center"><?= cek($row['creationdatetime'], "Y-m-d H:i:s") ?></td>
                                                        <td align="center"><?= $matching_dye_row['tahapan'] ?></td>
                                                        <td align="center"><?= $matching_dye_row['operator_matcher'] ?></td>
                                                        <td align="center"><?= cek($matching_dye_row['created_at'], "Y-m-d H:i:s") ?></td>
                                                        <td align="center"><?= cek($row['acc_creationdatetime'], "Y-m-d H:i:s") ?></td>
                                                        <td align="center"><?= $waktu_pengerjaan ?></td>
                                                        <td align="center"><?= $row['std_waktu_prosses'] ?></td>
                                                    </tr>
                                            <?php }
                                            } ?>
                                        </tbody>
                                        <tfoot class="bg-red">
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>

</html>