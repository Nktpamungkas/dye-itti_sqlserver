<script>
	function no_msn() {
		if (document.forms['form1']['kapasitas'].value == "2400") {
			document.getElementById("no_mc").innerHTML =
				"<option value=''>Pilih</option></option><option value='1401'>1401</option><option value='1406'>1406</option>";
		} else if (document.forms['form1']['kapasitas'].value == "1800") {
			document.getElementById("no_mc").innerHTML =
				"<option value=''>Pilih</option><option value='1103'>1103</option><option value='1107'>1107</option><option value='1411'>1411</option>";
		} else if (document.forms['form1']['kapasitas'].value == "1200") {
			document.getElementById("no_mc").innerHTML =
				"<option value=''>Pilih<option value='1104'>1104</option><option value='1108'>1108</option><option value='1402'>1402</option><option value='1420'>1420</option><option value='1421'>1421</option><option value='2348'>2348</option>";
		} else if (document.forms['form1']['kapasitas'].value == "900") {
			document.getElementById("no_mc").innerHTML =
				"<option value=''>Pilih</option><option value='1114'>1114</option>";
		} else if (document.forms['form1']['kapasitas'].value == "800") {
			document.getElementById("no_mc").innerHTML =
				"<option value=''>Pilih</option><option value='2229'>2229</option><option value='2246'>2246</option><option value='2247'>2247</option><option value='2625'>2625</option><option value='2627'>2627</option><option value='2634'>2634</option><option value='2636'>2636</option><option value='2637'>2637</option>";
		} else if (document.forms['form1']['kapasitas'].value == "750") {
			document.getElementById("no_mc").innerHTML =
				"<option value=''>Pilih</option><option value='1505'>1505</option>";
		} else if (document.forms['form1']['kapasitas'].value == "600") {
			document.getElementById("no_mc").innerHTML =
				"<option value=''>Pilih</option><option value='1115'>1115</option><option value='1116'>1116</option><option value='1117'>1117</option><option value='1410'>1410</option><option value='1451'>1451</option><option value='2632'>2632</option><option value='2633'>2633</option>";
		} else if (document.forms['form1']['kapasitas'].value == "400") {
			document.getElementById("no_mc").innerHTML =
				"<option value=''>Pilih</option><option value='2230'>2230</option><option value='2231'>2231</option>";
		} else if (document.forms['form1']['kapasitas'].value == "300") {
			document.getElementById("no_mc").innerHTML =
				"<option value=''>Pilih</option><option value='1118'>1118</option><option value='1412'>1412</option><option value='1413'>1413</option><option value='1419'>1419</option><option value='1449'>1449</option>";
		} else if (document.forms['form1']['kapasitas'].value == "200") {
			document.getElementById("no_mc").innerHTML =
				"<option value=''>Pilih</option><option value='2228'>2228</option>";
		} else if (document.forms['form1']['kapasitas'].value == "150") {
			document.getElementById("no_mc").innerHTML =
				"<option value=''>Pilih</option><option value='1409'>1409</option><option value='1450'>1450</option>";
		} else if (document.forms['form1']['kapasitas'].value == "100") {
			document.getElementById("no_mc").innerHTML =
				"<option value=''>Pilih</option><option value='1452'>1452</option><option value='1453'>1453</option><option value='1458'>1458</option><option value='2622'>2622</option><option value='2623'>2623</option><option value='2665'>2665</option><option value='2666'>2666</option><option value='2667'>2667</option>";
		} else if (document.forms['form1']['kapasitas'].value == "50") {
			document.getElementById("no_mc").innerHTML =
				"<option value=''>Pilih</option><option value='1454'>1454</option><option value='1455'>1455</option><option value='1456'>1456</option><option value='1457'>1457</option><option value='1459'>1459</option><option value='2624'>2624</option><option value='2635'>2635</option><option value='2660'>2660</option><option value='2661'>2661</option><option value='2662'>2662</option><option value='2663'>2663</option><option value='2664'>2664</option>";
		} else if (document.forms['form1']['kapasitas'].value == "30") {
			document.getElementById("no_mc").innerHTML =
				"<option value=''>Pilih</option><option value='2626'>2626</option>";
		} else if (document.forms['form1']['kapasitas'].value == "20") {
			document.getElementById("no_mc").innerHTML =
				"<option value=''>Pilih</option><option value='2042'>2042</option><option value='2043'>2043</option><option value='2044'>2044</option><option value='2045'>2045</option><option value='2639'>2639</option><option value='2640'>2640</option><option value='2641'>2641</option>";
		} else if (document.forms['form1']['kapasitas'].value == "10") {
			document.getElementById("no_mc").innerHTML =
				"<option value=''>Pilih</option><option value='2638'>2638</option>";
		} else if (document.forms['form1']['kapasitas'].value == "5") {
			document.getElementById("no_mc").innerHTML =
				"<option value=''>Pilih</option><option value='1468'>1468</option></option><option value='1469'>1469</option>";
		} else if (document.forms['form1']['kapasitas'].value == "0") {
			document.getElementById("no_mc").innerHTML =
				"<option value=''>Pilih</option><option value='WS11'>WS11</option><option value='CB11'>CB11</option>";
		} else {
			document.getElementById("no_mc").innerHTML = "<option value=''>Pilih</option>";
		}
	}

	function hload() {
		var nokk = document.forms['form1']['nokk'].value;
		var bruto = document.forms['form1']['qty4'].value;
		var kap = document.forms['form1']['kapasitas'].value;
		var loading;
		if (nokk != "") {
			loading = roundToTwo((bruto * 100) / kap).toFixed(2);
			document.forms['form1']['loading'].value = loading;
		}

	}
