<?PHP
	ini_set("error_reporting", 1);
	session_start();
	include "koneksi.php";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Schedule</title>
</head>
<style>
	blink {
		animation: 2s linear infinite condemned_blink_effect;
	}

	@keyframes condemned_blink_effect {
		0% {
			visibility: hidden;
		}
		50% {
			visibility: hidden;
		}
		100% {
			visibility: visible;
		}
	}
</style>

<body>
	<?php
	$data = mysqli_query($con, "SELECT
										id,
										GROUP_CONCAT( lot SEPARATOR '/' ) AS lot,
										if(COUNT(lot)>1,'Gabung Kartu','') as ket_kartu,
										if(COUNT(lot)>1,CONCAT('(',COUNT(lot),'kk',')'),'') as kk,
										no_mesin,
										no_urut,
										nodemand,
										buyer,
										langganan,
										no_order,
										no_item,
										no_hanger,
										no_resep,
										nokk,
										jenis_kain,
										warna,
										no_warna,
										sum(rol) as rol,
										sum(bruto) as bruto,
										proses,
										ket_status,
										ket_kain,
										tgl_delivery,
										suffix,
										suffix2,
										high_temp
									FROM
										tbl_schedule 
									WHERE
										`status` = 'antri mesin' or `status` = 'sedang jalan' 
									GROUP BY
										no_mesin,
										no_urut 
									ORDER BY
										no_mesin ASC,no_urut ASC");
	$no = 1;
	$n = 1;
	$c = 0;
	?>
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<a href="?p=Form-Schedule" class="btn btn-success <?php if ($_SESSION['lvl_id10'] == "3") {
																			echo "disabled";
																		} ?>"><i class="fa fa-plus-circle"></i> Tambah</a>
					<!--	
						<a href="?p=Form-Schedule-Manual" class="btn btn-warning"><i class="fa fa-plus-circle"></i> Tambah Manual</a>
						<a href="pages/cetak/cetak_schedule.php" class="btn btn-danger pull-right" target="_blank"><i class="fa fa-print"></i> Cetak</a>	
					-->
					<a href="#" data-toggle="modal" data-target="#PrintHalaman" class="btn btn-danger pull-right"><i class="fa fa-print"></i> Cetak</a>
				</div>
				<div class="box-body">
					<table id="example1" class="table table-bordered table-hover table-striped" width="100%">
						<thead class="bg-blue">
							<tr>
								<th width="47">
									<div align="center">Mesin</div>
								</th>
								<th width="26">
									<div align="center">No.</div>
								</th>
								<th width="26">
									<div align="center">No. Demand</div>
								</th>
								<th width="165">
									<div align="center">Pelanggan</div>
								</th>
								<th width="121">
									<div align="center">No. Order</div>
								</th>
								<th width="121">
									<div align="center">No. Item</div>
								</th>
								<th width="125">
									<div align="center">Jenis Kain</div>
								</th>
								<th width="88">
									<div align="center">Warna</div>
								</th>
								<th width="85">
									<div align="center">No Warna</div>
								</th>
								<th width="85">
									<div align="center">Suffix</div>
								</th>
								<th width="85">
									<div align="center">Suffix 2</div>
								</th>
								<th width="40">
									<div align="center">Lot</div>
								</th>
								<th width="86">
									<div align="center">Delivery</div>
								</th>
								<th width="48">
									<div align="center">Rol</div>
								</th>
								<th width="50">
									<div align="center">Kg</div>
								</th>
								<th width="71">
									<div align="center">Proses</div>
								</th>
								<th width="90">
									<div align="center">Keterangan</div>
								</th>
								<th width="98">
									<div align="center">Action</div>
								</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$col = 0;
								while ($rowd = mysqli_fetch_array($data)) {
									$bgcolor = ($col++ & 1) ? 'gainsboro' : 'antiquewhite';
									$qCek = mysqli_query($con, "SELECT id as idb FROM tbl_montemp WHERE id_schedule='$rowd[id]' LIMIT 1");
									$rCEk = mysqli_fetch_array($qCek);
							?>
								<tr bgcolor="<?php echo $bgcolor; ?>">
									<td align="center"><a href="#" id='<?php echo $rowd['no_mesin']; ?>' class="edit_status_mesin <?php if ($_SESSION['lvl_id10'] == "3") {
																																		echo "disabled";
																																	} ?>"><?php echo $rowd['no_mesin']; ?></a></td>
									<td align="center"><?php echo $rowd['no_urut']; ?></td>
									<td align="center"><?php echo $rowd['nodemand']; ?></td>
									<td><?php echo $rowd['langganan'] . "/" . $rowd['buyer']; ?></td>
									<td align="center"><?php echo $rowd['no_order']; ?></td>
									<td align="center"><?php echo $rowd['no_hanger']; ?></td>
									<td><?php echo $rowd['jenis_kain']; ?></td>
									<td align="center"><?php echo $rowd['warna']; ?></td>
									<td align="center"><?php echo $rowd['no_warna']; ?></td>
									<td align="center"><?= $rowd['suffix']; ?></td>
									<td align="center"><?= $rowd['suffix2']; ?></td>
									<td align="center"><a href="#"><?php echo $rowd['lot']; ?></a></td>
									<td align="center"><?php echo $rowd['tgl_delivery']; ?></td>
									<td align="center"><?php echo $rowd['rol'] . $rowd['kk']; ?></td>
									<td align="center"><?php echo $rowd['bruto']; ?></td>
									<td>
										<?php echo $rowd['proses']; ?><br>
										<?php if($rowd['high_temp'] == 1){ echo "<blink style='color: red;'><b>High Temperature</b></blink>"; } ?>
									</td>
									<td>
										<?php echo $rowd['ket_status']; ?>  - <?php echo $rowd['ket_kain']; ?><br>
										<i><?php echo $rowd['nokk']; ?></i><br>
										<i><a href="#" id='<?php echo $rowd['id']; ?>' class="resep"><?php echo $rowd['no_resep']; ?></a></i><br>
										<a href="#" id='<?php echo $rowd['id']; ?>' class="detail_kartu">
											<span class="label label-danger"><?php echo $rowd['ket_kartu']; ?></span>
										</a>
									</td>
									<td align="center">
										<div class="btn-group">
											<a href="#" id='<?php echo $rowd['id']; ?>' class="btn btn-xs btn-info schedule_edit <?php if ($_SESSION['lvl_id10'] == "3") {
																																		echo "disabled";
																																	} ?>"><i class="fa fa-edit"></i> </a>
											<a href="#" onclick="confirm_del('?p=sch_hapus&id=<?php echo $rowd['id'] ?>');" class="btn btn-xs btn-danger <?php if ($_SESSION['lvl_id10'] == "3" or $rCEk['idb'] != "") {
																																								echo "disabled";
																																							} ?>"><i class="fa fa-trash"></i> </a>
											<a href="#" class="btn btn-warning btn-xs" onclick="confirm_selesai('?p=sch_selesai&id=<?php echo $rowd['id'] ?>');"><i class="fa fa-flag-checkered" data-toggle="tooltip" data-placement="top" title="Selesai"></i> </a>

											<?php if($rowd['high_temp'] == 1) : ?>
												<a href="#" class="btn btn-primary btn-xs" onclick="delete_high_temp('?p=delete_high_temp&id=<?= $rowd['id'] ?>');"><i class="fa fa-exclamation-triangle" data-toggle="tooltip" data-placement="top" title="Delete High Temperature"></i></a>
											<?php else : ?>
												<a href="#" class="btn btn-danger btn-xs" onclick="confirm_high_temp('?p=high_temp&id=<?= $rowd['id'] ?>');"><i class="fa fa-exclamation-triangle" data-toggle="tooltip" data-placement="top" title="High Temperature"></i></a>
											<?php endif; ?>
										</div>
									</td>
								</tr>
							<?php
								$no++;
							} ?>
						</tbody>
						<tfoot class="bg-red">
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade modal-super-scaled" id="PrintHalaman">
		<div class="modal-dialog ">
			<div class="modal-content">
				<form class="form-horizontal" name="modal_popup" data-toggle="validator" method="post" action="" enctype="multipart/form-data">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Cetak Schedule Per Halaman</h4>
					</div>
					<div class="modal-body">
						<a href="pages/cetak/cetak_schedule_p1.php" class="btn btn-danger" target="_blank"><i class="fa fa-print"></i> Page 1</a>
						<a href="pages/cetak/cetak_schedule_p2.php" class="btn btn-danger" target="_blank"><i class="fa fa-print"></i> Page 2</a>
						<a href="pages/cetak/cetak_schedule_p3.php" class="btn btn-danger" target="_blank"><i class="fa fa-print"></i> Page 3</a>
						<a href="pages/cetak/cetak_schedule_p4.php" class="btn btn-danger" target="_blank"><i class="fa fa-print"></i> Page 4</a>
						<a href="pages/cetak/cetak_schedule_p5.php" class="btn btn-danger" target="_blank"><i class="fa fa-print"></i> Page 5</a><br><br>
						<a href="pages/cetak/cetak_schedule_p6.php" class="btn btn-success" target="_blank"><i class="fa fa-print"></i> Page 6</a>
						<a href="pages/cetak/cetak_schedule_p7.php" class="btn btn-success" target="_blank"><i class="fa fa-print"></i> Page 7</a>
						<a href="pages/cetak/cetak_schedule_p8.php" class="btn btn-success" target="_blank"><i class="fa fa-print"></i> Page 8</a>
						<a href="pages/cetak/cetak_schedule_p9.php" class="btn btn-success" target="_blank"><i class="fa fa-print"></i> Page 9</a>
						<a href="pages/cetak/cetak_schedule_p10.php" class="btn btn-success" target="_blank"><i class="fa fa-print"></i> Page 10</a><br><br>
						<a href="pages/cetak/cetak_schedule_p11.php" class="btn btn-primary" target="_blank"><i class="fa fa-print"></i> Page 11</a>
						<a href="pages/cetak/cetak_schedule_p12.php" class="btn btn-primary" target="_blank"><i class="fa fa-print"></i> Page 12</a>
						<a href="pages/cetak/cetak_schedule_p13.php" class="btn btn-primary" target="_blank"><i class="fa fa-print"></i> Page 13</a>
						<a href="pages/cetak/cetak_schedule_p14.php" class="btn btn-primary" target="_blank"><i class="fa fa-print"></i> Page 14</a>
						<a href="pages/cetak/cetak_schedule_p15.php" class="btn btn-primary" target="_blank"><i class="fa fa-print"></i> Page 15</a>
						<br><br>
						<a href="pages/cetak/cetak_schedule_p16.php" class="btn btn-info" target="_blank"><i class="fa fa-print"></i> Page 16</a>
						<a href="pages/cetak/cetak_schedule_p17.php" class="btn btn-info" target="_blank"><i class="fa fa-print"></i> Page 17</a><br><br>
						<!-- <a href="pages/cetak/cetak_schedule.php" class="btn btn-warning" target="_blank"><i class="fa fa-print"></i> All Page</a>  -->
						<a href="http://10.0.5.178/dye-itti/pages/cetak/cetak_schedule.php" class="btn btn-warning" target="_blank"><i class="fa fa-print"></i> All Page</a> 
						<a href="pages/cetak/schedule-celup-excel.php" class="btn btn-success" target="_blank"><i class="fa fa-file-excel-o"></i> All Page Excel</a>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
					</div>
				</form>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- Modal Popup untuk delete-->
	<div class="modal fade" id="delSchedule" tabindex="-1">
		<div class="modal-dialog modal-sm">
			<div class="modal-content" style="margin-top:100px;">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" style="text-align:center;">Are you sure to delete this information ?</h4>
				</div>

				<div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
					<a href="#" class="btn btn-danger" id="del_link">Delete</a>
					<button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal Popup untuk Selesai-->
	<div class="modal fade" id="selesaiSchedule" tabindex="-1">
		<div class="modal-dialog modal-sm">
			<div class="modal-content" style="margin-top:100px;">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" style="text-align:center;">Are you sure to Finish this Schedule ?</h4>
				</div>

				<div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
					<a href="#" class="btn btn-danger" id="selesai_link">Yes</a>
					<button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
				</div>
			</div>
		</div>
	</div>
	
	<!-- Modal Popup untuk High Temperature-->
	<div class="modal fade" id="HighTemperature" tabindex="-1">
		<div class="modal-dialog modal-sm">
			<div class="modal-content" style="margin-top:100px;">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" style="text-align:center;">Are you sure to High Temperature this Schedule ?</h4>
				</div>

				<div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
					<a href="#" class="btn btn-danger" id="yes_high_temp">Yes</a>
					<button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
				</div>
			</div>
		</div>
	</div>
	
	<!-- Modal Popup untuk Delete High Temperature-->
	<div class="modal fade" id="DeleteHighTemperature" tabindex="-1">
		<div class="modal-dialog modal-sm">
			<div class="modal-content" style="margin-top:100px;">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" style="text-align:center;">Are you sure to Delete High Temperature this Schedule ?</h4>
				</div>

				<div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
					<a href="#" class="btn btn-danger" id="delete_high_temp">Yes</a>
					<button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
				</div>
			</div>
		</div>
	</div>

	<div id="ScheduleEdit" class="modal fade modal-3d-slit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	</div>
	<div id="EditStatusMesin" class="modal fade modal-3d-slit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	</div>
	<div id="Resep" class="modal fade modal-3d-slit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	</div>
	<div id="DetailKartu" class="modal fade modal-3d-slit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	</div>
</body>

</html>
<script type="text/javascript">
	function confirm_del(delete_url) {
		$('#delSchedule').modal('show', {
			backdrop: 'static'
		});
		document.getElementById('del_link').setAttribute('href', delete_url);
	}

	function confirm_selesai(selesai_url) {
		$('#selesaiSchedule').modal('show', {
			backdrop: 'static'
		});
		document.getElementById('selesai_link').setAttribute('href', selesai_url);
	}
	
	function confirm_high_temp(selesai_url) {
		$('#HighTemperature').modal('show', {
			backdrop: 'static'
		});
		document.getElementById('yes_high_temp').setAttribute('href', selesai_url);
	}
	
	function delete_high_temp(selesai_url) {
		$('#DeleteHighTemperature').modal('show', {
			backdrop: 'static'
		});
		document.getElementById('delete_high_temp').setAttribute('href', selesai_url);
	}
</script>