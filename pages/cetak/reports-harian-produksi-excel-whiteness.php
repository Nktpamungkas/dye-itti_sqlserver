<?php
header("content-type:application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=report-produksi-whiteness" . substr($_GET['awal'], 0, 10) . ".xls");
?>
<?php
ini_set("error_reporting", 1);
include "../../koneksi.php";
include "../../koneksiLAB.php";
include "../../tgl_indo.php";
include "../../utils/helper.php";
//--
$idkk = $_REQUEST['idkk'];
$act = $_GET['g'];
//-
$qTgl = sqlsrv_query($con, "SELECT 
    CONVERT(date, GETDATE()) AS tgl_skrg,
    CONVERT(date, DATEADD(DAY, 1, GETDATE())) AS tgl_besok");
$rTgl = sqlsrv_fetch_array($qTgl);
$Awal = $_GET['awal'];
$Akhir = $_GET['akhir'];
if ($Awal == $Akhir) {
  $TglPAl = substr($Awal, 0, 10);
  $TglPAr = substr($Akhir, 0, 10);
} else {
  $TglPAl = $Awal;
  $TglPAr = $Akhir;
}
?>

<body>
  <strong>Periode: <?php echo $TglPAl; ?> s/d <?php echo $TglPAr; ?></strong><br>
  <strong>Shift: <?php echo $shft; ?></strong><br />
  <table width="100%" border="1">
    <thead>
      <tr>
        <th bgcolor="#99FF99">NO.</th>
        <th bgcolor="#99FF99">PRODUCTION ORDER</th>
        <th bgcolor="#99FF99">PRODUCTION DEMAND</th>
        <!-- <th bgcolor="#99FF99">ORIGINAL PD CODE</th> -->
        <th bgcolor="#99FF99">NO ITEM</th>
        <th bgcolor="#99FF99">COLOR GROUP</th>
        <th bgcolor="#99FF99">FABRIC TYPE</th>
        <!-- <th bgcolor="#99FF99">LIGHT/DARK</th> -->
        <th bgcolor="#99FF99">JENIS KAIN</th>
        <th bgcolor="#99FF99">GRAMASI</th>
        <th bgcolor="#99FF99">QTY</th>
        <th bgcolor="#99FF99">NOMOR MESIN</th>
        <th bgcolor="#99FF99">KAPASITAS MESIN</th>
        <th bgcolor="#99FF99">WARNA</th>
        <th bgcolor="#99FF99">NO WARNA</th>
        <th bgcolor="#99FF99">WAKTU IN</th>
        <th bgcolor="#99FF99">PRD. RSV. LINK GROUP CODE</th>
        <th bgcolor="#99FF99">WHITENESS</th>
        <th bgcolor="#99FF99">TINT</th>
        <th bgcolor="#99FF99">YELLOWNESS</th>
        <th bgcolor="#99FF99">LR</th>
        <th bgcolor="#99FF99">SUFFIX</th>
        <th bgcolor="#99FF99">CONSAGENT</th>
        <th bgcolor="#99FF99">LONG DESCRIPTION</th>
        <th bgcolor="#99FF99">SHORT DESCRIPTION</th>
        <th bgcolor="#99FF99">SEARCH DESCRIPTION</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $Awal = $_GET['awal'];
      $Akhir = $_GET['akhir'];
      $GShift = $_GET['shft'];

      $Tgl = substr($Awal, 0, 10);
      if ($GShift == "ALL") {
        $shft = null;
      } else {
        $shft = "  ISNULL(a.g_shift, c.g_shift) = '$GShift' ";
      }

      $start_date = $_GET['awal'];
      $stop_date = $_GET['akhir'];

      $Where = " AND CONVERT(date, c.tgl_update) BETWEEN CONVERT(date,'$start_date') AND CONVERT(date,'$stop_date') ";
      if ($Awal != "" and $Akhir != "") {
        $Where1 = "WHERE x.nokk  IS NOT  NULL";
      } else {
        $Where1 = " WHERE a.id='' AND  x.nokk IS NOT NULL";
      }
      $sql = sqlsrv_query($con, "SELECT 
                                    x.*,
                                    a.no_mesin AS mc,
                                    a.no_mc_lama AS mc_lama
                                FROM 
                                    db_dying.tbl_mesin a
                                LEFT JOIN
                                    (SELECT
                                        a.kd_stop,
                                        a.mulai_stop,
                                        a.selesai_stop,
                                        a.ket,
                                        a.status AS sts,
                                    CASE 
                                    WHEN c.tgl_mulai IS NULL OR c.tgl_stop IS NULL THEN a.lama_proses
                                    ELSE 
                                      CASE 
                                        WHEN DATEDIFF(MINUTE, c.tgl_mulai, c.tgl_stop) < 0 THEN a.lama_proses 
                                        ELSE 
                                          CONCAT(
                                            RIGHT('00' + CAST(FLOOR((DATEDIFF(MINUTE, c.tgl_mulai, c.tgl_stop) / 60)) AS VARCHAR(2)), 2),
                                            ':',
                                            RIGHT('00' + CAST((DATEDIFF(MINUTE, c.tgl_mulai, c.tgl_stop) % 60) AS VARCHAR(2)), 2)
                                          )
                                        END END AS lama_proses,
                                    SUBSTRING(
                                    CASE 
                                    WHEN c.tgl_mulai IS NULL OR c.tgl_stop IS NULL THEN a.lama_proses
                                    ELSE 
                                      CASE 
                                        WHEN DATEDIFF(MINUTE, c.tgl_mulai, c.tgl_stop) < 0 THEN a.lama_proses 
                                        ELSE 
                                          CONCAT(
                                            RIGHT('00' + CAST(FLOOR((DATEDIFF(MINUTE, c.tgl_mulai, c.tgl_stop) / 60)) AS VARCHAR(2)), 2),
                                            ':',
                                            RIGHT('00' + CAST((DATEDIFF(MINUTE, c.tgl_mulai, c.tgl_stop) % 60) AS VARCHAR(2)), 2)
                                          )
                                        END END,1,2) AS jam,
                                      SUBSTRING(
                                    CASE 
                                    WHEN c.tgl_mulai IS NULL OR c.tgl_stop IS NULL THEN a.lama_proses
                                    ELSE 
                                      CASE 
                                        WHEN DATEDIFF(MINUTE, c.tgl_mulai, c.tgl_stop) < 0 THEN a.lama_proses 
                                        ELSE 
                                          CONCAT(
                                            RIGHT('00' + CAST(FLOOR((DATEDIFF(MINUTE, c.tgl_mulai, c.tgl_stop) / 60)) AS VARCHAR(2)), 2),
                                            ':',
                                            RIGHT('00' + CAST((DATEDIFF(MINUTE, c.tgl_mulai, c.tgl_stop) % 60) AS VARCHAR(2)), 2)
                                          )
                                        END END,4,5) AS menit,
                                        a.point,
                                        CONVERT(DATE, a.mulai_stop) AS t_mulai,
                                        CONVERT(DATE, a.selesai_stop) AS t_selesai,
                                        FORMAT(a.mulai_stop, 'HH:mm') AS j_mulai,
                                        FORMAT(a.selesai_stop, 'HH:mm') AS j_selesai,
                                        DATEDIFF(MINUTE, a.mulai_stop, a.selesai_stop) AS lama_stop_menit,
                                        a.acc_keluar,
                                        CASE
                                            WHEN a.proses = '' OR a.proses IS NULL THEN b.proses
                                            ELSE a.proses
                                        END AS proses,
                                        b.buyer,
                                        b.langganan,
                                        b.no_order,
                                        b.jenis_kain,
                                        b.no_mesin,
                                        b.warna,
                                        b.lot,
                                        b.energi,
                                        b.dyestuff,    
                                        b.ket_status,
                                        b.kapasitas,
                                        b.loading,
                                        b.resep,
                                        b.kategori_warna,
                                        b.target,
                                        c.l_r,
                                        c.rol,
                                        c.bruto,
                                        c.pakai_air,
                                        c.no_program,
                                        c.pjng_kain,
                                        c.cycle_time,
                                        c.rpm,
                                        c.tekanan,
                                        c.nozzle,
                                        c.plaiter,
                                        c.blower,
                                        CONVERT(date, c.tgl_buat) AS tgl_in,
                                        CONVERT(date, a.tgl_buat) AS tgl_out,
                                        FORMAT(c.tgl_buat, 'HH:mm') AS jam_in,
                                        FORMAT(a.tgl_buat, 'HH:mm') AS jam_out,
                                        ISNULL(a.g_shift, c.g_shift) AS shft,
                                        a.operator_keluar,
                                        a.k_resep,
                                        a.status,
                                        a.proses_point,
                                        a.analisa,
                                        b.nokk,
                                        b.no_warna,
                                        b.lebar,
                                        b.gramasi,
                                        c.carry_over,
                                        b.no_hanger,
                                        b.no_item,
                                        b.po,
                                        b.tgl_delivery,
                                        b.kk_kestabilan,
                                        b.kk_normal,
                                        c.air_awal,
                                        a.air_akhir,
                                        c.nokk_legacy,
                                        c.loterp,
                                        c.nodemand,
                                        a.tambah_obat,
                                        a.tambah_obat1,
                                        a.tambah_obat2,
                                        a.tambah_obat3,
                                        a.tambah_obat4,
                                        a.tambah_obat5,
                                        a.tambah_obat6,
                                        c.leader,
                                        b.suffix,
                                        b.suffix2,
                                        c.l_r_2,
                                        c.lebar_fin,
                                        c.grm_fin,
                                        c.lebar_a,
                                        c.gramasi_a,
                                        c.operator,
                                        a.tambah_dyestuff,
                                        a.arah_warna,
                                        a.status_warna,
                                        c.tgl_update
                                    FROM
                                        db_dying.tbl_schedule b
                                    LEFT JOIN db_dying.tbl_montemp c ON c.id_schedule = b.id
                                    LEFT JOIN db_dying.tbl_hasilcelup a ON a.id_montemp = c.id
                                    $shft
                                    $Where
                                ) x ON (a.no_mesin = x.no_mesin OR a.no_mc_lama = x.no_mesin)
                                        $Where1 
                                ORDER BY 
                                    x.tgl_update DESC");

      $no = 1;
      while ($rowd = sqlsrv_fetch_array($sql)) {
        $sql_ITXVIEWKK = db2_exec($conn2, "SELECT * FROM ITXVIEWKK WHERE PRODUCTIONORDERCODE = '$rowd[nokk]' LIMIT 1");
        $dt_ITXVIEWKK = db2_fetch_assoc($sql_ITXVIEWKK);

        $q_uploadspectro = sqlsrv_query($con_nowprd, "SELECT * FROM nowprd.upload_spectro WHERE SUBSTRING(batch_name, 1,8) = '$rowd[nokk]'");
        $data_uploadspectro = sqlsrv_fetch_array($q_uploadspectro, SQLSRV_FETCH_ASSOC);

        if (!empty($data_uploadspectro)) {
          $q_rsv_link_group = db2_exec($conn2, "SELECT
                                                      q2.LINE,
                                                      q.PRODUCTIONORDERCODE,
                                                      LISTAGG('''' || a.valueint || '''', ',') AS STEPNUMBER,
                                                      LISTAGG(TRIM(q.OPERATIONCODE), ', ') AS OPERATIONCODE
                                                    FROM
                                                      QUALITYDOCUMENT q
                                                    LEFT JOIN ADSTORAGE a ON a.UNIQUEID = q.ABSUNIQUEID AND a.FIELDNAME = 'GroupStepNumber'
                                                    LEFT JOIN QUALITYDOCLINE q2 ON q2.QUALITYDOCUMENTHEADERLINE = q.HEADERLINE
                                                                  AND (TRIM(q2.CHARACTERISTICCODE) = 'WHITENESS'
                                                                    OR TRIM(q2.CHARACTERISTICCODE) = 'YELLOWNESS'
                                                                    OR TRIM(q2.CHARACTERISTICCODE) = 'TINT')
                                                                  AND NOT q2.VALUEQUANTITY = 0
                                                    WHERE
                                                      q.PRODUCTIONORDERCODE = '$rowd[nokk]'
                                                      AND q2.LINE = 11
                                                    GROUP BY
                                                      q2.LINE,
                                                      q.PRODUCTIONORDERCODE");
          $row_rsv_link_group = db2_fetch_assoc($q_rsv_link_group);

          $q_whiteness = db2_exec($conn2, "SELECT
                                                      q2.LINE,
                                                      q.PRODUCTIONORDERCODE,
                                                      LISTAGG(TRIM(q.OPERATIONCODE) || ' = ' || DECIMAL(q2.VALUEQUANTITY, 5,2), ', ') AS WHITENESS,
                                                      q2.CHARACTERISTICCODE	
                                                  FROM
                                                      QUALITYDOCUMENT q  
                                                  LEFT JOIN ADSTORAGE a ON a.UNIQUEID = q.ABSUNIQUEID AND a.FIELDNAME = 'GroupStepNumber'
                                                  LEFT JOIN QUALITYDOCLINE q2 ON q2.QUALITYDOCUMENTHEADERLINE = q.HEADERLINE 
                                                                AND (TRIM(q2.CHARACTERISTICCODE) = 'WHITENESS'
                                                                  OR TRIM(q2.CHARACTERISTICCODE) = 'YELLOWNESS'
                                                                  OR TRIM(q2.CHARACTERISTICCODE) = 'TINT')
                                                                AND NOT q2.VALUEQUANTITY = 0						
                                                  WHERE
                                                      q.PRODUCTIONORDERCODE = '$rowd[nokk]'
                                                      AND q2.LINE = 11
                                                      AND TRIM(q2.CHARACTERISTICCODE) = 'WHITENESS'
                                                  GROUP BY
                                                      q2.LINE,
                                                      q.PRODUCTIONORDERCODE,
                                                      q2.CHARACTERISTICCODE");
          $row_whiteness = db2_fetch_assoc($q_whiteness);

          $q_tint = db2_exec($conn2, "SELECT
                                              q2.LINE,
                                              q.PRODUCTIONORDERCODE,
                                              LISTAGG(TRIM(q.OPERATIONCODE) || ' = ' || DECIMAL(q2.VALUEQUANTITY, 5,2), ', ') AS TINT,
                                              q2.CHARACTERISTICCODE	
                                          FROM
                                              QUALITYDOCUMENT q  
                                          LEFT JOIN ADSTORAGE a ON a.UNIQUEID = q.ABSUNIQUEID AND a.FIELDNAME = 'GroupStepNumber'
                                          LEFT JOIN QUALITYDOCLINE q2 ON q2.QUALITYDOCUMENTHEADERLINE = q.HEADERLINE 
                                                        AND (TRIM(q2.CHARACTERISTICCODE) = 'WHITENESS'
                                                          OR TRIM(q2.CHARACTERISTICCODE) = 'YELLOWNESS'
                                                          OR TRIM(q2.CHARACTERISTICCODE) = 'TINT')
                                                        AND NOT q2.VALUEQUANTITY = 0						
                                          WHERE
                                              q.PRODUCTIONORDERCODE = '$rowd[nokk]'
                                              AND q2.LINE = 13
                                              AND TRIM(q2.CHARACTERISTICCODE) = 'TINT'
                                          GROUP BY
                                              q2.LINE,
                                              q.PRODUCTIONORDERCODE,
                                              q2.CHARACTERISTICCODE");
          $row_tint = db2_fetch_assoc($q_tint);

          $q_yellowness = db2_exec($conn2, "SELECT
                                                    q2.LINE,
                                                    q.PRODUCTIONORDERCODE,
                                                    LISTAGG(TRIM(q.OPERATIONCODE) || ' = ' || DECIMAL(q2.VALUEQUANTITY, 5,2), ', ') AS YELLOWNESS,
                                                    q2.CHARACTERISTICCODE	
                                                FROM
                                                    QUALITYDOCUMENT q  
                                                LEFT JOIN ADSTORAGE a ON a.UNIQUEID = q.ABSUNIQUEID AND a.FIELDNAME = 'GroupStepNumber'
                                                LEFT JOIN QUALITYDOCLINE q2 ON q2.QUALITYDOCUMENTHEADERLINE = q.HEADERLINE 
                                                              AND (TRIM(q2.CHARACTERISTICCODE) = 'WHITENESS'
                                                                OR TRIM(q2.CHARACTERISTICCODE) = 'YELLOWNESS'
                                                                OR TRIM(q2.CHARACTERISTICCODE) = 'TINT')
                                                              AND NOT q2.VALUEQUANTITY = 0						
                                                WHERE
                                                    q.PRODUCTIONORDERCODE = '$rowd[nokk]'
                                                    AND q2.LINE = 12
                                                    AND TRIM(q2.CHARACTERISTICCODE) = 'YELLOWNESS'
                                                GROUP BY
                                                    q2.LINE,
                                                    q.PRODUCTIONORDERCODE,
                                                    q2.CHARACTERISTICCODE");
          $row_yellowness = db2_fetch_assoc($q_yellowness);

          if ($row_rsv_link_group['STEPNUMBER']) {
            $q_lr = db2_exec($conn2, "SELECT 
                                            LISTAGG(TRIM(SUBCODE01)) AS RCODE,
                                            LISTAGG(TRIM(SUFFIXCODE)) AS RCODESUFFIX,
                                            LISTAGG(TRIM(PRODRESERVATIONLINKGROUPCODE) || ' = ' || DECIMAL(LR, 5,2), ', ') AS LR,
                                            LISTAGG(TRIM(PRODRESERVATIONLINKGROUPCODE) || ' = ' || TRIM(SUBCODE01) || '-' || TRIM(SUFFIXCODE), ', ') AS SUFFIX,
                                            LISTAGG(TRIM(PRODRESERVATIONLINKGROUPCODE) || ' = ' || TRIM(LONGDESCRIPTION), ', ') AS LONGDESCRIPTION,
                                            LISTAGG(TRIM(PRODRESERVATIONLINKGROUPCODE) || ' = ' || TRIM(SHORTDESCRIPTION), ', ') AS SHORTDESCRIPTION,
                                            LISTAGG(TRIM(PRODRESERVATIONLINKGROUPCODE) || ' = ' || TRIM(SEARCHDESCRIPTION), ', ') AS SEARCHDESCRIPTION
                                          FROM (
                                            SELECT 
                                              DISTINCT 
                                              p.PRODRESERVATIONLINKGROUPCODE,
                                              p.PICKUPQUANTITY AS LR,
                                              p.SUBCODE01,
                                              p.SUFFIXCODE,
                                              r.LONGDESCRIPTION,
                                              r.SHORTDESCRIPTION,
                                              r.SEARCHDESCRIPTION
                                            FROM 
                                              PRODUCTIONRESERVATION p 
                                            LEFT JOIN RECIPE r ON r.SUBCODE01 = p.SUBCODE01 AND r.SUFFIXCODE = p.SUFFIXCODE 
                                            LEFT JOIN VIEWPRODUCTIONDEMANDSTEP v ON v.PRODUCTIONORDERCODE = p.PRODUCTIONORDERCODE AND v.GROUPSTEPNUMBER = p.GROUPSTEPNUMBER
                                            WHERE	
                                              p.PRODUCTIONORDERCODE = '$rowd[nokk]'  
                                              AND 
                                              CASE 
                                                WHEN v.STEPTYPE = 3 THEN p.GROUPSTEPNUMBER IN ($row_rsv_link_group[STEPNUMBER])
                                                ELSE p.STEPNUMBER IN ($row_rsv_link_group[STEPNUMBER])
                                              END 
                                              AND p.ITEMNATURE = 9
                                              AND SUBSTR(p.SUBCODE01, 1,2) = 'SC' 
                                            GROUP BY
                                              p.PRODRESERVATIONLINKGROUPCODE,
                                              p.PICKUPQUANTITY,
                                              p.SUBCODE01,
                                              p.SUFFIXCODE,
                                              r.LONGDESCRIPTION,
                                              r.SHORTDESCRIPTION,
                                              r.SEARCHDESCRIPTION)");
            $row_lr = db2_fetch_assoc($q_lr);

            $q_detail_scouring = db2_exec($conn2, "SELECT
                                                        LISTAGG(i.LONGDESCRIPTION || '(' || CAST(i.CONSUMPTION AS DECIMAL(10,2)) || ')', ', ') AS DESKRIPSI,
                                                        LISTAGG(i.COMMENTLINE) AS DESKRIPSI2
                                                    FROM
                                                      ITXVIEWRESEP i
                                                    WHERE
                                                      PRODUCTIONORDERCODE = '$rowd[nokk]'
                                                      AND SUBCODE01_RESERVATION = '$row_lr[RCODE]'
                                                      AND SUFFIXCODE_RESERVATION = '$row_lr[RCODESUFFIX]'
                                                      AND COMPANYCODE = '100'");
            $row_detail_scouring = db2_fetch_assoc($q_detail_scouring);
          }

          $prd_rsv_link_group = $row_rsv_link_group['OPERATIONCODE'];
          $whiteness = $row_whiteness['WHITENESS'];
          $tint = $row_tint['TINT'];
          $yellowness = $row_yellowness['YELLOWNESS'];
          $LR = $row_lr['LR'];
          $SUFFIX = $row_lr['SUFFIX'];
          $LONGDESCRIPTION = $row_lr['LONGDESCRIPTION'];
          $SHORTDESCRIPTION = $row_lr['SHORTDESCRIPTION'];
          $SEARCHDESCRIPTION = $row_lr['SEARCHDESCRIPTION'];
          $detail_scouring = $row_detail_scouring['DESKRIPSI'] . ',' . $row_detail_scouring['DESKRIPSI2'];
        } else {
          $prd_rsv_link_group = '';
          $whiteness = '';
          $tint = '';
          $yellowness = '';
          $LR = '';
          $SUFFIX = '';
          $LONGDESCRIPTION = '';
          $SHORTDESCRIPTION = '';
          $SEARCHDESCRIPTION = '';
          $detail_scouring = '';
        }
        ?>
        <tr valign="top">
          <td><?= $no++; ?></td>
          <td>'<?= $rowd['nokk']; ?></td>
          <td>'<?= $rowd['nodemand']; ?></td>
          <!-- <td><?= $d_orig_pd_code['ORIGINALPDCODE']; ?></td> -->
          <td><?= $rowd['no_hanger']; ?></td>
          <td><?= $dt_ITXVIEWKK['COLORGROUP']; ?></td>
          <td><?= $dt_ITXVIEWKK['SUBCODE01']; ?></td>
          <!-- <td>
            <?php
            // $q_variant    = db2_exec($conn2, "SELECT TRIM(SUBCODE04) AS SUBCODE04 FROM PRODUCTIONRESERVATION WHERE PRODUCTIONORDERCODE = '$row_whiteness[PRODUCTIONORDERCODE]' AND (ITEMTYPEAFICODE = 'KGF' OR ITEMTYPEAFICODE = 'FKG')");
            // $row_variant  = db2_fetch_assoc($q_variant);
            // echo $row_variant['SUBCODE04'];
            ?>
          </td> -->
          <td><?= $rowd['jenis_kain']; ?></td>
          <td><?= $rowd['gramasi']; ?></td>
          <td><?= $rowd['bruto']; ?></td>
          <td><?= $rowd['mc']; ?></td>
          <td><?= $rowd['kapasitas']; ?></td>
          <td><?= $rowd['warna']; ?></td>
          <td><?= $rowd['no_warna']; ?></td>
          <td><?= cek($rowd['tgl_in']) . ' ' . cek($rowd['jam_in']); ?></td>
          <td><?= $prd_rsv_link_group ?></td>
          <td><?= $whiteness; ?></td>
          <td><?= $tint; ?></td>
          <td><?= $yellowness; ?></td>
          <td><?= $LR; ?></td>
          <td><?= $SUFFIX; ?></td>
          <td><?= $detail_scouring; ?></td>
          <td><?= $LONGDESCRIPTION ?></td>
          <td><?= $SHORTDESCRIPTION ?></td>
          <td><?= $SEARCHDESCRIPTION ?></td>
        </tr>
      </tbody>
    <?php } ?>
  </table>
</body>