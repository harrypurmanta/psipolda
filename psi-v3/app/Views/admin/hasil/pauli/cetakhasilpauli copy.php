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
/* ===================== */
/* UMUM */
.page {
    page-break-after: always;
    page-break-inside: avoid;
}

/* ===================== */
/* HALAMAN TABEL (PORTRAIT) */
.page-portrait {
    page-break-after: always;
}

/* ===================== */
/* HALAMAN CHART (LANDSCAPE) */
.page-landscape {
    page-break-after: always;
}

@media print {

    @page {
        size: A4;
        margin: 15mm;
    }

    @page landscape {
        size: A4 landscape;
        margin: 15mm;
    }

    .print-page {
        page-break-after: always;
        width: 100%;
    }

    .landscape {
        page: landscape;
    }

    h3 {
        margin-bottom: 10px;
    }

    /* Box chart DIKUNCI */
    .chart-box {
        width: 100%;
        /* height: 220mm; */
        display: flex;
        justify-content: center;
        align-items: center;
    }

    canvas {
        max-width: 100% !important;
        max-height: 100% !important;
    }

    .print-header {
        display: flex;
        width: 100%;
    }

    .col-left,
    .col-right {
        width: 50%;
    }

    .col-left table,
    .col-right table {
        width: 100%;
        font-size: 11pt;
    }
}
</style>

</head>
<body>
    <h2 style="text-align:center;">HASIL PENILAIAN</h2>
    <hr> 
    <div class="row print-header" style="text-align:center;">
        <div class="col-left">
            <table border="0" style="table-layout:fixed;width:90%;margin: 0 auto;line-height: 16px;">
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

        <div class="col-right">
            <table border="0" style="table-layout:fixed;width:90%;margin: 0 auto;line-height: 16px;">
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
    <hr>    
    <div class="page page-portrait">
        <div class="card">
            <div class="card-body">
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
        </div>
    </div>                       
    <div class="page page-portrait">
        <div class="card">
            <div class="card-body">
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
        </div>
    </div>

    <div class="page page-portrait">
        <div class="card">
            <div class="card-body">
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
        </div>
    </div>

    <div class="page page-portrait">
        <div class="card">
            <div class="card-body">
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
        </div>
    </div>
        
    
        <div class="print-page landscape">
            <h3 class="text-center">Grafik Lembar 1</h3>
            <div class="chart-box">
                <canvas id="chart_sk_1" style="height:600px;"></canvas>
            </div>
        </div>

        <div class="print-page landscape">
            <h3 class="text-center">Grafik Lembar 2</h3>
            <div class="chart-box">
                <canvas id="chart_sk_2" style="height:600px;"></canvas>
            </div>
        </div>

        <div class="print-page landscape">
            <h3 class="text-center">Grafik Lembar 3</h3>
            <div class="chart-box">
                <canvas id="chart_sk_3" style="height:600px;"></canvas>
            </div>
        </div>

        <div class="print-page landscape">
            <h3 class="text-center">Grafik Lembar 4</h3>
            <div class="chart-box">
                <canvas id="chart_sk_4" style="height:600px;"></canvas>
            </div>
        </div>



        
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="<?= base_url() ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url() ?>/dist/dist/js/adminlte.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
</script>
<script>
    const username   = "<?= $user[0]->user_nm ?>";
    const namaLengkap = "<?= $user[0]->person_nm ?>";
    const notest = "<?= $notest ?>";
    const safeName = (username + "_" + namaLengkap + "_" + notest)
        .replace(/[^a-z0-9_\- ]/gi, '')
        .replace(/\s+/g, '_');
    document.title = safeName;

    window.onload = function() {
        setTimeout(() => {
            window.print();
            window.onafterprint = window.close();
        }, 1000);
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
                            animation: false, // penting untuk cetak
                            scales: {
                                y: {
                                    min: 0,
                                    max: 60,
                                    ticks: {
                                        stepSize: 5
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
            

        $(document).ready(function(){
            buildCharts(hasil);
        });
    </script>
</body>
</html>
