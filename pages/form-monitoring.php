<?php
// include "koneksiLAB.php";
include "koneksi.php";
//db_connect($db_name);
$nokk = $_GET['nokk'];
if ($nokk) {
	$sqlCek = sqlsrv_query($con, "SELECT TOP 1 * FROM db_dying.tbl_schedule WHERE nokk='$nokk' ORDER BY id DESC", array(), array("Scrollable" => SQLSRV_CURSOR_KEYSET));
	$cek = sqlsrv_num_rows($sqlCek);
	$rcek = sqlsrv_fetch_array($sqlCek);
}
$splitresep = explode('-', $rcek['no_resep']);
$prdorder = $splitresep[0];
$grpline = $splitresep[1];
$sqlCekWaktu = sqlsrv_query($con, "SELECT TOP 1 th.operator_keluar, th.tgl_buat as jam_stop , GETDATE() as jam_start
	FROM db_dying.tbl_hasilcelup th 
	INNER JOIN db_dying.tbl_montemp tm on th.id_montemp =tm.id
	INNER JOIN db_dying.tbl_schedule ts on tm.id_schedule =ts.id
	WHERE ts.no_mesin ='" . $rcek['no_mesin'] . "'
	ORDER BY th.id DESC");
$rcekW = sqlsrv_fetch_array($sqlCekWaktu);
$awalP = $rcekW['jam_stop']->format('H:i:s');
$akhirP = $rcekW['jam_start']->format('H:i:s');
$diffP = $akhirP - $awalP;
$tjamP = round($diffP / (60 * 60), 2);

$sqlCekMc = sqlsrv_query($con, "SELECT no_mesin, kode, waktu_tunggu,wt_des, ket FROM db_dying.tbl_mesin WHERE no_mesin='" . $rcek['no_mesin'] . "'");
$rCekMc = sqlsrv_fetch_array($sqlCekMc);
$sqlCek1 = sqlsrv_query($con, "SELECT TOP 1 * FROM db_dying.tbl_montemp WHERE nokk='$nokk' and ([status]='antri mesin' or [status]='sedang jalan') ORDER BY id DESC", array(), array("Scrollable" => SQLSRV_CURSOR_KEYSET));
$cek1 = sqlsrv_num_rows($sqlCek1);
$rcek1 = sqlsrv_fetch_array($sqlCek1);
$sqlcek2 = sqlsrv_query($con, "SELECT
--    id,
    CASE WHEN COUNT(lot) > 1 THEN 'Gabung Kartu' ELSE '' END AS ket_kartu,
    CASE WHEN COUNT(lot) > 1 THEN CONCAT('(', COUNT(lot), 'kk', ')') ELSE '' END AS kk,
    STUFF(
        (SELECT ', ' + nokk
         FROM db_dying.tbl_schedule AS s2
         WHERE s2.no_mesin = s1.no_mesin AND s2.no_urut = s1.no_urut
         FOR XML PATH('')), 1, 2, '') AS g_kk,
    no_mesin,
    no_urut,    
    SUM(rol) AS rol,
    SUM(bruto) AS bruto
FROM
    db_dying.tbl_schedule AS s1
	WHERE
	[status] <> 'selesai' and no_mesin='" . $rcek['no_mesin'] . "' and no_urut='" . $rcek['no_urut'] . "'
GROUP BY  -- Include 'id' in the GROUP BY clause to avoid errors
    no_mesin,
    no_urut", array(), array("Scrollable" => SQLSRV_CURSOR_KEYSET));
$cek2 = sqlsrv_num_rows($sqlcek2);
$rcek2 = sqlsrv_fetch_array($sqlcek2);
if ($rcek2['ket_kartu'] != "") {
	$ketsts = $rcek2['ket_kartu'] . "\n(" . $rcek2['g_kk'] . ")";
} else {
	$ketsts = "";
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
function Des2($angka)
{
	$bulat = round($angka);
	if ($bulat > $angka) {
		$n = $bulat;
		$h = $n . ".0";
	} else {
		$n = $bulat;
		$h = $n . ".5";
	}
	return $h;
}
?>
<?php


// NOW
$groupline = substr($rcek['no_resep'], 9);
$db_viewreservation = db2_exec($conn2, "SELECT * FROM VIEWPRODUCTIONRESERVATION WHERE PRODUCTIONORDERCODE = '$nokk' AND GROUPLINE = '$groupline'");
$r_viewreservation = db2_fetch_assoc($db_viewreservation);

$groupline2 = substr($rcek['no_resep2'], 9);
$db_viewreservation2 = db2_exec($conn2, "SELECT * FROM VIEWPRODUCTIONRESERVATION WHERE PRODUCTIONORDERCODE = '$nokk' AND GROUPLINE = '$groupline2'");
$r_viewreservation2 = db2_fetch_assoc($db_viewreservation2);

if (!empty($row_carryover['CARRYOVER'])) {
	$carry_over = $row_carryover['CARRYOVER'];
} else {
	$carry_over = 0;
}

$sql_ITXVIEWKK = db2_exec($conn2, "SELECT
												TRIM(PRODUCTIONORDERCODE) AS PRODUCTIONORDERCODE,
												TRIM(DEAMAND) AS DEMAND,
												ORIGDLVSALORDERLINEORDERLINE,
												PROJECTCODE,
												ORDPRNCUSTOMERSUPPLIERCODE,
												TRIM(SUBCODE01) AS SUBCODE01, TRIM(SUBCODE02) AS SUBCODE02, TRIM(SUBCODE03) AS SUBCODE03, TRIM(SUBCODE04) AS SUBCODE04,
												TRIM(SUBCODE05) AS SUBCODE05, TRIM(SUBCODE06) AS SUBCODE06, TRIM(SUBCODE07) AS SUBCODE07, TRIM(SUBCODE08) AS SUBCODE08,
												TRIM(SUBCODE09) AS SUBCODE09, TRIM(SUBCODE10) AS SUBCODE10, 
												TRIM(ITEMTYPEAFICODE) AS ITEMTYPEAFICODE,
												TRIM(DSUBCODE05) AS NO_WARNA,
												TRIM(DSUBCODE02) || '-' || TRIM(DSUBCODE03)  AS NO_HANGER,
												TRIM(ITEMDESCRIPTION) AS ITEMDESCRIPTION,
												DELIVERYDATE
											FROM 
												ITXVIEWKK 
											WHERE 
												PRODUCTIONORDERCODE = '$nokk'");
$dt_ITXVIEWKK = db2_fetch_assoc($sql_ITXVIEWKK);

$db_stdcckwarna = db2_exec($conn2, "SELECT 
                                                CASE
                                                    WHEN ic.VALUESTRING = '1' THEN 'Labdip' || ' - ' || ic2.VALUESTRING 
                                                    WHEN ic.VALUESTRING = '2' THEN 'First Lot' || ' - ' || ic2.VALUESTRING 
                                                    WHEN ic.VALUESTRING = '3' THEN 'Original' || ' - ' || ic2.VALUESTRING 
                                                    WHEN ic.VALUESTRING = '4' THEN 'Previous Order' || ' - ' || ic2.VALUESTRING 
                                                    WHEN ic.VALUESTRING = '5' THEN 'Master Color' || ' - ' || ic2.VALUESTRING 
                                                    WHEN ic.VALUESTRING = '6' THEN 'Lampiran Buyer' || ' - ' || ic2.VALUESTRING 
                                                    WHEN ic.VALUESTRING = '7' THEN 'Body' || ' - ' || ic2.VALUESTRING 
                                                END AS STANDART_COCOK_WARNA
                                            FROM 
                                                SALESORDERLINE s 
                                            LEFT JOIN ITXVIEW_COLORSTANDARD ic ON ic.UNIQUEID = s.ABSUNIQUEID 
                                            LEFT JOIN ITXVIEW_COLORREMARKS ic2 ON ic2.UNIQUEID = s.ABSUNIQUEID 
                                            WHERE 
                                                s.SALESORDERCODE = '$dt_ITXVIEWKK[PROJECTCODE]' AND ORDERLINE = '$dt_ITXVIEWKK[ORIGDLVSALORDERLINEORDERLINE]'");
$r_stdcckwarna = db2_fetch_assoc($db_stdcckwarna);
if (!empty($r_stdcckwarna['STANDART_COCOK_WARNA'])) {
	$std_cck_warna = $r_stdcckwarna['STANDART_COCOK_WARNA'];
} else {
	$std_cck_warna = '';
}

// NOW
?>
<?php
$Kapasitas = isset($_POST['kapasitas']) ? $_POST['kapasitas'] : '';
$TglMasuk = isset($_POST['tglmsk']) ? $_POST['tglmsk'] : '';
$Item = isset($_POST['item']) ? $_POST['item'] : '';
$Warna = isset($_POST['warna']) ? $_POST['warna'] : '';
$Langganan = isset($_POST['langganan']) ? $_POST['langganan'] : '';
?>
<!--alerts CSS -->
<link href="bower_components/sweetalert/sweetalert2.css" rel="stylesheet" type="text/css">
<!-- Sweet Alert -->
<script type="text/javascript" src="bower_components/sweetalert/sweetalert2.min.js"></script>
<form class="form-horizontal" action="" method="post" enctype="multipart/form-data" name="form1">
	<div class="box box-info">
		<div class="box-header with-border">
			<h3 class="box-title">Input Data Kartu Kerja</h3>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i
						class="fa fa-minus"></i></button>
			</div>
		</div>
		<div class="box-body">
			<div class="col-md-6">
				<div class="form-group">
					<label for="no_po" class="col-sm-3 control-label">No KK</label>
					<div class="col-sm-3">
						<input name="nokk" type="text" class="form-control" id="nokk"
							onchange="window.location='?p=Form-Monitoring&nokk='+this.value"
							value="<?php echo $_GET['nokk']; ?>" placeholder="No KK" required>
						<input name="id" type="hidden" class="form-control" id="id" value="<?php echo $rcek['id']; ?>"
							placeholder="ID">
					</div>
					<label for="jammasukkain" class="col-sm-2 control-label">Jam Masuk Kain</label>
					<div class="col-sm-2">
						<?php
						// Mengatur zona waktu
						date_default_timezone_set('Asia/Jakarta');

						// Mendapatkan tanggal hari ini
						$tanggal_hari_ini = date('Y-m-d');

						// Mendapatkan tanggal kemarin
						$tanggal_kemarin = date('Y-m-d', strtotime('-1 day'));
						?>
						<input name="jammasukkain" type="date" class="form-control col-sm-2" required
							min="<?php echo $tanggal_kemarin; ?>" max="<?php echo $tanggal_hari_ini; ?>">
					</div>
					<div class="col-sm-2">
						<input name="tglmasukkain" type="text" class="form-control col-sm-2" id="tglmasukkain" required
							placeholder="00:00" pattern="[0-9]{2}:[0-9]{2}$" title=" e.g 14:25" onkeyup="
																				var time = this.value;
																				if (time.match(/^\d{2}$/) !== null) {
																					this.value = time + ':';
																				} else if (time.match(/^\d{2}\:\d{2}$/) !== null) {
																					this.value = time + '';
																				}" value="<?php echo $rw['jam_in'] ?>" size="5" maxlength="5">
					</div>
				</div>
				<div class="form-group">
					<label for="langganan" class="col-sm-3 control-label">Demand</label>
					<div class="col-sm-8">
						<input name="demand" type="text" class="form-control" id="demand"
							value="<?= $rcek['nodemand']; ?>" placeholder="demand">
					</div>
				</div>
				<div class="form-group">
					<label for="langganan" class="col-sm-3 control-label">Langganan</label>
					<div class="col-sm-8">
						<input name="langganan" type="text" class="form-control" id="langganan" value="<?php if ($cek > 0) {
							echo $rcek['langganan'];
						} else {
							echo $pelanggan;
						} ?>" placeholder="Langganan">
					</div>
				</div>
				<div class="form-group">
					<label for="buyer" class="col-sm-3 control-label">Buyer</label>
					<div class="col-sm-8">
						<input name="buyer" type="text" class="form-control" id="buyer" value="<?php if ($cek > 0) {
							echo $rcek['buyer'];
						} else {
							echo $buyer;
						} ?>" placeholder="Buyer">
					</div>
				</div>
				<div class="form-group">
					<label for="no_order" class="col-sm-3 control-label">No Order</label>
					<div class="col-sm-4">
						<input name="no_order" type="text" class="form-control" id="no_order" value="<?php if ($cek > 0) {
							echo $rcek['no_order'];
						} else {
							if ($r['NoOrder'] != "") {
								echo $r['NoOrder'];
							} else if ($nokk != "") {
								echo $cekM['no_order'];
							}
						} ?>" placeholder="No Order" required>
					</div>
				</div>
				<div class="form-group">
					<label for="no_po" class="col-sm-3 control-label">PO</label>
					<div class="col-sm-5">
						<input name="no_po" type="text" class="form-control" id="no_po" value="<?php if ($cek > 0) {
							echo $rcek['po'];
						} else {
							if ($r['PONumber'] != "") {
								echo $r['PONumber'];
							} else if ($nokk != "") {
								echo $cekM['no_po'];
							}
						} ?>" placeholder="PO">
					</div>
				</div>
				<div class="form-group">
					<label for="no_hanger" class="col-sm-3 control-label">No Hanger / No Item</label>
					<div class="col-sm-3">
						<input name="no_hanger" type="text" class="form-control" id="no_hanger" value="<?php if ($cek > 0) {
							echo $rcek['no_hanger'];
						} else {
							if ($r['HangerNo']) {
								echo $r['HangerNo'];
							} else if ($nokk != "") {
								echo $cekM['no_item'];
							}
						} ?>" placeholder="No Hanger">
					</div>
					<div class="col-sm-3">
						<input name="no_item" type="text" class="form-control" id="no_item" value="<?php if ($rcek['no_item'] != "") {
							echo $rcek['no_item'];
						} else if ($r['ProductCode'] != "") {
							echo $r['ProductCode'];
						} else {
							if ($r['HangerNo']) {
								echo $r['HangerNo'];
							} else if ($nokk != "") {
								echo $cekM['no_item'];
							}
						} ?>" placeholder="No Item">
					</div>
				</div>
				<div class="form-group">
					<label for="jns_kain" class="col-sm-3 control-label">Jenis Kain</label>
					<div class="col-sm-8">
						<textarea name="jns_kain" class="form-control" id="jns_kain" placeholder="Jenis Kain"><?php if ($cek > 0) {
							echo $rcek['jenis_kain'];
						} else {
							if ($r['ProductDesc'] != "") {
								echo $r['ProductDesc'];
							} else if ($nokk != "") {
								echo $cekM['jenis_kain'];
							}
						} ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label for="tgl_delivery" class="col-sm-3 control-label">Tgl. Delivery</label>
					<div class="col-sm-4">
						<div class="input-group date">
							<div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>
							<input name="tgl_delivery" type="text" class="form-control pull-right" id="datepicker2"
								placeholder="0000-00-00" value="<?php if ($cek > 0) {
									if ($rcek['tgl_delivery'] != NULL or $rcek['tgl_delivery'] != '') {
										echo $rcek['tgl_delivery']->format('Y-m-d');
									}
								} else {
									if ($r['RequiredDate'] != "") {
										echo $r['RequiredDate']->format('Y-m-d');
									}
								} ?>" required />
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="l_g" class="col-sm-3 control-label">L X Grm Permintaan</label>
					<div class="col-sm-2">
						<input name="lebar" type="text" class="form-control" id="lebar" value="<?php if ($cek > 0) {
							echo $rcek['lebar'];
						} else {
							echo round($r['Lebar']);
						} ?>" placeholder="0" required>
					</div>
					<div class="col-sm-2">
						<input name="grms" type="text" class="form-control" id="grms" value="<?php if ($cek > 0) {
							echo $rcek['gramasi'];
						} else {
							echo round($r['Gramasi']);
						} ?>" placeholder="0" onChange="hitungp();" required>
					</div>
				</div>
				<div class="form-group">
					<label for="warna" class="col-sm-3 control-label">Warna</label>
					<div class="col-sm-8">
						<input name="warna" type="text" class="form-control" id="warna" value="<?php if ($cek > 0) {
							echo $rcek['warna'];
						} else {
							if ($r['Color'] != "") {
								echo $r['Color'];
							} else if ($nokk != "") {
								echo $cekM['warna'];
							}
						} ?>" placeholder="Warna">
					</div>
				</div>
				<div class="form-group">
					<label for="no_warna" class="col-sm-3 control-label">No Warna</label>
					<div class="col-sm-8">
						<input name="no_warna" type="text" class="form-control" id="no_warna" value="<?php if ($cek > 0) {
							echo $rcek['no_warna'];
						} else {
							if ($r['ColorNo'] != "") {
								echo $r['ColorNo'];
							} else if ($nokk != "") {
								echo $cekM['no_warna'];
							}
						} ?>" placeholder="No Warna">
					</div>
				</div>
				<div class="form-group">
					<label for="qty_order" class="col-sm-3 control-label">Qty Order</label>
					<div class="col-sm-3">
						<div class="input-group">
							<input name="qty1" type="text" class="form-control" id="qty1" value="<?php if ($cek > 0) {
								echo $rcek['qty_order'];
							} else {
								echo round($r['BatchQuantity'], 2);
							} ?>" placeholder="0.00" required>
							<span class="input-group-addon">KGs</span>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="input-group">
							<input name="qty2" type="text" class="form-control" id="qty2" value="<?php if ($cek > 0) {
								echo $rcek['pjng_order'];
							} else {
								echo round($r['Quantity'], 2);
							} ?>" placeholder="0.00" style="text-align: right;" required>
							<span class="input-group-addon">
								<select name="satuan1" style="font-size: 12px;">
									<option value="Yard" <?php if ($rcek['satuan_order'] == "Yard") {
										echo "SELECTED";
									} ?>>Yard</option>
									<option value="Meter" <?php if ($rcek['satuan_order'] == "Meter") {
										echo "SELECTED";
									} ?>>Meter</option>
									<option value="PCS" <?php if ($rcek['satuan_order'] == "PCS") {
										echo "SELECTED";
									} ?>>PCS</option>
								</select>
							</span>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="lot" class="col-sm-3 control-label">Lot</label>
					<div class="col-sm-2">
						<input name="lot" type="text" class="form-control" id="lot" value="<?php if ($cek > 0) {
							echo $rcek['lot'];
						} else {
							if ($nomorLot != "") {
								echo $lotno;
							} else if ($nokk != "") {
								echo $cekM['lot'];
							}
						} ?>" placeholder="Lot">
					</div>
				</div>
				<div class="form-group">
					<label for="jml_bruto" class="col-sm-3 control-label">Rol &amp; Qty</label>
					<div class="col-sm-2">
						<input name="qty3" type="text" class="form-control" id="qty3" value="<?php if ($cek2 > 0) {
							echo $rcek2['rol'] . $rcek2['kk'];
						} ?>" placeholder="0.00" required>
					</div>
					<div class="col-sm-3">
						<div class="input-group">
							<input name="qty4" type="text" class="form-control" id="qty4" value="<?php if ($cek2 > 0) {
								echo $rcek2['bruto'];
							} ?>" placeholder="0.00" style="text-align: right;" required>
							<span class="input-group-addon">KGs</span>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="pjng_kain" class="col-sm-3 control-label">Panjang Kain</label>
					<div class="col-sm-3">
						<input name="pjng_kain" type="text" class="form-control" id="pjng_kain" value="<?php if ($cek > 0) {
							echo $rcek2['pnjg_kain'];
						} ?>" placeholder="0.00" style="text-align: right;" readonly>
					</div>
					<div class="col-sm-3">
						<input name="pjng_kain_perlubang" type="text" class="form-control" id="pjng_kain_perlubang"
							value="<?php if ($cek > 0) {
								echo $rcek2['pjng_kain_perlubang'];
							} ?>" placeholder="0.00" style="text-align: right;" readonly>
					</div>
				</div>
				<?php if ($cek > 0 and $_GET['kap'] != "") {
					$loading = round($rcek2['bruto'] / $_GET['kap'], 4) * 100;
				} else {
					if ($r['Weight'] != "" and $_GET['kap'] != "") {
						$loading = round($r['Weight'] / $_GET['kap'], 4) * 100;
					} else if ($nokk != "" and $_GET['kap'] != "") {
						$loading = round($cekM['bruto'] / $_GET['kap'], 4) * 100;
					}
				} ?>
				<div class="form-group">
					<label for="kapasitas" class="col-sm-3 control-label">Kapasitas Mesin</label>
					<div class="col-sm-3">
						<select name="kapasitas" class="form-control">
							<option value="">Pilih</option>
							<?php
							$sqlKap = sqlsrv_query($con, "SELECT kapasitas FROM db_dying.tbl_mesin GROUP BY kapasitas ORDER BY kapasitas DESC");
							while ($rK = sqlsrv_fetch_array($sqlKap)) {
								?>
								<option value="<?php echo $rK['kapasitas']; ?>" <?php if ($rcek['kapasitas'] == $rK['kapasitas']) {
									   echo "SELECTED";
								   } ?>><?php echo $rK['kapasitas']; ?> KGs</option>
							<?php } ?>
						</select>
					</div>

				</div>
				<?php if ($cek > 0 and $rcek['kapasitas'] != "" and $rcek['kapasitas'] != "0") {
					if ($rcek['kapasitas'] == 0) {
						$loading = 0;
					}
					$loading = round($rcek2['bruto'] / $rcek['kapasitas'], 4) * 100;
				} else {
					if ($r['Weight'] != "" and $rcek['kapasitas'] != "") {
						$loading = round($r['Weight'] / $rcek['kapasitas'], 4) * 100;
					} else if ($nokk != "" and $rcek['kapasitas'] != "") {
						$loading = round($cekM['bruto'] / $rcek['kapasitas'], 4) * 100;
					}
				} ?>
				<div class="form-group">
					<label for="no_mc" class="col-sm-3 control-label">No MC</label>
					<div cltbl_jenis_prosesass="col-sm-2">
						<select name="no_mc" class="form-control">
							<option value="">Pilih</option>
							<?php
							$sqlKap = sqlsrv_query($con, "SELECT no_mesin FROM db_dying.tbl_mesin WHERE kapasitas='$rcek[kapasitas]' ORDER BY no_mesin ASC");
							while ($rK = sqlsrv_fetch_array($sqlKap)) {
								?>
								<option value="<?php echo $rK['no_mesin']; ?>" <?php if ($rcek['no_mesin'] == $rK['no_mesin']) {
									   echo "SELECTED";
								   } ?>><?php echo $rK['no_mesin']; ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-sm-4"> <?php if ($rCekMc['kode'] != "") {
						echo $rCekMc['kode'] . "&nbsp; (Std Tunggu: " . $rCekMc['wt_des'] . " Jam)";
					} ?></div>

				</div>
				<div class="form-group">
					<label for="loading" class="col-sm-3 control-label">Loading</label>
					<div class="col-sm-3">
						<div class="input-group">
							<input name="loading" type="text" style="text-align: right;" class="form-control"
								id="loading" value="<?php if ($_GET['nokk'] != "" and $rcek['kapasitas'] != "") {
									echo $loading;
								} ?>" placeholder="0.00">
							<span class="input-group-addon">%</span>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="wkt" class="col-sm-3 control-label">Waktu</label>
					<div class="col-sm-3">
						<div class="input-group">
							<input name="wkt" type="text" style="text-align: right;" class="form-control" id="wkt"
								value="<?php if ($_GET['nokk'] != "" and $rcek['kapasitas'] != "") {
									echo $tjamP;
								} ?>" placeholder="0.00" readonly>
							<span class="input-group-addon">jam</span>
						</div>
					</div>
					<label for="oper_shift" class="col-sm-1 control-label">OperShift</label>
					<div class="col-sm-3">
						<input name="oper_shift" type="text" class="form-control" id="oper_shift" value="<?php if ($_GET['nokk'] != "" and $rcek['kapasitas'] != "") {
							echo $rcekW['operator_keluar'];
						} ?>" placeholder="Nama Operator" readonly>
					</div>
				</div>
				<div class="form-group">
					<label for="nokk_legacy" class="col-sm-3 control-label">KK Legacy</label>
					<div class="col-sm-4">
						<input name="nokk_legacy" type="text" class="form-control" id="nokk_legacy"
							value="<?= $rcek['nokk_legacy']; ?>" placeholder="KK Legacy">
					</div>
				</div>
				<?php if ($tjamP > $rCekMc['wt_des'] and $rCekMc['wt_des'] != "") { ?>
					<div class="form-group">
						<label for="ket" class="col-sm-3 control-label">Analisa Waktu Tunggu</label>
						<div class="col-sm-8">
							<div class="input-group">
								<select class="form-control select2" multiple="multiple" data-placeholder="Analisa"
									name="note_wt[]" id="note_wt" required>
									<option value="">Pilih</option>
									<?php
									$dtArr = $rcek1['analisa'];
									$data = explode(",", $dtArr);
									$qCek1 = sqlsrv_query($con, "SELECT analisa FROM db_dying.tbl_analisa_mesin_tunggu ORDER BY analisa ASC");
									$i = 0;
									while ($dCek1 = sqlsrv_fetch_array($qCek1)) { ?>
										<option value="<?php echo $dCek1['analisa']; ?>" <?php if ($dCek1['analisa'] == $data[0] or $dCek1['analisa'] == $data[1] or $dCek1['analisa'] == $data[2] or $dCek1['analisa'] == $data[3] or $dCek1['analisa'] == $data[4] or $dCek1['analisa'] == $data[5]) {
											   echo "SELECTED";
										   } ?>><?php echo $dCek1['analisa']; ?></option>
										<?php $i++;
									} ?>
								</select>
								<span class="input-group-btn"><button type="button" class="btn btn-default"
										data-toggle="modal" data-target="#DataAnalisa"> ...</button></span>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
			<!-- col -->
			<div class="col-md-6">
				<div class="form-group">
					<label for="no_resep" class="col-sm-3 control-label">No Bon Resep 1</label>
					<div class="col-sm-3">
						<input name="no_resep" type="text" class="form-control" id="no_resep" value="<?php if ($cek > 0) {
							echo $rcek['no_resep'];
						} ?>" placeholder="No Bon Resep 1">
					</div>
					<div class="col-sm-3">
						<input name="suffix" type="text" class="form-control" id="suffix"
							value="<?= $rcek['suffix']; ?>" placeholder="Suffix 1">
					</div>
				</div>
				<div class="form-group">
					<label for="no_resep2" class="col-sm-3 control-label">No Bon Resep 2</label>
					<div class="col-sm-3">
						<input name="no_resep2" type="text" class="form-control" id="no_resep2" value="<?php if ($cek > 0) {
							echo $rcek['no_resep2'];
						} ?>" placeholder="No Bon Resep 2">
					</div>
					<div class="col-sm-3">
						<input name="suffix2" type="text" class="form-control" id="suffix"
							value="<?= $rcek['suffix2']; ?>" placeholder="Suffix 1">
					</div>
				</div>
				<div class="form-group">
					<label for="a_dingin" class="col-sm-3 control-label">Pemakaian Air</label>
					<div class="col-sm-3">
						<div class="input-group">
							<?php
							if ($r_viewreservation['PICKUPQUANTITY'] == 0) {
								$LR = $r_viewreservation2['PICKUPQUANTITY'];
							} else {
								$LR = $r_viewreservation['PICKUPQUANTITY'];
							}
							?>
							<input name="pakai_air" type="text" class="form-control" id="pakai_air"
								value="<?= round($LR * $rcek['qty_order'], 2); ?>" placeholder="0.00"
								style="text-align: right;">
							<span class="input-group-addon">L</span>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="carry_over" class="col-sm-3 control-label">Carry Over</label>
					<div class="col-sm-3">
						<div class="input-group">
							<input name="carry_over" type="text" style="text-align: right;" class="form-control"
								id="carry_over"
								value="<?= $carry_over; ?><?php echo str_replace("%", "", trim($row['USER25'])); ?>"
								placeholder="0.00">
							<span class="input-group-addon">%</span>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="benang" class="col-sm-3 control-label">Benang</label>
					<div class="col-sm-8">
						<input name="benang" type="text" class="form-control" id="benang" value="<?php echo $bng; ?>"
							placeholder="Benang">
					</div>
				</div>
				<div class="form-group">
					<label for="std_cok_wrn" class="col-sm-3 control-label">Standar Cocok Warna</label>
					<div class="col-sm-6">
						<input name="std_cok_wrn" type="text" class="form-control" id="std_cok_wrn" value="<?= $std_cck_warna; ?><?php if ($ssr['Flag'] == " 1") {
							  echo "Original Color";
						  } elseif ($ssr['Flag'] == "2") {
							  echo "Color LD";
						  } else {
							  echo $ssr['OtherDesc'];
						  } ?>" placeholder="Standar Cocok Warna">
					</div>
				</div>
				<div class="form-group">
					<label for="shift" class="col-sm-3 control-label">Shift</label>
					<div class="col-sm-2">
						<select name="shift" class="form-control" required>
							<option value="">Pilih</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
						</select>
					</div>

				</div>
				<div class="form-group">
					<label for="g_shift" class="col-sm-3 control-label">Group Shift</label>
					<div class="col-sm-2">
						<select name="g_shift" class="form-control" required>
							<option value="">Pilih</option>
							<option value="A">A</option>
							<option value="B">B</option>
							<option value="C">C</option>
						</select>
					</div>

				</div>
				<div class="form-group">
					<label for="operator" class="col-sm-3 control-label">Operator </label>
					<div class="col-sm-3">
						<select name="operator" class="form-control" required>
							<option value="">Pilih</option>
							<?php
							$sqlKap = sqlsrv_query($con, "SELECT nama FROM db_dying.tbl_staff WHERE jabatan='Operator' ORDER BY nama ASC");
							while ($rK = sqlsrv_fetch_array($sqlKap)) {
								?>
								<option value="<?php echo $rK['nama']; ?>"><?php echo $rK['nama']; ?></option>
							<?php } ?>
						</select>
					</div>
					<label class="col-sm-2 control-label">Kategori Resep </label>
					<div class="col-sm-3">
						<select name="kategori_resep" class="form-control">
							<option value="">Pilih</option>
							<option value="Setting Resep">Setting Resep</option>
							<option value="Resep Matching">Resep Matching</option>
						</select>
					</div>

				</div>
				<div class="form-group">
					<label for="colorist" class="col-sm-3 control-label">Colorist </label>
					<div class="col-sm-3">
						<select name="colorist" class="form-control" required>
							<option value="">Pilih</option>
							<?php
							$sqlKap = sqlsrv_query($con, "SELECT nama FROM db_dying.tbl_staff WHERE jabatan='Colorist' or jabatan='SPV' ORDER BY nama ASC");
							while ($rK = sqlsrv_fetch_array($sqlKap)) {
								?>
								<option value="<?php echo $rK['nama']; ?>"><?php echo $rK['nama']; ?></option>
							<?php } ?>
						</select>
					</div>
					<label for="colorist" class="col-sm-2 control-label">Kasih Resep </label>
					<div class="col-sm-3">
						<select name="kasih_resep" class="form-control">
							<option value="">Pilih</option>
							<?php
							$q_kasihresep = sqlsrv_query($con, "SELECT * FROM db_dying.tbl_nama_colorist ORDER BY id ASC");
							while ($row_kasihresep = sqlsrv_fetch_array($q_kasihresep)) {
								?>
								<option value="<?= $row_kasihresep['nama_colorist']; ?>">
									<?= $row_kasihresep['nama_colorist']; ?>
								</option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="leader" class="col-sm-3 control-label">Leader </label>
					<div class="col-sm-3">
						<select name="leader" class="form-control" required>
							<option value="">Pilih</option>
							<?php
							$sqlKap = sqlsrv_query($con, "SELECT nama FROM db_dying.tbl_staff WHERE jabatan='Leader' ORDER BY nama ASC");
							while ($rK = sqlsrv_fetch_array($sqlKap)) {
								?>
								<option value="<?php echo $rK['nama']; ?>"><?php echo $rK['nama']; ?></option>
							<?php } ?>
						</select>
					</div>
					<label for="colorist" class="col-sm-2 control-label">ACC Resep </label>
					<div class="col-sm-3">
						<select name="acc_resep" class="form-control">
							<option value="">Pilih</option>
							<?php
							$q_accresep = sqlsrv_query($con, "SELECT * FROM db_dying.tbl_nama_colorist ORDER BY id ASC");
							while ($row_accresep = sqlsrv_fetch_array($q_accresep)) {
								?>
								<option value="<?= $row_accresep['nama_colorist']; ?>">
									<?= $row_accresep['nama_colorist']; ?>
								</option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="a_dingin" class="col-sm-3 control-label">No. Program</label>
					<div class="col-sm-3">
						<input name="no_program" type="text" class="form-control" id="no_program" value=""
							placeholder="No. Program">

					</div>
				</div>
				<div class="form-group">
					<label for="l_g" class="col-sm-3 control-label">L X Grm Aktual Dye</label>
					<div class="col-sm-2">
						<input name="lebar_a" type="text" class="form-control" id="lebar_a" value="" placeholder="0"
							required maxlength="2">
					</div>
					<div class="col-sm-2">
						<input name="grms_a" type="text" class="form-control" id="grms_a" value="" placeholder="0"
							required onChange="hitung();" maxlength="3">
					</div>
				</div>
				<div class="form-group">
					<label for="grm_fin" class="col-sm-3 control-label">L X Grm Aktual Fin</label>
					<div class="col-sm-2">
						<input name="lebar_fin" type="text" class="form-control" id="lebar_fin" value="" placeholder="0"
							maxlength="2">
					</div>
					<div class="col-sm-2">
						<input name="grm_fin" type="text" class="form-control" id="grm_fin" value="" placeholder="0"
							maxlength="3">
					</div>
				</div>
				<!-- <div class="form-group">
					<label for="grm_dye" class="col-sm-3 control-label">L X Grm Aktual Dye</label>
					<div class="col-sm-2">
						<input name="grm_dye" type="text" class="form-control" id="grm_dye" value="" placeholder="0">
					</div>
				</div> -->
				<!--  
					<div class="form-group">
							<label for="tgl_buat" class="col-sm-3 control-label">Jam Masuk Kain</label>
							<div class="col-sm-3">
							<div class="input-group">
								<input type="text" class="form-control timepicker" name="waktu_buat" id="waktu_buat" placeholder="00:00" required>				  
								<div class="input-group-addon">
								<i class="fa fa-clock-o"></i>
							</div>
							</div>
						</div>	  
							<div class="col-sm-4">					  
									<div class="input-group date">
						<div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>
						<input name="tgl_buat" type="text" class="form-control pull-right" id="datepicker3" placeholder="0000-00-00" value="" required/>
					</div>
							</div>
								
					</div>
				-->
				<div class="form-group">
					<label for="a_dingin" class="col-sm-3 control-label">L:R</label>
					<div class="col-sm-2">
						<input name="l_r" type="text" class="form-control" id="l_r" value="<?php if ($nokk != "") {
							echo "1:" . round($r_viewreservation['PICKUPQUANTITY'], 2);
						} ?>" placeholder="L:R 1">
					</div>
					<div class="col-sm-2">
						<input name="l_r2" type="text" class="form-control" id="l_r2" value="<?php if ($nokk != "") {
							echo "1:" . round($r_viewreservation2['PICKUPQUANTITY'], 2);
						} ?>" placeholder="L:R 2">
					</div>
					<label for="gabung" class="col-sm-2 control-label">Gabung Celup</label>
					<div class="col-sm-2">
						<select name="gabung" class="form-control">
							<option value="">Pilih</option>
							<option value="ngekor">ngekor</option>
							<option value="beda lubang">beda lubang</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="a_dingin" class="col-sm-3 control-label">Cycle Time</label>
					<div class="col-sm-3">
						<div class="input-group">
							<input name="cycle_time" type="text" class="form-control" id="cycle_time" value=""
								placeholder="0" style="text-align: right;">
							<span class="input-group-addon">dtk</span>
						</div>
					</div>
					<label for="masukkain" class="col-sm-2 control-label">Masuk Kain</label>
					<div class="col-sm-2">
						<select name="masukkain" class="form-control" required>
							<option value="">Pilih</option>
							<option value="satu kepala">Satu Kepala</option>
							<option value="dua kepala">Dua Kepala</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="rpm" class="col-sm-3 control-label">RPM</label>
					<div class="col-sm-2">
						<input name="rpm" type="text" class="form-control" id="rpm" value="" placeholder="0"
							style="text-align: right;">
					</div>
					<div class="col-sm-2">
						<input name="lb1" type="text" class="form-control" id="lb1" value="" placeholder="LB1" required
							onChange="hitung();">
					</div>
					<div class="col-sm-2">
						<input name="lb2" type="text" class="form-control" id="lb2" value="" placeholder="LB2"
							onChange="hitung();">
					</div>
					<div class="col-sm-2">
						<input name="lb3" type="text" class="form-control" id="lb3" value="" placeholder="LB3"
							onChange="hitung();">
					</div>
				</div>
				<div class="form-group">
					<label for="a_dingin" class="col-sm-3 control-label">Tekanan</label>
					<div class="col-sm-2">
						<input name="tekanan" type="text" class="form-control" id="tekanan" value="" placeholder="0"
							style="text-align: right;">
					</div>
					<div class="col-sm-2">
						<input name="lb4" type="text" class="form-control" id="lb4" value="" placeholder="LB4"
							onChange="hitung();">
					</div>
					<div class="col-sm-2">
						<input name="lb5" type="text" class="form-control" id="lb5" value="" placeholder="LB5"
							onChange="hitung();">
					</div>
					<div class="col-sm-2">
						<input name="lb6" type="text" class="form-control" id="lb6" value="" placeholder="LB6"
							onChange="hitung();">
					</div>
				</div>
				<div class="form-group">
					<label for="a_dingin" class="col-sm-3 control-label">&empty; Nozzle</label>
					<div class="col-sm-3">
						<select name="nozzle" class="form-control" required>
							<option value="">Pilih</option>
							<?php
							$sqlNoz = sqlsrv_query($con, "SELECT nilai,satuan FROM db_dying.tbl_nozzle ORDER BY nilai ASC");
							while ($rN = sqlsrv_fetch_array($sqlNoz)) {
								?>
								<option value="<?php echo $rN['nilai']; ?>">
									<?php echo $rN['nilai'] . " " . $rN['satuan']; ?>
								</option>
							<?php } ?>
						</select>
					</div>
					<div class="col-sm-2">
						<input name="lb7" type="text" class="form-control" id="lb7" value="" placeholder="LB7"
							onChange="hitung();">
					</div>
					<div class="col-sm-2">
						<input name="lb8" type="text" class="form-control" id="lb8" value="" placeholder="LB8"
							onChange="hitung();">
					</div>
				</div>
				<div class="form-group">
					<label for="blower" class="col-sm-3 control-label">Blower</label>
					<div class="col-sm-3">
						<div class="input-group">
							<input name="blower" type="text" class="form-control" id="blower" value="" placeholder="0"
								style="text-align: right;" required>
							<span class="input-group-addon">%</span>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="plaiter" class="col-sm-3 control-label">Plaiter</label>
					<div class="col-sm-3">
						<select name="plaiter" class="form-control" required>
							<option value="">Pilih</option>
							<option value="-">-</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
						</select>
					</div>
					<div class="col-sm-3">
						<input name="air_awal" type="text" class="form-control" id="air_awal" value="<?php if ($rCekMc['kode'] == "THEN") {
							echo "0";
						} ?>" placeholder="Air Awal" <?php if ($rCekMc['kode'] == "THEN") {
							echo "readonly";
						} else {
							echo "required";
						} ?> pattern=".*\S.*" style="text-align: right;" maxlength="12">
					</div>
				</div>
				<!--  
					<div class="form-group">
					<label for="a_dingin" class="col-sm-3 control-label">pH Cuci Bulu</label>
					<div class="col-sm-2">
								<input name="ph_cb" type="text" class="form-control" id="ph_cb" 
								value="" placeholder="0" style="text-align: right;">
							</div>				   
					</div>  
					<div class="form-group">
					<label for="a_dingin" class="col-sm-3 control-label">Suhu Tes pH Cuci Bulu</label>
					<div class="col-sm-2">
								<div class="input-group">  
								<input name="suhu_cb" type="text" class="form-control" id="suhu_cb" 
								value="" placeholder="0" style="text-align: right;">
								<span class="input-group-addon">&deg;</span></div>  
							</div>				   
					</div>
					<div class="form-group">
					<label for="a_dingin" class="col-sm-3 control-label">pH Poly</label>
					<div class="col-sm-2">
								<input name="ph_poly" type="text" class="form-control" id="ph_poly" 
								value="" placeholder="0" style="text-align: right;">
							</div>				   
					</div>  
					<div class="form-group">
							<label for="a_dingin" class="col-sm-3 control-label">Suhu Tes pH Poly</label>
					<div class="col-sm-2">
								<div class="input-group">  
								<input name="suhu_poly" type="text" class="form-control" id="suhu_poly" 
								value="" placeholder="0" style="text-align: right">
								<span class="input-group-addon">&deg;</span></div>  
							</div>				   
					</div>
					<div class="form-group">
					<label for="a_dingin" class="col-sm-3 control-label">pH Cotton</label>
					<div class="col-sm-2">
								<input name="ph_cott" type="text" class="form-control" id="ph_cott" 
								value="" placeholder="0" style="text-align: right;">
							</div>				   
					</div>
					<div class="form-group">
					<label for="a_dingin" class="col-sm-3 control-label">Suhu Tes pH Cotton</label>
					<div class="col-sm-2">
								<div class="input-group">  
								<input name="suhu_cott" type="text" class="form-control" id="suhu_cott" 
								value="" placeholder="0" style="text-align: right">
								<span class="input-group-addon">&deg;</span></div> 
							</div>				   
					</div>
					<div class="form-group">
					<label for="a_dingin" class="col-sm-3 control-label">Berat Jenis</label>
					<div class="col-sm-2">
								<input name="berat_jns" type="text" class="form-control" id="berat_jns" 
								value="" placeholder="0" style="text-align: right;">
							</div>				   
					</div>
					<div class="form-group">
					<label for="a_dingin" class="col-sm-3 control-label">pH Na<sub>2</sub>CO<sub>3</sub></label>
					<div class="col-sm-2">
								<input name="ph_naco" type="text" class="form-control" id="ph_naco" 
								value="" placeholder="0" style="text-align: right;">
							</div>				   
					</div>
				-->
				<div class="form-group">
					<label for="ket" class="col-sm-3 control-label">Catatan</label>
					<div class="col-sm-8">
						<textarea name="ket" class="form-control"><?php echo $ketsts; ?> <?php ?></textarea>
					</div>

				</div>
			</div>


			<input type="hidden" value="<?php if ($cek > 0) {
				echo $rcek['no_ko'];
			} else {
				echo $rKO['KONo'];
			} ?>" name="no_ko">
			<input type="hidden" value="<?php if ($cek > 0) {
				echo cekDesimal($rcek['target']);
			} else {
				echo cekDesimal($rKO['target']);
			} ?>" name="target">

		</div>
		<div class="box-footer">
			<button type="button" class="btn btn-default pull-left" name="back" value="kembali"
				onClick="window.location='?p=Monitoring-Tempelan'">Kembali <i
					class="fa fa-arrow-circle-o-left"></i></button>
			<?php
			if ($_GET['nokk']) {
				if ($rcek['target'] == '0.00' or empty($rcek['target'])) {
					echo "<script>swal({
								title: 'Standart target harus di isi terlebih dahulu ! ',
								text: 'Klik Ok untuk input kembali',
								type: 'warning',
								allowOutsideClick: false, 
            					allowEscapeKey: false,    
								}).then((result) => {
									if (result.value) {
										window.location='index1.php?p=Schedule';
									}
								});
							</script>";
				}
			}
			?>
			<?php if ($cek1 > 0) {
				echo "<script>swal({
								title: 'No Kartu Sudah diinput dan belum selesai proses',
								text: 'Klik Ok untuk input kembali',
								type: 'warning',
								allowOutsideClick: false, 
            					allowEscapeKey: false,
								}).then((result) => {
								if (result.value) {
									window.location='index1.php?p=Form-Monitoring';
								}
								});</script>";
			} else if ($rcek['no_urut'] != "1" and $nokk != "") {
				echo "<script>swal({
							title: 'Harus No Urut `1` ',
							text: 'Klik Ok untuk input kembali',
							type: 'warning',
							allowOutsideClick: false, 
            				allowEscapeKey: false,
							}).then((result) => {
								if (result.value) {
									window.location='index1.php?p=Form-Monitoring';
								}
							});
						</script>";
				?>
			<?php } else { ?>
					<button type="submit" class="btn btn-primary pull-right" name="save" value="save">Simpan <i
							class="fa fa-save"></i></button>
			<?php } ?>

		</div>
		<!-- /.box-footer -->
	</div>
