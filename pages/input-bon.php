<?php
ini_set("error_reporting", 1);
session_start();
include "koneksi.php";
$nokk = $_GET['nokk'];
// $sql = sqlsrv_query($conn, "select top 1
// 			x.*,dbo.fn_StockMovementDetails_GetTotalWeightPCC(0, x.PCBID) as Weight, 
// 			pm.Weight as Gramasi,pm.CuttableWidth as Lebar, pm.Description as ProductDesc, pm.ColorNo, pm.Color,
// 	dbo.fn_StockMovementDetails_GetTotalRollPCC(0, x.PCBID) as RollCount
// 		from
// 			(
// 			select
// 				so.SONumber, convert(char(10),so.SODate,103) as TglSO, so.CustomerID, so.BuyerID, so.PODate,
// 				sod.ID as SODID, sod.ProductID, sod.Quantity, sod.UnitID, sod.WeightUnitID, 
// 				soda.RefNo as DetailRefNo, jo.DocumentNo as NoOrder,soda.PONumber,sog.OtherDesc,
// 				pcb.ID as PCBID, pcb.Gross as Bruto,soda.HangerNo,pp.ProductCode,
// 				pcb.Quantity as BatchQuantity, pcb.UnitID as BatchUnitID, pcb.ScheduledDate, pcb.ProductionScheduledDate,
// 				pcblp.DepartmentID,pcb.LotNo,pcb.PCID,pcb.ChildLevel,pcb.RootID,sod.RequiredDate

// 			from
// 				SalesOrders so inner join
// 				JobOrders jo on jo.SOID=so.ID inner join
// 				SODetails sod on so.ID = sod.SOID inner join
// 				SODetailsAdditional soda on sod.ID = soda.SODID left join
// 				SOGarmentStyle sog ON so.ID = sog.SOID left join
// 				ProductPartner pp on pp.productid= sod.productid left join
// 				ProcessControlJO pcjo on sod.ID = pcjo.SODID left join
// 				ProcessControlBatches pcb on pcjo.PCID = pcb.PCID left join
// 				ProcessControlBatchesLastPosition pcblp on pcb.ID = pcblp.PCBID left join
// 				ProcessFlowProcessNo pfpn on pfpn.EntryType = 2 and pcb.ID = pfpn.ParentID and pfpn.MachineType = 24 left join
// 				ProcessFlowDetailsNote pfdn on pfpn.EntryType = pfdn.EntryType and pfpn.ID = pfdn.ParentID
// 			where pcb.DocumentNo='$nokk' and pcb.Gross<>'0'
// 				group by
// 					so.SONumber, so.SODate, so.CustomerID, so.BuyerID, so.PONumber, so.PODate,jo.DocumentNo,
// 					sod.ID, sod.ProductID, sod.Quantity, sod.UnitID, sod.Weight, sod.WeightUnitID,
// 					soda.RefNo,pcb.DocumentNo,soda.HangerNo,pp.ProductCode,sog.OtherDesc,
// 					pcb.ID, pcb.DocumentNo, pcb.Gross,soda.PONumber,
// 					pcb.Quantity, pcb.UnitID, pcb.ScheduledDate, pcb.ProductionScheduledDate,
// 					pcblp.DepartmentID,pcb.LotNo,pcb.PCID,pcb.ChildLevel,pcb.RootID,sod.RequiredDate
// 				) x inner join
// 				ProductMaster pm on x.ProductID = pm.ID left join
// 				Departments dep on x.DepartmentID  = dep.ID left join
// 				Departments pdep on dep.RootID = pdep.ID left join				
// 				Partners cust on x.CustomerID = cust.ID left join
// 				Partners buy on x.BuyerID = buy.ID left join
// 				UnitDescription udq on x.UnitID = udq.ID left join
// 				UnitDescription udw on x.WeightUnitID = udw.ID left join
// 				UnitDescription udb on x.BatchUnitID = udb.ID
// 			order by
// 				x.SODID, x.PCBID");
// $r = sqlsrv_fetch_array($sql);
// $sql1 = sqlsrv_query($conn, "select partnername from partners where id='$r[CustomerID]'");
// $r1 = sqlsrv_fetch_array($sql1);
// $sql2 = sqlsrv_query($conn, "select partnername from partners where id='$r[BuyerID]'");
// $r2 = sqlsrv_fetch_array($sql2);
// $pelanggan = $r1['partnername'] . "/" . $r2['partnername'];
// $ko = sqlsrv_query($conn, "select  ko.KONo from
// 		ProcessControlJO pcjo inner join
// 		ProcessControl pc on pcjo.PCID = pc.ID left join
// 		KnittingOrders ko on pc.CID = ko.CID and pcjo.KONo = ko.KONo 
// 	where
// 		pcjo.PCID = '$r[PCID]'
// group by ko.KONo");
// $rKO = sqlsrv_fetch_array($ko);

