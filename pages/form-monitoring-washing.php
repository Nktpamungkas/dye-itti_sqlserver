<?php
$host1 = "10.0.0.4";
$username1 = "timdit";
$password1 = "4dm1n";
$db_name1 = "TM";
set_time_limit(600);
$connInfo = array("Database" => $db_name1, "UID" => $username1, "PWD" => $password1);
$conn = sqlsrv_connect($host1, $connInfo);
include "koneksiLAB.php";
include "koneksi.php";
//db_connect($db_name);
// $con=sqlsrv_connect("10.0.0.10","dit","4dm1n","db_dying");
$nokk = $_GET['nokk'];
$sqlCek = sqlsrv_query($con, "SELECT TOP 1 * FROM db_dying.tbl_schedule WHERE nokk='$nokk' ORDER BY id DESC", array(), array("Scrollable" => SQLSRV_CURSOR_KEYSET));
$cek = sqlsrv_num_rows($sqlCek);
$rcek = sqlsrv_fetch_array($sqlCek);
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


?>
<?php
// $sqlc="select convert(char(10),CreateTime,103) as TglBonResep,convert(char(10),CreateTime,108) as JamBonResep,ID_NO,COLOR_NAME,PROGRAM_NAME,PRODUCT_LOT,VOLUME,PROGRAM_CODE,YARN as NoKK,TOTAL_WT,USER25 from ticket_title where ID_NO='$rcek[no_resep]' order by createtime Desc";
// 				 //--lot
// $qryc=sqlsrv_query($conn1,$sqlc, array(), array("Scrollable"=>"static"));

// $countdata=sqlsrv_num_rows($qryc);

// if ($countdata > 0)
// {
// date_default_timezone_set('Asia/Jakarta');

// $tglsvr= sqlsrv_query($conn1,"SELECT CONVERT(VARCHAR(10),GETDATE(),105) AS  tgk");
// $sr=sqlsrv_fetch_array($tglsvr);
// $sqls=sqlsrv_query($conn,"SELECT processcontrolJO.SODID,salesorders.ponumber,processcontrol.productid,salesorders.customerid,joborders.documentno,
// salesorders.buyerid,processcontrolbatches.lotno,productcode,productmaster.color,colorno,description,weight,cuttablewidth,SOSampleColor.OtherDesc,SOSampleColor.Flag from Joborders 
// left join processcontrolJO on processcontrolJO.joid = Joborders.id
// left join salesorders on soid= salesorders.id
// Left join SOSampleColor on SOSampleColor.SOID=SalesOrders.id
// left join processcontrol on processcontrolJO.pcid = processcontrol.id
// left join processcontrolbatches on processcontrolbatches.pcid = processcontrol.id
// left join productmaster on productmaster.id= processcontrol.productid
// left join productpartner on productpartner.productid= processcontrol.productid
// where processcontrolbatches.documentno='".$rcek['nokk']."'");
// 		$ssr=sqlsrv_fetch_array($sqls);
// 		$lgn1=sqlsrv_query($conn,"select partnername from partners where id='$ssr[customerid]'");
// 		$ssr1=sqlsrv_fetch_array($lgn1);
// 		$lgn2=sqlsrv_query($conn,"select partnername from partners where id='$ssr[buyerid]'");
// 		$ssr2=sqlsrv_fetch_array($lgn2);
// 		$itm=sqlsrv_query($conn,"select colorcode,color,productcode from productpartner where productid='$ssr[productid]' and partnerid='$ssr[customerid]'");
// 		$itm2=sqlsrv_fetch_array($itm);
//  $row=sqlsrv_fetch_array($qryc);
//  //
//  $sql=sqlsrv_query($conn,"select stockmovement.dono,stockmovement.documentno as no_doku,processcontrolbatches.documentno,lotno,customerid,
// 	processcontrol.productid ,processcontrol.id as pcid, 
//   sum(stockmovementdetails.weight) as berat,
//   count(stockmovementdetails.weight) as roll,processcontrolbatches.dated as tgllot
//    from stockmovement 
// LEFT join stockmovementdetails on StockMovement.id=stockmovementdetails.StockmovementID
// left join processcontrolbatches on processcontrolbatches.id=stockmovement.pcbid
// left join processcontrol on processcontrol.id=processcontrolbatches.pcid