</form>
<div class="modal fade" id="DataAnalisa">
	<div class="modal-dialog ">
		<div class="modal-content">
			<form class="form-horizontal" name="modal_popup" data-toggle="validator" method="post" action=""
				enctype="multipart/form-data">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Analisa Data Mesin Idle</h4>
				</div>
				<div class="modal-body">
					<input type="hidden" id="id" name="id">
					<div class="form-group">
						<label for="analisa1" class="col-md-3 control-label">Analisa</label>
						<div class="col-md-6">
							<input type="text" class="form-control" id="analisa1" name="analisa1" required>
							<span class="help-block with-errors"></span>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
					<input type="submit" value="Simpan" name="simpan_analisa" id="simpan_analisa"
						class="btn btn-primary pull-right">
				</div>
			</form>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<?php
if ($_POST['simpan_analisa'] == "Simpan") {
	$ket = strtoupper($_POST['analisa1']);
	$sqlData1 = sqlsrv_query($con, "INSERT INTO db_dying.tbl_analisa_mesin_tunggu (analisa) VALUES ($ket)");
	if ($sqlData1) {
		echo "<script>swal({
					title: 'Data Telah Tersimpan',   
					text: 'Klik Ok untuk input data kembali',
					type: 'success',
					allowOutsideClick: false, 
            		allowEscapeKey: false,
					}).then((result) => {
					if (result.value) {
							window.location.href='?p=Form-Monitoring&nokk=" . $_GET['nokk'] . "';
						
					}
					});</script>";
	}
}
?>
<?php
if ($_POST['save'] == "save") {
	$warna = str_replace("'", "''", $_POST['warna']);
	$nowarna = str_replace("'", "''", $_POST['no_warna']);
	$jns = str_replace("'", "''", $_POST['jns_kain']);
	$po = str_replace("'", "''", $_POST['no_po']);
	$benang = str_replace("'", "''", $_POST['benang']);
	$lot = trim($_POST['lot']);
	$tglbuat = $_POST['tgl_buat'] . " " . $_POST['waktu_buat'];
	$note1 = str_replace("'", "''", $_POST['note_wt']);
	if (isset($_POST['note_wt'])) {
		// Retrieving each selected option 
		foreach ($note1 as $index => $subject1) {
			if ($index > 0) {
				$jk1 = $jk1 . "," . $subject1;
			} else {
				$jk1 = $subject1;
			}
		}
	}

	$sqlCekWaktu1 = sqlsrv_query($con, "SELECT TOP 1 th.tgl_buat as jam_stop ,GETDATE() as jam_start
											FROM db_dying.tbl_hasilcelup th 
											INNER JOIN db_dying.tbl_montemp tm on th.id_montemp =tm.id
											INNER JOIN db_dying.tbl_schedule ts on tm.id_schedule =ts.id
											WHERE ts.no_mesin ='" . $_POST['no_mc'] . "'
											ORDER BY th.id DESC");
	$rcekW1 = sqlsrv_fetch_array($sqlCekWaktu1);
	$awalP1 = $rcekW1['jam_stop']->format('H:i:s');
	$akhirP1 = $rcekW1['jam_start']->format('H:i:s');
	$diffP1 = ($akhirP1 - $awalP1);
	$tjamP1 = round($diffP1 / (60 * 60), 2);


	// Retrieve and format POST data
	$jammasukkain = $_POST['jammasukkain']; //Ini ternyata tanggal
	$tglmasukkain = $_POST['tglmasukkain']; // Ini ternyata jam
	$targetMinutes = intval($_POST['target']); // Ensure target is an integer

	// Combine date and time
	$tgl_buatdt = $jammasukkain . ' ' . $tglmasukkain;

	// Calculate target date using PHP DateTime
	$dateTime = new DateTime($tgl_buatdt);
	$dateTime->add(new DateInterval("PT{$targetMinutes}M"));
	$tgl_targetdt = $dateTime->format('Y-m-d H:i:s');

	// Additional datetime fields
	$jammasukkaindt = $tgl_buatdt;
	$tgl_updatedt = (new DateTime())->format('Y-m-d H:i:s');

	// $pakaiair = ROUND($_POST['pakai_air']);



	// Prepare data untuk input apabila tidak diisi maka null 
	if ($_POST['id'] != NULL or $_POST['id'] != '') {
		$id = $_POST['id'];
	} else {
		$id = NULL;
	}
	//Handling demand
	if ($_POST['demand'] != NULL or $_POST['demand'] != '') {
		$demand = $_POST['demand'];
	} else {
		$demand = NULL;
	}
	// Handling nokk
	if ($_POST['nokk'] != NULL or $_POST['nokk'] != '') {
		$nokk = $_POST['nokk'];
	} else {
		$nokk = NULL;
	}
	// Handling operator
	if ($_POST['operator'] != NULL or $_POST['operator'] != '') {
		$operator = $_POST['operator'];
	} else {
		$operator = NULL;
	}
	// Handling colorist
	if ($_POST['colorist'] != NULL or $_POST['colorist'] != '') {
		$colorist = $_POST['colorist'];
	} else {
		$colorist = NULL;
	}
	// Handling Leader
	if ($_POST['leader'] != NULL or $_POST['leader'] != '') {
		$leader = $_POST['leader'];
	} else {
		$leader = NULL;
	}
	// Handling pakai_air
	if ($_POST['pakai_air'] != NULL or $_POST['pakai_air'] != '') {
		$pakai_air = ROUND($_POST['pakai_air']);
	} else {
		$pakai_air = NULL;
	}
	// Handling carry_over
	if ($_POST['carry_over'] != NULL or $_POST['carry_over'] != '') {
		$carry_over = $_POST['carry_over'];
	} else {
		$carry_over = NULL;
	}
	// Handling shift
	if ($_POST['shift'] != NULL or $_POST['shift'] != '') {
		$shift = $_POST['shift'];
	} else {
		$shift = NULL;
	}
	// Handling grms_a
	if ($_POST['grms_a'] != NULL or $_POST['grms_a'] != '') {
		$grms_a = $_POST['grms_a'];
	} else {
		$grms_a = NULL;
	}
	// Handling lebar_a
	if ($_POST['lebar_a'] != NULL or $_POST['lebar_a'] != '') {
		$lebar_a = $_POST['lebar_a'];
	} else {
		$lebar_a = NULL;
	}
	// Handling pjng_kain
	if ($_POST['pjng_kain'] != NULL or $_POST['pjng_kain'] != '') {
		$pjng_kain = $_POST['pjng_kain'];
	} else {
		$pjng_kain = NULL;
	}
	// Handling pjng_kain_perlubang
	if ($_POST['pjng_kain_perlubang'] != NULL or $_POST['pjng_kain_perlubang'] != '') {
		$pjng_kain_perlubang = $_POST['pjng_kain_perlubang'];
	} else {
		$pjng_kain_perlubang = NULL;
	}
	// Handling qty3
	if ($_POST['qty3'] != NULL or $_POST['qty3'] != '') {
		$qty3 = $_POST['qty3'];
	} else {
		$qty3 = NULL;
	}
	// Handling qty4
	if ($_POST['qty4'] != NULL or $_POST['qty4'] != '') {
		$qty4 = $_POST['qty4'];
	} else {
		$qty4 = NULL;
	}
	// Handling nokk_legacy
	if ($_POST['nokk_legacy'] != NULL or $_POST['nokk_legacy'] != '') {
		$nokk_legacy = $_POST['nokk_legacy'];
	} else {
		$nokk_legacy = NULL;
	}
	// Handling g_shift
	if ($_POST['g_shift'] != NULL or $_POST['g_shift'] != '') {
		$g_shift = $_POST['g_shift'];
	} else {
		$g_shift = NULL;
	}
	// Handling no_program
	if ($_POST['no_program'] != NULL or $_POST['no_program'] != '') {
		$no_program = $_POST['no_program'];
	} else {
		$no_program = NULL;
	}
	// Handling l_r
	if ($_POST['l_r'] != NULL or $_POST['l_r'] != '') {
		$l_r = $_POST['l_r'];
	} else {
		$l_r = NULL;
	}
	// Handling l_r2
	if ($_POST['l_r2'] != NULL or $_POST['l_r2'] != '') {
		$l_r2 = $_POST['l_r2'];
	} else {
		$l_r2 = NULL;
	}
	// Handling gabung
	if ($_POST['gabung'] != NULL or $_POST['gabung'] != '') {
		$gabung = $_POST['gabung'];
	} else {
		$gabung = NULL;
	}
	// Handling cycle_time
	if ($_POST['cycle_time'] != NULL or $_POST['cycle_time'] != '') {
		$cycle_time = $_POST['cycle_time'];
	} else {
		$cycle_time = NULL;
	}
	// Handling lb1 sampai lb8
	if ($_POST['lb1'] != NULL or $_POST['lb1'] != '') {
		$lb1 = $_POST['lb1'];
	} else {
		$lb1 = NULL;
	}
	if ($_POST['lb2'] != NULL or $_POST['lb2'] != '') {
		$lb2 = $_POST['lb2'];
	} else {
		$lb2 = NULL;
	}
	if ($_POST['lb3'] != NULL or $_POST['lb3'] != '') {
		$lb3 = $_POST['lb3'];
	} else {
		$lb3 = NULL;
	}
	if ($_POST['lb4'] != NULL or $_POST['lb4'] != '') {
		$lb4 = $_POST['lb4'];
	} else {
		$lb4 = NULL;
	}
	if ($_POST['lb5'] != NULL or $_POST['lb5'] != '') {
		$lb5 = $_POST['lb5'];
	} else {
		$lb5 = NULL;
	}
	if ($_POST['lb6'] != NULL or $_POST['lb6'] != '') {
		$lb6 = $_POST['lb6'];
	} else {
		$lb6 = NULL;
	}
	if ($_POST['lb7'] != NULL or $_POST['lb7'] != '') {
		$lb7 = $_POST['lb7'];
	} else {
		$lb7 = NULL;
	}
	if ($_POST['lb8'] != NULL or $_POST['lb8'] != '') {
		$lb8 = $_POST['lb8'];
	} else {
		$lb8 = NULL;
	}
	// Handling rpm
	if ($_POST['rpm'] != NULL or $_POST['rpm'] != '') {
		$rpm = $_POST['rpm'];
	} else {
		$rpm = NULL;
	}
	// Handling tekanan
	if ($_POST['tekanan'] != NULL or $_POST['tekanan'] != '') {
		$tekanan = $_POST['tekanan'];
	} else {
		$tekanan = NULL;
	}
	// Handling nozzle 
	if ($_POST['nozzle'] != NULL or $_POST['nozzle'] != '') {
		$nozzle = $_POST['nozzle'];
	} else {
		$nozzle = NULL;
	}
	// Handling benang
	if ($_POST['benang'] != NULL or $_POST['benang'] != '') {
		$benang = $_POST['benang'];
	} else {
		$benang = NULL;
	}
	// Handling std_cok_wrn
	if ($_POST['std_cok_wrn'] != NULL or $_POST['std_cok_wrn'] != '') {
		$std_cok_wrn = addslashes($_POST['std_cok_wrn']);
	} else {
		$std_cok_wrn = NULL;
	}
	// Handling ket
	if ($_POST['ket'] != NULL or $_POST['ket'] != '') {
		$ket = $_POST['ket'];
	} else {
		$ket = NULL;
	}
	// Handling tgl_buat
	if (!empty($_POST['jammasukkain']) and !empty($_POST['tglmasukkain'])) {
		$tgl_buat = $_POST['jammasukkain'] . ' ' . $_POST['tglmasukkain'] . ':00.000'; //NOTE, format kebalik antara tanggal dan jam, jammasukkain =  tanggalnya ; tglmasukkain = jamnya 
	} else {
		$tgl_buat = NULL;
	}
	// Handling blower
	if ($_POST['blower'] != NULL or $_POST['blower'] != '') {
		$blower = $_POST['blower'];
	} else {
		$blower = NULL;
	}
	// Handling plaiter
	if ($_POST['plaiter'] != NULL or $_POST['plaiter'] != '') {
		$plaiter = $_POST['plaiter'];
	} else {
		$plaiter = NULL;
	}
	// Handling air_awal
	if ($_POST['air_awal'] != NULL or $_POST['air_awal'] != '') {
		$air_awal = $_POST['air_awal'];
	} else {
		$air_awal = NULL;
	}
	// Handling tjamP1
	if ($_POST['tjamP1'] != NULL or $_POST['tjamP1'] != '') {
		$tjamP1 = $_POST['tjamP1'];
	} else {
		$tjamP1 = NULL;
	}
	// Handling jk1
	if ($_POST['jk1'] != NULL or $_POST['jk1'] != '') {
		$jk1 = $_POST['jk1'];
	} else {
		$jk1 = NULL;
	}
	// Handling Oper_shift
	if ($_POST['oper_shift'] != NULL or $_POST['oper_shift'] != '') {
		$oper_shift = $_POST['oper_shift'];
	} else {
		$oper_shift = NULL;
	}
	// Handling lebar_fin
	if ($_POST['lebar_fin'] != NULL or $_POST['lebar_fin'] != '') {
		$lebar_fin = $_POST['lebar_fin'];
	} else {
		$lebar_fin = NULL;
	}
	// Handling grm_fin
	if ($_POST['grm_fin'] != NULL or $_POST['grm_fin'] != '') {
		$grm_fin = $_POST['grm_fin'];
	} else {
		$grm_fin = NULL;
	}
	// Handling masukkain
	if ($_POST['masukkain'] != NULL or $_POST['masukkain'] != '') {
		$masukkain = $_POST['masukkain'];
	} else {
		$masukkain = NULL;
	}
	// Handling kategori_resep
	if ($_POST['kategori_resep'] != NULL or $_POST['kategori_resep'] != '') {
		$kategori_resep = $_POST['kategori_resep'];
	} else {
		$kategori_resep = NULL;
	}
	// Handling kasih_resep
	if ($_POST['kasih_resep'] != NULL or $_POST['kasih_resep'] != '') {
		$kasih_resep = $_POST['kasih_resep'];
	} else {
		$kasih_resep = NULL;
	}
	// Handling acc_resep
	if ($_POST['acc_resep'] != NULL or $_POST['acc_resep'] != '') {
		$acc_resep = $_POST['acc_resep'];
	} else {
		$acc_resep = NULL;
	}
	// Handling jammasukkain
	if ($tgl_buat != NULL or $tgl_buat != '' or $tgl_buat != '1900-01-01 00:00:00.000') {
		$jammasukkaindt = $tgl_buat;
	} else {
		$jammasukkaindt = NULL;
	}

	// Method untuk Insert pakai prepare
	$dataInsert = [
		$id,
		$demand,
		$nokk,
		$operator,
		$colorist,
		$leader,
		$pakai_air,
		$carry_over,
		$shift,
		$grms_a,
		$lebar_a,
		$pjng_kain,
		$pjng_kain_perlubang,
		$qty3,
		$qty4,
		$nokk_legacy,
		$g_shift,
		$no_program,
		$l_r,
		$l_r2,
		$gabung,
		$cycle_time,
		$lb1,
		$lb2,
		$lb3,
		$lb4,
		$lb5,
		$lb6,
		$lb7,
		$lb8,
		$rpm,
		$tekanan,
		$nozzle,
		$benang,
		$std_cok_wrn,
		$ket,
		$tgl_buat,
		$tgl_targetdt,
		$blower,
		$plaiter,
		$air_awal,
		$tjamP1,
		$jk1,
		$oper_shift,
		$lebar_fin,
		$grm_fin,
		$masukkain,
		$kategori_resep,
		$kasih_resep,
		$acc_resep,
		$jammasukkaindt,
		$tgl_updatedt
	];

	// var_dump($dataInsert);

	$sql = "INSERT INTO db_dying.tbl_montemp (
    id_schedule, nodemand, nokk, operator, colorist, leader, pakai_air, carry_over, shift, gramasi_a, lebar_a,
    pjng_kain, pjng_kain_perlubang, rol, bruto, nokk_legacy, g_shift, no_program, l_r, l_r_2, gabung_celup, cycle_time,
    lb1, lb2, lb3, lb4, lb5, lb6, lb7, lb8, rpm, tekanan, nozzle, benang, std_cok_wrn, ket, tgl_buat, tgl_target, blower, plaiter,
    air_awal, waktu_tunggu, note_wt, oper_shift, lebar_fin, grm_fin, masukkain, kategori_resep, kasih_resep, acc_resep, jammasukkain, tgl_update
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

	$stmt = sqlsrv_prepare($con, $sql, $dataInsert);

	if ($stmt === false) {
		die(print_r(sqlsrv_errors(), true));
	}
	$result = sqlsrv_execute($stmt);

	if ($result === false) {
		die(print_r(sqlsrv_errors(), true));
	}
	echo "<script>swal({
					title: 'Data Tersimpan',   
					text: 'Klik Ok untuk input data kembali',
					type: 'success',
					allowOutsideClick: false, 
            		allowEscapeKey: false,
					}).then((result) => {
					if (result.value) {
						
						window.location.href='?p=Monitoring-Tempelan'; 
					}
					});</script>";

	if ($sqlData) {
		$sqlD = sqlsrv_query($con, "UPDATE db_dying.tbl_schedule SET 
									[status]='sedang jalan',
									tgl_update=GETDATE()
									WHERE [status]='antri mesin' and no_mesin='" . $rcek['no_mesin'] . "' and no_urut='1' ");
		echo "<script>swal({
					title: 'Data Tersimpan',   
					text: 'Klik Ok untuk input data kembali',
					type: 'success',
					allowOutsideClick: false, 
            		allowEscapeKey: false,
					}).then((result) => {
					if (result.value) {
						
						window.location.href='?p=Monitoring-Tempelan'; 
					}
					});</script>";
	}
}
if ($_POST['update'] == "update") {
	$warna = str_replace("'", "''", $_POST['warna']);
	$nowarna = str_replace("'", "''", $_POST['no_warna']);
	$jns = str_replace("'", "''", $_POST['jns_kain']);
	$po = str_replace("'", "''", $_POST['no_po']);
	$lot = trim($_POST['lot']);
	$sqlData = sqlsrv_query($con, "UPDATE db_dying.tbl_montemp SET 
		  operator='" . $_POST['operator'] . "',
		  nodemand='$_POST[demand]',
		  colorist='" . $_POST['colorist'] . "',
		  leader='" . $_POST['leader'] . "',
		  shift='" . $_POST['shift'] . "',
		  gramasi_a='" . $_POST['grms_a'] . "',
		  lebar_a='" . $_POST['lebar_a'] . "',
		  rol='" . $_POST['qty3'] . "',
		  bruto='" . $_POST['qty4'] . "',
		  pjng_kain='" . $_POST['pjng_kain'] . "',
		  pjng_kain_perlubang='" . $_POST['pjng_kain_perlubang'] . "',
		  g_shift='" . $_POST['g_shift'] . "',
		  no_program='" . $_POST['no_program'] . "',
		  l_r='" . $_POST['l_r'] . "',
		  l_r_2='" . $_POST['l_r2'] . "',
		  gabung_celup='" . $_POST['gabung'] . "',
		  cycle_time='" . $_POST['cycle_time'] . "',
		  lb1='" . $_POST['lb1'] . "',
		  lb2='" . $_POST['lb2'] . "',
		  lb3='" . $_POST['lb3'] . "',
		  lb4='" . $_POST['lb4'] . "',
		  lb5='" . $_POST['lb5'] . "',
		  lb6='" . $_POST['lb6'] . "',
		  lb7='" . $_POST['lb7'] . "',
		  lb8='" . $_POST['lb8'] . "',
		  rpm='" . $_POST['rpm'] . "',
		  tekanan='" . $_POST['tekanan'] . "',
		  nozzle='" . $_POST['nozzle'] . "',		  
		  ket='" . $_POST['ket'] . "',
		  blower='" . $_POST['blower'] . "',
		  plaiter='" . $_POST['plaiter'] . "',
		  lebar_fin='" . $_POST['lebar_fin'] . "',
		  grm_fin='" . $_POST['grm_fin'] . "',
		  nokk_legacy='" . $_POST['nokk_legacy'] . "',
		  masukkain='" . $_POST['masukkain'] . "',
		  tgl_update=GETDATE()
		  WHERE nokk='" . $_POST['nokk'] . "'");

	if ($sqlData) {
		// echo "<script>alert('Data Telah Diubah');</script>";
		// echo "<script>window.location.href='?p=Input-Data-KJ;</script>";
		echo "<script>swal({
				title: 'Data Telah DiUbah',   
				text: 'Klik Ok untuk input data kembali',
				type: 'success',
				allowOutsideClick: false, 
            	allowEscapeKey: false,
				}).then((result) => {
				if (result.value) {
					
					window.location.href='?p=Monitoring-Tempelan'; 
				}
				});</script>";
	}
}
?>
<script>
	function roundToTwo(num) {
		return +(Math.round(num + "e+2") + "e-2");
	}

	function hitung() {
		if (document.forms['form1']['lebar_a'].value != "" && document.forms['form1']['grms_a'].value != "") {
			var brtKain = document.forms['form1']['qty4'].value;
			var lebar = document.forms['form1']['lebar_a'].value;
			var grms = document.forms['form1']['grms_a'].value;
			var lb1 = document.forms['form1']['lb1'].value;
			var lb2 = document.forms['form1']['lb2'].value;
			var lb3 = document.forms['form1']['lb3'].value;
			var lb4 = document.forms['form1']['lb4'].value;
			var lb5 = document.forms['form1']['lb5'].value;
			var lb6 = document.forms['form1']['lb6'].value;
			var lb7 = document.forms['form1']['lb7'].value;
			var lb8 = document.forms['form1']['lb8'].value;
			var m;
			if (lb1 > 0) {
				var _lb1 = 1;
			} else {
				var _lb1 = 0;
			}
			if (lb2 > 0) {
				var _lb2 = 1;
			} else {
				var _lb2 = 0;
			}
			if (lb3 > 0) {
				var _lb3 = 1;
			} else {
				var _lb3 = 0;
			}
			if (lb4 > 0) {
				var _lb4 = 1;
			} else {
				var _lb4 = 0;
			}
			if (lb5 > 0) {
				var _lb5 = 1;
			} else {
				var _lb5 = 0;
			}
			if (lb6 > 0) {
				var _lb6 = 1;
			} else {
				var _lb6 = 0;
			}
			if (lb7 > 0) {
				var _lb7 = 1;
			} else {
				var _lb7 = 0;
			}
			if (lb8 > 0) {
				var _lb8 = 1;
			} else {
				var _lb8 = 0;
			}
			m = roundToTwo((brtKain * 39.37 * 1000) / (lebar * grms));
			lb = (_lb1 + _lb2 + _lb3 + _lb4 + _lb5 + _lb6 + _lb7 + _lb8);
			m_lubang = roundToTwo((brtKain * 39.37 * 1000) / (lebar * grms) / lb);
			document.forms['form1']['pjng_kain'].value = m;
			document.forms['form1']['pjng_kain_perlubang'].value = m_lubang;
		}
	}

	function hitungp() {
		if (document.forms['form1']['lebar'].value != "" && document.forms['form1']['grms'].value != "") {
			var brtKain = document.forms['form1']['qty4'].value;
			var lebar = document.forms['form1']['lebar'].value;
			var grms = document.forms['form1']['grms'].value;
			var m;
			m = roundToTwo((brtKain * 39.37 * 1000) / (lebar * grms));
			document.forms['form1']['pjng_kain'].value = m;
		}
	}
</script>