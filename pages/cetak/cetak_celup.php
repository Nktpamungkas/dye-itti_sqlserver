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
$data=sqlsrv_query($con,"SELECT
	CAST(GETDATE() AS DATE) as tgs,
	a.*,
	b.k_resep,
	b.acc_keluar,
	b.operator_keluar,
	b.shift as shift_keluar,
	d.rol as rolm,
	d.bruto as brutom,
	b.g_shift as g_shift_keluar,
	c.comment_warna,
	c.acc,
	c.ket,
	c.id as idb
from
	db_dying.tbl_schedule a
INNER JOIN db_dying.tbl_montemp d ON
	a.id = d.id_schedule
INNER JOIN db_dying.tbl_hasilcelup b ON
	d.id = b.id_montemp
INNER JOIN db_dying.tbl_potongcelup c ON
	b.id = c.id_hasilcelup
WHERE
	c.id='$_GET[id]'
ORDER BY
	a.no_mesin ASC");
$r=sqlsrv_fetch_array($data);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="styles_cetak.css" rel="stylesheet" type="text/css">
<title>Cetak Celup</title>
<style>
	td{
	border-top:0px #000000 solid; 
	border-bottom:0px #000000 solid;
	border-left:0px #000000 solid; 
	border-right:0px #000000 solid;
	}
	</style>
</head>


<body>
<table width="100%" border="0" style="width: 7in;">
  <tbody>    
    <tr>
      <td><table width="100%" border="0" class="table-list1">
        <tr>
          <td colspan="3" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
	border-left:0px #000000 solid; border-right:0px #000000 solid;"><div style="font-size: 8px;"><?php echo $r['nokk'];?></div></td>
          <td colspan="2" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
	border-left:0px #000000 solid; border-right:0px #000000 solid;"><div style="font-size: 8px;"><?php echo tanggal_indo($r['tgs'],false);?></div></td>
          </tr>
        <tr>
          <td colspan="5" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
	border-left:0px #000000 solid; border-right:0px #000000 solid;"><div style="font-size:9px;"><?php echo substr($r['langganan'],0,13)."/".substr($r['buyer'],0,13);?></div></td>
          </tr>
        <tr>
          <td colspan="5" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
	border-left:0px #000000 solid; border-right:0px #000000 solid;"><div style="font-size:9px;"><?php echo substr($r['po'],0,31);?></div></td>
          </tr>
        <tr>
          <td colspan="5" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
	border-left:0px #000000 solid; border-right:0px #000000 solid;"><div style="font-size:9px;"><?php echo $r['no_order'];?><?php echo " (".$r['no_item'].")";?></div></td>
          </tr>
        <tr>
          <td colspan="5" valign="top" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
	border-left:0px #000000 solid; border-right:0px #000000 solid;"><div style="font-size:8px;"><?php echo substr($r['jenis_kain'],0,131);?></div></td>
          </tr>
        <tr>
          <td colspan="5" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
	border-left:0px #000000 solid; border-right:0px #000000 solid;"><div style="font-size:9px;"><span style="font-size:8px;"><?php echo $r['warna'];?></span></div></td>
          </tr>
        <tr>
          <td colspan="3" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
	border-left:0px #000000 solid; border-right:0px #000000 solid;"><div style="font-size:9px;"><?php echo $r['rolm']."x".$r['brutom']."kg";?></div></td>
          <td style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
	border-left:0px #000000 solid; border-right:0px #000000 solid;"><div style="font-size: 9px;">Mc</div></td>
          <td style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
	border-left:0px #000000 solid; border-right:0px #000000 solid;">: <span style="font-size:9px;"><?php echo $r['no_mesin']."/".$r['k_resep'];?></span></td>
        </tr>
        <tr>
          <td colspan="3" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
	border-left:0px #000000 solid; border-right:0px #000000 solid;"><div style="font-size:9px;"><?php echo $r['lot'];?></div></td>
          <td width="7%" align="right" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
	border-left:0px #000000 solid; border-right:0px #000000 solid;"><div style="font-size:9px;">L&amp;G:</div></td>
          <td width="45%" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
	border-left:0px #000000 solid; border-right:0px #000000 solid;"><div style="font-size:9px;"><?php echo $r['lebar']." x ".$r['gramasi'];?></div></td>
        </tr>
        <tr>
          <td colspan="5" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
	border-left:0px #000000 solid; border-right:0px #000000 solid;"><div style="font-size:9px;"><span style="font-size:8px;"><?php echo $r['no_warna'];?></span></div></td>
          </tr>
        <tr>
          <td width="11%" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
	border-left:0px #000000 solid; border-right:0px #000000 solid;"><div style="font-size:9px;">_Coment</div></td>
          <td width="3%" align="center" valign="middle" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
	border-left:0px #000000 solid; border-right:0px #000000 solid;">:</td>
          <td width="34%" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
	border-left:0px #000000 solid; border-right:0px #000000 solid;">&nbsp;</td>
          <td style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
	border-left:0px #000000 solid; border-right:0px #000000 solid;">&nbsp;</td>
          <td style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
	border-left:0px #000000 solid; border-right:0px #000000 solid;">&nbsp;</td>
        </tr>
      </table></td>
      <td><table width="100%" border="0" class="table-list1">
        <tr>
          <td colspan="3" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
	border-left:0px #000000 solid; border-right:0px #000000 solid;"><div style="font-size: 8px;"><?php echo $r['nokk'];?></div></td>
          <td colspan="2" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
	border-left:0px #000000 solid; border-right:0px #000000 solid;"><div style="font-size: 8px;"><?php echo tanggal_indo($r['tgs'],false);?></div></td>
          </tr>
        <tr>
          <td colspan="5" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
	border-left:0px #000000 solid; border-right:0px #000000 solid;"><div style="font-size:9px;"><?php echo substr($r['langganan'],0,13)."/".substr($r['buyer'],0,13);?></div></td>
          </tr>
        <tr>
          <td colspan="5" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
	border-left:0px #000000 solid; border-right:0px #000000 solid;"><div style="font-size:9px;"><?php echo substr($r['po'],0,31);?></div></td>
          </tr>
        <tr>
          <td colspan="5" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
	border-left:0px #000000 solid; border-right:0px #000000 solid;"><div style="font-size:9px;"><?php echo $r['no_order'];?><?php echo " (".$r['no_item'].")";?></div></td>
          </tr>
        <tr>
          <td colspan="5" valign="top" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
	border-left:0px #000000 solid; border-right:0px #000000 solid;"><div style="font-size:8px;"><?php echo substr($r['jenis_kain'],0,131);?></div></td>
          </tr>
        <tr>
          <td colspan="5" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
	border-left:0px #000000 solid; border-right:0px #000000 solid;"><div style="font-size:9px;"><span style="font-size:8px;"><?php echo $r['warna'];?></span></div></td>
          </tr>
        <tr>
          <td colspan="3" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
	border-left:0px #000000 solid; border-right:0px #000000 solid;"><div style="font-size:9px;"><?php echo $r['rolm']."x".$r['brutom']."kg";?></div></td>
          <td style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
	border-left:0px #000000 solid; border-right:0px #000000 solid;"><div style="font-size: 9px;">Mc</div></td>
          <td style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
	border-left:0px #000000 solid; border-right:0px #000000 solid;">: <span style="font-size:9px;"><?php echo $r['no_mesin']."/".$r['k_resep'];?></span></td>
        </tr>
        <tr>
          <td colspan="3" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
	border-left:0px #000000 solid; border-right:0px #000000 solid;"><div style="font-size:9px;"><?php echo $r['lot'];?></div></td>
          <td width="7%" align="right" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
	border-left:0px #000000 solid; border-right:0px #000000 solid;"><div style="font-size:9px;">L&amp;G:</div></td>
          <td width="45%" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
	border-left:0px #000000 solid; border-right:0px #000000 solid;"><div style="font-size:9px;"><?php echo $r['lebar']." x ".$r['gramasi'];?></div></td>
        </tr>
        <tr>
          <td colspan="5" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
	border-left:0px #000000 solid; border-right:0px #000000 solid;"><div style="font-size:9px;"><span style="font-size:8px;"><?php echo $r['no_warna'];?></span></div></td>
          </tr>
        <tr>
          <td width="11%" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
	border-left:0px #000000 solid; border-right:0px #000000 solid;"><div style="font-size:9px;">_Coment</div></td>
          <td width="3%" align="center" valign="middle" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
	border-left:0px #000000 solid; border-right:0px #000000 solid;">:</td>
          <td width="34%" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
	border-left:0px #000000 solid; border-right:0px #000000 solid;">&nbsp;</td>
          <td style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
	border-left:0px #000000 solid; border-right:0px #000000 solid;">&nbsp;</td>
          <td style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
	border-left:0px #000000 solid; border-right:0px #000000 solid;">&nbsp;</td>
        </tr>
      </table></td>
      <td><table width="100%" border="0" class="table-list1">
        <tr>
          <td colspan="3" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
	border-left:0px #000000 solid; border-right:0px #000000 solid;"><div style="font-size: 8px;"><?php echo $r['nokk'];?></div></td>
          <td colspan="2" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
	border-left:0px #000000 solid; border-right:0px #000000 solid;"><div style="font-size: 8px;"><?php echo tanggal_indo($r['tgs'],false);?></div></td>
          </tr>
        <tr>
          <td colspan="5" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
	border-left:0px #000000 solid; border-right:0px #000000 solid;"><div style="font-size:9px;"><?php echo substr($r['langganan'],0,13)."/".substr($r['buyer'],0,13);?></div></td>
          </tr>
        <tr>
          <td colspan="5" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
	border-left:0px #000000 solid; border-right:0px #000000 solid;"><div style="font-size:9px;"><?php echo substr($r['po'],0,31);?></div></td>
          </tr>
        <tr>
          <td colspan="5" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
	border-left:0px #000000 solid; border-right:0px #000000 solid;"><div style="font-size:9px;"><?php echo $r['no_order'];?><?php echo " (".$r['no_item'].")";?></div></td>
          </tr>
        <tr>
          <td colspan="5" valign="top" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
	border-left:0px #000000 solid; border-right:0px #000000 solid;"><div style="font-size:8px;"><?php echo substr($r['jenis_kain'],0,131);?></div></td>
          </tr>
        <tr>
          <td colspan="5" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
	border-left:0px #000000 solid; border-right:0px #000000 solid;"><div style="font-size:9px;"><span style="font-size:8px;"><?php echo $r['warna'];?></span></div></td>
          </tr>
        <tr>
          <td colspan="3" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
	border-left:0px #000000 solid; border-right:0px #000000 solid;"><div style="font-size:9px;"><?php echo $r['rolm']."x".$r['brutom']."kg";?></div></td>
          <td style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
	border-left:0px #000000 solid; border-right:0px #000000 solid;"><div style="font-size: 9px;">Mc</div></td>
          <td style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
	border-left:0px #000000 solid; border-right:0px #000000 solid;">: <span style="font-size:9px;"><?php echo $r['no_mesin']."/".$r['k_resep'];?></span></td>
        </tr>
        <tr>
          <td colspan="3" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
	border-left:0px #000000 solid; border-right:0px #000000 solid;"><div style="font-size:9px;"><?php echo $r['lot'];?></div></td>
          <td width="7%" align="right" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
	border-left:0px #000000 solid; border-right:0px #000000 solid;"><div style="font-size:9px;">L&amp;G:</div></td>
          <td width="45%" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
	border-left:0px #000000 solid; border-right:0px #000000 solid;"><div style="font-size:9px;"><?php echo $r['lebar']." x ".$r['gramasi'];?></div></td>
        </tr>
        <tr>
          <td colspan="5" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
	border-left:0px #000000 solid; border-right:0px #000000 solid;"><div style="font-size:9px;"><span style="font-size:8px;"><?php echo $r['no_warna'];?></span></div></td>
          </tr>
        <tr>
          <td width="11%" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
	border-left:0px #000000 solid; border-right:0px #000000 solid;"><div style="font-size:9px;">_Coment</div></td>
          <td width="3%" align="center" valign="middle" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
	border-left:0px #000000 solid; border-right:0px #000000 solid;">:</td>
          <td width="34%" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
	border-left:0px #000000 solid; border-right:0px #000000 solid;">&nbsp;</td>
          <td style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
	border-left:0px #000000 solid; border-right:0px #000000 solid;">&nbsp;</td>
          <td style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
	border-left:0px #000000 solid; border-right:0px #000000 solid;">&nbsp;</td>
        </tr>
      </table></td>
    </tr>
  </tbody>
</table>
</body>
</html>