<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Pages</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?= base_url() ?>/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>/dist/dist/css/adminlte.min.css">
  <link rel="icon" href="images/bg/favicon.ico" type="image/gif">
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <?= $this->include('admin/navbar') ?>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
          
          </div><!-- /.col -->
          <div class="col-sm-6">
        
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div>
    </div>
    <div class="content">
      <div class="container">
        <div class="row">
        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="text-center"><h2>DASS-42</h2></div>
                                            <hr>
                                            <div class="card">
                                                <div class="card-body">
                                                <div class="row col-md-12">
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
                                                                    <td class="text-left"><?= $user[0]->pangkat ?> / <?= $user[0]->nrp ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-left text-bold" width="100">Kesatuan</td>
                                                                    <td class="text-center" width="30">:</td>
                                                                    <td class="text-left"><?= $user[0]->satuan_nm ?></td>
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
                                                                    <td class="text-left"><?= ($user[0]->gender_cd=="m"?"Laki-laki":"Perempuan") ?> / <?= $thn_lahir ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-left text-bold" width="200">Tanggal Pemeriksaan</td>
                                                                    <td class="text-center" width="20">:</td>
                                                                    <td class="text-left"><?= date("d-m-Y",strtotime($tanggal_pemeriksaan[0]->created_dttm)) ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-left text-bold" width="200">Pendidikan</td>
                                                                    <td class="text-center" width="20">:</td>
                                                                    <td class="text-left"><?= $user[0]->pendidikan_nm ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-left text-bold" width="200">No. Peserta</td>
                                                                    <td class="text-center" width="20">:</td>
                                                                    <td class="text-left"><?= $notest ?></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                             </div>
                                                </div>
                                            </div>
                                             <div class="col-md-12 ">
                                                <div class="card">
                                                    <div class="card-body">
                                                    <div class="col-md-12">
                                                        <div class="table-responsive">
                                                        <table class="table table-bordered">
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
      </div>
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.conl-sidebar -->

  <!-- Main Footer -->
  
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="<?= base_url() ?>/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url() ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url() ?>/dist/dist/js/adminlte.min.js"></script>
</body>
</html>

