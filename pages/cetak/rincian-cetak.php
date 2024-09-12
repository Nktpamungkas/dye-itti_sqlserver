<?php

ini_set("error_reporting", 1);
include "../../koneksi.php";
include "../../tgl_indo.php";
//--
$idkk = $_REQUEST['idkk'];
$act = $_GET['g'];
//--
$qTgl = sqlsrv_query($con, "SELECT 
    CONVERT(date, GETDATE()) AS tgl_skrg,
    CONVERT(date, DATEADD(DAY, 1, GETDATE())) AS tgl_besok");
$rTgl = sqlsrv_fetch_array($qTgl);
?>
<html>

<head>
  <title>:: Cetak Reports Rincian Proses Dyeing</title>
  <link href="../../styles_cetak.css" rel="stylesheet" type="text/css">
  <style>
    input {
      text-align: center;
      border: hidden;
    }

    @media print {
      ::-webkit-input-placeholder {
        /* WebKit browsers */
        color: transparent;
      }

      :-moz-placeholder {
        /* Mozilla Firefox 4 to 18 */
        color: transparent;
      }

      ::-moz-placeholder {
        /* Mozilla Firefox 19+ */
        color: transparent;
      }

      :-ms-input-placeholder {
        /* Internet Explorer 10+ */
        color: transparent;
      }

      .pagebreak {
        page-break-before: always;
      }

      .header {
        display: block
      }

      table thead {
        display: table-header-group;
      }
    }
  </style>
</head>

<body>
  <?php

  $Awal = $_GET['awal'];
  $Akhir = $_GET['akhir'];
  $shift = $_GET['shft'];
  if ($_GET['shft'] == "ALL") {
    $shft = null;
  } else {
    $shft = " ISNULL(a.g_shift, c.g_shift) = '$_GET[shft]' AND ";
  }

  ?>
  <table width="100%" border="0">
    <thead>
      <tr>
        <td>
          <table width="100%" border="0">
            <tr style="border:1px solid; font-size:12px;">
              <td width="6%" rowspan="4" style="border:1px solid; font-size:12px;"><img src="Indo.jpg" alt="" width="60"
                  height="60"></td>
              <td width="75%" rowspan="4" style="border:1px solid; font-size:12px;">
                <div align="center">
                  <h2>FORM PRODUKSI HARIAN DYEING</h2>
                </div>
              </td>
              <td width="8%" style="border:1px solid; font-size:12px;">No. Form</td>
              <td width="11%" style="border:1px solid; font-size:12px;">: FW-02-DYE-03</td>
            </tr>
            <tr style="border:1px solid; font-size:12px;">
              <td style="border:1px solid; font-size:12px;">No. Revisi</td>
              <td style="border:1px solid; font-size:12px;">: 05</td>
            </tr>
            <tr style="border:1px solid; font-size:12px;">
              <td style="border:1px solid;font-size:12px; font-size:12px;">Tgl. Terbit</td>
              <td style="border:1px solid; font-size:12px;">: 16 Mei 2017</td>
            </tr>
          </table>
        </td>
      </tr>
    </thead>
    <tbody>
      <tr style="font-size:12px;">
        <td><strong>Periode: <?php echo $Awal; ?> s/d <?php echo $Akhir; ?></strong><br>
          <strong>Shift: <?php echo $shift; ?></strong>
          <table width="100%" border="0" class="table-list1">
            <tr>
              <td rowspan="3" valign="middle" bgcolor="#99FF99">
                <div align="center"><strong>No.</strong></div>
              </td>
              <td rowspan="3" valign="middle" bgcolor="#99FF99">
                <div align="center"><strong>Proses</strong></div>
              </td>
              <td rowspan="3" valign="middle" bgcolor="#99FF99">
                <div align="center"><strong>Keterangan</strong></div>
              </td>
              <td colspan="11" bgcolor="#99FF99">
                <div align="center"><strong>ALL BUYER</strong></div>
              </td>
              <td colspan="11" bgcolor="#99FF99">
                <div align="center"><strong>BUYER ADIDAS</strong></div>
              </td>
            </tr>
            <tr>
              <td colspan="4" bgcolor="#99FF99">
                <div align="center"><strong>Quantity &gt; 200 Kg</strong></div>
              </td>
              <td colspan="4" bgcolor="#99FF99">
                <div align="center"><strong>Quantity &lt; 200 Kg</strong></div>
              </td>
              <td colspan="3" bgcolor="#99FF99">
                <div align="center"><strong>Total</strong></div>
              </td>
              <td colspan="4" bgcolor="#99FF99">
                <div align="center"><strong>Quantity &gt; 200 Kg</strong></div>
              </td>
              <td colspan="4" bgcolor="#99FF99">
                <div align="center"><strong>Quantity &lt; 200 Kg</strong></div>
              </td>
              <td colspan="3" bgcolor="#99FF99">
                <div align="center"><strong>Total</strong></div>
              </td>
            </tr>
            <tr>
              <td bgcolor="#99FF99">
                <div align="center"><strong>R.B</strong></div>
              </td>
              <td bgcolor="#99FF99">
                <div align="center"><strong>Qty</strong></div>
              </td>
              <td bgcolor="#99FF99">
                <div align="center"><strong>R.L</strong></div>
              </td>
              <td bgcolor="#99FF99">
                <div align="center"><strong>Qty</strong></div>
              </td>
              <td bgcolor="#99FF99">
                <div align="center"><strong>R.B</strong></div>
              </td>
              <td bgcolor="#99FF99">
                <div align="center"><strong>Qty</strong></div>
              </td>
              <td bgcolor="#99FF99">
                <div align="center"><strong>R.L</strong></div>
              </td>
              <td bgcolor="#99FF99">
                <div align="center"><strong>Qty</strong></div>
              </td>
              <td bgcolor="#99FF99">
                <div align="center"><strong>R.B</strong></div>
              </td>
              <td bgcolor="#99FF99">
                <div align="center"><strong>R.L</strong></div>
              </td>
              <td bgcolor="#99FF99">
                <div align="center"><strong>Qty</strong></div>
              </td>
              <td bgcolor="#99FF99">
                <div align="center"><strong>R.B</strong></div>
              </td>
              <td bgcolor="#99FF99">
                <div align="center"><strong>Qty</strong></div>
              </td>
              <td bgcolor="#99FF99">
                <div align="center"><strong>R.L</strong></div>
              </td>
              <td bgcolor="#99FF99">
                <div align="center"><strong>Qty</strong></div>
              </td>
              <td bgcolor="#99FF99">
                <div align="center"><strong>R.B</strong></div>
              </td>
              <td bgcolor="#99FF99">
                <div align="center"><strong>Qty</strong></div>
              </td>
              <td bgcolor="#99FF99">
                <div align="center"><strong>R.L</strong></div>
              </td>
              <td bgcolor="#99FF99">
                <div align="center"><strong>Qty</strong></div>
              </td>
              <td bgcolor="#99FF99">
                <div align="center"><strong>R.B</strong></div>
              </td>
              <td bgcolor="#99FF99">
                <div align="center"><strong>R.L</strong></div>
              </td>
              <td bgcolor="#99FF99">
                <div align="center"><strong>Qty</strong></div>
              </td>
            </tr>
            <?php

            $sqlR = sqlsrv_query($con, "SELECT
                                          b.ket_status,
                                          b.proses,
                                          SUM(CASE WHEN a.resep = 'Baru' AND b.bruto > 200 THEN 1 ELSE 0 END) AS RB,
                                          SUM(CASE WHEN a.resep = 'Baru' AND b.bruto > 200 THEN b.bruto ELSE 0 END) AS qtyRB,
                                          SUM(CASE WHEN a.resep = 'Lama' AND b.bruto > 200 THEN 1 ELSE 0 END) AS RL,
                                          SUM(CASE WHEN a.resep = 'Lama' AND b.bruto > 200 THEN b.bruto ELSE 0 END) AS qtyRL,
                                          SUM(CASE WHEN a.resep = 'Baru' AND b.bruto > 0 AND b.bruto < 200 THEN 1 ELSE 0 END) AS RB1,
                                          SUM(CASE WHEN a.resep = 'Baru' AND b.bruto > 0 AND b.bruto < 200 THEN b.bruto ELSE 0 END) AS qtyRB1,
                                          SUM(CASE WHEN a.resep = 'Lama' AND b.bruto > 0 AND b.bruto < 200 THEN 1 ELSE 0 END) AS RL1,
                                          SUM(CASE WHEN a.resep = 'Lama' AND b.bruto > 0 AND b.bruto < 200 THEN b.bruto ELSE 0 END) AS qtyRL1,
                                          SUM(CASE WHEN a.resep = 'Baru' AND b.bruto > 200 AND b.buyer = 'ADIDAS' THEN 1 ELSE 0 END) AS RBadidas,
                                          SUM(CASE WHEN a.resep = 'Baru' AND b.bruto > 200 AND b.buyer = 'ADIDAS' THEN b.bruto ELSE 0 END) AS qtyRBadidas,
                                          SUM(CASE WHEN a.resep = 'Lama' AND b.bruto > 200 AND b.buyer = 'ADIDAS' THEN 1 ELSE 0 END) AS RLadidas,
                                          SUM(CASE WHEN a.resep = 'Lama' AND b.bruto > 200 AND b.buyer = 'ADIDAS' THEN b.bruto ELSE 0 END) AS qtyRLadidas,
                                          SUM(CASE WHEN a.resep = 'Baru' AND b.bruto > 0 AND b.bruto < 200 AND b.buyer = 'ADIDAS' THEN 1 ELSE 0 END) AS RBadidas1,
                                          SUM(CASE WHEN a.resep = 'Baru' AND b.bruto > 0 AND b.bruto < 200 AND b.buyer = 'ADIDAS' THEN b.bruto ELSE 0 END) AS qtyRBadidas1,
                                          SUM(CASE WHEN a.resep = 'Lama' AND b.bruto > 0 AND b.bruto < 200 AND b.buyer = 'ADIDAS' THEN 1 ELSE 0 END) AS RLadidas1,
                                          SUM(CASE WHEN a.resep = 'Lama' AND b.bruto > 0 AND b.bruto < 200 AND b.buyer = 'ADIDAS' THEN b.bruto ELSE 0 END) AS qtyRLadidas1,
                                          ISNULL(a.g_shift, c.g_shift) AS shft
                                      FROM
                                          db_dying.tbl_schedule b
                                          LEFT JOIN db_dying.tbl_montemp c ON c.id_schedule = b.id
                                          LEFT JOIN db_dying.tbl_hasilcelup a ON a.id_montemp = c.id
                                      WHERE
                                         $shft
                                          (CONVERT(date, a.tgl_buat) BETWEEN '$Awal' AND '$Akhir') 
                                          OR
                                          ((b.ket_status IN ('MC Stop', 'Cuci Mesin', 'MC Rusak')) AND b.status = 'antri mesin')
                                      GROUP BY
                                        b.proses, 
                                        b.ket_status,
                                        a.g_shift,
                                        c.g_shift
                                      ORDER BY
                                          b.proses ASC");
            $c = 1;
            $no = 1;
            while ($rowR = sqlsrv_fetch_array($sqlR)) {
              $bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99';
              ?>
              <tr bgcolor="<?php echo $bgcolor; ?>">
                <td>
                  <div align="center"><strong><?php echo $no; ?></strong></div>
                </td>
                <td><?php echo $rowR['proses']; ?></td>
                <td><?php echo $rowR['ket_status']; ?></td>
                <td>
                  <div align="center"><?php echo $rowR['RB']; ?></div>
                </td>
                <td>
                  <div align="right"><?php echo $rowR['qtyRB']; ?></div>
                </td>
                <td>
                  <div align="center"><?php echo $rowR['RL']; ?></div>
                </td>
                <td>
                  <div align="right"><?php echo $rowR['qtyRL']; ?></div>
                </td>
                <td>
                  <div align="center"><?php echo $rowR['RB1']; ?></div>
                </td>
                <td>
                  <div align="right"><?php echo $rowR['qtyRB1']; ?></div>
                </td>
                <td>
                  <div align="center"><?php echo $rowR['RL1']; ?></div>
                </td>
                <td>
                  <div align="right"><?php echo $rowR['qtyRL1']; ?></div>
                </td>
                <td>
                  <div align="center"><strong><?php echo $trb = $rowR['RB'] + $rowR['RB1']; ?></strong></div>
                </td>
                <td>
                  <div align="center"><strong><?php echo $trl = $rowR['RL'] + $rowR['RL1']; ?></strong></div>
                </td>
                <td>
                  <div align="right">
                    <strong><?php echo $tqt = $rowR['qtyRL'] + $rowR['qtyRL1'] + $rowR['qtyRB'] + $rowR['qtyRB1']; ?></strong>
                  </div>
                </td>
                <td>
                  <div align="center"><?php echo $rowR['RBadidas']; ?></div>
                </td>
                <td>
                  <div align="right"><?php echo $rowR['qtyRBadidas']; ?></div>
                </td>
                <td>
                  <div align="center"><?php echo $rowR['RLadidas']; ?></div>
                </td>
                <td>
                  <div align="right"><?php echo $rowR['qtyRLadidas']; ?></div>
                </td>
                <td>
                  <div align="center"><?php echo $rowR['RBadidas1']; ?></div>
                </td>
                <td>
                  <div align="right"><?php echo $rowR['qtyRBadidas1']; ?></div>
                </td>
                <td>
                  <div align="center"><?php echo $rowR['RLadidas1']; ?></div>
                </td>
                <td>
                  <div align="right"><?php echo $rowR['qtyRLadidas1']; ?></div>
                </td>
                <td>
                  <div align="center"><strong><?php echo $trbadidas = $rowR['RBadidas'] + $rowR['RBadidas1']; ?></strong>
                  </div>
                </td>
                <td>
                  <div align="center"><strong><?php echo $trladidas = $rowR['RLadidas'] + $rowR['RLadidas1']; ?></strong>
                  </div>
                </td>
                <td>
                  <div align="right">
                    <strong><?php echo $tqtadidas = $rowR['qtyRLadidas'] + $rowR['qtyRLadidas1'] + $rowR['qtyRBadidas'] + $rowR['qtyRBadidas1']; ?></strong>
                  </div>
                </td>
              </tr>
              <?php

              $totRB = $totRB + $rowR['RB'];
              $totRL = $totRL + $rowR['RL'];
              $totqtyRB = $totqtyRB + $rowR['qtyRB'];
              $totqtyRL = $totqtyRL + $rowR['qtyRL'];
              $totRB1 = $totRB1 + $rowR['RB1'];
              $totRL1 = $totRL1 + $rowR['RL1'];
              $totqtyRB1 = $totqtyRB1 + $rowR['qtyRB1'];
              $totqtyRL1 = $totqtyRL1 + $rowR['qtyRL1'];
              $trbrl = $totRB + $totRL;
              $tqtyrbrl = $totqtyRB + $totqtyRL;
              $trbrl1 = $totRB1 + $totRL1;
              $tqtyrbrl1 = $totqtyRB1 + $totqtyRL1;
              $totRBadidas = $totRBadidas + $rowR['RBadidas'];
              $totRLadidas = $totRLadidas + $rowR['RLadidas'];
              $totqtyRBadidas = $totqtyRBadidas + $rowR['qtyRBadidas'];
              $totqtyRLadidas = $totqtyRLadidas + $rowR['qtyRLadidas'];
              $totRBadidas1 = $totRBadidas1 + $rowR['RBadidas1'];
              $totRLadidas1 = $totRLadidas1 + $rowR['RLadidas1'];
              $totqtyRBadidas1 = $totqtyRBadidas1 + $rowR['qtyRBadidas1'];
              $totqtyRLadidas1 = $totqtyRLadidas1 + $rowR['qtyRLadidas1'];
              $trbrladidas = $totRBadidas + $totRLadidas;
              $tqtyrbrladidas = $totqtyRBadidas + $totqtyRLadidas;
              $trbrladidas1 = $totRBadidas1 + $totRLadidas1;
              $tqtyrbrladidas1 = $totqtyRBadidas1 + $totqtyRLadidas1;

              $no++;
            } ?>
            <tr>
              <td bgcolor="#99FF99">&nbsp;</td>
              <td bgcolor="#99FF99"><strong>Subtotal</strong></td>
              <td bgcolor="#99FF99">&nbsp;</td>
              <td bgcolor="#99FF99">
                <div align="center"><strong><?php echo $totRB; ?></strong></div>
              </td>
              <td bgcolor="#99FF99">
                <div align="right"><strong><?php echo $totqtyRB; ?></strong></div>
              </td>
              <td bgcolor="#99FF99">
                <div align="center"><strong><?php echo $totRL; ?></strong></div>
              </td>
              <td bgcolor="#99FF99">
                <div align="right"><strong><?php echo $totqtyRL; ?></strong></div>
              </td>
              <td bgcolor="#99FF99">
                <div align="center"><strong><?php echo $totRB1; ?></strong></div>
              </td>
              <td bgcolor="#99FF99">
                <div align="right"><strong><?php echo $totqtyRB1; ?></strong></div>
              </td>
              <td bgcolor="#99FF99">
                <div align="center"><strong><?php echo $totRL1; ?></strong></div>
              </td>
              <td bgcolor="#99FF99">
                <div align="right"><strong><?php echo $totqtyRL1; ?></strong></div>
              </td>
              <td bgcolor="#99FF99">
                <div align="center"><strong><?php echo $totalrb = $totRB + $totRB1; ?></strong></div>
              </td>
              <td bgcolor="#99FF99">
                <div align="center"><strong><?php echo $totalrl = $totRL + $totRL1; ?></strong></div>
              </td>
              <td bgcolor="#99FF99">
                <div align="right">
                  <strong><?php echo $totalqt = $totqtyRB + $totqtyRB1 + $totqtyRL + $totqtyRL1; ?></strong></div>
              </td>
              <td bgcolor="#99FF99">
                <div align="center"><strong><?php echo $totRBadidas; ?></strong></div>
              </td>
              <td bgcolor="#99FF99">
                <div align="right"><strong><?php echo $totqtyRBadidas; ?></strong></div>
              </td>
              <td bgcolor="#99FF99">
                <div align="center"><strong><?php echo $totRLadidas; ?></strong></div>
              </td>
              <td bgcolor="#99FF99">
                <div align="right"><strong><?php echo $totqtyRLadidas; ?></strong></div>
              </td>
              <td bgcolor="#99FF99">
                <div align="center"><strong><?php echo $totRBadidas1; ?></strong></div>
              </td>
              <td bgcolor="#99FF99">
                <div align="right"><strong><?php echo $totqtyRBadidas1; ?></strong></div>
              </td>
              <td bgcolor="#99FF99">
                <div align="center"><strong><?php echo $totRLadidas1; ?></strong></div>
              </td>
              <td bgcolor="#99FF99">
                <div align="right"><strong><?php echo $totqtyRLadidas1; ?></strong></div>
              </td>
              <td bgcolor="#99FF99">
                <div align="center"><strong><?php echo $totalrbadidas = $totRBadidas + $totRBadidas1; ?></strong></div>
              </td>
              <td bgcolor="#99FF99">
                <div align="center"><strong><?php echo $totalrladidas = $totRLadidas + $totRLadidas1; ?></strong></div>
              </td>
              <td bgcolor="#99FF99">
                <div align="right">
                  <strong><?php echo $totalqtyadidas = $totqtyRBadidas + $totqtyRLadidas + $totqtyRBadidas1 + $totqtyRLadidas1; ?></strong>
                </div>
              </td>
            </tr>
          </table>
          <table width="100%" border="0" class="table-list1">
            <tr>
              <td rowspan="3" valign="middle" bgcolor="#99FF99">
                <div align="center"><strong>No.</strong></div>
              </td>
              <td rowspan="3" valign="middle" bgcolor="#99FF99">
                <div align="center"><strong>Kestabilan Resep</strong></div>
              </td>
              <td colspan="11" bgcolor="#99FF99">
                <div align="center"><strong>ALL BUYER</strong></div>
              </td>
              <td colspan="11" bgcolor="#99FF99">
                <div align="center"><strong>BUYER ADIDAS</strong></div>
              </td>
            </tr>
            <tr>
              <td colspan="4" bgcolor="#99FF99">
                <div align="center"><strong>Quantity &gt; 200 Kg</strong></div>
              </td>
              <td colspan="4" bgcolor="#99FF99">
                <div align="center"><strong>Quantity &lt; 200 Kg</strong></div>
              </td>
              <td colspan="3" bgcolor="#99FF99">
                <div align="center"><strong>Total</strong></div>
              </td>
              <td colspan="4" bgcolor="#99FF99">
                <div align="center"><strong>Quantity &gt; 200 Kg</strong></div>
              </td>
              <td colspan="4" bgcolor="#99FF99">
                <div align="center"><strong>Quantity &lt; 200 Kg</strong></div>
              </td>
              <td colspan="3" bgcolor="#99FF99">
                <div align="center"><strong>Total</strong></div>
              </td>
            </tr>
            <tr>
              <td bgcolor="#99FF99">
                <div align="center"><strong>R.B</strong></div>
              </td>
              <td bgcolor="#99FF99">
                <div align="center"><strong>Qty</strong></div>
              </td>
              <td bgcolor="#99FF99">
                <div align="center"><strong>R.L</strong></div>
              </td>
              <td bgcolor="#99FF99">
                <div align="center"><strong>Qty</strong></div>
              </td>
              <td bgcolor="#99FF99">
                <div align="center"><strong>R.B</strong></div>
              </td>
              <td bgcolor="#99FF99">
                <div align="center"><strong>Qty</strong></div>
              </td>
              <td bgcolor="#99FF99">
                <div align="center"><strong>R.L</strong></div>
              </td>
              <td bgcolor="#99FF99">
                <div align="center"><strong>Qty</strong></div>
              </td>
              <td bgcolor="#99FF99">
                <div align="center"><strong>R.B</strong></div>
              </td>
              <td bgcolor="#99FF99">
                <div align="center"><strong>R.L</strong></div>
              </td>
              <td bgcolor="#99FF99">
                <div align="center"><strong>Qty</strong></div>
              </td>
              <td bgcolor="#99FF99">
                <div align="center"><strong>R.B</strong></div>
              </td>
              <td bgcolor="#99FF99">
                <div align="center"><strong>Qty</strong></div>
              </td>
              <td bgcolor="#99FF99">
                <div align="center"><strong>R.L</strong></div>
              </td>
              <td bgcolor="#99FF99">
                <div align="center"><strong>Qty</strong></div>
              </td>
              <td bgcolor="#99FF99">
                <div align="center"><strong>R.B</strong></div>
              </td>
              <td bgcolor="#99FF99">
                <div align="center"><strong>Qty</strong></div>
              </td>
              <td bgcolor="#99FF99">
                <div align="center"><strong>R.L</strong></div>
              </td>
              <td bgcolor="#99FF99">
                <div align="center"><strong>Qty</strong></div>
              </td>
              <td bgcolor="#99FF99">
                <div align="center"><strong>R.B</strong></div>
              </td>
              <td bgcolor="#99FF99">
                <div align="center"><strong>R.L</strong></div>
              </td>
              <td bgcolor="#99FF99">
                <div align="center"><strong>Qty</strong></div>
              </td>
            </tr>
            <?php
            $sqlx = sqlsrv_query($con, "SELECT
                                    k_resep,
                                    SUM(CASE WHEN a.resep = 'Baru' AND b.bruto > 200 AND a.proses = 'Celup Greige' THEN 1 ELSE 0 END) AS RB,
                                    SUM(CASE WHEN a.resep = 'Baru' AND b.bruto > 200 AND a.proses = 'Celup Greige' THEN b.bruto ELSE 0 END) AS qtyRB,
                                    SUM(CASE WHEN a.resep = 'Lama' AND b.bruto > 200 AND a.proses = 'Celup Greige' THEN 1 ELSE 0 END) AS RL,
                                    SUM(CASE WHEN a.resep = 'Lama' AND b.bruto > 200 AND a.proses = 'Celup Greige' THEN b.bruto ELSE 0 END) AS qtyRL,
                                    SUM(CASE WHEN a.resep = 'Baru' AND b.bruto > 0 AND b.bruto < 200 AND a.proses = 'Celup Greige' THEN 1 ELSE 0 END) AS RB1,
                                    SUM(CASE WHEN a.resep = 'Baru' AND b.bruto > 0 AND b.bruto < 200 AND a.proses = 'Celup Greige' THEN b.bruto ELSE 0 END) AS qtyRB1,
                                    SUM(CASE WHEN a.resep = 'Lama' AND b.bruto > 0 AND b.bruto < 200 AND a.proses = 'Celup Greige' THEN 1 ELSE 0 END) AS RL1,
                                    SUM(CASE WHEN a.resep = 'Lama' AND b.bruto > 0 AND b.bruto < 200 AND a.proses = 'Celup Greige' THEN b.bruto ELSE 0 END) AS qtyRL1,
                                    SUM(CASE WHEN a.resep = 'Baru' AND b.bruto > 200 AND b.buyer = 'ADIDAS' AND a.proses = 'Celup Greige' THEN 1 ELSE 0 END) AS RBadidas,
                                    SUM(CASE WHEN a.resep = 'Baru' AND b.bruto > 200 AND b.buyer = 'ADIDAS' AND a.proses = 'Celup Greige' THEN b.bruto ELSE 0 END) AS qtyRBadidas,
                                    SUM(CASE WHEN a.resep = 'Lama' AND b.bruto > 200 AND b.buyer = 'ADIDAS' AND a.proses = 'Celup Greige' THEN 1 ELSE 0 END) AS RLadidas,
                                    SUM(CASE WHEN a.resep = 'Lama' AND b.bruto > 200 AND b.buyer = 'ADIDAS' AND a.proses = 'Celup Greige' THEN b.bruto ELSE 0 END) AS qtyRLadidas,
                                    SUM(CASE WHEN a.resep = 'Baru' AND b.bruto > 0 AND b.bruto < 200 AND b.buyer = 'ADIDAS' AND a.proses = 'Celup Greige' THEN 1 ELSE 0 END) AS RBadidas1,
                                    SUM(CASE WHEN a.resep = 'Baru' AND b.bruto > 0 AND b.bruto < 200 AND b.buyer = 'ADIDAS' AND a.proses = 'Celup Greige' THEN b.bruto ELSE 0 END) AS qtyRBadidas1,
                                    SUM(CASE WHEN a.resep = 'Lama' AND b.bruto > 0 AND b.bruto < 200 AND b.buyer = 'ADIDAS' AND a.proses = 'Celup Greige' THEN 1 ELSE 0 END) AS RLadidas1,
                                    SUM(CASE WHEN a.resep = 'Lama' AND b.bruto > 0 AND b.bruto < 200 AND b.buyer = 'ADIDAS' AND a.proses = 'Celup Greige' THEN b.bruto ELSE 0 END) AS qtyRLadidas1,
                                    ISNULL(a.g_shift, c.g_shift) AS shft
                                FROM
                                    db_dying.tbl_schedule b
                                    LEFT JOIN db_dying.tbl_montemp c ON c.id_schedule = b.id
                                    LEFT JOIN db_dying.tbl_hasilcelup a ON a.id_montemp = c.id
                                WHERE
                                    (CONVERT(date, a.tgl_buat) BETWEEN '$Awal' AND '$Akhir')
                                    AND k_resep = ''
                                GROUP BY
                                    a.g_shift,
                                    c.g_shift,
                                    k_resep");
            $rx = sqlsrv_fetch_array($sqlx);
            $sql0x = sqlsrv_query($con, "SELECT
                                    k_resep,
                                    SUM(CASE WHEN a.resep = 'Baru' AND b.bruto > 200 AND a.proses = 'Celup Greige' THEN 1 ELSE 0 END) AS RB,
                                    SUM(CASE WHEN a.resep = 'Baru' AND b.bruto > 200 AND a.proses = 'Celup Greige' THEN b.bruto ELSE 0 END) AS qtyRB,
                                    SUM(CASE WHEN a.resep = 'Lama' AND b.bruto > 200 AND a.proses = 'Celup Greige' THEN 1 ELSE 0 END) AS RL,
                                    SUM(CASE WHEN a.resep = 'Lama' AND b.bruto > 200 AND a.proses = 'Celup Greige' THEN b.bruto ELSE 0 END) AS qtyRL,
                                    SUM(CASE WHEN a.resep = 'Baru' AND b.bruto > 0 AND b.bruto < 200 AND a.proses = 'Celup Greige' THEN 1 ELSE 0 END) AS RB1,
                                    SUM(CASE WHEN a.resep = 'Baru' AND b.bruto > 0 AND b.bruto < 200 AND a.proses = 'Celup Greige' THEN b.bruto ELSE 0 END) AS qtyRB1,
                                    SUM(CASE WHEN a.resep = 'Lama' AND b.bruto > 0 AND b.bruto < 200 AND a.proses = 'Celup Greige' THEN 1 ELSE 0 END) AS RL1,
                                    SUM(CASE WHEN a.resep = 'Lama' AND b.bruto > 0 AND b.bruto < 200 AND a.proses = 'Celup Greige' THEN b.bruto ELSE 0 END) AS qtyRL1,
                                    SUM(CASE WHEN a.resep = 'Baru' AND b.bruto > 200 AND b.buyer = 'ADIDAS' AND a.proses = 'Celup Greige' THEN 1 ELSE 0 END) AS RBadidas,
                                    SUM(CASE WHEN a.resep = 'Baru' AND b.bruto > 200 AND b.buyer = 'ADIDAS' AND a.proses = 'Celup Greige' THEN b.bruto ELSE 0 END) AS qtyRBadidas,
                                    SUM(CASE WHEN a.resep = 'Lama' AND b.bruto > 200 AND b.buyer = 'ADIDAS' AND a.proses = 'Celup Greige' THEN 1 ELSE 0 END) AS RLadidas,
                                    SUM(CASE WHEN a.resep = 'Lama' AND b.bruto > 200 AND b.buyer = 'ADIDAS' AND a.proses = 'Celup Greige' THEN b.bruto ELSE 0 END) AS qtyRLadidas,
                                    SUM(CASE WHEN a.resep = 'Baru' AND b.bruto > 0 AND b.bruto < 200 AND b.buyer = 'ADIDAS' AND a.proses = 'Celup Greige' THEN 1 ELSE 0 END) AS RBadidas1,
                                    SUM(CASE WHEN a.resep = 'Baru' AND b.bruto > 0 AND b.bruto < 200 AND b.buyer = 'ADIDAS' AND a.proses = 'Celup Greige' THEN b.bruto ELSE 0 END) AS qtyRBadidas1,
                                    SUM(CASE WHEN a.resep = 'Lama' AND b.bruto > 0 AND b.bruto < 200 AND b.buyer = 'ADIDAS' AND a.proses = 'Celup Greige' THEN 1 ELSE 0 END) AS RLadidas1,
                                    SUM(CASE WHEN a.resep = 'Lama' AND b.bruto > 0 AND b.bruto < 200 AND b.buyer = 'ADIDAS' AND a.proses = 'Celup Greige' THEN b.bruto ELSE 0 END) AS qtyRLadidas1,
                                    ISNULL(a.g_shift, b.g_shift) AS shft
                                FROM
                                    db_dying.tbl_schedule b
                                    LEFT JOIN db_dying.tbl_montemp c ON c.id_schedule = b.id
                                    LEFT JOIN db_dying.tbl_hasilcelup a ON a.id_montemp = c.id
                                WHERE
                                    $shft 
                                    (CONVERT(datetime, a.tgl_buat, 120) BETWEEN '$Awal' AND '$Akhir')
                                    AND k_resep = '0x'
                                GROUP BY
                                    b.g_shift,
                                    a.g_shift,
                                    k_resep");
            $r0x = sqlsrv_fetch_array($sql0x);
            $sql1x = sqlsrv_query($con, "SELECT
                                    k_resep,
                                    SUM(CASE WHEN a.resep = 'Baru' AND b.bruto > 200 AND a.proses = 'Celup Greige' THEN 1 ELSE 0 END) AS RB,
                                    SUM(CASE WHEN a.resep = 'Baru' AND b.bruto > 200 AND a.proses = 'Celup Greige' THEN b.bruto ELSE 0 END) AS qtyRB,
                                    SUM(CASE WHEN a.resep = 'Lama' AND b.bruto > 200 AND a.proses = 'Celup Greige' THEN 1 ELSE 0 END) AS RL,
                                    SUM(CASE WHEN a.resep = 'Lama' AND b.bruto > 200 AND a.proses = 'Celup Greige' THEN b.bruto ELSE 0 END) AS qtyRL,
                                    SUM(CASE WHEN a.resep = 'Baru' AND b.bruto > 0 AND b.bruto < 200 AND a.proses = 'Celup Greige' THEN 1 ELSE 0 END) AS RB1,
                                    SUM(CASE WHEN a.resep = 'Baru' AND b.bruto > 0 AND b.bruto < 200 AND a.proses = 'Celup Greige' THEN b.bruto ELSE 0 END) AS qtyRB1,
                                    SUM(CASE WHEN a.resep = 'Lama' AND b.bruto > 0 AND b.bruto < 200 AND a.proses = 'Celup Greige' THEN 1 ELSE 0 END) AS RL1,
                                    SUM(CASE WHEN a.resep = 'Lama' AND b.bruto > 0 AND b.bruto < 200 AND a.proses = 'Celup Greige' THEN b.bruto ELSE 0 END) AS qtyRL1,
                                    SUM(CASE WHEN a.resep = 'Baru' AND b.bruto > 200 AND b.buyer = 'ADIDAS' AND a.proses = 'Celup Greige' THEN 1 ELSE 0 END) AS RBadidas,
                                    SUM(CASE WHEN a.resep = 'Baru' AND b.bruto > 200 AND b.buyer = 'ADIDAS' AND a.proses = 'Celup Greige' THEN b.bruto ELSE 0 END) AS qtyRBadidas,
                                    SUM(CASE WHEN a.resep = 'Lama' AND b.bruto > 200 AND b.buyer = 'ADIDAS' AND a.proses = 'Celup Greige' THEN 1 ELSE 0 END) AS RLadidas,
                                    SUM(CASE WHEN a.resep = 'Lama' AND b.bruto > 200 AND b.buyer = 'ADIDAS' AND a.proses = 'Celup Greige' THEN b.bruto ELSE 0 END) AS qtyRLadidas,
                                    SUM(CASE WHEN a.resep = 'Baru' AND b.bruto > 0 AND b.bruto < 200 AND b.buyer = 'ADIDAS' AND a.proses = 'Celup Greige' THEN 1 ELSE 0 END) AS RBadidas1,
                                    SUM(CASE WHEN a.resep = 'Baru' AND b.bruto > 0 AND b.bruto < 200 AND b.buyer = 'ADIDAS' AND a.proses = 'Celup Greige' THEN b.bruto ELSE 0 END) AS qtyRBadidas1,
                                    SUM(CASE WHEN a.resep = 'Lama' AND b.bruto > 0 AND b.bruto < 200 AND b.buyer = 'ADIDAS' AND a.proses = 'Celup Greige' THEN 1 ELSE 0 END) AS RLadidas1,
                                    SUM(CASE WHEN a.resep = 'Lama' AND b.bruto > 0 AND b.bruto < 200 AND b.buyer = 'ADIDAS' AND a.proses = 'Celup Greige' THEN b.bruto ELSE 0 END) AS qtyRLadidas1,
                                    ISNULL(a.g_shift, b.g_shift) AS shft
                                FROM
                                    db_dying.tbl_schedule b
                                    LEFT JOIN db_dying.tbl_montemp c ON c.id_schedule = b.id
                                    LEFT JOIN db_dying.tbl_hasilcelup a ON a.id_montemp = c.id
                                WHERE
                                    $shft 
                                    (CONVERT(datetime, a.tgl_buat, 120) BETWEEN '$Awal' AND '$Akhir')
                                    AND k_resep = '1x'
                                GROUP BY
                                    b.g_shift,
                                    a.g_shift,
                                    k_resep");
            $r1x = sqlsrv_fetch_array($sql1x);
            $sql2x = sqlsrv_query($con, "SELECT
                                    k_resep,
                                    SUM(CASE WHEN a.resep = 'Baru' AND b.bruto > 200 AND a.proses = 'Celup Greige' THEN 1 ELSE 0 END) AS RB,
                                    SUM(CASE WHEN a.resep = 'Baru' AND b.bruto > 200 AND a.proses = 'Celup Greige' THEN b.bruto ELSE 0 END) AS qtyRB,
                                    SUM(CASE WHEN a.resep = 'Lama' AND b.bruto > 200 AND a.proses = 'Celup Greige' THEN 1 ELSE 0 END) AS RL,
                                    SUM(CASE WHEN a.resep = 'Lama' AND b.bruto > 200 AND a.proses = 'Celup Greige' THEN b.bruto ELSE 0 END) AS qtyRL,
                                    SUM(CASE WHEN a.resep = 'Baru' AND b.bruto > 0 AND b.bruto < 200 AND a.proses = 'Celup Greige' THEN 1 ELSE 0 END) AS RB1,
                                    SUM(CASE WHEN a.resep = 'Baru' AND b.bruto > 0 AND b.bruto < 200 AND a.proses = 'Celup Greige' THEN b.bruto ELSE 0 END) AS qtyRB1,
                                    SUM(CASE WHEN a.resep = 'Lama' AND b.bruto > 0 AND b.bruto < 200 AND a.proses = 'Celup Greige' THEN 1 ELSE 0 END) AS RL1,
                                    SUM(CASE WHEN a.resep = 'Lama' AND b.bruto > 0 AND b.bruto < 200 AND a.proses = 'Celup Greige' THEN b.bruto ELSE 0 END) AS qtyRL1,
                                    SUM(CASE WHEN a.resep = 'Baru' AND b.bruto > 200 AND b.buyer = 'ADIDAS' AND a.proses = 'Celup Greige' THEN 1 ELSE 0 END) AS RBadidas,
                                    SUM(CASE WHEN a.resep = 'Baru' AND b.bruto > 200 AND b.buyer = 'ADIDAS' AND a.proses = 'Celup Greige' THEN b.bruto ELSE 0 END) AS qtyRBadidas,
                                    SUM(CASE WHEN a.resep = 'Lama' AND b.bruto > 200 AND b.buyer = 'ADIDAS' AND a.proses = 'Celup Greige' THEN 1 ELSE 0 END) AS RLadidas,
                                    SUM(CASE WHEN a.resep = 'Lama' AND b.bruto > 200 AND b.buyer = 'ADIDAS' AND a.proses = 'Celup Greige' THEN b.bruto ELSE 0 END) AS qtyRLadidas,
                                    SUM(CASE WHEN a.resep = 'Baru' AND b.bruto > 0 AND b.bruto < 200 AND b.buyer = 'ADIDAS' AND a.proses = 'Celup Greige' THEN 1 ELSE 0 END) AS RBadidas1,
                                    SUM(CASE WHEN a.resep = 'Baru' AND b.bruto > 0 AND b.bruto < 200 AND b.buyer = 'ADIDAS' AND a.proses = 'Celup Greige' THEN b.bruto ELSE 0 END) AS qtyRBadidas1,
                                    SUM(CASE WHEN a.resep = 'Lama' AND b.bruto > 0 AND b.bruto < 200 AND b.buyer = 'ADIDAS' AND a.proses = 'Celup Greige' THEN 1 ELSE 0 END) AS RLadidas1,
                                    SUM(CASE WHEN a.resep = 'Lama' AND b.bruto > 0 AND b.bruto < 200 AND b.buyer = 'ADIDAS' AND a.proses = 'Celup Greige' THEN b.bruto ELSE 0 END) AS qtyRLadidas1,
                                    ISNULL(a.g_shift, b.g_shift) AS shft
                                FROM
                                    db_dying.tbl_schedule b
                                    LEFT JOIN db_dying.tbl_montemp c ON c.id_schedule = b.id
                                    LEFT JOIN db_dying.tbl_hasilcelup a ON a.id_montemp = c.id
                                WHERE
                                    $shft 
                                    (CONVERT(datetime, a.tgl_buat, 120) BETWEEN '$Awal' AND '$Akhir')
                                    AND k_resep = '2x'
                                GROUP BY
                                    b.g_shift,
                                    a.g_shift,
                                    k_resep");
            $r2x = sqlsrv_fetch_array($sql2x);
            $sql3x = sqlsrv_query($con, "SELECT
                                    k_resep,
                                    SUM(CASE WHEN a.resep = 'Baru' AND b.bruto > 200 AND a.proses = 'Celup Greige' THEN 1 ELSE 0 END) AS RB,
                                    SUM(CASE WHEN a.resep = 'Baru' AND b.bruto > 200 AND a.proses = 'Celup Greige' THEN b.bruto ELSE 0 END) AS qtyRB,
                                    SUM(CASE WHEN a.resep = 'Lama' AND b.bruto > 200 AND a.proses = 'Celup Greige' THEN 1 ELSE 0 END) AS RL,
                                    SUM(CASE WHEN a.resep = 'Lama' AND b.bruto > 200 AND a.proses = 'Celup Greige' THEN b.bruto ELSE 0 END) AS qtyRL,
                                    SUM(CASE WHEN a.resep = 'Baru' AND b.bruto > 0 AND b.bruto < 200 AND a.proses = 'Celup Greige' THEN 1 ELSE 0 END) AS RB1,
                                    SUM(CASE WHEN a.resep = 'Baru' AND b.bruto > 0 AND b.bruto < 200 AND a.proses = 'Celup Greige' THEN b.bruto ELSE 0 END) AS qtyRB1,
                                    SUM(CASE WHEN a.resep = 'Lama' AND b.bruto > 0 AND b.bruto < 200 AND a.proses = 'Celup Greige' THEN 1 ELSE 0 END) AS RL1,
                                    SUM(CASE WHEN a.resep = 'Lama' AND b.bruto > 0 AND b.bruto < 200 AND a.proses = 'Celup Greige' THEN b.bruto ELSE 0 END) AS qtyRL1,
                                    SUM(CASE WHEN a.resep = 'Baru' AND b.bruto > 200 AND b.buyer = 'ADIDAS' AND a.proses = 'Celup Greige' THEN 1 ELSE 0 END) AS RBadidas,
                                    SUM(CASE WHEN a.resep = 'Baru' AND b.bruto > 200 AND b.buyer = 'ADIDAS' AND a.proses = 'Celup Greige' THEN b.bruto ELSE 0 END) AS qtyRBadidas,
                                    SUM(CASE WHEN a.resep = 'Lama' AND b.bruto > 200 AND b.buyer = 'ADIDAS' AND a.proses = 'Celup Greige' THEN 1 ELSE 0 END) AS RLadidas,
                                    SUM(CASE WHEN a.resep = 'Lama' AND b.bruto > 200 AND b.buyer = 'ADIDAS' AND a.proses = 'Celup Greige' THEN b.bruto ELSE 0 END) AS qtyRLadidas,
                                    SUM(CASE WHEN a.resep = 'Baru' AND b.bruto > 0 AND b.bruto < 200 AND b.buyer = 'ADIDAS' AND a.proses = 'Celup Greige' THEN 1 ELSE 0 END) AS RBadidas1,
                                    SUM(CASE WHEN a.resep = 'Baru' AND b.bruto > 0 AND b.bruto < 200 AND b.buyer = 'ADIDAS' AND a.proses = 'Celup Greige' THEN b.bruto ELSE 0 END) AS qtyRBadidas1,
                                    SUM(CASE WHEN a.resep = 'Lama' AND b.bruto > 0 AND b.bruto < 200 AND b.buyer = 'ADIDAS' AND a.proses = 'Celup Greige' THEN 1 ELSE 0 END) AS RLadidas1,
                                    SUM(CASE WHEN a.resep = 'Lama' AND b.bruto > 0 AND b.bruto < 200 AND b.buyer = 'ADIDAS' AND a.proses = 'Celup Greige' THEN b.bruto ELSE 0 END) AS qtyRLadidas1,
                                    ISNULL(a.g_shift, b.g_shift) AS shft
                                FROM
                                    db_dying.tbl_schedule b
                                    LEFT JOIN db_dying.tbl_montemp c ON c.id_schedule = b.id
                                    LEFT JOIN db_dying.tbl_hasilcelup a ON a.id_montemp = c.id
                                WHERE
                                    $shft 
                                    (CONVERT(datetime, a.tgl_buat, 120) BETWEEN '$Awal' AND '$Akhir')
                                    AND k_resep = '3x'
                                GROUP BY
                                    b.g_shift,
                                    a.g_shift,
                                    k_resep");
            $r3x = sqlsrv_fetch_array($sql3x);
            $sql4x = sqlsrv_query($con, "SELECT
                                    k_resep,
                                    SUM(CASE WHEN a.resep = 'Baru' AND b.bruto > 200 AND a.proses = 'Celup Greige' THEN 1 ELSE 0 END) AS RB,
                                    SUM(CASE WHEN a.resep = 'Baru' AND b.bruto > 200 AND a.proses = 'Celup Greige' THEN b.bruto ELSE 0 END) AS qtyRB,
                                    SUM(CASE WHEN a.resep = 'Lama' AND b.bruto > 200 AND a.proses = 'Celup Greige' THEN 1 ELSE 0 END) AS RL,
                                    SUM(CASE WHEN a.resep = 'Lama' AND b.bruto > 200 AND a.proses = 'Celup Greige' THEN b.bruto ELSE 0 END) AS qtyRL,
                                    SUM(CASE WHEN a.resep = 'Baru' AND b.bruto > 0 AND b.bruto < 200 AND a.proses = 'Celup Greige' THEN 1 ELSE 0 END) AS RB1,
                                    SUM(CASE WHEN a.resep = 'Baru' AND b.bruto > 0 AND b.bruto < 200 AND a.proses = 'Celup Greige' THEN b.bruto ELSE 0 END) AS qtyRB1,
                                    SUM(CASE WHEN a.resep = 'Lama' AND b.bruto > 0 AND b.bruto < 200 AND a.proses = 'Celup Greige' THEN 1 ELSE 0 END) AS RL1,
                                    SUM(CASE WHEN a.resep = 'Lama' AND b.bruto > 0 AND b.bruto < 200 AND a.proses = 'Celup Greige' THEN b.bruto ELSE 0 END) AS qtyRL1,
                                    SUM(CASE WHEN a.resep = 'Baru' AND b.bruto > 200 AND b.buyer = 'ADIDAS' AND a.proses = 'Celup Greige' THEN 1 ELSE 0 END) AS RBadidas,
                                    SUM(CASE WHEN a.resep = 'Baru' AND b.bruto > 200 AND b.buyer = 'ADIDAS' AND a.proses = 'Celup Greige' THEN b.bruto ELSE 0 END) AS qtyRBadidas,
                                    SUM(CASE WHEN a.resep = 'Lama' AND b.bruto > 200 AND b.buyer = 'ADIDAS' AND a.proses = 'Celup Greige' THEN 1 ELSE 0 END) AS RLadidas,
                                    SUM(CASE WHEN a.resep = 'Lama' AND b.bruto > 200 AND b.buyer = 'ADIDAS' AND a.proses = 'Celup Greige' THEN b.bruto ELSE 0 END) AS qtyRLadidas,
                                    SUM(CASE WHEN a.resep = 'Baru' AND b.bruto > 0 AND b.bruto < 200 AND b.buyer = 'ADIDAS' AND a.proses = 'Celup Greige' THEN 1 ELSE 0 END) AS RBadidas1,
                                    SUM(CASE WHEN a.resep = 'Baru' AND b.bruto > 0 AND b.bruto < 200 AND b.buyer = 'ADIDAS' AND a.proses = 'Celup Greige' THEN b.bruto ELSE 0 END) AS qtyRBadidas1,
                                    SUM(CASE WHEN a.resep = 'Lama' AND b.bruto > 0 AND b.bruto < 200 AND b.buyer = 'ADIDAS' AND a.proses = 'Celup Greige' THEN 1 ELSE 0 END) AS RLadidas1,
                                    SUM(CASE WHEN a.resep = 'Lama' AND b.bruto > 0 AND b.bruto < 200 AND b.buyer = 'ADIDAS' AND a.proses = 'Celup Greige' THEN b.bruto ELSE 0 END) AS qtyRLadidas1,
                                    ISNULL(a.g_shift, b.g_shift) AS shft
                                FROM
                                    db_dying.tbl_schedule b
                                    LEFT JOIN db_dying.tbl_montemp c ON c.id_schedule = b.id
                                    LEFT JOIN db_dying.tbl_hasilcelup a ON a.id_montemp = c.id
                                WHERE
                                    $shft 
                                    (CONVERT(datetime, a.tgl_buat, 120) BETWEEN '$Awal' AND '$Akhir')
                                    AND k_resep = '4x'
                                GROUP BY
                                    b.g_shift,
                                    a.g_shift,
                                    k_resep");
            $r4x = sqlsrv_fetch_array($sql4x);
            $sql5x = sqlsrv_query($con, "SELECT
                                    k_resep,
                                    SUM(CASE WHEN a.resep = 'Baru' AND b.bruto > 200 AND a.proses = 'Celup Greige' THEN 1 ELSE 0 END) AS RB,
                                    SUM(CASE WHEN a.resep = 'Baru' AND b.bruto > 200 AND a.proses = 'Celup Greige' THEN b.bruto ELSE 0 END) AS qtyRB,
                                    SUM(CASE WHEN a.resep = 'Lama' AND b.bruto > 200 AND a.proses = 'Celup Greige' THEN 1 ELSE 0 END) AS RL,
                                    SUM(CASE WHEN a.resep = 'Lama' AND b.bruto > 200 AND a.proses = 'Celup Greige' THEN b.bruto ELSE 0 END) AS qtyRL,
                                    SUM(CASE WHEN a.resep = 'Baru' AND b.bruto > 0 AND b.bruto < 200 AND a.proses = 'Celup Greige' THEN 1 ELSE 0 END) AS RB1,
                                    SUM(CASE WHEN a.resep = 'Baru' AND b.bruto > 0 AND b.bruto < 200 AND a.proses = 'Celup Greige' THEN b.bruto ELSE 0 END) AS qtyRB1,
                                    SUM(CASE WHEN a.resep = 'Lama' AND b.bruto > 0 AND b.bruto < 200 AND a.proses = 'Celup Greige' THEN 1 ELSE 0 END) AS RL1,
                                    SUM(CASE WHEN a.resep = 'Lama' AND b.bruto > 0 AND b.bruto < 200 AND a.proses = 'Celup Greige' THEN b.bruto ELSE 0 END) AS qtyRL1,
                                    SUM(CASE WHEN a.resep = 'Baru' AND b.bruto > 200 AND b.buyer = 'ADIDAS' AND a.proses = 'Celup Greige' THEN 1 ELSE 0 END) AS RBadidas,
                                    SUM(CASE WHEN a.resep = 'Baru' AND b.bruto > 200 AND b.buyer = 'ADIDAS' AND a.proses = 'Celup Greige' THEN b.bruto ELSE 0 END) AS qtyRBadidas,
                                    SUM(CASE WHEN a.resep = 'Lama' AND b.bruto > 200 AND b.buyer = 'ADIDAS' AND a.proses = 'Celup Greige' THEN 1 ELSE 0 END) AS RLadidas,
                                    SUM(CASE WHEN a.resep = 'Lama' AND b.bruto > 200 AND b.buyer = 'ADIDAS' AND a.proses = 'Celup Greige' THEN b.bruto ELSE 0 END) AS qtyRLadidas,
                                    SUM(CASE WHEN a.resep = 'Baru' AND b.bruto > 0 AND b.bruto < 200 AND b.buyer = 'ADIDAS' AND a.proses = 'Celup Greige' THEN 1 ELSE 0 END) AS RBadidas1,
                                    SUM(CASE WHEN a.resep = 'Baru' AND b.bruto > 0 AND b.bruto < 200 AND b.buyer = 'ADIDAS' AND a.proses = 'Celup Greige' THEN b.bruto ELSE 0 END) AS qtyRBadidas1,
                                    SUM(CASE WHEN a.resep = 'Lama' AND b.bruto > 0 AND b.bruto < 200 AND b.buyer = 'ADIDAS' AND a.proses = 'Celup Greige' THEN 1 ELSE 0 END) AS RLadidas1,
                                    SUM(CASE WHEN a.resep = 'Lama' AND b.bruto > 0 AND b.bruto < 200 AND b.buyer = 'ADIDAS' AND a.proses = 'Celup Greige' THEN b.bruto ELSE 0 END) AS qtyRLadidas1,
                                    ISNULL(a.g_shift, b.g_shift) AS shft
                                FROM
                                    db_dying.tbl_schedule b
                                    LEFT JOIN db_dying.tbl_montemp c ON c.id_schedule = b.id
                                    LEFT JOIN db_dying.tbl_hasilcelup a ON a.id_montemp = c.id
                                WHERE
                                    $shft 
                                    (CONVERT(datetime, a.tgl_buat, 120) BETWEEN '$Awal' AND '$Akhir')
                                    AND k_resep = '5x'
                                GROUP BY
                                    b.g_shift,
                                    a.g_shift,
                                    k_resep");
            $r5x = sqlsrv_fetch_array($sql5x);
            $sql6x = sqlsrv_query($con, "SELECT
                                    k_resep,
                                    SUM(CASE WHEN a.resep = 'Baru' AND b.bruto > 200 AND a.proses = 'Celup Greige' THEN 1 ELSE 0 END) AS RB,
                                    SUM(CASE WHEN a.resep = 'Baru' AND b.bruto > 200 AND a.proses = 'Celup Greige' THEN b.bruto ELSE 0 END) AS qtyRB,
                                    SUM(CASE WHEN a.resep = 'Lama' AND b.bruto > 200 AND a.proses = 'Celup Greige' THEN 1 ELSE 0 END) AS RL,
                                    SUM(CASE WHEN a.resep = 'Lama' AND b.bruto > 200 AND a.proses = 'Celup Greige' THEN b.bruto ELSE 0 END) AS qtyRL,
                                    SUM(CASE WHEN a.resep = 'Baru' AND b.bruto > 0 AND b.bruto < 200 AND a.proses = 'Celup Greige' THEN 1 ELSE 0 END) AS RB1,
                                    SUM(CASE WHEN a.resep = 'Baru' AND b.bruto > 0 AND b.bruto < 200 AND a.proses = 'Celup Greige' THEN b.bruto ELSE 0 END) AS qtyRB1,
                                    SUM(CASE WHEN a.resep = 'Lama' AND b.bruto > 0 AND b.bruto < 200 AND a.proses = 'Celup Greige' THEN 1 ELSE 0 END) AS RL1,
                                    SUM(CASE WHEN a.resep = 'Lama' AND b.bruto > 0 AND b.bruto < 200 AND a.proses = 'Celup Greige' THEN b.bruto ELSE 0 END) AS qtyRL1,
                                    SUM(CASE WHEN a.resep = 'Baru' AND b.bruto > 200 AND b.buyer = 'ADIDAS' AND a.proses = 'Celup Greige' THEN 1 ELSE 0 END) AS RBadidas,
                                    SUM(CASE WHEN a.resep = 'Baru' AND b.bruto > 200 AND b.buyer = 'ADIDAS' AND a.proses = 'Celup Greige' THEN b.bruto ELSE 0 END) AS qtyRBadidas,
                                    SUM(CASE WHEN a.resep = 'Lama' AND b.bruto > 200 AND b.buyer = 'ADIDAS' AND a.proses = 'Celup Greige' THEN 1 ELSE 0 END) AS RLadidas,
                                    SUM(CASE WHEN a.resep = 'Lama' AND b.bruto > 200 AND b.buyer = 'ADIDAS' AND a.proses = 'Celup Greige' THEN b.bruto ELSE 0 END) AS qtyRLadidas,
                                    SUM(CASE WHEN a.resep = 'Baru' AND b.bruto > 0 AND b.bruto < 200 AND b.buyer = 'ADIDAS' AND a.proses = 'Celup Greige' THEN 1 ELSE 0 END) AS RBadidas1,
                                    SUM(CASE WHEN a.resep = 'Baru' AND b.bruto > 0 AND b.bruto < 200 AND b.buyer = 'ADIDAS' AND a.proses = 'Celup Greige' THEN b.bruto ELSE 0 END) AS qtyRBadidas1,
                                    SUM(CASE WHEN a.resep = 'Lama' AND b.bruto > 0 AND b.bruto < 200 AND b.buyer = 'ADIDAS' AND a.proses = 'Celup Greige' THEN 1 ELSE 0 END) AS RLadidas1,
                                    SUM(CASE WHEN a.resep = 'Lama' AND b.bruto > 0 AND b.bruto < 200 AND b.buyer = 'ADIDAS' AND a.proses = 'Celup Greige' THEN b.bruto ELSE 0 END) AS qtyRLadidas1,
                                    ISNULL(a.g_shift, b.g_shift) AS shft
                                FROM
                                    db_dying.tbl_schedule b
                                    LEFT JOIN db_dying.tbl_montemp c ON c.id_schedule = b.id
                                    LEFT JOIN db_dying.tbl_hasilcelup a ON a.id_montemp = c.id
                                WHERE
                                    $shft 
                                    (CONVERT(datetime, a.tgl_buat, 120) BETWEEN '$Awal' AND '$Akhir')
                                    AND k_resep = '6x'
                                GROUP BY
                                    b.g_shift,
                                    a.g_shift,
                                    k_resep");
            $r6x = sqlsrv_fetch_array($sql6x);
            ?>
            <tr bgcolor="#FFCC99">
              <td>
                <div align="center"><strong>1</strong></div>
              </td>
              <td>
                <div align="right">-</div>
              </td>
              <td>
                <div align="center">
                  <?php if ($rx > 0) {
                    echo $rx['RB'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="right">
                  <?php if ($rx > 0) {
                    echo $rx['qtyRB'];
                  } else {
                    echo "0.00";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <?php if ($rx > 0) {
                    echo $rx['RL'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="right">
                  <?php if ($rx > 0) {
                    echo $rx['qtyRL'];
                  } else {
                    echo "0.00";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <?php if ($rx > 0) {
                    echo $rx['RB1'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="right">
                  <?php if ($rx > 0) {
                    echo $rx['qtyRB1'];
                  } else {
                    echo "0.00";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <?php if ($rx > 0) {
                    echo $rx['RL1'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="right">
                  <?php if ($rx > 0) {
                    echo $rx['qtyRL1'];
                  } else {
                    echo "0.00";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <strong>
                    <?php if ($rx > 0) {
                      echo $tkr_RB = $rx['RB'] + $rx['RB1'];
                    } else {
                      echo "0";
                    } ?>
                  </strong>
                </div>
              </td>
              <td>
                <div align="center">
                  <strong>
                    <?php if ($rx > 0) {
                      echo $tkrRL = $rx['RL'] + $rx['RL1'];
                    } else {
                      echo "0";
                    } ?>
                  </strong>
                </div>
              </td>
              <td>
                <div align="right">
                  <strong>
                    <?php if ($rx > 0) {
                      echo $tkrqty = $rx['qtyRB'] + $rx['qtyRB1'] + $rx['qtyRL'] + $rx['qtyRL1'];
                    } else {
                      echo "0.00";
                    } ?>
                  </strong>
                </div>
              </td>
              <td>
                <div align="center">
                  <?php if ($rx > 0) {
                    echo $rx['RBadidas'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="right">
                  <?php if ($rx > 0) {
                    echo $rx['qtyRBadidas'];
                  } else {
                    echo "0.00";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <?php if ($rx > 0) {
                    echo $rx['RLadidas'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="right">
                  <?php if ($rx > 0) {
                    echo $rx['qtyRLadidas'];
                  } else {
                    echo "0.00";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <?php if ($rx > 0) {
                    echo $rx['RBadidas1'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="right">
                  <?php if ($rx > 0) {
                    echo $rx['qtyRBadidas1'];
                  } else {
                    echo "0.00";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <?php if ($rx > 0) {
                    echo $rx['RLadidas1'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="right">
                  <?php if ($rx > 0) {
                    echo $rx['qtyRLadidas1'];
                  } else {
                    echo "0.00";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <strong>
                    <?php if ($rx > 0) {
                      echo $tkrRBadidas = $rx['RBadidas'] + $rx['RBadidas1'];
                    } else {
                      echo "0";
                    } ?>
                  </strong>
                </div>
              </td>
              <td>
                <div align="center">
                  <strong>
                    <?php if ($rx > 0) {
                      echo $tkrRLadidas = $rx['RLadidas'] + $rx['RLadidas1'];
                    } else {
                      echo "0";
                    } ?>
                  </strong>
                </div>
              </td>
              <td>
                <div align="right">
                  <strong>
                    <?php if ($rx > 0) {
                      echo $tkrqtyadidas = $rx['qtyRBadidas'] + $rx['qtyRBadidas1'] + $rx['qtyRLadidas'] + $rx['qtyRLadidas1'];
                    } else {
                      echo "0.00";
                    } ?>
                  </strong>
                </div>
              </td>
            </tr>
            <tr bgcolor="#33CCFF">
              <td>
                <div align="center"><strong>2</strong></div>
              </td>
              <td>
                <div align="right"><strong>0x</strong></div>
              </td>
              <td>
                <div align="center"><?php if ($r0x > 0) {
                  echo $r0x['RB'];
                } else {
                  echo "0";
                } ?></div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r0x > 0) {
                    echo $r0x['qtyRB'];
                  } else {
                    echo "0.00";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center"><?php if ($r0x > 0) {
                  echo $r0x['RL'];
                } else {
                  echo "0";
                } ?></div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r0x > 0) {
                    echo $r0x['qtyRL'];
                  } else {
                    echo "0.00";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center"><?php if ($r0x > 0) {
                  echo $r0x['RB1'];
                } else {
                  echo "0";
                } ?></div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r0x > 0) {
                    echo $r0x['qtyRB1'];
                  } else {
                    echo "0.00";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center"><?php if ($r0x > 0) {
                  echo $r0x['RL1'];
                } else {
                  echo "0";
                } ?></div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r0x > 0) {
                    echo $r0x['qtyRL1'];
                  } else {
                    echo "0.00";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <strong>
                    <?php if ($r0x > 0) {
                      echo $tkrRB = $r0x['RB'] + $r0x['RB1'];
                    } else {
                      echo "0";
                    } ?>
                  </strong>
                </div>
              </td>
              <td>
                <div align="center">
                  <strong>
                    <?php if ($r0x > 0) {
                      echo $tkrRL = $r0x['RL'] + $r0x['RL1'];
                    } else {
                      echo "0";
                    } ?>
                  </strong>
                </div>
              </td>
              <td>
                <div align="right">
                  <strong>
                    <?php if ($r0x > 0) {
                      echo $tkrqty = $r0x['qtyRB'] + $r0x['qtyRB1'] + $r0x['qtyRL'] + $r0x['qtyRL1'];
                    } else {
                      echo "0.00";
                    } ?>
                  </strong>
                </div>
              </td>
              <td>
                <div align="center"><?php if ($r0x > 0) {
                  echo $r0x['RBadidas'];
                } else {
                  echo "0";
                } ?></div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r0x > 0) {
                    echo $r0x['qtyRBadidas'];
                  } else {
                    echo "0.00";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center"><?php if ($r0x > 0) {
                  echo $r0x['RLadidas'];
                } else {
                  echo "0";
                } ?></div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r0x > 0) {
                    echo $r0x['qtyRLadidas'];
                  } else {
                    echo "0.00";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center"><?php if ($r0x > 0) {
                  echo $r0x['RBadidas1'];
                } else {
                  echo "0";
                } ?></div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r0x > 0) {
                    echo $r0x['qtyRBadidas1'];
                  } else {
                    echo "0.00";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center"><?php if ($r0x > 0) {
                  echo $r0x['RLadidas1'];
                } else {
                  echo "0";
                } ?></div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r0x > 0) {
                    echo $r0x['qtyRLadidas1'];
                  } else {
                    echo "0.00";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <strong>
                    <?php if ($r0x > 0) {
                      echo $tkrRBadidas = $r0x['RBadidas'] + $r0x['RBadidas1'];
                    } else {
                      echo "0";
                    } ?>
                  </strong>
                </div>
              </td>
              <td>
                <div align="center">
                  <strong>
                    <?php if ($r0x > 0) {
                      echo $tkrRLadidas = $r0x['RLadidas'] + $r0x['RLadidas1'];
                    } else {
                      echo "0";
                    } ?>
                  </strong>
                </div>
              </td>
              <td>
                <div align="right">
                  <strong>
                    <?php if ($r0x > 0) {
                      echo $tkrqtyadidas = $r0x['qtyRBadidas'] + $r0x['qtyRBadidas1'] + $r0x['qtyRLadidas'] + $r0x['qtyRLadidas1'];
                    } else {
                      echo "0.00";
                    } ?>
                  </strong>
                </div>
              </td>
            </tr>
            <tr bgcolor="#FFCC99">
              <td bgcolor="#FFCC99">
                <div align="center"><strong>3</strong></div>
              </td>
              <td>
                <div align="right"><strong>1x</strong></div>
              </td>
              <td>
                <div align="center"><?php if ($r1x > 0) {
                  echo $r1x['RB'];
                } else {
                  echo "0";
                } ?></div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r1x > 0) {
                    echo $r1x['qtyRB'];
                  } else {
                    echo "0.00";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center"><?php if ($r1x > 0) {
                  echo $r1x['RL'];
                } else {
                  echo "0";
                } ?></div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r1x > 0) {
                    echo $r1x['qtyRL'];
                  } else {
                    echo "0.00";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center"><?php if ($r1x > 0) {
                  echo $r1x['RB1'];
                } else {
                  echo "0";
                } ?></div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r1x > 0) {
                    echo $r1x['qtyRB1'];
                  } else {
                    echo "0.00";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center"><?php if ($r1x > 0) {
                  echo $r1x['RL1'];
                } else {
                  echo "0";
                } ?></div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r1x > 0) {
                    echo $r1x['qtyRL1'];
                  } else {
                    echo "0.00";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <strong>
                    <?php if ($r1x > 0) {
                      echo $tkrRB = $r1x['RB'] + $r1x['RB1'];
                    } else {
                      echo "0";
                    } ?>
                  </strong>
                </div>
              </td>
              <td>
                <div align="center">
                  <strong>
                    <?php if ($r1x > 0) {
                      echo $tkrRL = $r1x['RL'] + $r1x['RL1'];
                    } else {
                      echo "0";
                    } ?>
                  </strong>
                </div>
              </td>
              <td>
                <div align="right">
                  <strong>
                    <?php if ($r1x > 0) {
                      echo $tkrqty = $r1x['qtyRB'] + $r1x['qtyRB1'] + $r1x['qtyRL'] + $r1x['qtyRL1'];
                    } else {
                      echo "0.00";
                    } ?>
                  </strong>
                </div>
              </td>
              <td>
                <div align="center"><?php if ($r1x > 0) {
                  echo $r1x['RBadidas'];
                } else {
                  echo "0";
                } ?></div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r1x > 0) {
                    echo $r1x['qtyRBadidas'];
                  } else {
                    echo "0.00";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center"><?php if ($r1x > 0) {
                  echo $r1x['RLadidas'];
                } else {
                  echo "0";
                } ?></div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r1x > 0) {
                    echo $r1x['qtyRLadidas'];
                  } else {
                    echo "0.00";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center"><?php if ($r1x > 0) {
                  echo $r1x['RBadidas1'];
                } else {
                  echo "0";
                } ?></div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r1x > 0) {
                    echo $r1x['qtyRBadidas1'];
                  } else {
                    echo "0.00";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center"><?php if ($r1x > 0) {
                  echo $r1x['RLadidas1'];
                } else {
                  echo "0";
                } ?></div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r1x > 0) {
                    echo $r1x['qtyRLadidas1'];
                  } else {
                    echo "0.00";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <strong>
                    <?php if ($r1x > 0) {
                      echo $tkrRBadidas = $r1x['RBadidas'] + $r1x['RBadidas1'];
                    } else {
                      echo "0";
                    } ?>
                  </strong>
                </div>
              </td>
              <td>
                <div align="center">
                  <strong>
                    <?php if ($r1x > 0) {
                      echo $tkrRLadidas = $r1x['RLadidas'] + $r1x['RLadidas1'];
                    } else {
                      echo "0";
                    } ?>
                  </strong>
                </div>
              </td>
              <td>
                <div align="right">
                  <strong>
                    <?php if ($r1x > 0) {
                      echo $tkrqtyadidas = $r1x['qtyRBadidas'] + $r1x['qtyRBadidas1'] + $r1x['qtyRLadidas'] + $r1x['qtyRLadidas1'];
                    } else {
                      echo "0.00";
                    } ?>
                  </strong>
                </div>
              </td>
            </tr>
            <tr bgcolor="#33CCFF">
              <td>
                <div align="center"><strong>4</strong></div>
              </td>
              <td>
                <div align="right"><strong>2x</strong></div>
              </td>
              <td>
                <div align="center"><?php if ($r2x > 0) {
                  echo $r2x['RB'];
                } else {
                  echo "0";
                } ?></div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r2x > 0) {
                    echo $r2x['qtyRB'];
                  } else {
                    echo "0.00";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center"><?php if ($r2x > 0) {
                  echo $r2x['RL'];
                } else {
                  echo "0";
                } ?></div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r2x > 0) {
                    echo $r2x['qtyRL'];
                  } else {
                    echo "0.00";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center"><?php if ($r2x > 0) {
                  echo $r2x['RB1'];
                } else {
                  echo "0";
                } ?></div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r2x > 0) {
                    echo $r2x['qtyRB1'];
                  } else {
                    echo "0.00";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center"><?php if ($r2x > 0) {
                  echo $r2x['RL1'];
                } else {
                  echo "0";
                } ?></div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r2x > 0) {
                    echo $r2x['qtyRL1'];
                  } else {
                    echo "0.00";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <strong>
                    <?php if ($r2x > 0) {
                      echo $tkrRB = $r2x['RB'] + $r2x['RB1'];
                    } else {
                      echo "0";
                    } ?>
                  </strong>
                </div>
              </td>
              <td>
                <div align="center">
                  <strong>
                    <?php if ($r2x > 0) {
                      echo $tkrRL = $r2x['RL'] + $r2x['RL1'];
                    } else {
                      echo "0";
                    } ?>
                  </strong>
                </div>
              </td>
              <td>
                <div align="right">
                  <strong>
                    <?php if ($r2x > 0) {
                      echo $tkrqty = $r2x['qtyRB'] + $r2x['qtyRB1'] + $r2x['qtyRL'] + $r2x['qtyRL1'];
                    } else {
                      echo "0.00";
                    } ?>
                  </strong>
                </div>
              </td>
              <td>
                <div align="center"><?php if ($r2x > 0) {
                  echo $r2x['RBadidas'];
                } else {
                  echo "0";
                } ?></div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r2x > 0) {
                    echo $r2x['qtyRBadidas'];
                  } else {
                    echo "0.00";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center"><?php if ($r2x > 0) {
                  echo $r2x['RLadidas'];
                } else {
                  echo "0";
                } ?></div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r2x > 0) {
                    echo $r2x['qtyRLadidas'];
                  } else {
                    echo "0.00";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center"><?php if ($r2x > 0) {
                  echo $r2x['RBadidas1'];
                } else {
                  echo "0";
                } ?></div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r2x > 0) {
                    echo $r2x['qtyRBadidas1'];
                  } else {
                    echo "0.00";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center"><?php if ($r2x > 0) {
                  echo $r2x['RLadidas1'];
                } else {
                  echo "0";
                } ?></div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r2x > 0) {
                    echo $r2x['qtyRLadidas1'];
                  } else {
                    echo "0.00";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <strong>
                    <?php if ($r2x > 0) {
                      echo $tkrRBadidas = $r2x['RBadidas'] + $r2x['RBadidas1'];
                    } else {
                      echo "0";
                    } ?>
                  </strong>
                </div>
              </td>
              <td>
                <div align="center">
                  <strong>
                    <?php if ($r2x > 0) {
                      echo $tkrRLadidas = $r2x['RLadidas'] + $r2x['RLadidas1'];
                    } else {
                      echo "0";
                    } ?>
                  </strong>
                </div>
              </td>
              <td>
                <div align="right">
                  <strong>
                    <?php if ($r2x > 0) {
                      echo $tkrqtyadidas = $r2x['qtyRBadidas'] + $r2x['qtyRBadidas1'] + $r2x['qtyRLadidas'] + $r2x['qtyRLadidas1'];
                    } else {
                      echo "0.00";
                    } ?>
                  </strong>
                </div>
              </td>
            </tr>
            <tr bgcolor="#FFCC99">
              <td>
                <div align="center"><strong>5</strong></div>
              </td>
              <td>
                <div align="right"><strong>3x</strong></div>
              </td>
              <td>
                <div align="center"><?php if ($r3x > 0) {
                  echo $r3x['RB'];
                } else {
                  echo "0";
                } ?></div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r3x > 0) {
                    echo $r3x['qtyRB'];
                  } else {
                    echo "0.00";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center"><?php if ($r3x > 0) {
                  echo $r3x['RL'];
                } else {
                  echo "0";
                } ?></div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r3x > 0) {
                    echo $r3x['qtyRL'];
                  } else {
                    echo "0.00";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center"><?php if ($r3x > 0) {
                  echo $r3x['RB1'];
                } else {
                  echo "0";
                } ?></div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r3x > 0) {
                    echo $r3x['qtyRB1'];
                  } else {
                    echo "0.00";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center"><?php if ($r3x > 0) {
                  echo $r3x['RL1'];
                } else {
                  echo "0";
                } ?></div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r3x > 0) {
                    echo $r3x['qtyRL1'];
                  } else {
                    echo "0.00";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <strong>
                    <?php if ($r3x > 0) {
                      echo $tkrRB = $r3x['RB'] + $r3x['RB1'];
                    } else {
                      echo "0";
                    } ?>
                  </strong>
                </div>
              </td>
              <td>
                <div align="center">
                  <strong>
                    <?php if ($r3x > 0) {
                      echo $tkrRL = $r3x['RL'] + $r3x['RL1'];
                    } else {
                      echo "0";
                    } ?>
                  </strong>
                </div>
              </td>
              <td>
                <div align="right">
                  <strong>
                    <?php if ($r3x > 0) {
                      echo $tkrqty = $r3x['qtyRB'] + $r3x['qtyRB1'] + $r3x['qtyRL'] + $r3x['qtyRL1'];
                    } else {
                      echo "0.00";
                    } ?>
                  </strong>
                </div>
              </td>
              <td>
                <div align="center"><?php if ($r3x > 0) {
                  echo $r3x['RBadidas'];
                } else {
                  echo "0";
                } ?></div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r3x > 0) {
                    echo $r3x['qtyRBadidas'];
                  } else {
                    echo "0.00";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center"><?php if ($r3x > 0) {
                  echo $r3x['RLadidas'];
                } else {
                  echo "0";
                } ?></div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r3x > 0) {
                    echo $r3x['qtyRLadidas'];
                  } else {
                    echo "0.00";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center"><?php if ($r3x > 0) {
                  echo $r3x['RBadidas1'];
                } else {
                  echo "0";
                } ?></div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r3x > 0) {
                    echo $r3x['qtyRBadidas1'];
                  } else {
                    echo "0.00";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center"><?php if ($r3x > 0) {
                  echo $r3x['RLadidas1'];
                } else {
                  echo "0";
                } ?></div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r3x > 0) {
                    echo $r3x['qtyRLadidas1'];
                  } else {
                    echo "0.00";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <strong>
                    <?php if ($r3x > 0) {
                      echo $tkrRBadidas = $r3x['RBadidas'] + $r3x['RBadidas1'];
                    } else {
                      echo "0";
                    } ?>
                  </strong>
                </div>
              </td>
              <td>
                <div align="center">
                  <strong>
                    <?php if ($r3x > 0) {
                      echo $tkrRLadidas = $r3x['RLadidas'] + $r3x['RLadidas1'];
                    } else {
                      echo "0";
                    } ?>
                  </strong>
                </div>
              </td>
              <td>
                <div align="right">
                  <strong>
                    <?php if ($r3x > 0) {
                      echo $tkrqtyadidas = $r3x['qtyRBadidas'] + $r3x['qtyRBadidas1'] + $r3x['qtyRLadidas'] + $r3x['qtyRLadidas1'];
                    } else {
                      echo "0.00";
                    } ?>
                  </strong>
                </div>
              </td>
            </tr>
            <tr bgcolor="#33CCFF">
              <td>
                <div align="center"><strong>6</strong></div>
              </td>
              <td>
                <div align="right"><strong>4x</strong></div>
              </td>
              <td>
                <div align="center"><?php if ($r4x > 0) {
                  echo $r4x['RB'];
                } else {
                  echo "0";
                } ?></div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r4x > 0) {
                    echo $r4x['qtyRB'];
                  } else {
                    echo "0.00";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center"><?php if ($r4x > 0) {
                  echo $r4x['RL'];
                } else {
                  echo "0";
                } ?></div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r4x > 0) {
                    echo $r4x['qtyRL'];
                  } else {
                    echo "0.00";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center"><?php if ($r4x > 0) {
                  echo $r4x['RB1'];
                } else {
                  echo "0";
                } ?></div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r4x > 0) {
                    echo $r4x['qtyRB1'];
                  } else {
                    echo "0.00";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center"><?php if ($r4x > 0) {
                  echo $r4x['RL1'];
                } else {
                  echo "0";
                } ?></div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r4x > 0) {
                    echo $r4x['qtyRL1'];
                  } else {
                    echo "0.00";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <strong>
                    <?php if ($r4x > 0) {
                      echo $tkrRB = $r4x['RB'] + $r4x['RB1'];
                    } else {
                      echo "0";
                    } ?>
                  </strong>
                </div>
              </td>
              <td>
                <div align="center">
                  <strong>
                    <?php if ($r4x > 0) {
                      echo $tkrRL = $r4x['RL'] + $r4x['RL1'];
                    } else {
                      echo "0";
                    } ?>
                  </strong>
                </div>
              </td>
              <td>
                <div align="right">
                  <strong>
                    <?php if ($r4x > 0) {
                      echo $tkrqty = $r4x['qtyRB'] + $r4x['qtyRB1'] + $r4x['qtyRL'] + $r4x['qtyRL1'];
                    } else {
                      echo "0.00";
                    } ?>
                  </strong>
                </div>
              </td>
              <td>
                <div align="center"><?php if ($r4x > 0) {
                  echo $r4x['RBadidas'];
                } else {
                  echo "0";
                } ?></div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r4x > 0) {
                    echo $r4x['qtyRBadidas'];
                  } else {
                    echo "0.00";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center"><?php if ($r4x > 0) {
                  echo $r4x['RLadidas'];
                } else {
                  echo "0";
                } ?></div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r4x > 0) {
                    echo $r4x['qtyRLadidas'];
                  } else {
                    echo "0.00";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center"><?php if ($r4x > 0) {
                  echo $r4x['RBadidas1'];
                } else {
                  echo "0";
                } ?></div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r4x > 0) {
                    echo $r4x['qtyRBadidas1'];
                  } else {
                    echo "0.00";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center"><?php if ($r4x > 0) {
                  echo $r4x['RLadidas1'];
                } else {
                  echo "0";
                } ?></div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r4x > 0) {
                    echo $r4x['qtyRLadidas1'];
                  } else {
                    echo "0.00";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <strong>
                    <?php if ($r4x > 0) {
                      echo $tkrRBadidas = $r4x['RBadidas'] + $r4x['RBadidas1'];
                    } else {
                      echo "0";
                    } ?>
                  </strong>
                </div>
              </td>
              <td>
                <div align="center">
                  <strong>
                    <?php if ($r4x > 0) {
                      echo $tkrRLadidas = $r4x['RLadidas'] + $r4x['RLadidas1'];
                    } else {
                      echo "0";
                    } ?>
                  </strong>
                </div>
              </td>
              <td>
                <div align="right">
                  <strong>
                    <?php if ($r4x > 0) {
                      echo $tkrqtyadidas = $r4x['qtyRBadidas'] + $r4x['qtyRBadidas1'] + $r4x['qtyRLadidas'] + $r4x['qtyRLadidas1'];
                    } else {
                      echo "0.00";
                    } ?>
                  </strong>
                </div>
              </td>
            </tr>
            <tr bgcolor="#FFCC99">
              <td>
                <div align="center"><strong>7</strong></div>
              </td>
              <td>
                <div align="right"><strong>5x</strong></div>
              </td>
              <td>
                <div align="center"><?php if ($r5x > 0) {
                  echo $r5x['RB'];
                } else {
                  echo "0";
                } ?></div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r5x > 0) {
                    echo $r5x['qtyRB'];
                  } else {
                    echo "0.00";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center"><?php if ($r5x > 0) {
                  echo $r5x['RL'];
                } else {
                  echo "0";
                } ?></div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r5x > 0) {
                    echo $r5x['qtyRL'];
                  } else {
                    echo "0.00";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center"><?php if ($r5x > 0) {
                  echo $r5x['RB1'];
                } else {
                  echo "0";
                } ?></div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r5x > 0) {
                    echo $r5x['qtyRB1'];
                  } else {
                    echo "0.00";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center"><?php if ($r5x > 0) {
                  echo $r5x['RL1'];
                } else {
                  echo "0";
                } ?></div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r5x > 0) {
                    echo $r5x['qtyRL1'];
                  } else {
                    echo "0.00";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <strong>
                    <?php if ($r5x > 0) {
                      echo $tkrRB = $r5x['RB'] + $r5x['RB1'];
                    } else {
                      echo "0";
                    } ?>
                  </strong>
                </div>
              </td>
              <td>
                <div align="center">
                  <strong>
                    <?php if ($r5x > 0) {
                      echo $tkrRL = $r5x['RL'] + $r5x['RL1'];
                    } else {
                      echo "0";
                    } ?>
                  </strong>
                </div>
              </td>
              <td>
                <div align="right">
                  <strong>
                    <?php if ($r5x > 0) {
                      echo $tkrqty = $r5x['qtyRB'] + $r5x['qtyRB1'] + $r5x['qtyRL'] + $r5x['qtyRL1'];
                    } else {
                      echo "0.00";
                    } ?>
                  </strong>
                </div>
              </td>
              <td>
                <div align="center"><?php if ($r5x > 0) {
                  echo $r5x['RBadidas'];
                } else {
                  echo "0";
                } ?></div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r5x > 0) {
                    echo $r5x['qtyRBadidas'];
                  } else {
                    echo "0.00";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center"><?php if ($r5x > 0) {
                  echo $r5x['RLadidas'];
                } else {
                  echo "0";
                } ?></div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r5x > 0) {
                    echo $r5x['qtyRLadidas'];
                  } else {
                    echo "0.00";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center"><?php if ($r5x > 0) {
                  echo $r5x['RBadidas1'];
                } else {
                  echo "0";
                } ?></div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r5x > 0) {
                    echo $r5x['qtyRBadidas1'];
                  } else {
                    echo "0.00";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center"><?php if ($r5x > 0) {
                  echo $r5x['RLadidas1'];
                } else {
                  echo "0";
                } ?></div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r5x > 0) {
                    echo $r5x['qtyRLadidas1'];
                  } else {
                    echo "0.00";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <strong>
                    <?php if ($r5x > 0) {
                      echo $tkrRBadidas = $r5x['RBadidas'] + $r5x['RBadidas1'];
                    } else {
                      echo "0";
                    } ?>
                  </strong>
                </div>
              </td>
              <td>
                <div align="center">
                  <strong>
                    <?php if ($r5x > 0) {
                      echo $tkrRLadidas = $r5x['RLadidas'] + $r5x['RLadidas1'];
                    } else {
                      echo "0";
                    } ?>
                  </strong>
                </div>
              </td>
              <td>
                <div align="right">
                  <strong>
                    <?php if ($r5x > 0) {
                      echo $tkrqtyadidas = $r5x['qtyRBadidas'] + $r5x['qtyRBadidas1'] + $r5x['qtyRLadidas'] + $r5x['qtyRLadidas1'];
                    } else {
                      echo "0.00";
                    } ?>
                  </strong>
                </div>
              </td>
            </tr>
            <tr bgcolor="#33CCFF">
              <td>
                <div align="center"><strong>8</strong></div>
              </td>
              <td>
                <div align="right"><strong>&gt;5x</strong></div>
              </td>
              <td>
                <div align="center">
                  <?php if ($r6x > 0) {
                    echo $r6x['RB'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r6x > 0) {
                    echo $r6x['qtyRB'];
                  } else {
                    echo "0.00";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <?php if ($r6x > 0) {
                    echo $r6x['RL'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r6x > 0) {
                    echo $r6x['qtyRL'];
                  } else {
                    echo "0.00";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <?php if ($r6x > 0) {
                    echo $r6x['RB1'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r6x > 0) {
                    echo $r6x['qtyRB1'];
                  } else {
                    echo "0.00";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <?php if ($r6x > 0) {
                    echo $r6x['RL1'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r6x > 0) {
                    echo $r6x['qtyRL1'];
                  } else {
                    echo "0.00";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <strong>
                    <?php if ($r6x > 0) {
                      echo $tkrRB = $r6x['RB'] + $r6x['RB1'];
                    } else {
                      echo "0";
                    } ?>
                  </strong>
                </div>
              </td>
              <td>
                <div align="center">
                  <strong>
                    <?php if ($r6x > 0) {
                      echo $tkrRL = $r6x['RL'] + $r6x['RL1'];
                    } else {
                      echo "0";
                    } ?>
                  </strong>
                </div>
              </td>
              <td>
                <div align="right">
                  <strong>
                    <?php if ($r6x > 0) {
                      echo $tkrqty = $r6x['qtyRB'] + $r6x['qtyRB1'] + $r6x['qtyRL'] + $r6x['qtyRL1'];
                    } else {
                      echo "0.00";
                    } ?>
                  </strong>
                </div>
              </td>
              <td>
                <div align="center">
                  <?php if ($r6x > 0) {
                    echo $r6x['RBadidas'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r6x > 0) {
                    echo $r6x['qtyRBadidas'];
                  } else {
                    echo "0.00";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <?php if ($r6x > 0) {
                    echo $r6x['RLadidas'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r6x > 0) {
                    echo $r6x['qtyRLadidas'];
                  } else {
                    echo "0.00";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <?php if ($r6x > 0) {
                    echo $r6x['RBadidas1'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r6x > 0) {
                    echo $r6x['qtyRBadidas1'];
                  } else {
                    echo "0.00";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <?php if ($r6x > 0) {
                    echo $r6x['RLadidas1'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r6x > 0) {
                    echo $r6x['qtyRLadidas1'];
                  } else {
                    echo "0.00";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <strong>
                    <?php if ($r6x > 0) {
                      echo $tkrRBadidas = $r6x['RBadidas'] + $r6x['RBadidas1'];
                    } else {
                      echo "0";
                    } ?>
                  </strong>
                </div>
              </td>
              <td>
                <div align="center">
                  <strong>
                    <?php if ($r6x > 0) {
                      echo $tkrRLadidas = $r6x['RLadidas'] + $r6x['RLadidas1'];
                    } else {
                      echo "0";
                    } ?>
                  </strong>
                </div>
              </td>
              <td>
                <div align="right">
                  <strong>
                    <?php if ($r6x > 0) {
                      echo $tkrqtyadidas = $r6x['qtyRBadidas'] + $r6x['qtyRBadidas1'] + $r6x['qtyRLadidas'] + $r6x['qtyRLadidas1'];
                    } else {
                      echo "0.00";
                    } ?>
                  </strong>
                </div>
              </td>
            </tr>
            <tr bgcolor="#99FF99">
              <td>&nbsp;</td>
              <td><strong>Subtotal</strong></td>
              <td>
                <div align="center">
                  <strong><?php echo $trb = $rx['RB'] + $r0x['RB'] + $r1x['RB'] + $r2x['RB'] + $r3x['RB'] + $r4x['RB'] + $r5x['RB'] + $r6x['RB']; ?></strong>
                </div>
              </td>
              <td>
                <div align="right">
                  <strong><?php echo $tqrb = $rx['qtyRB'] + $r0x['qtyRB'] + $r1x['qtyRB'] + $r2x['qtyRB'] + $r3x['qtyRB'] + $r4x['qtyRB'] + $r5x['qtyRB'] + $r6x['qtyRB']; ?>
                  </strong>
                </div>
              </td>
              <td>
                <div align="center">
                  <strong><?php echo $trl = $rx['RL'] + $r0x['RL'] + $r1x['RL'] + $r2x['RL'] + $r3x['RL'] + $r4x['RL'] + $r5x['RL'] + $r6x['RL']; ?></strong>
                </div>
              </td>
              <td>
                <div align="right">
                  <strong><?php echo $tqrl = $rx['qtyRL'] + $r0x['qtyRL'] + $r1x['qtyRL'] + $r2x['qtyRL'] + $r3x['qtyRL'] + $r4x['qtyRL'] + $r5x['qtyRL'] + $r6x['qtyRL']; ?>
                  </strong></div>
              </td>
              <td>
                <div align="center">
                  <strong><?php echo $trb1 = $rx['RB1'] + $r0x['RB1'] + $r1x['RB1'] + $r2x['RB1'] + $r3x['RB1'] + $r4x['RB1'] + $r5x['RB1'] + $r6x['RB1']; ?></strong>
                </div>
              </td>
              <td>
                <div align="right">
                  <strong><?php echo $tqrb1 = $rx['qtyRB1'] + $r0x['qtyRB1'] + $r1x['qtyRB1'] + $r2x['qtyRB1'] + $r3x['qtyRB1'] + $r4x['qtyRB1'] + $r5x['qtyRB1'] + $r6x['qtyRB1']; ?>
                  </strong></div>
              </td>
              <td>
                <div align="center">
                  <strong><?php echo $trl1 = $rx['RL1'] + $r0x['RL1'] + $r1x['RL1'] + $r2x['RL1'] + $r3x['RL1'] + $r4x['RL1'] + $r5x['RL1'] + $r6x['RL1']; ?></strong>
                </div>
              </td>
              <td>
                <div align="right">
                  <strong><?php echo $tqrl1 = $rx['qtyRL1'] + $r0x['qtyRL1'] + $r1x['qtyRL1'] + $r2x['qtyRL1'] + $r3x['qtyRL1'] + $r4x['qtyRL1'] + $r5x['qtyRL1'] + $r6x['qtyRL1']; ?></strong>
                </div>
              </td>
              <td>
                <div align="center"><strong><?php echo $torb1 = $trb + $trb1; ?></strong></div>
              </td>
              <td>
                <div align="center"><strong><?php echo $torl1 = $trl + $trl1; ?></strong></div>
              </td>
              <td>
                <div align="right"> <strong><?php echo $toq = $tqrb + $tqrl + $tqrb1 + $tqrl1; ?></strong></div>
              </td>
              <td>
                <div align="center">
                  <strong><?php echo $trbadidas = $rx['RBadidas'] + $r0x['RBadidas'] + $r1x['RBadidas'] + $r2x['RBadidas'] + $r3x['RBadidas'] + $r4x['RBadidas'] + $r5x['RBadidas'] + $r6x['RBadidas']; ?></strong>
                </div>
              </td>
              <td>
                <div align="right">
                  <strong><?php echo $tqrbadidas = $rx['qtyRBadidas'] + $r0x['qtyRBadidas'] + $r1x['qtyRBadidas'] + $r2x['qtyRBadidas'] + $r3x['qtyRBadidas'] + $r4x['qtyRBadidas'] + $r5x['qtyRBadidas'] + $r6x['qtyRBadidas']; ?>
                  </strong></div>
              </td>
              <td>
                <div align="center">
                  <strong><?php echo $trladidas = $rx['RLadidas'] + $r0x['RLadidas'] + $r1x['RLadidas'] + $r2x['RLadidas'] + $r3x['RLadidas'] + $r4x['RLadidas'] + $r5x['RLadidas'] + $r6x['RLadidas']; ?></strong>
                </div>
              </td>
              <td>
                <div align="right">
                  <strong><?php echo $tqrladidas = $rx['qtyRLadidas'] + $r0x['qtyRLadidas'] + $r1x['qtyRLadidas'] + $r2x['qtyRLadidas'] + $r3x['qtyRLadidas'] + $r4x['qtyRLadidas'] + $r5x['qtyRLadidas'] + $r6x['qtyRLadidas']; ?></strong>
                </div>
              </td>
              <td>
                <div align="center">
                  <strong><?php echo $trbadidas1 = $rx['RBadidas1'] + $r0x['RBadidas1'] + $r1x['RBadidas1'] + $r2x['RBadidas1'] + $r3x['RBadidas1'] + $r4x['RBadidas1'] + $r5x['RBadidas1'] + $r6x['RBadidas1']; ?></strong>
                </div>
              </td>
              <td>
                <div align="right">
                  <strong><?php echo $tqrbadidas1 = $rx['qtyRBadidas1'] + $r0x['qtyRBadidas1'] + $r1x['qtyRBadidas1'] + $r2x['qtyRBadidas1'] + $r3x['qtyRBadidas1'] + $r4x['qtyRBadidas1'] + $r5x['qtyRBadidas1'] + $r6x['qtyRBadidas1']; ?></strong>
                </div>
              </td>
              <td>
                <div align="center">
                  <strong><?php echo $trladidas1 = $rx['RLadidas1'] + $r0x['RLadidas1'] + $r1x['RLadidas1'] + $r2x['RLadidas1'] + $r3x['RLadidas1'] + $r4x['RLadidas1'] + $r5x['RLadidas1'] + $r6x['RLadidas1']; ?></strong>
                </div>
              </td>
              <td>
                <div align="right">
                  <strong><?php echo $tqrladidas1 = $rx['qtyRLadidas1'] + $r0x['qtyRLadidas1'] + $r1x['qtyRLadidas1'] + $r2x['qtyRLadidas1'] + $r3x['qtyRLadidas1'] + $r4x['qtyRLadidas1'] + $r5x['qtyRLadidas1'] + $r6x['qtyRLadidas1']; ?></strong>
                </div>
              </td>
              <td>
                <div align="center"><strong><?php echo $torbadidas1 = $trbadidas + $trbadidas1; ?></strong></div>
              </td>
              <td>
                <div align="center"><strong><?php echo $torladidas1 = $trladidas + $trladidas1; ?></strong></div>
              </td>
              <td>
                <div align="right">
                  <strong><?php echo $toqadidas = $tqrbadidas + $tqrladidas + $tqrbadidas1 + $tqrladidas1; ?></strong>
                </div>
              </td>
            </tr>
          </table>
          <table width="100%" border="0" class="table-list1">
            <tr>
              <td rowspan="3" valign="middle" bgcolor="#99FF99">
                <div align="center"><strong>No.</strong></div>
              </td>
              <td rowspan="3" valign="middle" bgcolor="#99FF99">
                <div align="center"><strong>L:R / Capacity</strong></div>
              </td>
              <td colspan="6" bgcolor="#99FF99">
                <div align="center"><strong>ALL BUYER</strong></div>
              </td>
              <td colspan="6" bgcolor="#99FF99">
                <div align="center"><strong>BUYER ADIDAS</strong></div>
              </td>
            </tr>
            <tr>
              <td colspan="6" bgcolor="#99FF99">
                <div align="center"><strong>AVERAGE PER CAPACITY</strong></div>
              </td>
              <td colspan="6" bgcolor="#99FF99">
                <div align="center"><strong>AVERAGE PER CAPACITY</strong></div>
              </td>
            </tr>
            <tr>
              <td bgcolor="#99FF99">
                <div align="center"><strong>R.B</strong></div>
              </td>
              <td bgcolor="#99FF99">
                <div align="center"><strong>R.L</strong></div>
              </td>
              <td bgcolor="#99FF99">
                <div align="center"><strong>Pemakaian Air</strong></div>
              </td>
              <td bgcolor="#99FF99">
                <div align="center"><strong>Quantity</strong></div>
              </td>
              <td bgcolor="#99FF99">
                <div align="center"><strong>% Loading</strong></div>
              </td>
              <td bgcolor="#99FF99">
                <div align="center"><strong>L:R</strong></div>
              </td>
              <td bgcolor="#99FF99">
                <div align="center"><strong>R.B</strong></div>
              </td>
              <td bgcolor="#99FF99">
                <div align="center"><strong>R.L</strong></div>
              </td>
              <td bgcolor="#99FF99">
                <div align="center"><strong>Pemakaian Air</strong></div>
              </td>
              <td bgcolor="#99FF99">
                <div align="center"><strong>Quantity</strong></div>
              </td>
              <td bgcolor="#99FF99">
                <div align="center"><strong>% Loading</strong></div>
              </td>
              <td bgcolor="#99FF99">
                <div align="center"><strong>L:R</strong></div>
              </td>
            </tr>
            <?php
            $sql0 = sqlsrv_query($con, "SELECT
                                          ROUND(AVG(c.pakai_air), 0) AS air,
                                          ROUND(AVG(b.bruto), 2) AS qty,
                                          ROUND(AVG((b.bruto / b.kapasitas) * 100), 2) AS loading,
                                          ROUND(AVG(c.pakai_air / NULLIF(b.bruto, 0)), 2) AS l_r,
                                          ROUND(AVG(CASE WHEN a.resep = 'Baru' THEN 1 ELSE 0 END), 0) AS RB,
                                          ROUND(AVG(CASE WHEN a.resep = 'Lama' THEN 1 ELSE 0 END), 0) AS RL,
                                          ROUND(AVG(CASE WHEN buyer = 'ADIDAS' THEN b.bruto ELSE 0 END), 2) AS qtyadidas,
                                          ROUND(AVG(CASE WHEN buyer = 'ADIDAS' THEN c.pakai_air ELSE 0 END), 2) AS airadidas,
                                          ROUND(AVG(CASE WHEN a.resep = 'Baru' AND buyer = 'ADIDAS' THEN 1 ELSE 0 END), 0) AS RBadidas,
                                          ROUND(AVG(CASE WHEN a.resep = 'Lama' AND buyer = 'ADIDAS' THEN 1 ELSE 0 END), 0) AS RLadidas,
                                          ROUND(AVG(CASE WHEN buyer = 'ADIDAS' THEN (b.bruto / b.kapasitas) * 100 ELSE 0 END), 2) AS loadingadidas,
                                          ROUND(AVG(CASE WHEN buyer = 'ADIDAS' THEN c.pakai_air / NULLIF(b.bruto, 0) ELSE 0 END), 2) AS l_rairadidas,
                                          ISNULL(a.g_shift, b.g_shift) AS shft
                                      FROM
                                          db_dying.tbl_schedule b
                                          LEFT JOIN db_dying.tbl_montemp c ON c.id_schedule = b.id
                                          LEFT JOIN db_dying.tbl_hasilcelup a ON a.id_montemp = c.id
                                      WHERE
                                          $shft
                                           CONVERT(datetime, a.tgl_buat, 120) BETWEEN '$Awal' AND '$Akhir'
                                          AND b.kapasitas > 0 AND b.kapasitas <= 50 AND b.bruto > 0 GROUP BY
                                          ISNULL(a.g_shift, b.g_shift)");
            $r0 = sqlsrv_fetch_array($sql0);
            $sql50 = sqlsrv_query($con, "SELECT
                                          ROUND(AVG(c.pakai_air), 0) AS air,
                                          ROUND(AVG(b.bruto), 2) AS qty,
                                          ROUND(AVG((b.bruto / b.kapasitas) * 100), 2) AS loading,
                                          ROUND(AVG(c.pakai_air / NULLIF(b.bruto, 0)), 2) AS l_r,
                                          ROUND(AVG(CASE WHEN a.resep = 'Baru' THEN 1 ELSE 0 END), 0) AS RB,
                                          ROUND(AVG(CASE WHEN a.resep = 'Lama' THEN 1 ELSE 0 END), 0) AS RL,
                                          ROUND(AVG(CASE WHEN buyer = 'ADIDAS' THEN b.bruto ELSE 0 END), 2) AS qtyadidas,
                                          ROUND(AVG(CASE WHEN buyer = 'ADIDAS' THEN c.pakai_air ELSE 0 END), 2) AS airadidas,
                                          ROUND(AVG(CASE WHEN a.resep = 'Baru' AND buyer = 'ADIDAS' THEN 1 ELSE 0 END), 0) AS RBadidas,
                                          ROUND(AVG(CASE WHEN a.resep = 'Lama' AND buyer = 'ADIDAS' THEN 1 ELSE 0 END), 0) AS RLadidas,
                                          ROUND(AVG(CASE WHEN buyer = 'ADIDAS' THEN (b.bruto / b.kapasitas) * 100 ELSE 0 END), 2) AS loadingadidas,
                                          ROUND(AVG(CASE WHEN buyer = 'ADIDAS' THEN c.pakai_air / NULLIF(b.bruto, 0) ELSE 0 END), 2) AS l_rairadidas,
                                          ISNULL(a.g_shift, b.g_shift) AS shft
                                      FROM
                                          db_dying.tbl_schedule b
                                          LEFT JOIN db_dying.tbl_montemp c ON c.id_schedule = b.id
                                          LEFT JOIN db_dying.tbl_hasilcelup a ON a.id_montemp = c.id
                                    WHERE
                                      $shft 
                                       CONVERT(datetime, a.tgl_buat, 120) BETWEEN '$Awal' AND '$Akhir'
                                      AND b.kapasitas > 50 and b.kapasitas <= 100 AND b.bruto > 0 GROUP BY
                                      ISNULL(a.g_shift, b.g_shift)");
            $r50 = sqlsrv_fetch_array($sql50);
            $sql100 = sqlsrv_query($con, "SELECT
                                          ROUND(AVG(c.pakai_air), 0) AS air,
                                          ROUND(AVG(b.bruto), 2) AS qty,
                                          ROUND(AVG((b.bruto / b.kapasitas) * 100), 2) AS loading,
                                          ROUND(AVG(c.pakai_air / NULLIF(b.bruto, 0)), 2) AS l_r,
                                          ROUND(AVG(CASE WHEN a.resep = 'Baru' THEN 1 ELSE 0 END), 0) AS RB,
                                          ROUND(AVG(CASE WHEN a.resep = 'Lama' THEN 1 ELSE 0 END), 0) AS RL,
                                          ROUND(AVG(CASE WHEN buyer = 'ADIDAS' THEN b.bruto ELSE 0 END), 2) AS qtyadidas,
                                          ROUND(AVG(CASE WHEN buyer = 'ADIDAS' THEN c.pakai_air ELSE 0 END), 2) AS airadidas,
                                          ROUND(AVG(CASE WHEN a.resep = 'Baru' AND buyer = 'ADIDAS' THEN 1 ELSE 0 END), 0) AS RBadidas,
                                          ROUND(AVG(CASE WHEN a.resep = 'Lama' AND buyer = 'ADIDAS' THEN 1 ELSE 0 END), 0) AS RLadidas,
                                          ROUND(AVG(CASE WHEN buyer = 'ADIDAS' THEN (b.bruto / b.kapasitas) * 100 ELSE 0 END), 2) AS loadingadidas,
                                          ROUND(AVG(CASE WHEN buyer = 'ADIDAS' THEN c.pakai_air / NULLIF(b.bruto, 0) ELSE 0 END), 2) AS l_rairadidas,
                                          ISNULL(a.g_shift, b.g_shift) AS shft
                                      FROM
                                          db_dying.tbl_schedule b
                                          LEFT JOIN db_dying.tbl_montemp c ON c.id_schedule = b.id
                                          LEFT JOIN db_dying.tbl_hasilcelup a ON a.id_montemp = c.id
                                    WHERE
                                      $shft 
                                       CONVERT(datetime, a.tgl_buat, 120) BETWEEN '$Awal' AND '$Akhir'
                                      AND b.kapasitas > '100' and b.kapasitas <= '200' AND b.bruto > 0 GROUP BY
                                      ISNULL(a.g_shift, b.g_shift)");
            $r100 = sqlsrv_fetch_array($sql100);
            $sql200 = sqlsrv_query($con, "SELECT
                                          ROUND(AVG(c.pakai_air), 0) AS air,
                                          ROUND(AVG(b.bruto), 2) AS qty,
                                          ROUND(AVG((b.bruto / b.kapasitas) * 100), 2) AS loading,
                                          ROUND(AVG(c.pakai_air / NULLIF(b.bruto, 0)), 2) AS l_r,
                                          ROUND(AVG(CASE WHEN a.resep = 'Baru' THEN 1 ELSE 0 END), 0) AS RB,
                                          ROUND(AVG(CASE WHEN a.resep = 'Lama' THEN 1 ELSE 0 END), 0) AS RL,
                                          ROUND(AVG(CASE WHEN buyer = 'ADIDAS' THEN b.bruto ELSE 0 END), 2) AS qtyadidas,
                                          ROUND(AVG(CASE WHEN buyer = 'ADIDAS' THEN c.pakai_air ELSE 0 END), 2) AS airadidas,
                                          ROUND(AVG(CASE WHEN a.resep = 'Baru' AND buyer = 'ADIDAS' THEN 1 ELSE 0 END), 0) AS RBadidas,
                                          ROUND(AVG(CASE WHEN a.resep = 'Lama' AND buyer = 'ADIDAS' THEN 1 ELSE 0 END), 0) AS RLadidas,
                                          ROUND(AVG(CASE WHEN buyer = 'ADIDAS' THEN (b.bruto / b.kapasitas) * 100 ELSE 0 END), 2) AS loadingadidas,
                                          ROUND(AVG(CASE WHEN buyer = 'ADIDAS' THEN c.pakai_air / NULLIF(b.bruto, 0) ELSE 0 END), 2) AS l_rairadidas,
                                          ISNULL(a.g_shift, b.g_shift) AS shft
                                      FROM
                                          db_dying.tbl_schedule b
                                          LEFT JOIN db_dying.tbl_montemp c ON c.id_schedule = b.id
                                          LEFT JOIN db_dying.tbl_hasilcelup a ON a.id_montemp = c.id
                                    WHERE
                                      $shft 
                                       CONVERT(datetime, a.tgl_buat, 120) BETWEEN '$Awal' AND '$Akhir'
                                      AND b.kapasitas > '200' and b.kapasitas <= '400' AND b.bruto > 0 GROUP BY
                                      ISNULL(a.g_shift, b.g_shift)");
            $r200 = sqlsrv_fetch_array($sql200);
            $sql400 = sqlsrv_query($con, "SELECT
                                          ROUND(AVG(c.pakai_air), 0) AS air,
                                          ROUND(AVG(b.bruto), 2) AS qty,
                                          ROUND(AVG((b.bruto / b.kapasitas) * 100), 2) AS loading,
                                          ROUND(AVG(c.pakai_air / NULLIF(b.bruto, 0)), 2) AS l_r,
                                          ROUND(AVG(CASE WHEN a.resep = 'Baru' THEN 1 ELSE 0 END), 0) AS RB,
                                          ROUND(AVG(CASE WHEN a.resep = 'Lama' THEN 1 ELSE 0 END), 0) AS RL,
                                          ROUND(AVG(CASE WHEN buyer = 'ADIDAS' THEN b.bruto ELSE 0 END), 2) AS qtyadidas,
                                          ROUND(AVG(CASE WHEN buyer = 'ADIDAS' THEN c.pakai_air ELSE 0 END), 2) AS airadidas,
                                          ROUND(AVG(CASE WHEN a.resep = 'Baru' AND buyer = 'ADIDAS' THEN 1 ELSE 0 END), 0) AS RBadidas,
                                          ROUND(AVG(CASE WHEN a.resep = 'Lama' AND buyer = 'ADIDAS' THEN 1 ELSE 0 END), 0) AS RLadidas,
                                          ROUND(AVG(CASE WHEN buyer = 'ADIDAS' THEN (b.bruto / b.kapasitas) * 100 ELSE 0 END), 2) AS loadingadidas,
                                          ROUND(AVG(CASE WHEN buyer = 'ADIDAS' THEN c.pakai_air / NULLIF(b.bruto, 0) ELSE 0 END), 2) AS l_rairadidas,
                                          ISNULL(a.g_shift, b.g_shift) AS shft
                                      FROM
                                          db_dying.tbl_schedule b
                                          LEFT JOIN db_dying.tbl_montemp c ON c.id_schedule = b.id
                                          LEFT JOIN db_dying.tbl_hasilcelup a ON a.id_montemp = c.id
                                    WHERE
                                      $shft 
                                       CONVERT(datetime, a.tgl_buat, 120) BETWEEN '$Awal' AND '$Akhir'
                                      AND b.kapasitas > '400' and b.kapasitas <= '600' AND b.bruto > 0 GROUP BY
                                      ISNULL(a.g_shift, b.g_shift)");
            $r400 = sqlsrv_fetch_array($sql400);
            $sql600 = sqlsrv_query($con, "SELECT
                                          ROUND(AVG(c.pakai_air), 0) AS air,
                                          ROUND(AVG(b.bruto), 2) AS qty,
                                          ROUND(AVG((b.bruto / b.kapasitas) * 100), 2) AS loading,
                                          ROUND(AVG(c.pakai_air / NULLIF(b.bruto, 0)), 2) AS l_r,
                                          ROUND(AVG(CASE WHEN a.resep = 'Baru' THEN 1 ELSE 0 END), 0) AS RB,
                                          ROUND(AVG(CASE WHEN a.resep = 'Lama' THEN 1 ELSE 0 END), 0) AS RL,
                                          ROUND(AVG(CASE WHEN buyer = 'ADIDAS' THEN b.bruto ELSE 0 END), 2) AS qtyadidas,
                                          ROUND(AVG(CASE WHEN buyer = 'ADIDAS' THEN c.pakai_air ELSE 0 END), 2) AS airadidas,
                                          ROUND(AVG(CASE WHEN a.resep = 'Baru' AND buyer = 'ADIDAS' THEN 1 ELSE 0 END), 0) AS RBadidas,
                                          ROUND(AVG(CASE WHEN a.resep = 'Lama' AND buyer = 'ADIDAS' THEN 1 ELSE 0 END), 0) AS RLadidas,
                                          ROUND(AVG(CASE WHEN buyer = 'ADIDAS' THEN (b.bruto / b.kapasitas) * 100 ELSE 0 END), 2) AS loadingadidas,
                                          ROUND(AVG(CASE WHEN buyer = 'ADIDAS' THEN c.pakai_air / NULLIF(b.bruto, 0) ELSE 0 END), 2) AS l_rairadidas,
                                          ISNULL(a.g_shift, b.g_shift) AS shft
                                      FROM
                                          db_dying.tbl_schedule b
                                          LEFT JOIN db_dying.tbl_montemp c ON c.id_schedule = b.id
                                          LEFT JOIN db_dying.tbl_hasilcelup a ON a.id_montemp = c.id
                                    WHERE
                                      $shft 
                                       CONVERT(datetime, a.tgl_buat, 120) BETWEEN '$Awal' AND '$Akhir'
                                    AND b.kapasitas > '600' and b.kapasitas <= '800' AND b.bruto > 0 GROUP BY
                                    ISNULL(a.g_shift, b.g_shift)");
            $r600 = sqlsrv_fetch_array($sql600);
            $sql800 = sqlsrv_query($con, "SELECT
                                          ROUND(AVG(c.pakai_air), 0) AS air,
                                          ROUND(AVG(b.bruto), 2) AS qty,
                                          ROUND(AVG((b.bruto / b.kapasitas) * 100), 2) AS loading,
                                          ROUND(AVG(c.pakai_air / NULLIF(b.bruto, 0)), 2) AS l_r,
                                          ROUND(AVG(CASE WHEN a.resep = 'Baru' THEN 1 ELSE 0 END), 0) AS RB,
                                          ROUND(AVG(CASE WHEN a.resep = 'Lama' THEN 1 ELSE 0 END), 0) AS RL,
                                          ROUND(AVG(CASE WHEN buyer = 'ADIDAS' THEN b.bruto ELSE 0 END), 2) AS qtyadidas,
                                          ROUND(AVG(CASE WHEN buyer = 'ADIDAS' THEN c.pakai_air ELSE 0 END), 2) AS airadidas,
                                          ROUND(AVG(CASE WHEN a.resep = 'Baru' AND buyer = 'ADIDAS' THEN 1 ELSE 0 END), 0) AS RBadidas,
                                          ROUND(AVG(CASE WHEN a.resep = 'Lama' AND buyer = 'ADIDAS' THEN 1 ELSE 0 END), 0) AS RLadidas,
                                          ROUND(AVG(CASE WHEN buyer = 'ADIDAS' THEN (b.bruto / b.kapasitas) * 100 ELSE 0 END), 2) AS loadingadidas,
                                          ROUND(AVG(CASE WHEN buyer = 'ADIDAS' THEN c.pakai_air / NULLIF(b.bruto, 0) ELSE 0 END), 2) AS l_rairadidas,
                                          ISNULL(a.g_shift, b.g_shift) AS shft
                                      FROM
                                          db_dying.tbl_schedule b
                                          LEFT JOIN db_dying.tbl_montemp c ON c.id_schedule = b.id
                                          LEFT JOIN db_dying.tbl_hasilcelup a ON a.id_montemp = c.id
                                    WHERE
                                      $shft 
                                       CONVERT(datetime, a.tgl_buat, 120) BETWEEN '$Awal' AND '$Akhir'
                                  AND b.kapasitas > '800' and b.kapasitas <= '1000' AND b.bruto > 0 GROUP BY
                                  ISNULL(a.g_shift, b.g_shift)");
            $r800 = sqlsrv_fetch_array($sql800);
            $sql1000 = sqlsrv_query($con, "SELECT
                                          ROUND(AVG(c.pakai_air), 0) AS air,
                                          ROUND(AVG(b.bruto), 2) AS qty,
                                          ROUND(AVG((b.bruto / b.kapasitas) * 100), 2) AS loading,
                                          ROUND(AVG(c.pakai_air / NULLIF(b.bruto, 0)), 2) AS l_r,
                                          ROUND(AVG(CASE WHEN a.resep = 'Baru' THEN 1 ELSE 0 END), 0) AS RB,
                                          ROUND(AVG(CASE WHEN a.resep = 'Lama' THEN 1 ELSE 0 END), 0) AS RL,
                                          ROUND(AVG(CASE WHEN buyer = 'ADIDAS' THEN b.bruto ELSE 0 END), 2) AS qtyadidas,
                                          ROUND(AVG(CASE WHEN buyer = 'ADIDAS' THEN c.pakai_air ELSE 0 END), 2) AS airadidas,
                                          ROUND(AVG(CASE WHEN a.resep = 'Baru' AND buyer = 'ADIDAS' THEN 1 ELSE 0 END), 0) AS RBadidas,
                                          ROUND(AVG(CASE WHEN a.resep = 'Lama' AND buyer = 'ADIDAS' THEN 1 ELSE 0 END), 0) AS RLadidas,
                                          ROUND(AVG(CASE WHEN buyer = 'ADIDAS' THEN (b.bruto / b.kapasitas) * 100 ELSE 0 END), 2) AS loadingadidas,
                                          ROUND(AVG(CASE WHEN buyer = 'ADIDAS' THEN c.pakai_air / NULLIF(b.bruto, 0) ELSE 0 END), 2) AS l_rairadidas,
                                          ISNULL(a.g_shift, b.g_shift) AS shft
                                      FROM
                                          db_dying.tbl_schedule b
                                          LEFT JOIN db_dying.tbl_montemp c ON c.id_schedule = b.id
                                          LEFT JOIN db_dying.tbl_hasilcelup a ON a.id_montemp = c.id
                                    WHERE
                                      $shft 
                                       CONVERT(datetime, a.tgl_buat, 120) BETWEEN '$Awal' AND '$Akhir'
                                AND b.kapasitas > '1000' and b.kapasitas <= '1200' AND b.bruto > 0 GROUP BY
                                ISNULL(a.g_shift, b.g_shift)", array(), array("Scrollable" => SQLSRV_CURSOR_KEYSET));
            $r1000 = sqlsrv_fetch_array($sql1000);
            $rw100 = sqlsrv_num_rows($sql1000);
            ?>
            <tr bgcolor="#33CCFF">
              <td>
                <div align="center"><strong>1</strong></div>
              </td>
              <td bgcolor="#33CCFF">
                <div align="right"><strong>0-50 Kg</strong></div>
              </td>
              <td>
                <div align="center">
                  <?php if ($r0 > 0) {
                    echo $r0['RB'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <?php if ($r0 > 0) {
                    echo $r0['RL'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r0 > 0) {
                    echo $r0['air'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r0 > 0) {
                    echo $r0['qty'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <?php if ($r0 > 0) {
                    echo $r0['loading'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <?php if ($r0 > 0 and $r0['qty'] > 0) {
                    echo $l_r0 = round($r0['air'] / $r0['qty'], 2);
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <?php if ($r0 > 0) {
                    echo $r0['RBadidas'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <?php if ($r0 > 0) {
                    echo $r0['RLadidas'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r0 > 0) {
                    echo $r0['airadidas'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r0 > 0) {
                    echo $r0['qtyadidas'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <?php if ($r0 > 0) {
                    echo $r0['loadingadidas'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <?php if ($r0 > 0 and $r0['qtyadidas'] > 0) {
                    echo $l_radidas0 = round($r0['airadidas'] / $r0['qtyadidas'], 2);
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
            </tr>
            <tr bgcolor="#FFCC99">
              <td>
                <div align="center"><strong>2</strong></div>
              </td>
              <td>
                <div align="right">
                  <div align="right"><strong>&gt; 50-100 Kg</strong></div>
                </div>
              </td>
              <td>
                <div align="center">
                  <?php if ($r50 > 0) {
                    echo $r50['RB'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <?php if ($r50 > 0) {
                    echo $r50['RL'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r50 > 0) {
                    echo $r50['air'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r50 > 0) {
                    echo $r50['qty'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <?php if ($r50 > 0) {
                    echo $r50['loading'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <?php if ($r50 > 0 and $r50['qty'] > 0) {
                    echo $l_r50 = round($r50['air'] / $r50['qty'], 2);
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <?php if ($r50 > 0) {
                    echo $r50['RBadidas'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <?php if ($r50 > 0) {
                    echo $r50['RLadidas'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r50 > 0) {
                    echo $r50['airadidas'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r50 > 0) {
                    echo $r50['qtyadidas'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <?php if ($r50 > 0) {
                    echo $r50['loadingadidas'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <?php if ($r50 > 0 and $r50['qtyadidas'] > 0) {
                    echo $l_radidas50 = round($r50['airadidas'] / $r50['qtyadidas'], 2);
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
            </tr>
            <tr bgcolor="#33CCFF">
              <td>
                <div align="center"><strong>3</strong></div>
              </td>
              <td>
                <div align="right">
                  <div align="right"><strong>&gt; 100-200 Kg</strong></div>
                </div>
              </td>
              <td>
                <div align="center">
                  <?php if ($r100 > 0) {
                    echo $r100['RB'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <?php if ($r100 > 0) {
                    echo $r100['RL'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r100 > 0) {
                    echo $r100['air'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r100 > 0) {
                    echo $r100['qty'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <?php if ($r100 > 0) {
                    echo $r100['loading'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <?php if ($r100 > 0 and $r100['qty'] > 0) {
                    echo $l_r100 = round($r100['air'] / $r100['qty'], 2);
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <?php if ($r100 > 0) {
                    echo $r100['RBadidas'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <?php if ($r100 > 0) {
                    echo $r100['RLadidas'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r100 > 0) {
                    echo $r100['airadidas'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r100 > 0) {
                    echo $r100['qtyadidas'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <?php if ($r100 > 0) {
                    echo $r100['loadingadidas'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <?php if ($r100 > 0 and $r100['qtyadidas'] > 0) {
                    echo $l_radidas100 = round($r100['airadidas'] / $r100['qtyadidas'], 2);
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
            </tr>
            <tr bgcolor="#FFCC99">
              <td>
                <div align="center"><strong>4</strong></div>
              </td>
              <td>
                <div align="right">
                  <div align="right"><strong>&gt; 200-400 Kg</strong></div>
                </div>
              </td>
              <td>
                <div align="center">
                  <?php if ($r200 > 0) {
                    echo $r200['RB'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <?php if ($r200 > 0) {
                    echo $r200['RL'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r200 > 0) {
                    echo $r200['air'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r200 > 0) {
                    echo $r200['qty'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <?php if ($r200 > 0) {
                    echo $r200['loading'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <?php if ($r200 > 0 and $r200['qty'] > 0) {
                    echo $l_r200 = round($r200['air'] / $r200['qty'], 2);
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <?php if ($r200 > 0) {
                    echo $r200['RBadidas'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <?php if ($r200 > 0) {
                    echo $r200['RLadidas'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r200 > 0) {
                    echo $r200['airadidas'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r200 > 0) {
                    echo $r200['qtyadidas'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <?php if ($r200 > 0) {
                    echo $r200['loadingadidas'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <?php if ($r200 > 0 and $r200['qtyadidas'] > 0) {
                    echo $l_radidas200 = round($r200['airadidas'] / $r200['qtyadidas'], 2);
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
            </tr>
            <tr bgcolor="#33CCFF">
              <td>
                <div align="center"><strong>5</strong></div>
              </td>
              <td>
                <div align="right">
                  <div align="right"><strong>&gt; 400-600 Kg</strong></div>
                </div>
              </td>
              <td>
                <div align="center">
                  <?php if ($r400 > 0) {
                    echo $r400['RB'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <?php if ($r400 > 0) {
                    echo $r400['RL'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r400 > 0) {
                    echo $r400['air'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r400 > 0) {
                    echo $r400['qty'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <?php if ($r400 > 0) {
                    echo $r400['loading'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <?php if ($r400 > 0 and $r400['qty'] > 0) {
                    echo $l_r400 = round($r400['air'] / $r400['qty'], 2);
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <?php if ($r400 > 0) {
                    echo $r400['RBadidas'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <?php if ($r400 > 0) {
                    echo $r400['RLadidas'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r400 > 0) {
                    echo $r400['airadidas'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r400 > 0) {
                    echo $r400['qtyadidas'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <?php if ($r400 > 0) {
                    echo $r400['loadingadidas'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <?php if ($r400 > 0 and $r400['qtyadidas'] > 0) {
                    echo $l_radidas400 = round($r400['airadidas'] / $r400['qtyadidas'], 2);
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
            </tr>
            <tr bgcolor="#FFCC99">
              <td>
                <div align="center"><strong>6</strong></div>
              </td>
              <td>
                <div align="right">
                  <div align="right"><strong>&gt; 600-800 Kg</strong></div>
                </div>
              </td>
              <td>
                <div align="center">
                  <?php if ($r600 > 0) {
                    echo $r600['RB'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <?php if ($r600 > 0) {
                    echo $r600['RL'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r600 > 0) {
                    echo $r600['air'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r600 > 0) {
                    echo $r600['qty'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <?php if ($r600 > 0) {
                    echo $r600['loading'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <?php if ($r600 > 0 and $r600['qty'] > 0) {
                    echo $l_r600 = round($r600['air'] / $r600['qty'], 2);
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <?php if ($r600 > 0) {
                    echo $r600['RBadidas'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <?php if ($r600 > 0) {
                    echo $r600['RLadidas'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r600 > 0) {
                    echo $r600['airadidas'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r600 > 0) {
                    echo $r600['qtyadidas'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <?php if ($r600 > 0) {
                    echo $r600['loadingadidas'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <?php if ($r600 > 0 and $r600['qtyadidas'] > 0) {
                    echo $l_radidas600 = round($r600['airadidas'] / $r600['qtyadidas'], 2);
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
            </tr>
            <tr bgcolor="#33CCFF">
              <td>
                <div align="center"><strong>7</strong></div>
              </td>
              <td>
                <div align="right">
                  <div align="right"><strong>&gt; 800-1000 Kg</strong></div>
                </div>
              </td>
              <td>
                <div align="center">
                  <?php if ($r800 > 0) {
                    echo $r800['RB'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <?php if ($r800 > 0) {
                    echo $r800['RL'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r800 > 0) {
                    echo $r800['air'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r800 > 0) {
                    echo $r800['qty'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <?php if ($r800 > 0) {
                    echo round($r800['loading'], 2);
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <?php if ($r800 > 0 and $r800['qty'] > 0) {
                    echo $l_r800 = round($r800['air'] / $r800['qty'], 2);
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <?php if ($r800 > 0) {
                    echo $r800['RBadidas'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <?php if ($r800 > 0) {
                    echo $r800['RLadidas'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r800 > 0) {
                    echo $r800['airadidas'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r800 > 0) {
                    echo $r800['qtyadidas'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <?php if ($r800 > 0) {
                    echo $r800['loadingadidas'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <?php if ($r800 > 0 and $r800['qtyadidas'] > 0) {
                    echo $l_radidas800 = round($r800['airadidas'] / $r800['qtyadidas'], 2);
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
            </tr>
            <tr bgcolor="#FFCC99">
              <td>
                <div align="center"><strong>8</strong></div>
              </td>
              <td>
                <div align="right">
                  <div align="right"><strong>&gt; 1000-1200 Kg</strong></div>
                </div>
              </td>
              <td>
                <div align="center">
                  <?php if ($rw100 > 0 and $r1000['RB'] > 0) {
                    echo $r1000['RB'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <?php if ($r1000 > 0 and $r1000['RL'] > 0) {
                    echo $r1000['RL'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r1000 > 0 and $r1000['air']) {
                    echo $r1000['air'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td bgcolor="#FFCC99">
                <div align="right">
                  <?php if ($r1000 > 0 and $r1000['qty'] > 0) {
                    echo $r1000['qty'];
                  } else {
                    echo "0.00";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <?php if ($r1000 > 0 and $r1000['loading'] > 0) {
                    echo $r1000['loading'];
                  } else {
                    echo "0.00";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <?php if ($r1000 > 0 and $r1000['qty'] > 0) {
                    echo $l_r1000 = round($r1000['air'] / $r1000['qty'], 2);
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <?php if ($r1000 > 0 and $r1000['RBadidas'] > 0) {
                    echo $r1000['RBadidas'];
                  } else {
                    echo "0";
                  } ?>

                </div>
              </td>
              <td>
                <div align="center">
                  <?php if ($r1000 > 0 and $r1000['RLadidas'] > 0) {
                    echo $r1000['RLadidas'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r1000 > 0 and $r1000['airadidas'] > 0) {
                    echo $r1000['airadidas'];
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
              <td>
                <div align="right">
                  <?php if ($r1000 > 0 and $r1000['qtyadidas'] > 0) {
                    echo $r1000['qtyadidas'];
                  } else {
                    echo "0.00";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <?php if ($r1000 > 0 and $r1000['loadingadidas'] > 0) {
                    echo $r1000['loadingadidas'];
                  } else {
                    echo "0.00";
                  } ?>
                </div>
              </td>
              <td>
                <div align="center">
                  <?php if ($r1000 > 0 and $r1000['qtyadidas'] > 0) {
                    echo $l_radidas1000 = round($r1000['airadidas'] / $r1000['qtyadidas'], 2);
                  } else {
                    echo "0";
                  } ?>
                </div>
              </td>
            </tr>
            <tr bgcolor="#99FF99">
              <td>&nbsp;</td>
              <td><strong>Total</strong></td>
              <td>
                <div align="center">
                  <strong><?php echo $ttlRB = $r0['RB'] + $r50['RB'] + $r100['RB'] + $r200['RB'] + $r400['RB'] + $r600['RB'] + $r800['RB'] + $r1000['RB']; ?>
                  </strong>
                </div>
              </td>
              <td>
                <div align="center">
                  <strong><?php echo $ttlRL = $r0['RL'] + $r50['RL'] + $r100['RL'] + $r200['RL'] + $r400['RL'] + $r600['RL'] + $r800['RL'] + $r1000['RL']; ?>
                  </strong></div>
              </td>
              <td>
                <div align="right">
                  <strong><?php echo $ttlair = $r0['air'] + $r50['air'] + $r100['air'] + $r200['air'] + $r400['air'] + $r600['air'] + $r800['air'] + $r1000['air']; ?>
                  </strong>
                </div>
              </td>
              <td>
                <div align="right">
                  <strong><?php echo $ttlqty = $r0['qty'] + $r50['qty'] + $r100['qty'] + $r200['qty'] + $r400['qty'] + $r600['qty'] + $r800['qty'] + $r1000['qty']; ?></strong>
                </div>
              </td>
              <td>
                <div align="center">
                  <strong><?php echo $ttlloading = $r0['loading'] + $r50['loading'] + $r100['loading'] + $r200['loading'] + $r400['loading'] + $r600['loading'] + $r800['loading'] + $r1000['loading']; ?></strong>
                </div>
              </td>
              <td>
                <div align="center">
                  <strong><?php echo $ttll_r = $l_r0 + $l_r50 + $l_r100 + $l_r200 + $l_r400 + $l_r600 + $l_r800 + $l_r1000; ?></strong>
                </div>
              </td>
              <td>
                <div align="center">
                  <strong><?php echo $ttlRBadidas = $r0['RBadidas'] + $r50['RBadidas'] + $r100['RBadidas'] + $r200['RBadidas'] + $r400['RBadidas'] + $r600['RBadidas'] + $r800['RBadidas'] + $r1000['RBadidas']; ?>
                  </strong></div>
              </td>
              <td>
                <div align="center">
                  <strong><?php echo $ttlRLadidas = $r0['RLadidas'] + $r50['RLadidas'] + $r100['RLadidas'] + $r200['RLadidas'] + $r400['RLadidas'] + $r600['RLadidas'] + $r800['RLadidas'] + $r1000['RLadidas']; ?></strong>
                </div>
              </td>
              <td>
                <div align="right">
                  <strong><?php echo $ttlairadidas = $r0['air'] + $r50['airadidas'] + $r100['airadidas'] + $r200['airadidas'] + $r400['airadidas'] + $r600['airadidas'] + $r800['airadidas'] + $r1000['airadidas']; ?></strong>
                </div>
              </td>
              <td>
                <div align="right">
                  <strong><?php echo $ttlqtyadidas = $r0['qtyadidas'] + $r50['qtyadidas'] + $r100['qtyadidas'] + $r200['qtyadidas'] + $r400['qtyadidas'] + $r600['qtyadidas'] + $r800['qtyadidas'] + $r1000['qtyadidas']; ?></strong>
                </div>
              </td>
              <td>
                <div align="center">
                  <strong><?php echo $ttlloadingadidas = $r0['loading'] + $r50['loadingadidas'] + $r100['loadingadidas'] + $r200['loadingadidas'] + $r400['loadingadidas'] + $r600['loadingadidas'] + $r800['loadingadidas'] + $r1000['loadingadidas']; ?></strong>
                </div>
              </td>
              <td>
                <div align="center">
                  <strong><?php echo $ttll_radidas = $l_radidas0 + $l_radidas50 + $l_radidas100 + $l_radidas200 + $l_radidas400 + $l_radidas600 + $l_radidas800 + $l_radidas1000; ?></strong>
                </div>
              </td>
            </tr>
            <tr bgcolor="#99FF99">
              <td>&nbsp;</td>
              <td><strong>Rata-Rata</strong></td>
              <td>
                <div align="center"><strong><?php echo round($ttlRB / 8, 2); ?></strong></div>
              </td>
              <td>
                <div align="center"><strong><?php echo round($ttlRL / 8, 2); ?></strong></div>
              </td>
              <td>
                <div align="right"><strong><?php echo round($ttlair / 8); ?></strong></div>
              </td>
              <td>
                <div align="right"><strong><?php echo round($ttlqty / 8, 2); ?></strong></div>
              </td>
              <td>
                <div align="center"><strong><?php echo round($ttlloading / 8, 2); ?></strong></div>
              </td>
              <td>
                <div align="center"><strong><?php echo round($ttll_r / 8, 2); ?></strong></div>
              </td>
              <td>
                <div align="center"><strong><?php echo round($ttlRBadidas / 8, 2); ?></strong></div>
              </td>
              <td>
                <div align="center"><strong><?php echo round($ttlRLadidas / 8, 2); ?></strong></div>
              </td>
              <td>
                <div align="right"><strong><?php echo round($ttlairadidas / 8); ?></strong></div>
              </td>
              <td>
                <div align="right"><strong><?php echo round($ttlqtyadidas / 8, 2); ?></strong></div>
              </td>
              <td>
                <div align="center"><strong><?php echo round($ttlloadingadidas / 8, 2); ?></strong></div>
              </td>
              <td>
                <div align="center"><strong><?php echo round($ttll_radidas / 8, 2); ?></strong></div>
              </td>
            </tr>
          </table>
          <table width="100%" border="0">
            <tr>
              <td align="left" valign="top">
                <table width="100%" border="0" class="table-list1">
                  <tr>
                    <td rowspan="3" valign="middle" bgcolor="#99FF99">
                      <div align="center"><strong>No.</strong></div>
                    </td>
                    <td rowspan="3" valign="middle" bgcolor="#99FF99">
                      <div align="center"><strong>Energy</strong></div>
                    </td>
                    <td colspan="2" bgcolor="#99FF99">
                      <div align="center"><strong>ALL BUYER</strong></div>
                    </td>
                    <td colspan="2" bgcolor="#99FF99">
                      <div align="center"><strong>BUYER ADIDAS</strong></div>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2" bgcolor="#99FF99">
                      <div align="center"><strong>Average</strong></div>
                    </td>
                    <td colspan="2" bgcolor="#99FF99">
                      <div align="center"><strong>Average</strong></div>
                    </td>
                  </tr>
                  <tr>
                    <td bgcolor="#99FF99">
                      <div align="center"><strong>Lama Proses</strong></div>
                    </td>
                    <td bgcolor="#99FF99">
                      <div align="center"><strong>Menit</strong></div>
                    </td>
                    <td bgcolor="#99FF99">
                      <div align="center"><strong>Lama Proses</strong></div>
                    </td>
                    <td bgcolor="#99FF99">
                      <div align="center"><strong>Menit</strong></div>
                    </td>
                  </tr>
                  <?php
                  $sqlenergi = sqlsrv_query($con, "SELECT
                                                      b.energi,
                                                      AVG(DATEDIFF(MINUTE, c.tgl_buat, a.tgl_buat)) AS lama,
                                                      AVG(CASE WHEN b.buyer = 'ADIDAS' THEN DATEDIFF(MINUTE, c.tgl_buat, a.tgl_buat) ELSE 0 END) AS lamaadidas,
                                                      ISNULL(a.g_shift, b.g_shift) AS shft
                                                  FROM
                                                      db_dying.tbl_schedule b
                                                      LEFT JOIN db_dying.tbl_montemp c ON c.id_schedule = b.id
                                                      LEFT JOIN db_dying.tbl_hasilcelup a ON a.id_montemp = c.id
                                                  WHERE 
                                                      $shft 
                                                      CONVERT(date, a.tgl_buat) BETWEEN '$Awal' AND '$Akhir'
                                                      AND b.energi <> '' AND b.energi IS NOT NULL
                                                  GROUP BY
                                                    b.energi,
                                                    a.g_shift,
                                                    b.g_shift
                                                  ORDER BY
                                                      b.energi 
                                                    ASC");
                  $c = 1;
                  $n = 1;
                  while ($rng = sqlsrv_fetch_array($sqlenergi)) {
                    $bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99';
                    ?>
                    <tr bgcolor="<?php echo $bgcolor; ?>">
                      <td>
                        <div align="center"><strong><?php echo $n; ?></strong></div>
                      </td>
                      <td>
                        <div align="right"><strong><?php echo $rng['energi']; ?></strong></div>
                      </td>
                      <td>
                        <div align="right">
                          <?php $jam = floor(round($rng['lama']) / 60);
                          $menit = round($rng['lama']) % 60;
                          echo $jam . " Jam " . $menit . " Menit"; ?>
                        </div>
                      </td>
                      <td>
                        <div align="right"><?php echo round($rng['lama']); ?></div>
                      </td>
                      <td>
                        <div align="right">
                          <?php $jamadidas = floor(round($rng['lamaadidas']) / 60);
                          $menitadidas = round($rng['lamaadidas']) % 60;
                          echo $jamadidas . " Jam " . $menitadidas . " Menit"; ?>
                        </div>
                      </td>
                      <td>
                        <div align="right"><?php echo round($rng['lamaadidas']); ?></div>
                      </td>
                    </tr>
                    <?php
                    $ttlLamaE = $ttlLamaE + $rng['lama'];
                    $Ejam = floor(round($ttlLamaE) / 60);
                    $Emenit = round($ttlLamaE) % 60;
                    $ttlLamaEadidas = $ttlLamaEadidas + $rng['lamaadidas'];
                    $Ejamadidas = floor(round($ttlLamaEadidas) / 60);
                    $Emenitadidas = round($ttlLamaEadidas) % 60;
                    $ttlLamaEr = $ttlLamaE / $n;
                    $ttlLamaEradidas = $ttlLamaEadidas / $n;
                    $Ejamr = floor(round($ttlLamaEr) / 60);
                    $Emenitr = round($ttlLamaEr) % 60;
                    $Ejamradidas = floor(round($ttlLamaEradidas) / 60);
                    $Emenitradidas = round($ttlLamaEradidas) % 60;
                    $n++;
                  } ?>
                  <tr bgcolor="#99FF99">
                    <td>&nbsp;</td>
                    <td><strong>Total</strong></td>
                    <td>
                      <div align="right"><strong><?php echo $Ejam . " Jam " . $Emenit . " Menit"; ?></strong></div>
                    </td>
                    <td>
                      <div align="right"><strong><?php echo round($ttlLamaE); ?></strong></div>
                    </td>
                    <td>
                      <div align="right">
                        <strong><?php echo $Ejamadidas . " Jam " . $Emenitadidas . " Menit"; ?></strong></div>
                    </td>
                    <td>
                      <div align="right"><strong><?php echo round($ttlLamaEadidas); ?></strong></div>
                    </td>
                  </tr>
                  <tr bgcolor="#99FF99">
                    <td>&nbsp;</td>
                    <td><strong>Rata-Rata</strong></td>
                    <td>
                      <div align="right"><strong><?php echo $Ejamr . " Jam " . $Emenitr . " Menit"; ?></strong></div>
                    </td>
                    <td>
                      <div align="right"><strong><?php echo round($ttlLamaEr); ?></strong></div>
                    </td>
                    <td>
                      <div align="right">
                        <strong><?php echo $Ejamradidas . " Jam " . $Emenitradidas . " Menit"; ?></strong></div>
                    </td>
                    <td>
                      <div align="right"><strong><?php echo round($ttlLamaEradidas); ?></strong></div>
                    </td>
                  </tr>
                </table>
              </td>
              <td align="left" valign="top">
                <table width="100%" border="0" class="table-list1">
                  <tr>
                    <td rowspan="3" valign="middle" bgcolor="#99FF99">
                      <div align="center"><strong>No.</strong></div>
                    </td>
                    <td rowspan="3" valign="middle" bgcolor="#99FF99">
                      <div align="center"><strong>Machine Utilization</strong></div>
                    </td>
                    <td colspan="2" bgcolor="#99FF99">
                      <div align="center"><strong>ALL BUYER</strong></div>
                    </td>
                    <td colspan="2" bgcolor="#99FF99">
                      <div align="center"><strong>BUYER ADIDAS</strong></div>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2" bgcolor="#99FF99">
                      <div align="center"><strong>Average</strong></div>
                    </td>
                    <td colspan="2" bgcolor="#99FF99">
                      <div align="center"><strong>Average</strong></div>
                    </td>
                  </tr>
                  <tr>
                    <td bgcolor="#99FF99">
                      <div align="center"><strong>Lama Stop</strong></div>
                    </td>
                    <td bgcolor="#99FF99">
                      <div align="center"><strong>Menit</strong></div>
                    </td>
                    <td bgcolor="#99FF99">
                      <div align="center"><strong>Lama Stop</strong></div>
                    </td>
                    <td bgcolor="#99FF99">
                      <div align="center"><strong>Menit</strong></div>
                    </td>
                  </tr>
                  <?php
                  $sqlSM = sqlsrv_query($con, "SELECT
                                                  a.kd_stop,
                                                  AVG(CASE WHEN a.kd_stop IS NOT NULL AND c.tgl_buat IS NOT NULL AND a.tgl_buat IS NOT NULL THEN DATEDIFF(MINUTE, c.tgl_buat, a.tgl_buat) END) AS lama,
                                                  AVG(CASE WHEN b.buyer = 'ADIDAS' AND a.kd_stop IS NOT NULL AND c.tgl_buat IS NOT NULL AND a.tgl_buat IS NOT NULL THEN DATEDIFF(MINUTE, c.tgl_buat, a.tgl_buat) ELSE 0 END) AS lamaadidas,
                                                  ISNULL(a.g_shift, b.g_shift) AS shft
                                              FROM
                                                  db_dying.tbl_schedule b
                                                  LEFT JOIN db_dying.tbl_montemp c ON c.id_schedule = b.id
                                                  LEFT JOIN db_dying.tbl_hasilcelup a ON a.id_montemp = c.id
                                              WHERE 
                                                  $shft
                                                  CONVERT(date, a.tgl_buat) BETWEEN '$Awal' AND '$Akhir'
                                                  AND (a.kd_stop = 'PT' OR a.kd_stop = 'PM')
                                              GROUP BY
                                                a.kd_stop,
                                                a.g_shift,
                                                b.g_shift
                                              ORDER BY
                                                  a.kd_stop ASC");
                  $rSM = sqlsrv_fetch_array($sqlSM);

                  $sqlCO = sqlsrv_query($con, "SELECT
                                                a.kd_stop,
                                               AVG(DISTINCT DATEDIFF(MINUTE, c.tgl_buat, a.tgl_buat)) AS lama,
                                               AVG(CASE WHEN b.buyer = 'ADIDAS' THEN DATEDIFF(MINUTE, c.tgl_buat, a.tgl_buat) ELSE 0 END) AS lamaadidas,
                                               ISNULL(a.g_shift, b.g_shift) AS shft
                                              FROM
                                                db_dying.tbl_schedule b
                                                LEFT JOIN db_dying.tbl_montemp c ON c.id_schedule = b.id
                                                LEFT JOIN db_dying.tbl_hasilcelup a ON a.id_montemp = c.id
                                              WHERE
                                                $shft 
                                                CONVERT(date, a.tgl_buat) BETWEEN '$Awal' AND '$Akhir'
                                                AND (a.kd_stop='PA')
                                              GROUP BY 
                                                a.kd_stop,
                                                a.g_shift,
                                                b.g_shift 
                                              ORDER BY a.kd_stop ASC ");
                  $rCO = sqlsrv_fetch_array($sqlCO);
                  $sqlBD = sqlsrv_query($con, "SELECT
                                                a.kd_stop,
                                                AVG(DISTINCT DATEDIFF(MINUTE, c.tgl_buat, a.tgl_buat)) AS lama,
                                                AVG(CASE WHEN b.buyer = 'ADIDAS' THEN DATEDIFF(MINUTE, c.tgl_buat, a.tgl_buat) ELSE 0 END) AS lamaadidas,	
                                                ISNULL(a.g_shift, b.g_shift) AS shft
                                              FROM
                                                db_dying.tbl_schedule b
                                                LEFT JOIN db_dying.tbl_montemp c ON c.id_schedule = b.id
                                                LEFT JOIN db_dying.tbl_hasilcelup a ON a.id_montemp = c.id	
                                              WHERE
                                              $shft 
                                                CONVERT(date, a.tgl_buat) BETWEEN '$Awal' AND '$Akhir' 
                                                AND (a.kd_stop='LM' OR a.kd_stop='KM' OR a.kd_stop='GT')
                                              GROUP BY 
                                                a.kd_stop,
                                                a.g_shift,
                                                b.g_shift 
                                              ORDER BY a.kd_stop ASC ");
                  $rBD = sqlsrv_fetch_array($sqlBD);
                  $sqlQC = sqlsrv_query($con, "SELECT
                                                a.kd_stop,
                                                AVG(DISTINCT DATEDIFF(MINUTE, c.tgl_buat, a.tgl_buat)) AS lama,
                                                AVG(CASE WHEN b.buyer = 'ADIDAS' THEN DATEDIFF(MINUTE, c.tgl_buat, a.tgl_buat) ELSE 0 END) AS lamaadidas,
                                                ISNULL(a.g_shift, b.g_shift) AS shft
                                              FROM
                                                db_dying.tbl_schedule b
                                                LEFT JOIN db_dying.tbl_montemp c ON c.id_schedule = b.id
                                                LEFT JOIN db_dying.tbl_hasilcelup a ON a.id_montemp = c.id	
                                              WHERE
                                              $shft 
                                                CONVERT(date, a.tgl_buat) BETWEEN '$Awal' AND '$Akhir' 
                                                AND (a.kd_stop='AP')
                                              GROUP BY
                                                a.kd_stop,
                                                a.g_shift,
                                                b.g_shift 
                                              ORDER BY a.kd_stop ASC ");
                  $rQC = sqlsrv_fetch_array($sqlQC);
                  $sqlPL = sqlsrv_query($con, "SELECT
                                              a.kd_stop,
                                              AVG(DISTINCT DATEDIFF(MINUTE, c.tgl_buat, a.tgl_buat)) AS lama,
                                              AVG(CASE WHEN b.buyer = 'ADIDAS' THEN DATEDIFF(MINUTE, c.tgl_buat, a.tgl_buat) ELSE 0 END) AS lamaadidas,
                                              ISNULL(a.g_shift, b.g_shift) AS shft
                                            FROM
                                              db_dying.tbl_schedule b
                                              LEFT JOIN db_dying.tbl_montemp c ON c.id_schedule = b.id
                                              LEFT JOIN db_dying.tbl_hasilcelup a ON a.id_montemp = c.id	
                                            WHERE
                                            $shft 
                                              CONVERT(date, a.tgl_buat) BETWEEN '$Awal' AND '$Akhir'
                                              AND (a.kd_stop='KO' OR a.kd_stop='TG')
                                            GROUP BY 
                                              a.kd_stop,
                                              b.g_shift, 
                                              a.g_shift
                                            ORDER BY a.kd_stop ASC");
                  $rPL = sqlsrv_fetch_array($sqlPL);
                  ?>
                  <tr bgcolor="#33CCFF">
                    <td>
                      <div align="center"><strong>1</strong></div>
                    </td>
                    <td>
                      <div align="center"><strong>Schedule Maintenance</strong></div>
                    </td>
                    <td>
                      <div align="right">
                        <?php $jam = floor(round($rSM['lama']) / 60);
                        $menit = round($rSM['lama']) % 60;
                        echo $jam . " Jam " . $menit . " Menit"; ?>
                      </div>
                    </td>
                    <td>
                      <div align="right">
                        <?php if ($rSM > 0) {
                          echo round($rSM['lama']);
                        } else {
                          echo "0";
                        } ?>
                      </div>
                    </td>
                    <td>
                      <div align="right">
                        <?php $jam = floor(round($rSM['lamaadidas']) / 60);
                        $menit = round($rSM['lamaadidas']) % 60;
                        echo $jam . " Jam " . $menit . " Menit"; ?>
                      </div>
                    </td>
                    <td>
                      <div align="right">
                        <?php if ($rSM > 0) {
                          echo round($rSM['lamaadidas']);
                        } else {
                          echo "0";
                        } ?>
                      </div>
                    </td>
                  </tr>
                  <tr bgcolor="#FFCC99">
                    <td>
                      <div align="center"><strong>2</strong></div>
                    </td>
                    <td>
                      <div align="center"><strong>Change Over</strong></div>
                    </td>
                    <td>
                      <div align="right">
                        <?php $jam = floor(round($rCO['lama']) / 60);
                        $menit = round($rCO['lama']) % 60;
                        echo $jam . " Jam " . $menit . " Menit"; ?>
                      </div>
                    </td>
                    <td>
                      <div align="right">
                        <?php if ($rCO > 0) {
                          echo round($rCO['lama']);
                        } else {
                          echo "0";
                        } ?>
                      </div>
                    </td>
                    <td>
                      <div align="right">
                        <?php $jam = floor(round($rCO['lamaadidas']) / 60);
                        $menit = round($rCO['lamaadidas']) % 60;
                        echo $jam . " Jam " . $menit . " Menit"; ?>
                      </div>
                    </td>
                    <td>
                      <div align="right">
                        <?php if ($rCO > 0) {
                          echo round($rCO['lamaadidas']);
                        } else {
                          echo "0";
                        } ?>
                      </div>
                    </td>
                  </tr>
                  <tr bgcolor="#33CCFF">
                    <td>
                      <div align="center"><strong>3</strong></div>
                    </td>
                    <td>
                      <div align="center"><strong>Breakdown</strong></div>
                    </td>
                    <td>
                      <div align="right">
                        <?php $jam = floor(round($rBD['lama']) / 60);
                        $menit = round($rBD['lama']) % 60;
                        echo $jam . " Jam " . $menit . " Menit"; ?>
                      </div>
                    </td>
                    <td>
                      <div align="right">
                        <?php if ($rBD > 0) {
                          echo round($rBD['lama']);
                        } else {
                          echo "0";
                        } ?>
                      </div>
                    </td>
                    <td>
                      <div align="right">
                        <?php $jam = floor(round($rBD['lamaadidas']) / 60);
                        $menit = round($rBD['lamaadidas']) % 60;
                        echo $jam . " Jam " . $menit . " Menit"; ?>
                      </div>
                    </td>
                    <td>
                      <div align="right">
                        <?php if ($rBD > 0) {
                          echo round($rBD['lamaadidas']);
                        } else {
                          echo "0";
                        } ?>
                      </div>
                    </td>
                  </tr>
                  <tr bgcolor="#FFCC99">
                    <td>
                      <div align="center"><strong>4</strong></div>
                    </td>
                    <td>
                      <div align="center"><strong>Operating Level</strong></div>
                    </td>
                    <td>
                      <div align="right">
                        <?php $jam = floor(round($rOL['lama']) / 60);
                        $menit = round($rOL['lama']) % 60;
                        echo $jam . " Jam " . $menit . " Menit"; ?>
                      </div>
                    </td>

                    <td>
                      <div align="right">
                        <?php if ($rOL > 0) {
                          echo round($rOL['lama']);
                        } else {
                          echo "0";
                        } ?>
                      </div>
                    </td>
                    <td>
                      <div align="right">
                        <?php $jam = floor(round($rOL['lamaadidas']) / 60);
                        $menit = round($rOL['lamaadidas']) % 60;
                        echo $jam . " Jam " . $menit . " Menit"; ?>
                      </div>
                    </td>
                    <td>
                      <div align="right">
                        <?php if ($rOL > 0) {
                          echo round($rOL['lamaadidas']);
                        } else {
                          echo "0";
                        } ?>
                      </div>
                    </td>
                  </tr>
                  <tr bgcolor="#33CCFF">
                    <td>
                      <div align="center"><strong>5</strong></div>
                    </td>
                    <td>
                      <div align="center"><strong>QC Check</strong></div>
                    </td>
                    <td>
                      <div align="right">
                        <?php $jam = floor(round($rQC['lama']) / 60);
                        $menit = round($rQC['lama']) % 60;
                        echo $jam . " Jam " . $menit . " Menit"; ?>
                      </div>
                    </td>
                    <td>
                      <div align="right">
                        <?php if ($rSM > 0) {
                          echo round($rQC['lama']);
                        } else {
                          echo "0";
                        } ?>
                      </div>
                    </td>
                    <td>
                      <div align="right">
                        <?php $jam = floor(round($rQC['lamaadidas']) / 60);
                        $menit = round($rQC['lamaadidas']) % 60;
                        echo $jam . " Jam " . $menit . " Menit"; ?>
                      </div>
                    </td>
                    <td>
                      <div align="right">
                        <?php if ($rSM > 0) {
                          echo round($rQC['lamaadidas']);
                        } else {
                          echo "0";
                        } ?>
                      </div>
                    </td>
                  </tr>
                  <tr bgcolor="#FFCC99">
                    <td>
                      <div align="center"><strong>6</strong></div>
                    </td>
                    <td>
                      <div align="center"><strong>Planning</strong></div>
                    </td>
                    <td>
                      <div align="right">
                        <?php $jam = floor(round($rPL['lama']) / 60);
                        $menit = round($rPL['lama']) % 60;
                        echo $jam . " Jam " . $menit . " Menit"; ?>
                      </div>
                    </td>
                    <td>
                      <div align="right">
                        <?php if ($rPL > 0) {
                          echo round($rPL['lama']);
                        } else {
                          echo "0";
                        } ?>
                      </div>
                    </td>
                    <td>
                      <div align="right">
                        <?php $jam = floor(round($rPL['lamaadidas']) / 60);
                        $menit = round($rPL['lamaadidas']) % 60;
                        echo $jam . " Jam " . $menit . " Menit"; ?>
                      </div>
                    </td>
                    <td>
                      <div align="right">
                        <?php if ($rPL > 0) {
                          echo round($rPL['lamaadidas']);
                        } else {
                          echo "0";
                        } ?>
                      </div>
                    </td>
                  </tr>

                  <tr bgcolor="#99FF99">
                    <td>&nbsp;</td>
                    <td><strong>Total</strong></td>
                    <td>
                      <div align="right">
                        <strong>
                          <?php $ttljam = floor(round($rSM['lama'] + $rCO['lama'] + $rBD['lama'] + $rOL['lama'] + $rQC['lama'] + $rPL['lama']) / 60);
                          $ttlmenit = round($rSM['lama'] + $rCO['lama'] + $rBD['lama'] + $rOL['lama'] + $rQC['lama'] + $rPL['lama']) % 60;
                          echo $ttljam . " Jam " . $ttlmenit . " Menit"; ?>
                        </strong>
                      </div>
                    </td>
                    <td>
                      <div align="right">
                        <strong><?php echo $ttlMenit = round($rSM['lama'] + $rCO['lama'] + $rBD['lama'] + $rOL['lama'] + $rQC['lama'] + $rPL['lama']); ?>
                        </strong>
                      </div>
                    </td>
                    <td>
                      <div align="right">
                        <strong>
                          <?php $ttljamadidas = floor(round($rSM['lamaadidas'] + $rCO['lamaadidas'] + $rBD['lamaadidas'] + $rOL['lamaadidas'] + $rQC['lamaadidas'] + $rPL['lamaadidas']) / 60);
                          $ttlmenitadidas = round($rSM['lamaadidas'] + $rCO['lamaadidas'] + $rBD['lamaadidas'] + $rOL['lamaadidas'] + $rQC['lamaadidas'] + $rPL['lamaadidas']) % 60;
                          echo $ttljamadidas . " Jam " . $ttlmenitadidas . " Menit"; ?>
                        </strong>
                      </div>
                    </td>
                    <td>
                      <div align="right">
                        <strong><?php echo $ttlMadidas = $rSM['lamaadidas'] + $rCO['lamaadidas'] + $rBD['lamaadidas'] + $rOL['lamaadidas'] + $rQC['lamaadidas'] + $rPL['lamaadidas']; ?>
                        </strong></div>
                    </td>
                  </tr>
                  <tr bgcolor="#99FF99">
                    <td>&nbsp;</td>
                    <td><strong>Rata-Rata</strong></td>
                    <td>
                      <div align="right">
                        <strong>
                          <?php $ttljamr = floor((round($rSM['lama'] + $rCO['lama'] + $rBD['lama'] + $rOL['lama'] + $rQC['lama'] + $rPL['lama']) / 6) / 60);
                          $ttlmenitr = round(($rSM['lama'] + $rCO['lama'] + $rBD['lama'] + $rOL['lama'] + $rQC['lama'] + $rPL['lama']) / 6) % 60;
                          echo $ttljamr . " Jam " . $ttlmenitr . " Menit"; ?>
                        </strong>
                      </div>
                    </td>
                    <td>
                      <div align="right"><strong><?php echo round($ttlMenit / 6); ?></strong></div>
                    </td>
                    <td>
                      <div align="right">
                        <strong>
                          <?php $ttljamadidasr = floor((round($rSM['lamaadidas'] + $rCO['lamaadidas'] + $rBD['lamaadidas'] + $rOL['lamaadidas'] + $rQC['lamaadidas'] + $rPL['lamaadidas']) / 6) / 60);
                          $ttlmenitadidasr = round(($rSM['lamaadidas'] + $rCO['lamaadidas'] + $rBD['lamaadidas'] + $rOL['lamaadidas'] + $rQC['lamaadidas'] + $rPL['lamaadidas']) / 6) % 60;
                          echo $ttljamadidasr . " Jam " . $ttlmenitadidasr . " Menit"; ?>
                        </strong>
                      </div>
                    </td>
                    <td>
                      <div align="right"><strong><?php echo round($ttlmadidas / 6); ?></strong></div>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </tbody>
  </table>
</body>

</html>