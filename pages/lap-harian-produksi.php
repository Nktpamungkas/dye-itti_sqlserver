<?PHP
ini_set("error_reporting", 1);
session_start();
include "koneksi.php";

?>

<!DOCTYPE html
  PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Laporan Harian Produksi</title>

</head>

<body>
  <?php
  $Awal = isset($_POST['awal']) ? $_POST['awal'] : '';
  $Akhir = isset($_POST['akhir']) ? $_POST['akhir'] : '';
  $jamA = isset($_POST['jam_awal']) ? $_POST['jam_awal'] : '';
  $jamAr = isset($_POST['jam_akhir']) ? $_POST['jam_akhir'] : '';
  $GShift = isset($_POST['gshift']) ? $_POST['gshift'] : '';
  $Fs = isset($_POST['fasilitas']) ? $_POST['fasilitas'] : '';
  $Rcode = isset($_POST['rcode']) ? $_POST['rcode'] : '';
  $start_date = $Awal . ' ' . $jamA;
  $stop_date = $Akhir . ' ' . $jamAr;
  ?>
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title"> Filter Laporan Harian Produksi</h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      </div>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form method="post" enctype="multipart/form-data" name="form1" class="form-horizontal" id="form1">
      <div class="box-body">
        <div class="form-group">
          <div class="col-sm-3">
            <div class="input-group date">
              <div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>
              <input name="awal" type="text" class="form-control pull-right" id="datepicker" placeholder="Tanggal Awal"
                value="<?php echo $Awal; ?>" autocomplete="off" />
            </div>
          </div>
          <div class="col-sm-2">
            <div class="input-group">
              <input type="text" class="form-control timepicker" name="jam_awal" placeholder="00:00"
                value="<?php echo $jamA; ?>" autocomplete="off">

              <div class="input-group-addon">
                <i class="fa fa-clock-o"></i>
              </div>
            </div>
            <div>
            </div>
          </div>
          <!-- /.input group -->
        </div>

        <div class="form-group">
          <div class="col-sm-3">
            <div class="input-group date">
              <div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>
              <input name="akhir" type="text" class="form-control pull-right" id="datepicker1"
                placeholder="Tanggal Akhir" value="<?php echo $Akhir; ?>" autocomplete="off" />
            </div>
          </div>
          <div class="col-sm-2">
            <div class="input-group">
              <input type="text" class="form-control timepicker" name="jam_akhir" placeholder="00:00"
                value="<?php echo $jamAr; ?>" autocomplete="off">
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

          <div class="col-sm-2">
            <input type="text" class="form-control" name="rcode" value="<?= $Rcode; ?>" placeholder="Rcode">
          </div>
        </div>

      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <div class="col-sm-2">
          <button type="submit" class="btn btn-block btn-social btn-linkedin btn-sm" name="save"
            style="width: 60%">Search <i class="fa fa-search"></i></button>
        </div>
      </div>
      <!-- /.box-footer -->
    </form>
  </div>
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Data Produksi Celup</h3><br><br>
          <?php if ($_POST['awal'] != "") { ?><b>Periode: <?php echo $start_date . " to " . $stop_date; ?></b>
            <div class="btn-group pull-right">
              <a href="pages/cetak/reports-harian-produksi.php?&awal=<?php echo $start_date; ?>&akhir=<?php echo $stop_date; ?>&shft=<?php echo $GShift; ?>"
                class="btn btn-danger " target="_blank" data-toggle="tooltip" data-html="true" title="Harian Produksi"><i
                  class="fa fa-print"></i> </a>
              <a href="pages/cetak/reports-panjang-kain.php?&awal=<?php echo $start_date; ?>&akhir=<?php echo $stop_date; ?>&shft=<?php echo $GShift; ?>"
                class="btn btn-warning" target="_blank" data-toggle="tooltip" data-html="true"
                title="Harian Produksi Excel Panjang Kain"><i class="fa fa-file-excel-o"></i> </a>
              <a href="pages/cetak/reports-harian-produksi-excel-whiteness.php?&awal=<?php echo $start_date; ?>&akhir=<?php echo $stop_date; ?>&shft=<?php echo $GShift; ?>"
                class="btn btn-primary" target="_blank" data-toggle="tooltip" data-html="true"
                title="Harian Produksi Excel With Whiteness Yellowness Tint"><i class="fa fa-file-excel-o"></i> </a>
              <a href="pages/cetak/reports-harian-produksi-excel-ketResep.php?&awal=<?php echo $start_date; ?>&akhir=<?php echo $stop_date; ?>&shft=<?php echo $GShift; ?>"
                class="btn btn-info" target="_blank" data-toggle="tooltip" data-html="true"
                title="Harian Produksi Excel 2"><i class="fa fa-file-excel-o"></i> </a>
              <a href="pages/cetak/reports-harian-produksi-excel.php?&awal=<?php echo $start_date; ?>&akhir=<?php echo $stop_date; ?>&shft=<?php echo $GShift; ?>"
                class="btn btn-success " target="_blank" data-toggle="tooltip" data-html="true"
                title="Harian Produksi Excel"><i class="fa fa-file-excel-o"></i> </a>
              <a href="pages/cetak/reports-harian-produksi-opt-excel.php?&awal=<?php echo $start_date; ?>&akhir=<?php echo $stop_date; ?>&shft=<?php echo $GShift; ?>"
                class="btn btn-primary " target="_blank" data-toggle="tooltip" data-html="true"
                title="Harian Produksi Waktu Tunggu Excel"><i class="fa fa-file-excel-o"></i> </a>
              <a href="pages/cetak/rincian-cetak.php?&awal=<?php echo $start_date; ?>&akhir=<?php echo $stop_date; ?>&shft=<?php echo $GShift; ?>"
                class="btn btn-warning " target="_blank" data-toggle="tooltip" data-html="true"
                title="Rincian Produksi"><i class="fa fa-print"></i> </a>
              <a href="pages/cetak/rincian-excel.php?&awal=<?php echo $start_date; ?>&akhir=<?php echo $stop_date; ?>&shft=<?php echo $GShift; ?>"
                class="btn btn-info " target="_blank" data-toggle="tooltip" data-html="true"
                title="Rincian Produksi Excel"><i class="fa fa-file-excel-o"></i> </a>
              <a href="pages/cetak/schedule-excel.php?&awal=<?php echo $start_date; ?>&akhir=<?php echo $stop_date; ?>&shft=<?php echo $GShift; ?>"
                class="btn bg-maroon " target="_blank" data-toggle="tooltip" data-html="true"
                title="Schedule Produksi Excel"><i class="fa fa-file-excel-o"></i> </a>
            </div>
          <?php } elseif ($Rcode != "") { ?>
            <div class="btn-group pull-right">
              <a href="pages/cetak/reports-harian-produksi-excel-ketResep.php?&rcode=<?= $Rcode; ?>" class="btn btn-info"
                target="_blank" data-toggle="tooltip" data-html="true"
                title="Harian Produksi Excel With Keterangan Analisa Resep Rcode"><i class="fa fa-file-excel-o"></i> </a>
            </div>
          <?php } ?>
        </div>
        <div class="box-body">
          <table id="example1" class="table table-bordered table-hover" width="100%">
            <thead class="btn-danger">
              <tr>
                <th width="38">
                  <div align="center">Mesin</div>
                </th>
                <th width="38">Shift</th>
                <th width="224">
                  <div align="center">Buyer</div>
                </th>
                <th width="215">
                  <div align="center">Tgl Celup</div>
                </th>
                <th width="314">
                  <div align="center">Order<br>No Demand</div>
                </th>
                <th width="404">
                  <div align="center">Jenis Kain</div>
                </th>
                <th width="404">
                  <div align="center">Lot</div>
                </th>
                <th width="404">
                  <div align="center">Warna</div>
                </th>
                <th width="404">
                  <div align="center">QTY</div>
                </th>
                <th width="215">
                  <div align="center">Proses</div>
                </th>
                <th width="215">
                  <div align="center">Aktual Proses</div>
                </th>
                <th width="215">
                  <div align="center">Lama Proses</div>
                </th>
                <th width="215">
                  <div align="center">Std Target</div>
                </th>
                <th width="215">
                  <div align="center">Keterangan</div>
                </th>
                <th width="215">
                  <div align="center">Item</div>
                </th>
                <th width="215">
                  <div align="center">Rcode</div>
                </th>
                <th width="237">
                  <font size="-1">Status Resep</font>
                </th>
                <th width="237">
                  <font size="-1">Analisa Resep</font>
                </th>
              </tr>
            </thead>
            <tbody>
              <?php
              $c = 0;
              $no = 0;
              if ($Rcode) {
                $sql = sqlsrv_query($con, "SELECT x.*, a.no_mesin AS mc, a.no_mc_lama AS mc_lama
                              FROM db_dying.tbl_mesin a
                              RIGHT JOIN
                              (
                                  SELECT
                                     a.rcode,
                                                c.tgl_update,
                                                b.nokk,
                                                b.nodemand,
                                                b.buyer,
                                                b.langganan,
                                                b.no_order,
                                                b.jenis_kain,
                                                b.lot,
                                                b.no_mesin,
                                                b.warna,
                                                b.proses,
                                                b.target,
                                      ISNULL(a.g_shift, c.g_shift) AS shft,
                                      c.operator,
                                      CASE
                                        WHEN c.status = 'selesai' THEN
                                          CASE
                                            WHEN c.tgl_mulai IS NULL OR c.tgl_stop IS NULL THEN a.lama_proses
                                            ELSE 
                                              CONCAT(
                                                CAST(DATEDIFF(SECOND, c.tgl_stop, c.tgl_mulai) / 3600 AS VARCHAR(2)), ':',
                                                RIGHT('0' + CAST((DATEDIFF(SECOND, c.tgl_stop, c.tgl_mulai) % 3600) / 60 AS VARCHAR(2)), 2)
                                              )
                                          END
                                        ELSE
                                          STR(DATEDIFF(SECOND, GETDATE(), c.tgl_buat) / 3600) + ':' +
                                          RIGHT('0' + CAST((DATEDIFF(SECOND, GETDATE(), c.tgl_buat) % 3600) / 60 AS VARCHAR(2)), 2)
                                      END AS lama,
                                      b.status AS sts,
                                      a.status AS stscelup,
                                      a.proses AS proses_aktual,
                                      a.id AS idclp,
                                      a.analisa_resep,
                                      a.status_resep,
                                      b.no_hanger,
                                      b.qty_order,
                                      a.tambah_dyestuff
                                  FROM db_dying.tbl_schedule b
                                  LEFT JOIN db_dying.tbl_montemp c ON c.id_schedule = b.id
                                  LEFT JOIN db_dying.tbl_hasilcelup a ON a.id_montemp = c.id
                                  WHERE
                                      a.rcode LIKE '%$Rcode%'
                              ) x ON (a.no_mesin = x.no_mesin OR a.no_mc_lama = x.no_mesin)
                              WHERE 
                                  x.nokk IS NOT NULL
                              ORDER BY
                                  x.tgl_update DESC");
                if (!$sql) {
                  var_dump(sqlsrv_errors());
                  exit();
                }
              } else {
                if ($GShift == "ALL") {
                  $shft = null;
                } else {
                  $shft = " ISNULL(a.g_shift, c.g_shift) = '$GShift' AND ";
                }

                $Where = " CONVERT(datetime, c.tgl_update) BETWEEN CONVERT(datetime, '$start_date') AND CONVERT(datetime, '$stop_date') ";
                if ($Awal != "" and $Akhir != "") {
                  $Where1 = " AND x.nokk IS NOT NULL";
                } else {
                  $Where1 = " AND a.id='' AND  x.nokk IS NOT NULL ";
                }
                $sql = sqlsrv_query($con, "SELECT x.*, a.no_mesin AS mc, a.no_mc_lama AS mc_lama
                              FROM db_dying.tbl_mesin a
                              RIGHT JOIN
                              (
                                  SELECT
                                      a.rcode,
                                      b.nokk,
                                      b.nodemand,
                                      c.tgl_update,
                                      b.buyer,
                                      b.langganan,
                                      b.no_order,
                                      b.jenis_kain,
                                      b.lot,
                                      b.no_mesin,
                                      b.warna,
                                      b.proses,
                                      b.target,
                                      ISNULL(a.g_shift, c.g_shift) AS shft,
                                      c.operator,
                                      CASE
                                        WHEN c.status = 'selesai' THEN
                                          CASE
                                            WHEN c.tgl_mulai IS NULL OR c.tgl_stop IS NULL THEN a.lama_proses
                                            ELSE 
                                              CONCAT(
                                                CAST(DATEDIFF(MINUTE, c.tgl_stop, c.tgl_mulai) / 60 AS VARCHAR(2)), ':',
                                                RIGHT('0' + CAST((DATEDIFF(MINUTE, c.tgl_stop, c.tgl_mulai) % 60)  AS VARCHAR(2)), 2)
                                              )
                                          END
                                        ELSE
                                          STR(DATEDIFF(MINUTE, GETDATE(), c.tgl_buat) / 60) + ':' +
                                          RIGHT('0' + CAST((DATEDIFF(MINUTE, GETDATE(), c.tgl_buat) % 60)  AS VARCHAR(2)), 2)
                                      END AS lama,
                                      b.status AS sts,
                                      a.status AS stscelup,
                                      a.proses AS proses_aktual,
                                      a.id AS idclp,
                                      a.analisa_resep,
                                      a.status_resep,
                                      b.no_hanger,
                                      b.qty_order,
                                      a.tambah_dyestuff
                                  FROM db_dying.tbl_schedule b
                                  LEFT JOIN db_dying.tbl_montemp c ON c.id_schedule = b.id
                                  LEFT JOIN db_dying.tbl_hasilcelup a ON a.id_montemp = c.id
                                  WHERE
                                      $shft
                                      $Where
                              ) x ON (a.no_mesin = x.no_mesin OR a.no_mc_lama = x.no_mesin) 
                              $Where1 
                              ORDER BY x.tgl_update DESC");

                if (!$sql) {
                  var_dump(sqlsrv_errors());
                  exit();
                }
              }

              while ($rowd = sqlsrv_fetch_array($sql)) {
                if ($GShift == "ALL") {
                  $shftSM = null;
                } else {
                  $shftSM = " g_shift='$GShift' AND ";
                }
                $sqlSM = sqlsrv_query($con, "SELECT *, g_shift AS shiftSM,  FORMAT(CONVERT(time, DATEADD(second, DATEDIFF(second, mulai, selesai), 0)), 'HH:mm') AS lamaSM  FROM db_dying.tbl_stopmesin
                                WHERE $shftSM tgl_update BETWEEN '$start_date' AND '$stop_date' AND (no_mesin='$rowd[mc]' OR no_mesin='$rowd[mc_lama]') ORDER BY id DESC");
                $rowSM = sqlsrv_fetch_array($sqlSM);
                $no++;
                $bgcolor = ($no % 2 == 0) ? 'gainsboro' : 'antiquewhite'; // Alternate row colors
                $qCek = sqlsrv_query($con, "SELECT TOP 1 id AS idb FROM db_dying.tbl_potongcelup WHERE nokk='$rowd[nokk]'");
                $rCEk = sqlsrv_fetch_array($qCek);

                ?>

                <tr bgcolor="<?php echo $bgcolor; ?>" class="table table-bordered table-hover table-striped">
                  <td align="center"><?php echo $rowd['mc']; ?><br>
                    <div class="btn-group <?php if ($rCEk['idb'] == "") {
                      echo "hidden";
                    } ?>"><a href="pages/cetak/cetak_celup.php?id=<?php echo $rCEk['idb'] ?>"
                        class="btn btn-xs btn-warning" target="_blank"><i class="fa fa-print"></i> </a><a href="#"
                        id='<?php echo $rowd['idclp']; ?>' class="btn btn-xs btn-info edit_stscelup"><i
                          class="fa fa-edit"></i> </a></div>
                  </td>
                  <td align="center"><?php if ($rowd['no_order'] == "" and substr($rowd['proses'], 0, 10) != "Cuci Mesin") {
                    echo $rowSM['shiftSM'];
                  } else {
                    echo $rowd['shft'];
                  } ?></td>
                  <td align="center"><?php echo $rowd['buyer']; ?><br><?= $rowd['langganan']; ?></td>
                  <td>
                    <?= ($rowd['tgl_update'] != null or $rowd['tgl_update'] != '') ? $rowd['tgl_update']->format('Y-m-d H:i:s') : '' ?>
                  </td>
                  <td align="center"><?php echo $rowd['no_order']; ?><br><?= $rowd['nodemand'] ?></td>
                  <td><?php echo $rowd['jenis_kain']; ?></td>
                  <td align="center"><?php echo $rowd['lot']; ?></td>
                  <td><?php echo $rowd['warna']; ?></td>
                  <td><?php echo $rowd['qty_order']; ?></td>
                  <td align="left"><?php if ($rowd['no_order'] == "" and substr($rowd['proses'], 0, 10) != "Cuci Mesin") {
                    echo $rowSM['proses'];
                  } else {
                    echo $rowd['proses'];
                  } ?><br />
                    <i class="label bg-hijau"><?php if ($rowd['operator_keluar'] != "") {
                      echo $rowd['operator_keluar'];
                    } else {
                      echo $rowd['operator'];
                    } ?></i>
                  </td>
                  <td align="center"><?php echo $rowd['proses_aktual']; ?></td>
                  <td align="center"><?php if ($rowd['no_order'] == "" and substr($rowd['proses'], 0, 10) != "Cuci Mesin") {
                    echo $rowSM['lamaSM'];
                  } else {
                    echo $rowd['lama'];
                  } ?></td>
                  <td align="center"><?php echo $rowd['target']; ?></td>
                  <td><i class="label bg-abu"><?php if ($rowd['no_order'] == "" and substr($rowd['proses'], 0, 10) != "Cuci Mesin") {
                    echo $rowSM['no_stop'] . "<br>" . $rowSM['keterangan'];
                  } else {
                    echo $rowd['nokk'];
                  } ?></i><br />
                    <i class="label <?php if ($rowd['stscelup'] == "OK") {
                      echo "bg-green";
                    } else if ($rowd['stscelup'] == "Gagal Proses") {
                      echo "bg-red";
                    } ?>"> <?php echo $rowd['stscelup']; ?> </i><br /><?php echo $rowd['ket']; ?>
                  </td>
                  <td><?= $rowd['no_hanger'] ?></td>
                  <td><?= $rowd['rcode'] ?></td>
                  <td><?= $rowd['status_resep'] ?></td>
                  <td><?= $rowd['analisa_resep'] ?></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div id="EditStsCelup" class="modal fade modal-3d-slit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
  </div>
  <script>
    $(document).ready(function () {
      $('[data-toggle="tooltip"]').tooltip();
    });
  </script>
</body>

</html>