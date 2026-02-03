<?php
$request = \Config\Services::request();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Hasil Kreplin</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="<?= base_url() ?>/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>/dist/dist/css/adminlte.min.css">
  <link rel="icon" href="../../../../../images/bg/favicon.ico" type="image/gif">
</head>
<body>
    <h2 style="text-align:center;">HASIL PENILAIAN</h2>
    <div class="col-md-12">
        <table border="0" style="width:100%;" width="100%">
            <tbody>
                <tr>
                    <td style="font-weight: bold;" width="100">Nama</td>
                    <td class="text-center" width="10">:</td>
                    <td class="text-left" width="300"><?= $user[0]->person_nm ?></td>
                    <td style="font-weight: bold;" width="100">NRP</td>
                    <td class="text-center" width="10">:</td>
                    <td class="text-left"><?= $user[0]->nrp ?></td>
                </tr>
                <tr>
                    <td style="font-weight: bold;" width="100">Satuan</td>
                    <td class="text-center" width="10">:</td>
                    <td class="text-left" width="300"><?= $user[0]->satuan ?></td>
                    <td style="font-weight: bold;" width="100">TTL</td>
                    <td class="text-center" width="10">:</td>
                    <td class="text-left" width="250"><?= $user[0]->birth_place ?>, <?= date("d-m-Y",strtotime($user[0]->birth_dttm)) ?></td>
                </tr>
                <tr>
                    <td style="font-weight: bold;" width="100">Pangkat</td>
                    <td class="text-center" width="10">:</td>
                    <td class="text-left" width="300"><?= $user[0]->pangkat ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <hr>
    <div class="col-md-6">
    <table border="0">
        <tbody>
            <tr>
                <td width="110">Jumlah Jawab</td>
                <td class="text-center" width="10">:</td>
                <td style="font-weight: bold;" width="300"><?= $ttl_jawab ?></td>
                <td width="200">Rata - rata I (30 Detik Perkolom)</td>
                <td class="text-center" width="10">:</td>
                <td style="font-weight: bold;"><?= $rata1 ?></td>
            </tr>
            <tr>
                <td width="110">Jumlah Salah</td>
                <td class="text-center" width="10">:</td>
                <td style="font-weight: bold;" width="300"><?= $jml_salah ?></td>
                <td width="200">Rata - rata II (20 Detik Perkolom)</td>
                <td class="text-center" width="10">:</td>
                <td style="font-weight: bold;"><?= $rata2 ?></td>
            </tr>
        </tbody>
    </table>
    </div>
    <hr>                                        

    <div class='chart'>
        <canvas id='myLineChart1' style="min-height: 250px; height: 350px; max-height: 350px; max-width: 100%;"></canvas>
    </div>
    
                                                                <div class='chart'>
                                                                    <canvas id='myLineChart3'></canvas>
                                                                </div>
                                                                <div class='chart'>
                                                                    <canvas id='myLineChart2'></canvas>
                                                                </div>
                                                                <div class='chart'>
                                                                    <canvas id='myLineChart4'></canvas>
                                                                </div>


<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="<?= base_url() ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url() ?>/dist/dist/js/adminlte.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.6/dist/chart.umd.min.js"></script>
<!-- <script>
        $(document).ready(function(){
            let labels1 = <?= json_encode($kolom1) ?>;
            let labels2 = <?= json_encode($kolom2) ?>;
            let labels3 = <?= json_encode($kolom3) ?>;
            let labels4 = <?= json_encode($kolom4) ?>;
            let dataset1Data = <?= json_encode($jml_jawab1) ?>;
            let dataset2Data = <?= json_encode($jml_jawab2) ?>;
            let dataset3Data = <?= json_encode($jml_jawab3) ?>;
            let dataset4Data = <?= json_encode($jml_jawab4) ?>;
    
            // Creating line chart
            let ctx = 
                document.getElementById('myLineChart1').getContext('2d');
            let myLineChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels1,
                    datasets: [
                        {
                            label: 'Jumlah Jawab',
                            data: dataset1Data,
                            borderColor: 'blue',
                            borderWidth: 2,
                            fill: false,
                        }
                    ]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Group 1',
                                font: {
                                    padding: 4,
                                    size: 20,
                                    weight: 'bold',
                                    family: 'Arial'
                                },
                                color: 'darkblue'
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Jumlah Soal',
                                font: {
                                    size: 12,
                                    weight: 'bold',
                                    family: 'Arial'
                                },
                                color: 'darkblue'
                            },
                            beginAtZero: true,
                            min: 0,
                            max: 60,
                            scaleLabel: {
                                display: true,
                                labelString: 'Values',
                            },
                        }
                    }
                }
            });

            let ctx3 = 
                document.getElementById('myLineChart3').getContext('2d');
            let myLineChart3 = new Chart(ctx3, {
                type: 'line',
                data: {
                    labels: labels3,
                    datasets: [
                        {
                            label: 'Jumlah Jawab',
                            data: dataset3Data,
                            borderColor: 'blue',
                            borderWidth: 2,
                            fill: false,
                        }
                    ]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Group 3',
                                font: {
                                    padding: 4,
                                    size: 20,
                                    weight: 'bold',
                                    family: 'Arial'
                                },
                                color: 'darkblue'
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Jumlah Soal',
                                font: {
                                    size: 12,
                                    weight: 'bold',
                                    family: 'Arial'
                                },
                                color: 'darkblue'
                            },
                            beginAtZero: true,
                            min: 0,
                            max: 60,
                            scaleLabel: {
                                display: true,
                                labelString: 'Values',
                            }
                        }
                    }
                }
            });

            //chart group 2
            let ctx2 = 
                document.getElementById('myLineChart2').getContext('2d');
            let myLineChart2 = new Chart(ctx2, {
                type: 'line',
                data: {
                    labels: labels2,
                    datasets: [
                        {
                            label: 'Jumlah Jawab',
                            data: dataset2Data,
                            borderColor: 'green',
                            borderWidth: 2,
                            fill: false,
                        }
                    ]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Group 2',
                                font: {
                                    padding: 4,
                                    size: 20,
                                    weight: 'bold',
                                    family: 'Arial'
                                },
                                color: 'darkblue'
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Jumlah Soal',
                                font: {
                                    size: 12,
                                    weight: 'bold',
                                    family: 'Arial'
                                },
                                color: 'darkblue'
                            },
                            beginAtZero: true,
                            min: 0,
                            max: 60,
                            scaleLabel: {
                                display: true,
                                labelString: 'Values',
                            }
                        }
                    }
                }
            });

            //chart 4

            let ctx4 = 
                document.getElementById('myLineChart4').getContext('2d');
            let myLineChart4 = new Chart(ctx4, {
                type: 'line',
                data: {
                    labels: labels4,
                    datasets: [
                        {
                            label: 'Jumlah Jawab',
                            data: dataset4Data,
                            borderColor: 'green',
                            borderWidth: 2,
                            fill: false,
                        }
                    ]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Group 4',
                                font: {
                                    padding: 4,
                                    size: 20,
                                    weight: 'bold',
                                    family: 'Arial'
                                },
                                color: 'darkblue'
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Jumlah Soal',
                                font: {
                                    size: 12,
                                    weight: 'bold',
                                    family: 'Arial'
                                },
                                color: 'darkblue'
                            },
                            beginAtZero: true,
                            min: 0,
                            max: 60,
                            scaleLabel: {
                                display: true,
                                labelString: 'Values',
                            }
                        }
                    }
                }
            });

        });
    </script> -->
</body>
</html>
