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
$qTgl=sqlsrv_query($con,"SELECT 
    FORMAT(GETDATE(), 'yyyy-MM-dd') AS tgl_skrg,
    FORMAT(DATEADD(DAY, 1, GETDATE()), 'yyyy-MM-dd') AS tgl_besok;
");
$rTgl=sqlsrv_fetch_array($qTgl);
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
        <td colspan="17"><table width="100%" border="0" class="table-list1">
          <thead>
            <tr>
              <td width="6%" rowspan="4"><img src="Indo.jpg" alt="" width="60" height="60"></td>
              <td width="75%" rowspan="4"><div align="center">
                <h2>FORM POTONG CELUP DYEING</h2>
              </div></td>
              <td width="8%">No. Form</td>
              <td width="11%">: -</td>
            </tr>
            <tr>
              <td>No. Revisi</td>
              <td>: 00</td>
            </tr>
            <tr>
              <td>Tgl. Terbit</td>
              <td>: -</td>
            </tr>
                <thead>
        </table></td>
      </tr>
<tr valign="top">
        <td colspan="17"><strong>Periode: <?php echo $_GET['awal']; ?> s/d <?php echo $_GET['akhir']; ?></strong><br />
        <strong>Shift: <?php echo $_GET['shft']; ?></strong></td>
      </tr>
    <tr>
      <td bgcolor="#99FF99"><div align="center">NO.</div></td>
      <td bgcolor="#99FF99"><div align="center">NO MC</div></td>
      <td bgcolor="#99FF99"><div align="center">LANGGANAN</div></td>
      <td bgcolor="#99FF99"><div align="center">BUYER</div></td>
      <td bgcolor="#99FF99"><div align="center">NO PO</div></td>
      <td bgcolor="#99FF99"><div align="center">NO ORDER</div></td>
      <td bgcolor="#99FF99"><div align="center">JENIS KAIN</div></td>
      <td bgcolor="#99FF99"><div align="center">WARNA</div></td>
      <td bgcolor="#99FF99"><div align="center">NO WARNA</div></td>
      <td bgcolor="#99FF99"><div align="center">LOT</div></td>
      <td bgcolor="#99FF99"><div align="center">ROLL</div></td>
      <td bgcolor="#99FF99"><div align="center">QUANTITY</div></td>
      <td bgcolor="#99FF99"><div align="center">PROSES</div></td>
      <td bgcolor="#99FF99"><div align="center">ACC KELUAR KAIN</div></td>
      <td bgcolor="#99FF99"><div align="center">KETERANGAN</div></td>
      <td bgcolor="#99FF99"><div align="center">ACC KETERANGAN</div></td>
      <td bgcolor="#99FF99"><div align="center">DISPOSISI</div></td>
    </tr>
    </thead> 
    <tbody>
	<?php
	$Awal=$_GET['awal'];
	$Akhir=$_GET['akhir'];
	$GShift=$_GET['shft'];	
	if($GShift=="ALL"){$shft=" ";}else{$shft=" ISNULL(d.g_shift, '') ='$GShift' AND ";}
  $sql=sqlsrv_query($con,"SELECT
    *,
    b.buyer,
    b.no_order,
    b.jenis_kain,
    b.lot,
    b.no_mesin,
    b.warna,
    b.proses,
    ISNULL(d.g_shift, d.g_shift) AS shft, 
    c.operator,
    d.comment_warna,
    d.disposisi,
    d.acc,
    d.ket,
    d.operator AS opt_potong,
    CASE
        WHEN c.status = 'selesai' THEN a.lama_proses
        ELSE FORMAT(DATEDIFF(MINUTE, c.tgl_buat, GETDATE()) / 60, '00') + ':' + FORMAT(DATEDIFF(MINUTE, c.tgl_buat, GETDATE()) % 60, '00')
    END AS lama,
    b.[status] AS sts
FROM 
    db_dying.tbl_schedule b
    LEFT JOIN db_dying.tbl_montemp c ON c.id_schedule = b.id
    LEFT JOIN db_dying.tbl_hasilcelup a ON a.id_montemp = c.id
    LEFT JOIN db_dying.tbl_potongcelup d ON d.id_hasilcelup = a.id
WHERE
	$shft 
  CAST(d.tgl_buat AS DATE) BETWEEN '$Awal' AND '$Akhir'
	ORDER BY
	b.no_mesin ASC");
  
   $no=1;
   
   $c=0;
   
    while($rowd=sqlsrv_fetch_array($sql)){
		   ?>
      <tr valign="top">
      <td><div align="center"><?php echo $no;?></div></td>
      <td><div align="center"><?php echo $rowd['no_mesin'];?></div></td>
      <td><?php echo $rowd['langganan'];?></td>
      <td><?php echo $rowd['buyer'];?></td>
      <td><?php echo $rowd['po']; ?></td>
      <td><?php echo $rowd['no_order']; ?></td>
      <td><?php echo $rowd['jenis_kain'];?></td>
      <td><?php echo $rowd['warna']; ?></td>
      <td><?php echo $rowd['no_warna']; ?></td>
      <td><div align="center"><?php echo $rowd['lot']; ?></div></td>
      <td><div align="center"><?php echo $rowd['rol']; ?></div></td>
      <td><div align="right"><?php echo $rowd['bruto']; ?></div></td>
      <td><?php echo $rowd['proses']; ?></td>
      <td><?php echo $rowd['acc_keluar']; ?></td>
      <td><?php if($rowd['comment_warna']=="OK"){ echo $rowd['comment_warna']; }else{ echo $rowd['ket']; }?></td>
      <td><?php echo $rowd['acc'];?></td>
      <td><?php echo $rowd['disposisi'];?></td>
      </tr>
     <?php 
	 $totrol +=$rowd['rol'];
	 $totberat +=$rowd['bruto'];
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