$child = $r['ChildLevel'];
if ($nokk != "") {
	// if ($child > 0) {
	// 	$sqlgetparent = sqlsrv_query($conn, "select ID,LotNo from ProcessControlBatches where ID='$r[RootID]' and ChildLevel='0'");
	// 	$rowgp = sqlsrv_fetch_array($sqlgetparent);

	// 	//$nomLot=substr("$row2[LotNo]",0,1);
	// 	$nomLot = $rowgp['LotNo'];
	// 	$nomorLot = "$nomLot/K$r[ChildLevel]";
	// } else {
	// 	$nomorLot = $r['LotNo'];
	// }

	// $sqlLot1 = "Select count(*) as TotalLot From ProcessControlBatches where PCID='$r[PCID]' and RootID='0' and LotNo < '1000'";
	// $qryLot1 = sqlsrv_query($conn, $sqlLot1) or die('A error occured : ');
	// $rowLot = sqlsrv_fetch_array($qryLot1);
	// $lotno = $rowLot['TotalLot'] . "-" . $nomorLot;
	// if ($r['Quantity'] != "") {
	// 	$x = ((($r['Lebar'] + 2) * $r['Gramasi']) / 43.06038193629178);
	// 	$x1 = (1000 / $x);
	// 	$yard = $x1 * $r['Quantity'];
	// }
}

$sqlCek = sqlsrv_query($con, "SELECT top 1 * FROM db_dying.tbl_gantikain WHERE nokk='$nokk' ORDER BY id DESC");
$cek = sqlsrv_num_rows($sqlCek);
$rcek = sqlsrv_fetch_array($sqlCek);

// NOW
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

