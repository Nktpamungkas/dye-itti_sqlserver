<?php
// ini_set("error_reporting", 1);
session_start();
include("../koneksi.php");
$modal_id = $_GET['id'];
$modal = sqlsrv_query($con, "SELECT
                                    *
                                FROM
                                    db_dying.tbl_montemp 
                                WHERE
                                    id = '$modal_id'");
while ($r = sqlsrv_fetch_array($modal)) {
    //Inisiasi variable untuk tanggal mulai dan tanggal stop
    if ($r['tgl_stop'] != NULL or $r['tgl_stop'] != '') {
        $tglS = $r['tgl_stop']->format('Y-m-d');
    } else {
        $tglS = NULL;
    }
    if ($r['tgl_stop'] != NULL or $r['tgl_stop'] != '') {
        $jamS = $r['tgl_stop']->format('H:i:s');
    } else {
        $jamS = NULL;
    }
    if ($r['tgl_mulai'] != NULL or $r['tgl_mulai'] != '') {
        $tglM = $r['tgl_mulai']->format('Y-m-d');
    } else {
        $tglM = NULL;
    }
    if ($r['tgl_mulai'] != NULL or $r['tgl_mulai'] != '') {
        $jamM = $r['tgl_mulai']->format('H:i:s');
    } else {
        $jamM = NULL;
    }

    //Inisiasi variable untuk tanggal mulai2 dan tanggal stop2
    if ($r['tgl_stop2'] != NULL or $r['tgl_stop2'] != '') {
        $tglS2 = $r['tgl_stop2']->format('Y-m-d');
    } else {
        $tglS2 = NULL;
    }
    if ($r['tgl_stop2'] != NULL or $r['tgl_stop2'] != '') {
        $jamS2 = $r['tgl_stop2']->format('H:i:s');
    } else {
        $jamS2 = NULL;
    }
    if ($r['tgl_mulai2'] != NULL or $r['tgl_mulai2'] != '') {
        $tglM2 = $r['tgl_mulai2']->format('Y-m-d');
    } else {
        $tglM2 = NULL;
    }
    if ($r['tgl_mulai2'] != NULL or $r['tgl_mulai2'] != '') {
        $jamM2 = $r['tgl_mulai2']->format('H:i:s');
    } else {
        $jamM2 = NULL;
    }


    // Inisiasi variable untuk tanggal mulai3 dan tanggal stop3
    if ($r['tgl_stop3'] != NULL or $r['tgl_stop3'] != '') {
        $tglS3 = $r['tgl_stop3']->format('Y-m-d');
    } else {
        $tglS3 = NULL;
    }
    if ($r['tgl_stop3'] != NULL or $r['tgl_stop3'] != '') {
        $jamS3 = $r['tgl_stop3']->format('H:i:s');
    } else {
        $jamS3 = NULL;
    }
    if ($r['tgl_mulai3'] != NULL or $r['tgl_mulai3'] != '') {
        $tglM3 = $r['tgl_mulai3']->format('Y-m-d');
    } else {
        $tglM3 = NULL;
    }
    if ($r['tgl_mulai3'] != NULL or $r['tgl_mulai3'] != '') {
        $jamM3 = $r['tgl_mulai3']->format('H:i:s');
    } else {
        $jamM3 = NULL;
    }

    // Inisiasi variable untuk tanggal mulai4 dan tanggal stop4
    if ($r['tgl_stop4'] != NULL or $r['tgl_stop4'] != '') {
        $tglS4 = $r['tgl_stop4']->format('Y-m-d');
    } else {
        $tglS4 = NULL;
    }
    if ($r['tgl_stop4'] != NULL or $r['tgl_stop4'] != '') {
        $jamS4 = $r['tgl_stop4']->format('H:i:s');
    } else {
        $jamS4 = NULL;
    }
    if ($r['tgl_mulai4'] != NULL or $r['tgl_mulai4'] != '') {
        $tglM4 = $r['tgl_mulai4']->format('Y-m-d');
    } else {
        $tglM4 = NULL;
    }
    if ($r['tgl_mulai4'] != NULL or $r['tgl_mulai4'] != '') {
        $jamM4 = $r['tgl_mulai4']->format('H:i:s');
    } else {
        $jamM4 = NULL;
    }



    $qLama = sqlsrv_query($con, "SELECT
                                        DATEDIFF(minute, b.tgl_target, GETDATE()) AS lama,
                                        b.id 
                                    FROM
                                        db_dying.tbl_schedule a
                                    LEFT JOIN db_dying.tbl_montemp b ON a.id = b.id_schedule 
                                    WHERE
                                        b.id = '$modal_id' 
                                        AND b.STATUS = 'sedang jalan' 
                                    ORDER BY
                                        a.no_urut ASC");
    $dLama = sqlsrv_fetch_array($qLama);

    //Untuk mengubah menit menjadi Jam:menit
    if ($dLama['lama'] != NULL or $dLama['lama'] != '') {
         $totalMenit = $dLama['lama'];

    // Tandai jika nilai negatif
    $negatif = $totalMenit < 0;

    // Ambil nilai absolut dari menit
    $absMenit = abs($totalMenit);

    // Hitung jumlah jam dan menit
    $jam = floor($absMenit / 60);
    $menit = $absMenit % 60;

    // Format hasil sebagai Jam:Menit
    $lama = sprintf("%s%d:%02d", $negatif ? '-' : '', $jam, $menit);
    } else {
        $lama = NULL;
    }



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
            <form class="form-horizontal" name="modal_popup" data-toggle="validator" method="post" action="?p=edit_stop"
                enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">
                        <center>Edit Stop - Start Mesin</center>
                    </h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id" name="id" value="<?php echo $r['id']; ?>">
                    <input type="hidden" id="sisa_waktu" name="sisa_waktu" value="<?php echo $lama; ?>">

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
                                <input type="text" class="form-control timepicker" name="jam_stop" placeholder="00:00"
                                    value="<?php echo $jamS; ?>">
                                <div class="input-group-addon">
                                    <i class="fa fa-clock-o"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="input-group date">
                                <div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>
                                <!-- <input name="tgl_stop" type="text" class="form-control pull-right" id="datepicker3" max="2023-11-21" placeholder="0000-00-00" value="<?php //echo ''; ?>" /> -->
                                <!-- <input name="tgl_stop" type="date" class="form-control pull-right" max="<?php //Date('Y-m-d'); ?>" placeholder="0000-00-00" value="<?php //echo $r['tglS']; ?>" /> -->
                                <input name="tgl_stop" type="date" class="form-control pull-right"
                                    max="<?= Date('Y-m-d'); ?>" placeholder="0000-00-00" value="<?php echo $tglS; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="selesaism" class="col-sm-3 control-label">Selesai Stop Mesin</label>
                        <div class="col-sm-3">
                            <div class="input-group">
                                <input type="text" class="form-control timepicker" name="jam_mulai" placeholder="00:00"
                                    value="<?php echo $jamM; ?>">
                                <div class="input-group-addon">
                                    <i class="fa fa-clock-o"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="input-group date">
                                <div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>
                                <!-- <input name="tgl_mulai" type="text" class="form-control pull-right" id="datepicker"  placeholder="0000-00-00" value="<?php //echo '' ?>" /> -->
                                <!-- <input name="tgl_mulai" type="date" class="form-control pull-right" max="<?php //Date('Y-m-d'); ?>" placeholder="0000-00-00" value="<?php
                                 // echo $r['tglM']; 
                                 ?>" /> -->
                                <input name="tgl_mulai" type="date" class="form-control pull-right"
                                    max="<?= Date('Y-m-d'); ?>" placeholder="0000-00-00" value="<?php echo $tglM; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="multi" class="col-sm-3 control-label">Keterangan Stop Mesin</label>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <select class="form-control" name="ket_stopmesin">
                                    <option value="" selected>-</option>
                                    <?php $q_ket_stopmesin = sqlsrv_query($con, "SELECT * FROM db_dying.tbl_ket_stopmesin ORDER BY id ASC"); ?>
                                    <?php while ($row_ket_stopmesin = sqlsrv_fetch_array($q_ket_stopmesin)) { ?>
                                       <option value="<?php echo htmlspecialchars($row_ket_stopmesin['ket_stopmesin']); ?>" <?php if ($r['ket_stopmesin'] == $row_ket_stopmesin['ket_stopmesin'])
                                           echo 'selected'; ?>>
                                        <?php echo htmlspecialchars($row_ket_stopmesin['ket_stopmesin']); ?>
                                    </option>
                                    <?php } ?>
                                </select>
                                <span class="input-group-btn"><a target="_blank" href="?p=tambah_ketstopmesin"
                                        class="btn btn-default">...</a></span>
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
                                <input type="text" class="form-control timepicker" name="jam_stop2" placeholder="00:00"
                                    value="<?php echo $jamS2; ?>">
                                <div class="input-group-addon">
                                    <i class="fa fa-clock-o"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="input-group date">
                                <div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>
                                <input name="tgl_stop2" type="date" class="form-control pull-right"
                                    max="<?= Date('Y-m-d'); ?>" placeholder="0000-00-00"
                                    value="<?php echo $tglS2; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="selesaism" class="col-sm-3 control-label">Selesai Stop Mesin</label>
                        <div class="col-sm-3">
                            <div class="input-group">
                                <input type="text" class="form-control timepicker" name="jam_mulai2" placeholder="00:00"
                                    value="<?php echo $jamM2; ?>">
                                <div class="input-group-addon">
                                    <i class="fa fa-clock-o"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="input-group date">
                                <div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>
                                <input name="tgl_mulai2" type="date" class="form-control pull-right"
                                    max="<?= Date('Y-m-d'); ?>" placeholder="0000-00-00"
                                    value="<?php echo $tglM2; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="multi" class="col-sm-3 control-label">Keterangan Stop Mesin</label>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <select class="form-control" name="ket_stopmesin2">
                                    <option value="" disabled selected>-</option>
                                    <?php $q_ket_stopmesin = sqlsrv_query($con, "SELECT * FROM db_dying.tbl_ket_stopmesin ORDER BY id ASC"); ?>
                                    <?php while ($row_ket_stopmesin = sqlsrv_fetch_array($q_ket_stopmesin)) { ?>
                                        <option value="<?= $row_ket_stopmesin['ket_stopmesin']; ?>" <?php if ($r['ket_stopmesin2'] == $row_ket_stopmesin['ket_stopmesin']) ?>>
                                            <?= $row_ket_stopmesin['ket_stopmesin']; ?></option>
                                    <?php } ?>
                                </select>
                                <span class="input-group-btn"><a target="_blank" href="?p=tambah_ketstopmesin"
                                        class="btn btn-default">...</a></span>
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
                                <input type="text" class="form-control timepicker" name="jam_stop3" placeholder="00:00"
                                    value="<?php echo $jamS3; ?>">
                                <div class="input-group-addon">
                                    <i class="fa fa-clock-o"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="input-group date">
                                <div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>
                                <input name="tgl_stop3" type="date" class="form-control pull-right"
                                    max="<?= Date('Y-m-d'); ?>" placeholder="0000-00-00"
                                    value="<?php echo $tglS3; ?>" />
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="selesaism" class="col-sm-3 control-label">Selesai Stop Mesin</label>
                        <div class="col-sm-3">
                            <div class="input-group">
                                <input type="text" class="form-control timepicker" name="jam_mulai3" placeholder="00:00"
                                    value="<?php echo $jamM3; ?>">
                                <div class="input-group-addon">
                                    <i class="fa fa-clock-o"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="input-group date">
                                <div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>
                                <input name="tgl_mulai3" type="date" class="form-control pull-right"
                                    max="<?= Date('Y-m-d'); ?>" placeholder="0000-00-00"
                                    value="<?php echo $tglM3; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="multi" class="col-sm-3 control-label">Keterangan Stop Mesin</label>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <select class="form-control" name="ket_stopmesin3">
                                    <option value="" disabled selected>-</option>
                                    <?php $q_ket_stopmesin = sqlsrv_query($con, "SELECT * FROM db_dying.tbl_ket_stopmesin ORDER BY id ASC"); ?>
                                    <?php while ($row_ket_stopmesin = sqlsrv_fetch_array($q_ket_stopmesin)) { ?>
                                        <option value="<?= $row_ket_stopmesin['ket_stopmesin']; ?>" <?php if ($r['ket_stopmesin3'] == $row_ket_stopmesin['ket_stopmesin']) ?>>
                                            <?= $row_ket_stopmesin['ket_stopmesin']; ?></option>
                                    <?php } ?>
                                </select>
                                <span class="input-group-btn"><a target="_blank" href="?p=tambah_ketstopmesin"
                                        class="btn btn-default">...</a></span>
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
                                <input type="text" class="form-control timepicker" name="jam_stop4" placeholder="00:00"
                                    value="<?php echo $jamS4; ?>">
                                <div class="input-group-addon">
                                    <i class="fa fa-clock-o"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="input-group date">
                                <div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>
                                <input name="tgl_stop4" type="date" class="form-control pull-right"
                                    max="<?= Date('Y-m-d'); ?>" placeholder="0000-00-00"
                                    value="<?php echo $tglS4; ?>" />
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="selesaism" class="col-sm-3 control-label">Selesai Stop Mesin</label>
                        <div class="col-sm-3">
                            <div class="input-group">
                                <input type="text" class="form-control timepicker" name="jam_mulai4" placeholder="00:00"
                                    value="<?php echo $jamM4; ?>">
                                <div class="input-group-addon">
                                    <i class="fa fa-clock-o"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="input-group date">
                                <div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>
                                <input name="tgl_mulai4" type="date" class="form-control pull-right"
                                    max="<?= Date('Y-m-d'); ?>" placeholder="0000-00-00"
                                    value="<?php echo $tglM4; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="multi" class="col-sm-3 control-label">Keterangan Stop Mesin</label>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <select class="form-control" name="ket_stopmesin4">
                                    <option value="" disabled selected>-</option>
                                    <?php $q_ket_stopmesin = sqlsrv_query($con, "SELECT * FROM db_dying.tbl_ket_stopmesin ORDER BY id ASC"); ?>
                                    <?php while ($row_ket_stopmesin = sqlsrv_fetch_array($q_ket_stopmesin)) { ?>
                                        <option value="<?= $row_ket_stopmesin['ket_stopmesin']; ?>" <?php if ($r['ket_stopmesin4'] == $row_ket_stopmesin['ket_stopmesin']) ?>>
                                            <?= $row_ket_stopmesin['ket_stopmesin']; ?></option>
                                    <?php } ?>
                                </select>
                                <span class="input-group-btn"><a target="_blank" href="?p=tambah_ketstopmesin"
                                        class="btn btn-default">...</a></span>
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

    $(function () {
        //Timepicker
        $('.timepicker').timepicker({
            minuteStep: 1,
            showInputs: true,
            showMeridian: false,
            defaultTime: false

        })
    })
</script>