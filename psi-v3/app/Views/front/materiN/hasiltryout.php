<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Hasil Tryout Materi N - Bagian Psikologi Polda Sumsel</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?= base_url() ?>/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <style>
        .content-header h1 {
            font-weight: 700;
            color: #222d32;
            letter-spacing: -0.5px;
            margin-bottom: 5px;
        }
        .header-meta {
            font-size: 15px;
            color: #606f7b;
            margin-bottom: 20px;
        }
        .card-stat {
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.07);
            border: 1px solid #e2e8f0;
            margin-bottom: 20px;
            overflow: hidden;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .card-stat:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 14px rgba(0,0,0,0.1);
        }
        .card-stat .card-stat-header {
            padding: 14px 18px;
            font-size: 16px;
            font-weight: 700;
            border-bottom: 1px solid #edf2f7;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .card-stat-header.bg-header-kecerdasan {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: #ffffff;
        }
        .card-stat-header.bg-header-kepribadian {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            color: #ffffff;
        }
        .card-stat-body {
            padding: 20px 18px;
        }
        .mini-stat-box {
            text-align: center;
            padding: 15px 10px;
            border-radius: 6px;
            background: #f8fafc;
            border: 1px solid #eef2f7;
            margin-bottom: 10px;
        }
        .mini-stat-title {
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #64748b;
            margin-bottom: 6px;
        }
        .mini-stat-value {
            font-size: 28px;
            font-weight: 700;
            line-height: 1;
        }
        .text-terjawab {
            color: #2563eb;
        }
        .text-benar {
            color: #16a34a;
        }
        .text-salah {
            color: #dc2626;
        }
        .table-custom-sk th {
            text-align: center;
            vertical-align: middle !important;
            background-color: #1e293b !important;
            color: #f8fafc !important;
            font-size: 14px;
            font-weight: 600;
            border-color: #334155 !important;
        }
        .table-custom-sk td {
            vertical-align: middle !important;
            font-size: 14px;
        }
        .table-custom-sk tfoot td {
            font-weight: 700;
            font-size: 15px;
            background-color: #f1f5f9 !important;
        }
        .badge-pill-custom {
            display: inline-block;
            min-width: 48px;
            padding: 6px 12px;
            font-size: 13px;
            font-weight: 600;
            border-radius: 12px;
        }
        .badge-terjawab {
            background-color: #dbeafe;
            color: #1e40af;
        }
        .badge-benar {
            background-color: #dcfce7;
            color: #15803d;
        }
        .badge-salah {
            background-color: #fee2e2;
            color: #b91c1c;
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
                <section class="content-header text-center" style="margin-top: 15px; margin-bottom: 25px;">
                    <h1><b>HASIL TRYOUT MATERI N</b></h1>
                    <div class="header-meta">
                        <span><i class="fa fa-users"></i> <?= esc($group_nm) ?></span>
                        <span style="margin: 0 10px;">|</span>
                        <span><i class="fa fa-calendar"></i> <?= date('d F Y') ?></span>
                    </div>
                </section>

                <section class="content">
                    <!-- SECTION 1: KECERDASAN & KEPRIBADIAN -->
                    <div class="row">
                        <!-- Card Kecerdasan -->
                        <div class="col-md-6">
                            <div class="card-stat">
                                <div class="card-stat-header bg-header-kecerdasan">
                                    <span><i class="fa fa-lightbulb-o" style="margin-right: 8px;"></i> <?= esc($nm_kecerdasan) ?></span>
                                </div>
                                <div class="card-stat-body">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <div class="mini-stat-box">
                                                <div class="mini-stat-title">Terjawab</div>
                                                <div class="mini-stat-value text-terjawab"><?= (int)$terjawab_kec ?></div>
                                            </div>
                                        </div>
                                        <div class="col-xs-4">
                                            <div class="mini-stat-box">
                                                <div class="mini-stat-title">Benar</div>
                                                <div class="mini-stat-value text-benar"><?= (int)$benar_kec ?></div>
                                            </div>
                                        </div>
                                        <div class="col-xs-4">
                                            <div class="mini-stat-box">
                                                <div class="mini-stat-title">Salah</div>
                                                <div class="mini-stat-value text-salah"><?= (int)$salah_kec ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card Kepribadian -->
                        <div class="col-md-6">
                            <div class="card-stat">
                                <div class="card-stat-header bg-header-kepribadian">
                                    <span><i class="fa fa-user-circle-o" style="margin-right: 8px;"></i> <?= esc($nm_kepribadian) ?></span>
                                </div>
                                <div class="card-stat-body">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <div class="mini-stat-box">
                                                <div class="mini-stat-title">Terjawab</div>
                                                <div class="mini-stat-value text-terjawab"><?= (int)$terjawab_kep ?></div>
                                            </div>
                                        </div>
                                        <div class="col-xs-4">
                                            <div class="mini-stat-box">
                                                <div class="mini-stat-title">Benar</div>
                                                <div class="mini-stat-value text-benar"><?= (int)$benar_kep ?></div>
                                            </div>
                                        </div>
                                        <div class="col-xs-4">
                                            <div class="mini-stat-box">
                                                <div class="mini-stat-title">Salah</div>
                                                <div class="mini-stat-value text-salah"><?= (int)$salah_kep ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SECTION 2: SIKAP KERJA (DATATABLE BERBEDA) -->
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-md-12">
                            <div class="box box-primary" style="border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.07); overflow: hidden;">
                                <div class="box-header with-border" style="background-color: #f8fafc; padding: 14px 18px;">
                                    <h3 class="box-title" style="font-weight: 700; color: #1e293b;">
                                        <i class="fa fa-table" style="margin-right: 8px; color: #3c8dbc;"></i> 
                                        <?= esc($nm_sikapkerja) ?> - Rincian Hasil Per Kolom
                                    </h3>
                                </div>
                                <div class="box-body table-responsive" style="padding: 18px;">
                                    <table id="table_sikap_kerja" class="table table-bordered table-striped table-hover table-custom-sk" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th style="width: 50px;">No</th>
                                                <th>Nama Kolom</th>
                                                <th style="width: 180px;">Jumlah Terjawab</th>
                                                <th style="width: 180px;">Jumlah Benar</th>
                                                <th style="width: 180px;">Jumlah Salah</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($hasil_sikap_kerja)) { ?>
                                                <?php $no = 1; foreach ($hasil_sikap_kerja as $row) { ?>
                                                    <tr>
                                                        <td class="text-center" style="font-weight: 600; color: #64748b;"><?= $no++ ?></td>
                                                        <td style="font-weight: 600; color: #1e293b;"><?= esc($row->kolom_nm) ?></td>
                                                        <td class="text-center">
                                                            <span class="badge-pill-custom badge-terjawab">
                                                                <?= (int)$row->terjawab ?>
                                                            </span>
                                                        </td>
                                                        <td class="text-center">
                                                            <span class="badge-pill-custom badge-benar">
                                                                <?= (int)$row->benar ?>
                                                            </span>
                                                        </td>
                                                        <td class="text-center">
                                                            <span class="badge-pill-custom badge-salah">
                                                                <?= (int)$row->salah ?>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <tr>
                                                    <td colspan="5" class="text-center" style="padding: 20px; color: #94a3b8;">
                                                        Tidak ada data hasil untuk Sikap Kerja.
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="2" class="text-center" style="font-weight: 700; color: #1e293b;">TOTAL</td>
                                                <td class="text-center" style="font-weight: 700; color: #1e40af; font-size: 16px;"><?= (int)$total_sk_terjawab ?></td>
                                                <td class="text-center" style="font-weight: 700; color: #15803d; font-size: 16px;"><?= (int)$total_sk_benar ?></td>
                                                <td class="text-center" style="font-weight: 700; color: #b91c1c; font-size: 16px;"><?= (int)$total_sk_salah ?></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SECTION 3: GRAFIK SIKAP KERJA -->
                    <?php if (!empty($chart_labels)) { ?>
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-md-12">
                            <div class="box box-success" style="border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.07); overflow: hidden;">
                                <div class="box-header with-border" style="background-color: #f8fafc; padding: 14px 18px;">
                                    <h3 class="box-title" style="font-weight: 700; color: #1e293b;">
                                        <i class="fa fa-bar-chart" style="margin-right: 8px; color: #00a65a;"></i> 
                                        Grafik Performa Sikap Kerja Per Kolom
                                    </h3>
                                </div>
                                <div class="box-body" style="padding: 20px;">
                                    <div class="chart">
                                        <canvas id="barChartSikapKerja" style="height: 320px; width: 100%;"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>

                    <!-- SECTION 4: TOMBOL KEMBALI -->
                    <div class="row" style="margin-top: 20px; margin-bottom: 40px;">
                        <div class="col-md-12 text-center">
                            <a href="<?= base_url() ?>" class="btn btn-primary btn-lg" style="min-width: 200px; border-radius: 6px; font-weight: 600; box-shadow: 0 4px 12px rgba(60, 141, 188, 0.3);">
                                <i class="fa fa-arrow-left" style="margin-right: 8px;"></i> Kembali ke Menu Utama
                            </a>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <?= $this->include('front/footer') ?>
    </div>

    <!-- Scripts -->
    <script src="<?= base_url() ?>/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?= base_url() ?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="<?= base_url() ?>/plugins/chart.js/Chart.min.js"></script>
    <script src="<?= base_url() ?>/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="<?= base_url() ?>/bower_components/fastclick/lib/fastclick.js"></script>
    <script src="<?= base_url() ?>/dist/js/adminlte.min.js"></script>

    <script>
        $(document).ready(function() {
            // Inisialisasi DataTable untuk Sikap Kerja
            $('#table_sikap_kerja').DataTable({
                "paging": true,
                "pageLength": 10,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "language": {
                    "search": "Cari Kolom:",
                    "zeroRecords": "Tidak ada data yang cocok",
                    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ kolom",
                    "infoEmpty": "Menampilkan 0 sampai 0 dari 0 kolom",
                    "infoFiltered": "(disaring dari _MAX_ total data)",
                    "paginate": {
                        "first": "Awal",
                        "last": "Akhir",
                        "next": "Berikutnya",
                        "previous": "Sebelumnya"
                    }
                }
            });

            // Inisialisasi Grafik Batang Sikap Kerja
            var chartCanvas = document.getElementById("barChartSikapKerja");
            if (chartCanvas) {
                var ctx = chartCanvas.getContext("2d");
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: <?= json_encode($chart_labels ?? []) ?>,
                        datasets: [
                            {
                                label: 'Terjawab',
                                backgroundColor: 'rgba(37, 99, 235, 0.85)',
                                borderColor: 'rgba(37, 99, 235, 1)',
                                borderWidth: 1,
                                data: <?= json_encode($chart_terjawab ?? []) ?>
                            },
                            {
                                label: 'Benar',
                                backgroundColor: 'rgba(22, 163, 74, 0.85)',
                                borderColor: 'rgba(22, 163, 74, 1)',
                                borderWidth: 1,
                                data: <?= json_encode($chart_benar ?? []) ?>
                            },
                            {
                                label: 'Salah',
                                backgroundColor: 'rgba(220, 38, 38, 0.85)',
                                borderColor: 'rgba(220, 38, 38, 1)',
                                borderWidth: 1,
                                data: <?= json_encode($chart_salah ?? []) ?>
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        legend: {
                            position: 'top',
                            labels: {
                                fontStyle: 'bold',
                                fontColor: '#334155'
                            }
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true,
                                    precision: 0,
                                    fontColor: '#64748b'
                                },
                                gridLines: {
                                    color: '#e2e8f0',
                                    drawBorder: false
                                }
                            }],
                            xAxes: [{
                                ticks: {
                                    fontColor: '#64748b'
                                },
                                gridLines: {
                                    display: false
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