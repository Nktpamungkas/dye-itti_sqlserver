<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=report-produksi-harian" . substr($_GET['awal'], 0, 10) . ".xls"); //ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");
//disini script laporan anda
?>
<?php
include "../../koneksi.php";
include "../../tgl_indo.php";

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
?>

<body>
	<?php
	function nmhari($tgl)
	{
		$namahari = date('l', strtotime($tgl));
		return $namahari;
	}
	function cekDesimal($angka)
	{
		$bulat = round($angka);
		if ($bulat > $angka) {
			$jam = $bulat - 1;
			$waktu = $jam . ":30";
		} else {
			$jam = $bulat;
			$waktu = $jam . ":00";
		}
		return $waktu;
	}
	?>
	<strong>Periode: <?php echo $TglPAl; ?> s/d <?php echo $TglPAr; ?> Shift: <?php echo $shft; ?></strong>
	<table width="100%" border="1">
		<tr>
			<th bgcolor="#99FF99">No.</th>
			<th bgcolor="#99FF99">Shift</th>
			<th bgcolor="#99FF99">No MC</th>
			<th bgcolor="#99FF99">Kapasitas</th>
			<th bgcolor="#99FF99">Jenis Kain</th>
			<th bgcolor="#99FF99">No Warna</th>
			<th bgcolor="#99FF99">Warna</th>
			<th bgcolor="#99FF99">Lot</th>
			<th bgcolor="#99FF99">Proses</th>
			<th bgcolor="#99FF99">Keterangan</th>
			<th bgcolor="#99FF99">Tgl In</th>
			<th bgcolor="#99FF99">Jam In</th>
			<th bgcolor="#99FF99">Tgl Out</th>
			<th bgcolor="#99FF99">Jam Out</th>
			<th bgcolor="#99FF99">Lama Proses</th>
			<th bgcolor="#99FF99">Target Lama Proses</th>
			<th bgcolor="#99FF99">K.W</th>
			<th bgcolor="#99FF99">Dyestuff</th>
			<th bgcolor="#99FF99">Machine Idle</th>
			<th bgcolor="#99FF99">Operator Masuk Kain</th>
			<th bgcolor="#99FF99">Operator Keluar Kain</th>
			<th bgcolor="#99FF99">Oper Shift</th>
			<th bgcolor="#99FF99">Cycle time</th>
			<th bgcolor="#99FF99">Target Cycle time</th>
			<th bgcolor="#99FF99">Analisa</th>
			<th bgcolor="#99FF99">Analisa Machine Idle</th>
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
			$shftq = " ISNULL(a.g_shift, c.g_shift) = '$_GET[shft]' AND ";
		}
		$sql = sqlsrv_query($con, "SELECT x.*,a.no_mesin as mc,a.no_mc_lama as mc_lama FROM db_dying.tbl_mesin a
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
											c.tgl_buat,
										  	CONVERT(date, c.tgl_buat) AS tgl_in,
											CONVERT(date, a.tgl_buat) AS tgl_out,
											FORMAT(c.tgl_buat, 'HH:mm') AS jam_in,
											FORMAT(a.tgl_buat, 'HH:mm') AS jam_out,
											ISNULL(a.g_shift, c.g_shift) AS shft,
											a.operator_keluar,
											c.operator,
											c.waktu_tunggu,
											c.oper_shift,
											a.k_resep,
											a.status,
											a.proses_point,
											a.analisa,
											b.target,
											b.nokk,
											b.no_warna,
											b.lebar,
											b.gramasi,
											c.carry_over,
											b.no_hanger,
											b.no_item,
											b.po,	
											b.tgl_delivery,
											c.air_awal,
											c.note_wt,
											a.air_akhir
										FROM
											db_dying.tbl_schedule b
											LEFT JOIN db_dying.tbl_montemp c ON c.id_schedule = b.id
											LEFT JOIN db_dying.tbl_hasilcelup a ON a.id_montemp=c.id	
										WHERE
											$shftq 
											$Where
											)x ON (a.no_mesin=x.no_mesin or a.no_mc_lama=x.no_mesin) ORDER BY a.no_mesin,x.tgl_buat ASC");

		$no = 1;

		$c = 0;
		$totrol = 0;
		$totberat = 0;

		while ($rowd = sqlsrv_fetch_array($sql)) {
			if ($_GET['shft'] == "ALL") {
				$shftSM = null;
			} else {
				$shftSM = " g_shift='" . $_GET['shft'] . "' AND ";
			}
			$sqlSM = sqlsrv_query($con, "SELECT *, FORMAT(
														DATEADD(MINUTE, 
																DATEDIFF(MINUTE, mulai, selesai), 
																'1900-01-01'
															), 
														'HH:mm'
													) AS menitSM,
													CONVERT(date, mulai) AS tgl_masuk,
													CONVERT(date, selesai) AS tgl_selesai,
													FORMAT(mulai, 'HH:mm') AS jam_masuk,
													FORMAT(selesai, 'HH:mm') AS jam_selesai,
													kapasitas AS kapSM,
													g_shift AS shiftSM
      												FROM db_dying.tbl_stopmesin
      				WHERE $shftSM tgl_update BETWEEN '" . $_GET['awal'] . "' AND '" . $_GET['akhir'] . "' AND (no_mesin='" . $rowd['mc'] . "' AND no_mesin='" . $rowd['mc_lama'] . "' )");
			$rowSM = sqlsrv_fetch_array($sqlSM);
			if ($rowd['jam'] > 0) {
				$menit = round($rowd['menit'] / 60);
				$jam = $rowd['jam'] + $menit;
				$cycle_time = round($jam / 8, 2);
			} else {
				$cycle_time = 0;
			}
			if ($rowd['target'] > 0) {
				$jam1 = $rowd['target'];
				$cycle_time1 = round($jam1 / 8, 2);
			} else {
				$cycle_time1 = 0;
			}
			if ($rowd['oper_shift'] != "") {
				$opershift = $rowd['oper_shift'] . "->" . $rowd['operator'];
			} else {
				$opershift = "";
			}
			?>
			<tr valign="top">
				<td><?php echo $no; ?></td>
				<td><?php if ($rowd['langganan'] == "" and substr($rowd['proses'], 0, 10) != "Cuci Mesin") {
					echo $rowSM['shiftSM'];
				} else {
					echo $rowd['shft'];
				} ?></td>
				<td>'<?php echo $rowd['mc']; ?></td>
				<td><?php if ($rowd['langganan'] == "" and substr($rowd['proses'], 0, 10) != "Cuci Mesin") {
					echo $rowSM['kapSM'];
				} else {
					echo $rowd['kapasitas'];
				} ?></td>
				<td><?php echo $rowd['jenis_kain']; ?></td>
				<td><?php echo $rowd['no_warna']; ?></td>
				<td><?php echo $rowd['warna']; ?></td>
				<td>'<?php echo $rowd['lot']; ?></td>
				<td><?php if ($rowd['langganan'] == "" and substr($rowd['proses'], 0, 10) != "Cuci Mesin") {
					echo $rowSM['proses'];
				} else {
					echo $rowd['proses'];
				} ?></td>
				<td><?php if ($rowd['langganan'] == "" and substr($rowd['proses'], 0, 10) != "Cuci Mesin") {
					echo $rowSM['keterangan'] . "" . $rowSM['no_stop'];
				} else {
					echo $rowd['ket'] . "" . $rowd['status'];
				} ?></td>
				<td>
					<font color="<?php if (nmhari($rowd['tgl_in']->format('Y-m-d')) == "Sunday") {
						echo "red";
					} ?>"><?php echo $rowd['tgl_in']->format('Y-m-d'); ?></font>
				</td>
				<td><?php echo $rowd['jam_in']; ?></td>
				<td>
					<font color="<?php if (nmhari($rowd['tgl_in']->format('Y-m-d')) == "Sunday") {
						echo "red";
					} ?>"><?php echo ($rowd['tgl_out'] != null or $rowd['tgl_out'] != "") ? $rowd['tgl_out']->format('Y-m-d') : ""; ?>
					</font>
				</td>
				<td><?php echo $rowd['jam_out']; ?></td>
				<td><?php if ($rowd['lama_proses'] != "") {
					echo $rowd['jam'] . ":" . $rowd['menit'];
				} ?></td>
				<td><?php echo cekDesimal($rowd['target']); ?></td>
				<td><?php echo $rowd['kategori_warna']; ?></td>
				<td><?php echo $rowd['dyestuff']; ?></td>
				<td><?php echo $rowd['waktu_tunggu']; ?></td>
				<td><?php echo $rowd['operator']; ?></td>
				<td><?php echo $rowd['operator_keluar']; ?></td>
				<td><?php echo $opershift; ?></td>
				<td><?php echo $cycle_time; ?></td>
				<td><?php echo $cycle_time1; ?></td>
				<td><?php echo $rowd['analisa']; ?></td>
				<td><?php echo $rowd['note_wt']; ?></td>
			</tr>
			<?php
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
			<td bgcolor="#99FF99">&nbsp;</td>
			<td bgcolor="#99FF99">&nbsp;</td>
			<td bgcolor="#99FF99">&nbsp;</td>
		</tr>

	</table>
</body>