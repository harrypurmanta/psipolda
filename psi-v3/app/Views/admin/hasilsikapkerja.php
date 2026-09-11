<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Hasil Sikap Kerja - Admin</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?= base_url() ?>/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>/dist/dist/css/adminlte.min.css">
  <link rel="icon" href="<?= base_url() ?>/images/bg/favicon.ico" type="image/gif">
  <style>
    @media print {
      .no-print {
        display: none !important;
      }
      .card {
        border: none !important;
        box-shadow: none !important;
      }
    }
  </style>
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <div class="no-print">
    <?= $this->include('admin/navbar') ?>
  </div>
  <!-- /.navbar -->

  <!-- Content Wrapper -->
  <div class="content-wrapper">
    <div class="content-header no-print">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Hasil Penilaian Sikap Kerja</h1>
          </div>
          <div class="col-sm-6 text-right">
            <a href="<?= base_url('admin/hasil/hasilsikapkerjapdf/' . (!empty($start_dttm) ? $start_dttm : date('Y-m-d')) . '/' . (!empty($end_dttm) ? $end_dttm : date('Y-m-d')) . '/' . (!empty($user[0]->user_id) ? $user[0]->user_id : '') . '/' . (!empty($materi_id) ? $materi_id : '')) ?>" target="_blank" class="btn btn-danger mr-1">
              <i class="fa fa-file-pdf"></i> Download PDF
            </a>
            <button onclick="window.print()" class="btn btn-default mr-1"><i class="fa fa-print"></i> Cetak</button>
            <button onclick="window.close()" class="btn btn-secondary"><i class="fa fa-times"></i> Tutup</button>
          </div>
        </div>
      </div>
    </div>

    <div class="content">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-outline card-primary">
              <div class="card-body">
                <div class="text-center mb-4">
                  <h3 class="font-weight-bold">HASIL PENILAIAN SIKAP KERJA</h3>
                  <h4>Materi: <b><?= esc($materi_nm) ?></b></h4>
                </div>
                <hr>

                <!-- Biodata Peserta -->
                <div class="card mb-4 bg-light">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6">
                        <table class="table table-sm table-borderless">
                          <tbody>
                            <tr>
                              <td class="font-weight-bold" width="180">No. Tes</td>
                              <td width="20">:</td>
                              <td><b class="text-primary font-weight-bold" style="font-size: 16px;"><?= !empty($no_tes) ? $no_tes : '-' ?></b></td>
                            </tr>
                            <tr>
                              <td class="font-weight-bold">Nama</td>
                              <td>:</td>
                              <td><b><?= !empty($user[0]->person_nm) ? $user[0]->person_nm : '-' ?></b></td>
                            </tr>
                            <tr>
                              <td class="font-weight-bold">Pangkat / NRP</td>
                              <td>:</td>
                              <td><?= (!empty($user[0]->pangkat) ? $user[0]->pangkat : '-') . ' / ' . (!empty($user[0]->nrp) ? $user[0]->nrp : '-') ?></td>
                            </tr>
                            <tr>
                              <td class="font-weight-bold">Kesatuan</td>
                              <td>:</td>
                              <td><?= !empty($user[0]->satuan_nm) ? $user[0]->satuan_nm : '-' ?></td>
                            </tr>
                            <tr>
                              <td class="font-weight-bold">Pendidikan</td>
                              <td>:</td>
                              <td><?= !empty($user[0]->pendidikan_nm) ? $user[0]->pendidikan_nm : '-' ?></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      <div class="col-md-6">
                        <table class="table table-sm table-borderless">
                          <tbody>
                            <tr>
                              <td class="font-weight-bold" width="180">Jenis Kelamin / Usia</td>
                              <td width="20">:</td>
                              <td><?= (!empty($user[0]->gender_cd) && strtolower($user[0]->gender_cd) == 'm' ? 'Laki-laki' : 'Perempuan') . ' / ' . $thn_lahir . ' Tahun' ?></td>
                            </tr>
                            <tr>
                              <td class="font-weight-bold">Tempat, Tgl Lahir</td>
                              <td>:</td>
                              <td><?= (!empty($user[0]->birth_place) ? $user[0]->birth_place . ', ' : '') . (!empty($user[0]->birth_dttm) ? date('d-m-Y', strtotime($user[0]->birth_dttm)) : '-') ?></td>
                            </tr>
                            <tr>
                              <td class="font-weight-bold">Tanggal Ujian</td>
                              <td>:</td>
                              <td><?= !empty($tanggal_pemeriksaan[0]->created_dttm) ? date('d-m-Y H:i', strtotime($tanggal_pemeriksaan[0]->created_dttm)) : date('d-m-Y') ?></td>
                            </tr>
                            <tr>
                              <td class="font-weight-bold">No. Handphone</td>
                              <td>:</td>
                              <td><?= !empty($user[0]->cellphone) ? $user[0]->cellphone : '-' ?></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Ringkasan Statistik -->
                <div class="row mb-4">
                  <div class="col-md-4 col-sm-6 col-12">
                    <div class="info-box bg-info">
                      <span class="info-box-icon"><i class="fas fa-tasks"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text">Total Terjawab</span>
                        <span class="info-box-number" style="font-size: 24px;"><?= $total_terjawab ?></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-6 col-12">
                    <div class="info-box bg-success">
                      <span class="info-box-icon"><i class="fas fa-check-circle"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text">Total Benar</span>
                        <span class="info-box-number" style="font-size: 24px;"><?= $total_benar ?></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-6 col-12">
                    <div class="info-box bg-danger">
                      <span class="info-box-icon"><i class="fas fa-times-circle"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text">Total Salah</span>
                        <span class="info-box-number" style="font-size: 24px;"><?= $total_salah ?></span>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Rincian Per Kolom -->
                <h5 class="font-weight-bold mb-3"><i class="fa fa-table"></i> Rincian Hasil Per Kolom</h5>
                <div class="table-responsive">
                  <table class="table table-bordered table-striped text-center">
                    <thead class="bg-dark text-white">
                      <tr>
                        <th style="width: 60px;">No</th>
                        <th style="text-align: left;">Nama Kolom</th>
                        <th style="width: 180px;">Terjawab</th>
                        <th style="width: 180px;">Benar</th>
                        <th style="width: 180px;">Salah</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (!empty($hasil_kolom)) { ?>
                        <?php $no = 1; foreach ($hasil_kolom as $row) { ?>
                          <tr>
                            <td><?= $no++ ?></td>
                            <td style="text-align: left; font-weight: 600;"><?= esc($row->kolom_nm) ?></td>
                            <td>
                              <span class="badge badge-info" style="font-size: 14px; padding: 6px 14px;">
                                <?= $row->terjawab ?>
                              </span>
                            </td>
                            <td>
                              <span class="badge badge-success" style="font-size: 14px; padding: 6px 14px;">
                                <?= $row->benar ?>
                              </span>
                            </td>
                            <td>
                              <span class="badge badge-danger" style="font-size: 14px; padding: 6px 14px;">
                                <?= $row->salah ?>
                              </span>
                            </td>
                          </tr>
                        <?php } ?>
                      <?php } else { ?>
                        <tr>
                          <td colspan="5">Tidak ada data hasil.</td>
                        </tr>
                      <?php } ?>
                    </tbody>
                    <tfoot class="bg-light font-weight-bold">
                      <tr>
                        <td colspan="2" style="text-align: right;">TOTAL:</td>
                        <td><span class="badge badge-info" style="font-size: 15px; padding: 6px 14px;"><?= $total_terjawab ?></span></td>
                        <td><span class="badge badge-success" style="font-size: 15px; padding: 6px 14px;"><?= $total_benar ?></span></td>
                        <td><span class="badge badge-danger" style="font-size: 15px; padding: 6px 14px;"><?= $total_salah ?></span></td>
                      </tr>
                    </tfoot>
                  </table>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <footer class="main-footer no-print">
    <strong>Copyright &copy; 2024.</strong> All rights reserved.
  </footer>
</div>

<!-- jQuery -->
<script src="<?= base_url() ?>/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url() ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url() ?>/dist/dist/js/adminlte.min.js"></script>
</body>
</html>