// where wid='12' and processcontrolbatches.documentno='".$rcek['nokk']."' and (transactiontype='7' or transactiontype='4')
// group by stockmovement.DocumentNo,processcontrolbatches.DocumentNo,processcontrolbatches.LotNo,stockmovement.dono,
// processcontrol.CustomerID,processcontrol.ProductID,processcontrol.ID,processcontrolbatches.Dated") or die("gagal");
// $c=0;
//  $r=sqlsrv_fetch_array($sql); 
//  	if($r['documentno']!=''){$dated = $r['tgllot']->format('Y-m-d H:i:s');} 
// 	 $sqlkko=sqlsrv_query($conn,"select SODID from knittingorders  
// 	where knittingorders.Kono='$r[dono]'") or die("gagal");
// 	$rkko=sqlsrv_fetch_array($sqlkko);
// 	 $sqlkko1=sqlsrv_query($conn,"select joid,productid from processcontroljo  
// 	where sodid='$rkko[SODID]'") or die("gagal");
// 	$rkko1=sqlsrv_fetch_array($sqlkko1);
// 	if($r['productid']!=''){$kno1=$r['productid'];}else{$kno1=$rkko1['productid'];}
// 	$sql1=sqlsrv_query($conn,"select hangerno,color from  productmaster
// 	where id='$kno1'") or die("gagal"); 
// 	 $r1=sqlsrv_fetch_array($sql1);
// 	 $sql2=sqlsrv_query($conn,"select partnername from Partners
// 	where id='$r[customerid]'") or die("gagal"); 
// 	 $r2=sqlsrv_fetch_array($sql2);
// 	 $sql3=sqlsrv_query($conn,"select Kono,joid from processcontroljo 
// 	where pcid='$r[pcid]'") or die("gagal"); 
// 	$r3=sqlsrv_fetch_array($sql3);
// 	if($r3['Kono']!=''){$kno=$r3['Kono'];}else{$kno=$r['dono'];}
// 	 $sql4=sqlsrv_query($conn,"select CAST(TM.dbo.knittingorders.[Note] AS VARCHAR(8000))as note,id,supplierid from knittingorders 
// 	where kono='$kno'") or die("gagal");
// 	 $r4=sqlsrv_fetch_array($sql4);
// 	 $sql5=sqlsrv_query($conn,"select partnername from partners 
// 	where id='$r4[supplierid]'") or die("gagal");
// 	 $r5=sqlsrv_fetch_array($sql5);
// 	 if($r3['joid']!=''){$jno=$r3['joid'];}else{$jno=$rkko1['joid'];}
// 	 $sql6=sqlsrv_query($conn,"select documentno,soid from joborders 
// 	where id='$jno'") or die("gagal");
// 	 $r6=sqlsrv_fetch_array($sql6);
// 	  $sql8=sqlsrv_query($conn,"select customerid from salesorders where id='$r6[soid]'") or die("gagal");
// 	 $r8=sqlsrv_fetch_array($sql8);
// 	 $sql9=sqlsrv_query($conn,"select partnername from partners where id='$r8[customerid]'") or die("gagal");
// 	 $r9=sqlsrv_fetch_array($sql9);
// 	 $sql10=sqlsrv_query($conn,"select id,productid from kodetails where koid='$r4[id]'") or die("gagal");
// 	 $r10=sqlsrv_fetch_array($sql10);
// 	 $sql11=sqlsrv_query($conn,"select productnumber from productmaster where id='$r10[productid]'") or die("gagal");
// 	 $r11=sqlsrv_fetch_array($sql11);


// 	 $s4=sqlsrv_query($conn,"select KOdetails.id as KODID,productmaster.id as BOMID ,KnittingOrders.SupplierID,TM.dbo.Partners.PartnerName,ProductNumber,CustomerID,SODID,KnittingOrders.ID as KOID,SalesOrders.ID as SOID from 
// (TM.dbo.KnittingOrders 
// left join TM.dbo.SODetails on TM.dbo.SODetails.ID= TM.dbo.KnittingOrders.SODID
// left join TM.dbo.KODetails on TM.dbo.KODetails.KOid= TM.dbo.KnittingOrders.ID
// left join TM.dbo.Partners on TM.dbo.Partners.ID= TM.dbo.KnittingOrders.SupplierID)
// left join TM.dbo.ProductMaster on TM.dbo.ProductMaster.ID= TM.dbo.KODetails.ProductID
// left join TM.dbo.SalesOrders on TM.dbo.SalesOrders.ID= TM.dbo.SODetails.SOID
// 		where KONO='$kno'");
// 	 $as7=sqlsrv_fetch_array($s4);
// 	 $sql12=sqlsrv_query($conn,"select SODetailsBom.ProductID from SODetailsBom where SODID='$as7[SODID]' and KODID='$as7[KODID]' and Parentproductid='$as7[BOMID]' order by ID", array(), array("Scrollable"=>"static"));
// 	  $sql14=sqlsrv_query($conn,"select  count(lotno)as jmllot from processcontrolbatches where pcid='$r[pcid]' and dated='$dated'");
// 	  $lt=sqlsrv_fetch_array($sql14);
// 	 $ai=sqlsrv_num_rows($sql12);
// 	 $sql15=sqlsrv_query($conn,"select Partnername from TM.dbo.Partners where TM.dbo.Partners.ID='$as7[CustomerID]'");
// 	$as8=sqlsrv_fetch_array($sql15);
// $i=0;



//  do{
// 	$as5=sqlsrv_fetch_array($sql12);
// 	$sql13=sqlsrv_query($conn,"select ShortDescription from  ProductMaster where ID='$as5[ProductID]'");
// 	$as6=sqlsrv_fetch_array($sql13);
// 	$ar[$i]=$as6['ShortDescription'];

