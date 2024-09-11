<?php
include "../../koneksi.php";
include "../../tgl_indo.php";
include "../../utils/helper.php";

$Awal=$_GET['awal'];
$Akhir=$_GET['akhir'];
$qTgl=sqlsrv_query($con,"SELECT 
    FORMAT(GETDATE(), 'dd-MMM-yy') AS tgl_skrg,
    FORMAT(GETDATE(), 'HH:mm:ss') AS jam_skrg;
");
$rTgl=sqlsrv_fetch_array($qTgl);
if($Awal!=""){$tgl=substr($Awal,0,10); $jam=$Awal;}else{$tgl=$rTgl['tgl_skrg']; $jam=$rTgl['jam_skrg'];}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="styles_cetak.css" rel="stylesheet" type="text/css">
<title>Cetak Laporan Data Test Proses</title>
<script>

// set portrait orientation

jsPrintSetup.setOption('orientation', jsPrintSetup.kPortraitOrientation);

// set top margins in millimeters
jsPrintSetup.setOption('marginTop', 0);
jsPrintSetup.setOption('marginBottom', 0);
jsPrintSetup.setOption('marginLeft', 0);
jsPrintSetup.setOption('marginRight', 0);

// set page header
jsPrintSetup.setOption('headerStrLeft', '');
jsPrintSetup.setOption('headerStrCenter', '');
jsPrintSetup.setOption('headerStrRight', '');

// set empty page footer
jsPrintSetup.setOption('footerStrLeft', '');
jsPrintSetup.setOption('footerStrCenter', '');
jsPrintSetup.setOption('footerStrRight', '');

// clears user preferences always silent print value
// to enable using 'printSilent' option
jsPrintSetup.clearSilentPrint();

// Suppress print dialog (for this context only)
jsPrintSetup.setOption('printSilent', 1);

// Do Print 
// When print is submitted it is executed asynchronous and
// script flow continues after print independently of completetion of print process! 
jsPrintSetup.print();

window.addEventListener('load', function () {
    var rotates = document.getElementsByClassName('rotate');
    for (var i = 0; i < rotates.length; i++) {
        rotates[i].style.height = rotates[i].offsetWidth + 'px';
    }
});
// next commands

</script>
<style>
.hurufvertical {
 writing-mode:tb-rl;
    -webkit-transform:rotate(-90deg);
    -moz-transform:rotate(-90deg);
    -o-transform: rotate(-90deg);
    -ms-transform:rotate(-90deg);
    transform: rotate(180deg);
    white-space:nowrap;
    float:left;
}	

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
<?php 
//$nmBln=array(1 => "JANUARI","FEBUARI","MARET","APRIL","MEI","JUNI","JULI","AGUSTUS","SEPTEMBER","OKTOBER","NOVEMBER","DESEMBER");	
?>
<body>
<table width="100%">
  <thead>
    <tr>
      <td><table width="100%" border="1" class="table-list1"> 
  <tr>
        <td align="center"><strong><font size="+1">LAPORAN DATA TEST PROSES</font><br />
		<font size="-1">Periode: <?php echo date("d/m/Y", strtotime($Awal));?> s/d <?php echo date("d/m/Y", strtotime($Akhir));?></font>
    </tr>
  </table>

		</td>
    </tr>
	</thead>
    <tr>
      <td><table width="100%" border="1" class="table-list1">
        <thead>
          <tr align="center">
			<td><font size="-2"><strong>No.</strong></font></td>
            <td><font size="-2"><strong>Tanggal</strong></font></td>
            <td><font size="-2"><strong>No KK</strong></font></td>
            <td><font size="-2"><strong>Langganan</strong></font></td>
            <td><font size="-2"><strong>Buyer</strong></font></td>
            <td><font size="-2"><strong>Order</strong></font></td>
            <td><font size="-2"><strong>Jenis Kain</strong></font></td>
            <td><font size="-2"><strong>No. Warna</strong></font></td>
            <td><font size="-2"><strong>Warna</strong></font></td>
            <td><font size="-2"><strong>Lot</strong></font></td>
            <td><font size="-2"><strong>Roll</strong></font></td>
            <td><font size="-2"><strong>Quantity</strong></font></td>
            <td><font size="-2"><strong>Penanggung Jawab</strong></font></td>
            <td><font size="-2"><strong>Keterangan</strong></font></td>
          </tr>
		</thead>
		<tbody>  
		<?php
        $no=1;
        if($Awal!=""){
            $qry1=sqlsrv_query($con,"SELECT * FROM db_dying.tbl_datatest WHERE CONVERT(DATE, tgl_buat) BETWEEN '$Awal' AND '$Akhir' ORDER BY id ASC");
        while($row1=sqlsrv_fetch_array($qry1)){
		 ?>
          <tr valign="top">
            <td align="center" valign="middle"><?php echo $no; ?></td>
            <td align="center" valign="middle"><?php echo cek($row1['tgl_buat'], "d-M-y");?></td>
            <td align="center" valign="middle"><?php echo $row1['nokk'];?></td>
            <td align="center" valign="middle"><?php echo $row1['langganan'];?></td>
            <td align="center" valign="middle"><?php echo $row1['buyer'];?></td>
            <td align="center" valign="middle"><?php echo $row1['no_order'];?></td>
            <td valign="middle"><?php echo $row1['jenis_kain'];?></td>
            <td align="center" valign="middle"><?php echo $row1['no_warna'];?></td>
            <td align="center" valign="middle"><?php echo $row1['warna'];?></td>
            <td align="center" valign="middle"><?php echo $row1['lot'];?></td>
            <td align="right" valign="middle"><?php echo $row1['roll'];?></td>
            <td align="right" valign="middle"><?php echo $row1['bruto'];?></td>
            <td align="center" valign="middle"><?php echo $row1['t_jawab'];?></td>
            <td valign="middle"><?php echo $row1['ket'];?></td>
          </tr>
        <?php $no++;
        } 
        }
        ?>
        </tbody>
      </table></td>
    </tr>
</table>

<script>
//alert('cetak');window.print();
</script> 
</body>
</html>