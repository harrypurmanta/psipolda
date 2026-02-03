<?php
$request = \Config\Services::request();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Hasil Pauli Kreplin</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="<?= base_url() ?>/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>/dist/dist/css/adminlte.min.css">
  <link rel="icon" href="../../../../../images/bg/favicon.ico" type="image/gif">

  <style>
    .chart-wrapper {
    max-width: 900px;   /* atur sesuai kebutuhan */
    height: 400px;
    margin: 40px auto;  /* INI YANG MEMUSATKAN */
}

.chart-wrapper canvas {
    width: 100% !important;
    height: 100% !important;
    display: block;
}


  </style>
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">
  <?= $this->include('admin/navbar') ?>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
          
          </div>
          <div class="col-sm-6">
        
          </div>
        </div>
      </div>
    </div>
    <div class="content">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div>
              <button id="btnPrint" class="btn btn-primary btn-sm" type="button" onclick="CetakPauli()"><i class="fa fa-print"></i> Cetak</button>
            </div>
            <div class="card" id="dv_print">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="text-center"><h2>HASIL PENILAIAN</h2></div>
                            <hr> 
                            <div class="card">
                                <div class="card-body">
                                    <div class="row col-md-12">
                                    <div class="col-md-6">
                                        <table border="0">
                                            <tbody>
                                                <tr>
                                                    <td class="text-left text-bold" width="100">Nama</td>
                                                    <td class="text-center" width="30">:</td>
                                                    <td class="text-left"><?= $user[0]->person_nm ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left text-bold" width="100">Satuan</td>
                                                    <td class="text-center" width="30">:</td>
                                                    <td class="text-left"><?= $user[0]->satuan_nm ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left text-bold" width="100">Pangkat</td>
                                                    <td class="text-center" width="30">:</td>
                                                    <td class="text-left"><?= $user[0]->pangkat ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left text-bold" width="100">No Tes</td>
                                                    <td class="text-center" width="30">:</td>
                                                    <td class="text-left"><?= $notest ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table border="0">
                                            <tbody>
                                                <tr>
                                                    <td class="text-left text-bold" width="100">NRP</td>
                                                    <td class="text-center" width="30">:</td>
                                                    <td class="text-left"><?= $user[0]->nrp ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left text-bold" width="100">Pendidikan</td>
                                                    <td class="text-center" width="30">:</td>
                                                    <td class="text-left"><?= $user[0]->pendidikan_nm ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left text-bold" width="100">TTL</td>
                                                    <td class="text-center" width="30">:</td>
                                                    <td class="text-left"><?= $user[0]->birth_place ?>, <?= date("d-m-Y",strtotime($user[0]->birth_dttm)) ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                </div>
                            </div>
                                <hr>
                            <div class="card">
                                <div class="card-body">

                                    <div class="row"><!-- ROW WAJIB -->

                                        <!-- LEMBAR 1 -->
                                        <div class="col-md-6">
                                            <div class="text-center mb-3">
                                                <h3>Lembar 1</h3>
                                            </div>

                                            <table class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">No.</th>
                                                        <th class="text-center">Kolom</th>
                                                        <th class="text-center">Terjawab</th>
                                                        <th class="text-center">Tidak Terjawab</th>
                                                        <th class="text-center">Salah</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 1; foreach ($hasil[1] as $row) { ?>
                                                    <tr>
                                                        <td class="text-center"><?= $no++ ?></td>
                                                        <td><?= $row->kolom_nm ?></td>
                                                        <td class="text-center"><?= $row->terjawab ?></td>
                                                        <td class="text-center"><?= $row->tidak_terjawab ?></td>
                                                        <td class="text-center"><?= $row->salah ?></td>
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>

                                        <!-- LEMBAR 2 -->
                                        <div class="col-md-6">
                                            <div class="text-center mb-3">
                                                <h3>Lembar 2</h3>
                                            </div>

                                            <table class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">No.</th>
                                                        <th class="text-center">Kolom</th>
                                                        <th class="text-center">Terjawab</th>
                                                        <th class="text-center">Tidak Terjawab</th>
                                                        <th class="text-center">Salah</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 1; foreach ($hasil[2] as $row) { ?>
                                                    <tr>
                                                        <td class="text-center"><?= $no++ ?></td>
                                                        <td><?= $row->kolom_nm ?></td>
                                                        <td class="text-center"><?= $row->terjawab ?></td>
                                                        <td class="text-center"><?= $row->tidak_terjawab ?></td>
                                                        <td class="text-center"><?= $row->salah ?></td>
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div><!-- END ROW -->

                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">

                                    <div class="row"><!-- ROW WAJIB -->

                                        <!-- LEMBAR 1 -->
                                        <div class="col-md-6">
                                            <div class="text-center mb-3">
                                                <h3>Lembar 3</h3>
                                            </div>

                                            <table class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">No.</th>
                                                        <th class="text-center">Kolom</th>
                                                        <th class="text-center">Terjawab</th>
                                                        <th class="text-center">Tidak Terjawab</th>
                                                        <th class="text-center">Salah</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 1; foreach ($hasil[3] as $row) { ?>
                                                    <tr>
                                                        <td class="text-center"><?= $no++ ?></td>
                                                        <td><?= $row->kolom_nm ?></td>
                                                        <td class="text-center"><?= $row->terjawab ?></td>
                                                        <td class="text-center"><?= $row->tidak_terjawab ?></td>
                                                        <td class="text-center"><?= $row->salah ?></td>
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>

                                        <!-- LEMBAR 2 -->
                                        <div class="col-md-6">
                                            <div class="text-center mb-3">
                                                <h3>Lembar 4</h3>
                                            </div>

                                            <table class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">No.</th>
                                                        <th class="text-center">Kolom</th>
                                                        <th class="text-center">Terjawab</th>
                                                        <th class="text-center">Tidak Terjawab</th>
                                                        <th class="text-center">Salah</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 1; foreach ($hasil[4] as $row) { ?>
                                                    <tr>
                                                        <td class="text-center"><?= $no++ ?></td>
                                                        <td><?= $row->kolom_nm ?></td>
                                                        <td class="text-center"><?= $row->terjawab ?></td>
                                                        <td class="text-center"><?= $row->tidak_terjawab ?></td>
                                                        <td class="text-center"><?= $row->salah ?></td>
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div><!-- END ROW -->

                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="chart-wrapper">
                                            <div class="text-center"><h3>Lembar 1</h3></div>
                                            <canvas id="chart_sk_1"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="chart-wrapper">
                                            <div class="text-center"><h3>Lembar 2</h3></div>
                                            <canvas id="chart_sk_2"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="chart-wrapper">
                                            <div class="text-center"><h3>Lembar 3</h3></div>
                                            <canvas id="chart_sk_3"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="chart-wrapper">
                                            <div class="text-center"><h3>Lembar 4</h3></div>
                                            <canvas id="chart_sk_4"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>s
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="<?= base_url() ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url() ?>/dist/dist/js/adminlte.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- <script type="module" src="/dist/js/charttoimages/index.js"> -->
    
</script>
<script>
    // import { ChartJsImage } from "../../../../../../dist/js/charttoimages/index.js";
    function unduhpdf() {
      let start_date = "<?= $request->uri->getSegment(4) ?>";
      let end_date = "<?= $request->uri->getSegment(5) ?>";
      let user_id = <?= $request->uri->getSegment(6) ?>;
      
      window.open("<?= base_url() ?>/admin/hasil/hasilpaulipdf/"+start_date+"/"+end_date+"/"+user_id,'_blank');
    }

    function CetakPauli() {
        let start_date = "<?= $request->uri->getSegment(4) ?>";
        let end_date = "<?= $request->uri->getSegment(5) ?>";
        let user_id = <?= $request->uri->getSegment(6) ?>;
        window.open("<?= base_url() ?>/admin/hasil/cetakhasilpauli/"+start_date+"/"+end_date+"/"+user_id,'_blank');
    }

       const hasil = <?= json_encode($hasil) ?>;

       function buildCharts(skGroupId) {
            for (let sk_group_id = 1; sk_group_id <= 4; sk_group_id++) {

                const dataSk = hasil[sk_group_id];

                if (!dataSk) continue; // pengaman

                const labels = dataSk.map(item => item.kolom_nm);

                const datasets = [
                    {
                        label: 'Terjawab',
                        data: dataSk.map(item => parseInt(item.terjawab)),
                        tension: 0.3
                    },
                    {
                        label: 'Tidak Terjawab',
                        data: dataSk.map(item => parseInt(item.tidak_terjawab)),
                        tension: 0.3,
                        hidden: true
                    },
                    {
                        label: 'Salah',
                        data: dataSk.map(item => parseInt(item.salah)),
                        tension: 0.3,
                        hidden: true
                    }
                ];

                const ctx = document
                        .getElementById('chart_sk_' + sk_group_id)
                        .getContext('2d');

                    new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: labels,
                            datasets: datasets
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                y: {
                                    min: 0,     // 👈 mulai dari 0
                                    max: 60,    // 👈 sampai 60
                                    ticks: {
                                        stepSize: 5 // opsional, biar rapi
                                    }
                                }
                            },
                            plugins: {
                                legend: {
                                    position: 'top'
                                }
                            }
                        }

                    });

            }
            
        }
    buildCharts(hasil);

    </script>
</body>
</html>