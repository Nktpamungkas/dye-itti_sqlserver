<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=report-monitoring-tempelan-".substr($_GET['awal'],0,10).".xls");//ganti nama sesuai keperluan
header("Pragma: no-cache");
//header("Expires: 0");
//disini script laporan anda
?>
<?php 
ini_set("error_reporting", 1);
include "../../koneksi.php";
include "../../koneksiLAB.php";
include "../../tgl_indo.php";
include_once "../../utils/helper.php";
//--
// Ambil parameter dari URL
$idkk = $_REQUEST['idkk'];
$act = $_GET['g'];
$Awal = $_GET['awal'];
$Akhir = $_GET['akhir'];
$GShift = $_GET['shft'];

// Query untuk mendapatkan tanggal saat ini dan tanggal besok
$qTgl = sqlsrv_query($con, "
    SELECT
        GETDATE() AS tgl_skrg,
        DATEADD(DAY, 1, GETDATE()) AS tgl_besok
");
$rTgl = sqlsrv_fetch_array($qTgl);

// Query data
if ($GShift == "ALL") {
    $shft = "";
} else {
    $shft = "c.g_shift = '$GShift' AND ";
}
?>

<body>

	<strong>Periode: <?php echo $Awal; ?> s/d <?php echo $Akhir; ?></strong><br>
	<strong>Shift: <?php echo $GShift; ?></strong><br />
	<table width="100%" border="1">
		<tr>
			<th bgcolor="#99FF99">NO.</th>
			<th bgcolor="#99FF99">SHIFT</th>
			<th bgcolor="#99FF99">NO MC</th>
			<th bgcolor="#99FF99">KAPASITAS</th>
			<th bgcolor="#99FF99">LANGGANAN</th>
			<th bgcolor="#99FF99">BUYER</th>
			<th bgcolor="#99FF99">NO ORDER</th>
			<th bgcolor="#99FF99">JENIS KAIN</th>
			<th bgcolor="#99FF99">WARNA</th>
			<th bgcolor="#99FF99">K.W</th>
			<th bgcolor="#99FF99">LOT</th>
			<th bgcolor="#99FF99">ROLL</th>
			<th bgcolor="#99FF99">QTY</th>
			<th bgcolor="#99FF99">PROSES</th>
			<th bgcolor="#99FF99">% LOADING</th>
			<th bgcolor="#99FF99">L:R</th>
			<th bgcolor="#99FF99">PEMAKAIAN AIR</th>
			<th bgcolor="#99FF99">KETERANGAN</th>
			<th bgcolor="#99FF99">K.R</th>
			<th bgcolor="#99FF99">R.B/R.L</th>
			<th bgcolor="#99FF99">LAMA PROSES</th>
			<th bgcolor="#99FF99">Operator</th>
			<th bgcolor="#99FF99">NoKK</th>
			<th bgcolor="#99FF99">No Warna</th>
			<th bgcolor="#99FF99">Lebar</th>
			<th bgcolor="#99FF99">Gramasi</th>
			<th bgcolor="#99FF99">Carry Over</th>
			<th bgcolor="#99FF99">No Program</th>
			<th bgcolor="#99FF99">Panjang Kain</th>
			<th bgcolor="#99FF99">cycle time</th>
			<th bgcolor="#99FF99">RPM</th>
			<th bgcolor="#99FF99">Tekanan</th>
			<th bgcolor="#99FF99">Noozle</th>
		</tr>
		<?php
          $Awal=$_GET['awal'];
          $Akhir=$_GET['akhir'];	
          if($GShift=="ALL"){$shft=" ";}else{$shft=" c.g_shift='$GShift' AND ";}
          $sql = sqlsrv_query($con, 
          "SELECT
              a.kd_stop,
              a.mulai_stop,
              a.selesai_stop,
              a.ket,
              CASE 
                  WHEN c.tgl_mulai IS NULL OR c.tgl_stop IS NULL THEN a.lama_proses
                  ELSE 
                      FORMAT(DATEPART(HOUR, DATEADD(MINUTE, DATEDIFF(MINUTE, c.tgl_stop, c.tgl_mulai), 0)), '00') + ':' +
                      FORMAT(DATEPART(MINUTE, DATEADD(MINUTE, DATEDIFF(MINUTE, c.tgl_stop, c.tgl_mulai), 0)), '00')
              END AS lama_proses,
              a.status AS sts,
              DATEPART(HOUR, DATEADD(MINUTE, DATEDIFF(MINUTE, c.tgl_stop, c.tgl_mulai), 0)) AS jam,
              DATEPART(MINUTE, DATEADD(MINUTE, DATEDIFF(MINUTE, c.tgl_stop, c.tgl_mulai), 0)) AS menit,
              a.point,
              FORMAT(a.mulai_stop, 'yyyy-MM-dd') AS t_mulai,
              FORMAT(a.selesai_stop, 'yyyy-MM-dd') AS t_selesai,
              FORMAT(a.mulai_stop, 'HH:mm') AS j_mulai,
              FORMAT(a.selesai_stop, 'HH:mm') AS j_selesai,
              DATEDIFF(MINUTE, a.mulai_stop, a.selesai_stop) AS lama_stop_menit,
              a.acc_keluar,
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
              FORMAT(c.tgl_buat, 'yyyy-MM-dd') AS tgl_in,
              FORMAT(a.tgl_buat, 'yyyy-MM-dd') AS tgl_out,
              FORMAT(c.tgl_buat, 'HH:mm') AS jam_in,
              FORMAT(a.tgl_buat, 'HH:mm') AS jam_out,
              COALESCE(a.g_shift, b.g_shift) AS shft,
              a.operator_keluar,
              b.nokk,
              b.no_warna,
              b.lebar,
              b.gramasi,
              c.carry_over,
              c.operator,
              c.no_program,
              c.pjng_kain,
              c.tekanan,
              c.rpm,
              c.cycle_time,
              c.nozzle,
              b.no_hanger,
              b.no_item,
              b.po,
              b.tgl_delivery
          FROM
              db_dying.tbl_schedule b
              LEFT JOIN db_dying.tbl_montemp c ON c.id_schedule = b.id
              LEFT JOIN db_dying.tbl_hasilcelup a ON a.id_montemp = c.id
          WHERE
              $shft
              FORMAT(c.tgl_buat, 'yyyy-MM-dd') BETWEEN '$Awal' AND '$Akhir'
          ORDER BY
              b.no_mesin ASC
            "); 
          
          $no=1;
          $totrol=0;
          $totberat=0;
          $c=0;
          
      
    while($rowd=sqlsrv_fetch_array($sql)){
		   ?>
		<tr valign="top">
			<td><?php echo $no;?></td>
			<td><?php echo $rowd['shft'];?></td>
			<td>'<?php echo $rowd['no_mesin'];?></td>
			<td><?php echo $rowd['kapasitas'];?></td>
			<td><?php echo $rowd['langganan'];?></td>
			<td><?php echo $rowd['buyer'];?></td>
			<td><?php echo $rowd['no_order']; ?></td>
			<td><?php echo $rowd['jenis_kain'];?></td>
			<td><?php echo $rowd['warna']; ?></td>
			<td><?php echo $rowd['kategori_warna']; ?></td>
			<td>'<?php echo $rowd['lot']; ?></td>
			<td><?php if($rowd['tgl_out']!=""){$rol=$rowd['rol'];}else{ $rol=0; } echo $rol; ?></td>
			<td><?php if($rowd['tgl_out']!=""){$brt=$rowd['bruto'];}else{ $brt=0; } echo $brt; ?></td>
			<td><?php echo $rowd['proses']; ?></td>
			<td><?php echo $rowd['loading']; ?></td>
			<td>'<?php echo $rowd['l_r']; ?></td>
			<td><?php echo $rowd['pakai_air']; ?></td>
			<td><?php echo $rowd['ket']."<br>".$rowd['sts']; ?></td>
			<td><?php echo $rowd['k_resep'];?></td>
			<td><?php if($rowd['ket_status']!="MC Stop"){ if($rowd['resep']=="Baru"){echo"R.B";}else{echo"R.L";} }?>
			</td>
			<td><?php echo !empty($rowd['lama_proses']) ? sprintf('%02d Jam %02d Menit', intval(explode(':', $rowd['lama_proses'])[0]), intval(explode(':', $rowd['lama_proses'])[1])) : ""; ?>
			</td>
			<td><?php echo $rowd['operator'];?></td>
			<td>'<?php echo $rowd['nokk'];?></td>
			<td><?php echo $rowd['no_warna'];?></td>
			<td><?php echo $rowd['lebar'];?></td>
			<td><?php echo $rowd['gramasi'];?></td>
			<td><?php echo $rowd['carry_over'];?></td>
			<td><?php echo $rowd['no_program'];?></td>
			<td><?php echo $rowd['pjng_kain'];?></td>
			<td><?php echo $rowd['cycle_time'];?></td>
			<td><?php echo $rowd['rpm'];?></td>
			<td><?php echo $rowd['tekanan'];?></td>
			<td><?php echo $rowd['nozzle'];?></td>
		</tr>
		<?php 
	 $totrol +=$rol;
	 $totberat +=$brt;
	 $no++;} ?>
		<tr>
			<td colspan="8" bgcolor="#99FF99">&nbsp;</td>
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
			<th bgcolor="#99FF99">Total</th>
			<td bgcolor="#99FF99">&nbsp;</td>
			<th bgcolor="#99FF99">&nbsp;</th>
			<th bgcolor="#99FF99"><?php echo $totrol;?></th>
			<th bgcolor="#99FF99"><?php echo $totberat;?></th>
			<th bgcolor="#99FF99">&nbsp;</th>
			<th bgcolor="#99FF99">&nbsp;</th>
			<th bgcolor="#99FF99">&nbsp;</th>
			<th bgcolor="#99FF99">&nbsp;</th>
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
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
	</table>
</body>