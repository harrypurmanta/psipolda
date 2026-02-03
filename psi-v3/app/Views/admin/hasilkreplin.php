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
              <button id="btnPrint" class="btn btn-primary btn-sm" type="button" onclick="CetakKreplin()"><i class="fa fa-print"></i> Cetak</button>
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
                                                  <div class="row col-md-12">
                                                    <div class="col-md-6">
                                                    <table border="0">
                                                        <tbody>
                                                            <tr>
                                                                <td class="text-left text-bold" width="100">Jumlah Jawab</td>
                                                                <td class="text-center" width="30">:</td>
                                                                <td class="text-center"><?= $ttl_jawab ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-left text-bold" width="250">Jumlah Salah</td>
                                                                <td class="text-center" width="30">:</td>
                                                                <td class="text-center"><?= $jml_salah ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    </div>
                                                    <div class="col-md-6">
                                                    <table border="0">
                                                        <tbody>
                                                            <tr>
                                                                <td class="text-left text-bold" width="250">Rata - rata I (30 Detik Perkolom)</td>
                                                                <td class="text-center" width="30">:</td>
                                                                <td class="text-center"><?= $rata1 ?> X 2 = <?= $ttl_rata1 ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-left text-bold" width="250">Rata - rata II (20 Detik Perkolom)</td>
                                                                <td class="text-center" width="30">:</td>
                                                                <td class="text-center"><?= $rata2 ?> X 3 = <?= $ttl_rata2 ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    </div>
                                             </div>
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
                                                            <div class="col-md-6">
                                                                <div class='chart'>
                                                                    <canvas id='myLineChart1' style="min-height: 250px; height: 350px; max-height: 350px; max-width: 100%;"></canvas>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class='chart'>
                                                                    <canvas id='myLineChart3' style="min-height: 250px; height: 350px; max-height: 350px; max-width: 100%;"></canvas>
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
                                                            <div class="col-md-6" style="background-color:white;margin:5px;">
                                                                <div class='chart'>
                                                                    <canvas id='myLineChart2' style="min-height: 250px; height: 350px; max-height: 350px; max-width: 100%;"></canvas>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6" style="background-color:white;margin:5px;">
                                                                <div class='chart'>
                                                                    <canvas id='myLineChart4' style="min-height: 250px; height: 350px; max-height: 350px; max-width: 100%;"></canvas>
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
      </div><!-- /.container-fluid -->
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="<?= base_url() ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url() ?>/dist/dist/js/adminlte.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.6/dist/chart.umd.min.js"></script>
<!-- <script type="module" src="/dist/js/charttoimages/index.js"> -->
    
</script>
<script>
    // import { ChartJsImage } from "../../../../../../dist/js/charttoimages/index.js";
    function unduhpdf() {
      let start_date = "<?= $request->uri->getSegment(4) ?>";
      let end_date = "<?= $request->uri->getSegment(5) ?>";
      let user_id = <?= $request->uri->getSegment(6) ?>;
      
      window.open("<?= base_url() ?>/admin/hasil/hasilkreplinpdf/"+start_date+"/"+end_date+"/"+user_id,'_blank');
    }

    function CetakKreplin() {
        let start_date = "<?= $request->uri->getSegment(4) ?>";
        let end_date = "<?= $request->uri->getSegment(5) ?>";
        let user_id = <?= $request->uri->getSegment(6) ?>;
        window.open("<?= base_url() ?>/admin/hasil/cetakhasilkreplin/"+start_date+"/"+end_date+"/"+user_id,'_blank');
    }

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
                            min: 0,
                            max: 50,
                            stacked: true,
                            ticks: {
                                count: 5,
                                beginAtZero: true,
                                autoSkip: false, 
                                stepSize: 5,
                            },
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
                            min: 0,
                            max: 50,
                            stacked: true,
                            ticks: {
                                count: 5,
                                beginAtZero: true,
                                autoSkip: false, 
                                stepSize: 5,
                            },
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
                            min: 0,
                            max: 50,
                            stacked: true,
                            ticks: {
                                count: 5,
                                beginAtZero: true,
                                autoSkip: false, 
                                stepSize: 5,
                            },
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
                            min: 0,
                            max: 50,
                            stacked: true,
                            ticks: {
                                count: 5,
                                beginAtZero: true,
                                autoSkip: false, 
                                stepSize: 5,
                            },
                        }
                    }
                }
            });

        });
    </script>
</body>
</html>
