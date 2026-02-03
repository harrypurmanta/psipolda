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
    <link rel="stylesheet" href="<?= base_url() ?>/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/dist/css/skins/_all-skins.min.css">
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
                    <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="box">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="person_nm">Nama Lengkap</label>
                                            <input type="text" class="form-control" id="person_nm" placeholder="Masukkan nama lengkap">
                                        </div>
                                        <div class="form-group">
                                            <label for="satuan">Satuan</label>
                                            <input type="text" class="form-control" id="satuan" placeholder="Masukkan Satuan">
                                        </div>
                                        <div class="form-group">
                                            <label for="birth_place">Tempat Lahir</label>
                                            <input type="text" class="form-control" id="birth_place" placeholder="Masukkan Tempat Lahir">
                                        </div>
                                        <div class="form-group">
                                            <label for="birth_dttm">Tanggal Lahir</label>
                                            <input type="date" class="form-control" id="birth_dttm" >
                                        </div>
                                        <div class="form-group">
                                            <label for="birth_dttm">Jenis Kelamin</label>
                                            <select class="form-control" name="gender_cd" id="gender_cd">
                                                <option value="m">Laki-laki</option>
                                                <option value="f">Perempuan</option>
                                            </select>
                                        </div>
                                        
                                        <div class="form-group">
                                            <div class="text-center">
                                                <button type="button" onclick="simpanbiodata()" class="btn btn-primary">Mulai</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="d-none" id='loader-wrapper'>
                <div class="loader"></div>
            </div>
        </div>
        <?= $this->include('front/footer') ?>
    </div>
    <script src="<?= base_url() ?>/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?= base_url() ?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="<?= base_url() ?>/bower_components/fastclick/lib/fastclick.js"></script>
    <script src="<?= base_url() ?>/dist/js/adminlte.min.js"></script>
    <script>
        function simpanbiodata() {
        var person_nm = $("#person_nm").val();
        var satuan = $("#satuan").val();
        var birth_place = $("#birth_place").val();
        var birth_dttm = $("#birth_dttm").val();
        var gender_cd = $("#gender_cd").val();
        var materi_id = <?= $request->uri->getSegment(3) ?>;
        var group_id = <?= $request->uri->getSegment(4) ?>;
        
        $.ajax({
            url: "<?= base_url('materi/simpanbiodata') ?>",
            type: "post",
            dataType: "json",
            data: {
                "person_nm" : person_nm,
                "satuan" : satuan,
                "birth_place" : birth_place,
                "birth_dttm" : birth_dttm,
                "gender_cd" : gender_cd,
                "materi_id" : materi_id,
                "group_id" : group_id
            },
            beforeSend: function() {
                $("#loader-wrapper").removeClass("d-none");
            },
            success: function(data) {
                $("#loader-wrapper").addClass("d-none");
                if (data == "sukses") {
                    alert("Data berhasil disimpan");
                    location.href = "<?= base_url() ?>/tryout/ujian/"+materi_id+"/"+group_id;
                } else if (data == "sudahada") {
                    alert("Anda sudah mengerjakan materi ini");
                } else {
                    alert("error");
                }
            },
                error: function() {
                alert("error");
                $("#loader-wrapper").addClass("d-none");
            }
        });
        }
    </script>
</body>

</html>