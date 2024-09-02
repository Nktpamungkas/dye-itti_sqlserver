<?php
ini_set("error_reporting", 1);
session_start();
include("../koneksi.php");

function cek($value) {
  if($value == NULL || $value == "") {
      return NULL;
  }

  if($value instanceof DateTime) {
      if($value->format('Y-m-d') != '1900-01-01') {
          return $value->format('Y-m-d');
      } else {
          return NULL;
      }
  }

  if($value == '1900-01-01') {
      return NULL;
  }

  if($value == '.00') {
    return NULL;
  }

  return $value;
}
?>
<div class="modal-dialog modal-lg" style="width: 95%">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title" id="myModalLabel">No Mesin a :
        <?php echo $_GET['id']; ?>
      </h4>
    </div>
    <div class="modal-body table-responsive">
      <table id="tbl3" class="table table-bordered table-hover display" width="100%">
        <thead>
          <tr>
            <th width="2%">No</th>
            <th width="5%">No KK</th>
            <th width="10%">No Urut</th>
            <th width="7%">Costumer</th>
            <th width="7%">Buyer</th>
            <th width="7%">Order</th>
            <th width="7%">Jenis Kain</th>
            <th width="7%">Hanger</th>
            <th width="7%">Warna</th>
            <th width="7%">Lot</th>
            <th width="7%">Roll</th>
            <th width="7%">Qty</th>
            <th width="7%">Proses</th>
            <th width="7%">Tgl Delivery</th>
            <th width="11%">Ket</th>
            <th width="10%">Status</th>
          </tr>
        </thead>
        <tbody>
          <?php


          $qry = sqlsrv_query($con, "SELECT
                                        *,
                                        CASE
                                            WHEN DATEDIFF(day, GETDATE(), tgl_delivery) > 0 THEN 'Urgent'
                                            WHEN DATEDIFF(day, GETDATE(), tgl_delivery) > -4 THEN 'Potensi Delay'
                                            ELSE ''
                                        END AS sts,
                                        CASE
                                            WHEN b.tgl_stop IS NOT NULL AND b.tgl_mulai IS NULL THEN 'stop mesin'
                                            ELSE a.status
                                        END AS status_aktual,
                                        b.ket_stopmesin
                                    FROM
                                        db_dying.tbl_schedule a
                                    LEFT JOIN db_dying.tbl_montemp b ON b.id_schedule = a.id
                                    WHERE
                                        a.no_mesin = '$_GET[id]'
                                        AND a.status <> 'selesai'
                                    ORDER BY
                                        a.no_urut ASC;
                                    ");
          $no = 1;

          $c = 0;
          while ($rowd = sqlsrv_fetch_array($qry)) {
            $bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99';

          ?>
            <tr>
              <td>
                <?php echo $no; ?>
              </td>
              <td>
                <?php echo cek($rowd['nokk']); ?>
              </td>
              <td><?php echo cek($rowd['no_urut']); ?></td>
              <td><?php echo cek($rowd['langganan']); ?></td>
              <td><?php echo cek($rowd['buyer']); ?></td>
              <td><?php echo cek($rowd['no_order']); ?></td>
              <td><?php echo cek($rowd['jenis_kain']); ?></td>
              <td><?php echo cek($rowd['no_hanger']); ?></td>
              <td><?php echo cek($rowd['warna']); ?></td>
              <td><?php echo cek($rowd['lot']); ?></td>
              <td><?php echo cek($rowd['rol']); ?></td>
              <td><?php echo cek($rowd['qty_order']); ?></td>
              <td><?php echo cek($rowd['proses']); ?></td>
              <td>
                <?php echo cek($rowd['tgl_delivery']); ?>
              </td>
              <td bgcolor="<?php echo $bg; ?>">
                <?php echo cek($rowd['ket_status']); ?>
                <br>
                <span class="label <?php if (cek($rowd['status_aktual']) == "sedang jalan") {
                                          echo "label-success";
                                        } elseif (cek($rowd['status_aktual']) == "antri mesin") {
                                          echo "label-primary";
                                        } else{
                                          echo "label-danger";
                                        }?>">
                  <?php echo cek($rowd['status_aktual']); ?>
                </span>
                <?php echo cek($rowd['ket_stopmesin']); ?>
              </td>
              <td bgcolor="<?php if (cek($rowd['sts']) == "Potensi Delay") {
                              echo " orange";
                            } else if (cek($rowd['sts']) == "Urgent") {
                              echo " red";
                            } ?>">
                <?php if (cek($rowd['sts']) != "") {
                  echo "<font color=white>$rowd[sts]</font>";
                } ?>
                <span class="label bg-abu"><?php echo $rowd['ket_kain']; ?></span>
              </td>
            </tr>
          <?php $no++;
          } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>
<script type="text/javascript">
  $(function() {
    $("#tbl3").dataTable();
  });
</script>