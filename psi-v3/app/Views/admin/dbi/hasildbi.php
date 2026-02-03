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
                                            <div class="col-md-6">
                                                <p class="text-center">KEPOLISIAN NEGARA REPUBLIK INDONESIA <br>
                                                        DAERAH SUMATERA SELATAN <br>
                                                        BIRO SUMBER DAYA MANUSIA
                                                    </p>
                                                    <hr style="border: 1px solid black; margin-top: -12px !important;">
                                            </div>
                                            

                                            <div class="text-center"><h2>BDI</h2></div>
                                            <hr>

                                            <div class="card">
                                                <div class="card-body" style="padding-left: 0px; padding-right: 0px;">
                                                <div class="row col-md-12">
                                                    <div class="col-md-6" style="padding-left: 10px; padding-right: 0px;">
                                                        <table border="0" width="100%">
                                                            <tbody>
                                                                <tr>
                                                                    <td style="vertical-align: top;" class="text-left text-bold" width="110">Nama</td>
                                                                    <td style="vertical-align: top;" class="text-cente text-boldr" width="20">:</td>
                                                                    <td style="vertical-align: top;" class="text-left"><?= $user[0]->person_nm ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="vertical-align: top;" class="text-left text-bold" width="110">Pangkat/NRP</td>
                                                                    <td style="vertical-align: top;" class="text-center text-bold" width="20">:</td>
                                                                    <td style="vertical-align: top;" class="text-left"><?= $user[0]->pangkat ?> / <?= $user[0]->nrp ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="vertical-align: top;" class="text-left text-bold" width="110">Kesatuan</td>
                                                                    <td style="vertical-align: top;" class="text-center text-bold" width="20">:</td>
                                                                    <td style="vertical-align: top;" class="text-left"><?= $user[0]->satuan_nm ?></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="col-md-6" style="padding-left: 10px; padding-right: 0px;">
                                                        <table border="0" width="100%">
                                                            <tbody>
                                                                <tr>
                                                                    <td style="vertical-align: top;" class="text-left text-bold" width="150">Jenis Kelamin/Usia</td>
                                                                    <td style="vertical-align: top;" class="text-center text-bold" width="20">:</td>
                                                                    <td style="vertical-align: top;" class="text-left"><?= ($user[0]->gender_cd=="m"?"Laki-laki":"Perempuan") ?> / <?= $thn_lahir ?> Thn</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="vertical-align: top;" class="text-left text-bold" width="150">tgl Pemeriksaan</td>
                                                                    <td style="vertical-align: top;" class="text-center text-bold" width="20">:</td>
                                                                    <td style="vertical-align: top;" class="text-left"><?= date("d-m-Y",strtotime($tanggal_pemeriksaan[0]->created_dttm)) ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="vertical-align: top;" class="text-left text-bold" width="150">Pendidikan</td>
                                                                    <td style="vertical-align: top;" class="text-center text-bold" width="20">:</td>
                                                                    <td style="vertical-align: top;" class="text-left"><?= $user[0]->pendidikan_nm ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="vertical-align: top;" class="text-left text-bold" width="150">No. Peserta</td>
                                                                    <td style="vertical-align: top;" class="text-center text-bold" width="20">:</td>
                                                                    <td style="vertical-align: top;" class="text-left"><?= $notest ?></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                             </div>
                                                </div>
                                            </div>
                                             
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="col-md-12">
                                                        <table border="0">
                                                            <tbody>
                                                                <tr>
                                                                    <td width="100px"><strong>Total</strong></td>
                                                                    <td width="20px" class="text-center"><strong>:</strong></td>
                                                                    <td width="150px" id="td_total"><?= $total ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td width="100px"><strong>Kategori</strong></td>
                                                                    <td width="20px" class="text-center"><strong>:</strong></td>
                                                                    <td width="150px" id="td_kategori"><?= $kategori ?></td>
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

