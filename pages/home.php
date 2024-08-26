<?php
ini_set("error_reporting", 1);
session_start();
include"koneksi.php";
//include_once('koneksi.php');
//include 'ajax/logic_chart.php';
?>
<?php
if (!isset($_SESSION['user_id10']) || !isset($_SESSION['pass_id10'])) {
?>
  <script>
    setTimeout("location.href='index.php'", 500);
  </script>
<?php
  die('Illegal Acces');
}
$page  = isset($_GET['p']) ? $_GET['p'] : '';
$act  = isset($_GET['act']) ? $_GET['act'] : '';
$id    = isset($_GET['id']) ? $_GET['id'] : '';
$page  = strtolower($page);
?>
<link rel="stylesheet" href="plugins/highcharts/style_chart.css">

<body>
  <!-- <blockquote style="margin: 0px"> -->
  <div class="container" style="margin-top: -20px; margin-bottom: 10px;">
    <h2 style="font-weight: bold;" class="text-center">Welcome <u><?php echo strtoupper($_SESSION['user_id10']); ?></u> at Indo Taichen Textile Industry</h2>

  </div>
  <!-- </blockquote> -->
  <!-- 4 Kotak Dashboard -->
  <div class="row">
    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-aqua">
        <div class="inner">
          <?php
          $bulan = array(
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
          );
          // $sqlsvr = sqlsrv_query($conn,"select count(*) as jml,MONTH(GETDATE()) as bln,YEAR(GETDATE()) as thn from
          //                       NCP ncp inner join
          //                       ProcessControlBatches pcb on ncp.PCBID = pcb.ID 
          //                       where ncp.DocumentNo LIKE 'DYE%' and convert(char(7),ncp.Dated,120)=convert(char(7),GETDATE(),120)");
          // $rsvr = sqlsrv_fetch_array($sqlsvr);
          ?>
          <h3><?php echo $rsvr['jml']; ?></h3>
          <p>NCP Dyeing Bulan <?php echo $bulan[$rsvr['bln']] . " " . $rsvr['thn']; ?></p>
        </div>
        <div class="icon">
          <i class="fa fa-shopping-cart"></i>
        </div>
        <a href="?p=NCP-DYE" class="small-box-footer">
          More info <i class="fa fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-green">
        <div class="inner">
          <?php
          // $sqlsvr1 = sqlsrv_query($conn,"select count(*) as jml,YEAR(GETDATE()) as thn from
          //                     NCP ncp inner join
          //                     ProcessControlBatches pcb on ncp.PCBID = pcb.ID 
          //                     where ncp.DocumentNo LIKE 'DYE%' and convert(char(4),ncp.Dated,120)=convert(char(4),GETDATE(),120)");
          // $rsvr1 = sqlsrv_fetch_array($sqlsvr1);
          ?>
          <h3><?php echo $rsvr1['jml']; ?></h3>
          <p>NCP Dyeing Tahun <?php echo $rsvr1['thn']; ?></p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
        <a href="?p=NCP-DYE" class="small-box-footer">
          More info <i class="fa fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>
    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-yellow">
        <div class="inner">
          <?php
          /*$sql1 = mysqli_query("SELECT count(*) as jml FROM tbl_monitoring a 
	                            INNER JOIN tbl_sample b ON a.id_sample=b.id", $con);
          $r1 = mysqli_fetch_array($sql1);*/
          ?>
          <h3>0<?php /*echo $r1[jml];*/ ?></h3>

          <p>Data MPC</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
        <a href="?p=Monitoring" class="small-box-footer">
          More info <i class="fa fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-red">
        <div class="inner">
          <?php
          $sql = mysqli_query($con,"SELECT count(*) as jml,DATE_FORMAT(now(),'%Y') as thn FROM tbl_monitoring a 
                              INNER JOIN tbl_sample b ON a.id_sample=b.id
                              WHERE DATE_FORMAT(tgl_monitor,'%Y')=DATE_FORMAT(now(),'%Y')");
          $r = mysqli_fetch_array($sql);
          ?>
          <h3><?php echo $r['jml']; ?></h3>

          <p>MPC Tahun <?php echo $r['thn']; ?></p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>
        <a href="?p=Monitoring" class="small-box-footer">
          More info <i class="fa fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>
  </div>
  <!-- END 4 Kotak Dashboard -->
  <!--<div class="row" style="margin-top: 10px;" id="table_matching">
    <div class="col-md-12">
      <div class="box">
        <figure class="highcharts-figure">
          <div id="container"></div>
        </figure>
      </div>
    </div>
  </div>-->

  <!-- ////////////////////////////////////////////////////////////////////// ASSET ////////////////////////////////////////////////////////////////////// -->
  <script src="plugins/highcharts/code/highcharts.js"></script>
  <script src="plugins/highcharts/code/highcharts-3d.js"></script>
  <script src="plugins/highcharts/code/modules/exporting.js"></script>
  <script src="plugins/highcharts/code/modules/export-data.js"></script>
  <script>
    $(function() {
      $('#container').highcharts({
        chart: {
          height: 180 * 66,
          type: 'bar'
        },
        title: {
          text: 'Schedule Pencelupan, Relaxing & Scouring ➞ Preset'
        },
        subtitle: {
          text: 'Source: <a href="https://10.0.0.10/dye-itti">DYE-ITTI</a>'
        },
        xAxis: {
          categories: '<?php print_r($data_mesin); ?>',
          title: {
            text: null
          }
        },
        yAxis: {
          min: 0,
          title: {
            text: 'Satuan Besaran dalama Kilogram',
            align: 'high'
          },
          labels: {
            overflow: 'justify'
          }
        },
        tooltip: {
          valueSuffix: ' KG'
        },
        plotOptions: {
          bar: {
            dataLabels: {
              enabled: true
            }
          }
        },
        legend: {
          layout: 'vertical',
          align: 'right',
          verticalAlign: 'top',
          x: -40,
          y: 80,
          floating: true,
          borderWidth: 1,
          backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
          shadow: true
        },
        credits: {
          enabled: false
        },
        tooltip: {
          formatter: function() {
            return `Qty: <b>` + this.point.y + ` Kg</b><br />
                    Order: <b>` + this.point.myData + `</b>`;
          }
        },
        series: [{
            name: 'Urutan ke-1',
            data: <?php print_r($data_one); ?>
          },
          {
            name: 'Urutan ke-2',
            data: <?php print_r($data_two); ?>
          },
          {
            name: 'Urutan ke-3',
            data: <?php print_r($data_tri); ?>
          },
          {
            name: 'Urutan ke-4',
            data: <?php print_r($data_four); ?>
          },
          {
            name: 'Urutan ke-5',
            data: <?php print_r($data_five); ?>
          },
          {
            name: 'Urutan ke-6',
            data: <?php print_r($data_six); ?>
          },
          {
            name: 'Urutan ke-7',
            data: <?php print_r($data_seven); ?>
          },
        ]
      }, function(chart) {
        var legend = chart.legend,
          initialY = legend.options.y;

        $(window).scroll(function() {
          legend.options.y = initialY + window.scrollY;
          legend.render();
        });
      });
    });
  </script>
</body>

</html>