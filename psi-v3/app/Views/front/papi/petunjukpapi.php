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
                        <div class="col-md-12" style="height: 100%; display: flex; justify-content: center; align-items: center;">
                            <div class="bg-gray col-md-10">
                                <h3 style="padding-top:10px;" class="text-center"><b>PETUNJUK PENGERJAAN KOSTICK PAPI</b></h3>
                                <div class="row col-md-12">
                                    <label for="contoh1">Petunjuk :</label>
                                    <p>Ada sembilan puluh ( 90 ) pasang,pilihlah satu dari setiap pasangan tersebut yang Saudara anggap paling dekat menggambarkan diri saudara. Bila tidak satupun dari sebuah pasangan pernyataan yang cocok,pilihlah yang Saudara anggap paling mendekati Isilah jawaban pada kolom yang sudah disediakan pada setiap pernyataan yang Saudara pilih. </p>

                                    <label for="contoh2">Sebagai Contoh :</label>
                                    <table>
                                        <tr>
                                            <td rowspan="2">1.</td>
                                            <td style="padding-left: 10px;">a. Saya adalah pekerja keras</td>
                                        </tr>
                                        <tr>
                                            <td style="padding-left: 10px;">b. Saya tidak mudah murung</td>
                                        </tr>
                                    </table>

                                    <p style="margin-top: 20px;">Dalam hal ini Saudara memilih pernyataan " a ", karena pernyataan " a " merupakan gambaran diri Saudara.
                                    Tetapi jika pernyataan " b " lebih menggambarkan diri Saudara,maka lingkarilah tanda anak panah pada pernyataan " b "</p>
                                    <p>
                                        Kerjakan secepat mungkin dan pilihlah hanya satu pernyataan dari tiap pasang.
                                    </p>
                                    <p>SELAMAT BEKERJA</p>
                                </div>
                                <div class="row col-md-12 text-center" style="margin-top: 20px; padding-bottom: 20px;">
                                    <a href='<?= base_url() ?>/papi/ujian/<?= $request->uri->getSegment(3) ?>/<?= $request->uri->getSegment(4) ?>' class='btn btn-success' style='font-size:18px;'>Mulai</a>
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