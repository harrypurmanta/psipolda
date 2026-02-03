<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Bagian Psikologi Polda Sumsel</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?= base_url() ?>/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/dist/css/skins/_all-skins.min.css">
    <link rel="icon" href="images/bg/favicon.ico" type="image/gif">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue layout-top-nav">
    <div class="wrapper">
        <header class="main-header">
            <?= $this->include('front/navbar') ?>
        </header>

        <div class="content-wrapper">
        <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body bg-gray">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="text-center"><h2>HASIL PENILAIAN</h2></div>
                                            <div class="col-md-12">
                                             <hr>
                                             </div>
                                            <div class="col-md-12">
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
                                                                    <td class="text-left"><?= $user[0]->satuan ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-left text-bold" width="100">Pangkat</td>
                                                                    <td class="text-center" width="30">:</td>
                                                                    <td class="text-left"><?= $user[0]->pangkat ?></td>
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
                                                                    <td class="text-left"><?= $user[0]->pendidikan ?></td>
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
                                             <div class="col-md-12">
                                             <hr>
                                             </div>
                                             <div class="col-md-12">
                                                    <div class="col-md-12">
                                                    <table border="0">
                                                        <tbody>
                                                            <tr>
                                                                <td class="text-left text-bold" width="250">Jumlah Salah</td>
                                                                <td class="text-center" width="30">:</td>
                                                                <td class="text-center"><?= $jml_salah ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-left text-bold" width="100">Rata - rata I (30 Detik Perkolom)</td>
                                                                <td class="text-center" width="30">:</td>
                                                                <td class="text-center"><?= $rata1 ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-left text-bold" width="100">Rata - rata II (20 Detik Perkolom)</td>
                                                                <td class="text-center" width="30">:</td>
                                                                <td class="text-center"><?= $rata2 ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    </div>
                                             </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <div class="row" style="margin-top:10px;">
                                            <div class="col-md-12">
                                                <div class='card'>
                                                    <div class='card-body'>
                                                        <div class="text-center" style="display: flex;align-items: center;justify-content: center;">
                                                            <div class="col-md-5" style="background-color:white;margin:5px;">
                                                                <div class='chart'>
                                                                    <canvas id='myLineChart1'></canvas>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-5" style="background-color:white;margin:5px;">
                                                                <div class='chart'>
                                                                    <canvas id='myLineChart3'></canvas>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class='card'>
                                                    <div class='card-body'>
                                                        <div class="text-center" style="display: flex;align-items: center;justify-content: center;">
                                                            <div class="col-md-5" style="background-color:white;margin:5px;">
                                                                <div class='chart'>
                                                                    <canvas id='myLineChart2'></canvas>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-5" style="background-color:white;margin:5px;">
                                                                <div class='chart'>
                                                                    <canvas id='myLineChart4'></canvas>
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
        
    </script>
</body>

</html>