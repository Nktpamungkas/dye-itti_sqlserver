<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=report-schedule-produksi-" . substr($_GET['awal'], 0, 10) . ".xls"); //ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");
//disini script laporan anda
?>
<?php
ini_set("error_reporting", 1);
include "../../koneksi.php";
include "../../tgl_indo.php";
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
$shft = $_GET['shft'];
function cekDesimal($angka)
{
  $bulat = round($angka);
  if ($bulat > $angka) {
    $jam = $bulat - 1;
    $waktu = $jam . " Jam 30 Menit";
  } else {
    $jam = $bulat;
    $waktu = $jam . " Jam 00 Menit";
  }
  return $waktu;
}
?>

<body>

  <strong>Periode: <?php echo $TglPAl; ?> s/d <?php echo $TglPAr; ?></strong><br>
  <strong>Shift: <?php echo $shft; ?></strong><br />
  <table width="100%" border="1">
    <tr>
      <th bgcolor="#99FF99">NO.</th>
      <th bgcolor="#99FF99">NO MC</th>
      <th bgcolor="#99FF99">SHIFT</th>
      <th bgcolor="#99FF99">NOKK</th>
      <th bgcolor="#99FF99">KAPASITAS</th>
      <th bgcolor="#99FF99">LANGGANAN</th>
      <th bgcolor="#99FF99">BUYER</th>
      <th bgcolor="#99FF99">NO PO</th>
      <th bgcolor="#99FF99">NO ORDER</th>
      <th bgcolor="#99FF99">JENIS KAIN</th>
      <th bgcolor="#99FF99">WARNA</th>
      <th bgcolor="#99FF99">NO WARNA</th>
      <th bgcolor="#99FF99">LOT</th>
      <th bgcolor="#99FF99">ROLL</th>
      <th bgcolor="#99FF99">QUANTITY</th>
      <th bgcolor="#99FF99">LOADING</th>
      <th bgcolor="#99FF99">PROSES</th>
      <th bgcolor="#99FF99">TARGET PROSES</th>
      <th bgcolor="#99FF99">LAMA PROSES</th>
      <th bgcolor="#99FF99">LAMA STOP</th>
      <th bgcolor="#99FF99">OVER TIME</th>
      <th bgcolor="#99FF99">K.R</th>
      <th bgcolor="#99FF99">R.B/R.L</th>
    </tr>
    <?php
    $Awal = $_GET['awal'];
    $Akhir = $_GET['akhir'];
    $Tgl = substr($Awal, 0, 10);
    if ($Awal != $Akhir) {
      $Where = " CONVERT(date, c.tgl_update) BETWEEN '$Awal' AND '$Akhir' ";
    } else {
      $Where = " CONVERT(date , c.tgl_update) = '$Tgl' ";
    }
    if ($_GET['shft'] == "ALL") {
      $shftq = null;
    } else {
      $shftq = " ISNULL(a.g_shift, b.g_shift) = '$_GET[shft]' AND ";
    }
    $sql = sqlsrv_query($con, "SELECT x.*,a.no_mesin as mc FROM db_dying.tbl_mesin a
                                          LEFT JOIN
                                          (SELECT
                                          a.kd_stop,
                                          a.mulai_stop,
                                          a.selesai_stop,
                                          a.status AS sts_hasil,	
                                          a.ket,	
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
                                          a.analisa,
                                          a.k_resep,
                                          b.proses,
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
                                          c.l_r,
                                          c.rol,
                                          c.bruto,
                                          c.pakai_air,
                                        	CONVERT(date, c.tgl_buat) AS tgl_in,
                                          CONVERT(date, a.tgl_buat) AS tgl_out,
                                          FORMAT(c.tgl_buat, 'HH:mm') AS jam_in,
                                          FORMAT(a.tgl_buat, 'HH:mm') AS jam_out,
                                          ISNULL(a.g_shift, c.g_shift) AS shft,
                                          a.operator_keluar,
                                          b.nokk,
                                          b.no_warna,
                                          b.lebar,
                                          b.gramasi,
                                          c.carry_over,
                                          b.no_hanger,
                                          b.no_item,
                                          b.po,
                                          b.tgl_delivery,
                                          b.target,
                                          CASE
                                            WHEN 
                                              a.lama_proses > CONVERT(varchar, b.target) 
                                            THEN 'lebih'
                                            ELSE 'kurang'
                                        END AS jjm
                                        FROM
                                          db_dying.tbl_schedule b
                                          LEFT JOIN  db_dying.tbl_montemp c ON c.id_schedule = b.id
                                          LEFT JOIN  db_dying.tbl_hasilcelup a ON a.id_montemp=c.id	
                                        WHERE
                                          $shftq 
                                          $Where)x ON (a.no_mesin = x.no_mesin OR a.no_mc_lama = x.no_mesin) ORDER BY a.no_mesin");

    $no = 1;
    $totrol = 0;
    $totberat = 0;
    $c = 0;

    while ($rowd = sqlsrv_fetch_array($sql)) {
      $target = explode(".", $rowd['target']);
      $jamtarget = (int)$target[0] * 60;
      if ($target[1] == '5') {
        $menittarget = 30;
      } else {
        $menittarget = 0;
      }
      $jmltarget = $jamtarget + $menittarget;
      $jamproses = (int)$rowd['jam'] * 60;
      $jmlproses = $jamproses + (int)$rowd['menit'];
      $overtime = $jmlproses - $jmltarget;
      $hours = floor($overtime / 60);
      $min = $overtime - ($hours * 60);
    ?>
      <tr valign="top">
        <td><?php echo $no; ?></td>
        <td>'<?php echo $rowd['mc']; ?></td>
        <td><?php echo $rowd['shft']; ?></td>
        <td>'<?php echo $rowd['nokk']; ?></td>
        <td><?php echo $rowd['kapasitas']; ?></td>
        <td><?php echo $rowd['langganan']; ?></td>
        <td><?php echo $rowd['buyer']; ?></td>
        <td><?php echo $rowd['po']; ?></td>
        <td><?php echo $rowd['no_order']; ?></td>
        <td><?php echo $rowd['jenis_kain']; ?></td>
        <td><?php echo $rowd['warna']; ?></td>
        <td><?php echo $rowd['no_warna']; ?></td>
        <td>'<?php echo $rowd['lot']; ?></td>
        <td align="right"><?php if ($rowd['tgl_out'] != "") {
                            $rol = $rowd['rol'];
                          } else {
                            $rol = 0;
                          }
                          echo $rol; ?></td>
        <td align="right"><?php if ($rowd['tgl_out'] != "") {
                            $brt = $rowd['bruto'];
                          } else {
                            $brt = 0;
                          }
                          echo $brt; ?></td>
        <td><?php echo $rowd['loading']; ?></td>
        <td><?php echo $rowd['proses']; ?></td>
        <td><?php echo cekDesimal($rowd['target']); ?></td>
        <td bgcolor="<?php if ($rowd['jjm'] == "lebih") {
                        echo "yellow";
                      } ?>"><?php if ($rowd['lama_proses'] != "") {
                              echo $rowd['jam'] . " Jam " . $rowd['menit'] . " Menit";
                            } ?><br><?php echo $rowd['sts_hasil']; ?></td>
        <td bgcolor="<?php if ($rowd['jjm'] == "lebih") {
                        echo "yellow";
                      } ?>"><?php echo $rowd['analisa']; ?><br><?php if ($rowd['lama_stop_menit'] != "") {
                                                                  $jam = floor(round($rowd['lama_stop_menit']) / 60);
                                                                  $menit = round($rowd['lama_stop_menit']) % 60;
                                                                  echo $jam . " Jam " . $menit . " Menit";
                                                                } ?></td>
        <td><?php if ($overtime > 0) {
              echo $hours . " Jam " . $min . " Menit";
            } else {
              echo "0";
            } ?></td>
        <td><?php echo $rowd['k_resep']; ?></td>
        <td><?php if ($rowd['ket_status'] == "") {
              echo "";
            } else if ($rowd['ket_status'] != "MC Stop") {
              if ($rowd['resep'] == "Baru") {
                echo "R.B";
              } else {
                echo "R.L";
              }
            } ?></td>
      </tr>
    <?php
      $totrol = $totrol + $rol;
      $totberat = $totberat + $brt;
      $no++;
    } ?>
    <tr>
      <td bgcolor="#99FF99">&nbsp;</td>
      <td bgcolor="#99FF99">&nbsp;</td>
      <td bgcolor="#99FF99">&nbsp;</td>
      <td bgcolor="#99FF99">&nbsp;</td>
      <td bgcolor="#99FF99">&nbsp;</td>
      <td bgcolor="#99FF99">&nbsp;</td>
      <td bgcolor="#99FF99">&nbsp;</td>
      <td bgcolor="#99FF99">&nbsp;</td>
      <td bgcolor="#99FF99">&nbsp;</td>
      <td bgcolor="#99FF99">&nbsp;</td>
      <td bgcolor="#99FF99">&nbsp;</td>
      <td bgcolor="#99FF99">&nbsp;</td>
      <td bgcolor="#99FF99">&nbsp;</td>
      <td bgcolor="#99FF99">&nbsp;</td>
      <td bgcolor="#99FF99">&nbsp;</td>
      <td bgcolor="#99FF99">&nbsp;</td>
      <td bgcolor="#99FF99">&nbsp;</td>
      <td bgcolor="#99FF99">&nbsp;</td>
      <td bgcolor="#99FF99">&nbsp;</td>
      <td bgcolor="#99FF99">&nbsp;</td>
      <td bgcolor="#99FF99">&nbsp;</td>
      <td bgcolor="#99FF99">&nbsp;</td>
      <td bgcolor="#99FF99">&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="#99FF99">&nbsp;</td>
      <td bgcolor="#99FF99">&nbsp;</td>
      <td bgcolor="#99FF99">&nbsp;</td>
      <td bgcolor="#99FF99">&nbsp;</td>
      <td bgcolor="#99FF99">&nbsp;</td>
      <td bgcolor="#99FF99">&nbsp;</td>
      <td bgcolor="#99FF99">&nbsp;</td>
      <td bgcolor="#99FF99">&nbsp;</td>
      <td bgcolor="#99FF99">&nbsp;</td>
      <td bgcolor="#99FF99">&nbsp;</td>
      <th bgcolor="#99FF99">Total</th>
      <td bgcolor="#99FF99">&nbsp;</td>
      <th bgcolor="#99FF99">&nbsp;</th>
      <th bgcolor="#99FF99"><?php echo $totrol; ?></th>
      <th bgcolor="#99FF99"><?php echo $totberat; ?></th>
      <th bgcolor="#99FF99">&nbsp;</th>
      <th bgcolor="#99FF99">&nbsp;</th>
      <th bgcolor="#99FF99">&nbsp;</th>
      <td bgcolor="#99FF99">&nbsp;</td>
      <td bgcolor="#99FF99">&nbsp;</td>
      <td bgcolor="#99FF99">&nbsp;</td>
      <td bgcolor="#99FF99">&nbsp;</td>
      <td bgcolor="#99FF99">&nbsp;</td>
    </tr>
  </table>
</body>