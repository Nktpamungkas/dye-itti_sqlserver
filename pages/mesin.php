<?php
ini_set("error_reporting", 1);
session_start();
include "koneksi.php";

if (isset($_POST['delete'])) {
  $id = $_POST['delete_id'];

  // Mengamankan input terhadap SQL Injection
  $id = $id;

  // Mendapatkan informasi user dan IP
  $user_name = $_SESSION['user_id10']; // Misalnya username disimpan di session
  $user_ip = $_SERVER['REMOTE_ADDR']; // Mendapatkan IP user

  // Mendapatkan no_mesin dari tabel tbl_mesin
  $no_mesin_query = "SELECT * FROM db_dying.tbl_mesin WHERE id='$id'";
  $result = sqlsrv_query($con, $no_mesin_query);
  $row = sqlsrv_fetch_array($result);
  $no_mesin = $row['no_mesin'];
  $no_mesin_baru = $row['no_mesin_baru'];
  $no_mc_lama = $row['no_mc_lama'];


  // Query untuk menyimpan log penghapusan
  $log_sql = "INSERT INTO db_dying.tbl_delete_log_mesin (id, user_name, user_ip, no_mesin, no_mc_lama, no_mesin_baru) 
          VALUES ('$id', '$user_name', '$user_ip', '$no_mesin', '$no_mc_lama', '$no_mesin_baru')";

  if (sqlsrv_query($con, $log_sql)) {
    // Query untuk menghapus item
    $delete_sql = "DELETE FROM db_dying.tbl_mesin WHERE id='$id'";

    $stmt =  sqlsrv_query($con, $delete_sql);

    if ($stmt) {
      echo "<script>swal({
          title: 'Sukses',
          text: 'Data berhasil disimpan',
          type: 'success',
          }).then((result) => {
          if (result.value) {
          window.location='?p=Mesin';
          }
        });</script>";
    } else {
      echo "<script>swal({
        title: 'Gagal',
        text: 'Data gagal disimpan',
        type: 'error',
        }).then((result) => {
        if (result.value) {
        window.location='?p=Mesin'
        }
      });</script>";
    }
  } else {
    echo "<script>swal({
			title: 'Gagal',
			text: 'Data gagal disimpan',
			type: 'error',
			}).then((result) => {
			if (result.value) {
			window.location='?p=Mesin'
			}
		});</script>";
  }

  // Clean up statement resources
  sqlsrv_free_stmt($stmt);
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Mesin</title>
</head>

<body>
  <?php

  $data = sqlsrv_query($con, "SELECT * FROM db_dying.tbl_mesin ORDER BY no_mesin ASC");
  $no = 1;
  $col = 0;
  ?>
  <!-- <div class="container mt-4"> -->
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <a href="#" data-toggle="modal" data-target="#DataMesin" class="btn btn-success"><i class="fa fa-plus-circle"></i> Add</a>
        </div>
        <div class="box-body">
          <table width="100%" class="table table-bordered table-hover display" id="example2">
            <thead class="bg-blue">
              <tr align="center">
                <td width="3%"><strong>No</strong></td>
                <td width="12%"><strong>Nama Mesin</strong></td>
                <td width="12%"><strong>No. Mesin</strong></td>
                <td width="11%"><strong>L:R</strong></td>
                <td width="15%"><strong>Kapasitas</strong></td>
                <td width="37%"><strong>Note</strong></td>
                <td width="10%"><strong>Action</strong></td>
              </tr>
            </thead>
            <tbody>
              <?php
              $col = 0;
              while ($rowd = sqlsrv_fetch_array($data)) {
                $bgcolor = ($col++ & 1) ? 'gainsboro' : 'antiquewhite';
              ?>
                <tr align="center" bgcolor="<?php echo $bgcolor; ?>">
                  <td align="center"><?php echo $no; ?></td>
                  <td align="center"><?php echo $rowd['kode']; ?></td>
                  <td align="center"><?php echo $rowd['no_mesin']; ?></td>
                  <td align="center"><?php echo $rowd['l_r']; ?></td>
                  <td align="center"><?php echo $rowd['kapasitas']; ?></td>
                  <td align="center"><?php echo $rowd['ket']; ?></td>
                  <td align="center">
                    <a href="#" id='<?php echo $rowd['id'] ?>' class="btn btn-info mesin_edit"><i class="fa fa-edit"></i> </a>
                    <?php
                    // Hanya tampilkan tombol delete untuk pengguna Lukman dan Andri
                    if ($_SESSION['user_id10'] == 'lukman' || $_SESSION['user_id10'] == 'andri' || $_SESSION['user_id10'] == 'dit') {
                    ?>
                      <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal<?php echo $rowd['id']; ?>"><i class="fa fa-trash"></i></button>
                    <?php
                    }
                    ?>

                  </td>
                </tr>
                <?php
                $no++;
                ?>
                <!-- Modal Delete -->
                <div class="modal fade" id="deleteModal<?php echo $rowd['id']; ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?php echo $rowd['id']; ?>" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel<?php echo $rowd['id']; ?>">Confirm Delete</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        Are you sure you want to delete this item?
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <form method="post" action="">
                          <input type="hidden" name="delete_id" value="<?php echo $rowd['id']; ?>">
                          <button type="submit" class="btn btn-danger" name="delete">Delete</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              <?php } ?>
            </tbody>
          </table>
          <div class="modal fade modal-super-scaled" id="DataMesin">
            <div class="modal-dialog ">
              <div class="modal-content">
                <form class="form-horizontal" name="modal_popup" data-toggle="validator" method="post" action="?p=simpan_mesin" enctype="multipart/form-data">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Data Mesin</h4>
                  </div>
                  <div class="modal-body">
                    <div class="form-group">
                      <label for="kode" class="col-md-3 control-label">Nama Mesin</label>
                      <div class="col-md-3">
                        <input type="text" class="form-control" id="kode" name="kode" required>
                        <span class="help-block with-errors"></span>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="no_mesin" class="col-md-3 control-label">No Mesin</label>
                      <div class="col-md-3">
                        <input type="text" class="form-control" id="no_mesin" name="no_mesin" required>
                        <span class="help-block with-errors"></span>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="l_r" class="col-md-3 control-label">L:R</label>
                      <div class="col-md-3">
                        <input type="text" class="form-control" id="l_r" name="l_r" required>
                        <span class="help-block with-errors"></span>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="kap" class="col-md-3 control-label">Kapasitas</label>
                      <div class="col-md-3">
                        <input type="text" class="form-control" id="kap" name="kap" required>
                        <span class="help-block with-errors"></span>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="sts" class="col-md-3 control-label">Note</label>
                      <div class="col-md-6">
                        <textarea name="note" class="form-control" id="note"></textarea>
                        <span class="help-block with-errors"></span>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                  </div>
                </form>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
          <!-- Modal Popup untuk Edit-->
          <div id="MesinEdit" class="modal fade modal-3d-slit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> </div>
        </div>
      </div>
    </div>
  </div>
  <!-- </div> -->
  </div>
</body>

</html>