<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Bagian Psikologi Polda Sumsel</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?= base_url() ?>/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>/dist/dist/css/adminlte.min.css">
    <link rel="icon" href="../../../../../images/bg/favicon.ico" type="image/gif">
</head>
<body class="hold-transition skin-blue layout-top-nav">
    <div class="wrapper">
        <header class="main-header">
            <?= $this->include('admin/navbar') ?>
        </header>

        <div class="content-wrapper">
        <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card bg-gray">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="text-center"><h2>DASS-42</h2></div>
                                            <div class="col-md-12">
                                             <hr>
                                             </div>
                                            <div class="col-md-12">
                                                    <div class="col-md-6">
                                                        <table border="0">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="text-left text-bold" width="200">Nama</td>
                                                                    <td class="text-center" width="30">:</td>
                                                                    <td class="text-left"><?= $user[0]->person_nm ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-left text-bold" width="100">Pangkat/NRP</td>
                                                                    <td class="text-center" width="30">:</td>
                                                                    <td class="text-left"><?= $user[0]->pangkat ?>/<?= $user[0]->nrp ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-left text-bold" width="100">Kesatuan</td>
                                                                    <td class="text-center" width="30">:</td>
                                                                    <td class="text-left"><?= $user[0]->satuan ?></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <table border="0">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="text-left text-bold" width="150">Jenis Kelamin/Usia</td>
                                                                    <td class="text-center" width="20">:</td>
                                                                    <td class="text-left"><?= ($user[0]->gender_cd=="m"?"Laki-laki":"Perempuan") ?>/<?= $user[0]->gender_cd ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-left text-bold" width="100">Tanggal Pemeriksaan</td>
                                                                    <td class="text-center" width="20">:</td>
                                                                    <td class="text-center"><?= date("d-m-Y",strtotime($tanggal_pemeriksaan[0]->created_dttm)) ?></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                             </div>
                                             <div class="col-md-12">
                                             <hr>
                                             </div>
                                             <div class="col-md-12 ">
                                                <div class="card">
                                                    <div class="card-body" style="display:flex;justify-content:center;padding-bottom:15px;">
                                                    <div class="col-md-6">
                                                    <table border="1" width="100%" style="border:1px solid black;line-height: 30px;margin-top:10px;">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center" width="40%"></th>
                                                                <th class="text-center bg-blue" width="20%">Depression</th>
                                                                <th class="text-center bg-blue" width="20%">Anxiety</th>
                                                                <th class="text-center bg-blue" width="20%">Stress</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td class="text-left text-bold bg-blue" style="padding-left:10px;">Normal</td>
                                                                <td class="text-center text-bold" style="font-size: 20px;"><?= ($depression[0]->jumlah_d <= 9? $depression[0]->jumlah_d:"") ?></td>
                                                                <td class="text-center text-bold" style="font-size: 20px;"><?= ($anxiety[0]->jumlah_a <= 7? $anxiety[0]->jumlah_a:"") ?></td>
                                                                <td class="text-center text-bold" style="font-size: 20px;"><?= ($stress[0]->jumlah_s <= 14? $stress[0]->jumlah_s:"") ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-left text-bold bg-blue" style="padding-left:10px;">Mild</td>
                                                                <td class="text-center text-bold" style="font-size: 20px;"><?= ($depression[0]->jumlah_d >= 10 && $depression[0]->jumlah_d <= 13 ? $depression[0]->jumlah_d:"") ?></td>
                                                                <td class="text-center text-bold" style="font-size: 20px;"><?= ($anxiety[0]->jumlah_a >= 8 && $anxiety[0]->jumlah_a <= 9? $anxiety[0]->jumlah_a:"") ?></td>
                                                                <td class="text-center text-bold" style="font-size: 20px;"><?= ($stress[0]->jumlah_s >= 15 && $stress[0]->jumlah_s <= 18? $stress[0]->jumlah_s:"") ?></td>
                                                            </tr> 
                                                            <tr>
                                                                <td class="text-left text-bold bg-blue" style="padding-left:10px;">Moderate</td>
                                                                <td class="text-center text-bold" style="font-size: 20px;"><?= ($depression[0]->jumlah_d >= 14 && $depression[0]->jumlah_d <= 20 ? $depression[0]->jumlah_d:"") ?></td>
                                                                <td class="text-center text-bold" style="font-size: 20px;"><?= ($anxiety[0]->jumlah_a >= 10 && $anxiety[0]->jumlah_a <= 14? $anxiety[0]->jumlah_a:"") ?></td>
                                                                <td class="text-center text-bold" style="font-size: 20px;"><?= ($stress[0]->jumlah_s >= 19 && $stress[0]->jumlah_s <= 25? $stress[0]->jumlah_s:"") ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-left text-bold bg-blue" style="padding-left:10px;">Severe</td>
                                                                <td class="text-center text-bold" style="font-size: 20px;"><?= ($depression[0]->jumlah_d >= 21 && $depression[0]->jumlah_d <= 27 ? $depression[0]->jumlah_d:"") ?></td>
                                                                <td class="text-center text-bold" style="font-size: 20px;"><?= ($anxiety[0]->jumlah_a >= 15 && $anxiety[0]->jumlah_a <= 19? $anxiety[0]->jumlah_a:"") ?></td>
                                                                <td class="text-center text-bold" style="font-size: 20px;"><?= ($stress[0]->jumlah_s >= 26 && $stress[0]->jumlah_s <= 33? $stress[0]->jumlah_s:"") ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-left text-bold bg-blue" style="padding-left:10px;">Extremely Severe</td>
                                                                <td class="text-center text-bold" style="font-size: 20px;"><?= ($depression[0]->jumlah_d >= 28 ? $depression[0]->jumlah_d:"") ?></td>
                                                                <td class="text-center text-bold" style="font-size: 20px;"><?= ($anxiety[0]->jumlah_a >= 20 ? $anxiety[0]->jumlah_a:"") ?></td>
                                                                <td class="text-center text-bold" style="font-size: 20px;"><?= ($stress[0]->jumlah_s >= 34 ? $stress[0]->jumlah_s:"") ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    </div>
                                                    </div>
                                                </div>
                                             </div>
                                        </div>
                                    </div>
                                    
                            </div>
                        </div>
                    </div>
                    </div>
                </section>
        </div>
        <?= $this->include('front/footer') ?>
    </div>
    <script src="<?= base_url() ?>/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?= base_url() ?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="<?= base_url() ?>/bower_components/fastclick/lib/fastclick.js"></script>
    <script src="<?= base_url() ?>/dist/js/adminlte.min.js"></script>
    <script src="<?= base_url() ?>/dist/js/Chart.js"></script>

    <script>
        $(document).ready(function(){
            
        });
        
    </script>
</body>

</html>