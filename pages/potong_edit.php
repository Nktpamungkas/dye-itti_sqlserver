<?php
ini_set("error_reporting", 1);
session_start();
include("../koneksi.php");
    $modal_id=$_GET['id'];
	$modal=sqlsrv_query($con,"SELECT * FROM db_dying.tbl_potongcelup WHERE id='$modal_id' ");
while($r=sqlsrv_fetch_array($modal)){
?>
<script>
	function aktif(){
		if(document.forms['modal_popup']['sts_warna'].value == "OK"){
		document.modal_popup.ket.setAttribute("disabled",true);
		document.modal_popup.ket.removeAttribute("required");		
		document.modal_popup.ket.value="";
		document.modal_popup.disposisi.setAttribute("disabled",true);
		document.modal_popup.disposisi.removeAttribute("required");		
		document.modal_popup.disposisi.value="";	
		}
		else{
		document.modal_popup.ket.removeAttribute("disabled");
		document.modal_popup.ket.setAttribute("required",true);	
		document.modal_popup.disposisi.removeAttribute("disabled");
		document.modal_popup.disposisi.setAttribute("required",true);		
		}
	}</script>
          <div class="modal-dialog">
            <div class="modal-content">
            <form class="form-horizontal" name="modal_popup" data-toggle="validator" method="post" action="?p=edit_potong" enctype="multipart/form-data">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Potong Celup</h4>
              </div>
              <div class="modal-body">
                  <input type="hidden" id="id" name="id" value="<?php echo $r['id'];?>">
				  <div class="form-group">
                  <label for="sts_warna" class="col-md-4 control-label">Status Warna</label>
                  <div class="col-md-3">
                  <select name="sts_warna" class="form-control" id="sts_warna" onChange="aktif();">
                  <option value="">Pilih</option>
                  <option value="OK" <?php if (isset($r['comment_warna']) && $r['comment_warna'] == "OK") {
                    echo "SELECTED";} ?>>OK</option>
                  <option value="Tolak Basah" <?php if (isset($r['comment_warna']) && $r['comment_warna'] == "Tolak Basah") {
                    echo "SELECTED";} ?>>Tolak Basah</option>
				  </select>
                  <span class="help-block with-errors"></span>
                  </div>
                  </div>
                  <div class="form-group">
                  <label for="ket" class="col-md-4 control-label">Tolak Basah</label>
                  <div class="col-md-3">
                  <select name="ket" class="form-control" id="ket" disabled>
							  	<option value="">Pilih</option>
					  			<option value="Tolak Basah BW" <?php if (isset($r['ket']) && $r['ket'] == "Tolak Basah BW") {
                    echo "SELECTED";
                  } ?>>BW</option>
					  			<option value="Tolak Basah Luntur"<?php if (isset($r['ket']) && $r['ket'] == "Tolak Basah Luntur") {
                    echo "SELECTED";
                  } ?>>Luntur</option>
					  			<option value="Tolak Basah BW+Luntur"<?php if (isset($r['ket']) && $r['ket'] == "Tolak Basah BW+Luntur") {
                    echo "SELECTED";
                  } ?>>BW+Luntur</option>
					  			<option value="Tolak Basah Kena Warna"<?php if (isset($r['ket']) && $r['ket'] == "Tolak Basah Kena Warna") {
                    echo "SELECTED";
                  } ?>>Kena Warna</option>
					  			<option value="Tolak Basah Belang"<?php if (isset($r['ket']) && $r['ket'] == "Tolak Basah Belang") {
                    echo "SELECTED";
                  } ?>>Belang</option>
				  </select>
                  <span class="help-block with-errors"></span>
                  </div>
                  </div>
				  <div class="form-group">
                  <label for="acc" class="col-md-4 control-label">Acc Warna</label>
                  <div class="col-md-5">
				  <input class="form-control" name="acc" value="<?php if ($r['acc']!= NULL or $r['acc'] != "") {
            echo $r['acc'];
          } echo NULL; ?>">	  
                  <!--<select name="acc" class="form-control">
							  	<option value="">Pilih</option>
					  			<option value="-">-</option>
							  <?php 
							  //$sqlKap=sqlsrv_query($con,"SELECT nama FROM db_dying.tbl_staff WHERE jabatan='SPV' or jabatan='Asst. Manager' or jabatan='Manager' or jabatan='Senior Manager' or jabatan='DMF' ORDER BY nama ASC");
							  //while($rK=sqlsrv_fetch_array($sqlKap)){
							  ?>
								  <option value="<?php //echo $rK['nama']; ?>"><?php //echo $rK['nama']; ?></option>
							 <?php //} ?>	  
					  </select>-->
                  <span class="help-block with-errors"></span>
                  </div>
                  </div>
				  <div class="form-group">
                  <label for="dispo" class="col-md-4 control-label">Disposisi</label>
                  <div class="col-md-5">
                  <input class="form-control" name="disposisi" value="<?php if ($r['disposisi'] != NULL or $r['disposisi'] != "") {
                    echo $r['disposisi'];
                  }
                  echo NULL; ?>" id="disposisi" disabled>
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