$sql_pelanggan_buyer = db2_exec($conn2, "SELECT TRIM(LANGGANAN) AS PELANGGAN, TRIM(BUYER) AS BUYER FROM ITXVIEW_PELANGGAN 
													WHERE ORDPRNCUSTOMERSUPPLIERCODE = '$dt_ITXVIEWKK[ORDPRNCUSTOMERSUPPLIERCODE]' AND CODE = '$dt_ITXVIEWKK[PROJECTCODE]'");
$dt_pelanggan_buyer = db2_fetch_assoc($sql_pelanggan_buyer);

$sql_demand = db2_exec($conn2, "SELECT LISTAGG(TRIM(DEAMAND), ', ') AS DEMAND,
												LISTAGG(''''|| TRIM(ORIGDLVSALORDERLINEORDERLINE) ||'''', ', ')  AS ORIGDLVSALORDERLINEORDERLINE
										FROM ITXVIEWKK 
										WHERE PRODUCTIONORDERCODE = '$nokk'");
$dt_demand = db2_fetch_assoc($sql_demand);

if (!empty($dt_demand['ORIGDLVSALORDERLINEORDERLINE'])) {
	$orderline = $dt_demand['ORIGDLVSALORDERLINEORDERLINE'];
} else {
	$orderline = '0';
}

$sql_po = db2_exec($conn2, "SELECT TRIM(EXTERNALREFERENCE) AS NO_PO FROM ITXVIEW_KGBRUTO 
										WHERE PROJECTCODE = '$dt_ITXVIEWKK[PROJECTCODE]' AND ORIGDLVSALORDERLINEORDERLINE IN ($orderline)");
$dt_po = db2_fetch_assoc($sql_po);

$sql_noitem = db2_exec($conn2, "SELECT * FROM ORDERITEMORDERPARTNERLINK WHERE ORDPRNCUSTOMERSUPPLIERCODE = '$dt_ITXVIEWKK[ORDPRNCUSTOMERSUPPLIERCODE]' 
										AND SUBCODE01 = '$dt_ITXVIEWKK[SUBCODE01]' AND SUBCODE02 = '$dt_ITXVIEWKK[SUBCODE02]' 
										AND SUBCODE03 = '$dt_ITXVIEWKK[SUBCODE03]' AND SUBCODE04 = '$dt_ITXVIEWKK[SUBCODE04]' 
										AND SUBCODE05 = '$dt_ITXVIEWKK[SUBCODE05]' AND SUBCODE06 = '$dt_ITXVIEWKK[SUBCODE06]'
										AND SUBCODE07 = '$dt_ITXVIEWKK[SUBCODE07]' AND SUBCODE08 ='$dt_ITXVIEWKK[SUBCODE08]'
										AND SUBCODE09 = '$dt_ITXVIEWKK[SUBCODE09]' AND SUBCODE10 ='$dt_ITXVIEWKK[SUBCODE10]'");
$dt_item = db2_fetch_assoc($sql_noitem);

$sql_lebargramasi = db2_exec($conn2, "SELECT i.LEBAR,
											CASE
												WHEN i2.GRAMASI_KFF IS NULL THEN i2.GRAMASI_FKF
												ELSE i2.GRAMASI_KFF
											END AS GRAMASI 
											FROM 
												ITXVIEWLEBAR i 
											LEFT JOIN ITXVIEWGRAMASI i2 ON i2.SALESORDERCODE = '$dt_ITXVIEWKK[PROJECTCODE]' AND i2.ORDERLINE = '$dt_ITXVIEWKK[ORIGDLVSALORDERLINEORDERLINE]'
											WHERE 
												i.SALESORDERCODE = '$dt_ITXVIEWKK[PROJECTCODE]' AND i.ORDERLINE = '$dt_ITXVIEWKK[ORIGDLVSALORDERLINEORDERLINE]'");
$dt_lg = db2_fetch_assoc($sql_lebargramasi);

$sql_warna = db2_exec($conn2, "SELECT DISTINCT TRIM(WARNA) AS WARNA FROM ITXVIEWCOLOR 
											WHERE ITEMTYPECODE = '$dt_ITXVIEWKK[ITEMTYPEAFICODE]' 
											AND SUBCODE01 = '$dt_ITXVIEWKK[SUBCODE01]' 
											AND SUBCODE02 = '$dt_ITXVIEWKK[SUBCODE02]'
											AND SUBCODE03 = '$dt_ITXVIEWKK[SUBCODE03]' 
											AND SUBCODE04 = '$dt_ITXVIEWKK[SUBCODE04]'
											AND SUBCODE05 = '$dt_ITXVIEWKK[SUBCODE05]' 
											AND SUBCODE06 = '$dt_ITXVIEWKK[SUBCODE06]'
											AND SUBCODE07 = '$dt_ITXVIEWKK[SUBCODE07]' 
											AND SUBCODE08 = '$dt_ITXVIEWKK[SUBCODE08]'
											AND SUBCODE09 = '$dt_ITXVIEWKK[SUBCODE09]' 
											AND SUBCODE10 = '$dt_ITXVIEWKK[SUBCODE10]'");
$dt_warna = db2_fetch_assoc($sql_warna);

$sql_qtyorder = db2_exec($conn2, "SELECT DISTINCT
						INITIALUSERPRIMARYQUANTITY AS QTY_ORDER,
						USERSECONDARYQUANTITY AS QTY_ORDER_YARD,
						CASE
							WHEN TRIM(USERSECONDARYUOMCODE) = 'yd' THEN 'Yard'
							WHEN TRIM(USERSECONDARYUOMCODE) = 'm' THEN 'Meter'
							ELSE 'PCS'
						END AS SATUAN_QTY
					FROM 
						ITXVIEW_RESERVATION 
					WHERE 
						PRODUCTIONORDERCODE = '$dt_ITXVIEWKK[PRODUCTIONORDERCODE]' AND ITEMTYPEAFICODE = 'RFD'");
$dt_qtyorder = db2_fetch_assoc($sql_qtyorder);

$sql_roll = db2_exec($conn2, "SELECT count(*) AS ROLL, s2.PRODUCTIONORDERCODE
											FROM STOCKTRANSACTION s2 
											WHERE s2.ITEMTYPECODE ='KGF' AND s2.PRODUCTIONORDERCODE = '$dt_ITXVIEWKK[PRODUCTIONORDERCODE]'
											GROUP BY s2.PRODUCTIONORDERCODE");
$dt_roll = db2_fetch_assoc($sql_roll);

$sql_mesinknt = db2_exec($conn2, "SELECT DISTINCT
											s.LOTCODE,
											CASE
												WHEN a.VALUESTRING IS NULL THEN '-'
												ELSE a.VALUESTRING
											END AS VALUESTRING
										FROM STOCKTRANSACTION s 
										LEFT JOIN PRODUCTIONDEMAND p ON p.CODE = s.LOTCODE 
										LEFT JOIN ADSTORAGE a ON a.UNIQUEID = p.ABSUNIQUEID AND a.NAMENAME = 'MachineNo'
										WHERE s.PRODUCTIONORDERCODE = '$nokk'");
$dt_mesinknt = db2_fetch_assoc($sql_mesinknt);

$sql_bonresep1 = db2_exec($conn2, "SELECT
											TRIM(PRODUCTIONRESERVATION.PRODUCTIONORDERCODE) AS PRODUCTIONORDERCODE,
											TRIM(PRODUCTIONRESERVATION.PRODUCTIONORDERCODE) || '-' || TRIM(PRODUCTIONRESERVATION.GROUPLINE) AS BONRESEP1,
											TRIM(SUFFIXCODE) AS SUFFIXCODE
										FROM
											PRODUCTIONRESERVATION PRODUCTIONRESERVATION 
										WHERE
											PRODUCTIONRESERVATION.ITEMTYPEAFICODE = 'RFD' AND PRODUCTIONRESERVATION.PRODUCTIONORDERCODE = '$nokk' 
											AND NOT SUFFIXCODE = '001'
										ORDER BY
											PRODUCTIONRESERVATION.GROUPLINE ASC LIMIT 1");
$dt_bonresep1 = db2_fetch_assoc($sql_bonresep1);

$sql_bonresep2 = db2_exec($conn2, "SELECT
											TRIM( PRODUCTIONRESERVATION.PRODUCTIONORDERCODE ) AS PRODUCTIONORDERCODE,
											TRIM(PRODUCTIONRESERVATION.PRODUCTIONORDERCODE) || '-' || TRIM(PRODUCTIONRESERVATION.GROUPLINE) AS BONRESEP2,
											TRIM(SUFFIXCODE) AS SUFFIXCODE
										FROM
											PRODUCTIONRESERVATION PRODUCTIONRESERVATION 
										WHERE
											PRODUCTIONRESERVATION.ITEMTYPEAFICODE = 'RFD' AND PRODUCTIONRESERVATION.PRODUCTIONORDERCODE = '$nokk' 
											AND NOT SUFFIXCODE = '001'
										ORDER BY
											PRODUCTIONRESERVATION.GROUPLINE DESC LIMIT 1");
$dt_bonresep2 = db2_fetch_assoc($sql_bonresep2);
// NOW
?>
<form class="form-horizontal" action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
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
					<label for="nokk" class="col-sm-3 control-label">Production Order</label>
					<div class="col-sm-4">
						<input name="nokk" type="text" class="form-control" id="nokk"
							onchange="window.location='?p=Input-Bon&nokk='+this.value"
							value="<?php echo $_GET['nokk']; ?>" placeholder="Production Order" required>
					</div>
				</div>
				<div class="form-group">
					<label for="demand" class="col-sm-3 control-label">Production Demand</label>
					<div class="col-sm-8">
						<input name="demand" type="text" class="form-control" id="demand" value="<?= $dt_demand['DEMAND']; ?><?php if ($cek > 0) {
							  echo $rcek['nodemand'];
						  } ?>" placeholder="Production Demand">
					</div>
				</div>
				<div class="form-group">
					<label for="no_order" class="col-sm-3 control-label">No Order</label>
					<div class="col-sm-4">
						<input name="no_order" type="text" class="form-control" id="no_order" value="<?= $dt_ITXVIEWKK['PROJECTCODE']; ?><?php if ($cek > 0) {
							  echo $rcek['no_order'];
						  } else {
							  echo $r['NoOrder'];
						  } ?>" placeholder="No Order" required>
					</div>
				</div>
				<div class="form-group">
					<label for="no_po" class="col-sm-3 control-label">Pelanggan</label>
					<div class="col-sm-8">
						<input name="pelanggan" type="text" class="form-control" id="no_po" value="<?= $dt_pelanggan_buyer['PELANGGAN']; ?><?php if ($cek > 0) {
							  echo $rcek['langganan'];
						  } else if ($r1['partnername'] != "") {
							  echo $pelanggan;
						  } else {
						  } ?>" placeholder="Pelanggan">
					</div>
				</div>
				<div class="form-group">
					<label for="no_po" class="col-sm-3 control-label">PO</label>
					<div class="col-sm-5">
						<input name="no_po" type="text" class="form-control" id="no_po" value="<?= $dt_po['NO_PO']; ?><?php if ($cek > 0) {
							  echo $rcek['po'];
						  } else {
							  echo $r['PONumber'];
						  } ?>" placeholder="PO">
					</div>
				</div>
				<div class="form-group">
					<label for="no_hanger" class="col-sm-3 control-label">No Hanger / No Item</label>
					<div class="col-sm-3">
						<input name="no_hanger" type="text" class="form-control" id="no_hanger" value="<?= $dt_ITXVIEWKK['NO_HANGER'] ?><?php if ($cek > 0) {
							  echo $rcek['no_hanger'];
						  } else {
							  echo $r['HangerNo'];
						  } ?>" placeholder="No Hanger">
					</div>
					<div class="col-sm-3">
						<input name="no_item" type="text" class="form-control" id="no_item" value="<?= $dt_item['EXTERNALITEMCODE'] ?><?php if ($rcek['no_item'] != "") {
							  echo $rcek['no_item'];
						  } else {
							  echo $r['ProductCode'];
						  } ?>" placeholder="No Item">
					</div>
				</div>
				<div class="form-group">
					<label for="jns_kain" class="col-sm-3 control-label">Jenis Kain</label>
					<div class="col-sm-8">
						<textarea name="jns_kain" class="form-control" id="jns_kain" placeholder="Jenis Kain"><?= $dt_ITXVIEWKK['ITEMDESCRIPTION'] ?><?php if ($cek > 0) {
							  echo $rcek['jenis_kain'];
						  } else {
							  echo $r['ProductDesc'];
						  } ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label for="styl" class="col-sm-3 control-label">Style</label>
					<div class="col-sm-8">
						<input name="styl" type="text" class="form-control" id="styl" value="<?php if ($cek > 0) {
							echo $rcek['styl'];
						} else {
							echo $r['OtherDesc'];
						} ?>" placeholder="Style">
					</div>
				</div>
				<div class="form-group">
					<label for="l_g" class="col-sm-3 control-label">Lebar X Gramasi</label>
					<div class="col-sm-2">
						<input name="lebar" type="text" class="form-control" id="lebar" value="<?= $dt_lg['LEBAR']; ?><?php if ($cek > 0) {
							  echo $rcek['lebar'];
						  } else if ($nokk != "") {
							  echo round($r['Lebar']);
						  } else {
						  } ?>" placeholder="0" required>
					</div>
					<div class="col-sm-2">
						<input name="grms" type="text" class="form-control" id="grms" value="<?= $dt_lg['GRAMASI']; ?><?php if ($cek > 0) {
							  echo $rcek['gramasi'];
						  } else if ($nokk != "") {
							  echo round($r['Gramasi']);
						  } else {
						  } ?>" placeholder="0" required>
					</div>
				</div>
				<div class="form-group">
					<label for="warna" class="col-sm-3 control-label">Warna</label>
					<div class="col-sm-8">
						<textarea name="warna" class="form-control" id="warna" placeholder="Warna"><?= $dt_warna['WARNA']; ?><?php if ($cek > 0) {
							  echo $rcek['warna'];
						  } else {
							  echo $r['Color'];
						  } ?></textarea>
					</div>
				</div>
				<div class="form-group">

					<label for="no_warna" class="col-sm-3 control-label">No Warna</label>
					<div class="col-sm-8">
						<textarea name="no_warna" class="form-control" id="no_warna" placeholder="No Warna"><?= $dt_ITXVIEWKK['NO_WARNA']; ?><?php if ($cek > 0) {
							  echo $rcek['no_warna'];
						  } else {
							  echo $r['ColorNo'];
						  } ?></textarea>
					</div>
				</div>
			</div>
			<!-- col -->
			<div class="col-md-6">
				<div class="form-group">
					<label for="lot" class="col-sm-3 control-label">Lot</label>
					<div class="col-sm-3">
						<input name="lot" type="text" class="form-control" id="lot" value="<?php if ($cek > 0) {
							echo $rcek['lot'];
						} else {
							echo $lotno;
						} ?>" placeholder="Lot">
					</div>
				</div>
				<div class="form-group">
					<label for="proses" class="col-sm-3 control-label">Qty Order</label>
					<div class="col-sm-4">
						<div class="input-group">
							<input name="qty_order" type="text" class="form-control" id="qty_order" value="<?= $dt_qtyorder['QTY_ORDER']; ?><?php if ($cek > 0) {
								  echo $rcek['qty_order'];
							  } ?>" placeholder="0.00" style="text-align: right;" required>
							<span class="input-group-addon"><select name="satuan_o" style="font-size: 12px;"
									id="satuan1">
									<option value="KG" <?php if ($rcek['satuan_o'] == "KG") {
										echo "SELECTED";
									} ?>>KG</option>
									<option value="PCS" <?php if ($rcek['satuan_o'] == "PCS") {
										echo "SELECTED";
									} ?>>PCS</option>
								</select></span>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="tangggung_jawab" class="col-sm-3 control-label">Tanggung Jawab 1</label>
					<div class="col-sm-2">
						<select class="form-control select2" name="t_jawab">
							<option value="">Pilih</option>
							<option value="MKT" <?php if ($rcek['t_jawab'] == "MKT") {
								echo "SELECTED";
							} ?>>MKT</option>
							<option value="FIN" <?php if ($rcek['t_jawab'] == "FIN") {
								echo "SELECTED";
							} ?>>FIN</option>
							<option value="DYE" <?php if ($rcek['t_jawab'] == "DYE") {
								echo "SELECTED";
							} ?>>DYE</option>
							<option value="KNT" <?php if ($rcek['t_jawab'] == "KNT") {
								echo "SELECTED";
							} ?>>KNT</option>
							<option value="LAB" <?php if ($rcek['t_jawab'] == "LAB") {
								echo "SELECTED";
							} ?>>LAB</option>
							<option value="PRT" <?php if ($rcek['t_jawab'] == "PRT") {
								echo "SELECTED";
							} ?>>PRT</option>
							<option value="KNK" <?php if ($rcek['t_jawab'] == "KNK") {
								echo "SELECTED";
							} ?>>KNK</option>
							<option value="QCF" <?php if ($rcek['t_jawab'] == "QCF") {
								echo "SELECTED";
							} ?>>QCF</option>
							<option value="GKG" <?php if ($rcek['t_jawab'] == "GKG") {
								echo "SELECTED";
							} ?>>GKG</option>
							<option value="PRO" <?php if ($rcek['t_jawab'] == "PRO") {
								echo "SELECTED";
							} ?>>PRO</option>
							<option value="RMP" <?php if ($rcek['t_jawab'] == "RMP") {
								echo "SELECTED";
							} ?>>RMP</option>
							<option value="PPC" <?php if ($rcek['t_jawab'] == "PPC") {
								echo "SELECTED";
							} ?>>PPC</option>
							<option value="TAS" <?php if ($rcek['t_jawab'] == "TAS") {
								echo "SELECTED";
							} ?>>TAS</option>
							<option value="GKJ" <?php if ($rcek['t_jawab'] == "GKJ") {
								echo "SELECTED";
							} ?>>GKJ</option>
							<option value="BRS" <?php if ($rcek['t_jawab'] == "BRS") {
								echo "SELECTED";
							} ?>>BRS</option>
							<option value="CST" <?php if ($rcek['t_jawab'] == "CST") {
								echo "SELECTED";
							} ?>>CST</option>
						</select>
					</div>
					<div class="col-sm-3">
						<div class="input-group">
							<input name="persen" type="text" class="form-control" id="persen" value="<?php if ($cek > 0) {
								echo $rcek['persen'];
							} ?>" placeholder="0.00" style="text-align: right;">
							<span class="input-group-addon">%</span>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="tangggung_jawab" class="col-sm-3 control-label">Tanggung Jawab 2</label>
					<div class="col-sm-2">
						<select class="form-control select2" name="t_jawab1">
							<option value="">Pilih</option>
							<option value="MKT" <?php if ($rcek['t_jawab1'] == "MKT") {
								echo "SELECTED";
							} ?>>MKT</option>
							<option value="FIN" <?php if ($rcek['t_jawab1'] == "FIN") {
								echo "SELECTED";
							} ?>>FIN</option>
							<option value="DYE" <?php if ($rcek['t_jawab1'] == "DYE") {
								echo "SELECTED";
							} ?>>DYE</option>
							<option value="KNT" <?php if ($rcek['t_jawab1'] == "KNT") {
								echo "SELECTED";
							} ?>>KNT</option>
							<option value="LAB" <?php if ($rcek['t_jawab1'] == "LAB") {
								echo "SELECTED";
							} ?>>LAB</option>
							<option value="PRT" <?php if ($rcek['t_jawab1'] == "PRT") {
								echo "SELECTED";
							} ?>>PRT</option>
							<option value="KNK" <?php if ($rcek['t_jawab1'] == "KNK") {
								echo "SELECTED";
							} ?>>KNK</option>
							<option value="QCF" <?php if ($rcek['t_jawab1'] == "QCF") {
								echo "SELECTED";
							} ?>>QCF</option>
							<option value="GKG" <?php if ($rcek['t_jawab1'] == "GKG") {
								echo "SELECTED";
							} ?>>GKG</option>
							<option value="PRO" <?php if ($rcek['t_jawab1'] == "PRO") {
								echo "SELECTED";
							} ?>>PRO</option>
							<option value="RMP" <?php if ($rcek['t_jawab1'] == "RMP") {
								echo "SELECTED";
							} ?>>RMP</option>
							<option value="PPC" <?php if ($rcek['t_jawab1'] == "PPC") {
								echo "SELECTED";
							} ?>>PPC</option>
							<option value="TAS" <?php if ($rcek['t_jawab1'] == "TAS") {
								echo "SELECTED";
							} ?>>TAS</option>
							<option value="GKJ" <?php if ($rcek['t_jawab1'] == "GKJ") {
								echo "SELECTED";
							} ?>>GKJ</option>
							<option value="BRS" <?php if ($rcek['t_jawab1'] == "BRS") {
								echo "SELECTED";
							} ?>>BRS</option>
							<option value="CST" <?php if ($rcek['t_jawab1'] == "CST") {
								echo "SELECTED";
							} ?>>CST</option>
						</select>
					</div>
					<div class="col-sm-3">
						<div class="input-group">
							<input name="persen1" type="text" class="form-control" id="persen1" value="<?php if ($cek > 0) {
								echo $rcek['persen1'];
							} ?>" placeholder="0.00" style="text-align: right;">
							<span class="input-group-addon">%</span>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="tangggung_jawab" class="col-sm-3 control-label">Tanggung Jawab 3</label>
					<div class="col-sm-2">
						<select class="form-control select2" name="t_jawab2">
							<option value="">Pilih</option>
							<option value="MKT" <?php if ($rcek['t_jawab2'] == "MKT") {
								echo "SELECTED";
							} ?>>MKT</option>
							<option value="FIN" <?php if ($rcek['t_jawab2'] == "FIN") {
								echo "SELECTED";
							} ?>>FIN</option>
							<option value="DYE" <?php if ($rcek['t_jawab2'] == "DYE") {
								echo "SELECTED";
							} ?>>DYE</option>
							<option value="KNT" <?php if ($rcek['t_jawab2'] == "KNT") {
								echo "SELECTED";
							} ?>>KNT</option>
							<option value="LAB" <?php if ($rcek['t_jawab2'] == "LAB") {
								echo "SELECTED";
							} ?>>LAB</option>
							<option value="PRT" <?php if ($rcek['t_jawab2'] == "PRT") {
								echo "SELECTED";
							} ?>>PRT</option>
							<option value="KNK" <?php if ($rcek['t_jawab2'] == "KNK") {
								echo "SELECTED";
							} ?>>KNK</option>
							<option value="QCF" <?php if ($rcek['t_jawab2'] == "QCF") {
								echo "SELECTED";
							} ?>>QCF</option>
							<option value="GKG" <?php if ($rcek['t_jawab2'] == "GKG") {
								echo "SELECTED";
							} ?>>GKG</option>
							<option value="PRO" <?php if ($rcek['t_jawab2'] == "PRO") {
								echo "SELECTED";
							} ?>>PRO</option>
							<option value="RMP" <?php if ($rcek['t_jawab2'] == "RMP") {
								echo "SELECTED";
							} ?>>RMP</option>
							<option value="PPC" <?php if ($rcek['t_jawab2'] == "PPC") {
								echo "SELECTED";
							} ?>>PPC</option>
							<option value="TAS" <?php if ($rcek['t_jawab2'] == "TAS") {
								echo "SELECTED";
							} ?>>TAS</option>
							<option value="GKJ" <?php if ($rcek['t_jawab2'] == "GKJ") {
								echo "SELECTED";
							} ?>>GKJ</option>
							<option value="BRS" <?php if ($rcek['t_jawab2'] == "BRS") {
								echo "SELECTED";
							} ?>>BRS</option>
							<option value="CST" <?php if ($rcek['t_jawab2'] == "CST") {
								echo "SELECTED";
							} ?>>CST</option>
						</select>
					</div>
					<div class="col-sm-3">
						<div class="input-group">
							<input name="persen2" type="text" class="form-control" id="persen2" value="<?php if ($cek > 0) {
								echo $rcek['persen2'];
							} ?>" placeholder="0.00" style="text-align: right;">
							<span class="input-group-addon">%</span>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="masalah" class="col-sm-3 control-label">Masalah</label>
					<div class="col-sm-8">
						<textarea name="masalah" rows="5" class="form-control" id="masalah" placeholder="Masalah"><?php if ($cek > 0) {
							echo $rcek['masalah'];
						} ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label for="ket" class="col-sm-3 control-label">Keterangan</label>
					<div class="col-sm-8">
						<textarea name="ket" rows="5" class="form-control" id="ket" placeholder="Keterangan"><?php if ($cek > 0) {
							echo $rcek['ket'];
						} ?></textarea>
					</div>
				</div>
			</div>

		</div>
		<div class="box-footer">
			<?php if ($_GET['nokk'] != "" and $cek == 0) { ?>
				<button type="submit" class="btn btn-primary pull-right" name="save" value="save"><i class="fa fa-save"></i>
					Simpan</button>
			<?php } ?>
		</div>
		<!-- /.box-footer -->
	</div>