</script>
<?php
include "../koneksi.php";
$nokk = $_GET['nokk'];


$child = $r['ChildLevel'];
if ($nokk != "") {
}

$sqlCekWaktu = sqlsrv_query($con, "	SELECT
										TOP 1 th.operator_keluar,
										th.tgl_buat AS jam_stop,
										GETDATE () AS jam_start
									FROM
										db_dying.tbl_hasilcelup th
										INNER JOIN db_dying.tbl_montemp tm ON th.id_montemp = tm.id
										INNER JOIN db_dying.tbl_schedule ts ON tm.id_schedule = ts.id
									WHERE
										ts.no_mesin = '" . $rcek[' no_mesin '] . "'
									ORDER BY
										th.id DESC");
$rcekW = sqlsrv_fetch_array($sqlCekWaktu);
$awalP  = $rcekW['jam_stop'];
$akhirP = $rcekW['jam_start'];

$diffP  = $akhirP->diff($awalP); // Calculate difference between $akhirP and $awalP

// Calculate total hours
$tjamP  = $diffP->h + ($diffP->i / 60) + ($diffP->s / 3600);
$tjamP  = round($tjamP, 2); // Round to 2 decimal places if needed

$sqlCekMc = sqlsrv_query($con, "SELECT
									no_mesin,
									kode,
									waktu_tunggu,
									wt_des,
									ket 
								FROM
									db_dying.tbl_mesin 
								WHERE
									no_mesin = '" . $rcek[' no_mesin '] . "'");
$rCekMc = sqlsrv_fetch_array($sqlCekMc);

$sqlCek1 = sqlsrv_query($con, "	SELECT
									TOP 1 *
								FROM
									db_dying.tbl_setting_mesin
								WHERE
									nokk = '$nokk'
								ORDER BY
									id DESC", array(), array("Scrollable" => SQLSRV_CURSOR_KEYSET));
$cek1 = sqlsrv_num_rows($sqlCek1);
$rcek1 = sqlsrv_fetch_array($sqlCek1);

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


//DB2 Volume
$sqlvDB2 = "SELECT
	ITXVIEW_RESERVATION.PRODUCTIONORDERCODE,
	ITXVIEW_RESERVATION.GROUPLINE,
	ITXVIEW_RESERVATION.INITIALUSERPRIMARYQUANTITY,
	VIEWPRODUCTIONRESERVATION.PICKUPQUANTITY,
	ITXVIEW_RESERVATION.INITIALUSERPRIMARYQUANTITY * VIEWPRODUCTIONRESERVATION.PICKUPQUANTITY AS VOLUME
FROM
	ITXVIEW_RESERVATION ITXVIEW_RESERVATION
	LEFT JOIN VIEWPRODUCTIONRESERVATION VIEWPRODUCTIONRESERVATION ON ITXVIEW_RESERVATION.PRODUCTIONORDERCODE = VIEWPRODUCTIONRESERVATION.PRODUCTIONORDERCODE
	AND ITXVIEW_RESERVATION.GROUPLINE = VIEWPRODUCTIONRESERVATION.GROUPLINE
WHERE
	ITXVIEW_RESERVATION.PRODUCTIONORDERCODE = '$prdorder'
	AND ITXVIEW_RESERVATION.GROUPLINE = '$grpline'";
$stmt = db2_exec($conn2, $sqlvDB2, array('cursor' => DB2_SCROLLABLE));
$rowvdb2 = db2_fetch_assoc($stmt);

if ($nokk != "" and $rcek2['bruto'] != "" and $rcek2['bruto'] > 0) {
	$lr = Des2($rowvdb2['VOLUME'] / $rcek2['bruto']);
} else {
	$lr = "";
}
?>
<?php
$Kapasitas	= isset($_POST['kapasitas']) ? $_POST['kapasitas'] : '';
$TglMasuk	= isset($_POST['tglmsk']) ? $_POST['tglmsk'] : '';
$Item		= isset($_POST['item']) ? $_POST['item'] : '';
$Warna		= isset($_POST['warna']) ? $_POST['warna'] : '';
$Langganan	= isset($_POST['langganan']) ? $_POST['langganan'] : '';
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
					<label for="nokk" class="col-sm-3 control-label">No KK</label>
					<div class="col-sm-4">
						<input name="nokk" type="text" class="form-control" id="nokk"
							onchange="window.location='?p=Form-Setting-Mesin&nokk='+this.value"
							value="<?php echo $_GET['nokk']; ?>" placeholder="No KK" required>
					</div>
				</div>
				<div class="form-group">
					<label for="langganan" class="col-sm-3 control-label">Langganan</label>
					<div class="col-sm-8">
						<input name="langganan" type="text" class="form-control" id="langganan"
							value="<?php if ($cek1 > 0) {
										echo $rcek1['langganan'];
									} else {
										echo $pelanggan;
									} ?>" placeholder="Langganan">
					</div>
				</div>
				<div class="form-group">
					<label for="buyer" class="col-sm-3 control-label">Buyer</label>
					<div class="col-sm-8">
						<input name="buyer" type="text" class="form-control" id="buyer"
							value="<?php if ($cek1 > 0) {
										echo $rcek1['buyer'];
									} else {
										echo $buyer;
									} ?>" placeholder="Buyer">
					</div>
				</div>
				<div class="form-group">
					<label for="no_order" class="col-sm-3 control-label">No Order</label>
					<div class="col-sm-4">
						<input name="no_order" type="text" class="form-control" id="no_order"
							value="<?php if ($cek1 > 0) {
										echo $rcek1['no_order'];
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
					<label for="po" class="col-sm-3 control-label">PO</label>
					<div class="col-sm-5">
						<input name="po" type="text" class="form-control" id="po"
							value="<?php if ($cek1 > 0) {
										echo $rcek1['po'];
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
						<input name="no_hanger" type="text" class="form-control" id="no_hanger"
							value="<?php if ($cek1 > 0) {
										echo $rcek1['no_hanger'];
									} else {
										if ($r['HangerNo']) {
											echo $r['HangerNo'];
										} else if ($nokk != "") {
											echo $cekM['no_item'];
										}
									} ?>" placeholder="No Hanger">
					</div>
					<div class="col-sm-3">
						<input name="no_item" type="text" class="form-control" id="no_item"
							value="<?php if ($rcek1['no_item'] != "") {
										echo $rcek1['no_item'];
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
						<textarea name="jns_kain" class="form-control" id="jns_kain" placeholder="Jenis Kain">
							<?php if ($cek1 > 0) {
								echo $rcek1['jenis_kain'];
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
								placeholder="0000-00-00" value="<?php if ($cek1 > 0) {
																	echo $rcek1['tgl_delivery'] != '' or $rcek1['tgl_delivery'] != null ? $rcek1['tgl_delivery']->format('Y-m-d H:i:s') : '';
																} else {
																	if ($r['RequiredDate'] != "") {
																		echo date('Y-m-d', strtotime($r['RequiredDate']->format('Y-m-d H:i:s')));
																	}
																} ?>" required />
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="l_g" class="col-sm-3 control-label">L X Grm Permintaan</label>
					<div class="col-sm-2">
						<input name="lebar" type="number" class="form-control" id="lebar"
							value="<?php if ($cek1 > 0) {
										echo $rcek1['lebar'];
									} else {
										echo round($r['Lebar']);
									} ?>" placeholder="0" required>
					</div>
					<div class="col-sm-2">
						<input name="grms" type="number" class="form-control" id="grms"
							value="<?php if ($cek1 > 0) {
										echo $rcek1['gramasi'];
									} else {
										echo round($r['Gramasi']);
									} ?>" placeholder="0" onChange="hitungp();" required>
					</div>
				</div>
				<div class="form-group">
					<label for="warna" class="col-sm-3 control-label">Warna</label>
					<div class="col-sm-8">
						<input name="warna" type="text" class="form-control" id="warna"
							value="<?php if ($cek1 > 0) {
										echo $rcek1['warna'];
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
						<input name="no_warna" type="text" class="form-control" id="no_warna"
							value="<?php if ($cek1 > 0) {
										echo $rcek1['no_warna'];
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
							<input name="qty1" type="number" class="form-control" id="qty1"
								value="<?php if ($cek1 > 0) {
											echo $rcek1['qty_order'];
										} else {
											echo round($r['BatchQuantity'], 2);
										} ?>" placeholder="0.00" required>
							<span class="input-group-addon">KGs</span>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="input-group">
							<input name="qty2" type="number" class="form-control" id="qty2"
								value="<?php if ($cek1 > 0) {
											echo $rcek1['pjng_order'];
										} else {
											echo round($r['Quantity'], 2);
										} ?>" placeholder="0.00" style="text-align: right;" required>
							<span class="input-group-addon">
								<select name="satuan1" style="font-size: 12px;">
									<option value="Yard" <?php if ($rcek1['satuan_order'] == "Yard") {
																echo "SELECTED";
															} ?>>Yard</option>
									<option value="Meter" <?php if ($rcek1['satuan_order'] == "Meter") {
																echo "SELECTED";
															} ?>>Meter</option>
									<option value="PCS" <?php if ($rcek1['satuan_order'] == "PCS") {
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
						<input name="lot" type="text" class="form-control" id="lot"
							value="<?php if ($cek1 > 0) {
										echo $rcek1['lot'];
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
						<input name="qty3" type="number" min="0" class="form-control" id="qty3"
							value="<?php if ($cek1 > 0) {
										echo $rcek1['rol'] . $rcek2['kk'];
									} else {
										if ($r['RollCount'] != "") {
											echo round($r['RollCount']);
										} else if ($nokk != "") {
											echo $cekM['jml_roll'];
										}
									} ?>" placeholder="0.00" required>
					</div>
					<div class="col-sm-3">
						<div class="input-group">
							<input name="qty4" type="number" min="0" class="form-control" id="qty4"
								value="<?php if ($cek1 > 0) {
											echo $rcek1['bruto'];
										} else {
											if ($r['Weight'] != "") {
												echo round($r['Weight'], 2);
											} else if ($nokk != "") {
												echo $cekM['bruto'];
											}
										} ?>" placeholder="0.00" style="text-align: right;" required>
							<span class="input-group-addon">KGs</span>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="pjng_kain" class="col-sm-3 control-label">Panjang Kain</label>
					<div class="col-sm-3">
						<input name="pjng_kain" type="text" class="form-control" id="pjng_kain"
							value="<?php if ($cek1 > 0) {
										echo $rcek1['pnjg_kain'];
									} ?>" placeholder="0.00" style="text-align: right;" readonly>
					</div>
				</div>
				<?php if ($cek1 > 0 and $_GET['kap'] != "") {
					$loading = round($rcek1['bruto'] / $_GET['kap'], 4) * 100;
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
						<select name="kapasitas" class="form-control" id="kapasitas" onChange="no_msn();hload();">
							<option value="">Pilih</option>
							<?php
							$sqlKap = sqlsrv_query($con, "SELECT kapasitas FROM db_dying.tbl_mesin GROUP BY kapasitas ORDER BY kapasitas DESC");
							while ($rK = sqlsrv_fetch_array($sqlKap)) {
							?>
								<option value="<?php echo $rK['kapasitas']; ?>" <?php if ($rcek1['kapasitas'] == $rK['kapasitas']) {
																					echo "SELECTED";
																				} ?>><?php echo $rK['kapasitas']; ?> KGs</option>
							<?php } ?>
						</select>
					</div>

				</div>
				<?php if ($cek1 > 0 and $rcek1['kapasitas'] != "" and $rcek1['kapasitas'] != "0") {
					if ($rcek1['kapasitas'] == 0) {
						$loading = 0;
					}
					$loading = round($rcek1['bruto'] / $rcek1['kapasitas'], 4) * 100;
				} else {
					if ($r['Weight'] != "" and $rcek1['kapasitas'] != "") {
						$loading = round($r['Weight'] / $rcek1['kapasitas'], 4) * 100;
					} else if ($nokk != "" and $rcek1['kapasitas'] != "") {
						$loading = round($cekM['bruto'] / $rcek1['kapasitas'], 4) * 100;
					}
				} ?>
				<div class="form-group">
					<label for="no_mc" class="col-sm-3 control-label">No MC</label>
					<div class="col-sm-2">
						<select name="no_mc" class="form-control" id="no_mc">
							<option value="">Pilih</option>
							<?php
							$sqlKap = sqlsrv_query($con, "SELECT
																no_mesin
															FROM
																db_dying.tbl_mesin
															WHERE
																kapasitas = '" . $rcek[' kapasitas '] . "'
															ORDER BY
																no_mesin ASC");
							while ($rK = sqlsrv_fetch_array($sqlKap)) {
							?>
								<option value="<?php echo $rK['no_mesin']; ?>" <?php if ($rcek1['no_mesin'] == $rK['no_mesin']) {
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
							<input name="loading" type="number" min="0" step=".01" style="text-align: right;"
								class="form-control" id="loading" value="<?php if ($_GET['nokk'] != "" and $rcek1['kapasitas'] != "") {
																				echo $loading;
																			} ?>" placeholder="0.00">
							<span class="input-group-addon">%</span>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="prod_order" class="col-sm-3 control-label">Prod. Order /Prod. Demand</label>
					<div class="col-sm-4">
						<input name="prod_order" type="text" class="form-control" id="prod_order"
							value="<?php if ($cek > 0) {
										echo $rcek1['prod_order'];
									} ?>" placeholder="Production Order" required>
					</div>
					<div class="col-sm-4">
						<input name="prod_demand" type="text" class="form-control" id="prod_demand"
							value="<?php if ($cek > 0) {
										echo $rcek1['prod_demand'];
									} ?>" placeholder="Production Demand" required>
					</div>
				</div>
			</div>
			<!-- col -->
			<div class="col-md-6">
				<div class="form-group">
					<label for="no_program" class="col-sm-3 control-label">No. Program</label>
					<div class="col-sm-3">
						<input name="no_program" type="text" class="form-control" id="no_program" value=""
							placeholder="No. Program">

					</div>
				</div>
				<div class="form-group">
					<label for="l_r" class="col-sm-3 control-label">L:R Cotton</label>
					<div class="col-sm-2">
						<input name="l_r" type="text" class="form-control" id="l_r"
							value="<?php if ($nokk != "") {
										echo "1:" . $lr;
									} ?>" placeholder="L:R Cotton">
					</div>
					<label for="l_r" class="col-sm-3 control-label">L:R Poly</label>
					<div class="col-sm-2">
						<input name="l_r_poly" type="text" class="form-control" id="l_r_poly"
							value="<?php if ($nokk != "") {
										echo "1:" . $lr;
									} ?>" placeholder="L:R Poly">
					</div>
				</div>
				<div class="form-group">
					<label for="cycle_time" class="col-sm-3 control-label">Cycle Time</label>
					<div class="col-sm-3">
						<div class="input-group">
							<input name="cycle_time" type="number" min="0" class="form-control" id="cycle_time" value=""
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
						<input name="rpm" type="number" class="form-control" min="0" id="rpm" value="" placeholder="0"
							style="text-align: right;">
					</div>
				</div>
				<div class="form-group">
					<label for="tekanan" class="col-sm-3 control-label">Tekanan Cotton</label>
					<div class="col-sm-2">
						<input name="tekanan" type="number" class="form-control" min="0" step=".01" id="tekanan"
							value="" placeholder="0" style="text-align: right;">
					</div>
					<label for="tekanan_poly" class="col-sm-3 control-label">Tekanan Poly</label>
					<div class="col-sm-2">
						<input name="tekanan_poly" type="number" class="form-control" min="0" step=".01"
							id="tekanan_poly" value="" placeholder="0" style="text-align: right;">
					</div>
				</div>
				<div class="form-group">
					<label for="a_dingin" class="col-sm-3 control-label">&empty; Nozzle Cotton</label>
					<div class="col-sm-3">
						<select name="nozzle" class="form-control" required>
							<option value="">Pilih</option>
							<?php
							$sqlNoz = sqlsrv_query($con, "SELECT
																nilai,
																satuan
															FROM
																db_dying.tbl_nozzle
															ORDER BY
																nilai ASC");
							while ($rN = sqlsrv_fetch_array($sqlNoz)) {
							?>
								<option value="<?php echo $rN['nilai']; ?>">
									<?php echo $rN['nilai'] . " " . $rN['satuan']; ?></option>
							<?php } ?>
						</select>
					</div>
					<label for="a_dingin" class="col-sm-3 control-label">&empty; Nozzle Poly</label>
					<div class="col-sm-3">
						<select name="nozzle_poly" class="form-control" required>
							<option value="">Pilih</option>
							<?php
							$sqlNoz = sqlsrv_query($con, "SELECT
																nilai,
																satuan
															FROM
																db_dying.tbl_nozzle
															ORDER BY
																nilai ASC");
							while ($rN = sqlsrv_fetch_array($sqlNoz)) {
							?>
								<option value="<?php echo $rN['nilai']; ?>">
									<?php echo $rN['nilai'] . " " . $rN['satuan']; ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="blower" class="col-sm-3 control-label">Blower Cotton</label>
					<div class="col-sm-3">
						<div class="input-group">
							<input name="blower" type="number" min="0" step=".01" class="form-control" id="blower"
								value="" placeholder="0" style="text-align: right;" required>
							<span class="input-group-addon">%</span>
						</div>
					</div>
					<label for="blower_poly" class="col-sm-3 control-label">Blower Poly</label>
					<div class="col-sm-3">
						<div class="input-group">
							<input name="blower_poly" type="number" min="0" step=".01" class="form-control"
								id="blower_poly" value="" placeholder="0" style="text-align: right;" required>
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
				</div>
				<div class="form-group">
					<label for="jumlah_test" class="col-sm-3 control-label">Jumlah Test</label>
					<div class="col-sm-3">
						<select name="jumlah_test" class="form-control" required>
							<option value="">Pilih</option>
							<option value="-">-</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="file_gambar" class="col-sm-3 control-label">Upload Foto</label>
					<div class="col-sm-6">
						<input type="file" id="file_gambar" name="file_gambar">
						<span style="color:red;"><?php if ($rcek1['file_gambar'] != "") {
														echo $rcek1['file_gambar'];
													} ?></span>
						<span class="help-block with-errors"></span>
					</div>
				</div>
				<div class="form-group">
					<label for="catatan" class="col-sm-3 control-label">Catatan</label>
					<div class="col-sm-8">
						<textarea name="catatan" class="form-control"></textarea>
					</div>

				</div>
				<div class="form-group">
					<label for="alur_proses" class="col-sm-3 control-label">Alur Proses</label>
					<div class="col-sm-8">
						<textarea name="alur_proses" class="form-control"></textarea>
					</div>

				</div>
			</div>
		</div>
		<div class="box-footer">
			<button type="button" class="btn btn-default pull-left" name="back" value="kembali"
				onClick="window.location='?p=Setting-Mesin'">Kembali <i class="fa fa-arrow-circle-o-left"></i></button>
			<?php if ($cek1 > 0) {
				echo "<script>swal({
				title: 'No Kartu Sudah diinput',
				text: 'Klik Ok untuk input kembali',
				type: 'warning',
				}).then((result) => {
				if (result.value) {
					window.location='index1.php?p=Form-Setting-Mesin';
				}
				});</script>";
			} else {
			?>
				<button type="submit" class="btn btn-primary pull-right" name="save" value="save">Simpan <i
						class="fa fa-save"></i></button>
			<?php } ?>

		</div>
		<!-- /.box-footer -->
	</div>
</form>
<?php

if ($_POST['save'] == "save") {
	$warna = str_replace("'", "''", $_POST['warna']);
	$nowarna = str_replace("'", "''", $_POST['no_warna']);
	$jns = str_replace("'", "''", $_POST['jns_kain']);
	$po = str_replace("'", "''", $_POST['po']);
	$lot = trim($_POST['lot']);
	$catatan = str_replace("'", "''", $_POST['catatan']);
	$alur_proses = str_replace("'", "''", $_POST['alur_proses']);
	$file_gambar = $_FILES['file_gambar']['name'];
	// ambil data file
	$namaFile_gambar = $_FILES['file_gambar']['name'];
	$namaSementara_gambar = $_FILES['file_gambar']['tmp_name'];
	// tentukan lokasi file akan dipindahkan
	$dirUpload = "dist/img-settingmesin/";
	// pindahkan file
	$terupload_gambar = move_uploaded_file($namaSementara_gambar, $dirUpload . $namaFile_gambar);

	$sqlData = sqlsrv_query($con, "INSERT INTO
	db_dying.tbl_setting_mesin (
		nokk,
		langganan,
		buyer,
		no_order,
		po,
		no_hanger,
		no_item,
		jenis_kain,
		tgl_delivery,
		lebar,
		gramasi,
		warna,
		no_warna,
		qty_order,
		pnjg_order,
		satuan_order,
		lot,
		rol,
		bruto,
		pjng_kain,
		kapasitas,
		no_mc,
		loading,
		prod_order,
		prod_demand,
		no_program,
		l_r,
		l_r_poly,
		cycle_time,
		masukkain,
		rpm,
		tekanan,
		tekanan_poly,
		nozzle,
		nozzle_poly,
		blower,
		blower_poly,
		plaiter,
		jumlah_test,
		catatan,
		alur_proses,
		file_gambar,
		tgl_buat,
		tgl_update
	)
VALUES
	(
		'$_POST[nokk]',
		'$_POST[langganan]',
		'$_POST[buyer]',
		'$_POST[no_order]',
		'$po',
		'$_POST[no_hanger]',
		'$_POST[no_item]',
		'$_POST[jns_kain]',
		'$_POST[tgl_delivery]',
		'$_POST[lebar]',
		'$_POST[grms]',
		'$_POST[warna]',
		'$_POST[no_warna]',
		'$_POST[qty1]',
		'$_POST[qty2]',
		'$_POST[satuan1]',
		'$_POST[lot]',
		'$_POST[qty3]',
		'$_POST[qty4]',
		'$_POST[pjng_kain]',
		'$_POST[kapasitas]',
		'$_POST[no_mc]',
		'$_POST[loading]',
		'$_POST[prod_order]',
		'$_POST[prod_demand]',
		'$_POST[no_program]',
		'$_POST[l_r]',
		'$_POST[l_r_poly]',
		'$_POST[cycle_time]',
		'$_POST[masukkain]',
		'$_POST[rpm]',
		'$_POST[tekanan]',
		'$_POST[tekanan_poly]',
		'$_POST[nozzle]',
		'$_POST[nozzle_poly]',
		'$_POST[blower]',
		'$_POST[blower_poly]',
		'$_POST[plaiter]',
		'$_POST[jumlah_test]',
		'$catatan',
		'$alur_proses',
		'$file_gambar',
		GETDATE (),
		GETDATE ()
	)");


	if ($sqlData) {
		echo "<script>swal({
		title: 'Data Tersimpan',   
		text: 'Klik Ok untuk input data kembali',
		type: 'success',
		}).then((result) => {
		if (result.value) {
			window.location.href='?p=Setting-Mesin'; 
		}
		});</script>";
	} else {
		echo "<script>swal({
        title: 'Data Gagal Tersimpan',   
        text: 'Klik Ok untuk input data kembali',
        type: 'error',
        }).then((result) => {
        if (result.value) {
        	window.location.href='?p=Setting-Mesin'; 
        }
        });</script>";
	}
}
if ($_POST['update'] == "update") {
	$warna = str_replace("'", "''", $_POST['warna']);
	$nowarna = str_replace("'", "''", $_POST['no_warna']);
	$jns = str_replace("'", "''", $_POST['jns_kain']);
	$po = str_replace("'", "''", $_POST['po']);
	$lot = trim($_POST['lot']);
	$catatan = str_replace("'", "''", $_POST['catatan']);
	$file_gambar = $_FILES['file_gambar']['name'];
	// ambil data file
	$namaFile_gambar = $_FILES['file_gambar']['name'];
	$namaSementara_gambar = $_FILES['file_gambar']['tmp_name'];
	// tentukan lokasi file akan dipindahkan
	$dirUpload = "dist/img-settingmesin/";
	// pindahkan file
	$terupload_gambar = move_uploaded_file($namaSementara_gambar, $dirUpload . $namaFile_gambar);
	$sqlData = sqlsrv_query($con, "UPDATE db_dying.tbl_setting_mesin
SET
	langganan = '$_POST[langganan]',
	buyer = '$_POST[buyer]',
	no_order = '$_POST[no_order]',
	po = '$po',
	no_hanger = '$_POST[no_hanger]',
	no_item = '$_POST[no_item]',
	jenis_kain = '$_POST[jns_kain]',
	tgl_delivery = '$_POST[tgl_delivery]',
	lebar = '$_POST[lebar]',
	gramasi = '$_POST[grms]',
	warna = '$_POST[warna]',
	no_warna = '$_POST[no_warna]',
	qty_order = '$_POST[qty1]',
	pnjg_order = '$_POST[qty2]',
	satuan_order = '$_POST[satuan1]',
	lot = '$_POST[lot]',
	rol = '$_POST[qty3]',
	bruto = '$_POST[qty4]',
	pjng_kain = '$_POST[pjng_kain]',
	kapasitas = '$_POST[kapasitas]',
	no_mc = '$_POST[no_mc]',
	loading = '$_POST[loading]',
	prod_order = '$_POST[prod_order]',
	prod_demand = '$_POST[prod_demand]',
	no_program = '$_POST[no_program]',
	l_r = '$_POST[l_r]',
	cycle_time = '$_POST[cycle_time]',
	masukkain = '$_POST[masukkain]',
	rpm = '$_POST[rpm]',
	tekanan = '$_POST[tekanan]',
	nozzle = '$_POST[nozzle]',
	blower = '$_POST[blower]',
	plaiter = '$_POST[plaiter]',
	jumlah_test = '$_POST[jumlah_test]',
	catatan = '$catatan',
	file_gambar = '$file_gambar',
	tgl_update = GETDATE ()
WHERE
	nokk = '$_POST[nokk]'");


	if ($sqlData) {
		echo "<script>swal({
		title: 'Data Telah DiUbah',   
		text: 'Klik Ok untuk input data kembali',
		type: 'success',
		}).then((result) => {
		if (result.value) {
			
			window.location.href='?p=Setting-Mesin'; 
		}
		});</script>";
	} else {
		echo "<script>swal({
		title: 'Data Gagal DiUbah',   
		text: 'Klik Ok untuk input data kembali',
		type: 'error',
		}).then((result) => {
		if (result.value) {
			window.location.href='?p=Setting-Mesin'; 
		}
		});</script>";
	}
}
?>
<script>
	function roundToTwo(num) {
		return +(Math.round(num + "e+2") + "e-2");
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