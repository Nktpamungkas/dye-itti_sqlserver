<?php
ini_set("error_reporting", 1);
include "./../koneksi.php";

$sqJam = sqlsrv_query($con, "SELECT 
			CONVERT(VARCHAR,CONVERT(date, GETDATE())) AS jskrng, 
			CONVERT(VARCHAR(10), DATEADD(DAY, -1, GETDATE()), 120) AS jsblm");
$rJam = sqlsrv_fetch_array($sqJam);

if (date("H:i:s") >= "23:00:00" && date("H:i:s") <= "06:59:59") {
	$sf = "3";
} else if (date("H:i:s") >= "07:00:00" && date("H:i:s") <= "14:59:59") {
	$sf = "1";
} else if (date("H:i:s") >= "15:00:00" && date("H:i:s") <= "22:59:59") {
	$sf = "2";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="refresh" content="360">
	<title><?php echo "SHIFT: " . $sf; ?> Lot Keluar Celup Dyeing ITTI</title>
	<style>
		td {
			padding: 1px 0px;
		}

		.blink_me {
			animation: blinker 1s linear infinite;
		}

		.blink_me1 {
			animation: blinker 7s linear infinite;
		}

		@keyframes blinker {
			50% {
				opacity: 0;
			}
		}

		body {
			font-family: Calibri, "sans-serif", "Courier New";
			/* "Calibri Light","serif" */
			font-style: normal;
		}
	</style>

	<link rel="stylesheet" href="./../bower_components/bootstrap/dist/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="./../bower_components/font-awesome/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="./../bower_components/Ionicons/css/ionicons.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="./../dist/css/AdminLTE.min.css">
	<!-- toast CSS -->
	<link href="./../bower_components/toast-master/css/jquery.toast.css" rel="stylesheet">
	<!-- DataTables -->
	<link rel="stylesheet" href="./../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
	<!-- bootstrap datepicker -->
	<link rel="stylesheet" href="./../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">

	<link rel="stylesheet" href="./../dist/css/skins/skin-purple.min.css">

	<link rel="icon" type="image/png" href="./../dist/img/index.ico">
	<style type="text/css">
		.teks-berjalan {
			background-color: #03165E;
			color: #F4F0F0;
			font-family: monospace;
			font-size: 24px;
			font-style: italic;
		}

		.border-dashed {
			border: 4px dashed #083255;
		}

		.bulat {
			border-radius: 50%;
			/*box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);*/
		}
	</style>
</head>

<body>
	<div class="row">
		<div class="col-xs-3">
			<?php
			if ($sf == "1" or $sf == "2") {
				$sqJam1 = sqlsrv_query($con, "SELECT CONVERT(date, GETDATE()) AS tgl ");
				$rJam1 = sqlsrv_fetch_array($sqJam1);
			} else {
				$sqJam1 = sqlsrv_query($con, "SELECT CONVERT(VARCHAR(10), DATEADD(DAY, -1, GETDATE()), 23) AS tgl");
				$rJam1 = sqlsrv_fetch_array($sqJam1);
			}
			?>



			<div class="box-body table-responsive">
				<i style="font-size: 8px;"><strong>Tgl: <?php echo $rJam1['tgl']->format('Y-m-d'); ?> SHIFT: 1</strong></i>
				<table width="100%" border="0" id="tblr1" style="font-size: 8px;">
					<thead class="bg-blue">
						<tr align="center">
							<td scope="col">No Mesin</td>
							<td scope="col">Cap </td>
							<td scope="col">Shf</td>
							<td scope="col">Operator</td>
							<td scope="col">Lot Keluar</td>
							<td scope="col">Qty</td>
							<td scope="col">Waktu Proses</td>
							<td scope="col">Warna</td>
							<td scope="col">Proses</td>
							<td scope="col">Status</td>
						</tr>
					</thead>
					<tbody>
						<?php
						if ($sf == "1" or $sf == "2") {
							$sqlM = sqlsrv_query($con, "SELECT 
													a.no_mesin,	
													a.kapasitas,
													b.operator,
													b.g_shift,
													b.bruto,
													b.lama,
													b.warna,
													b.proses,
													b.tgl,
													b.tgl1,
													b.tgl2,
													CASE WHEN b.g_shift IS NOT NULL THEN 1 ELSE '' END AS lotkeluar 
												FROM 
													db_dying.tbl_mesin a
												LEFT JOIN (
													SELECT
														a.no_mesin,
														b.g_shift,
														b.operator_keluar AS operator,
														a.jenis_kain,
														a.proses,
														a.warna,
														CASE
															WHEN c.tgl_mulai IS NULL OR c.tgl_stop IS NULL THEN b.lama_proses
															ELSE 
															CONCAT(
																CAST(DATEDIFF(SECOND, c.tgl_stop, c.tgl_mulai) / 3600 AS VARCHAR(2)), ':',
																RIGHT('0' + CAST((DATEDIFF(SECOND, c.tgl_stop, c.tgl_mulai) % 3600) / 60 AS VARCHAR(2)), 2)
															)
                                          				END AS lama,
														b.point,
														b.k_resep,
														a.target,
														c.bruto,
														c.rol,
														c.tgl_buat AS tgl_in,
														b.tgl_buat AS tgl_out,
														CONVERT(DATE, DATEADD(DAY, -2, GETDATE())) AS tgl,
														CONVERT(DATE, DATEADD(DAY, -1, GETDATE())) AS tgl1,
														CONVERT(DATE, GETDATE()) AS tgl2
													FROM
														db_dying.tbl_schedule a
														INNER JOIN db_dying.tbl_montemp c ON a.id = c.id_schedule
														INNER JOIN db_dying.tbl_hasilcelup b ON c.id = b.id_montemp 
													WHERE
														a.status = 'selesai'
														AND (NOT a.proses LIKE '%Cuci Mesin%' OR a.proses IS NULL)
														AND CONVERT(DATETIME, b.tgl_buat) BETWEEN 
														CONVERT(DATETIME, CONVERT(VARCHAR(10), GETDATE(), 120) + ' 07:15')
														AND CONVERT(DATETIME, CONVERT(VARCHAR(10), GETDATE(), 120) + ' 15:14')
												) b ON b.no_mesin = a.no_mesin 
												WHERE 
													a.kapasitas > 0 
												ORDER BY 
													a.kapasitas DESC");
						} else {
							$sqlM = sqlsrv_query($con, "SELECT 
							a.no_mesin,
							a.kapasitas,
							b.operator,
							b.g_shift,
							b.bruto,
							b.lama,
							b.warna,
							b.proses,
							b.tgl,
							b.tgl1,
							b.tgl2,
							CASE WHEN b.g_shift IS NOT NULL THEN 1 ELSE '' END AS lotkeluar  FROM db_dying.tbl_mesin a
												LEFT JOIN
												( SELECT
													a.no_mesin,
													b.g_shift,
													b.operator_keluar as operator,
													a.jenis_kain,
													a.proses,
													a.warna,	
													CASE
															WHEN c.tgl_mulai IS NULL OR c.tgl_stop IS NULL THEN b.lama_proses
															ELSE 
															CONCAT(
																CAST(DATEDIFF(SECOND, c.tgl_stop, c.tgl_mulai) / 3600 AS VARCHAR(2)), ':',
																RIGHT('0' + CAST((DATEDIFF(SECOND, c.tgl_stop, c.tgl_mulai) % 3600) / 60 AS VARCHAR(2)), 2)
															)
                                          				END AS lama,
													b.point,
													b.k_resep,
													a.target,
													c.bruto,
													c.rol,
													c.tgl_buat AS tgl_in,
													b.tgl_buat AS tgl_out,
													CONVERT(DATE, DATEADD(DAY, -2, GETDATE())) AS tgl,
													CONVERT(DATE, DATEADD(DAY, -1, GETDATE())) AS tgl1,
													CONVERT(DATE, GETDATE()) AS tgl2
												FROM
													db_dying.tbl_schedule a
													INNER JOIN db_dying.tbl_montemp c ON a.id = c.id_schedule
													INNER JOIN db_dying.tbl_hasilcelup b ON c.id = b.id_montemp 
												WHERE
													a.status = 'selesai'
													AND (NOT a.proses LIKE 'Cuci Mesin%' OR a.proses IS NULL)
													AND CONVERT(DATETIME, b.tgl_buat) BETWEEN 
														CONVERT(DATETIME, CONVERT(VARCHAR(10), GETDATE(), 120) + ' 07:15')
														AND CONVERT(DATETIME, CONVERT(VARCHAR(10), GETDATE(), 120) + ' 15:14')
												) b on b.no_mesin = a.no_mesin 
													WHERE a.kapasitas > 0 
													AND (b.proses IS NULL OR b.proses NOT LIKE 'Cuci Mesin%')
													ORDER BY a.kapasitas DESC");
						}

						while ($rM = sqlsrv_fetch_array($sqlM)) {
							$bgcolor = ($col++ & 1) ? 'gainsboro' : 'antiquewhite';
						?>
							<tr bgcolor="<?php echo $bgcolor; ?>">
								<td align="center"><strong><?php echo  $rM['no_mesin']; ?></strong></td>
								<td align="center"><strong><?php echo  $rM['kapasitas']; ?></strong></td>
								<td align="center"><strong><?php echo  $rM['g_shift']; ?></strong></td>
								<td align="center"><strong><?php echo  $rM['operator']; ?></strong></td>
								<td align="center"><strong><?php echo  $rM['lotkeluar']; ?></strong></td>
								<td align="center"><strong><?php echo  $rM['bruto']; ?></strong></td>
								<td align="center"><strong><?php echo  $rM['lama']; ?></strong></td>
								<td align="center"><strong><?php echo  $rM['warna']; ?></strong></td>
								<td align="center"><strong><?php echo  $rM['proses']; ?></strong></td>
								<td>&nbsp;</td>
							</tr>
						<?php
							if ($rM['lotkeluar'] != "") {
								$LK1 = $rM['lotkeluar'];
							} else {
								$LK1 = 0;
							}
							$tLK1 += $LK1;
							$tKGS1 += $rM['bruto'];
						} ?>
					</tbody>
					<tfoot class="bg-blue">
						<tr>
							<td align="center">&nbsp;</td>
							<td align="center">&nbsp;</td>
							<td align="center">&nbsp;</td>
							<td align="center">Total</td>
							<td align="center"><?php echo $tLK1; ?></td>
							<td align="center"><?php echo $tKGS1; ?></td>
							<td align="center">&nbsp;</td>
							<td align="center">&nbsp;</td>
							<td align="center">&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
					</tfoot>
				</table>

			</div>
		</div>
		<div class="col-xs-3">
			<?php
			if ($sf == "2" or $sf == "3") {
				$sqJam2 = sqlsrv_query($con, "SELECT CONVERT(date, GETDATE()) AS tgl ");
				$rJam2 = sqlsrv_fetch_array($sqJam2);
			} else {
				$sqJam2 = sqlsrv_query($con, "SELECT CONVERT(VARCHAR(10), DATEADD(DAY, -1, GETDATE()), 23) AS tgl");
				$rJam2 = sqlsrv_fetch_array($sqJam2);
			} ?>
			<div class="box-body table-responsive">
				<i style="font-size: 8px;"><strong>Tgl: <?php echo $rJam2['tgl']; ?> SHIFT: 2</strong></i>
				<table width="100%" border="0" id="tblr1" style="font-size: 8px;">
					<thead class="bg-blue">
						<tr align="center">
							<td scope="col">No Mesin</td>
							<td scope="col">Cap </td>
							<td scope="col">Shf</td>
							<td scope="col">Operator</td>
							<td scope="col">Lot Keluar</td>
							<td scope="col">Qty</td>
							<td scope="col">Waktu Proses</td>
							<td scope="col">Warna</td>
							<td scope="col">Proses</td>
							<td scope="col">Status</td>
						</tr>
					</thead>
					<tbody>
						<?php
						if ($sf == "2" or $sf == "3") {
							$sqlM = sqlsrv_query($con, "SELECT a.no_mesin,
							a.kapasitas,
							b.operator,
							b.g_shift,
							b.bruto,
							b.lama,
							b.warna,
							b.proses,
							b.tgl,
							b.tgl1,
							b.tgl2,
							CASE WHEN b.g_shift IS NOT NULL THEN 1 ELSE '' END AS lotkeluar 
							FROM db_dying.tbl_mesin a
							LEFT JOIN
								(SELECT
									a.no_mesin,
									b.g_shift,
									b.operator_keluar AS operator,
									a.jenis_kain,
									a.proses,
									a.warna, 
									CASE
															WHEN c.tgl_mulai IS NULL OR c.tgl_stop IS NULL THEN b.lama_proses
															ELSE 
															CONCAT(
																CAST(DATEDIFF(SECOND, c.tgl_stop, c.tgl_mulai) / 3600 AS VARCHAR(2)), ':',
																RIGHT('0' + CAST((DATEDIFF(SECOND, c.tgl_stop, c.tgl_mulai) % 3600) / 60 AS VARCHAR(2)), 2)
															)
                                          				END AS lama,
									b.point,
									b.k_resep,
									a.target,
									c.bruto,
									c.rol,
									c.tgl_buat AS tgl_in,
									b.tgl_buat AS tgl_out,
									CONVERT(DATE, DATEADD(DAY, -2, GETDATE())) AS tgl,
									CONVERT(DATE, DATEADD(DAY, -1, GETDATE())) AS tgl1,
									CONVERT(DATE, GETDATE()) AS tgl2
								FROM
									db_dying.tbl_schedule a
									INNER JOIN db_dying.tbl_montemp c ON a.id = c.id_schedule
									INNER JOIN db_dying.tbl_hasilcelup b ON c.id = b.id_montemp 
								WHERE
									a.status = 'selesai' 
									AND (NOT a.proses LIKE '%Cuci Mesin%' OR a.proses IS NULL)
									AND CONVERT(DATETIME, b.tgl_buat) BETWEEN CONVERT(DATETIME, CONVERT(VARCHAR(10), GETDATE(), 120) + ' 15:15')
									AND CONVERT(DATETIME, CONVERT(VARCHAR(10), GETDATE(), 120) + ' 23:14')
								) b on b.no_mesin = a.no_mesin 
								WHERE a.kapasitas > 0
								ORDER BY a.kapasitas DESC");
						} else {
							$sqlM = sqlsrv_query($con, " SELECT a.no_mesin,a.kapasitas,b.operator,b.g_shift,b.bruto,b.lama,b.warna,b.proses,b.tgl,b.tgl1,b.tgl2,CASE WHEN b.g_shift IS NOT NULL THEN 1 ELSE '' END AS lotkeluar  FROM db_dying.tbl_mesin a
								LEFT JOIN 
								( SELECT
									a.no_mesin,
									b.g_shift,
									b.operator_keluar AS operator,
									a.jenis_kain,
									a.proses,
									a.warna,	
									CASE
															WHEN c.tgl_mulai IS NULL OR c.tgl_stop IS NULL THEN b.lama_proses
															ELSE 
															CONCAT(
																CAST(DATEDIFF(SECOND, c.tgl_stop, c.tgl_mulai) / 3600 AS VARCHAR(2)), ':',
																RIGHT('0' + CAST((DATEDIFF(SECOND, c.tgl_stop, c.tgl_mulai) % 3600) / 60 AS VARCHAR(2)), 2)
															)
                                          				END AS lama,
									b.point,
									b.k_resep,
									a.target,
									c.bruto,
									c.rol,
									c.tgl_buat AS tgl_in,
									b.tgl_buat AS tgl_out,
									CONVERT(DATE, DATEADD(DAY, -2, GETDATE())) AS tgl,
									CONVERT(DATE, DATEADD(DAY, -1, GETDATE())) AS tgl1,
									CONVERT(DATE, GETDATE()) AS tgl2
								FROM
									db_dying.tbl_schedule a
									INNER JOIN db_dying.tbl_montemp c ON a.id = c.id_schedule
									INNER JOIN db_dying.tbl_hasilcelup b ON c.id = b.id_montemp 
								WHERE
									a.status = 'selesai' 
									AND (NOT a.proses LIKE '%Cuci Mesin%' OR a.proses IS NULL)
									AND CONVERT(DATETIME, b.tgl_buat) BETWEEN CONVERT(DATETIME, CONVERT(VARCHAR(10), GETDATE(), 120) + ' 15:15')
									AND CONVERT(DATETIME, CONVERT(VARCHAR(10), GETDATE(), 120) + ' 23:14')
								) b on b.no_mesin=a.no_mesin 
								WHERE a.kapasitas > 0
								ORDER BY a.kapasitas DESC");
						}
						while ($rM = sqlsrv_fetch_array($sqlM)) {
							$bgcolor = ($col++ & 1) ? 'gainsboro' : 'antiquewhite';
						?>
							<tr bgcolor="<?php echo $bgcolor; ?>">
								<td align="center"><strong><?php echo  $rM['no_mesin']; ?></strong></td>
								<td align="center"><strong><?php echo  $rM['kapasitas']; ?></strong></td>
								<td align="center"><strong><?php echo  $rM['g_shift']; ?></strong></td>
								<td align="center"><strong><?php echo  $rM['operator']; ?></strong></td>
								<td align="center"><strong><?php echo  $rM['lotkeluar']; ?></strong></td>
								<td align="center"><strong><?php echo  $rM['bruto']; ?></strong></td>
								<td align="center"><strong><?php echo  $rM['lama']; ?></strong></td>
								<td align="center"><strong><?php echo  $rM['warna']; ?></strong></td>
								<td align="center"><strong><?php echo  $rM['proses']; ?></strong></td>
								<td>&nbsp;</td>
							</tr>
						<?php
							if ($rM['lotkeluar'] != "") {
								$LK2 = $rM['lotkeluar'];
							} else {
								$LK2 = 0;
							}
							$tLK2 += $LK2;
							$tKGS2 += $rM['bruto'];
						} ?>
					</tbody>
					<tfoot class="bg-blue">
						<tr>
							<td align="center">&nbsp;</td>
							<td align="center">&nbsp;</td>
							<td align="center">&nbsp;</td>
							<td align="center">Total</td>
							<td align="center"><?php echo $tLK2; ?></td>
							<td align="center"><?php echo $tKGS2; ?></td>
							<td align="center">&nbsp;</td>
							<td align="center">&nbsp;</td>
							<td align="center">&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
					</tfoot>
				</table>

			</div>
		</div>
		<div class="col-xs-3">
			<?php
			if ($sf == "3") {
				$sqJam3 =
					sqlsrv_query($con, "SELECT CONVERT(date, GETDATE()) AS tgl ");
				$rJam3 =
					sqlsrv_fetch_array($sqJam3);
			} else {
				$sqJam3 =
					sqlsrv_query($con, "SELECT CONVERT(VARCHAR(10), DATEADD(DAY, -1, GETDATE()), 23) AS tgl");
				$rJam3 =
					sqlsrv_fetch_array($sqJam3);
			}
			?>
			<div class="box-body table-responsive">
				<i style="font-size: 8px;"><strong>Tgl: <?php echo $rJam3['tgl']; ?> SHIFT: 3 </strong></i>
				<table width="100%" border="0" id="tblr1" style="font-size: 8px;">
					<thead class="bg-blue">
						<tr align="center">
							<td scope="col">No Mesin</td>
							<td scope="col">Cap </td>
							<td scope="col">Shf</td>
							<td scope="col">Operator</td>
							<td scope="col">Lot Keluar</td>
							<td scope="col">Qty</td>
							<td scope="col">Waktu Proses</td>
							<td scope="col">Warna</td>
							<td scope="col">Proses</td>
							<td scope="col">Status</td>
						</tr>
					</thead>
					<tbody>
						<?php $sqlM = sqlsrv_query($con, " SELECT a.no_mesin,a.kapasitas,b.operator,b.g_shift,b.bruto,b.lama,b.warna,b.proses,b.tgl,b.tgl1,b.tgl2,CASE WHEN b.g_shift IS NOT NULL THEN 1 ELSE '' END AS lotkeluar  FROM db_dying.tbl_mesin a
							LEFT JOIN
							( SELECT
								a.no_mesin,
								b.g_shift,
								b.operator_keluar AS operator,
								a.jenis_kain,
								a.proses,
								a.warna,	
								CASE
															WHEN c.tgl_mulai IS NULL OR c.tgl_stop IS NULL THEN b.lama_proses
															ELSE 
															CONCAT(
																CAST(DATEDIFF(SECOND, c.tgl_stop, c.tgl_mulai) / 3600 AS VARCHAR(2)), ':',
																RIGHT('0' + CAST((DATEDIFF(SECOND, c.tgl_stop, c.tgl_mulai) % 3600) / 60 AS VARCHAR(2)), 2)
															)
                                          				END AS lama,
								b.point,
								b.k_resep,
								a.target,
								c.bruto,
								c.rol,
								c.tgl_buat AS tgl_in,
								b.tgl_buat AS tgl_out,
								CONVERT(DATE, DATEADD(DAY, -2, GETDATE())) AS tgl,
								CONVERT(DATE, DATEADD(DAY, -1, GETDATE())) AS tgl1,
								CONVERT(DATE, GETDATE()) AS tgl2
							FROM
								db_dying.tbl_schedule a
								INNER JOIN db_dying.tbl_montemp c ON a.id = c.id_schedule
								INNER JOIN db_dying.tbl_hasilcelup b ON c.id = b.id_montemp 
							WHERE
								a.status = 'selesai' 
								AND (NOT a.proses LIKE '%Cuci Mesin%' OR a.proses IS NULL)
								AND CONVERT(DATETIME, b.tgl_buat) BETWEEN CONVERT(DATETIME, CONVERT(VARCHAR(10), DATEADD(DAY, -1, GETDATE()), 120) + ' 23:15')
								AND CONVERT(DATETIME, CONVERT(VARCHAR(10), GETDATE(), 120) + ' 07:14')
							) b on b.no_mesin = a.no_mesin 
							WHERE a.kapasitas > 0
							ORDER BY a.kapasitas DESC");
						while ($rM = sqlsrv_fetch_array($sqlM)) {
							$bgcolor = ($col++ & 1) ? 'gainsboro' : 'antiquewhite';
						?>
							<tr bgcolor="<?php echo $bgcolor; ?>">
								<td align="center"><strong><?php echo  $rM['no_mesin']; ?></strong></td>
								<td align="center"><strong><?php echo  $rM['kapasitas']; ?></strong></td>
								<td align="center"><strong><?php echo  $rM['g_shift']; ?></strong></td>
								<td align="center"><strong><?php echo  $rM['operator']; ?></strong></td>
								<td align="center"><strong><?php echo  $rM['lotkeluar']; ?></strong></td>
								<td align="center"><strong><?php echo  $rM['bruto']; ?></strong></td>
								<td align="center"><strong><?php echo  $rM['lama']; ?></strong></td>
								<td align="center"><strong><?php echo  $rM['warna']; ?></strong></td>
								<td align="center"><strong><?php echo  $rM['proses']; ?></strong></td>
								<td>&nbsp;</td>
							</tr>
						<?php
							if ($rM['lotkeluar'] != "") {
								$LK3 = $rM['lotkeluar'];
							} else {
								$LK3 = 0;
							}
							$tLK3 += $LK3;
							$tKGS3 += $rM['bruto'];
						} ?>
					</tbody>
					<tfoot class="bg-blue">
						<tr>
							<td align="center">&nbsp;</td>
							<td align="center">&nbsp;</td>
							<td align="center">&nbsp;</td>
							<td align="center">Total</td>
							<td align="center"><?php echo $tLK3; ?></td>
							<td align="center"><?php echo $tKGS3; ?></td>
							<td align="center">&nbsp;</td>
							<td align="center">&nbsp;</td>
							<td align="center">&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
					</tfoot>
				</table>

			</div>
		</div>
		<div class="col-xs-2">
			<div class="box-body table-responsive">
				<i style="font-size: 8px;"><strong>TOTAL LOT </strong></i>
				<table width="100%" border="0" id="tblr1" style="font-size: 8px;">
					<thead class="bg-blue">
						<tr align="center">
							<td scope="col">No Mesin</td>
							<td scope="col">Cap </td>
							<td scope="col"><?php echo $rJam['jskrng'] ?></td>
							<td scope="col"><?php echo $rJam['jsblm'] ?></td>
						</tr>
					</thead>
					<tbody>
						<?php $sqlM = sqlsrv_query($con, "SELECT 
															x.*, 
															y.jml AS jmlsblm 
														FROM
															(SELECT 
																a.no_mesin, 
																a.kapasitas, 
																SUM(b.lotkeluar) AS jml 
															FROM 
																db_dying.tbl_mesin a 
																LEFT JOIN 
																(
																	SELECT 
																		a.no_mesin,
																		CASE WHEN b.g_shift IS NOT NULL THEN 1 ELSE 0 END AS lotkeluar,
																		b.tgl1,
																		b.tgl2 
																	FROM 
																		db_dying.tbl_mesin a
																		LEFT JOIN 
																		(
																			SELECT
																				a.no_mesin,
																				b.g_shift,
																				b.operator_keluar AS operator,
																				a.jenis_kain,
																				a.proses,
																				a.warna,
																				a.kategori_warna, 
																				CASE 
																					WHEN c.tgl_mulai IS NULL OR c.tgl_stop IS NULL 
																					THEN b.lama_proses
																					ELSE 
																						FORMAT(
																							DATEADD(MINUTE, DATEDIFF(MINUTE, '1900-01-01 00:00:00', ISNULL(c.tgl_stop, '1900-01-01 00:00:00')) - DATEDIFF(MINUTE, '1900-01-01 00:00:00', ISNULL(c.tgl_mulai, '1900-01-01 00:00:00')), '1900-01-01 00:00:00'), 'HH:mm'
																						)
																				END AS lama,
																				b.point,
																				b.k_resep,
																				a.target,
																				c.bruto,
																				c.rol,
																				c.tgl_buat AS tgl_in,
																				b.tgl_buat AS tgl_out,
																				CONVERT(VARCHAR, DATEADD(DAY, -1, GETDATE()), 23) AS tgl1,
																				CONVERT(VARCHAR, GETDATE(), 23) AS tgl2
																			FROM
																				db_dying.tbl_schedule a
																				INNER JOIN db_dying.tbl_montemp c ON a.id = c.id_schedule
																				INNER JOIN db_dying.tbl_hasilcelup b ON c.id = b.id_montemp 
																			WHERE
																				a.status = 'selesai' 
																				AND (a.proses NOT LIKE 'Cuci Mesin%' OR a.proses IS NULL)
																				AND b.tgl_buat BETWEEN DATEADD(MINUTE, 15, CAST(CONVERT(VARCHAR, GETDATE(), 23) AS DATETIME)) 
																				AND DATEADD(MINUTE, 15, CAST(CONVERT(VARCHAR, DATEADD(DAY, 1, GETDATE()), 23) AS DATETIME))
																		) b ON b.no_mesin = a.no_mesin 
																) b ON b.no_mesin = a.no_mesin 
															WHERE 
																a.kapasitas > 0 
															GROUP BY 
																a.no_mesin, a.kapasitas 
															) x
															LEFT JOIN 
															(
																SELECT 
																	a.no_mesin, 
																	a.kapasitas, 
																	SUM(b.lotkeluar) AS jml 
																FROM 
																	db_dying.tbl_mesin a 
																	LEFT JOIN 
																	(
																		SELECT 
																			a.no_mesin,
																			CASE WHEN b.g_shift IS NOT NULL THEN 1 ELSE 0 END AS lotkeluar,
																			b.tgl1,
																			b.tgl2 
																		FROM 
																			db_dying.tbl_mesin a
																			LEFT JOIN 
																			(
																				SELECT
																					a.no_mesin,
																					b.g_shift,
																					b.operator_keluar AS operator,
																					a.jenis_kain,
																					a.proses,
																					a.warna,
																					a.kategori_warna, 
																					CASE 
																						WHEN c.tgl_mulai IS NULL OR c.tgl_stop IS NULL 
																						THEN b.lama_proses
																						ELSE 
																							FORMAT(
																								DATEADD(MINUTE, DATEDIFF(MINUTE, '1900-01-01 00:00:00', ISNULL(c.tgl_stop, '1900-01-01 00:00:00')) - DATEDIFF(MINUTE, '1900-01-01 00:00:00', ISNULL(c.tgl_mulai, '1900-01-01 00:00:00')), '1900-01-01 00:00:00'), 'HH:mm'
																							)
																					END AS lama,
																					b.point,
																					b.k_resep,
																					a.target,
																					c.bruto,
																					c.rol,
																					c.tgl_buat AS tgl_in,
																					b.tgl_buat AS tgl_out,
																					CONVERT(VARCHAR, DATEADD(DAY, -1, GETDATE()), 23) AS tgl1,
																					CONVERT(VARCHAR, GETDATE(), 23) AS tgl2
																				FROM
																					db_dying.tbl_schedule a
																					INNER JOIN db_dying.tbl_montemp c ON a.id = c.id_schedule
																					INNER JOIN db_dying.tbl_hasilcelup b ON c.id = b.id_montemp 
																				WHERE
																					a.status = 'selesai' 
																					AND (a.proses NOT LIKE 'Cuci Mesin%' OR a.proses IS NULL)
																					AND b.tgl_buat BETWEEN DATEADD(MINUTE, 15, CAST(CONVERT(VARCHAR, DATEADD(DAY, -1, GETDATE()), 23) AS DATETIME)) 
																					AND DATEADD(MINUTE, 15, CAST(CONVERT(VARCHAR, GETDATE(), 23) AS DATETIME))
																			) b ON b.no_mesin = a.no_mesin 
																	) b ON b.no_mesin = a.no_mesin 
																WHERE 
																	a.kapasitas > 0 
																GROUP BY 
																	a.no_mesin, a.kapasitas 
															) y ON x.no_mesin = y.no_mesin
														ORDER BY 
															x.kapasitas DESC");
						while ($rM = sqlsrv_fetch_array($sqlM)) {
							$bgcolor = ($col++ & 1) ? 'gainsboro' : 'antiquewhite';
						?>
							<tr bgcolor="<?php echo $bgcolor; ?>">
								<td align="center"><strong><?php echo  $rM['no_mesin']; ?></strong></td>
								<td align="center"><strong><?php echo  $rM['kapasitas']; ?></strong></td>
								<td align="center"><strong><?php echo  $rM['jml']; ?></strong></td>
								<td align="center"><strong><?php echo  $rM['jmlsblm']; ?></strong></td>

							</tr>
						<?php
							$totJ += $rM['jml'];
							$totJS += $rM['jmlsblm'];
						} ?>
					</tbody>
					<tfoot class="bg-blue">
						<tr>
							<td align="center">&nbsp;</td>
							<td align="center">Total</td>
							<td align="center"><?php echo $totJ; ?></td>
							<td align="center"><?php echo $totJS; ?></td>
						</tr>
					</tfoot>
				</table>

			</div>
		</div>
	</div>
</body>
<!-- Tooltips -->
<!-- jQuery 3 -->
<script src="./../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="./../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="./../dist/js/adminlte.min.js"></script>

<!-- DataTables -->
<script src="./../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="./../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- bootstrap datepicker -->
<script src="./../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
<script src="./../bower_components/toast-master/js/jquery.toast.js"></script>
<!-- Tooltips -->
<script src="./../../dist/js/tooltips.js"></script>
<script>
	$(document).ready(function() {
		$('[data-toggle="tooltip"]').tooltip();
	});
</script>
<!-- Javascript untuk popup modal Edit-->
<script type="text/javascript">
	$(document).on('click', '.detail_status', function(e) {
		var m = $(this).attr("id");
		$.ajax({
			url: "./cek-status-mesin.php",
			type: "GET",
			data: {
				id: m,
			},
			success: function(ajaxData) {
				$("#CekDetailStatus").html(ajaxData);
				$("#CekDetailStatus").modal('show', {
					backdrop: 'true'
				});
			}
		});
	});

	//            tabel lookup KO status terima
	$(function() {
		$("#lookup").dataTable();
	});
</script>
<script>
	$(document).ready(function() {
		"use strict";
		// toat popup js
		$.toast({
			heading: 'Selamat Datang',
			text: 'Dyeing Indo Taichen',
			position: 'bottom-right',
			loaderBg: '#ff6849',
			icon: 'success',
			hideAfter: 3500,
			stack: 6
		})


	});
	$(".tst1").on("click", function() {
		var msg = $('#message').val();
		var title = $('#title').val() || '';
		$.toast({
			heading: 'Info',
			text: msg,
			position: 'top-right',
			loaderBg: '#ff6849',
			icon: 'info',
			hideAfter: 3000,
			stack: 6
		});

	});
</script>

</html>