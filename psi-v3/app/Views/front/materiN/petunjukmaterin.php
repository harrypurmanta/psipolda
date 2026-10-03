<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Petunjuk Pengerjaan - <?= esc($materi[0]->materi_nm ?? 'Materi N') ?> - Bagian Psikologi Polda Sumsel</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?= base_url() ?>/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    
    <style>
        html, body {
            height: 100% !important;
            min-height: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            overflow: hidden !important;
            background-color: #ecf0f5 !important;
            font-family: 'Source Sans Pro', 'Helvetica Neue', Helvetica, Arial, sans-serif;
        }
        body > .wrapper {
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            right: 0 !important;
            bottom: 0 !important;
            width: 100vw !important;
            height: 100vh !important;
            max-height: 100vh !important;
            display: flex !important;
            flex-direction: column !important;
            justify-content: space-between !important;
            overflow: hidden !important;
            background-color: #ecf0f5 !important;
            z-index: 1 !important;
        }
        .main-header {
            flex: 0 0 auto !important;
            width: 100% !important;
            z-index: 1030 !important;
        }
        .content-wrapper {
            flex: 1 1 auto !important;
            height: auto !important;
            min-height: 0 !important;
            max-height: calc(100vh - 95px) !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            margin: 0 !important;
            padding: 0 15px !important;
            background-color: #ecf0f5 !important;
            overflow: hidden !important;
        }
        .content-wrapper > .container {
            width: 100% !important;
            max-width: 820px !important;
            padding: 0 !important;
            margin: 0 auto !important;
            display: flex !important;
            justify-content: center !important;
            align-items: center !important;
        }
        .content {
            width: 100% !important;
            padding: 0 !important;
            margin: 0 !important;
            display: flex !important;
            justify-content: center !important;
        }
        .main-footer {
            flex: 0 0 auto !important;
            width: 100% !important;
            height: 44px !important;
            min-height: 44px !important;
            padding: 12px 20px !important;
            background-color: #ffffff !important;
            border-top: 1px solid #d2d6de !important;
            color: #444444 !important;
            font-size: 13px !important;
            line-height: 1.4 !important;
            margin: 0 !important;
            z-index: 1000 !important;
        }

        /* CARD CONSISTENT SIZE */
        .petunjuk-wrapper {
            width: 760px;
            max-width: 100%;
            margin: 0 auto;
        }
        .petunjuk-card {
            width: 760px;
            height: 430px;
            min-height: 430px;
            max-height: 430px;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08), 0 2px 8px rgba(0, 0, 0, 0.04);
            border: 1px solid #dce2e6;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }
        .petunjuk-header {
            height: 70px;
            min-height: 70px;
            max-height: 70px;
            padding: 0 24px;
            display: flex;
            align-items: center;
            color: #ffffff;
            flex-shrink: 0;
        }
        .header-kecerdasan {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
        }
        .header-kepribadian {
            background: linear-gradient(135deg, #0f766e 0%, #14b8a6 100%);
        }
        .header-sikapkerja {
            background: linear-gradient(135deg, #b45309 0%, #f59e0b 100%);
        }
        .header-content-inline {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .header-left {
            display: flex;
            align-items: center;
        }
        .petunjuk-icon-circle {
            width: 44px;
            height: 44px;
            line-height: 44px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            text-align: center;
            font-size: 20px;
            color: #ffffff;
            margin-right: 14px;
            flex-shrink: 0;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        .header-text-group h2 {
            font-weight: 700;
            font-size: 18px;
            letter-spacing: -0.2px;
            margin: 0;
            text-transform: uppercase;
            line-height: 1.2;
        }
        .header-text-group p {
            margin: 3px 0 0 0;
            font-size: 13px;
            opacity: 0.9;
        }
        .materi-badge {
            background: rgba(255, 255, 255, 0.25);
            padding: 5px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            letter-spacing: 0.4px;
            white-space: nowrap;
        }

        /* CARD BODY UNIFORM LAYOUT */
        .petunjuk-body {
            flex: 1 1 auto;
            height: 360px;
            min-height: 360px;
            max-height: 360px;
            padding: 22px 28px 18px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            background: #ffffff;
            box-sizing: border-box;
        }
        .instructions-box {
            background: #f8fafc;
            border-left: 4px solid #2563eb;
            border-radius: 0 8px 8px 0;
            padding: 14px 18px;
            font-size: 15px;
            line-height: 1.55;
            color: #334155;
            min-height: 88px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .info-pill-container {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            justify-content: center;
            align-items: center;
        }
        .info-pill {
            display: inline-flex;
            align-items: center;
            background: #f1f5f9;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            padding: 7px 14px;
            font-size: 13px;
            color: #1e293b;
            font-weight: 600;
        }
        .info-pill i {
            margin-right: 7px;
            font-size: 15px;
        }
        .alert-start-notice {
            background: #fffbeb;
            border: 1px solid #fef3c7;
            border-radius: 6px;
            padding: 10px 16px;
            color: #92400e;
            font-size: 13.5px;
            display: flex;
            align-items: center;
            line-height: 1.45;
        }
        .alert-start-notice i {
            font-size: 20px;
            margin-right: 12px;
            color: #d97706;
            flex-shrink: 0;
        }
        .btn-container {
            text-align: center;
            padding-bottom: 2px;
        }
        .btn-start-ujian {
            display: inline-block;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: #ffffff !important;
            font-size: 17px;
            font-weight: 700;
            padding: 11px 45px;
            border-radius: 25px;
            border: none;
            box-shadow: 0 4px 14px rgba(16, 185, 129, 0.4);
            transition: all 0.2s ease;
            letter-spacing: 0.4px;
            text-decoration: none !important;
        }
        .btn-start-ujian:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(16, 185, 129, 0.5);
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
            color: #ffffff !important;
        }
        .btn-start-ujian:active {
            transform: translateY(1px);
        }

        /* SIKAP KERJA MINI EXAMPLE */
        .sk-example-wrap {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin-top: 6px;
            background: #ffffff;
            border: 1px solid #dce2e6;
            border-radius: 8px;
            padding: 6px 14px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.04);
        }
        .sk-example-label {
            font-size: 13px;
            font-weight: 700;
            color: #475569;
            margin-bottom: 5px;
            letter-spacing: 0.3px;
            text-align: center;
        }
        .example-table-inline {
            border-collapse: separate;
            border-spacing: 8px 4px;
            margin: 0 auto;
        }
        .example-table-inline td {
            text-align: center;
            width: 52px;
            height: 34px;
            line-height: 34px;
            padding: 0;
            border-radius: 6px;
            border: 1px solid #cbd5e1;
        }
        .example-table-inline td.char-cell {
            font-weight: 700;
            background-color: #f8fafc;
            color: #0f172a;
            font-size: 20px;
            box-shadow: 0 1px 2px rgba(0,0,0,0.05);
        }
        .example-table-inline td.opsi-cell {
            font-weight: 800;
            background-color: #eff6ff;
            border-color: #93c5fd;
            color: #1d4ed8;
            font-size: 17px;
        }

        /* RESPONSIVE FALLBACK FOR VERY SMALL SCREENS */
        @media (max-width: 800px) {
            .petunjuk-wrapper, .petunjuk-card {
                width: 95% !important;
                max-width: 95% !important;
            }
        }
        @media (max-height: 560px) {
            body > .wrapper {
                position: relative !important;
                height: auto !important;
                min-height: 100vh !important;
                overflow-y: auto !important;
            }
            html, body {
                overflow-y: auto !important;
            }
            .content-wrapper {
                max-height: none !important;
                padding: 15px 0 !important;
            }
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
                <section class="content">
                    <?php
                        $materi_id = (int)$materi[0]->materi_id;
                        $materi_nm = $materi[0]->materi_nm;

                        // Tentukan tema & icon berdasarkan materi
                        $header_class = "header-kecerdasan";
                        $icon_class = "fa-lightbulb-o";
                        if ($materi_id == 20 || stripos($materi_nm, 'kepribadian') !== false) {
                            $header_class = "header-kepribadian";
                            $icon_class = "fa-user-circle-o";
                        } else if ($materi_id == 21 || stripos($materi_nm, 'sikap') !== false) {
                            $header_class = "header-sikapkerja";
                            $icon_class = "fa-briefcase";
                        }
                    ?>

                    <div class="petunjuk-wrapper">
                        <div class="petunjuk-card">
                            <!-- Compact Header (Exact 70px) -->
                            <div class="petunjuk-header <?= $header_class ?>">
                                <div class="header-content-inline">
                                    <div class="header-left">
                                        <div class="petunjuk-icon-circle">
                                            <i class="fa <?= $icon_class ?>"></i>
                                        </div>
                                        <div class="header-text-group">
                                            <h2>Petunjuk Pengerjaan Soal</h2>
                                            <p>Harap membaca instruksi dengan seksama</p>
                                        </div>
                                    </div>
                                    <div class="materi-badge">
                                        <?= esc($materi_nm) ?>
                                    </div>
                                </div>
                            </div>

                            <!-- Body (Exact 360px) -->
                            <div class="petunjuk-body">
                                <!-- Instructions Area -->
                                <?php if ($materi_id == 19 || stripos($materi_nm, 'kecerdasan') !== false) { ?>
                                    <div class="instructions-box" style="border-left-color: #2563eb;">
                                        <p style="margin: 0; font-weight: 500;">
                                            Jawablah pertanyaan di bawah ini dengan memilih salah satu pilihan jawaban yang paling tepat. Gunakan logika dan ketelitian analisis terbaik Anda dalam menyelesaikan seluruh soal.
                                        </p>
                                    </div>

                                    <div class="info-pill-container">
                                        <div class="info-pill">
                                            <i class="fa fa-clock-o" style="color: #2563eb;"></i> Durasi: <b>90 Menit</b>
                                        </div>
                                        <div class="info-pill">
                                            <i class="fa fa-check-square-o" style="color: #2563eb;"></i> Format: <b>Pilihan Ganda</b>
                                        </div>
                                        <div class="info-pill">
                                            <i class="fa fa-pencil" style="color: #2563eb;"></i> Sistem: <b>Navigasi Soal</b>
                                        </div>
                                    </div>

                                <?php } else if ($materi_id == 20 || stripos($materi_nm, 'kepribadian') !== false) { ?>
                                    <div class="instructions-box" style="border-left-color: #0f766e;">
                                        <p style="margin: 0; font-weight: 500;">
                                            Perhatikan setiap butir soal/gambar di bawah ini dengan seksama. Pilihlah respon jawaban yang paling mencerminkan diri Anda secara spontan, objektif, dan jujur.
                                        </p>
                                    </div>

                                    <div class="info-pill-container">
                                        <div class="info-pill">
                                            <i class="fa fa-clock-o" style="color: #0f766e;"></i> Durasi: <b>45 Menit</b>
                                        </div>
                                        <div class="info-pill">
                                            <i class="fa fa-check-square-o" style="color: #0f766e;"></i> Format: <b>Respon Pilihan</b>
                                        </div>
                                        <div class="info-pill">
                                            <i class="fa fa-heart-o" style="color: #0f766e;"></i> Petunjuk: <b>Jujur & Spontan</b>
                                        </div>
                                    </div>

                                <?php } else if ($materi_id == 21 || stripos($materi_nm, 'sikap') !== false) { ?>
                                    <div class="instructions-box" style="border-left-color: #b45309; min-height: 100px;">
                                        <p style="margin: 0 0 6px 0; font-weight: 500; text-align: center;">
                                            Soal terdiri dari <b>10 kolom</b>, di mana setiap kolom berdurasi <b>1 menit</b>. Pilihlah karakter (angka, huruf, simbol) yang hilang dari rangkaian deret.
                                        </p>
                                        <div class="sk-example-wrap">
                                            <span class="sk-example-label">Pola Pilihan Jawaban:</span>
                                            <table class="example-table-inline">
                                                <tr>
                                                    <td class="char-cell">∑</td>
                                                    <td class="char-cell">4</td>
                                                    <td class="char-cell">7</td>
                                                    <td class="char-cell">V</td>
                                                    <td class="char-cell">X</td>
                                                </tr>
                                                <tr>
                                                    <td class="opsi-cell">A</td>
                                                    <td class="opsi-cell">B</td>
                                                    <td class="opsi-cell">C</td>
                                                    <td class="opsi-cell">D</td>
                                                    <td class="opsi-cell">E</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="info-pill-container">
                                        <div class="info-pill">
                                            <i class="fa fa-columns" style="color: #b45309;"></i> Jumlah: <b>10 Kolom</b>
                                        </div>
                                        <div class="info-pill">
                                            <i class="fa fa-hourglass-half" style="color: #b45309;"></i> Waktu/Kolom: <b>1 Menit</b>
                                        </div>
                                        <div class="info-pill">
                                            <i class="fa fa-bolt" style="color: #b45309;"></i> <b>Kecepatan & Ketelitian</b>
                                        </div>
                                    </div>
                                <?php } ?>

                                <!-- Alert Notice -->
                                <div class="alert-start-notice">
                                    <i class="fa fa-info-circle"></i>
                                    <div>
                                        Saat Anda menekan tombol <b>Mulai Ujian</b>, sistem akan langsung membuka soal dan pengatur waktu akan berjalan otomatis.
                                    </div>
                                </div>

                                <!-- Start Button -->
                                <div class="btn-container">
                                    <?php
                                        if ($materi_id == 21 || stripos($materi_nm, 'sikap') !== false) {
                                            $start_url = base_url("materiN/sikapkerja/" . $group_id . "/" . $materi_id);
                                        } else {
                                            $start_url = base_url("materiN/ujian/" . $group_id . "/" . $materi_id);
                                        }
                                    ?>
                                    <a href="<?= $start_url ?>" class="btn btn-start-ujian">
                                        <i class="fa fa-play-circle" style="margin-right: 6px;"></i> Mulai Ujian
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <?= $this->include('front/footer') ?>
    </div>

    <script src="<?= base_url() ?>/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?= base_url() ?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="<?= base_url() ?>/bower_components/fastclick/lib/fastclick.js"></script>
    <script src="<?= base_url() ?>/dist/js/adminlte.min.js"></script>
</body>
</html>