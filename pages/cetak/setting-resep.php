<?php
session_start();

include "../../koneksi.php";
include "../../utils/helper.php";

$idkk = $_REQUEST['idkk'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link href="styles_cetak_matching.css" rel="stylesheet" type="text/css">
  <title>Cetak Kartu Setting Resep Dye</title>
  <style>
    .hurufvertical {
      writing-mode: tb-rl;
      -webkit-transform: rotate(-90deg);
      -moz-transform: rotate(-90deg);
      -o-transform: rotate(-90deg);
      -ms-transform: rotate(-90deg);
      transform: rotate(180deg);
      white-space: nowrap;
      float: left;
    }
  </style>
</head>

<body>
  <?php
  $qry = sqlsrv_query($conLab,"SELECT *, FORMAT(GETDATE(), 'dd MMMM yyyy') as tgl FROM db_laborat.tbl_matching WHERE no_resep='$idkk'");
  $data = sqlsrv_fetch_array($qry);
  $ip_num = $_SERVER['REMOTE_ADDR'];

  $sql = "INSERT INTO 
            log_status_matching (
              ids
              [status]
              info
              do_by
              do_at
              ip_address
            ) VALUES (
              ?, ?, ?, ?, ?, ?
            )";

  $params = [
    $idkk,
    'print',
    'cetak kartu matching',
    @$_SESSION['userLAB'],
    date("Y-m-d H:i:s"),
    $ip_num,
  ];

  $params = array_trim_cek($params);

  sqlsrv_query($conLab, $sql, $params);
  ?>
  <table width="100%" border="0">
    <tr style="font-size: 10px;">
      <td width="13%">GRAMASI PERMINTAAN:</td>
      <td width="10%"><strong><?Php echo $data['lebar'] . " x " . $data['gramasi'] . " gr/m2"; ?></strong></td>
      <td width="11%">GRAMASI AKTUAL:</td>
      <td width="11%">&nbsp;</td>
      <td width="16%">BERAT:</td>
      <td width="15%">&nbsp;</td>
      <td width="9%">&nbsp;</td>
      <td width="15%">&nbsp;</td>
    </tr>
  </table>
  <table width="100%" border="0" class="table-list1">
    <tbody>

      <tr>
        <td width="74" style="border-right:0px #000000 solid;"><strong style="font-size: 22px;">R</strong><span>CODE</span></td>
        <td width="18" style="border-right:0px #000000 solid; border-left:0px #000000 solid;">:</td>
        <td width="58" style="border-left:0px #000000 solid;"><strong><?Php echo $data['no_resep']; ?></strong></td>
        <td width="94" style="border-right:0px #000000 solid;"><strong style="font-size: 22px;">I</strong>TEM</td>
        <td width="12" style="border-right:0px #000000 solid; border-left:0px #000000 solid;">:</td>
        <td colspan="5" style="border-left:0px #000000 solid;"><strong><?Php echo $data['no_item']; ?></strong></td>
        <td colspan="6" align="center" style="border-bottom:0px #000000 solid;">
          <?php if ($data['jenis_matching'] == "L/D") : ?>
            <strong style="font-size: 24px;">KARTU SETTING RESEP DYE L/D</strong>
          <?php else : ?>
            <strong style="font-size: 24px;">KARTU SETTING RESEP DYE</strong>
          <?php endif; ?>
        </td>
        <td width="101" style="border-right:0px #000000 solid;"><strong style="font-size: 22px;">L</strong>ANGGANAN</td>
        <td width="16" style="border-right:0px #000000 solid; border-left:0px #000000 solid;">:</td>
        <td width="162" style="border-left:0px #000000 solid;"><strong style="font-size: 9px;"><?Php echo $data['langganan']; ?></strong></td>
      </tr>
      <tr>
        <td style="border-right:0px #000000 solid;"><strong style="font-size: 21px;">M</strong>ATCHER</td>
        <td style="border-right:0px #000000 solid; border-left:0px #000000 solid;">:</td>
        <td style="border-left:0px #000000 solid;">&nbsp;</td>
        <td style="border-right:0px #000000 solid;"><strong style="font-size: 21px;">P</strong>O <strong style="font-size: 21px;">G</strong>REIGE</td>
        <td style="border-right:0px #000000 solid; border-left:0px #000000 solid;">:</td>
        <td colspan="5" style="border-left:0px #000000 solid;"><strong><?Php if ($data['no_po'] == "NULL") {
                                                                          echo " ";
                                                                        } else {
                                                                          echo $data['no_po'];
                                                                        }   ?></strong></td>
        <td colspan="6" align="left" valign="top" style="border-top:0px #000000 solid;">CATATAN:</td>
        <td style="border-right:0px #000000 solid;"><strong style="font-size: 21px;">P</strong>ROSES
        </td>
        <td style="border-right:0px #000000 solid; border-left:0px #000000 solid;">:</td>
        <td style="border-left:0px #000000 solid;"><strong><?Php echo $data['proses']; ?></strong></td>
      </tr>
      <tr>
        <td rowspan="2" style="border-right:0px #000000 solid;"><strong style="font-size: 21px;">T</strong>IME <strong style="font-size: 21px;">I</strong>N</td>
        <td rowspan="2" style="border-right:0px #000000 solid; border-left:0px #000000 solid;">:</td>
        <td rowspan="2" style="border-left:0px #000000 solid;"><strong><?Php echo cek($data['tgl_in'], "d-m-Y"); ?></strong></td>
        <td rowspan="2" style="border-right:0px #000000 solid;"><strong style="font-size: 21px;">K</strong>AIN</td>
        <td rowspan="2" style="border-right:0px #000000 solid; border-left:0px #000000 solid;">:</td>
        <td colspan="5" rowspan="2" style="border-left:0px #000000 solid;"><strong style="font-size: 8px;"><?Php if ($data['jenis_kain'] == "NULL") {
                                                                                                              echo "";
                                                                                                            } else {
                                                                                                              echo $data['jenis_kain'];
                                                                                                            } ?></strong></td>
        <td width="71" rowspan="2">No. Program Celup</td>
        <td width="76" style="border-right:0px #000000 solid;">T-Side </td>
        <td width="55" style="border-left:0px #000000 solid;">:</td>
        <td width="56" rowspan="2">No. Gelas</td>
        <td width="54" style="border-right:0px #000000 solid;">T-Side </td>
        <td width="65" style="border-left:0px #000000 solid;">:</td>
        <td rowspan="2" style="border-right:0px #000000 solid;">STD COCOK WARNA</td>
        <td rowspan="2" style="border-right:0px #000000 solid; border-left:0px #000000 solid;">:</td>
        <td style="border-left:0px #000000 solid;">1. <strong><?Php echo $data['cocok_warna']; ?></strong></td>
      </tr>
      <tr>
        <td width="76" style="border-right:0px #000000 solid;">C-Side </td>
        <td width="55" style="border-left:0px #000000 solid;">:</td>
        <td width="54" style="border-right:0px #000000 solid;">C-Side </td>
        <td width="65" style="border-left:0px #000000 solid;">:</td>
        <td style="border-left:0px #000000 solid;">2.</td>
      </tr>
      <tr>
        <td rowspan="2" style="border-right:0px #000000 solid;"><strong style="font-size: 21px;">D</strong>ELIVERY</td>
        <td rowspan="2" style="border-right:0px #000000 solid; border-left:0px #000000 solid;">:</td>
        <td rowspan="2" style="border-left:0px #000000 solid;"><strong><?Php echo cek($data['tgl_delivery'], "d-m-Y"); ?></strong></td>
        <td rowspan="2" style="border-right:0px #000000 solid;"><strong style="font-size: 22px;">B</strong>ENANG</td>
        <td rowspan="2" style="border-right:0px #000000 solid; border-left:0px #000000 solid;">:</td>
        <td colspan="5" rowspan="2" style="border-left:0px #000000 solid;"><strong style="font-size: 8px;"><?Php if ($data['benang'] == "NULL") {
                                                                                                              echo "";
                                                                                                            } else {
                                                                                                              echo $data['benang'];
                                                                                                            } ?></strong></td>
        <td rowspan="4">T-Side</td>
        <td style="border-right:0px #000000 solid;">L : R </td>
        <td style="border-left:0px #000000 solid;">:</td>
        <td rowspan="4">C-Side</td>
        <td style="border-right:0px #000000 solid;">L : R </td>
        <td style="border-left:0px #000000 solid;">:</td>
        <td rowspan="2" style="border-right:0px #000000 solid;"><strong style="font-size: 21px;">W</strong>ARNA</td>
        <td rowspan="2" style="border-right:0px #000000 solid; border-left:0px #000000 solid;">:</td>
        <td rowspan="2" style="border-left:0px #000000 solid;"><strong style="font-size: 9px;"><?Php echo $data['warna']; ?></strong></td>
      </tr>
      <tr>
        <td colspan="2" align="right">&nbsp;&nbsp; &deg;C X&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Menit</td>
        <td colspan="2" align="right">&nbsp;&nbsp; &deg;C X&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Menit</td>
      </tr>
      <tr><?php $i = 1;
          $sqlLamp = sqlsrv_query($conLab,"SELECT * FROM db_laborat.vpot_lampbuy where buyer = '$data[buyer]' order by flag"); ?>
        <td rowspan="2" style="border-right:0px #000000 solid;" colspan="3"><strong>LAMPU</strong> : <?php while ($lamp = sqlsrv_fetch_array($sqlLamp)) {
                                                                                                        echo $i++ . '.(' . $lamp['lampu'] . '), ';
                                                                                                      } ?>
        </td>
        <td rowspan="2" style="border-right:0px #000000 solid;"><strong style="font-size: 21px;">T</strong>IME <strong style="font-size: 21px;">O</strong>UT</td>
        <td rowspan="2" style="border-right:0px #000000 solid; border-left:0px #000000 solid;">:</td>
        <td width="32" rowspan="2" style="border-right:0px #000000 solid; border-left:0px #000000 solid;">&nbsp;</td>
        <td width="65" rowspan="2" style="border-right:0px #000000 solid; border-left:0px #000000 solid;"><span style="border-left:0px #000000 solid;"><span style="border-right:0px #000000 solid;"><strong style="font-size: 21px;">C</strong>IE <strong style="font-size: 21px;">W</strong>I</span></span> :</td>
        <td width="19" rowspan="2" style="border-right:0px #000000 solid; border-left:0px #000000 solid;">&nbsp;</td>
        <td width="66" rowspan="2" style="border-right:0px #000000 solid; border-left:0px #000000 solid;"><span style="border-left:0px #000000 solid;"><strong style="font-size: 8px;"><strong style="font-size: 21px;">C</strong>IE <strong style="font-size: 21px;">T</strong>INT</strong></span> :</td>
        <td width="19" rowspan="2" style="border-right:0px #000000 solid; border-left:0px #000000 solid;">&nbsp;</td>
        <td style="border-right:0px #000000 solid;">PH </td>
        <td style="border-left:0px #000000 solid;">:</td>
        <td colspan="2">&nbsp;</td>
        <td rowspan="2" style="border-right:0px #000000 solid;"><strong style="font-size: 21px;">N</strong>O <strong style="font-size: 21px;">W</strong>ARNA</td>
        <td rowspan="2" style="border-right:0px #000000 solid; border-left:0px #000000 solid;">:</td>
        <td rowspan="2" style="border-left:0px #000000 solid;"><strong><?Php echo $data['no_warna']; ?></strong></td>
      </tr>
      <tr>
        <td style="border-right:0px #000000 solid;">RC/Bleaching</td>
        <td style="border-left:0px #000000 solid;">:</td>
        <td style="border-right:0px #000000 solid;">Soaping</td>
        <td style="border-left:0px #000000 solid;"> :</td>
      </tr>
    </tbody>
  </table>
  <table width="100%" border="0" class="table-list1">
    <tbody>
      <tr align="center">
        <td width="1%">&nbsp;</td>
        <td width="2%"><strong>
            <font size="-1">D/A CODE</font>
          </strong></td>
        <td colspan="4"><strong>
            <font size="+2">D/A NAME</font>
          </strong></td>
        <td width="5%"><strong>
            <font size="+2">1</font>
          </strong></td>
        <td width="5%"><strong>
            <font size="+2">2</font>
          </strong></td>
        <td width="5%"><strong>
            <font size="+2">3</font>
          </strong></td>
        <td width="5%"><strong>
            <font size="+2">4</font>
          </strong></td>
        <td width="5%"><strong>
            <font size="+2">5</font>
          </strong></td>
        <td width="5%"><strong>
            <font size="+2">6</font>
          </strong></td>
        <td width="5%"><strong>
            <font size="+2">7</font>
          </strong></td>
        <td width="5%"><strong>
            <font size="+2">8</font>
          </strong></td>
        <td width="5%"><strong>
            <font size="+2">9</font>
          </strong></td>
        <td width="5%"><strong>
            <font size="+2">10</font>
          </strong></td>
        <td width="5%"><strong>
            <font size="+2">11</font>
          </strong></td>
        <td width="5%"><strong>
            <font size="+2">12</font>
          </strong></td>
        <td width="5%"><strong>
            <font size="+2">13</font>
          </strong></td>
        <td width="5%"><strong>
            <font size="+2">14</font>
          </strong></td>
        <td width="5%"><strong>
            <font size="+2">15</font>
          </strong></td>
      </tr>
      <?php
      $no = 1;
      $qry1 = sqlsrv_query($conLab,"SELECT * FROM db_laborat.tbl_matching_detail WHERE id_matching='$data[id]' ORDER BY flag ");
      while ($r = sqlsrv_fetch_array($qry1)) { ?>
        <tr>
          <?php if ($no < 2) { ?><td rowspan="<?php $sp = 12;
                                              echo $sp - $no; ?>"><a class="hurufvertical"><strong>SIDE A</strong></a></td> <?php } ?>
          <td align="center" style="height: 15px;"><?php echo strtoupper($r['kode']); ?></td>
          <td colspan="4"><?php echo $r['nama']; ?></td>
          <td align="center"><?php echo printf("%.4f", $r['conc1']); ?></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      <?php $no++;
      } ?>
      <?php for ($i = $no; $i <= 7; $i++) { ?>
        <tr>
          <?php if ($i < 2) { ?><td rowspan="11" style="border-bottom: double;"><a class="hurufvertical"><strong>SIDE A</strong></a></td> <?php } ?>
          <td style="height: 15px;">&nbsp;</td>
          <td colspan="4">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      <?php } ?>
      <tr>
        <td style="height: 15px;">&nbsp;</td>
        <td colspan="4">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td style="height: 15px;">&nbsp;</td>
        <td colspan="4">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td style="height: 15px;">&nbsp;</td>
        <td colspan="4">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td align="center" style="border-bottom:5px solid black !important; height: 15px; border-bottom: double;">&nbsp;</td>
        <td colspan="4" align="center" style="border-bottom:5px solid black !important; height: 15px; border-bottom: double;">&nbsp;</td>
        <td align="center" style="border-bottom:5px solid black !important; height: 15px; border-bottom: double;">&nbsp;</td>
        <td align="center" style="border-bottom:5px solid black !important; height: 15px; border-bottom: double;">&nbsp;</td>
        <td align="center" style="border-bottom:5px solid black !important; height: 15px; border-bottom: double;">&nbsp;</td>
        <td align="center" style="border-bottom:5px solid black !important; height: 15px; border-bottom: double;">&nbsp;</td>
        <td align="center" style="border-bottom:5px solid black !important; height: 15px; border-bottom: double;">&nbsp;</td>
        <td align="center" style="border-bottom:5px solid black !important; height: 15px; border-bottom: double;">&nbsp;</td>
        <td align="center" style="border-bottom:5px solid black !important; height: 15px; border-bottom: double;">&nbsp;</td>
        <td align="center" style="border-bottom:5px solid black !important; height: 15px; border-bottom: double;">&nbsp;</td>
        <td align="center" style="border-bottom:5px solid black !important; height: 15px; border-bottom: double;">&nbsp;</td>
        <td align="center" style="border-bottom:5px solid black !important; height: 15px; border-bottom: double;">&nbsp;</td>
        <td align="center" style="border-bottom:5px solid black !important; height: 15px; border-bottom: double;">&nbsp;</td>
        <td align="center" style="border-bottom:5px solid black !important; height: 15px; border-bottom: double;">&nbsp;</td>
        <td align="center" style="border-bottom:5px solid black !important; height: 15px; border-bottom: double;">&nbsp;</td>
        <td align="center" style="border-bottom:5px solid black !important; height: 15px; border-bottom: double;">&nbsp;</td>
        <td align="center" style="border-bottom:5px solid black !important; height: 15px; border-bottom: double;">&nbsp;</td>
      </tr>
      <?php
      $no1 = 1;
      $qry2 = sqlsrv_query($conLab,"SELECT * FROM db_laborat.tbl_matching_detail WHERE id_matching='$data[id]' and jenis='polyester' ORDER BY id ASC");
      while ($r1 = sqlsrv_fetch_array($qry2)) { ?>
        <tr>
          <?php if ($no1 < 2) { ?><td rowspan="<?php $sp1 = 15;
                                                echo $sp1 - $no1; ?>"><a class="hurufvertical"><strong>SIDE B</strong></a></td> <?php } ?>
          <td align="center" style="height: 15px;"><?php echo strtoupper($r1['kode']); ?></td>
          <td colspan="4"><?php echo $r1['nama']; ?></td>
          <td align="center"><?php echo cek($r1['lab']); ?></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      <?php $no1++;
      } ?>
      <?php for ($i1 = $no1; $i1 <= 7; $i1++) { ?>
        <tr>
          <?php if ($i1 < 2) { ?><td rowspan="11"><a class="hurufvertical"><strong>SIDE B</strong></a></td> <?php } ?>
          <td style="height: 15px;">&nbsp;</td>
          <td colspan="4">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      <?php } ?>
      <tr>
        <td style="height: 15px;">&nbsp;</td>
        <td colspan="4">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td style="height: 15px;">&nbsp;</td>
        <td colspan="4">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td style="height: 15px;">&nbsp;</td>
        <td colspan="4">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td align="center" style="height: 15px;">&nbsp;</td>
        <td colspan="4" align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
      </tr>
      <tr> <?php $sqlOrder = sqlsrv_query($conLab,"SELECT * FROM db_laborat.tbl_orderchild where id_matching = '$data[id]' AND NOT [order] = '$data[no_order]' "); ?>
        <td rowspan="10"><a class="hurufvertical"><strong>SAMPLE</strong></a></td>
        <td rowspan="7" colspan="5" valign="top"> <?php if ($data['jenis_matching'] == "L/D") : ?>
            <strong style="font-size: 21px;">R</strong>EQUEST NO :
          <?php else : ?>
            <strong style="font-size: 21px;">NO.</strong>ORDER :
            <?php endif; ?><?php echo $data['no_order'] ?>, <?php while ($order = sqlsrv_fetch_array($sqlOrder)) {
                                                              echo $order['order'] . ', ';
                                                            } ?><div align="right"><strong style="font-size: 21px;"><?php if($data['salesman_sample']=="1"){ echo "S/S"; } ?></strong></div></td>
        <td style="border-bottom: 0px; border-top:0px;" width="4%" align="center">&nbsp;</td>
        <td style="border-bottom: 0px; border-top:0px;" width="4%" align="center">&nbsp;</td>
        <td style="border-bottom: 0px; border-top:0px;" width="4%" rowspan="2" align="left">&nbsp;</td>
        <td style="border-bottom: 0px; border-top:0px;" width="5%" rowspan="2" align="center">&nbsp;</td>
        <td rowspan="7" align="center">&nbsp;</td>
        <td rowspan="7" align="center">&nbsp;</td>
        <td rowspan="7" align="center">&nbsp;</td>
        <td rowspan="7" align="center">&nbsp;</td>
        <td rowspan="7" align="center">&nbsp;</td>
        <td rowspan="7" align="center">&nbsp;</td>
        <td rowspan="7" align="center">&nbsp;</td>
        <td rowspan="7" align="center">&nbsp;</td>
        <td rowspan="7" align="center">&nbsp;</td>
        <td rowspan="7" align="center">&nbsp;</td>
        <td rowspan="7" align="center">&nbsp;</td>
      </tr>
      <tr>
        <td style="border-bottom: 0px; border-top:0px;" align="center"><a style="font-size: 8px;">&nbsp;</a></td>
        <td style="border-bottom: 0px; border-top:0px;" align="center"><a style="font-size: 8px;">&nbsp;</td>
      </tr>
      <tr>
        <td style="border-bottom: 0px; border-top:0px;" align="center"><a style="font-size: 8px;">&nbsp;</a></td>
        <td style="border-bottom: 0px; border-top:0px;" width="2%" align="center">&nbsp;</td>
        <td style="border-bottom: 0px; border-top:0px;" width="4%" align="left">&nbsp;</td>
        <td style="border-bottom: 0px; border-top:0px;" width="5%" align="center">&nbsp;</td>
      </tr>
      <tr>
        <td style="border-bottom: 0px; border-top:0px;" align="center">&nbsp;</td>
        <td style="border-bottom: 0px; border-top:0px;" align="center">&nbsp;</td>
        <td style="border-bottom: 0px; border-top:0px;" rowspan="2" align="left">&nbsp;</td>
        <td style="border-bottom: 0px; border-top:0px;" rowspan="2" align="center">&nbsp;</td>
      </tr>
      <tr>
        <td style="border-bottom: 0px; border-top:0px;" align="center">&nbsp;</td>
        <td style="border-bottom: 0px; border-top:0px;" align="center">&nbsp;</td>
      </tr>
      <tr>
        <td style="border-bottom: 0px; border-top:0px;" align="center">&nbsp;</td>
        <td style="border-bottom: 0px; border-top:0px;" align="center">&nbsp;</td>
        <td style="border-bottom: 0px; border-top:0px;" rowspan="2" align="left">&nbsp;</td>
        <td style="border-bottom: 0px; border-top:0px;" rowspan="2" align="center">&nbsp;</td>
      </tr>
      <tr>
        <td style="border-bottom: 0px; border-top:0px;" align="center">&nbsp;</td>
        <td style="border-bottom: 0px; border-top:0px;" align="center">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="5" rowspan="3" valign="top" style="height: 0.65in;">QTY ORDER : <strong><?Php echo $data['qty_order']; ?></strong></td>
        <td rowspan="3" align="center">&nbsp;</td>
        <td rowspan="3" align="center">&nbsp;</td>
        <td style="border-bottom: 0px;" align="left"><a style="font-size: 9px;">&nbsp;</a></td>
        <td style="border-bottom: 0px;" align="center">&nbsp;</td>
        <td rowspan="3" align="center">&nbsp;</td>
        <td rowspan="3" align="center">&nbsp;</td>
        <td rowspan="3" align="center">&nbsp;</td>
        <td rowspan="3" align="center">&nbsp;</td>
        <td rowspan="3" align="center">&nbsp;</td>
        <td rowspan="3" align="center">&nbsp;</td>
        <td rowspan="3" align="center">&nbsp;</td>
        <td rowspan="3" align="center">&nbsp;</td>
        <td rowspan="3" align="center">&nbsp;</td>
        <td rowspan="3" align="center">&nbsp;</td>
        <td rowspan="3" align="center">&nbsp;</td>
      </tr>
      <tr>
        <td style="border-bottom: 0px; border-top:0px;" align="left"><a style="font-size: 9px;">&nbsp;</a></td>
        <td style="border-bottom: 0px; border-top:0px;" align="center">&nbsp;</td>
      </tr>
      <tr>
        <td style=" border-top:0px;" align="left">&nbsp;</td>
        <td style="border-top:0px;" align="center">&nbsp;</td>
      </tr>
    </tbody>
    <hr>
  </table>
</body>

</html>
<script>
  // setTimeout(function() {
  //   window.print()
  // }, 1500);
</script>