<?php
ini_set("error_reporting", 1);
session_start();
include("../koneksi.php");
  $modal_id=$_GET['id'];
	$modal=sqlsrv_query($con,"SELECT * FROM db_dying.tbl_hasilcelup WHERE id='$modal_id' ");
while($r=sqlsrv_fetch_array($modal)){
?>
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
            <form class="form-horizontal" name="modal_popup" data-toggle="validator" method="post" action="?p=edit_shift1" enctype="multipart/form-data">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Shift</h4>
              </div>
              <div class="modal-body">
                  <input type="hidden" id="id" name="id" value="<?php echo $r['id'];?>">
				  <div class="form-group">
                  <label for="gshift" class="col-md-5 control-label">Group Shift</label>
                  <div class="col-md-4">
                  <select name="gshift" class="form-control" id="gshift">
							  	<option value="">Pilih</option>
					  			<option value="A" <?php if($r['g_shift']=="A"){ echo "SELECTED";}?>>A</option>
					  			<option value="B" <?php if($r['g_shift']=="B"){ echo "SELECTED";}?>>B</option>
					  			<option value="C" <?php if($r['g_shift']=="C"){ echo "SELECTED";}?>>C</option>
				  </select>
                  <span class="help-block with-errors"></span>
                  </div>
                  </div>
				  <div class="form-group">
                  <label for="shift" class="col-md-5 control-label">Shift</label>
                  <div class="col-md-4">
                  <select name="shift" class="form-control" id="shift">
							  	<option value="">Pilih</option>
					  			<option value="1" <?php if($r['shift']=="1"){ echo "SELECTED";}?>>1</option>
					  			<option value="2" <?php if($r['shift']=="2"){ echo "SELECTED";}?>>2</option>
					  			<option value="3" <?php if($r['shift']=="3"){ echo "SELECTED";}?>>3</option>
				  </select>
                  <span class="help-block with-errors"></span>
                  </div>
                  </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" >Save</button>
              </div>
            </form>
            </div>
            <!-- /.modal-content -->
  </div>
          <!-- /.modal-dialog -->
          <?php } ?>
