<?php
ini_set("error_reporting", 1);
include "../../koneksi.php";
include "../../tgl_indo.php";
//--
$idkk = $_REQUEST['idkk'];
$act = $_GET['g'];
//- 
$Awal = $_GET['awal'];
$Akhir = $_GET['akhir'];
$Dept = $_GET['dept'];
$Cancel = $_GET['cancel'];
$Kategori = $_GET['kategori'];
$qTgl = sqlsrv_query($con, "SELECT CONVERT(datetime,GETDATE()) AS tgl_skrg,CONVERT(datetime,GETDATE()) AS jam_skrg");
$rTgl = sqlsrv_fetch_array($qTgl);
if ($Awal != "") {
  $tgl = substr($Awal, 0, 10);
  $jam = $Awal;
} else {
  $tgl = $rTgl['tgl_skrg'];
  $jam = $rTgl['jam_skrg'];
}

if ($Kategori == "ALL") {
  $WKategori = null;
} else if ($Kategori == "hitung") {
  $WKategori = " ncp_hitung = 'ya' AND ";
} else if ($Kategori == "tidakhitung") {
  $WKategori = " ncp_hitung = 'tidak' AND ";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link href="styles_cetak.css" rel="stylesheet" type="text/css">
  <title>Cetak Harian NCP</title>
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

    window.addEventListener('load', function() {
      var rotates = document.getElementsByClassName('rotate');
      for (var i = 0; i < rotates.length; i++) {
        rotates[i].style.height = rotates[i].offsetWidth + 'px';
      }
    });
    // next commands
  </script>
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
  <table width="100%">
    <thead>
      <tr>
        <td>
          <table width="100%" border="1" class="table-list1">
            <tr>
              <td width="6%" align="center"><img src="indo.jpg" width="60" height="60" /></td>
              <td width="94%" align="center" valign="middle"><strong>
                  <font size="+1">LAPORAN NCP BULANAN</font>
                </strong></td>
            </tr>
          </table>
          <table width="100%" border="0">
            <tbody>
              <tr>
                <td>Dept : <?php echo "DYE"; ?><br />
                  Periode : <?php echo tanggal_indo($_GET['awal']); ?> s/d <?php echo tanggal_indo($_GET['akhir']); ?></td>
              </tr>
            </tbody>
          </table>
        </td>
      </tr>
    </thead>
    <tr>
      <td>
        <table width="100%" border="1" class="table-list1">
          <tbody>
            <tr align="center">
              <td width="3%">No</td>
              <td>Tanggal</td>
              <td>No. NCP</td>
              <td>Langganan</td>
              <td width="4%">Buyer</td>
              <td width="3%">PO</td>
              <td width="4%">Order</td>
              <td>Hanger</td>
              <td>Jenis Kain</td>
              <td width="4%">Warna</td>
              <td width="4%">No. Warna</td>
              <td width="3%">Lot</td>
              <td width="3%">Rol</td>
              <td width="4%">Weight</td>
              <td width="4%">PO Rajut</td>
              <td>Masalah</td>
              <td>Penyelesaian</td>
              <td width="3%">NSP</td>
              <td>Tgl Rencana</td>
              <td>Tgl Aktual</td>
            </tr>
            <?php
            $no = 1;
            $qry1 = sqlsrv_query($con, "SELECT * FROM db_dying.tbl_ncp_memo WHERE $WKategori CONVERT(date, tgl_buat) BETWEEN '$Awal' AND '$Akhir' ORDER BY id ASC");

            while ($row1 = sqlsrv_fetch_array($qry1)) {
            ?>
              <tr valign="top">
                <td align="center"><?php echo $no; ?></td>
                <td align="center"><?php echo date("d/m/y", strtotime($row1['tgl_buat']->format('Y-m-d'))); ?></td>
                <td align="center" style="text-align: left"><?php echo strtoupper($row1['no_ncp']); ?></td>
                <td><?php echo strtoupper($row1['langganan']); ?></td>
                <td><?php echo strtoupper($row1['buyer']); ?></td>
                <td><?php echo strtoupper($row1['po_number']); ?></td>
                <td align="center"><?php echo strtoupper($row1['order']); ?></td>
                <td><?php echo strtoupper($row1['no_hanger']); ?></td>
                <td><?php echo strtoupper($row1['jenis_kain']); ?></td>
                <td><?php echo strtoupper($row1['warna']); ?></td>
                <td><?php echo strtoupper($row1['no_warna']); ?></td>
                <td align="center"><?php echo strtoupper($row1['lot']); ?></td>
                <td align="center"><?php echo strtoupper($row1['rol_ncp']); ?></td>
                <td align="right"><?php echo strtoupper($row1['qty_ncp']); ?></td>
                <td align="center"><?php echo strtoupper($row1['po_rajut']); ?></td>
                <td align="left"><?php echo strtoupper($row1['masalah']); ?></td>
                <td align="center"><?php echo strtoupper($row1['penyelesaian']); ?></td>
                <td align="center"><?php echo strtoupper($row1['nsp']); ?></td>
                <td align="center"><?php if ($row1['tgl_rencana'] != "") {
                                      echo date("d/m/y", strtotime($row1['tgl_rencana']->format('Y-m-d')));
                                    } ?></td>
                <td align="center"><?php if ($row1['tgl_penyelesaian'] != "") {
                                      echo date("d/m/y", strtotime($row1['tgl_penyelesaian']->format('Y-m-d')));
                                    } ?></td>
              </tr>
            <?php $no++;
              if ($row1['status'] != "Cancel") {
                $rol   = $row1['rol_ncp'];
                $berat = $row1['qty_ncp'];
                $lot   = "1";
              } else {
                $rol   = "0";
                $berat = "0";
                $lot   = "0";
              }
              $trol = $trol + $rol;
              $tberat = $tberat + $berat;
              $tlot = $tlot + $lot;
            } ?>
            <tr valign="top">
              <td align="right">&nbsp;</td>
              <td align="right">&nbsp;</td>
              <td align="right">&nbsp;</td>
              <td align="right">&nbsp;</td>
              <td align="right">&nbsp;</td>
              <td align="right">&nbsp;</td>
              <td align="right">&nbsp;</td>
              <td align="right">&nbsp;</td>
              <td align="right">&nbsp;</td>
              <td align="right">&nbsp;</td>
              <td align="right">TOTAL</td>
              <td align="center"><?php echo $tlot; ?></td>
              <td align="center"><?php echo $trol; ?></td>
              <td align="right"><?php echo number_format($tberat, 2); ?></td>
              <td align="right">&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
            </tr>

          </tbody>
        </table>
      </td>
    </tr>

  </table>

  <script>
    //alert('cetak');window.print();
  </script>
</body>

</html>