</form>


</div>
</div>
</div>
</div>
<?php
if (isset($_POST['save']) && $_POST['save'] == "save") {
	// Escape strings to prevent SQL injection
	$warna = str_replace("'", "''", $_POST['warna']);
	$nowarna = str_replace("'", "''", $_POST['no_warna']);
	$jns = str_replace("'", "''", $_POST['jns_kain']);
	$po = str_replace("'", "''", $_POST['no_po']);
	$masalah = str_replace("'", "''", $_POST['masalah']);
	$ket = str_replace("'", "''", $_POST['ket']);
	$styl = str_replace("'", "''", $_POST['styl']);
	$lot = trim($_POST['lot']);
	$sts = ($_POST['sts'] == "1") ? "1" : "0";

	$nokk = !empty($_POST['nokk']) ? $_POST['nokk'] : NULL;
	$demand = !empty($_POST['demand']) ? $_POST['demand'] : NULL;
	$pelanggan = !empty($_POST['pelanggan']) ? $_POST['pelanggan'] : NULL;
	$no_order = !empty($_POST['no_order']) ? $_POST['no_order'] : NULL;
	$no_hanger = !empty($_POST['no_hanger']) ? $_POST['no_hanger'] : NULL;
	$no_item = !empty($_POST['no_item']) ? $_POST['no_item'] : NULL;
	$lebar = !empty($_POST['lebar']) ? (int) $_POST['lebar'] : NULL;
	$grms = !empty($_POST['grms']) ? (int) $_POST['grms'] : NULL;
	$qty_order = !empty($_POST['qty_order']) ? $_POST['qty_order'] : NULL;
	$t_jawab = !empty($_POST['t_jawab']) ? $_POST['t_jawab'] : NULL;
	$t_jawab1 = !empty($_POST['t_jawab1']) ? $_POST['t_jawab1'] : NULL;
	$t_jawab2 = !empty($_POST['t_jawab2']) ? $_POST['t_jawab2'] : NULL;
	$persen = !empty($_POST['persen']) ? $_POST['persen'] : NULL;
	$persen1 = !empty($_POST['persen1']) ? $_POST['persen1'] : NULL;
	$persen2 = !empty($_POST['persen2']) ? $_POST['persen2'] : NULL;
	$satuan_o = !empty($_POST['satuan_o']) ? $_POST['satuan_o'] : NULL;
	$personil = !empty($_POST['personil']) ? $_POST['personil'] : NULL;
	$shift = !empty($_POST['shift']) ? $_POST['shift'] : NULL;
	$penyebab = !empty($_POST['penyebab']) ? $_POST['penyebab'] : NULL;

	$Ftgl_buat = new DateTime();
	$tgl_buat = $Ftgl_buat->format("Y-m-d");
	$tgl_update = $Ftgl_buat->format("Y-m-d H:i:s");

	$datainsert = [
		$nokk,
		$demand,
		$pelanggan,
		$no_order,
		$no_hanger,
		$no_item,
		$po,
		$jns,
		$styl,
		(int) $lebar,
		(int) $grms,
		$lot,
		$warna,
		$nowarna,
		$masalah,
		$qty_order,
		$t_jawab,
		$t_jawab1,
		$t_jawab2,
		$persen,
		$persen1,
		$persen2,
		$satuan_o,
		$personil,
		$shift,
		$penyebab,
		$sts,
		$ket,
		$tgl_buat,
		$tgl_update
	];

	$sqlData = "INSERT INTO db_dying.tbl_gantikain (
          nokk, 
		  nodemand, 
		  langganan, 
		  no_order, 
		  no_hanger, 
		  no_item, 
          po, 
		  jenis_kain, 
		  styl, 
		  lebar, 
		  gramasi, 
		  lot, 
		  warna, 
		  no_warna, 
          masalah, 
		  qty_order, 
		  t_jawab, 
		  t_jawab1, 
		  t_jawab2, 
		  persen, 
          persen1, 
		  persen2, 
		  satuan_o, 
		  personil,
		  shift, 
		  penyebab, 
		  sts, 
          ket,
		  tgl_buat, 
		  tgl_update
        ) VALUES (
		   ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
        )";

	// echo "<pre>";
	// echo "SQL Query:\n";
	// echo htmlspecialchars($sqlData) . "\n";
	// echo "Data to insert:\n";
	// var_dump($datainsert);
	// echo "</pre>";
	$stmt = sqlsrv_query($con, $sqlData, $datainsert);

	if ($stmt === false) {
		die(print_r(sqlsrv_errors(), true));
	} else {
		echo "<script>
            swal({
                title: 'Data Tersimpan',
                text: 'Klik Ok untuk input data kembali',
                type: 'success'
            }).then((result) => {
                if (result.value) {
                    window.location.href='index1.php?p=Input-Bon';
                }
            });
        </script>";
	}
}
?>