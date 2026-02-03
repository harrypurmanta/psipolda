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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
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
                        <div class="col-md-12" style="height: 100%;">
                            <div class="bg-gray col-md-8">
                                <h3 style="padding-top:10px;" class="text-center"><b>PETUNJUK PENGERJAAN TIU 5</b></h3>
                                <div class="row col-md-12">
                                    <label for="contoh1">Contoh 1 :</label>
                                    <img src="../../../images/petunjuk/tiu5/contoh1.PNG" alt="" style="object-fit: contain; width: 100%; height: 100%;">
                                    <p>Bila A dikecilkan diperoleh B. Bila sekarang dengan C dilakukan hal yang serupa, jadi C dikecilkan, diperoleh gambar 2, maka dari itu gambar 2dicoret di bawahnya</p>

                                    <label for="contoh1">Contoh 2 :</label>
                                    <img src="../../../images/petunjuk/tiu5/contoh2.PNG" alt="" style="object-fit: contain; width: 100%; height: 100%;">
                                    <p>Bila A diputar diperoleh B. Bila C diputar diperoleh gambar . . . . . . . . Carilah gambar tersebut dan berilah coretan di bawahnya.</p>

                                    <label for="contoh1">Latihan :</label>
                                    <p>Seperti halnya A. diubah menjadi B, demikian pula C diubah menjadi salah satu dari kelima gambar berikutnya. Carilah gambar tersebut dan berilah coretan di bawahnya.</p>
                                    <img src="../../../images/petunjuk/tiu5/contoh3.PNG" alt="" style="object-fit: contain; width: 100%; height: 100%;">

                                </div>
                                <div class="row col-md-12 text-center" style="margin-top: 20px; padding-bottom: 20px;">
                                    <a href='<?= base_url() ?>/tiu5/ujian/<?= $request->uri->getSegment(3) ?>/<?= $request->uri->getSegment(4) ?>' class='btn btn-success' style='font-size:18px;'>Mulai</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <?= $this->include('front/footer') ?>
    </div>
    <script src="<?= base_url() ?>/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?= base_url() ?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="<?= base_url() ?>/bower_components/fastclick/lib/fastclick.js"></script>
    <script src="<?= base_url() ?>/dist/js/adminlte.min.js"></script>
    <script src="<?= base_url() ?>/dist/js/demo.js"></script>
</body>
</html>