// $i++;
// }while($ai>=$i);
// $jb1=$ar[0];
// $jb2=$ar[1];
// $jb3=$ar[2];
// $jb4=$ar[3];
// if($ai<2){$jb1=$ar[0];
// $jb2='';
// $jb3='';
// }
// 	$bng=$jb1.",".$jb2.",".$jb3.",".$jb4;
// }
if ($nokk != "" and $rcek2['bruto'] != "" and $rcek2['bruto'] > 0) {
	$lr = round($row['VOLUME'] / $rcek2['bruto']);
} else {
	$lr = "";
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
<?php
$Kapasitas = isset($_POST['kapasitas']) ? $_POST['kapasitas'] : '';
$TglMasuk = isset($_POST['tglmsk']) ? $_POST['tglmsk'] : '';
$Item = isset($_POST['item']) ? $_POST['item'] : '';
$Warna = isset($_POST['warna']) ? $_POST['warna'] : '';
$Langganan = isset($_POST['langganan']) ? $_POST['langganan'] : '';
?>
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
					<div class="col-sm-4">
						<input name="nokk" type="text" class="form-control" id="nokk"
							onchange="window.location='?p=Form-Monitoring-Washing&nokk='+this.value"
							value="<?php echo $_GET['nokk']; ?>" placeholder="No KK" required>
					</div>
					<div class="col-sm-4">
						<input name="id" type="hidden" class="form-control" id="id" value="<?php echo $rcek['id']; ?>"
							placeholder="ID">
					</div>
				</div>
				<div class="form-group">
					<label for="l_g" class="col-sm-3 control-label">L X Grm Permintaan</label>
					<div class="col-sm-2">
						<input name="lebar" type="text" class="form-control" id="lebar"
							value="<?php if ($cek > 0) {
								echo $rcek['lebar'];
							} else {
								echo round($r['Lebar']);
							} ?>"
							placeholder="0" required>
					</div>
					<div class="col-sm-2">
						<input name="grms" type="text" class="form-control" id="grms"
							value="<?php if ($cek > 0) {
								echo $rcek['gramasi'];
							} else {
								echo round($r['Gramasi']);
							} ?>"
							placeholder="0" required>
					</div>
				</div>
				<div class="form-group">
					<label for="qty_order" class="col-sm-3 control-label">Qty Order</label>
					<div class="col-sm-3">
						<div class="input-group">
							<input name="qty1" type="text" class="form-control" id="qty1"
								value="<?php if ($cek > 0) {
									echo $rcek['qty_order'];
								} else {
									echo round($r['BatchQuantity'], 2);
								} ?>"
								placeholder="0.00" required>
							<span class="input-group-addon">KGs</span>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="input-group">
							<input name="qty2" type="text" class="form-control" id="qty2"
								value="<?php if ($cek > 0) {
									echo $rcek['pjng_order'];
								} else {
									echo round($r['Quantity'], 2);
								} ?>"
								placeholder="0.00" style="text-align: right;" required>
							<span class="input-group-addon">
								<select name="satuan1" style="font-size: 12px;">
									<option value="Yard" <?php if ($rcek['satuan_order'] == "Yard") {
										echo "SELECTED";
									} ?>>
										Yard</option>
									<option value="Meter" <?php if ($rcek['satuan_order'] == "Meter") {
										echo "SELECTED";
									} ?>>Meter</option>
									<option value="PCS" <?php if ($rcek['satuan_order'] == "PCS") {
										echo "SELECTED";
									} ?>>PCS
									</option>
								</select>
							</span>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="lot" class="col-sm-3 control-label">Lot</label>
					<div class="col-sm-2">
						<input name="lot" type="text" class="form-control" id="lot"
							value="<?php if ($cek > 0) {
								echo $rcek['lot'];
							} else {
								if ($nomorLot != "") {
									echo $lotno;
								} else if ($nokk != "") {
									echo $cekM['lot'];
								}
							} ?>"
							placeholder="Lot">
					</div>
				</div>
				<div class="form-group">
					<label for="jml_bruto" class="col-sm-3 control-label">Rol &amp; Qty</label>
					<div class="col-sm-2">
						<input name="qty3" type="text" class="form-control" id="qty3"
							value="<?php if ($cek2 > 0) {
								echo $rcek2['rol'] . $rcek2['kk'];
							} ?>" placeholder="0.00" required>
					</div>
					<div class="col-sm-3">
						<div class="input-group">
							<input name="qty4" type="text" class="form-control" id="qty4"
								value="<?php if ($cek2 > 0) {
									echo $rcek2['bruto'];
								} ?>" placeholder="0.00"
								style="text-align: right;" required>
							<span class="input-group-addon">KGs</span>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="no_resep" class="col-sm-3 control-label">No Bon Resep 1</label>
					<div class="col-sm-3">
						<input name="no_resep" type="text" class="form-control" id="no_resep"
							value="<?php if ($cek > 0) {
								echo $rcek['no_resep'];
							} ?>" placeholder="No Bon Resep 1">
					</div>
				</div>
				<div class="form-group">
					<label for="no_resep2" class="col-sm-3 control-label">No Bon Resep 2</label>
					<div class="col-sm-3">
						<input name="no_resep2" type="text" class="form-control" id="no_resep2"
							value="<?php if ($cek > 0) {
								echo $rcek['no_resep2'];
							} ?>" placeholder="No Bon Resep 2">
					</div>
				</div>
				<div class="form-group">
					<label for="a_dingin" class="col-sm-3 control-label">Pemakaian Air</label>
					<div class="col-sm-3">
						<div class="input-group">
							<input name="pakai_air" type="text" class="form-control" id="pakai_air"
								value="<?php echo $row['VOLUME']; ?>" placeholder="0.00" style="text-align: right;">
							<span class="input-group-addon">L</span>
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
						<input name="std_cok_wrn" type="text" class="form-control" id="std_cok_wrn" value="<?php if ($ssr['Flag'] == " 1") {
							echo "Original Color";
						} elseif ($ssr['Flag'] == "2") {
							echo "Color LD";
						} else {
							echo
								$ssr['OtherDesc'];
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
					<div class="col-sm-5">
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

				</div>
				<!--  
		<div class="form-group">
		  <label for="colorist" class="col-sm-3 control-label">Colorist </label>
				  <div class="col-sm-5">					  
					<select name="colorist" class="form-control" required>
								  <option value="">Pilih</option>
							  <?php
							  $sqlKap = sqlsrv_query($con, "SELECT nama FROM db_dying.tbl_staff WHERE jabatan='Colorist' ORDER BY nama ASC");
							  while ($rK = sqlsrv_fetch_array($sqlKap)) {
								  ?>
								  <option value="<?php echo $rK['nama']; ?>"><?php echo $rK['nama']; ?></option>
							 <?php } ?>	  
					  </select>
				  </div>
					  
		</div>
		-->
				<div class="form-group">
					<label for="leader" class="col-sm-3 control-label">Leader </label>
					<div class="col-sm-5">
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

				</div>
				<div class="form-group">
					<label for="a_dingin" class="col-sm-3 control-label">No. Program</label>
					<div class="col-sm-3">
						<input name="no_program" type="text" class="form-control" id="no_program" value=""
							placeholder="No. Program">
					</div>
				</div>
				<div class="form-group">
					<label for="l_g" class="col-sm-3 control-label">L X Grm Sebelum</label>
					<div class="col-sm-2">
						<input name="lebar_a" type="text" class="form-control" id="lebar_a" value="" placeholder="0"
							required>
					</div>
					<div class="col-sm-2">
						<input name="grms_a" type="text" class="form-control" id="grms_a" value="" placeholder="0"
							required onChange="hitung();">
					</div>
				</div>
				<div class="form-group">
					<label for="l_g1" class="col-sm-3 control-label">L X Grm Sesudah</label>
					<div class="col-sm-2">
						<input name="lebar1_a" type="text" class="form-control" id="lebar1_a" value="" placeholder="0"
							required onChange="susut();">
					</div>
					<div class="col-sm-2">
						<input name="grms1_a" type="text" class="form-control" id="grms1_a" value="" placeholder="0"
							required>
					</div>
				</div>
				<div class="form-group">
					<label for="susut_lebar" class="col-sm-3 control-label">Susut Lebar</label>
					<div class="col-sm-3">
						<div class="input-group">
							<input name="susut_lebar" type="text" style="text-align: right;" class="form-control"
								id="susut_lebar" value="" placeholder="0.00">
							<span class="input-group-addon">%</span>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="susut_panjang" class="col-sm-3 control-label">Susut Panjang</label>
					<div class="col-sm-3">
						<div class="input-group">
							<input name="susut_panjang" type="text" style="text-align: right;" class="form-control"
								id="susut_panjang" value="" placeholder="0.00">
							<span class="input-group-addon">%</span>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="pjng_kain" class="col-sm-3 control-label">Panjang Kain</label>
					<div class="col-sm-3">
						<input name="pjng_kain" type="text" class="form-control" id="pjng_kain"
							value="<?php if ($cek > 0) {
								echo $rcek['pnjg_kain'];
							} ?>" placeholder="0.00"
							style="text-align: right;" readonly>
					</div>
				</div>
				<div class="form-group">
					<label for="speed" class="col-sm-3 control-label">speed</label>
					<div class="col-sm-3">
						<div class="input-group">
							<input name="speed" type="text" style="text-align: right;" class="form-control" id="speed"
								value="" placeholder="0.00">
							<span class="input-group-addon">m/mnt</span>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="vacum" class="col-sm-3 control-label">Vacuum Pump</label>
					<div class="col-sm-3">
						<div class="input-group">
							<input name="vacum" type="text" style="text-align: right;" class="form-control" id="vacum"
								value="" placeholder="0.00">
							<span class="input-group-addon">%</span>
						</div>
					</div>
				</div>
			</div>

			<!-- col -->
			<div class="col-md-6">
				<div class="form-group">
					<label for="ch1" class="col-sm-3 control-label">Chamber 1</label>
					<div class="col-sm-2">
						<div class="input-group">
							<input name="ch1" type="text" class="form-control" id="ch1" value="" placeholder="0">
							<span class="input-group-addon">&deg;</span>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="ch2" class="col-sm-3 control-label">Chamber 2</label>
					<div class="col-sm-2">
						<div class="input-group">
							<input name="ch2" type="text" class="form-control" id="ch2" value="" placeholder="0">
							<span class="input-group-addon">&deg;</span>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="ch3" class="col-sm-3 control-label">Chamber 3</label>
					<div class="col-sm-2">
						<div class="input-group">
							<input name="ch3" type="text" class="form-control" id="ch3" value="" placeholder="0">
							<span class="input-group-addon">&deg;</span>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="ch4" class="col-sm-3 control-label">Chamber 4</label>
					<div class="col-sm-2">
						<div class="input-group">
							<input name="ch4" type="text" class="form-control" id="ch4" value="" placeholder="0">
							<span class="input-group-addon">&deg;</span>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="ch5" class="col-sm-3 control-label">Chamber 5</label>
					<div class="col-sm-2">
						<div class="input-group">
							<input name="ch5" type="text" class="form-control" id="ch5" value="" placeholder="0">
							<span class="input-group-addon">&deg;</span>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="ch6" class="col-sm-3 control-label">Chamber 6</label>
					<div class="col-sm-2">
						<div class="input-group">
							<input name="ch6" type="text" class="form-control" id="ch6" value="" placeholder="0">
							<span class="input-group-addon">&deg;</span>
						</div>
					</div>
				</div>

				<div class="form-group">
					<label for="vr1" class="col-sm-3 control-label">VR 1</label>
					<div class="col-sm-2">
						<input name="vr1" type="text" class="form-control" id="vr1" value="" placeholder="0">
					</div>
				</div>
				<div class="form-group">
					<label for="vr2" class="col-sm-3 control-label">VR 2</label>
					<div class="col-sm-2">
						<input name="vr2" type="text" class="form-control" id="vr2" value="" placeholder="0">
					</div>
				</div>
				<div class="form-group">
					<label for="vr3" class="col-sm-3 control-label">VR 3</label>
					<div class="col-sm-2">
						<input name="vr3" type="text" class="form-control" id="vr3" value="" placeholder="0">
					</div>
				</div>
				<div class="form-group">
					<label for="vr4" class="col-sm-3 control-label">VR 4</label>
					<div class="col-sm-2">
						<input name="vr4" type="text" class="form-control" id="vr4" value="" placeholder="0">
					</div>
				</div>
				<div class="form-group">
					<label for="vr5" class="col-sm-3 control-label">VR 5</label>
					<div class="col-sm-2">
						<input name="vr5" type="text" class="form-control" id="vr5" value="" placeholder="0">
					</div>
				</div>
				<div class="form-group">
					<label for="vr6" class="col-sm-3 control-label">VR 6</label>
					<div class="col-sm-2">
						<input name="vr6" type="text" class="form-control" id="vr6" value="" placeholder="0">
					</div>
				</div>
				<div class="form-group">
					<label for="vr7" class="col-sm-3 control-label">VR 7</label>
					<div class="col-sm-2">
						<input name="vr7" type="text" class="form-control" id="vr7" value="" placeholder="0">
					</div>
				</div>
				<div class="form-group">
					<label for="vr8" class="col-sm-3 control-label">VR 8</label>
					<div class="col-sm-2">
						<input name="vr8" type="text" class="form-control" id="vr8" value="" placeholder="0">
					</div>
				</div>
				<div class="form-group">
					<label for="vr9" class="col-sm-3 control-label">VR 9</label>
					<div class="col-sm-2">
						<input name="vr9" type="text" class="form-control" id="vr9" value="" placeholder="0">
					</div>
				</div>
				<div class="form-group">
					<label for="vr10" class="col-sm-3 control-label">VR 10</label>
					<div class="col-sm-2">
						<input name="vr10" type="text" class="form-control" id="vr10" value="" placeholder="0">
					</div>
				</div>
				<div class="form-group">
					<label for="vr11" class="col-sm-3 control-label">VR 11</label>
					<div class="col-sm-2">
						<input name="vr11" type="text" class="form-control" id="vr11" value="" placeholder="0">
					</div>
				</div>
				<div class="form-group">
					<label for="vr12" class="col-sm-3 control-label">VR 12</label>
					<div class="col-sm-2">
						<input name="vr12" type="text" class="form-control" id="vr12" value="" placeholder="0">
					</div>
				</div>
				<div class="form-group">
					<label for="vr13" class="col-sm-3 control-label">VR 13</label>
					<div class="col-sm-2">
						<input name="vr13" type="text" class="form-control" id="vr13" value="" placeholder="0">
					</div>
				</div>
				<div class="form-group">
					<label for="vr14" class="col-sm-3 control-label">VR 14</label>
					<div class="col-sm-2">
						<input name="vr14" type="text" class="form-control" id="vr14" value="" placeholder="0">
					</div>
				</div>
				<div class="form-group">
					<label for="vr15" class="col-sm-3 control-label">VR 15</label>
					<div class="col-sm-2">
						<input name="vr15" type="text" class="form-control" id="vr15" value="" placeholder="0">
					</div>
				</div>
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
					<label for="ket" class="col-sm-3 control-label">Keterangan</label>
					<div class="col-sm-8">
						<textarea name="ket" class="form-control"><?php echo $ketsts; ?></textarea>
					</div>

				</div>
			</div>


			<input type="hidden" value="<?php if ($cek > 0) {
				echo $rcek['no_ko'];
			} else {
				echo $rKO['KONo'];
			} ?>" name="no_ko">
			<input type="hidden"
				value="<?php if ($cek > 0) {
					echo cekDesimal($rcek['target']);
				} else {
					echo cekDesimal($rKO['target']);
				} ?>"
				name="target">

		</div>
		<div class="box-footer">
			<button type="button" class="btn btn-default pull-left" name="back" value="kembali"
				onClick="window.location='?p=Monitoring-Tempelan'">Kembali <i
					class="fa fa-arrow-circle-o-left"></i></button>
			<?php if ($cek1 > 0) {
				echo "<script>swal({
  title: 'No Kartu Sudah diinput dan belum selesai proses',
  text: 'Klik Ok untuk input kembali',
  type: 'warning',
  }).then((result) => {
  if (result.value) {
    window.location='index1.php?p=Form-Monitoring-Washing';
  }
});</script>";
			} else if ($rcek['no_urut'] != "1" and $nokk != "") {
				echo "<script>swal({
  title: 'Harus No Urut `1` ',
  text: 'Klik Ok untuk input kembali',
  type: 'warning',
  }).then((result) => {
  if (result.value) {
    window.location='index1.php?p=Form-Monitoring-Washing';
  }
});</script>";
			} else { ?>
					<button type="submit" class="btn btn-primary pull-right" name="save" value="save">Simpan <i
							class="fa fa-save"></i></button>
			<?php } ?>

		</div>
		<!-- /.box-footer -->
	</div>
