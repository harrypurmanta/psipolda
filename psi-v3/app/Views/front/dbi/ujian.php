<?php
$request = \Config\Services::request();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Bagian Psikologi Polda Sumsel</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?= base_url() ?>/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/plugins/sweetalert2/sweetalert2.css">
    <link rel="icon" href="images/bg/favicon.ico" type="image/gif">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <style>
    .d-none {
        display: none !important;
    }

    #loader-wrapper {
        display: flex;
        position: fixed;
        z-index: 1060;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        flex-direction: row;
        align-items: center;
        justify-content: center;
        padding: 0.625em;
        overflow-x: hidden;
        transition: background-color 0.1s;
        background-color: rgb(253 253 253 / 58%);
        -webkit-overflow-scrolling: touch;
    }

    .loader {
        border: 10px solid #f3f3f3;
        border-radius: 50%;
        border-top: 10px solid #3af3f5;
        border-bottom: 10px solid #3abcec;
        width: 50px;
        height: 50px;
        -webkit-animation: spin 2s linear infinite;
        animation: spin 2s linear infinite;
        margin: 1.75rem auto;
    }



    @keyframes fadeIn {
        0% {
            opacity: 0;
        }

        100% {
            opacity: 1;
        }
    }

    @-moz-keyframes fadeIn {
        0% {
            opacity: 0;
        }

        100% {
            opacity: 1;
        }
    }

    @-webkit-keyframes fadeIn {
        0% {
            opacity: 0;
        }

        100% {
            opacity: 1;
        }
    }

    @-o-keyframes fadeIn {
        0% {
            opacity: 0;
        }

        100% {
            opacity: 1;
        }
    }

    @-ms-keyframes fadeIn {
        0% {
            opacity: 0;
        }

        100% {
            opacity: 1;
        }
    }

    @-webkit-keyframes spin {
        0% {
            -webkit-transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
        }
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
    </style>
</head>

<body class="hold-transition skin-blue layout-top-nav">
    <div class="wrapper">
        <header class="main-header">
            <?= $this->include('front/navbar') ?>
        </header>
        <div class="content-wrapper">
            <div class="container">
                <section class="content">
                    <div class="row" style="display:none;">
                        <div class="col-md-12">
                            <div class="bg-gray col-md-4 text-center"
                                style="border-radius:5px;">
                                <span style="margin-top:12px;">Waktu</span><br>
                                <label id="countdown">00:00</label>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top:10px;">
                        <div class="col-md-12">
                            <div class="bg-gray col-md-12" style="border-radius:5px;">
                            <label style="margin-top:10px;font-size:18px;" for="pertanyaan">Pertanyaan <span id="group_nm"></span> </label>
                                <div id="dv_soal" class="col-md-12"
                                    style="min-height:140px;background-color:#aeaebb;border-radius:5px;padding-bottom: 5px;text-align: justify;">
                                    <label id="p_no_soal" style="margin-top:10px;font-size:18px;"></label>
                                    <div id="inp_soal_nm" style="margin:5px;font-size:18px;">

                                    </div>
                                    <div id="dv_img_soal" style="margin:5px;font-size:16px;"></div>
                                    <input type="hidden" value="" id="inp_soal_id">
                                    <input type="hidden" value="1" id="inp_no_soal">
                                    <input type="hidden" value="0" id="inp_kolom_id">
                                </div>
                                <div class="row" id="dv_main_jawaban" style="margin-top:10px;padding-bottom: 50px;">
                                    <div class="col-md-12" >
                                   
                                    </div>
                                </div>
                                <input type="hidden" value="" id="inp_jawaban_id">
                                <input type="hidden" value="" id="inp_pilihan_nm">
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <div class="d-none" id='loader-wrapper'>
            <div class="loader"></div>
        </div>
    </div>
    <script src="<?= base_url() ?>/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?= base_url() ?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="<?= base_url() ?>/bower_components/fastclick/lib/fastclick.js"></script>
    <script src="<?= base_url() ?>/dist/js/adminlte.min.js"></script>
    <script src="<?= base_url() ?>/plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
    <script src="<?= base_url() ?>/plugins/sweetalert2/sweetalert2.js"></script>
    <script>
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox({
            alwaysShowClose: true,
            wrapping: false
        });
    });
    
    var timers;
    $(document).ready(function() {
        let group_id = <?= $request->uri->getSegment(4) ?>;
        if (group_id == 2) {
            $('#inp_soal_nm').css('padding-bottom','0');
        }
        setTimeout(() => {
            startujian("start","","");
        }, 1000);
    });

    function setboxsoal(no_soal) {
        no_soalx = no_soal + 1;
        $("#inp_no_soal").val(no_soal);
        $("#p_no_soal").text("Soal no. " + no_soal);
        startujian("prev");
    }

    function updateFinishRespon(materi_id,group_id) {
        $.ajax({
            url: "<?= base_url('dbi/updateFinishRespon') ?>",
            type: "post",
            dataType: "json",
            data: {
                "materi_id": materi_id,
                "group_id": group_id
            },
            beforeSend: function() {
                $("#loader-wrapper").removeClass("d-none")
            },
            success: function(data) {
                $("#loader-wrapper").addClass("d-none");
            },
            error: function() {
                Swal.fire("Ada terjadi sesuatu, mohon hubungi administrator", "", "warning");
            }
        });
    }

    function startujian(proc,jawaban_id,pilihan_nm,index) {
        if (index == 0) {
            $('#inp_chk_jawaban_id_0').prop('checked', true);
            $('#inp_chk_jawaban_id_1').prop('checked', false);
            $('#inp_chk_jawaban_id_2').prop('checked', false);
            $('#inp_chk_jawaban_id_3').prop('checked', false);
        } else if (index == 1) {
            $('#inp_chk_jawaban_id_0').prop('checked', false);
            $('#inp_chk_jawaban_id_1').prop('checked', true);
            $('#inp_chk_jawaban_id_2').prop('checked', false);
            $('#inp_chk_jawaban_id_3').prop('checked', false);
        } else if (index == 2) {
            $('#inp_chk_jawaban_id_0').prop('checked', false);
            $('#inp_chk_jawaban_id_1').prop('checked', false);
            $('#inp_chk_jawaban_id_2').prop('checked', true);
            $('#inp_chk_jawaban_id_3').prop('checked', false);
        } else if (index == 3) {
            $('#inp_chk_jawaban_id_0').prop('checked', false);
            $('#inp_chk_jawaban_id_1').prop('checked', false);
            $('#inp_chk_jawaban_id_2').prop('checked', false);
            $('#inp_chk_jawaban_id_3').prop('checked', true);
        }


        let soal_id = $("#inp_soal_id").val();
        // let jawaban_id = $("#inp_jawaban_id").val();
        let group_id = <?= $request->uri->getSegment(4) ?>;
        let no_soal = $("#inp_no_soal").val();
        // let pilihan_nm = $("#inp_pilihan_nm").val();
        let kolom_id = $("#inp_kolom_id").val();
        let materi = <?= $request->uri->getSegment(3) ?>;
        let waktu = document.getElementById('countdown').textContent;
        $.ajax({
            url: "<?= base_url('dbi/dbiujian') ?>",
            type: "post",
            dataType: "json",
            data: {
                "jawaban_id": jawaban_id,
                "soal_id": soal_id,
                "group_id": group_id,
                "no_soal": no_soal,
                "pilihan_nm": pilihan_nm,
                "kolom_id": kolom_id,
                "materi": materi,
                "proc": proc,
                "waktu": waktu
            },
            beforeSend: function() {
                // $("#loader-wrapper").removeClass("d-none")
            },
            success: function(data) {
                if (data.proc == "selesai") {
                    updateFinishRespon(<?= $request->uri->getSegment(3) ?>,<?= $request->uri->getSegment(4) ?>);
                        Swal.fire({
                            title: "anda telah selesai mengerjakan Test, klik Ok untuk keluar",
                            icon: "info",
                            showCancelButton: false,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "OK"
                            }).then((result) => {
                            if (result.isConfirmed) {
                                Swal.fire({
                                    title: "Terima Kasih",
                                    text: "Anda telah menyelesaikan tes ini",
                                    icon: "success"
                                });
                                updateFinishRespon(<?= $request->uri->getSegment(3) ?>,<?= $request->uri->getSegment(4) ?>);
                                window.location.href = "<?= base_url() ?>/dbi/hasiltryout/"+<?= $request->uri->getSegment(3) ?>+"/" +<?= $request->uri->getSegment(4) ?>;
                            }
                        });
                    
                } else {
                    if (data == "jawaban_kosong") {
                        alert("Jawaban belum dipilih");
                    } else {
                        if (data.no_soal == 1) {
                            window.clearInterval(timers);
                            countdown(1800);
                        } 

                        $("#inp_soal_id").val(data.soal_id);
                        $("#inp_soal_nm").html(data.soal_nm);
                        $("#group_nm").text(data.group_nm);
                        $("#p_no_soal").text("Soal no. " + data.no_soal);
                        $("#inp_group_id").val(data.group_id);
                        $("#inp_no_soal").val(data.no_soal);
                        $("#inp_kolom_id").val(data.kolom_id);
                        $("#dv_main_jawaban").html(data.jawaban_nm);
                        $("#dv_boxnosoal").html(data.boxnomorsoal);
                        $("#dv_button").html(data.button);
                        $("#inp_jawaban_id").val("");
                        $("#inp_pilihan_nm").val("");
                        // $("#dv_img_soal").html(data.img_soal);
                        // setTimeout(() => {
                        //     selectJawaban(data.jawaban_idx,data.pilihan_nms);
                        // }, 10);
                        
                    }

                    // $("#loader-wrapper").addClass("d-none");

                }
            },
            error: function(e) {
                alert(e.responseText);
            }
        });
    }

    function convertSeconds(s) {
        var min = Math.floor(s / 60);
        var sec = s % 60;
        if (sec < 10) {
            sec = "0"+sec;
        }

        if (min < 10) {
            min = "0"+min;
        }
        return min + ":" + sec;
    }


    function countdown(detik) {
        var seconds = detik;
        var group_id = <?= $request->uri->getSegment(4) ?>;
        var materi = <?= $request->uri->getSegment(3) ?>;
        timers = window.setInterval(function() {
            myFunction();
        }, 1000); // every second

        function myFunction() {
            seconds--;
            $("#countdown").text(convertSeconds(seconds));
            if (seconds === 0) {
                let grp_id = group_id + 1;
                window.location.href = "<?= base_url() ?>/materi/pilihanMateri/" + materi + "/" + grp_id;
            } else {
                //Do nothing
            }

        }
    }
    </script>
</body>

</html>