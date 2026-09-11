<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Hasil Tryout - Bagian Psikologi Polda Sumsel</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?= base_url() ?>/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <style>
        .table-hasil th {
            text-align: center;
            vertical-align: middle !important;
            background-color: #2c3b41;
            color: #ffffff;
            font-size: 15px;
        }
        .table-hasil td {
            vertical-align: middle !important;
            font-size: 14px;
        }
        .table-hasil tfoot td {
            font-weight: bold;
            font-size: 15px;
            background-color: #ecf0f5;
        }
        .info-box-number {
            font-size: 26px;
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
                <section class="content-header" style="text-align: center; margin-bottom: 15px;">
                    <h1>
                        <b>HASIL PENILAIAN SIKAP KERJA</b>
                    </h1>
                    <p style="font-size: 16px; color: #666; margin-top: 5px;">
                        Materi: <b><?= esc($materi_nm) ?></b>
                    </p>
                </section>

                <section class="content">
                    <!-- Tabel Hasil -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><i class="fa fa-table"></i> Rincian Hasil Per Kolom</h3>
                                </div>
                                <div class="box-body table-responsive">
                                    <table class="table table-bordered table-striped table-hover table-hasil">
                                        <thead>
                                            <tr>
                                                <th style="width: 60px;">No</th>
                                                <th>Nama Kolom</th>
                                                <th style="width: 160px;">Terjawab</th>
                                                <th style="width: 160px;">Benar</th>
                                                <th style="width: 160px;">Salah</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($hasil_kolom)) { ?>
                                                <?php $no = 1; foreach ($hasil_kolom as $row) { ?>
                                                    <tr>
                                                        <td class="text-center"><?= $no++ ?></td>
                                                        <td style="font-weight: 600;"><?= esc($row->kolom_nm) ?></td>
                                                        <td class="text-center">
                                                            <span class="badge bg-light-blue" style="font-size: 13px; padding: 5px 12px;">
                                                                <?= $row->terjawab ?>
                                                            </span>
                                                        </td>
                                                        <td class="text-center">
                                                            <span class="badge bg-green" style="font-size: 13px; padding: 5px 12px;">
                                                                <?= $row->benar ?>
                                                            </span>
                                                        </td>
                                                        <td class="text-center">
                                                            <span class="badge bg-red" style="font-size: 13px; padding: 5px 12px;">
                                                                <?= $row->salah ?>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <tr>
                                                    <td colspan="5" class="text-center">Tidak ada data hasil.</td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="2" class="text-center" style="font-weight: bold;">TOTAL</td>
                                                <td class="text-center" style="font-weight: bold; color: #3c8dbc;"><?= $total_terjawab ?></td>
                                                <td class="text-center" style="font-weight: bold; color: #00a65a;"><?= $total_benar ?></td>
                                                <td class="text-center" style="font-weight: bold; color: #dd4b39;"><?= $total_salah ?></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Grafik Hasil -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box box-success">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><i class="fa fa-bar-chart"></i> Grafik Performa Per Kolom</h3>
                                </div>
                                <div class="box-body">
                                    <div class="chart">
                                        <canvas id="barChart" style="height: 320px; width: 100%;"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="row">
                        <div class="col-md-12 text-center" style="margin-top: 10px; margin-bottom: 30px;">
                            <?php 
                                $back_url = base_url();
                                if (!empty($group_id)) {
                                    $back_url = base_url("sikapkerja/index/$group_id");
                                }
                            ?>
                            <a href="<?= $back_url ?>" class="btn btn-primary btn-lg" style="min-width: 160px;">
                                <i class="fa fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <?= $this->include('front/footer') ?>
    </div>

    <script src="<?= base_url() ?>/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?= base_url() ?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>/plugins/chart.js/Chart.min.js"></script>
    <script src="<?= base_url() ?>/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="<?= base_url() ?>/bower_components/fastclick/lib/fastclick.js"></script>
    <script src="<?= base_url() ?>/dist/js/adminlte.min.js"></script>

    <script>
        $(document).ready(function() {
            var chartCanvas = document.getElementById("barChart");
            if (chartCanvas) {
                var ctx = chartCanvas.getContext("2d");
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: <?= json_encode($chart_labels) ?>,
                        datasets: [
                            {
                                label: 'Terjawab',
                                backgroundColor: 'rgba(60, 141, 188, 0.85)',
                                borderColor: 'rgba(60, 141, 188, 1)',
                                borderWidth: 1,
                                data: <?= json_encode($chart_terjawab) ?>
                            },
                            {
                                label: 'Benar',
                                backgroundColor: 'rgba(0, 166, 90, 0.85)',
                                borderColor: 'rgba(0, 166, 90, 1)',
                                borderWidth: 1,
                                data: <?= json_encode($chart_benar) ?>
                            },
                            {
                                label: 'Salah',
                                backgroundColor: 'rgba(221, 75, 57, 0.85)',
                                borderColor: 'rgba(221, 75, 57, 1)',
                                borderWidth: 1,
                                data: <?= json_encode($chart_salah) ?>
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        legend: {
                            position: 'top'
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true,
                                    precision: 0
                                }
                            }]
                        }
                    }
                });
            }
        });
    </script>
</body>
</html>