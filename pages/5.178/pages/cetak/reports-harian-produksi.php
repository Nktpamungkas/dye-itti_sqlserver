<?php 
//$lReg_username=$_SESSION['labReg_username'];

ini_set("error_reporting", 1);
include "../../koneksi.php";
include "../../koneksiLAB.php";
include "../../tgl_indo.php";
//--
$idkk=$_REQUEST['idkk'];
$act=$_GET['g'];
//-
$qTgl=mysqli_query($con,"SELECT DATE_FORMAT(now(),'%Y-%m-%d') as tgl_skrg, DATE_FORMAT(now(),'%Y-%m-%d')+ INTERVAL 1 DAY as tgl_besok");
$rTgl=mysqli_fetch_array($qTgl);
?>
<html>
<head>
<title>:: Cetak Reports Produksi Dyeing</title>
<link href="styles_cetak.css" rel="stylesheet" type="text/css">
<style>
input{
text-align:center;
border:hidden;
}
@media print {
  ::-webkit-input-placeholder { /* WebKit browsers */
      color: transparent;
  }
  :-moz-placeholder { /* Mozilla Firefox 4 to 18 */
      color: transparent;
  }
  ::-moz-placeholder { /* Mozilla Firefox 19+ */
      color: transparent;
  }
  :-ms-input-placeholder { /* Internet Explorer 10+ */
      color: transparent;
  }
  .pagebreak { page-break-before:always; }
  .header {display:block}
  table thead 
   {
    display: table-header-group;
   }
}
</style>
</head>
<body>
<table width="100%" border="0" class="table-list1">
  <thead>
<tr valign="top">
        <td colspan="18"><table width="100%" border="0" class="table-list1">
          <thead>
            <tr>
              <td width="6%" rowspan="4"><img src="Indo.jpg" alt="" width="60" height="60"></td>
              <td width="75%" rowspan="4"><div align="center">
                <h2>FORM PRODUKSI HARIAN DYEING</h2>
              </div></td>
              <td width="8%">No. Form</td>
              <td width="11%">: FW-02-DYE-03</td>
            </tr>
            <tr>
              <td>No. Revisi</td>
              <td>: 06</td>
            </tr>
            <tr>
              <td>Tgl. Terbit</td>
              <td>: 01 Maret 2019</td>
            </tr>
                <thead>
        </table></td>
      </tr>
			<?php $Awal=$_GET['awal'];
$Akhir=$_GET['akhir'];
if($Awal==$Akhir){$TglPAl=substr($Awal,0,10);$TglPAr=substr($Akhir,0,10);}else{ $TglPAl=$Awal;$TglPAr=$Akhir; }
			?>
