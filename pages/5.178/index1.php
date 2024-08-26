<?php
ini_set("error_reporting", 1);
session_start();
//include config
//require_once "waktu.php";
include_once('koneksi.php');
//include"koneksi.php";
//include_once ('tgl_indo.php');
?>



<?php
//set base constant
if (!isset($_SESSION['user_id10'])) {
?>
  <script>
    setTimeout("location.href='login'", 500);
  </script>
<?php
  die('Illegal Acces');
} elseif (!isset($_SESSION['pass_id10'])) {
?>
  <script>
    setTimeout("location.href='lockscreen'", 500);
  </script>
<?php
  die('Illegal Acces');
}

//request page
$page = isset($_GET['p']) ? $_GET['p'] : '';
$act  = isset($_GET['act']) ? $_GET['act'] : '';
$id   = isset($_GET['id']) ? $_GET['id'] : '';
$page = strtolower($page);
$iduser = $_SESSION['id10'];
?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="initial-scale = 1.0, maximum-scale = 1.0, user-scalable = no, width = device-width">
  <title>Dyeing |
    <?php if ($_GET['p'] != "") {
      echo ucwords($_GET['p']);
    } else {
      echo "Home";
    } ?>
  </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- toast CSS -->
  <link href="bower_components/toast-master/css/jquery.toast.css" rel="stylesheet">
  <!-- DataTables -->
  <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link href="bower_components/datatables.net-bs/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="plugins/timepicker/bootstrap-timepicker.min.css">

  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
  <link rel="stylesheet" href="dist/css/skins/skin-purple.min.css">
  <!-- Sweet Alert -->
  <link href="bower_components/sweetalert/sweetalert2.css" rel="stylesheet" type="text/css">
  <!-- Sweet Alert -->
  <script type="text/javascript" src="bower_components/sweetalert/sweetalert2.min.js"></script>
  <!-- Select2 -->
  <link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <!--
  <link rel="stylesheet"
        href="dist/css/font/font.css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  -->
  <link rel="icon" type="image/png" href="dist/img/ITTI_Logo index.ico">
  <!-- jQuery 3 -->
  <script src="bower_components/jquery/dist/jquery.min.js"></script>
  <style>
    .blink_me {
      animation: blinker 1s linear infinite;
    }

    .blink_me1 {
      animation: blinker 7s linear infinite;
    }

    .bulat {
      border-radius: 50%;
      /*box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);*/
    }

    .border-dashed {
      border: 3px dashed #083255;
    }

    .border-dashed-tujuan {
      border: 3px dashed #FF0007;
    }

    @keyframes blinker {
      50% {
        opacity: 0;
      }
    }

    body {
      font-family: Calibri, "sans-serif", "Courier New";
      /* "Calibri Light","serif" */
      font-style: normal;
    }
  </style>

</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->