</form>




<?php
if ($_POST['save'] == "save") {
	// Handling untuk data insert
	$benang = str_replace("'", "''", $_POST['benang']);
	$tglbuat = $_POST['tgl_buat'] . " " . $_POST['waktu_buat'];
	if($_POST['id']!=NULL or $_POST['id']!=''){
		$id=$_POST['id'];
	}else{
		$id=NULL;
	}
	if ($_POST['nokk'] != NULL or $_POST['nokk'] != '') {
		$nokk = $_POST['nokk'];
	} else {
		$nokk = NULL;
	}
	if ($_POST['operator'] != NULL or $_POST['operator'] != '') {
		$operator = $_POST['operator'];
	} else {
		$operator = NULL;
	}
	if ($_POST['colorist'] != NULL or $_POST['colorist'] != '') {
		$colorist = $_POST['colorist'];
	} else {
		$colorist = NULL;
	}
	if ($_POST['leader'] != NULL or $_POST['leader'] != '') {
		$leader = $_POST['leader'];
	} else {
		$leader = NULL;
	}
	if ($_POST['pakai_air'] != NULL or $_POST['pakai_air'] != '') {
		$pakai_air = ROUND($_POST['pakai_air']);
	} else {
		$pakai_air = NULL;
	}
	if ($_POST['carry_over'] != NULL or $_POST['carry_over'] != '') {
		$carry_over = $_POST['carry_over'];
	} else {
		$carry_over = NULL;
	}
	if ($_POST['shift'] != NULL or $_POST['shift'] != '') {
		$shift = $_POST['shift'];
	} else {
		$shift = NULL;
	}
	if ($_POST['grms_a'] != NULL or $_POST['grms_a'] != '') {
		$grms_a = $_POST['grms_a'];
	} else {
		$grms_a = NULL;
	}
	if ($_POST['lebar1_a'] != NULL or $_POST['lebar1_a'] != '') {
		$lebar1_a = $_POST['lebar1_a'];
	} else {
		$lebar1_a = NULL;
	}
	if ($_POST['lebar_a'] != NULL or $_POST['lebar_a'] != '') {
		$lebar_a = $_POST['lebar_a'];
	} else {
		$lebar_a = NULL;
	}
	if ($_POST['grms1_a'] != NULL or $_POST['grms1_a'] != '') {
		$grms1_a = $_POST['grms1_a'];
	} else {
		$grms1_a = NULL;
	}
	if ($_POST['pjng_kain'] != NULL or $_POST['pjng_kain'] != '') {
		$pjng_kain = $_POST['pjng_kain'];
	} else {
		$pjng_kain = NULL;
	}
	if ($_POST['qty3'] != NULL or $_POST['qty3'] != '') {
		$qty3 = $_POST['qty3'];
	} else {
		$qty3 = NULL;
	}
	if ($_POST['qty4'] != NULL or $_POST['qty4'] != '') {
		$qty4 = $_POST['qty4'];
	} else {
		$qty4 = NULL;
	}
	if ($_POST['g_shift'] != NULL or $_POST['g_shift'] != '') {
		$g_shift = $_POST['g_shift'];
	} else {
		$g_shift = NULL;
	}
	if ($_POST['no_program'] != NULL or $_POST['no_program'] != '') {
		$no_program = $_POST['no_program'];
	} else {
		$no_program = NULL;
	}
	if ($_POST['std_cok_wrn'] != NULL or $_POST['std_cok_wrn'] != '') {
		$std_cok_wrn = $_POST['std_cok_wrn'];
	} else {
		$std_cok_wrn = NULL;
	}
	if ($_POST['speed'] != NULL or $_POST['speed'] != '') {
		$speed = $_POST['speed'];
	} else {
		$speed = NULL;
	}
	if ($_POST['susut_lebar'] != NULL or $_POST['susut_lebar'] != '') {
		$susut_lebar = $_POST['susut_lebar'];
	} else {
		$susut_lebar = NULL;
	}
	if ($_POST['susut_panjang'] != NULL or $_POST['susut_panjang'] != '') {
		$susut_panjang = $_POST['susut_panjang'];
	} else {
		$susut_panjang = NULL;
	}
	if ($_POST['vacum'] != NULL or $_POST['vacum'] != '') {
		$vacum = $_POST['vacum'];
	} else {
		$vacum = NULL;
	}
	if ($_POST['ch1'] != NULL or $_POST['ch1'] != '') {
		$ch1 = $_POST['ch1'];
	} else {
		$ch1 = NULL;
	}
	if ($_POST['ch2'] != NULL or $_POST['ch2'] != '') {
		$ch2 = $_POST['ch2'];
	} else {
		$ch2 = NULL;
	}
	if ($_POST['ch3'] != NULL or $_POST['ch3'] != '') {
		$ch3 = $_POST['ch3'];
	} else {
		$ch3 = NULL;
	}
	if ($_POST['ch4'] != NULL or $_POST['ch4'] != '') {
		$ch4 = $_POST['ch4'];
	} else {
		$ch4 = NULL;
	}
	if ($_POST['ch5'] != NULL or $_POST['ch5'] != '') {
		$ch5 = $_POST['ch5'];
	} else {
		$ch5 = NULL;
	}
	if ($_POST['ch6'] != NULL or $_POST['ch6'] != '') {
		$ch6 = $_POST['ch6'];
	} else {
		$ch6 = NULL;
	}
	if ($_POST['ch1'] != NULL or $_POST['ch1'] != '') {
		$ch1 = $_POST['ch1'];
	} else {
		$ch1 = NULL;
	}
	if ($_POST['vr1'] != NULL or $_POST['vr1'] != '') {
		$vr1 = $_POST['vr1'];
	} else {
		$vr1 = NULL;
	}
	if ($_POST['vr2'] != NULL or $_POST['vr2'] != '') {
		$vr2 = $_POST['vr2'];
	} else {
		$vr2 = NULL;
	}
	if ($_POST['vr3'] != NULL or $_POST['vr3'] != '') {
		$vr3 = $_POST['vr3'];
	} else {
		$vr3 = NULL;
	}
	if ($_POST['vr4'] != NULL or $_POST['vr4'] != '') {
		$vr4 = $_POST['vr4'];
	} else {
		$vr4 = NULL;
	}
	if ($_POST['vr5'] != NULL or $_POST['vr5'] != '') {
		$vr5 = $_POST['vr5'];
	} else {
		$vr5 = NULL;
	}
	if ($_POST['vr6'] != NULL or $_POST['vr6'] != '') {
		$vr6 = $_POST['vr6'];
	} else {
		$vr6 = NULL;
	}
	if ($_POST['vr7'] != NULL or $_POST['vr7'] != '') {
		$vr7 = $_POST['vr7'];
	} else {
		$vr7 = NULL;
	}
	if ($_POST['vr8'] != NULL or $_POST['vr8'] != '') {
		$vr8 = $_POST['vr8'];
	} else {
		$vr8 = NULL;
	}
	if ($_POST['vr9'] != NULL or $_POST['vr9'] != '') {
		$vr9 = $_POST['vr9'];
	} else {
		$vr9 = NULL;
	}
	if ($_POST['vr10'] != NULL or $_POST['vr10'] != '') {
		$vr10 = $_POST['vr10'];
	} else {
		$vr10 = NULL;
	}
	if ($_POST['vr11'] != NULL or $_POST['vr11'] != '') {
		$vr11 = $_POST['vr11'];
	} else {
		$vr11 = NULL;
	}
	if ($_POST['vr12'] != NULL or $_POST['vr12'] != '') {
		$vr12 = $_POST['vr12'];
	} else {
		$vr12 = NULL;
	}
	if ($_POST['vr13'] != NULL or $_POST['vr13'] != '') {
		$vr13 = $_POST['vr13'];
	} else {
		$vr13 = NULL;
	}
	if ($_POST['vr14'] != NULL or $_POST['vr14'] != '') {
		$vr14 = $_POST['vr14'];
	} else {
		$vr14 = NULL;
	}
	if ($_POST['vr15'] != NULL or $_POST['vr15'] != '') {
		$vr15 = $_POST['vr15'];
	} else {
		$vr15 = NULL;
	}
	$tgl_buat = Date('Y-m-d H:i:s');
	if ($_POST['ket'] != NULL or $_POST['ket'] != '') {
		$ket = $_POST['ket'];
	} else {
		$ket = NULL;
	}

	$tglbuat= new DateTime();
	// Ambil target menit dari input POST
	$targetMinutes = intval($_POST['target']);

	// Buat interval waktu dalam format yang sesuai
	$interval = new DateInterval("PT{$targetMinutes}M");

	// Tambahkan interval ke objek DateTime
	$tglbuat->add($interval);

	// Format tanggal target
	$tgl_target = $tglbuat->format("Y-m-d H:i:s");

	if($tgl_buat!=NULL or $tgl_buat!='' or $tgl_buat!='1900-01-01 00:00:00.000'){
	$tglupdate =$tgl_buat;
	}else{
		$tglupdate = NULL;
	}
	// var_dump($pakai_air);
	// var_dump($_POST['pakai_air']);


	$insertdata = [
		$id,
		$nokk,
		$operator,
		$leader,
		$pakai_air,
		$shift,
		$grms_a,
		$lebar_a,
		$grms1_a,
		$lebar1_a,
		$pjng_kain,
		$qty3,
		$qty4,
		$g_shift,
		$no_program,
		$benang,
		$std_cok_wrn,
		$speed,
		$susut_lebar,
		$susut_panjang,
		$vacum,
		$ch1,
		$ch2,
		$ch3,
		$ch4,
		$ch5,
		$ch6,
		$vr1,
		$vr2,
		$vr3,
		$vr4,
		$vr5,
		$vr6,
		$vr7,
		$vr8,
		$vr9,
		$vr10,
		$vr11,
		$vr12,
		$vr13,
		$vr14,
		$vr15,
		$ket,
		$tgl_buat,
		$tgl_target,
		$tglupdate
	];
		// var_dump($insertdata);
	$sqlData = "INSERT INTO db_dying.tbl_montemp (id_schedule,
	nokk,
	operator,leader,pakai_air,shift,gramasi_a,lebar_a,gramasi_s,lebar_s,pjng_kain,rol,bruto,
	g_shift,no_program,benang,std_cok_wrn,speed,susut_lebar,susut_panjang,vacum,ch1,ch2,ch3,ch4,ch5,ch6,vr1,vr2,vr3,vr4,vr5,vr6,vr7,vr8,vr9,vr10,vr11,vr12,vr13,vr14,vr15,ket,tgl_buat,tgl_target,tgl_update) VALUES 
	(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

	$stmt = sqlsrv_prepare($con, $sqlData, $insertdata);

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
		/*$sqlD=sqlsrv_query("UPDATE tbl_schedule SET 
			   status='sedang jalan',
			   tgl_update=now()
			   WHERE id='$_POST[id]' ");*/

		$sqlD = sqlsrv_query($con, "UPDATE db_dying.tbl_schedule SET 
		  status='sedang jalan',
		  tgl_update=GETDATE()
		  WHERE [status]='antri mesin' and no_mesin='" . $rcek['no_mesin'] . "' and no_urut='1' ");

		echo "<script>swal({
  title: 'Data Tersimpan',   
  text: 'Klik Ok untuk input data kembali',
  type: 'success',
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
		  operator='$_POST[operator]',
		  colorist='$_POST[colorist]',
		  leader='$_POST[leader]',
		  shift='$_POST[shift]',
		  gramasi_a='$_POST[grms_a]',
		  lebar_a='$_POST[lebar_a]',
		  rol='$_POST[qty3]',
		  bruto='$_POST[qty4]',
		  pjng_kain='$_POST[pjng_kain]',
		  g_shift='$_POST[g_shift]',
		  no_program='$_POST[no_program]',
		  speed='$_POST[speed]',
		  susut_lebar='$_POST[susut_lebar]',
		  susut_panjang='$_POST[susut_panjang]',
		  vacum='$_POST[vacum]',
		  ch1='$_POST[ch1]',
		  ch2='$_POST[ch2]',
		  ch3='$_POST[ch3]',
		  ch4='$_POST[ch4]',
		  ch5='$_POST[ch5]',
		  ch6='$_POST[ch6]',
		  vr1='$_POST[vr1]',
		  vr2='$_POST[vr2]',
		  vr3='$_POST[vr3]',
		  vr4='$_POST[vr4]',
		  vr5='$_POST[vr5]',
		  vr6='$_POST[vr6]',
		  vr7='$_POST[vr7]',
		  vr8='$_POST[vr8]',
		  vr9='$_POST[vr9]',
		  vr10='$_POST[vr10]',
		  vr11='$_POST[vr11]',
		  vr12='$_POST[vr12]',
		  vr13='$_POST[vr13]',
		  vr14='$_POST[vr14]',
		  vr15='$_POST[vr15]',
		  ket='$_POST[ket]',
		  tgl_update=GETDATE()
		  WHERE nokk='$_POST[nokk]'");

	if ($sqlData) {
		// echo "<script>alert('Data Telah Diubah');</script>";
		// echo "<script>window.location.href='?p=Input-Data-KJ;</script>";
		echo "<script>swal({
  title: 'Data Telah DiUbah',   
  text: 'Klik Ok untuk input data kembali',
  type: 'success',
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
			var m;
			m = roundToTwo((brtKain * 39.37 * 1000) / (lebar * grms));
			document.forms['form1']['pjng_kain'].value = m;
		}
	}
	function susut() {
		var sebelum = document.forms['form1']['lebar_a'].value;
		var sesudah = document.forms['form1']['lebar1_a'].value;
		var susut_lebar;
		susut_lebar = roundToTwo((sesudah - sebelum) * 100 / sebelum);
		document.forms['form1']['susut_lebar'].value = susut_lebar;
	}	
</script>