<tr valign="top">
        <td colspan="18"><strong>Periode: <?php echo $TglPAl; ?> s/d <?php echo $TglPAr; ?></strong><br />
        <strong>Shift: <?php echo $_GET['shft']; ?></strong></td>
      </tr>
    <tr>
      <td rowspan="2" bgcolor="#99FF99"><div align="center">NO MC</div></td>
      <td rowspan="2" bgcolor="#99FF99"><div align="center">LANGGANAN / BUYER</div></td>
      <td rowspan="2" bgcolor="#99FF99"><div align="center">NO ORDER</div></td>
      <td rowspan="2" bgcolor="#99FF99"><div align="center">JENIS KAIN</div></td>
      <td rowspan="2" bgcolor="#99FF99"><div align="center">WARNA</div></td>
      <td rowspan="2" bgcolor="#99FF99"><div align="center">LOT</div></td>
      <td rowspan="2" bgcolor="#99FF99"><div align="center">ROLL</div></td>
      <td rowspan="2" bgcolor="#99FF99"><div align="center">QTY</div></td>
      <td rowspan="2" bgcolor="#99FF99"><div align="center">PROSES</div></td>
      <td rowspan="2" bgcolor="#99FF99"><div align="center">KETERANGAN</div></td>
      <td rowspan="2" bgcolor="#99FF99"><div align="center">K.R</div></td>
      <td rowspan="2" bgcolor="#99FF99">R.B/R.L</td>
      <td colspan="2" bgcolor="#99FF99"><div align="center">JAM PROSES</div></td>
      <td rowspan="2" bgcolor="#99FF99"><div align="center">POINT</div></td>
      <td colspan="2" bgcolor="#99FF99"><div align="center">STOP MESIN</div></td>
      <td rowspan="2" bgcolor="#99FF99"><div align="center">KODE STOP</div></td>
    </tr>
     <tr>
      <td bgcolor="#99FF99"><div align="center">IN</div></td>
      <td bgcolor="#99FF99"><div align="center">OUT</div></td>
      <td bgcolor="#99FF99"><div align="center">JAM</div></td>
      <td bgcolor="#99FF99"><div align="center">S/D</div></td>
    </tr>
    </thead> 
    <tbody>
	<?php
	$Awal=$_GET['awal'];
	$Akhir=$_GET['akhir'];
	$Tgl=substr($Awal,0,10);	
	if($Awal!=$Akhir){ $Where=" DATE_FORMAT(c.tgl_update, '%Y-%m-%d %H:%i') BETWEEN '$Awal' AND '$Akhir' ";}else{
		$Where=" DATE_FORMAT(c.tgl_update, '%Y-%m-%d')='$Tgl' ";
	}	
	if($_GET['shft']=="ALL"){$shft=" ";}else{$shft=" if(ISNULL(a.g_shift),c.g_shift,a.g_shift)='$_GET[shft]' AND ";}
		$sql=mysqli_query($con,"SELECT x.*,a.no_mesin as mc FROM tbl_mesin a
  LEFT JOIN
  (SELECT
  b.nokk,
	b.buyer,
	b.langganan,
	b.no_order,
	b.jenis_kain,
	b.no_mesin,
	b.warna,
	b.lot,
	c.rol,
	c.bruto,
  a.point,
	b.ket_status,
	b.resep,
	c.tgl_buat as tgl_in,
	a.tgl_buat as tgl_out,
	a.kd_stop,
	a.mulai_stop,
	a.selesai_stop,
	a.ket,
	a.status,
	a.k_resep,
	if(a.proses='' or ISNULL(a.proses),b.proses,a.proses) as proses,
	if(ISNULL(a.g_shift),c.g_shift,a.g_shift) as shft
FROM
	tbl_schedule b
	LEFT JOIN  tbl_montemp c ON c.id_schedule = b.id
	LEFT JOIN tbl_hasilcelup a ON a.id_montemp=c.id
WHERE
	$shft 
	$Where 
)x ON (a.no_mesin=x.no_mesin or a.no_mc_lama=x.no_mesin) ORDER BY a.no_mesin");
   $no=1;
   
   $c=0;
   $totrol=0;
   $totberat=0;
   
    while($rowd=mysqli_fetch_array($sql)){
      if($_GET['shft']=="ALL"){$shftSM=" ";}else{$shftSM=" g_shift='$_GET[shft]' AND ";}
      $sqlSM=mysqli_query($con,"SELECT * FROM tbl_stopmesin
      WHERE $shftSM tgl_update BETWEEN '$_GET[awal]' AND '$_GET[akhir]' AND no_mesin='$rowd[mc]' ORDER BY id DESC LIMIT 1");
      $rowSM=mysqli_fetch_array($sqlSM);
		   ?>
      <tr valign="top">
      <td><div align="center"> <?php echo $rowd['mc'];?></div></td>
      <td><?php echo $rowd['langganan']."/".$rowd['buyer'];?></td>
      <td><?php echo $rowd['no_order']; ?></td>
      <td><?php echo $rowd['jenis_kain'];?></td>
      <td><?php echo $rowd['warna']; ?></td>
      <td><div align="center"><?php echo $rowd['lot']; ?></div></td>
      <td><div align="center"><?php if($rowd['tgl_out']!=""){$rol=$rowd['rol'];}else{ $rol=0; } echo $rol; ?></div></td>
      <td><div align="right"><?php if($rowd['tgl_out']!=""){$brt=$rowd['bruto'];}else{ $brt=0; } echo $brt; ?></div></td>
      <td><?php if($rowd['nokk']=="" AND substr($rowd['proses'],0,10)!="Cuci Mesin"){ echo $rowSM['proses'];}else{echo $rowd['proses'];} ?></td>
      <td><?php if($rowd['nokk']=="" AND substr($rowd['proses'],0,10)!="Cuci Mesin"){ echo $rowSM['keterangan']."<br>".$rowSM['no_stop'];} else{echo $rowd['ket']."<br>".$rowd['status'];} ?></td>
      <td><?php echo $rowd['k_resep'];?></td>
      <td><div align="center"><?php if($rowd['ket_status']==""){echo "";}else if($rowd['ket_status']!="MC Stop"){if($rowd['resep']=="Baru"){echo"R.B";}else{echo"R.L";}} ?></div></td>
      <td><div align="right"><?php if($rowd['tgl_in']!=""){echo  date('H:i', strtotime($rowd['tgl_in']));}?> </div></td>
      <td><div align="right"><?php if($rowd['tgl_out']!=""){echo  date('H:i', strtotime($rowd['tgl_out']));}?> </div></td>
      <td><div align="center"><?php echo $rowd['point'];?></div></td>
      <td><div align="right"><?php if($rowd['nokk']=="" AND substr($rowd['proses'],0,10)!="Cuci Mesin" AND $rowSM['proses']=="Stop"){echo date('H:i', strtotime($rowSM['mulai']));}else{echo "";}?></div></td>
      <td><div align="right"><?php if($rowd['nokk']=="" AND substr($rowd['proses'],0,10)!="Cuci Mesin" AND $rowSM['proses']=="Stop"){echo date('H:i', strtotime($rowSM['selesai']));}else{echo "";}?></div></td>
      <td><div align="center"><?php if($rowd['nokk']=="" AND substr($rowd['proses'],0,10)!="Cuci Mesin"){ echo $rowSM['kd_stopmc'];}else{echo $rowd['kd_stop'];}?> <?php ?></div></td>
    </tr>
     <?php
	 $totrol +=$rol;
	 $totberat +=$brt;
	 $no++;} ?>
     </tbody>
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
    </tr>
    <tr>
      <td bgcolor="#99FF99">&nbsp;</td>
      <td bgcolor="#99FF99">&nbsp;</td>
      <td bgcolor="#99FF99">&nbsp;</td>
      <td bgcolor="#99FF99">&nbsp;</td>
      <td bgcolor="#99FF99">Total</td>
      <td bgcolor="#99FF99">&nbsp;</td>
      <td bgcolor="#99FF99"><div align="right"><?php echo $totrol;?></div></td>
      <td bgcolor="#99FF99"><div align="right"><?php echo $totberat;?></div></td>
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
  <table width="100%" border="0" class="table-list1">
  <tr>
    <td width="15%">&nbsp;</td>
    <td width="31%"><div align="center">DIBUAT OLEH:</div></td>
    <td width="27%"><div align="center">DIPERIKSA OLEH:</div></td>
    <td width="27%"><div align="center">DIKETAHUI OLEH:</div></td>
    </tr>
  <tr>
    <td>NAMA</td>
    <td><div align="center">
      <input name=nama type=text placeholder="Ketik disini" size="33" maxlength="30">
    </div></td>
    <td><div align="center">
      <input name=nama3 type=text placeholder="Ketik disini" size="33" maxlength="30">
    </div></td>
    <td><div align="center">
      <input name=nama5 type=text placeholder="Ketik disini" size="33" maxlength="30">
    </div></td>
    </tr>
  <tr>
    <td>JABATAN</td>
    <td><div align="center">
      <input name=nama2 type=text placeholder="Ketik disini" size="33" maxlength="30">
    </div></td>
    <td><div align="center">
      <input name=nama4 type=text placeholder="Ketik disini" size="33" maxlength="30">
    </div></td>
    <td><div align="center">
      <input name=nama6 type=text placeholder="Ketik disini" size="33" maxlength="30">
    </div></td>
    </tr>
  <tr>
    <td>TANGGAL</td>
    <td><div align="center">
      <input type="text" name="date" placeholder="dd-mm-yyyy" onKeyUp="
  var date = this.value;
  if (date.match(/^\d{2}$/) !== null) {
     this.value = date + '-';
  } else if (date.match(/^\d{2}\-\d{2}$/) !== null) {
     this.value = date + '-';
  }" maxlength="10">
    </div></td>
    <td><div align="center">
      <input type="text" name="date" placeholder="dd-mm-yyyy" onKeyUp="
  var date = this.value;
  if (date.match(/^\d{2}$/) !== null) {
     this.value = date + '-';
  } else if (date.match(/^\d{2}\-\d{2}$/) !== null) {
     this.value = date + '-';
  }" maxlength="10">
    </div></td>
    <td><div align="center">
      <input type="text" name="date" placeholder="dd-mm-yyyy" onKeyUp="
  var date = this.value;
  if (date.match(/^\d{2}$/) !== null) {
     this.value = date + '-';
  } else if (date.match(/^\d{2}\-\d{2}$/) !== null) {
     this.value = date + '-';
  }" maxlength="10">
    </div></td>
    </tr>
  <tr>
    <td height="60" valign="top">TANDA TANGAN</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
</table>

</body>
</html>