<body class="hold-transition skin-purple sidebar-collapse fixed">

  <div class="wrapper">

    <!-- Main Header -->
    <header class="main-header ">

      <!-- Logo -->
      <a href="?p=Home" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>Dye</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Dye</b>ing</span>
      </a>

      <!-- Header Navbar -->
      <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
	<?php 
		  $qryNCP=mysqli_query($cond,"SELECT COUNT(*) as jml from tbl_ncp_qcf_new WHERE dept='DYE' AND ncp_in_dye='0'");
          $rNCP=mysqli_fetch_array($qryNCP);
	?>
          <!-- Notifications Menu -->
          <li class="dropdown notifications-menu">
            <!-- Menu toggle button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning"><?php echo $rNCP['jml']; ?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Ada <span class="label label-warning"><?php echo $rNCP['jml']; ?></span> NCP Baru</li>
              <li>
                <!-- Inner Menu: contains the notifications -->
                <ul class="menu">
				<?php $qryNCP1=mysqli_query($cond,"SELECT no_ncp_gabungan,nokk,nokk_salinan FROM tbl_ncp_qcf_new WHERE dept='DYE' AND ncp_in_dye='0' ");
                while ($rNCP1=mysqli_fetch_array($qryNCP1)) {
					if($rNCP1['nokk_salinan']!=""){ $nokkNCP=$rNCP1['nokk_salinan'];}else{ $nokkNCP=$rNCP1['nokk'];}
                ?>
                  <li><!-- start notification -->
                    <a href="index1.php?p=Form-NCP&manual=&nokk=&nokkncp=<?php echo $nokkNCP; ?>">
                      <i class="fa fa-file-text text-aqua"></i> <?php echo "No NCP: ".$rNCP1['no_ncp_gabungan']; ?><br><?php echo "KK NCP: ".$nokkNCP; ?>
                    </a>
                  </li>
                  <!-- end notification -->
					<?php } ?>
                </ul>
              </li>
              <li class="footer"><a href="index1.php?p=Form-NCP">Tampil Semua</a></li>
            </ul>
          </li>
			<?php $qryNCP2=mysqli_query($con,"SELECT COUNT(*) as jml from tbl_ncp_memo
			WHERE  (penyelesaian='' OR ISNULL(penyelesaian))");
      $rNCP2=mysqli_fetch_array($qryNCP2);
            ?>
          <!-- Tasks Menu -->
          <li class="dropdown tasks-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-info"><?php echo $rNCP2['jml'];?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Ada <span class="label label-primary"><?php echo $rNCP2['jml'];?></span> NCP sedang proses</li>
              <li>
                <!-- Inner menu: contains the tasks -->
                <ul class="menu">
				<?php $qryNCP3=mysqli_query($cond,"SELECT id,no_ncp_gabungan FROM tbl_ncp_qcf_new 
				WHERE NOT ISNULL(tgl_rencana) 
				AND dept='DYE'
				AND status='Belum OK'
				");
                while ($rNCP3=mysqli_fetch_array($qryNCP3)) {
          ?>
                  <li><!-- Task item -->
                    <a href="index1.php?p=Status-NCP-NEW&id=<?php echo $rNCP3['id']; ?>">
                      <!-- Task title and progress text -->
                      <h3>
                        <?php echo "No NCP: ".$rNCP3['no_ncp_gabungan'];?>
                        <small class="pull-right"><?php echo "50";?>%</small>
                      </h3>
                      <!-- The progress bar -->
                      <div class="progress xs">
                        <!-- Change the css width attribute to simulate progress -->
                        <div class="progress-bar <?php if($prsn=="100"){echo"bg-green";}else if(51>50){echo"bg-aqua";} ?> " style="width: <?php echo "50";?>%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only"><?php echo "50";?>% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
				<?php } ?>
                </ul>
              </li>
              <li class="footer">
                <a href="index1.php?p=Form-NCP">Tampil Semua</a>
              </li>
            </ul>
          </li>
		  <?php $qryNCP4=mysqli_query($cond,"SELECT COUNT(*) as jml from tbl_ncp_qcf_new 
		  WHERE ISNULL(akar_masalah) or akar_masalah='' or ISNULL(solusi_panjang) or solusi_panjang=''");
      $rNCP4=mysqli_fetch_array($qryNCP4);
            ?>
           <!-- Revisi Menu -->
          <li class="dropdown tasks-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa  fa-flag-checkered"></i>
              <span class="label label-danger"><?php echo $rNCP4['jml'];?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Ada <span class="label label-danger"><?php echo $rNCP4['jml'];?></span> NCP Belum di Analisa Masalah</li>
              <li>
                <!-- Inner menu: contains the tasks -->
                <ul class="menu">
				<?php $qryNCP5=mysqli_query($cond,"SELECT id,no_ncp_gabungan FROM tbl_ncp_qcf_new 
				WHERE (ISNULL(akar_masalah) or akar_masalah='' or ISNULL(solusi_panjang) or solusi_panjang='')
				AND dept='DYE'
				");
                while ($rNCP5=mysqli_fetch_array($qryNCP5)) {	?>
                  <li><!-- Task item -->
                    <a href="index1.php?p=Status-NCP-NEW&id=<?php echo $rNCP5['id']; ?>">
                      <!-- Task title and progress text -->
                      <h3>
                        <?php echo "No NCP: ".$rNCP5['no_ncp_gabungan']."";?>
                      </h3>
                    </a>
                  </li>
                  <!-- end task item -->
				<?php } ?>
                </ul>
              </li>
              <li class="footer">
                <a href="index1.php?p=Status-NCP-NEW">Tampil Semua</a>
              </li>
            </ul>
          </li>

            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!-- The user image in the navbar-->
                <img src="dist/img/<?php echo $_SESSION['foto10']; ?>.png" class="user-image" alt="User Image">
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span class="hidden-xs">
                  <?php echo strtoupper($_SESSION['user_id10']); ?></span>
              </a>
              <ul class="dropdown-menu">
                <!-- The user image in the menu -->
                <li class="user-header">
                  <img src="dist/img/<?php echo $_SESSION['foto10']; ?>.png" class="img-circle" alt="User Image">

                  <p>
                    <?php echo strtoupper($_SESSION['user_id10']); ?>
                  </p>
                </li>
                <!-- Menu Body -->
                <!-- <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div> -->
                <!-- /.row -->

			<!-- </li> -->
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-left">
                <a href="lockscreen" class="btn btn-default btn-flat">LockScreen</a>
              </div>
              <div class="pull-left">
                <a href="#" id="<?php echo $iduser; ?>" class="btn btn-default open_change_password">ChangePwd</a>
              </div>
              <div class="pull-right">
                <a href="logout" class="btn btn-default btn-flat">Sign out</a>
              </div>
            </li>
          </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <!-- <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li> -->
          </ul>
        </div>
      </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">

      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="dist/img/<?php echo $_SESSION['foto10']; ?>.png" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p>
              <?php echo strtoupper($_SESSION['user_id10']); ?>
            </p>
            <!-- Status -->
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          </div>
        </div>


        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">HEADER</li>
          <!-- Optionally, you can add icons to the links -->
          <li class="<?php if ($_GET['p'] == "Home" or $_GET['p'] == "") {
                        echo "active";
                      } ?>"><a href="?p=Home"><i class="fa fa-dashboard text-success"></i> <span>DashBoard</span></a></li>
          <li class="treeview <?php if ($_GET['p'] == "Schedule" or $_GET['p'] == "Schedule-Cek" or $_GET['p'] == "Status-Mesin" or $_GET['p'] == "Form-Schedule" or $_GET['p'] == "Form-Schedule-Manual" or $_GET['p'] == "Monitoring-Tempelan" or $_GET['p'] == "Hasil-Celup" or $_GET['p'] == "Potong-Celup" or $_GET['p'] == "Form-Celup" or $_GET['p'] == "Form-Potong" or $_GET['p'] == "Form-Monitoring" or $_GET['p'] == "Form-Monitoring-Washing" or $_GET['p'] == "Masalah-Celupan" or $_GET['p'] == "Form-Masalah-Celupan" or $_GET['p'] == "Setting-Mesin" or $_GET['p'] == "Form-Setting-Mesin") {
                                echo "active";
                              } ?>">
            <a href="#"><i class="fa fa-gears text-primary"></i> <span>Dyeing</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="<?php if ($_GET['p'] == "Schedule" or $_GET['p'] == "Form-Schedule" or $_GET['p'] == "Form-Schedule-Manual") {
                            echo "active";
                          } ?>"><a href="?p=Schedule"><i class="fa fa-calendar text-warning"></i> <span>Schedule</span></a></li>
              <li class="<?php if ($_GET['p'] == "Status-Mesin") {
                            echo "active";
                          } ?>"><a href="?p=Status-Mesin"><i class="fa fa-line-chart text-danger"></i> <span>Status Mesin</span></a></li>
			  <li class=""><a href="pages/lot-keluar-full.php" target="_blank"><i class="fa fa-line-chart text-warning"></i> <span>Lot Keluar</span></a></li>	
              <li class="<?php if ($_GET['p'] == "Monitoring-Tempelan" or $_GET['p'] == "Form-Monitoring" or $_GET['p'] == "Form-Monitoring-Washing") {
                            echo "active";
                          } ?>"><a href="?p=Monitoring-Tempelan"><i class="fa fa-desktop text-success"></i> <span>Monitoring-Tempelan</span></a></li>
              <li class="<?php if ($_GET['p'] == "Hasil-Celup" or $_GET['p'] == "Form-Celup") {
                            echo "active";
                          } ?>"><a href="?p=Hasil-Celup"><i class="fa fa-square text-info"></i> <span>Hasil-Celup</span></a></li>
              <!--<li class="<?php if ($_GET['p'] == "Potong-Celup" or $_GET['p'] == "Form-Potong") {
                                echo "active";
                              } ?>"><a href="?p=Potong-Celup"><i class="fa fa-cut text-warning"></i> <span>Potong-Celup</span></a></li> -->
              <li class="<?php if ($_GET['p'] == "Schedule-Cek") {
                            echo "active";
                          } ?>"><a href="?p=Schedule-Cek"><i class="fa fa-calendar text-danger"></i> <span>Cek Schedule</span></a></li>
              <li class="<?php if ($_GET['p'] == "Masalah-Celupan" or $_GET['p'] == "Form-Masalah-Celupan") {
                            echo "active";
                          } ?>"><a href="?p=Masalah-Celupan"><i class="fa fa-cut text-primary"></i> <span>Masalah-Celupan</span></a></li>
              <li class="<?php if ($_GET['p'] == "Setting-Mesin" or $_GET['p'] == "Form-Setting-Mesin") {
                            echo "active";
                          } ?>"><a href="?p=Setting-Mesin"><i class="fa fa-gear text-success"></i> <span>Setting-Mesin</span></a></li>
            </ul>
          </li>
          <li class="treeview <?php if ($_GET['p'] == "lap-hasil-celup" or $_GET['p'] == "lap-harian-produksi" or $_GET['p'] == "lap-monitoring-tempelan" or $_GET['p'] == "lap-schedule" or $_GET['p'] == "lap-potong-celup" or $_GET['p'] == "lap-waktu-proses" or $_GET['p'] == "lap-total-point") {
                                echo "active";
                              } ?>">
            <a href="#"><i class="fa fa-line-chart text-danger"></i> <span>Report</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="<?php if ($_GET['p'] == "lap-schedule") {
                            echo "active";
                          } ?>"><a href="?p=lap-schedule"><i class="fa fa-columns text-green"></i> <span>Lap Schedule</span></a></li>
              <li class="<?php if ($_GET['p'] == "lap-monitoring-tempelan") {
                            echo "active";
                          } ?>"><a href="?p=lap-monitoring-tempelan"><i class="fa fa-columns text-yellow"></i> <span>Lap Monitoring Tempelan</span></a></li>
              <li class="<?php if ($_GET['p'] == "lap-hasil-celup") {
                            echo "active";
                          } ?>"><a href="?p=lap-hasil-celup"><i class="fa fa-columns text-blue"></i> <span>Lap Hasil Celup</span></a></li>
              <li class="<?php if ($_GET['p'] == "lap-harian-produksi") {
                            echo "active";
                          } ?>"><a href="?p=lap-harian-produksi"><i class="fa fa-columns text-red"></i> <span>Lap Harian Produksi</span></a></li>
              <li class="<?php if ($_GET['p'] == "lap-potong-celup") {
                            echo "active";
                          } ?>"><a href="?p=lap-potong-celup"><i class="fa fa-columns text-lime"></i> <span>Lap Potong Celup</span></a></li>
              <li class="<?php if ($_GET['p'] == "lap-waktu-proses") {
                            echo "active";
                          } ?>"><a href="?p=lap-waktu-proses"><i class="fa fa-columns text-lime"></i> <span>Lap Waktu Proses</span></a></li>
              <li class="<?php if ($_GET['p'] == "lap-total-point") {
                            echo "active";
                          } ?>"><a href="?p=lap-total-point"><i class="fa fa-columns text-aqua"></i> <span>Lap Total Point</span></a></li>
            </ul>
          </li>
		  <?php if ($_SESSION['lvl_id10'] != "4") {  ?>	
		  <li class="treeview <?php if ($_GET['p'] == "Input-DataTest-Proses" or $_GET['p'] == "Lap-DataTest-Proses" or $_GET['p'] == "Status-Data-Test") {
                                  echo "active";
                                } ?>">
              <a href="#"><i class="fa fa-file text-green"></i> <span>Data Test Proses</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class="<?php if ($_GET['p'] == "Input-DataTest-Proses") {
                              echo "active";
                            } ?>"><a href="?p=Input-DataTest-Proses"><i class="fa fa-columns text-yellow"></i> <span>Input Data Test Proses</span></a></li>
                <li class="<?php if ($_GET['p'] == "Lap-DataTest-Proses") {
                              echo "active";
                            } ?>"><a href="?p=Lap-DataTest-Proses"><i class="fa fa-columns text-blue"></i> <span>Laporan Data Test Proses</span></a></li>
                <li class="<?php if ($_GET['p'] == "Status-Data-Test") {
                              echo "active";
                            } ?>"><a href="?p=Status-Data-Test"><i class="fa fa-columns text-green"></i> <span>Status Data Test Proses</span></a></li>
              </ul>
            </li>
		  <?php } ?>	
          <?php if ($_SESSION['lvl_id10'] == "1" or strtoupper($_SESSION['user_id10']) == "EKO") {
          ?>
            <li class="treeview <?php if ($_GET['p'] == "Input-Bon" or $_GET['p'] == "Lap-Bon" or $_GET['p'] == "input-bon-kain") {
                                  echo "active";
                                } ?>">
              <a href="#"><i class="fa fa-clone text-aqua"></i> <span>Ganti Kain</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class="<?php if ($_GET['p'] == "Input-Bon") {
                              echo "active";
                            } ?>"><a href="?p=Input-Bon"><i class="fa fa-columns text-yellow"></i> <span>Input Bon</span></a></li>
                <li class="<?php if ($_GET['p'] == "Lap-Bon" or $_GET['p'] == "input-bon-kain") {
                              echo "active";
                            } ?>"><a href="?p=Lap-Bon"><i class="fa fa-columns text-blue"></i> <span>Laporan Bon</span></a></li>
              </ul>
            </li>
			<?php if (strtoupper($_SESSION['user_id10']) == "ANDRI" or strtoupper($_SESSION['user_id10']) == "USMANAS") {
          ?>
            <li class="treeview <?php if ($_GET['p'] == "Input-Dokumen" or $_GET['p'] == "Lap-Dokumen") {
                                  echo "active";
                                } ?>">
              <a href="#"><i class="fa fa-file text-red"></i> <span>Dokumen</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class="<?php if ($_GET['p'] == "Input-Dokumen") {
                              echo "active";
                            } ?>"><a href="?p=Input-Dokumen"><i class="fa fa-columns text-yellow"></i> <span>Input Dokumen</span></a></li>
                <li class="<?php if ($_GET['p'] == "Lap-Dokumen") {
                              echo "active";
                            } ?>"><a href="?p=Lap-Dokumen"><i class="fa fa-columns text-blue"></i> <span>Laporan</span></a></li>
              </ul>
            </li>
			<?php } ?>
			<li class="treeview <?php if ($_GET['p'] == "Input-Salah-Resep" or $_GET['p'] == "Lap-Salah-Resep") {
                                  echo "active";
                                } ?>">
              <a href="#"><i class="fa fa-file text-yellow"></i> <span>Salah Resep</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class="<?php if ($_GET['p'] == "Input-Salah-Resep") {
                              echo "active";
                            } ?>"><a href="?p=Input-Salah-Resep"><i class="fa fa-columns text-yellow"></i> <span>Input Salah Resep</span></a></li>
                <li class="<?php if ($_GET['p'] == "Lap-Salah-Resep") {
                              echo "active";
                            } ?>"><a href="?p=Lap-Salah-Resep"><i class="fa fa-columns text-blue"></i> <span>Laporan Salah Resep</span></a></li>
              </ul>
            </li>			
            <li class="treeview <?php if ($_GET['p'] == "Lap-NCP" or $_GET['p'] == "Form-NCP" or $_GET['p'] == "Lap-NCPMemo") {
                                  echo "active";
                                } ?>">
              <a href="#"><i class="fa fa-file text-blue"></i> <span>NCP</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>				
                </span>
              </a>
              <ul class="treeview-menu">
				<li class="<?php if ($_GET['p'] == "Form-NCP") {
                              echo "active";
                            } ?>"><a href="?p=Form-NCP"><i class="fa fa-columns text-yellow"></i> <span>Input NCP-Memo</span>
					<span class="pull-right-container">
              <small class="label pull-right bg-green blink_me">new</small>
            </span></a></li> 
			    <li class="<?php if ($_GET['p'] == "Lap-NCPMemo") {
                              echo "active";
                            } ?>"><a href="?p=Lap-NCPMemo"><i class="fa fa-columns text-green"></i> <span>Laporan NCP-Memo</span>
					<span class="pull-right-container">
              <small class="label pull-right bg-green blink_me">new</small>
            </span></a></li> 	
				<li class="<?php if($_GET['p']=="Status-NCP-New"){echo"active";} ?>"><a href="?p=Status-NCP-New"><i class="fa fa-area-chart text-navy"></i> <span>Status NCP</span> <span class="pull-right-container">
              <small class="label pull-right bg-green blink_me">new</small>
            </span></a></li>
			  <li class="<?php if ($_GET['p'] == "Lap-Harian-NCP") {
                              echo "active";
                            } ?>"><a href="?p=Lap-Harian-NCP"><i class="fa fa-columns text-green"></i> <span>Laporan Harian NCP</span></a></li>	  
                <li class="<?php if ($_GET['p'] == "Lap-NCP") {
                              echo "active";
                            } ?>"><a href="?p=Lap-NCP"><i class="fa fa-columns text-blue"></i> <span>Laporan NCP</span></a></li>                
              </ul>
            </li>
            <li class="treeview <?php if ($_GET['p'] == "Setting-Resep-Dye") {
                                  echo "active";
                                } ?>">
              <a href="#"><i class="fa fa-file text-white"></i> <span>Setting Resep Dye</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class="<?php if ($_GET['p'] == "Setting-Resep-Dye") {
                              echo "active";
                            } ?>"><a href="?p=Setting-Resep-Dye"><i class="fa fa-gear text-yellow"></i> <span>Setting Resep Dyeing</span></a></li>                
              </ul>
            </li>
            <li class="treeview <?php if ($_GET['p'] == "Mesin" or $_GET['p'] == "Std-Target" or $_GET['p'] == "Line-News" or $_GET['p'] == "Staff" or $_GET['p'] == "User") {
                                  echo "active";
                                } ?>">
              <a href="#"><i class="fa fa-edit text-purple"></i> <span>Master</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class="<?php if ($_GET['p'] == "Mesin") {
                              echo "active";
                            } ?>"><a href="?p=Mesin"><i class="fa fa-columns text-blue"></i> <span>Mesin</span></a></li>
                <li class="<?php if ($_GET['p'] == "Std-Target") {
                              echo "active";
                            } ?>"><a href="?p=Std-Target"><i class="fa fa-columns text-maroon"></i> <span>Std-Target</span></a></li>
                <li class="<?php if ($_GET['p'] == "Staff") {
                              echo "active";
                            } ?>"><a href="?p=Staff"><i class="fa fa-users text-green"></i> <span>Staff</span></a></li>
                <li class="<?php if ($_GET['p'] == "Line-News") {
                              echo "active";
                            } ?>"><a href="?p=Line-News"><i class="fa fa-newspaper-o text-red"></i> <span>Line News</span></a></li>
                <li class="<?php if ($_GET['p'] == "User") {
                              echo "active";
                            } ?>"><a href="?p=User"><i class="fa fa-user text-aqua"></i> <span>User</span></a></li>
              </ul>
            </li>
          <?php
          } ?>
			<?php if ($_SESSION['lvl_id10'] == "4") {  ?>
            <li class="treeview <?php if ($_GET['p'] == "Lap-NCP" or $_GET['p'] == "Form-NCP" or $_GET['p'] == "Lap-NCPMemo") {
                                  echo "active";
                                } ?>">
              <a href="#"><i class="fa fa-file text-blue"></i> <span>NCP</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>				
                </span>
              </a>
              <ul class="treeview-menu">
				<li class="<?php if ($_GET['p'] == "Form-NCP") {
                              echo "active";
                            } ?>"><a href="?p=Form-NCP"><i class="fa fa-columns text-yellow"></i> <span>Input NCP-Memo</span>
					<span class="pull-right-container">
              <small class="label pull-right bg-green blink_me">new</small>
            </span></a></li> 
			    <li class="<?php if ($_GET['p'] == "Lap-NCPMemo") {
                              echo "active";
                            } ?>"><a href="?p=Lap-NCPMemo"><i class="fa fa-columns text-green"></i> <span>Laporan NCP-Memo</span>
					<span class="pull-right-container">
              <small class="label pull-right bg-green blink_me">new</small>
            </span></a></li> 	
				<li class="<?php if($_GET['p']=="Status-NCP-New"){echo"active";} ?>"><a href="?p=Status-NCP-New"><i class="fa fa-area-chart text-navy"></i> <span>Status NCP</span> <span class="pull-right-container">
              <small class="label pull-right bg-green blink_me">new</small>
            </span></a></li>
			  <li class="<?php if ($_GET['p'] == "Lap-Harian-NCP") {
                              echo "active";
                            } ?>"><a href="?p=Lap-Harian-NCP"><i class="fa fa-columns text-green"></i> <span>Laporan Harian NCP</span></a></li>	  
                <li class="<?php if ($_GET['p'] == "Lap-NCP") {
                              echo "active";
                            } ?>"><a href="?p=Lap-NCP"><i class="fa fa-columns text-blue"></i> <span>Laporan NCP</span></a></li>                
              </ul>
            </li>
			<?php } ?>
			<?php if ($_SESSION['lvl_id10'] == "4") {  ?>
            <li class="treeview <?php if ($_GET['p'] == "Setting-Resep-Dye") {
                                  echo "active";
                                } ?>">
              <a href="#"><i class="fa fa-file text-white"></i> <span>Setting Resep Dye</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class="<?php if ($_GET['p'] == "Setting-Resep-Dye") {
                              echo "active";
                            } ?>"><a href="?p=Setting-Resep-Dye"><i class="fa fa-gear text-yellow"></i> <span>Setting Resep Dyeing</span></a></li>                
              </ul>
            </li>
			<?php } ?>
        </ul>
        <!-- /.sidebar-menu -->
      </section>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->


      <!-- Main content -->
      <section class="content container-fluid">
        <?php
        if (!empty($page) and !empty($act)) {
          $files = 'pages/' . $page . '.' . $act . '.php';
        } elseif (!empty($page)) {
          $files = 'pages/' . $page . '.php';
        } else {
          $files = 'pages/home.php';
        }

        if (file_exists($files)) {
          include_once($files);
        } else {
          include_once("blank.php");
        }
        ?>

      </section>
      <div id="ChangePassword" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      </div>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
      <!-- To the right -->
      <div class="pull-right hidden-xs">
        DIT
      </div>
      <!-- Default to the left -->
      <strong>Copyright &copy; 2023 <a href="#">DIT ITTI</a>.</strong> All rights reserved.
    </footer>

    <!-- Control Sidebar -->
    <!--
  <aside class="control-sidebar control-sidebar-dark">

    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>

    <div class="tab-content">

      <div class="tab-pane active" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:;">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
        </ul>


        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:;">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="pull-right-container">
                    <span class="label label-danger pull-right">70%</span>
                  </span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
        </ul>


      </div>

      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>

      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>

        </form>
      </div>

    </div>
  </aside>
  -->
    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED JS SCRIPTS -->


  <!-- Bootstrap 3.3.7 -->
  <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
  <!-- Select2 -->
  <script src="bower_components/select2/dist/js/select2.full.min.js"></script>
  <!-- DataTables -->
  <script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <!-- start - This is for export functionality only -->
  <script src="bower_components/datatables.net-bs/js/dataTables.buttons.min.js"></script>
  <script src="bower_components/datatables.net-bs/js/buttons.flash.min.js"></script>
  <script src="bower_components/datatables.net-bs/js/jszip.min.js"></script>
  <script src="bower_components/datatables.net-bs/js/pdfmake.min.js"></script>
  <script src="bower_components/datatables.net-bs/js/vfs_fonts.js"></script>
  <script src="bower_components/datatables.net-bs/js/buttons.html5.min.js"></script>
  <script src="bower_components/datatables.net-bs/js/buttons.print.min.js"></script>
  <!-- end - This is for export functionality only -->
  <!-- InputMask -->
  <script src="plugins/input-mask/jquery.inputmask.js"></script>
  <script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
  <script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>
  <!-- bootstrap datepicker -->
  <script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
  <!-- bootstrap time picker -->
  <script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>
  <!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
  <script src="bower_components/toast-master/js/jquery.toast.js"></script>
  <script>
    //Date picker
    $('#datepicker').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd',
        todayHighlight: true,
      }),
      //Date picker
      $('#datepicker1').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd',
        todayHighlight: true,
      }),
      //Date picker
      $('#datepicker2').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd',
        todayHighlight: true,
      }),
      //Date picker
      $('#datepicker3').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd',
        todayHighlight: true,
      });
    //Timepicker
    $('#timepicker').timepicker({
      showInputs: false
    })
  </script>
  <script>
    $(function() {

      $('#example1').DataTable({
        'scrollX': true,
        'scrollY': '350px',
        'paging': false,
        dom: 'Bfrtip',
        buttons: [
          'excel',
        ]


      });
      $('#example2').DataTable();
      $('#example3').DataTable({
        'scrollX': true,
        dom: 'Bfrtip',
        buttons: [
          'excel',
          {
            orientation: 'portrait',
            pageSize: 'LEGAL',
            extend: 'pdf',
            footer: true,
          },
        ]
      });
      $('#example4').DataTable({
        'paging': false,
      });
      $('#tblr1').DataTable({
        'paging': false,
        'ordering': false,
        'info': false,
        'searching': false
      });
      $('#tblr2').DataTable({
        'paging': false,
        'ordering': false,
        'info': false,
        'searching': false
      });
      $('#tblr3').DataTable({
        'paging': false,
        'ordering': false,
        'info': false,
        'searching': false
      });
      $('#tblr4').DataTable({
        'paging': false,
        'ordering': false,
        'info': false,
        'searching': false
      });
      $('#tblr5').DataTable({
        'paging': false,
        'ordering': false,
        'info': false,
        'searching': false
      });
      $('#tblr6').DataTable({
        'paging': false,
        'ordering': false,
        'info': false,
        'searching': false
      });
      $('#tblr7').DataTable({
        'paging': false,
        'ordering': false,
        'info': false,
        'searching': false
      });
      $('#tblr8').DataTable({
        'paging': false,
        'ordering': false,
        'info': false,
        'searching': false
      });
      $('#tblr9').DataTable({
        'paging': false,
        'ordering': false,
        'info': false,
        'searching': false
      });
      $('#tblr10').DataTable({
        'paging': false,
        'ordering': false,
        'info': false,
        'searching': false
      });
      $('#tblr11').DataTable({
        'paging': false,
        'ordering': false,
        'info': false,
        'searching': false
      });
      $('#tblr12').DataTable({
        'paging': false,
        'ordering': false,
        'info': false,
        'searching': false
      });
      $('#tblr13').DataTable()
      $('#tblr14').DataTable()
      $('#tblr15').DataTable()
      $('#tblr16').DataTable()
      $('#tblr17').DataTable()
      $('#tblr18').DataTable()
      $('#tblr19').DataTable()
      $('#tblr20').DataTable()

    })
  </script>
  <!-- Javascript untuk popup modal Edit-->
  <script type="text/javascript">
    $(document).ready(function() {

    });
    $(function() {
      //Initialize Select2 Elements
      $('.select2').select2()
    });
  </script>
  <script type="text/javascript">
    //            jika dipilih, PO akan masuk ke input dan modal di tutup
    $(document).on('click', '.pilih', function(e) {
      document.getElementById("no_po").value = $(this).attr('data-po');
      document.getElementById("no_po").focus();
      $('#myModal').modal('hide');
    });
    //            jika dipilih, BON akan masuk ke input dan modal di tutup
    $(document).on('click', '.pilih-bon', function(e) {
      document.getElementById("no_bon").value = $(this).attr('data-bon');
      document.getElementById("no_bon").focus();
      $('#myModal').modal('hide');
    });
    // jika dipilih, Kode Benang akan masuk ke input dan modal di tutup
    $(document).on('click', '.pilih-kd', function(e) {
      document.getElementById("kd").value = $(this).attr('data-kd');
      document.getElementById("kd").focus();
      $('#myModal').modal('hide');
    });
    $(document).on('click', '.mesin_edit', function(e) {
      var m = $(this).attr("id");
      $.ajax({
        url: "pages/mesin_edit.php",
        type: "GET",
        data: {
          id: m,
        },
        success: function(ajaxData) {
          $("#MesinEdit").html(ajaxData);
          $("#MesinEdit").modal('show', {
            backdrop: 'true'
          });
        }
      });
    });
    $(document).on('click', '.staff_edit', function(e) {
      var m = $(this).attr("id");
      $.ajax({
        url: "pages/staff_edit.php",
        type: "GET",
        data: {
          id: m,
        },
        success: function(ajaxData) {
          $("#StaffEdit").html(ajaxData);
          $("#StaffEdit").modal('show', {
            backdrop: 'true'
          });
        }
      });
    });
    $(document).on('click', '.potong_edit', function(e) {
      var m = $(this).attr("id");
      $.ajax({
        url: "pages/potong_edit.php",
        type: "GET",
        data: {
          id: m,
        },
        success: function(ajaxData) {
          $("#PotongEdit").html(ajaxData);
          $("#PotongEdit").modal('show', {
            backdrop: 'true'
          });
        }
      });
    });
    $(document).on('click', '.stop_edit', function(e) {
      var m = $(this).attr("id");
      $.ajax({
        url: "pages/stop_edit.php",
        type: "GET",
        data: {
          id: m,
        },
        success: function(ajaxData) {
          $("#StopMesin").html(ajaxData);
          $("#StopMesin").modal('show', {
            backdrop: 'true'
          });
        }
      });
    });
    $(document).on('click', '.edit_shift', function(e) {
      var m = $(this).attr("id");
      $.ajax({
        url: "pages/shift_edit.php",
        type: "GET",
        data: {
          id: m,
        },
        success: function(ajaxData) {
          $("#EditShift").html(ajaxData);
          $("#EditShift").modal('show', {
            backdrop: 'true'
          });
        }
      });
    });
    $(document).on('click', '.edit_stscelup', function(e) {
      var m = $(this).attr("id");
      $.ajax({
        url: "pages/stspro_edit.php",
        type: "GET",
        data: {
          id: m,
        },
        success: function(ajaxData) {
          $("#EditStsCelup").html(ajaxData);
          $("#EditStsCelup").modal('show', {
            backdrop: 'true'
          });
        }
      });
    });
    $(document).on('click', '.user_edit', function(e) {
      var m = $(this).attr("id");
      $.ajax({
        url: "pages/user_edit.php",
        type: "GET",
        data: {
          id: m,
        },
        success: function(ajaxData) {
          $("#UserEdit").html(ajaxData);
          $("#UserEdit").modal('show', {
            backdrop: 'true'
          });
        }
      });
    });
    $(document).on('click', '.news_edit', function(e) {
      var m = $(this).attr("id");
      $.ajax({
        url: "pages/news_edit.php",
        type: "GET",
        data: {
          id: m,
        },
        success: function(ajaxData) {
          $("#NewsEdit").html(ajaxData);
          $("#NewsEdit").modal('show', {
            backdrop: 'true'
          });
        }
      });
    });
    $(document).on('click', '.detail_status', function(e) {
      var m = $(this).attr("id");
      $.ajax({
        url: "pages/cek-status-mesin.php",
        type: "GET",
        data: {
          id: m,
        },
        success: function(ajaxData) {
          $("#CekDetailStatus").html(ajaxData);
          $("#CekDetailStatus").modal('show', {
            backdrop: 'true'
          });
        }
      });
    });
    $(document).on('click', '.edit_status_mesin', function(e) {
      var m = $(this).attr("id");
      $.ajax({
        url: "pages/edit-status-mesin.php",
        type: "GET",
        data: {
          id: m,
        },
        success: function(ajaxData) {
          $("#EditStatusMesin").html(ajaxData);
          $("#EditStatusMesin").modal('show', {
            backdrop: 'true'
          });
        }
      });
    });
    $(document).on('click', '.detail_kartu', function(e) {
      var m = $(this).attr("id");
      $.ajax({
        url: "pages/detail-kartu.php",
        type: "GET",
        data: {
          id: m,
        },
        success: function(ajaxData) {
          $("#DetailKartu").html(ajaxData);
          $("#DetailKartu").modal('show', {
            backdrop: 'true'
          });
        }
      });
    });
    $(document).on('click', '.schedule_edit', function(e) {
      var m = $(this).attr("id");
      $.ajax({
        url: "pages/schedule_edit.php",
        type: "GET",
        data: {
          id: m,
        },
        success: function(ajaxData) {
          $("#ScheduleEdit").html(ajaxData);
          $("#ScheduleEdit").modal('show', {
            backdrop: 'true'
          });
        }
      });
    });
	$(document).on('click', '.tambah_analisa', function(e) {
      var m = $(this).attr("id");
      $.ajax({
        url: "pages/tambah_analisa.php",
        type: "GET",
        data: {
          id: m,
        },
        success: function(ajaxData) {
          $("#TambahAnalisa").html(ajaxData);
          $("#TambahAnalisa").modal('show', {
            backdrop: 'true'
          });
        }
      });
    });
	$(document).on('click', '.analisa_masalah', function(e) {
      var m = $(this).attr("id");
      $.ajax({
        url: "pages/analisa_masalah.php",
        type: "GET",
        data: {
          id: m,
        },
        success: function(ajaxData) {
          $("#AnalisaMasalah").html(ajaxData);
          $("#AnalisaMasalah").modal('show', {
            backdrop: 'true'
          });
        }
      });
    });    
	$(document).on('click', '.tambah_analisa_new', function(e) {
      var m = $(this).attr("id");
      $.ajax({
        url: "pages/tambah_analisa_new.php",
        type: "GET",
        data: {
          id: m,
        },
        success: function(ajaxData) {
          $("#TambahAnalisaNew").html(ajaxData);
          $("#TambahAnalisaNew").modal('show', {
            backdrop: 'true'
          });
        }
      });
    });   
    $(document).on('click', '.schedule_edit1', function(e) {
      var m = $(this).attr("id");
      $.ajax({
        url: "pages/schedule_edit.php",
        type: "GET",
        data: {
          id: m,
        },
        success: function(ajaxData) {
          $("#ScheduleEdit1").html(ajaxData);
          $("#ScheduleEdit1").modal('show', {
            backdrop: 'true'
          });
        }
      });
    });
    $(document).on('click', '.resep', function(e) {
      var m = $(this).attr("id");
      $.ajax({
        url: "pages/resep.php",
        type: "GET",
        data: {
          id: m,
        },
        success: function(ajaxData) {
          $("#Resep").html(ajaxData);
          $("#Resep").modal('show', {
            backdrop: 'true'
          });
        }
      });
    });
    $(document).on('click', '.std_edit', function(e) {
      var m = $(this).attr("id");
      $.ajax({
        url: "pages/std_edit.php",
        type: "GET",
        data: {
          id: m,
        },
        success: function(ajaxData) {
          $("#StdEdit").html(ajaxData);
          $("#StdEdit").modal('show', {
            backdrop: 'true'
          });
        }
      });
    });
    $(document).on('click', '.shift_edit1', function(e) {
      var m = $(this).attr("id");
      $.ajax({
        url: "pages/shift1_edit.php",
        type: "GET",
        data: {
          id: m,
        },
        success: function(ajaxData) {
          $("#ShiftEdit1").html(ajaxData);
          $("#ShiftEdit1").modal('show', {
            backdrop: 'true'
          });
        }
      });
    });
	$(document).on('click', '.edit_sts_dok', function(e) {
      var m = $(this).attr("id");
      $.ajax({
        url: "pages/edit_sts_dok.php",
        type: "GET",
        data: {
          id: m,
        },
        success: function(ajaxData) {
          $("#EditStsDok").html(ajaxData);
          $("#EditStsDok").modal('show', {
            backdrop: 'true'
          });
        }
      });
    }); 
	$(document).on('click', '.tambah_inout', function(e) {
      var m = $(this).attr("id");
      $.ajax({
        url: "pages/tambah_inout.php",
        type: "GET",
        data: {
          id: m,
        },
        success: function(ajaxData) {
          $("#TambahInOut").html(ajaxData);
          $("#TambahInOut").modal('show', {
            backdrop: 'true'
          });
        }
      });
    });  
	$(document).on('click', '.detail_inout', function(e) {
      var m = $(this).attr("id");
      $.ajax({
        url: "pages/detail_inout.php",
        type: "GET",
        data: {
          id: m,
        },
        success: function(ajaxData) {
          $("#DetailInOut").html(ajaxData);
          $("#DetailInOut").modal('show', {
            backdrop: 'true'
          });
        }
      });
    });  
	$(document).on('click', '.dokumen_edit', function(e) {
      var m = $(this).attr("id");
      $.ajax({
        url: "pages/dokumen_edit.php",
        type: "GET",
        data: {
          id: m,
        },
        success: function(ajaxData) {
          $("#EditDok").html(ajaxData);
          $("#EditDok").modal('show', {
            backdrop: 'true'
          });
        }
      });
    }); 
	$(document).on('click', '.posisi_kk', function (e) {
  var m = $(this).attr("id");
    $.ajax({
       url: "pages/posisikk.php",
       type: "GET",
       data : {id: m,},
       success: function (ajaxData){
         $("#PosisiKK").html(ajaxData);
         $("#PosisiKK").modal('show',{backdrop: 'true'});
       }
     });
      });  
    $(document).on('click', '.open_change_password', function(e) {
      var m = $(this).attr("id");
      $.ajax({
        url: "pages/change_password.php",
        type: "GET",
        data: {
          id: m,
        },
        success: function(ajaxData) {
          $("#ChangePassword").html(ajaxData);
          $("#ChangePassword").modal('show', {
            backdrop: 'true'
          });
        }
      });
    });
    //            tabel lookup KO status terima
    $(function() {
      $("#lookup").dataTable();
    });
    $(function() {
      $("#lookup1").dataTable();
    });
    $(function() {
      $("#lookup2").dataTable();
    });
  </script>
  <script type="text/javascript">
    function bukaInfo() {
      $('#myModal').modal('show');
    }
    $(function() {
      //Timepicker

      $('.timepicker').timepicker({
        minuteStep: 1,
        showInputs: true,
        showMeridian: false,
        defaultTime: false

      })
      $('.timepicker1').timepicker({
        template: 'dropdown'
      })
    })
  </script>

</body>

</html>