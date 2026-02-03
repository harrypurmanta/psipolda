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
                        <div class="col-md-12" style="height: 400px;">
                            <div class="bg-gray col-md-8 text-center" style="top: 50%;left: 50%;transform: translate(-50%, -50%);height: 350px;">
                                <h3 style="padding-top:10px;"><b>PETUNJUK PENGISIAN KUESIONER</b></h3>
                                <p class="col-md-12" style="text-align: justify;">Kuesioner ini terdiri dari berbagai pernyataan yang mungkin sesuai dengan pengalaman saudara dalam menghadapi situasi sehari - hari dalam kurun waktu 3 bulan ini. Anda dapat memilih salah satu jawaban dan memberi tanda silang (X) pada pilihan jawaban yang sesuai dengan diri anda. Terdapat empat pilihan jawaban yang disediakan untuk setiap pernyataan yaitu:</p>
                                <div class="col-md-12" style="text-align: justify;">
                                    <p>0 : Tidak sesuai dengan saya sama sekali, atau tidak pernah.</p>
                                    <p>1 : Sesuai dengan saya sampai tingkat tertentu, atau kadang - kadang.</p>
                                    <p>2 : Sesuai dengan saya sampai batas yang dipertimbangkan, atau lumayan sering.</p>
                                    <p>3 : Sangat sesuai dengan saya, atau sering sekali</p>
                                </div>
                                <a href='<?= base_url() ?>/dass/ujian/<?= $request->uri->getSegment(3) ?>/<?= $request->uri->getSegment(4) ?>' class='btn btn-success' style='font-size:18px;'>Mulai</a>
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
</body>
</html>