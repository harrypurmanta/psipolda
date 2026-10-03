<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Bagian Psikologi Polda Sumsel</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?= base_url() ?>/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/dist/css/skins/_all-skins.min.css">
    <link rel="icon" href="../../../../../images/bg/favicon.ico" type="image/gif">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue layout-top-nav">
    <div class="wrapper">
        <header class="main-header">
            <?= $this->include('front/navbar') ?>
        </header>

        <div class="content-wrapper">
            <div class="container">
                <section class="content">
                    <div class="row">
                    <div class="col-md-12" style="display: flex;justify-content: center;margin-bottom:20px;">
                                <h2><b>MATERI</b></h2>
                    </div>
                    <div class="col-md-12">
                            <?php
                                $this->session = \Config\Services::session();
                                $user_id = $this->session->user_id;
                                $db = db_connect();
                                foreach ($materi as $key) {
                                    $query = $db->query("SELECT * FROM respon WHERE materi = $key->materi_id AND group_id = $key->group_id AND created_user_id = $user_id AND status_cd = 'finish'")->getResultArray();

                                    if (count($query)>0) {
                                        $click = "";
                                        $class_bg = "bg-green";
                                        $a_bg = "bg-green";
                                        $icon= "fa-check";
                                        $text= "Selesai";
                                    } else {
                                        $click = "href='".base_url()."/tiu5/petunjuktiu5/". $key->materi_id ."/". $key->group_id."'";
                                        $class_bg = "bg-gray";
                                        $a_bg = "bg-blue";
                                        $icon= "fa-arrow-circle-right";
                                        $text= "Mulai";
                                    }
                            ?>
                            <div class="col-lg-5">
                                <div class="small-box <?= $class_bg ?>" style="border-radius:10px;">
                                    <div class="inner text-center">
                                        <h3><?= $key->materi_nm ?></h3>
                                    </div>
                                        <a <?= $click ?> class="btn small-box-footer <?= $a_bg ?>" style="color:black;font-size:16px;">
                                        <?= $text ?> <i class="fa <?= $icon ?>"></i>
                                        </a>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </section>
                
            </div>
        </div>
                <div class="modal fade" id="modal-token">
                    <div class="modal-dialog modal-md">
                        <div class="modal-content">
                            <div class="modal-header bg-blue">
                                <!-- <h4>Masukkan Token</h4> -->
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div id="modal_body" class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="token">Token</label>
                                                <input class="form-control" type="text" name="token" id="token" placeholder="Masukkan Token" maxlength="6" minlength="6">
                                                <input class="form-control" type="hidden" name="group_idx" id="group_idx">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <button style="margin-top: 25px;" class="btn btn-primary" type="button" onclick="checktoken()">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        <?= $this->include('front/footer') ?>
    </div>
    <script src="<?= base_url() ?>/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?= base_url() ?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="<?= base_url() ?>/bower_components/fastclick/lib/fastclick.js"></script>
    <script src="<?= base_url() ?>/dist/js/adminlte.min.js"></script>
    <script>
        function showtoken(group_id) {
            $("#group_idx").val(group_id);
            $("#modal-token").modal("show");
        }
        function checktoken() {
            var token = $("#token").val();
            var group_id = $("#group_idx").val();
            
            $.ajax({
                url: "<?= base_url('token/checktoken') ?>",
                type: "post",
                dataType: "json",
                data: {
                    "token": token,
                    "group_id": group_id
                },
                beforeSend: function() {
                    $("#loader-wrapper").removeClass("d-none");
                },
                success: function(data) {
                    if (data == "sukses") {
                        alert("Token berhasil disimpan");
                        if (group_id == 3) {
                            window.location.href = "<?= base_url() ?>/kreplin/petunjukkreplin/1/"+group_id;
                        } else if (group_id == 2) {
                            window.location.href = "<?= base_url() ?>/tryout/petunjukkedua/1/"+group_id;
                        } else if (group_id == 1) {
                            window.location.href = "<?= base_url() ?>/tryout/petunjukpertama/1/"+group_id;
                        } else if (group_id == 4) {
                            window.location.href = "<?= base_url() ?>/dass/petunjukdass/1/"+group_id;
                        } else if (group_id == 5) {
                            window.location.href = "<?= base_url() ?>/tiu5/index/"+group_id;
                        }
                    } else {
                        alert("Token salah/tidak ada, hubungi administrator");
                    }
                    $("#loader-wrapper").addClass("d-none");
                },
                error: function() {
                    alert("Error");
                    $("#loader-wrapper").addClass("d-none");
                }
            });
        }
    </script>
</body>

</html>