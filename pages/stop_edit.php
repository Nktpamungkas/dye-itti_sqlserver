<?php
    ini_set("error_reporting", 1);
    session_start();
    include("../koneksi.php");
    $modal_id = $_GET['id'];
    $modal = mysqli_query($con, "SELECT
                                    *,
                                    DATE_FORMAT( tgl_stop, '%Y-%m-%d' ) AS tglS,
                                    DATE_FORMAT( tgl_stop, '%H:%i' ) AS jamS,
                                    DATE_FORMAT( tgl_mulai, '%Y-%m-%d' ) AS tglM,
                                    DATE_FORMAT( tgl_mulai, '%H:%i' ) AS jamM,
                                    DATE_FORMAT( tgl_stop2, '%Y-%m-%d' ) AS tglS2,
                                    DATE_FORMAT( tgl_stop2, '%H:%i' ) AS jamS2,
                                    DATE_FORMAT( tgl_mulai2, '%Y-%m-%d' ) AS tglM2,
                                    DATE_FORMAT( tgl_mulai2, '%H:%i' ) AS jamM2,
                                    DATE_FORMAT( tgl_stop3, '%Y-%m-%d' ) AS tglS3,
                                    DATE_FORMAT( tgl_stop3, '%H:%i' ) AS jamS3,
                                    DATE_FORMAT( tgl_mulai3, '%Y-%m-%d' ) AS tglM3,
                                    DATE_FORMAT( tgl_mulai3, '%H:%i' ) AS jamM3,
                                    DATE_FORMAT( tgl_stop4, '%Y-%m-%d' ) AS tglS4,
                                    DATE_FORMAT( tgl_stop4, '%H:%i' ) AS jamS4,
                                    DATE_FORMAT( tgl_mulai4, '%Y-%m-%d' ) AS tglM4,
                                    DATE_FORMAT( tgl_mulai4, '%H:%i' ) AS jamM4
                                FROM
                                    `tbl_montemp` 
                                WHERE
                                    id = '$modal_id'");
    while ($r = mysqli_fetch_array($modal)) {
        $qLama = mysqli_query($con, "SELECT
                                        TIME_FORMAT( timediff( b.tgl_target, now()), '%H:%i' ) AS lama,
                                        b.id 
                                    FROM
                                        tbl_schedule a
                                        LEFT JOIN tbl_montemp b ON a.id = b.id_schedule 
                                    WHERE
                                        b.id = '$modal_id' 
                                        AND b.STATUS = 'sedang jalan' 
                                    ORDER BY
                                        a.no_urut ASC");
        $dLama = mysqli_fetch_array($qLama);
?>
    <style>
        /* Gaya untuk judul */
        .title {
            text-align: center;
            /* Pusatkan teks */
            margin-bottom: 20px;
            /* Ruang di bawah judul */
        }

        /* Gaya untuk garis horizontal */
        .hr-style {
            display: flex;
            /* Menggunakan flexbox */
            align-items: center;
            /* Pusatkan vertikal */
        }

        /* Gaya untuk garis horizontal dalam baris */
        .hr-line {
            flex-grow: 1;
            /* Biarkan garis horizontal memperluas seluruh lebar */
            border-top: 1px solid black;
            /* Garis horizontal */
        }

        /* Gaya untuk teks di tengah garis horizontal */
        .hr-text {
            padding: 0 10px;
            /* Ruang di sekitar teks */
        }
    </style>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form class="form-horizontal" name="modal_popup" data-toggle="validator" method="post" action="?p=edit_stop" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">
                        <center>Edit Stop - Start Mesin</center>
                    </h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id" name="id" value="<?php echo $r['id']; ?>">
                    <input type="hidden" id="sisa_waktu" name="sisa_waktu" value="<?php echo $dLama['lama']; ?>">

                    <!-- KODE STOP MESIN 1 -->
                    <div class="hr-style">
                        <div class="hr-line"></div>
                        <div class="hr-text">Kode Stop Mesin 1</div>
                        <div class="hr-line"></div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="mulaism" class="col-sm-3 control-label">Mulai Stop Mesin</label>
                        <div class="col-sm-3">
                            <div class="input-group">
                                <input type="text" class="form-control timepicker" name="jam_stop" placeholder="00:00" value="<?= $r['jamS']; ?>">
                                <div class="input-group-addon">
                                    <i class="fa fa-clock-o"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="input-group date">
                                <div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>
                                <!-- <input name="tgl_stop" type="text" class="form-control pull-right" id="datepicker3" max="2023-11-21" placeholder="0000-00-00" value="<?php echo $r['tglS']; ?>" /> -->
                                <input name="tgl_stop" type="date" class="form-control pull-right" max="<?= Date('Y-m-d'); ?>" placeholder="0000-00-00" value="<?php echo $r['tglS']; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="selesaism" class="col-sm-3 control-label">Selesai Stop Mesin</label>
                        <div class="col-sm-3">
                            <div class="input-group">
                                <input type="text" class="form-control timepicker" name="jam_mulai" placeholder="00:00" value="<?php echo $r['jamM']; ?>">
                                <div class="input-group-addon">
                                    <i class="fa fa-clock-o"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="input-group date">
                                <div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>
                                <!-- <input name="tgl_mulai" type="text" class="form-control pull-right" id="datepicker"  placeholder="0000-00-00" value="<?php echo $r['tglM']; ?>" /> -->
                                <input name="tgl_mulai" type="date" class="form-control pull-right" max="<?= Date('Y-m-d'); ?>" placeholder="0000-00-00" value="<?php echo $r['tglM']; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="multi" class="col-sm-3 control-label">Keterangan Stop Mesin</label>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <select class="form-control" name="ket_stopmesin">
                                    <option value="" disabled selected>-</option>
                                    <?php $q_ket_stopmesin      = mysqli_query($con, "SELECT * FROM tbl_ket_stopmesin ORDER BY id ASC"); ?>
                                    <?php while ($row_ket_stopmesin  = mysqli_fetch_array($q_ket_stopmesin)) { ?>
                                        <option value="<?= $row_ket_stopmesin['ket_stopmesin']; ?>" <?php if($r['ket_stopmesin'] == $row_ket_stopmesin['ket_stopmesin']) ?>><?= $row_ket_stopmesin['ket_stopmesin']; ?></option>
                                    <?php } ?>
                                </select>
                                <span class="input-group-btn"><a target="_blank" href="?p=tambah_ketstopmesin" class="btn btn-default">...</a></span>
                            </div>
                        </div>
                    </div>

                    <!-- KODE STOP MESIN 2 -->
                    <div class="hr-style">
                        <div class="hr-line"></div>
                        <div class="hr-text">Kode Stop Mesin 2</div>
                        <div class="hr-line"></div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="mulaism" class="col-sm-3 control-label">Mulai Stop Mesin</label>
                        <div class="col-sm-3">
                            <div class="input-group">
                                <input type="text" class="form-control timepicker" name="jam_stop2" placeholder="00:00" value="<?php echo $r['jamS2']; ?>">
                                <div class="input-group-addon">
                                    <i class="fa fa-clock-o"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="input-group date">
                                <div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>
                                <input name="tgl_stop2" type="date" class="form-control pull-right" max="<?= Date('Y-m-d'); ?>" placeholder="0000-00-00" value="<?php echo $r['tglS2']; ?>" />
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="selesaism" class="col-sm-3 control-label">Selesai Stop Mesin</label>
                        <div class="col-sm-3">
                            <div class="input-group">
                                <input type="text" class="form-control timepicker" name="jam_mulai2" placeholder="00:00" value="<?php echo $r['jamM2']; ?>">
                                <div class="input-group-addon">
                                    <i class="fa fa-clock-o"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="input-group date">
                                <div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>
                                <input name="tgl_mulai2" type="date" class="form-control pull-right" max="<?= Date('Y-m-d'); ?>" placeholder="0000-00-00" value="<?php echo $r['tglM2']; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="multi" class="col-sm-3 control-label">Keterangan Stop Mesin</label>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <select class="form-control" name="ket_stopmesin2">
                                    <option value="" disabled selected>-</option>
                                    <?php $q_ket_stopmesin      = mysqli_query($con, "SELECT * FROM tbl_ket_stopmesin ORDER BY id ASC"); ?>
                                    <?php while ($row_ket_stopmesin  = mysqli_fetch_array($q_ket_stopmesin)) { ?>
                                        <option value="<?= $row_ket_stopmesin['ket_stopmesin']; ?>" <?php if($r['ket_stopmesin2'] == $row_ket_stopmesin['ket_stopmesin']) ?>><?= $row_ket_stopmesin['ket_stopmesin']; ?></option>
                                    <?php } ?>
                                </select>
                                <span class="input-group-btn"><a target="_blank" href="?p=tambah_ketstopmesin" class="btn btn-default">...</a></span>
                            </div>
                        </div>
                    </div>

                    <!-- KODE STOP MESIN 3 -->
                    <div class="hr-style">
                        <div class="hr-line"></div>
                        <div class="hr-text">Kode Stop Mesin 3</div>
                        <div class="hr-line"></div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="mulaism" class="col-sm-3 control-label">Mulai Stop Mesin</label>
                        <div class="col-sm-3">
                            <div class="input-group">
                                <input type="text" class="form-control timepicker" name="jam_stop3" placeholder="00:00" value="<?php echo $r['jamS3']; ?>">
                                <div class="input-group-addon">
                                    <i class="fa fa-clock-o"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="input-group date">
                                <div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>
                                <input name="tgl_stop3" type="date" class="form-control pull-right" max="<?= Date('Y-m-d'); ?>" placeholder="0000-00-00" value="<?php echo $r['tglS3']; ?>" />
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="selesaism" class="col-sm-3 control-label">Selesai Stop Mesin</label>
                        <div class="col-sm-3">
                            <div class="input-group">
                                <input type="text" class="form-control timepicker" name="jam_mulai3" placeholder="00:00" value="<?php echo $r['jamM3']; ?>">
                                <div class="input-group-addon">
                                    <i class="fa fa-clock-o"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="input-group date">
                                <div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>
                                <input name="tgl_mulai3" type="date" class="form-control pull-right" max="<?= Date('Y-m-d'); ?>" placeholder="0000-00-00" value="<?php echo $r['tglM3']; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="multi" class="col-sm-3 control-label">Keterangan Stop Mesin</label>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <select class="form-control" name="ket_stopmesin3">
                                    <option value="" disabled selected>-</option>
                                    <?php $q_ket_stopmesin      = mysqli_query($con, "SELECT * FROM tbl_ket_stopmesin ORDER BY id ASC"); ?>
                                    <?php while ($row_ket_stopmesin  = mysqli_fetch_array($q_ket_stopmesin)) { ?>
                                        <option value="<?= $row_ket_stopmesin['ket_stopmesin']; ?>" <?php if($r['ket_stopmesin3'] == $row_ket_stopmesin['ket_stopmesin']) ?>><?= $row_ket_stopmesin['ket_stopmesin']; ?></option>
                                    <?php } ?>
                                </select>
                                <span class="input-group-btn"><a target="_blank" href="?p=tambah_ketstopmesin" class="btn btn-default">...</a></span>
                            </div>
                        </div>
                    </div>

                    <!-- KODE STOP MESIN 4 -->
                    <div class="hr-style">
                        <div class="hr-line"></div>
                        <div class="hr-text">Kode Stop Mesin 4</div>
                        <div class="hr-line"></div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="mulaism" class="col-sm-3 control-label">Mulai Stop Mesin</label>
                        <div class="col-sm-3">
                            <div class="input-group">
                                <input type="text" class="form-control timepicker" name="jam_stop4" placeholder="00:00" value="<?php echo $r['jamS4']; ?>">
                                <div class="input-group-addon">
                                    <i class="fa fa-clock-o"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="input-group date">
                                <div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>
                                <input name="tgl_stop4" type="date" class="form-control pull-right" max="<?= Date('Y-m-d'); ?>" placeholder="0000-00-00" value="<?php echo $r['tglS4']; ?>" />
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="selesaism" class="col-sm-3 control-label">Selesai Stop Mesin</label>
                        <div class="col-sm-3">
                            <div class="input-group">
                                <input type="text" class="form-control timepicker" name="jam_mulai4" placeholder="00:00" value="<?php echo $r['jamM4']; ?>">
                                <div class="input-group-addon">
                                    <i class="fa fa-clock-o"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="input-group date">
                                <div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>
                                <input name="tgl_mulai4" type="date" class="form-control pull-right" max="<?= Date('Y-m-d'); ?>" placeholder="0000-00-00" value="<?php echo $r['tglM4']; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="multi" class="col-sm-3 control-label">Keterangan Stop Mesin</label>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <select class="form-control" name="ket_stopmesin4">
                                    <option value="" disabled selected>-</option>
                                    <?php $q_ket_stopmesin      = mysqli_query($con, "SELECT * FROM tbl_ket_stopmesin ORDER BY id ASC"); ?>
                                    <?php while ($row_ket_stopmesin  = mysqli_fetch_array($q_ket_stopmesin)) { ?>
                                        <option value="<?= $row_ket_stopmesin['ket_stopmesin']; ?>" <?php if($r['ket_stopmesin4'] == $row_ket_stopmesin['ket_stopmesin']) ?>><?= $row_ket_stopmesin['ket_stopmesin']; ?></option>
                                    <?php } ?>
                                </select>
                                <span class="input-group-btn"><a target="_blank" href="?p=tambah_ketstopmesin" class="btn btn-default">...</a></span>
                            </div>
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
<?php } ?>
<script>
    //Date picker
    $('#datepicker').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd',
        todayHighlight: true,
    });
    //Date picker
    $('#datepicker3').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd',
        todayHighlight: true,
    });
    //Timepicker
    $('#timepicker').timepicker({
        showInputs: false,
    });

    $(function() {
        //Timepicker
        $('.timepicker').timepicker({
            minuteStep: 1,
            showInputs: true,
            showMeridian: false,
            defaultTime: false

        })
    })
</script>