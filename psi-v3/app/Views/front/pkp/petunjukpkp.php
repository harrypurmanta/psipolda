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
                                <h3 style="padding-top:10px;"><b>PETUNJUK PENGERJAAN</b></h3>
                                <?php if ($request->uri->getSegment(5) == 1) { ?>
                                    <p class="col-md-12" style="text-align: justify; font-size: 18px;">Dalam kuesioner ini terdapat 52 pernyataan yang perlu dibaca secara teliti dan selanjutnya dijawab. Jawablah semua pernyataan sesuai dengan kondisi diri Anda sebenarnya. </p>
                                    <p>Berikan jawaban pertama yang terlintas di pikiran Anda agar Anda dapat bekerja tepat, cepat, dan spontan.</p>
                                    <p>Apabila Anda merasa setuju dengan pernyataan itu, atau, merasa bahwa pernyataan itu sesuai dengan diri Anda, maka berilah jawaban dengan menghitamkan bulatan huruf "A" di Lembar Jawaban Komputer.</p>
                                    <p>Sedangkan apabila Anda merasa tidak setuju dengan pernyataan itu, atau, merasa tidak sesuai dengan diri Anda, maka berikanlah jawaban dengan menghitamkan bulatan huruf “B” di Lembar Jawaban Komputer..</p>
                                    <a href='<?= base_url() ?>/pkp/ujian/<?= $request->uri->getSegment(3) ?>/<?= $request->uri->getSegment(4) ?>/<?= $request->uri->getSegment(5) ?>' class='btn btn-success' style='font-size:18px;'>Mulai</a>
                                <?php } else if ($request->uri->getSegment(5) == 2) { ?>
                                    <p class="col-md-12 text-left" style="text-align: justify; font-size: 18px;">pada tes ini, anda akan menghadapi 22 buah pertanyaan dengan jawaban yang sudah tersedia untuk dipilih : </p>
                                    <div class="text-left" style="margin-left: 20px;">
                                         1. Bila sangat tidak menggambarkan diri anda <br>
                                        2. Bila tidak menggambarkan diri anda <br>
                                        3. Bila agak tidak menggambarkan diri anda <br>
                                        4. Bila agak menggambarkan diri anda <br>
                                        5. Bila menggambarkan diri anda <br>
                                        6. Bila sangat menggambarkan diri anda <br>
                                    </div>
                                    <br>

                                    <p>Pilihlah jawaban sesuai dengan kenyataan yang ada pada diri anda sendiri</p>

                                    <a href='<?= base_url() ?>/pkp/ujian/<?= $request->uri->getSegment(3) ?>/<?= $request->uri->getSegment(4) ?>/<?= $request->uri->getSegment(5) ?>' class='btn btn-success' style='font-size:18px;'>Mulai</a>
                                <?php } else { ?>
                                    <p class="col-md-12" style="text-align: justify; font-size: 18px;">Dibawah ini adalah pernyataan-pernyataan yang menggambarkan profesi anda sebagai anggota kepolisian.</p>
                                    <p>Silahkan pilih pernyataan sesuai tingkatan angka yang menggambarkan tingkat gangguan yang anda alami/rasakan dalam menjalankan tugas sehari-hari selama kurun waktu 6 bulan belakangan ini.</p>

                                    <a href='<?= base_url() ?>/pkp/ujian/<?= $request->uri->getSegment(3) ?>/<?= $request->uri->getSegment(4) ?>/<?= $request->uri->getSegment(5) ?>' class='btn btn-success' style='font-size:18px;'>Mulai</a>
                                <?php } ?>

                                
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