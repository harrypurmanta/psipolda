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
    <link rel="stylesheet" href="<?= base_url() ?>/plugins/sweetalert2/sweetalert2.css">
    <link rel="stylesheet" href="<?= base_url() ?>/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/plugins/toastr/toastr.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/bower_components/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <style>
   video, canvas {
      display: block;
      margin-bottom: 10px;
      max-width: 100%;
    }
    .tab-container {
      width: 100%;
      background: white;
      border-radius: 6px;
      box-shadow: 0 2px 8px rgb(0 0 0 / 0.1);
      overflow: hidden;
    }
    .tabs {
      display: flex;
      background-color: #8f959c;
      border-bottom: 1px solid #ddd;
      user-select: none;
    }
    .tab {
      color: white;
      padding: 12px 20px;
      cursor: pointer;
      font-weight: 600;
      transition: background-color 0.3s ease;
      border-bottom: 3px solid transparent;
    }
    .tab:not(.active):hover {
      background-color: #0069d9;
    }
    .tab.active {
      background-color: #ffffff;
      color: #007bff;
      border-bottom: 3px solid #007bff;
    }
    .tab-content {
      padding: 20px 5px;
      color: #333;
      line-height: 1.6;
    }

    
  </style>
</head>
<body class="hold-transition skin-blue layout-top-nav">
    <div class="wrapper">
        <header class="main-header">
            <?= $this->include('front/navbar') ?>
        </header>
        <div class="content-wrapper">
            <section class="content">
                <div class="container-fluid" style="padding-left: 0px; padding-right: 0px;">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-md-12">
                                                <div class="col-md-8 text-center">
                                                    KEPOLISIAN DAERAH SUMATERA SELATAN <br>
                                                        BIRO SUMBER DAYA MANUSIA<br>
                                                        BAGIAN PSIKOLOGI 
                                                        <hr>
                                                </div>
                                                <div class="col-md-4">
                                                    <table border="0" style="margin: auto; border: 1px solid black; text-align: center;">
                                                        <tbody>
                                                            <tr><td style="padding: 10px;">NOMOR TES : <br><b><label style="font-size: 30px;" id="no_test_header"><?= isset($NoTest[0]->NoTest) ? $NoTest[0]->NoTest : '' ?></label></b></td></tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-md-12 text-center">
                                                <label style="font-size: 30px;">RIWAYAT HIDUP</label>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="hidden" id="riwayat_hidup_id" name="riwayat_hidup_id">
                                                    <label for="jenis_pengajuan_id" style="font-size: 16px;" class="col-sm-2 col-form-label">Jenis Pengajuan :</label>
                                                    <div class="col-sm-3">
                                                        <select name="jenis_pengajuan_id" id="jenis_pengajuan_id" class="form-control">
                                                            <option value="" disabled selected>Pilih Jenis Pengajuan</option>
                                                            <?php
                                                                foreach ($pengajuan as $key) {
                                                            ?>
                                                            <option value="<?= $key->jenis_pengajuan_id ?>">
                                                                <?= $key->jenis_pengajuan_nm ?>
                                                            </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr style="border-top: 2px solid #007bff;">
                                    <input type="hidden" id="person_id" name="person_id">
                                    <div class="tab-container" style="margin-top: 10px;">
                                        <div style="overflow: auto;" class="tabs" role="tablist" aria-label="Sample Tabs">
                                            <div class="tab active text-center" role="tab" tabindex="0" aria-selected="true" aria-controls="panel-identitas" id="tab-identitas">Identitas Diri</div>
                                            <div class="tab text-center" role="tab" tabindex="-1" aria-selected="false" aria-controls="panel-keluarga" id="tab-keluarga">Keluarga</div>
                                            <div class="tab text-center" role="tab" tabindex="-1" aria-selected="false" aria-controls="panel-riwayat-pendidikan" id="tab-riwayat-pendidikan">Riwayat Pendidikan</div>
                                            <div class="tab text-center" role="tab" tabindex="-1" aria-selected="false" aria-controls="panel-riwayat-pekerjaan" id="tab-riwayat-pekerjaan">Riwayat Pekerjaan</div>
                                            <div class="tab text-center" role="tab" tabindex="-1" aria-selected="false" aria-controls="panel-tanda-tangan" id="tab-ttd">Tanda Tangan</div>
                                            <div class="tab text-center" role="tab" tabindex="-1" aria-selected="false" aria-controls="panel-inventori-tes-psikologi" id="tab-inventori">Inventori Tes Psikologi</div>
                                        </div>
                                        
                                        <div id="panel-identitas" class="tab-content" role="tabpanel" aria-labelledby="tab-home">
                                            <form class="form-horizontal">
                                                <div class="box-body">
                                                    <div class="form-group">
                                                        <label for="person_nm" class="col-sm-2 control-label">Nama Lengkap</label>
                                                        <div class="col-sm-4">
                                                            <input type="text" class="form-control form-identitas" id="person_nm" placeholder="Nama Lengkap" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="birth" class="col-sm-2 control-label">Tempat</label>
                                                        <div class="col-sm-3">
                                                            <input type="text" class="form-control form-identitas" id="birth_place" name="birth_place" placeholder="Tempat Lahir" autocomplete="off">
                                                        </div>
                                                        <!-- <div class="col-sm-3">
                                                            <input type="date" class="form-control form-identitas" id="birth_dttm" name="birth_dttm" placeholder="Tanggal Lahir" autocomplete="off">
                                                        </div> -->
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="birth" class="col-sm-2 control-label">Tanggal lahir</label>
                                                        <div class="col-sm-3">
                                                            <select class="form-control select2bs4" name="hari_lahir" id="hari_lahir" required>
                                                                <?php
                                                                    for ($i=1; $i <= 31 ; $i++) { 
                                                                        $value = str_pad($i, 2, '0', STR_PAD_LEFT);
                                                                ?>
                                                                <option value="<?= $value ?>"><?= $value ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="birth" class="col-sm-2 control-label">Bulan lahir</label>
                                                        <div class="col-sm-3">
                                                            <select class="form-control select2bs4" name="bulan_lahir" id="bulan_lahir" required>
                                                                <option value="01">Januari</option>
                                                                <option value="02">Februari</option>
                                                                <option value="03">Maret</option>
                                                                <option value="04">April</option>
                                                                <option value="05">Mei</option>
                                                                <option value="06">Juni</option>
                                                                <option value="07">Juli</option>
                                                                <option value="08">Agustus</option>
                                                                <option value="09">September</option>
                                                                <option value="10">Oktober</option>
                                                                <option value="11">November</option>
                                                                <option value="12">Desember</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="birth" class="col-sm-2 control-label">Bulan lahir</label>
                                                        <div class="col-sm-3">
                                                            <select class="form-control select2bs4" name="tahun_lahir" id="tahun_lahir" required>
                                                                <?php
                                                                $thn = date("Y");
                                                                    for ($t=$thn; $t >= 1950; $t--) { 
                                                                ?>
                                                                <option <?= ($t==$thn?'selected':'') ?> value="<?= $t ?>"><?= $t ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="gender_cd" class="col-sm-2 control-label">Jenis kelamin</label>
                                                        <div class="col-sm-4">
                                                            <select name="gender_cd" id="gender_cd" class="form-control form-identitas">
                                                                <option value="" disabled selected> Pilih Jenis Kelamin</option>
                                                                <option value="m">Laki-laki</option>
                                                                <option value="f">Perempuan</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="addr_txt" class="col-sm-2 control-label">Alamat</label>
                                                        <div class="col-sm-4">
                                                            <textarea name="addr_txt" id="addr_txt" class="form-control form-identitas"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="religion" class="col-sm-2 control-label">Agama</label>
                                                        <div class="col-sm-4">
                                                            <select name="religion" id="religion" class="form-control form-identitas">
                                                                <option value="" disabled selected> Pilih Agama</option>
                                                                <?php
                                                                    foreach ($agama as $agamakey) {
                                                                ?>
                                                                <option value="<?= $agamakey->agama_id ?>"><?= $agamakey->agama_nm ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="status_pernikahan" class="col-sm-2 control-label">Status Pernikahan</label>
                                                        <div class="col-sm-4">
                                                            <select name="status_pernikahan" id="status_pernikahan" class="form-control form-identitas">
                                                                <option value="" disabled selected> Pilih Status Pernikahan</option>
                                                                <?php
                                                                    foreach ($merried as $merriedkey) {
                                                                ?>
                                                                <option value="<?= $merriedkey->status_pernikahan_id ?>"><?= $merriedkey->status_pernikahan_nm ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="jabatan_id" class="col-sm-2 control-label">Jabatan Saat ini</label>
                                                        <div class="col-sm-4">
                                                            <input type="text" class="form-control form-identitas" id="jabatan_id" name="jabatan_id" placeholder="Jabatan Saat ini" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="pangkat" class="col-sm-2 control-label">Pangkat</label>
                                                        <div class="col-sm-4">
                                                            <input type="text" class="form-control form-identitas" id="pangkat" name="pangkat" placeholder="Masukkan Pangkat Anda" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nrp" class="col-sm-2 control-label">NRP</label>
                                                        <div class="col-sm-4">
                                                            <input type="text" class="form-control form-identitas" id="nrp" name="nrp" placeholder="Masukkan NRP Anda" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="addr_txt_office" class="col-sm-2 control-label">Alamat Kantor</label>
                                                        <div class="col-sm-4">
                                                            <textarea name="addr_txt_office" id="addr_txt_office" class="form-control form-identitas"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nama_atasan" class="col-sm-2 control-label">Nama atasan langsung</label>
                                                        <div class="col-sm-4">
                                                            <input type="text" class="form-control form-identitas" id="nama_atasan" name="nama_atasan" placeholder="Masukkan Nama Atasan Anda" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="jabatan_atasan" class="col-sm-2 control-label">Jabatan atasan langsung</label>
                                                        <div class="col-sm-4">
                                                            <input type="text" class="form-control form-identitas" id="jabatan_atasan" name="jabatan_atasan" placeholder="Masukkan Jabatan Atasan Anda" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="cellphone" class="col-sm-2 control-label">No HP</label>
                                                        <div class="col-sm-4">
                                                            <input type="text" class="form-control form-identitas" id="cellphone" name="cellphone" placeholder="Masukkan No HP Anda" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email" class="col-sm-2 control-label">Email</label>
                                                        <div class="col-sm-4">
                                                            <input type="text" class="form-control form-identitas" id="email" name="email" placeholder="Masukkan Email Anda" autocomplete="off">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="box-footer col-md-8">
                                                    <button style="margin-left: 10px;" id="btn_nextIdentitas" onclick="nextIdentitas()" type="button" class="btn btn-primary pull-right">Selanjutnya <i class="fa fa-arrow-right"></i></button> 
                                                    <button id="btn_simpanidentitas" onclick="simpanidentitas()" type="button" class="btn btn-success pull-right">Simpan</button>
                                                    
                                                    <!-- <button id="btn_editidentitas" onclick="editidentitas()" type="button" class="btn btn-warning pull-right" style="display: none;">Edit</button> -->
                                                </div>
                                            </form>
                                        </div>

                                        <div id="panel-keluarga" class="tab-content" role="tabpanel" aria-labelledby="tab-profile" hidden>
                                            <div class="box">
                                                <div class="box-header with-border text-left">
                                                    <h3 class="box-title">Susunan Keluarga (Istri/Suami dan Anak-anak)</h3>

                                                    <button onclick="tambahKeluarga('Anak')" type="button" class="btn btn-sm btn-primary pull-right" data-toggle="modal" data-target="#modal-tambah-keluarga"  style="margin: 5px;"><i class="fa fa-user-plus"></i> Anak</button>
                                                    <button id="btnIstri" onclick="tambahKeluarga('Istri')" type="button" class="btn btn-sm btn-primary pull-right" data-toggle="modal" data-target="#modal-tambah-keluarga"  style="margin: 5px;"><i class="fa fa-user-plus"></i> Istri</button>
                                                    <button id="btnSuami" onclick="tambahKeluarga('Suami')" type="button" class="btn btn-sm btn-primary pull-right" data-toggle="modal" data-target="#modal-tambah-keluarga"  style="margin: 5px;"><i class="fa fa-user-plus"></i> Suami</button>
                                                    
                                                </div>
                                                <div class="box-body" style="overflow: auto;">
                                                    <table width="100%" id="table_keluarga" class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">Hubungan</th>
                                                                <th class="text-center">Nama</th>
                                                                <th class="text-center">L/P</th>
                                                                <th class="text-center">Tempat/Tgl Lahir</th>
                                                                <th class="text-center">Pendidikan</th>
                                                                <th class="text-center">Pekerjaan</th>
                                                                <th class="text-center">Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                           
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="box-footer col-md-12">
                                                    <button id="btn_prevKeluarga" onclick="prevKeluarga()" type="button" class="btn btn-primary pull-left"><i class="fa fa-arrow-left"></i> Sebelumnya</button>
                                                    <button id="btn_nextKeluarga" onclick="nextKeluarga()" type="button" class="btn btn-primary pull-right">Selanjutnya <i class="fa fa-arrow-right"></i></button>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="panel-riwayat-pendidikan" class="tab-content" role="tabpanel" aria-labelledby="tab-messages" hidden>
                                            <div class="box">
                                                <div class="box-header with-border text-left">
                                                    <h4 class="box-title">1. Pendidikan Formal</h4>
                                                    <button onclick="emptyFormPendidikanFormal()" type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#modal-pendidikan-formal"><i class="fa fa-plus"></i> Pendidikan Formal</button>
                                                </div>
                                                <div class="box-body" style="overflow: auto;">
                                                    <table id="table_pendidikan_formal" class="table table-bordered" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center"></th>
                                                                <th class="text-center">Nama Sekolah</th>
                                                                <th class="text-center">Jurusan</th>
                                                                <th class="text-center">Tempat</th>
                                                                <th class="text-center">Thn s/d Thn</th>
                                                                <th class="text-center">Keterangan</th>
                                                                <th class="text-center">Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                           
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="box" style="margin-top: 50px;">
                                                <div class="box-header with-border text-left">
                                                    <h4 class="box-title">2. Pendidikan Polri (Diklat dan Dikbang)</h4>
                                                    <button onclick="emptyFormPendidikanPolri()" type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#modal-pendidikan-polri"><i class="fa fa-plus"></i> Pendidikan Polri</button>
                                                </div>
                                                <div class="box-body" style="overflow: auto;">
                                                    <table id="table_pendidikan_polri" class="table table-bordered" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">No</th>
                                                                <th class="text-center">Jenis</th>
                                                                <th class="text-center">Tempat</th>
                                                                <th class="text-center">Tahun</th>
                                                                <th class="text-center">Keterangan</th>
                                                                <th class="text-center">Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                           
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="box" style="margin-top: 50px;">
                                                <div class="box-header with-border text-left">
                                                    <h4 class="box-title">3. Pendidikan Pengembangan Spesialis yang diikuti/Termasuk Pelatihan Yang diadakan Polri</h4>
                                                    <button onclick="emptyFormPendidikanSpesialis()" type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#modal-pendidikan-spesialis"><i class="fa fa-plus"></i> Pendidikan Spesialis</button>
                                                </div>
                                                <div class="box-body" style="overflow: auto;">
                                                    <table id="table_pendidikan_spesialis" class="table table-bordered" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">No</th>
                                                                <th class="text-center">Jenis Dikbangspes</th>
                                                                <th class="text-center">Tempat</th>
                                                                <th class="text-center">Tahun</th>
                                                                <th class="text-center">Keterangan</th>
                                                                <th class="text-center">Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                           
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="box-footer col-md-12">
                                                <button id="btn_prevPendidikan" onclick="prevPendidikan()" type="button" class="btn btn-primary pull-left"><i class="fa fa-arrow-left"></i> Sebelumnya</button>
                                                <button id="btn_nextPendidikan" onclick="nextPendidikan()" type="button" class="btn btn-primary pull-right">Selanjutnya <i class="fa fa-arrow-right"></i></button>
                                            </div>
                                        </div>

                                        <div id="panel-riwayat-pekerjaan" class="tab-content" role="tabpanel" aria-labelledby="tab-settings" hidden>
                                            <div class="box">
                                                <div class="box-header with-border text-left">
                                                    <h4 class="box-title">1. Uraikan dengan singkat pekerjaan Anda selama ini (dimulai dari posisi terakhir)</h4>
                                                    <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#modal-riwayat-pekerjaan" onclick="emptyFormRiwayatPekerjaan()"><i class="fa fa-plus"></i> Riwayat Pekerjaan</button>
                                                </div>
                                                <div class="box-body" style="overflow: auto;">
                                                    <table id="table_riwayat_pekerjaan" class="table table-bordered" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">No</th>
                                                                <th class="text-center">Jabatan</th>
                                                                <th class="text-center">Bln/Thn s/d Bln/Thn</th>
                                                                <th class="text-center">Bagian/Dept.</th>
                                                                <th class="text-center">Satker</th>
                                                                <th class="text-center">Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                           
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="box-footer col-md-12">
                                                    <button id="btn_prevPekerjaan" onclick="prevPekerjaan()" type="button" class="btn btn-primary pull-left"><i class="fa fa-arrow-left"></i> Sebelumnya</button>
                                                    <button id="btn_nextPekerjaan" onclick="nextPekerjaan()" type="button" class="btn btn-primary pull-right">Selanjutnya <i class="fa fa-arrow-right"></i></button>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="panel-tanda-tangan" class="tab-content" role="tabpanel" aria-labelledby="tab-ttd" hidden>
                                            <div class="box">
                                                <div class="box-header with-border text-center">
                                                    <h4 class="box-title">Tanda Tangan</h4>
                                                </div>
                                                <div class="box-body">
                                                    <form class="form-horizontal">
                                                            <div class="form-group">
                                                                <label for="tempat_ttd" class="col-sm-2 control-label">Tempat tanda tangan :</label>
                                                                <div class="col-sm-3">
                                                                    <input class="form-control" type="text" id="tempat_ttd" name="tempat_ttd" placeholder="Tempat tanda tangan" autocomplete="off">
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="hari_tanda_tangan" class="col-sm-2 control-label">Tanggal TTD</label>
                                                                <div class="col-sm-2">
                                                                    <select class="form-control select2bs4" name="hari_tanda_tangan" id="hari_tanda_tangan" required>
                                                                        <?php
                                                                            for ($i=1; $i <= 31 ; $i++) { 
                                                                                $value = str_pad($i, 2, '0', STR_PAD_LEFT);
                                                                        ?>
                                                                        <option value="<?= $value ?>"><?= $value ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="bulan_tanda_tangan" class="col-sm-2 control-label">Bulan TTD</label>
                                                                <div class="col-sm-2">
                                                                    <select class="form-control select2bs4" name="bulan_tanda_tangan" id="bulan_tanda_tangan" required>
                                                                        <option value="01">Januari</option>
                                                                        <option value="02">Februari</option>
                                                                        <option value="03">Maret</option>
                                                                        <option value="04">April</option>
                                                                        <option value="05">Mei</option>
                                                                        <option value="06">Juni</option>
                                                                        <option value="07">Juli</option>
                                                                        <option value="08">Agustus</option>
                                                                        <option value="09">September</option>
                                                                        <option value="10">Oktober</option>
                                                                        <option value="11">November</option>
                                                                        <option value="12">Desember</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="tahun_tanda_tangan" class="col-sm-2 control-label">Tahun TTD</label>
                                                                <div class="col-sm-2">
                                                                    <select class="form-control select2bs4" name="tahun_tanda_tangan" id="tahun_tanda_tangan" required>
                                                                        <?php
                                                                        $thn = date("Y");
                                                                            for ($t=$thn; $t >= 1950; $t--) { 
                                                                            // for ($year = $yearNow; $year >= 1950; $year--) {
                                                                            //         echo $year . "<br>";
                                                                        ?>
                                                                        <option <?= ($t==$thn?'selected':'') ?> value="<?= $t ?>"><?= $t ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                    </form>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-6 text-center">
                                                            <h2>Ambil Foto dari Kamera</h2>
                                                            <video id="video" width="400" height="300" autoplay style="display:block; margin:0 auto;"></video>
                                                            <button style="margin-top: 10px;" id="snap" class="btn btn-sm btn-primary"><i class="fa fa-camera"></i> Ambil Foto</button>
                                                        </div>
                                                        <div class="col-md-6 text-center">
                                                            <h2>Hasil Foto</h2>
                                                            <canvas id="canvas" width="400" height="300" style="display:none;"></canvas>
                                                            <img id="photo" src="" alt="Hasil Foto" style="display:none; border:1px solid #ccc;"><br><br>
                                                            <button type="button" id="simpantandatangan" class="btn btn-sm btn-success" style="display: none;">Simpan</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button id="btn_prevTandaTangan" onclick="prevTandaTangan()" type="button" class="btn btn-primary pull-left"><i class="fa fa-arrow-left"></i> Sebelumnya</button>
                                            </div>
                                        </div>

                                        <div id="panel-inventori-tes-psikologi" class="tab-content" role="tabpanel" aria-labelledby="tab-inventori" hidden>
                                            <div class="col-md-12">
                                                <div class="table-responsive" style="overflow: auto;">
                                                    <table style="width: 100%; font-size: 12px;">
                                                        <tbody>
                                                        <tr>
                                                            <td width="100px"><strong>NOMOR UJIAN</strong></td>
                                                            <td width="20px" class="text-center">:</td>
                                                            <td width="150px"><?= isset($NoTest[0]->NoTest) ? $NoTest[0]->NoTest : '' ?></td>
                                                            <td width="100px"><strong>JABATAN</strong></td>
                                                            <td width="20px" class="text-center">:</td>
                                                            <td><?= isset($riwayathidup[0]->jabatan) ? $riwayathidup[0]->jabatan : '' ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>NAMA</strong></td>
                                                            <td class="text-center">:</td>
                                                            <td><?= isset($riwayathidup[0]->person_nm) ? $riwayathidup[0]->person_nm : '' ?></td>
                                                            <td><strong>KESATUAN</strong></td>
                                                            <td class="text-center">:</td>
                                                            <td><?= isset($riwayathidup[0]->satuan_nm) ? $riwayathidup[0]->satuan_nm : '' ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>PANGKAT/NRP</strong></td>
                                                            <td class="text-center">:</td>
                                                            <td><?= isset($riwayathidup[0]->pangkat) ? $riwayathidup[0]->pangkat : '' ?>/<?= isset($riwayathidup[0]->nrp) ? $riwayathidup[0]->nrp : '' ?></td>
                                                            <td><strong>TANGGAL UJIAN</strong></td>
                                                            <td class="text-center">:</td>
                                                            <td><?= isset($riwayathidup[0]->tanggal_ujian) ? $riwayathidup[0]->tanggal_ujian : '' ?></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                    </div>
                                            </div>

                                            <div class="box" style="margin-top: 10px;">
                                                <div class="box-body">
                                                    <label for="">Instruksi:</label>
                                                    <p style="text-align: justify;">
                                                        Anda dihadapkan pada beberapa pertanyaan. Bacalah setiap nomor dan sub pertanyaan dengan saksama karena tiap-tiap pertanyaan saling berhubungan. Jawablah pertanyaan-pertanyaan di tempat yang telah disediakan. Selamat mengerjakan.
                                                    </p>
                                                </div>
                                            </div>
                                            <form id="form-jawaban">
                                            <div class="box" style="margin-top: 10px;">
                                                <div class="box-body">
                                                    
                                                    <ol type="1">
                                                        <?php
                                                            $db = db_connect();
                                                            $this->session = \Config\Services::session();
                                                            $person_id = $this->session->person_id;
                                                            foreach ($no_soal as $nosoal_key) {
                                                        ?>
                                                        <li>
                                                            <ol type="a">
                                                                <?php
                                                                    $soal = $db->query("SELECT * FROM inventori_pertanyaan a LEFT JOIN inventori_psikologi b ON b.inventori_pertanyaan_id = a.inventori_pertanyaan_id AND b.person_id = $person_id WHERE a.status_cd = 'normal' AND a.no_soal = $nosoal_key->no_soal")->getResult();
                                                                    foreach ($soal as $soal_key) {
                                                                ?>
                                                                <li style="margin-top: 10px;">
                                                                    <?= $soal_key->inventori_pertanyaan_nm ?>
                                                                    <textarea name="jawaban[<?= $soal_key->inventori_pertanyaan_id ?>]" id="jawaban_<?= $soal_key->inventori_pertanyaan_id ?>" class="form-control text-pertanyaan" required><?= $soal_key->jawaban ?></textarea>
                                                                </li>
                                                                <?php } ?>
                                                            </ol>
                                                        </li>
                                                        <?php } ?>
                                                    </ol>
                                                    <div class="col-md-12 text-center">
                                                        <button type="button" class="btn btn-primary" onclick="simpanjawaban()">Simpan</button>
                                                    </div>
                                                </div>
                                            </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="modal-tambah-keluarga">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Masukkan data anggota keluarga anda disini</h4>
                        </div>
                        <div class="modal-body">
                            <div class="box">
                                <div class="box-body">
                                    <form class="form-horizontal">
                                        <input type="hidden" id="keluarga_id" name="keluarga_id">
                                        <div class="form-group">
                                            <label for="hubungan" class="col-sm-4 control-label">Hubungan Keluarga</label>
                                            <div class="col-sm-8">
                                                <select disabled name="hubungan" id="hubungan" class="form-control form-keluarga">
                                                    <option value="" selected disabled>Pilih hubungan keluarga</option>
                                                    <option value="Suami">Suami</option>
                                                    <option value="Istri">Istri</option>
                                                    <option value="Anak">Anak</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="person_nm_keluarga" class="col-sm-4 control-label">Nama Lengkap</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control form-keluarga" id="person_nm_keluarga" placeholder="Nama Lengkap" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="jenis_kelamin" class="col-sm-4 control-label">Jenis Kelamin</label>
                                            <div class="col-sm-8">
                                                <select name="jenis_kelamin" id="jenis_kelamin" class="form-control form-keluarga">
                                                    <option value="" selected disabled>Pilih Jenis Kelamin</option>
                                                    <option value="L">Laki-laki</option>
                                                    <option value="P">Perempuan</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="tempat_lahir" class="col-sm-4 control-label">Tempat Lahir</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control form-keluarga" id="tempat_lahir" name="tempat_lahir" placeholder="Masukkan tempat lahir" autocomplete="off">
                                            </div>
                                        </div>
                                        <!-- <div class="form-group">
                                            <label for="tanggal_lahir" class="col-sm-4 control-label">Tanggal Lahir</label>
                                            <div class="col-sm-8">
                                                <input type="date" class="form-control form-keluarga" id="tanggal_lahir" name="tanggal_lahir" placeholder="Masukkan tanggal lahir">
                                            </div>
                                        </div> -->
                                        <div class="form-group">
                                            <label for="hari_lahir_keluarga" class="col-sm-4 control-label">Tanggal lahir</label>
                                            <div class="col-sm-8">
                                                <select class="form-control select2bs4" name="hari_lahir_keluarga" id="hari_lahir_keluarga" required>
                                                    <?php
                                                        for ($i=1; $i <= 31 ; $i++) { 
                                                            $value = str_pad($i, 2, '0', STR_PAD_LEFT);
                                                    ?>
                                                    <option value="<?= $value ?>"><?= $value ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="bulan_lahir_keluarga" class="col-sm-4 control-label">Bulan lahir</label>
                                            <div class="col-sm-8">
                                                <select class="form-control select2bs4" name="bulan_lahir_keluarga" id="bulan_lahir_keluarga" required>
                                                    <option value="01">Januari</option>
                                                    <option value="02">Februari</option>
                                                    <option value="03">Maret</option>
                                                    <option value="04">April</option>
                                                    <option value="05">Mei</option>
                                                    <option value="06">Juni</option>
                                                    <option value="07">Juli</option>
                                                    <option value="08">Agustus</option>
                                                    <option value="09">September</option>
                                                    <option value="10">Oktober</option>
                                                    <option value="11">November</option>
                                                    <option value="12">Desember</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="tahun_lahir_keluarga" class="col-sm-4 control-label">Tahun lahir</label>
                                            <div class="col-sm-8">
                                                <select class="form-control select2bs4" name="tahun_lahir_keluarga" id="tahun_lahir_keluarga" required>
                                                    <?php
                                                    $thn = date("Y");
                                                        for ($t=$thn; $t >= 1950; $t--) { 
                                                    ?>
                                                    <option <?= ($t==$thn?'selected':'') ?> value="<?= $t ?>"><?= $t ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="pendidikan_keluarga" class="col-sm-4 control-label">Pendidikan</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control form-keluarga" id="pendidikan_keluarga" name="pendidikan_keluarga" placeholder="Masukkan pendidikan" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="pekerjaan" class="col-sm-4 control-label">Pekerjaan</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control form-keluarga" id="pekerjaan" name="pekerjaan" placeholder="Masukkan Pekerjaan" autocomplete="off">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
                            <button onclick="simpankeluarga()" type="button" class="btn btn-success">Simpan</button>
                        </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                

                <div class="modal fade" id="modal-pendidikan-formal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Masukkan data pendidikan formal anda disini</h4>
                        </div>
                        <div class="modal-body">
                            <div class="box">
                                <div class="box-body">
                                    <form class="form-horizontal">
                                        <input type="hidden" id="riwayat_pendidikan_formal_id" name="riwayat_pendidikan_formal_id">
                                        <div class="form-group">
                                            <label for="jenjang_pendidikan_id" class="col-sm-4 control-label">Jenjang Pendidikan</label>
                                            <div class="col-sm-8">
                                                <select name="jenjang_pendidikan_id" id="jenjang_pendidikan_id" class="form-control form-pendidikan">
                                                    <option value="" selected disabled>Pilih jenjang pendidikan</option>
                                                    <?php
                                                        foreach ($jenjang as $jenjangkey) {
                                                    ?>
                                                    <option value="<?= $jenjangkey->jenjang_pendidikan_id  ?>"><?= $jenjangkey->jenjang_pendidikan_nm ?></option>
                                                    <?php
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama_sekolah" class="col-sm-4 control-label">Nama Sekolah</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control form-pendidikan" id="nama_sekolah" name="nama_sekolah" placeholder="Masukkan Nama Sekolah" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="jurusan" class="col-sm-4 control-label">Jurusan</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control form-pendidikan" id="jurusan" name="jurusan" placeholder="Masukkan Jurusan Anda" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="tempat" class="col-sm-4 control-label">Tempat</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control form-pendidikan" id="tempat" name="tempat" placeholder="Masukkan Alamat Sekolah" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="tahun_mulai" class="col-sm-4 control-label">Tahun Masuk</label>
                                            <div class="col-sm-8">
                                                <select name="tahun_mulai" id="tahun_mulai" class="form-control select2 form-pendidikan">
                                                    <option value="" selected disabled>Pilih tahun masuk</option>
                                                    <?php
                                                        $yearNow = date("Y");

                                                        for ($year = $yearNow; $year >= 1950; $year--) {
                                                            echo $year . "<br>";
                                                        
                                                    ?>
                                                    <option value="<?= $year ?>"><?= $year ?></option>
                                                    <?php
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="tahun_selesai" class="col-sm-4 control-label">Tahun Selesai</label>
                                            <div class="col-sm-8">
                                                <select name="tahun_selesai" id="tahun_selesai" class="form-control select2 form-pendidikan">
                                                    <option value="" selected disabled>Pilih tahun selesai</option>
                                                    <?php
                                                        $yearNow = date("Y");

                                                        for ($year = $yearNow; $year >= 1950; $year--) {
                                                            echo $year . "<br>";
                                                        
                                                    ?>
                                                    <option value="<?= $year ?>"><?= $year ?></option>
                                                    <?php
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="keterangan" class="col-sm-4 control-label">Keterangan</label>
                                            <div class="col-sm-8">
                                                <textarea type="text" class="form-control form-pendidikan" id="keterangan" name="keterangan"></textarea>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
                            <button onclick="simpanpendidikanformal()" type="button" class="btn btn-success">Simpan</button>
                        </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>

                <div class="modal fade" id="modal-pendidikan-polri">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Masukkan data pendidikan polri anda disini</h4>
                        </div>
                        <div class="modal-body">
                            <div class="box">
                                <div class="box-body">
                                    <form class="form-horizontal">
                                        <input type="hidden" id="riwayat_pendidikan_polri_id" name="riwayat_pendidikan_polri_id">
                                        <div class="form-group">
                                            <label for="jenis_pendidikan_polri" class="col-sm-4 control-label">Jenis</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control form-polri" id="jenis_pendidikan_polri" name="jenis_pendidikan_polri" placeholder="Masukkan jenis pendidikan" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="tempat_pendidikan_polri" class="col-sm-4 control-label">Tempat</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control form-polri" id="tempat_pendidikan_polri" name="tempat_pendidikan_polri" placeholder="Masukkan tempat" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="tahun_pendidikan_polri" class="col-sm-4 control-label">Tahun</label>
                                            <div class="col-sm-8">
                                                <select name="tahun_pendidikan_polri" id="tahun_pendidikan_polri" class="form-control select2 form-polri">
                                                    <option value="" selected disabled>Pilih tahun</option>
                                                    <?php
                                                        $yearNow = date("Y");

                                                        for ($year = $yearNow; $year >= 1950; $year--) {
                                                            echo $year . "<br>";
                                                        
                                                    ?>
                                                    <option value="<?= $year ?>"><?= $year ?></option>
                                                    <?php
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="keterangan_pendidikan_polri" class="col-sm-4 control-label">Keterangan</label>
                                            <div class="col-sm-8">
                                                <textarea type="text" class="form-control form-polri" id="keterangan_pendidikan_polri" name="keterangan_pendidikan_polri"></textarea>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
                            <button onclick="simpanpendidikanpolri()" type="button" class="btn btn-success">Simpan</button>
                        </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>

                <div class="modal fade" id="modal-pendidikan-spesialis">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Masukkan data pendidikan spesialis anda disini</h4>
                        </div>
                        <div class="modal-body">
                            <div class="box">
                                <div class="box-body">
                                    <form class="form-horizontal">
                                        <input type="hidden" id="riwayat_pendidikan_spesialis_id" name="riwayat_pendidikan_spesialis_id">
                                        <div class="form-group">
                                            <label for="jenis_pendidikan_spesialis" class="col-sm-4 control-label">Jenis</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control form-spesialis" id="jenis_pendidikan_spesialis" name="jenis_pendidikan_spesialis" placeholder="Masukkan jenis pendidikan" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="tempat_pendidikan_spesialis" class="col-sm-4 control-label">Tempat</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control form-spesialis" id="tempat_pendidikan_spesialis" name="tempat_pendidikan_spesialis" placeholder="Masukkan tempat" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="tahun_pendidikan_spesialis" class="col-sm-4 control-label">Tahun</label>
                                            <div class="col-sm-8">
                                                <select name="tahun_pendidikan_spesialis" id="tahun_pendidikan_spesialis" class="form-control select2 form-spesialis">
                                                    <option value="" selected disabled>Pilih tahun</option>
                                                    <?php
                                                        $yearNow = date("Y");

                                                        for ($year = $yearNow; $year >= 1950; $year--) {
                                                            echo $year . "<br>";
                                                        
                                                    ?>
                                                    <option value="<?= $year ?>"><?= $year ?></option>
                                                    <?php
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="keterangan_pendidikan_spesialis" class="col-sm-4 control-label">Keterangan</label>
                                            <div class="col-sm-8">
                                                <textarea type="text" class="form-control form-spesialis" id="keterangan_pendidikan_spesialis" name="keterangan_pendidikan_spesialis"></textarea>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
                            <button onclick="simpanpendidikanspesialis()" type="button" class="btn btn-success">Simpan</button>
                        </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>

                <div class="modal fade" id="modal-riwayat-pekerjaan">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Masukkan data riwayat pekerjaan anda disini</h4>
                        </div>
                        <div class="modal-body">
                            <div class="box">
                                <div class="box-body">
                                    <form class="form-horizontal">
                                        <input type="hidden" id="riwayat_pekerjaan_id" name="riwayat_pekerjaan_id">
                                        <div class="form-group">
                                            <label for="riwayat_jabatan" class="col-sm-4 control-label">Jabatan</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control form-pekerjaan" id="riwayat_jabatan" name="riwayat_jabatan" placeholder="Masukkan riwayat jabatan" autocomplete="off">
                                            </div>
                                        </div>
                                        <!-- <div class="form-group">
                                            <label for="riwayat_mulai" class="col-sm-4 control-label">Bulan & Tahun Mulai <small>(abaikan tanggal)</small></label>
                                            <div class="col-sm-8">
                                                <input type="date" class="form-control form-pekerjaan" id="riwayat_mulai" name="riwayat_mulai" placeholder="Masukkan bulan dan tahun mulai" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="riwayat_selesai" class="col-sm-4 control-label">Bulan & Tahun Selesai <small>(abaikan tanggal)</small></label>
                                            <div class="col-sm-8">
                                                <input type="date" class="form-control form-pekerjaan" id="riwayat_selesai" name="riwayat_selesai" placeholder="Masukkan bulan dan tahun selesai" autocomplete="off">
                                            </div>
                                        </div> -->
                                        
                                        <div class="form-group">
                                            <label for="bulan_mulai_pekerjaan" class="col-sm-2 control-label">Bulan Mulai</label>
                                            <div class="col-sm-3">
                                                <select class="form-control select2bs4" name="bulan_mulai_pekerjaan" id="bulan_mulai_pekerjaan" required>
                                                    <option value="01">Januari</option>
                                                    <option value="02">Februari</option>
                                                    <option value="03">Maret</option>
                                                    <option value="04">April</option>
                                                    <option value="05">Mei</option>
                                                    <option value="06">Juni</option>
                                                    <option value="07">Juli</option>
                                                    <option value="08">Agustus</option>
                                                    <option value="09">September</option>
                                                    <option value="10">Oktober</option>
                                                    <option value="11">November</option>
                                                    <option value="12">Desember</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="tahun_mulai_pekerjaan" class="col-sm-2 control-label">Tahun Mulai</label>
                                            <div class="col-sm-3">
                                                <select class="form-control select2bs4" name="tahun_mulai_pekerjaan" id="tahun_mulai_pekerjaan" required>
                                                    <?php
                                                    $thn = date("Y");
                                                        for ($t=$thn; $t >= 1950; $t--) { 
                                                    ?>
                                                    <option <?= ($t==$thn?'selected':'') ?> value="<?= $t ?>"><?= $t ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="bulan_selesai_pekerjaan" class="col-sm-2 control-label">Bulan Selesai</label>
                                            <div class="col-sm-3">
                                                <select class="form-control select2bs4" name="bulan_selesai_pekerjaan" id="bulan_selesai_pekerjaan" required>
                                                    <option value="01">Januari</option>
                                                    <option value="02">Februari</option>
                                                    <option value="03">Maret</option>
                                                    <option value="04">April</option>
                                                    <option value="05">Mei</option>
                                                    <option value="06">Juni</option>
                                                    <option value="07">Juli</option>
                                                    <option value="08">Agustus</option>
                                                    <option value="09">September</option>
                                                    <option value="10">Oktober</option>
                                                    <option value="11">November</option>
                                                    <option value="12">Desember</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="tahun_selesai_pekerjaan" class="col-sm-2 control-label">Tahun Selesai</label>
                                            <div class="col-sm-3">
                                                <select class="form-control select2bs4" name="tahun_selesai_pekerjaan" id="tahun_selesai_pekerjaan" required>
                                                    <?php
                                                    $thn = date("Y");
                                                        for ($t=$thn; $t >= 1950; $t--) { 
                                                    ?>
                                                    <option <?= ($t==$thn?'selected':'') ?> value="<?= $t ?>"><?= $t ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="riwayat_bagian" class="col-sm-4 control-label">Bagian/Dept.</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control form-pekerjaan" id="riwayat_bagian" name="riwayat_bagian" placeholder="Masukkan bagian/dept." autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="riwayat_satker" class="col-sm-4 control-label">Satuan Kerja</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control form-pekerjaan" id="riwayat_satker" name="riwayat_satker" placeholder="Masukkan riwayat satuan kerja anda" autocomplete="off">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
                            <button onclick="simpanriwayatpekerjaan()" type="button" class="btn btn-success">Simpan</button>
                        </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>

                <!-- Modal -->
                <div class="modal fade" id="modal-token" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                    <div class="modal-header bg-blue">
                        <h5 class="modal-title">Masukkan Token</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                        <label for="token">Token</label>
                        <input class="form-control" type="text" name="token" id="token" placeholder="Masukkan Token" maxlength="6" minlength="6">
                        </div>
                        <button class="btn btn-primary" type="button" onclick="checktoken()">Next</button>
                    </div>
                    </div>
                </div>
                </div>


                <div class="modal fade" id="modal-noTest" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
                    <div class="modal-dialog modal-md" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-blue">
                            </div>
                            <div id="modal_body" class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="token">Nomor Test</label>
                                                <input class="form-control" type="text" name="notest" id="notest" placeholder="Masukkan No Test Anda" maxlength="6" minlength="6">
                                                <input class="form-control" type="hidden" name="group_id_notest" id="group_id_notest">
                                                <input class="form-control" type="hidden" name="materi_id_notest" id="materi_id_notest">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <button style="margin-top: 25px;" class="btn btn-primary" type="button" onclick="InsertNoTest()">Submit</button>
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
    <script src="<?= base_url() ?>/plugins/sweetalert2/sweetalert2.js"></script>
    <script src="<?= base_url() ?>/plugins/datatables/jquery.dataTables.min.js"></script>
    <!-- <script src="<?= base_url() ?>/bower_components/select2/dist/js/select2.full.min.js"></script> -->
    <script src="<?= base_url() ?>/plugins/select2/js/select2.full.min.js"></script>
    <script>

        function tambahKeluarga(hubungan) {
            emptyFormKeluarga();
            $("#hubungan").val(hubungan);
        }

        function simpanjawaban() {
            let isValid = true;
            let textareas = document.querySelectorAll(".text-pertanyaan");

            textareas.forEach(function(textarea) {
                if (textarea.value.trim() === "") {
                    isValid = false;
                    textarea.classList.add("is-invalid");
                } else {
                    textarea.classList.remove("is-invalid");
                }
            });

            if (!isValid) {
                Swal.fire("Semua jawaban harus diisi terlebih dahulu.", "", "info");
                return false;
            }

            $.ajax({
                url: "<?= base_url('rh/simpanjawaban') ?>",
                type: "POST",
                data: $('#form-jawaban').serialize(),
                dataType: "json",
                success: function(response) {
                    if (response == 'success') {
                        Swal.fire({
                            title: "Anda telah selesai menjawab pertanyaan, klik Ok untuk kembali ke halaman utama",
                            icon: "success",
                            showCancelButton: false,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "OK"
                            }).then((result) => {
                            if (result.isConfirmed) {
                                Swal.fire({
                                    title: "Terima Kasih",
                                    text: "Anda telah menyelesaikan inventori tes psikologi",
                                    icon: "success"
                                });
                                
                                window.location.href = "<?= base_url() ?>/home";
                            }
                        });
                    } else {
                        Swal.fire("Gagal menyimpan jawaban.", "", "warning");
                    }
                },
                error: function(xhr) {
                    alert('Terjadi kesalahan saat menyimpan.');
                }
            });
        }

        function showtoken() {
            $("#token").val("");
            $("#modal-token").modal("show");
        }

        function checktoken() {
            var token = $("#token").val();
            $.ajax({
                url: "<?= base_url('token/checktoken') ?>",
                type: "post",
                dataType: "json",
                data: {
                    "token": token,
                    "group_id": 99
                },
                beforeSend: function() {
                    $("#loader-wrapper").removeClass("d-none");
                },
                success: function(data) {
                    if (data == "sukses") {
                        $("#modal-token").modal("hide");
                        $("#modal-noTest").modal("show");
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

        function InsertNoTest() {
            var notest = $("#notest").val();
            $.ajax({
                url: "<?= base_url('rh/InsertNoTest') ?>",
                type: "post",
                dataType: "json",
                data: {
                    "notest": notest,
                    "group_id": 99
                },
                beforeSend: function() {
                    $("#loader-wrapper").removeClass("d-none");
                },
                success: function(data) {
                    if (data == "sukses") {
                        alert("No Test berhasil di simpan");
                        $("#modal-noTest").modal("hide");
                    } 
                    $("#loader-wrapper").addClass("d-none");
                    loadExistingIdentitas();
                },
                error: function() {
                    alert("Error");
                    $("#loader-wrapper").addClass("d-none");
                }
            });

            
        }

        function emptyFormKeluarga() {
            let hubungan = $("#hubungan").val('');
            let person_nm_keluarga = $("#person_nm_keluarga").val('');
            let jenis_kelamin = $("#jenis_kelamin").val('');
            let tempat_lahir = $("#tempat_lahir").val('');
            // let tanggal_lahir = $("#tanggal_lahir").val('');
            let pendidikan_keluarga = $("#pendidikan_keluarga").val('');
            let pekerjaan = $("#pekerjaan").val('');
            let keluarga_id = $("#pekerjaan").val('');
        }

        function emptyFormPendidikanFormal() {
            let riwayat_pendidikan_formal_id = $("#riwayat_pendidikan_formal_id").val('');
            let jenjang_pendidikan_id = $("#jenjang_pendidikan_id").val('');
            let nama_sekolah = $("#nama_sekolah").val('');
            let jurusan = $("#jurusan").val('');
            let tempat = $("#tempat").val('');
            let tahun_mulai = $("#tahun_mulai").val('');
            let tahun_selesai = $("#tahun_selesai").val('');
            let keterangan = $("#keterangan").val('');
        }

        function emptyFormPendidikanPolri() {
            let riwayat_pendidikan_polri_id = $("#riwayat_pendidikan_polri_id").val('');
            let jenis_pendidikan_polri = $("#jenis_pendidikan_polri").val('');
            let tempat_pendidikan_polri = $("#tempat_pendidikan_polri").val('');
            let tahun_pendidikan_polri = $("#tahun_pendidikan_polri").val('');
            let keterangan_pendidikan_polri = $("#keterangan_pendidikan_polri").val('');
        }

        function emptyFormPendidikanSpesialis() {
            let riwayat_pendidikan_spesialis_id = $("#riwayat_pendidikan_spesialis_id").val('');
            let jenis_pendidikan_spesialis = $("#jenis_pendidikan_spesialis").val('');
            let tempat_pendidikan_spesialis = $("#tempat_pendidikan_spesialis").val('');
            let tahun_pendidikan_spesialis = $("#tahun_pendidikan_spesialis").val('');
            let keterangan_pendidikan_spesialis = $("#keterangan_pendidikan_spesialis").val('');
        }

        function emptyFormRiwayatPekerjaan() {
            let riwayat_pekerjaan_id = $("#riwayat_pekerjaan_id").val('');
            let riwayat_jabatan = $("#riwayat_jabatan").val('');
            // let riwayat_mulai = $("#riwayat_mulai").val('');
            // let riwayat_selesai = $("#riwayat_selesai").val('');
            let riwayat_bagian = $("#riwayat_bagian").val('');
            let riwayat_satker = $("#riwayat_satker").val('');
        }

        loadDataKeluarga = () => {
            let person_id = $("#person_id").val();
            $("#table_keluarga").DataTable({
                ordering: false,
                paging: false,
                searching: false,
                destroy: true,
                ajax: {
                    url: "/rh/getDataKeluarga",
                    type: "POST",
                    data: function(d) {
                        d.person_id = person_id
                    },
                    dataSrc: function(json) {
                        let nomor = 1
                        json.forEach((row, idx) => {
                            if (idx > 0) {
                                nomor++
                            }
                            row.nomor = nomor
                        });

                        return json
                    }
                },
                bDestroy: true,
                pageLength: 100,
                columns: [
                    {
                        data: "hubungan",
                        className: "text-center"
                    },
                    {
                        data: "keluarga_nm",
                        className: "left"
                    },
                    {
                        data: "jenis_kelamin",
                        className: "text-center"
                    },
                    {
                        data: null,
                        className: "text-center",
                        render: function(data) {
                            var parts = data.tanggal_lahir.split('-');
                            var tanggal_lahir = parts[2] + '-' + parts[1] + '-' + parts[0];
                            return `${data.tempat_lahir}/${tanggal_lahir}`;
                        }
                    },
                    {
                        data: "pendidikan",
                        className: "text-center"
                    },
                    {
                        data: "pekerjaan",
                        className: "text-center"
                    },
                    {
                        data: null,
                        className: "text-center",
                        render: function(data) {
                        return `<button class="btn btn-warning btn-sm" type="button" onclick="editkeluarga(${data.keluarga_id})"><i class="fa fa-edit"></i></button>
                        <button class="btn btn-danger btn-sm" type="button" onclick="hapuskeluarga(${data.keluarga_id})"><i class="fa fa-trash"></i></button>`
                        }
                    }
                ]
            })
        }

        loadDataPendidikanFormal = () => {
            let person_id = $("#person_id").val();
            $("#table_pendidikan_formal").DataTable({
                ordering: false,
                paging: false,
                searching: false,
                destroy: true,
                ajax: {
                    url: "/rh/getDataPendidikanFormal",
                    type: "POST",
                    data: function(d) {
                        d.person_id = person_id
                    },
                    dataSrc: function(json) {
                        let nomor = 1
                        json.forEach((row, idx) => {
                            if (idx > 0) {
                                nomor++
                            }
                            row.nomor = nomor
                        });

                        return json
                    }
                },
                bDestroy: true,
                pageLength: 100,
                columns: [
                    {
                        data: "jenjang_pendidikan_nm",
                        className: "text-left"
                    },
                    {
                        data: "nama_sekolah",
                        className: "text-left"
                    },
                    {
                        data: "jurusan",
                        className: "text-left"
                    },
                    {
                        data: "tempat",
                        className: "text-center"
                    },
                    {
                        data: null,
                        className: "text-center",
                        render: function(data) {
                            return `${data.tahun_mulai}/${data.tahun_selesai}`;
                        }
                    },
                    {
                        data: "keterangan",
                        className: "text-center"
                    },
                    {
                        data: null,
                        className: "text-center",
                        render: function(data) {
                        return `<button class="btn btn-warning btn-sm" type="button" onclick="editPendidikanFormal(${data.riwayat_pendidikan_formal_id})"><i class="fa fa-edit"></i></button>
                        <button class="btn btn-danger btn-sm" type="button" onclick="hapusPendidikanFormal(${data.riwayat_pendidikan_formal_id})"><i class="fa fa-trash"></i></button>`
                        }
                    }
                ]
            })
        }

        loadDataPendidikanPolri = () => {
            let person_id = $("#person_id").val();
            $("#table_pendidikan_polri").DataTable({
                ordering: false,
                paging: false,
                searching: false,
                destroy: true,
                ajax: {
                    url: "/rh/getDataPendidikanPolri",
                    type: "POST",
                    data: function(d) {
                        d.person_id = person_id
                    },
                    dataSrc: function(json) {
                        let nomor = 1
                        json.forEach((row, idx) => {
                            if (idx > 0) {
                                nomor++
                            }
                            row.nomor = nomor
                        });

                        return json
                    }
                },
                bDestroy: true,
                pageLength: 100,
                columns: [
                    {
                        data: "nomor",
                        className: "text-center"
                    },
                    {
                        data: "jenis",
                        className: "text-center"
                    },
                    {
                        data: "tempat",
                        className: "text-left"
                    },
                    {
                        data: "tahun",
                        className: "text-center"
                    },
                    {
                        data: "keterangan",
                        className: "text-center"
                    },
                    {
                        data: null,
                        className: "text-center",
                        render: function(data) {
                        return `<button class="btn btn-warning btn-sm" type="button" onclick="editPendidikanPolri(${data.riwayat_pendidikan_polri_id})"><i class="fa fa-edit"></i></button>
                        <button class="btn btn-danger btn-sm" type="button" onclick="hapusPendidikanPolri(${data.riwayat_pendidikan_polri_id})"><i class="fa fa-trash"></i></button>`
                        }
                    }
                ]
            })
        }

        loadDataPendidikanSpesialis = () => {
            let person_id = $("#person_id").val();
            $("#table_pendidikan_spesialis").DataTable({
                ordering: false,
                paging: false,
                searching: false,
                destroy: true,
                ajax: {
                    url: "/rh/getDataPendidikanSpesialis",
                    type: "POST",
                    data: function(d) {
                        d.person_id = person_id
                    },
                    dataSrc: function(json) {
                        let nomor = 1
                        json.forEach((row, idx) => {
                            if (idx > 0) {
                                nomor++
                            }
                            row.nomor = nomor
                        });

                        return json
                    }
                },
                bDestroy: true,
                pageLength: 100,
                columns: [
                    {
                        data: "nomor",
                        className: "text-center"
                    },
                    {
                        data: "jenis",
                        className: "text-center"
                    },
                    {
                        data: "tempat",
                        className: "text-left"
                    },
                    {
                        data: "tahun",
                        className: "text-center"
                    },
                    {
                        data: "keterangan",
                        className: "text-center"
                    },
                    {
                        data: null,
                        className: "text-center",
                        render: function(data) {
                        return `<button class="btn btn-warning btn-sm" type="button" onclick="editPendidikanSpesialis(${data.riwayat_pendidikan_polri_id})"><i class="fa fa-edit"></i></button>
                        <button class="btn btn-danger btn-sm" type="button" onclick="hapusPendidikanSpesialis(${data.riwayat_pendidikan_polri_id})"><i class="fa fa-trash"></i></button>`
                        }
                    }
                ]
            })
        }

        loadDataRiwayatPekerjaan = () => {
            let person_id = $("#person_id").val();
            $("#table_riwayat_pekerjaan").DataTable({
                ordering: false,
                paging: false,
                searching: false,
                destroy: true,
                ajax: {
                    url: "/rh/getDataRiwayatPekerjaan",
                    type: "POST",
                    data: function(d) {
                        d.person_id = person_id
                    },
                    dataSrc: function(json) {
                        let nomor = 1
                        json.forEach((row, idx) => {
                            if (idx > 0) {
                                nomor++
                            }
                            row.nomor = nomor
                        });

                        return json
                    }
                },
                bDestroy: true,
                pageLength: 100,
                columns: [
                    {
                        data: "nomor",
                        className: "text-center"
                    },
                    {
                        data: "jabatan",
                        className: "text-center"
                    },
                    {
                        data: null,
                        className: "text-center",
                        render: function(data) {
                            var parts_mulai = data.mulai.split('-');
                            var parts_selesai = data.selesai.split('-');
                            var mulai = parts_mulai[1] + '/' + parts_mulai[0];
                            var selesai = parts_selesai[1] + '/' + parts_selesai[0];
                        return `${mulai} s/d ${selesai}`
                        }
                    },
                    {
                        data: "bagian",
                        className: "text-center"
                    },
                    {
                        data: "satker",
                        className: "text-center"
                    },
                    {
                        data: null,
                        className: "text-center",
                        render: function(data) {
                        return `<button class="btn btn-warning btn-sm" type="button" onclick="editRiwayatPekerjaan(${data.riwayat_pekerjaan_id})"><i class="fa fa-edit"></i></button>
                        <button class="btn btn-danger btn-sm" type="button" onclick="hapusRiwayatPekerjaan(${data.riwayat_pekerjaan_id})"><i class="fa fa-trash"></i></button>`
                        }
                    }
                ]
            })
        }

        function simpankeluarga() {
            let isValid = true;
            let form_identitas = document.querySelectorAll(".form-keluarga");

            form_identitas.forEach(function(textarea) {
                if (textarea.value.trim() === "") {
                    isValid = false;
                    textarea.classList.add("is-invalid");
                } else {
                    textarea.classList.remove("is-invalid");
                }
            });

            if (!isValid) {
                Swal.fire("Semua kolom data keluarga harus diisi terlebih dahulu.", "", "info");
                return false;
            }


            let keluarga_id = $("#keluarga_id").val();
            let hubungan = $("#hubungan").val();
            let person_nm_keluarga = $("#person_nm_keluarga").val();
            let jenis_kelamin = $("#jenis_kelamin").val();
            let tempat_lahir = $("#tempat_lahir").val();
            // let tanggal_lahir = $("#tanggal_lahir").val();
            let pendidikan_keluarga = $("#pendidikan_keluarga").val();
            let pekerjaan = $("#pekerjaan").val();
            let person_id = $("#person_id").val();
            let hari_lahir_keluarga = $("#hari_lahir_keluarga").val();
            let bulan_lahir_keluarga = $("#bulan_lahir_keluarga").val();
            let tahun_lahir_keluarga = $("#tahun_lahir_keluarga").val();

            $.ajax({
                url: "<?= base_url('rh/simpankeluarga') ?>",
                type: "post",
                dataType: "json",
                data: {
                    'person_id' : person_id,
                    'keluarga_id' : keluarga_id,
                    'person_nm_keluarga' : person_nm_keluarga,
                    'hubungan' : hubungan,
                    'jenis_kelamin' : jenis_kelamin,
                    'tempat_lahir' : tempat_lahir,
                    // 'tanggal_lahir' : tanggal_lahir,
                    'hari_lahir_keluarga' : hari_lahir_keluarga,
                    'bulan_lahir_keluarga' : bulan_lahir_keluarga,
                    'tahun_lahir_keluarga' : tahun_lahir_keluarga,
                    'pendidikan_keluarga' : pendidikan_keluarga,
                    'pekerjaan' : pekerjaan
                },
                success: function(data) {
                    if (data == "berhasil") {
                        $("#modal-tambah-keluarga").modal('hide');
                        loadDataKeluarga();
                        emptyFormKeluarga();

                        if (hubungan == "Istri" || hubungan == "Suami") {
                            Swal.fire({
                                title: "Data  berhasil di disimpan",
                                icon: "success",
                                showCancelButton: false,
                                confirmButtonColor: "#3085d6",
                                cancelButtonColor: "#d33",
                                confirmButtonText: "Tambah Anak"
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        $("#modal-tambah-keluarga").modal('show');
                                        tambahKeluarga('Anak');
                                    }
                            });
                        }
                        
                        if (hubungan == "Anak") {
                            Swal.fire({
                                title: "Data keluarga berhasil di disimpan, tekan tombol tambah untuk menambah data anak anda",
                                icon: "success",
                                showCancelButton: false,
                                showDenyButton: true,
                                confirmButtonColor: "#3085d6",
                                denyButtonColor: "#16cf78ff",
                                confirmButtonText: "Tambah",
                                denyButtonText: "Selesai"
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        $("#modal-tambah-keluarga").modal('show');
                                    }

                                    if (result.isDenied) {
                                        nextKeluarga();
                                    }
                                });
                        }
                    } else {
                        Swal.fire("Data gagal di disimpan", "", "info");
                    }
                },
                error: function() {
                    alert("error");
                }
            });
        }

        function editkeluarga(keluarga_id) {
            $.ajax({
                url: "<?= base_url('rh/getKeluargaById') ?>",
                type: "post",
                dataType: "json",
                data: {
                    'keluarga_id' : keluarga_id
                },
                success: function(data) {
                    let pecah = data[0].tanggal_lahir.split("-");
                    let tahun = pecah[0];
                    let bulan = pecah[1];
                    let hari  = pecah[2];
                    
                    $("#modal-tambah-keluarga").modal('show');
                        let keluarga_id = $("#keluarga_id").val(data[0].keluarga_id);
                        let hubungan = $("#hubungan").val(data[0].hubungan);
                        let person_nm_keluarga = $("#person_nm_keluarga").val(data[0].keluarga_nm);
                        let jenis_kelamin = $("#jenis_kelamin").val(data[0].jenis_kelamin);
                        let tempat_lahir = $("#tempat_lahir").val(data[0].tempat_lahir);
                        let hari_lahir_keluarga = $("#hari_lahir_keluarga").val(hari).trigger('change');
                        let bulan_lahir_keluarga = $("#bulan_lahir_keluarga").val(bulan).trigger('change');
                        let tahun_lahir_keluarga = $("#tahun_lahir_keluarga").val(tahun).trigger('change');
                        let pendidikan_keluarga = $("#pendidikan_keluarga").val(data[0].pendidikan);
                        let pekerjaan = $("#pekerjaan").val(data[0].pekerjaan);
                },
                error: function() {
                    alert("error");
                }
            });
        }

        function hapuskeluarga(keluarga_id) {
            Swal.fire({
                title: "Apakah anda yakin hapus data ini?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yakin"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                    url: "<?= base_url('rh/hapuskeluarga') ?>",
                    type: "post",
                    dataType: "json",
                    data: {
                        "keluarga_id": keluarga_id
                    },
                    success: function(data) {
                        Swal.fire("Data keluarga berhasil dihapus", "", "success");
                        loadDataKeluarga();
                    },
                    error: function() {
                        alert("error");
                    }
                });
                }
            });
        }


        function simpanidentitas() {
            let jenis_pengajuan_id = $("#jenis_pengajuan_id").val();
            if (jenis_pengajuan_id == null) {
                Swal.fire("Jenis pengajuan belum dipilih", "", "warning");
                $("#jenis_pengajuan_id").focus();
                return;
            }

            let isValid = true;
            let form_identitas = document.querySelectorAll(".form-identitas");

            form_identitas.forEach(function(textarea) {
                if (textarea.value.trim() === "") {
                    isValid = false;
                    textarea.classList.add("is-invalid");
                } else {
                    textarea.classList.remove("is-invalid");
                }
            });

            if (!isValid) {
                Swal.fire("Semua data harus diisi terlebih dahulu.", "", "info");
                return false;
            }
            
            let person_id = $("#person_id").val();
            let person_nm = $("#person_nm").val();
            let birth_place = $("#birth_place").val();
            let hari_lahir = $("#hari_lahir").val();
            let bulan_lahir = $("#bulan_lahir").val();
            let tahun_lahir = $("#tahun_lahir").val();
            let gender_cd = $("#gender_cd").val();
            let addr_txt = $("#addr_txt").val();
            let religion = $("#religion").val();
            let status_pernikahan = $("#status_pernikahan").val();
            let jabatan_id = $("#jabatan_id").val();
            let pangkat = $("#pangkat").val();
            let nrp = $("#nrp").val();
            let addr_txt_office = $("#addr_txt_office").val();
            let nama_atasan = $("#nama_atasan").val();
            let jabatan_atasan = $("#jabatan_atasan").val();
            let cellphone = $("#cellphone").val();
            let email = $("#email").val();
            let riwayat_hidup_id = $("#riwayat_hidup_id").val();

            $.ajax({
                url: "<?= base_url('rh/simpanidentitas') ?>",
                type: "post",
                dataType: "json",
                data: {
                    'riwayat_hidup_id' : riwayat_hidup_id,
                    'jenis_pengajuan_id' : jenis_pengajuan_id,
                    'person_id' : person_id,
                    'person_nm' : person_nm,
                    'birth_place' : birth_place,
                    // 'birth_dttm' : birth_dttm,
                    'hari_lahir' : hari_lahir,
                    'bulan_lahir' : bulan_lahir,
                    'tahun_lahir' : tahun_lahir,
                    'gender_cd' : gender_cd,
                    'addr_txt' : addr_txt,
                    'religion' : religion,
                    'status_pernikahan' : status_pernikahan,
                    'jabatan_id' : jabatan_id,
                    'pangkat' : pangkat,
                    'nrp' : nrp,
                    'addr_txt_office' : addr_txt_office,
                    'nama_atasan' : nama_atasan,
                    'jabatan_atasan' : jabatan_atasan,
                    'cellphone' : cellphone,
                    'email' : email
                },
                success: function(data) {
                    if (data == "berhasil") {
                        Swal.fire({
                            title: "Data identitas berhasil di disimpan",
                            icon: "success",
                            showCancelButton: false,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "OK"
                            }).then((result) => {
                            if (result.isConfirmed) {
                                loadExistingIdentitas();
                                nextSimpanIdentitas();
                            }
                        });
                    } else {
                        Swal.fire("Data gagal di disimpan", "", "info");
                    }
                },
                error: function() {
                    alert("error");
                }
            });
        }

        function loadExistingIdentitas() {
            $.ajax({
                url: "<?= base_url('rh/loadExistingIdentitas') ?>",
                type: "post",
                dataType: "json",
                beforeSend: function() {
                    $("#loader-wrapper").removeClass("d-none");
                },
                success: function(data) {
                    
                    if (data[0].gender_cd == "m") {
                        $('#btnSuami').hide();
                    }

                    if (data[0].gender_cd == "f") {
                        $('#btnIStri').hide();
                    }
                    
                    let pecah = data[0].birth_dttm.substring(0, 10).split("-");
                    let tahun = pecah[0];
                    let bulan = pecah[1];
                    let hari  = pecah[2];

                    var tahun_ttd = '';
                    var bulan_ttd = '';
                    var hari_ttd  = '';

                    if (data[0].tanggal_ttd != null) {
                        pecah_ttd = data[0].tanggal_ttd.split("-");
                        tahun_ttd = pecah_ttd[0];
                        bulan_ttd = pecah_ttd[1];
                        hari_ttd  = pecah_ttd[2];
                    } 
                    
                    $("#person_nm").val(data[0].person_nm);
                    $("#birth_place").val(data[0].birth_place);
                    $("#hari_lahir").val(hari).trigger('change');
                    $("#bulan_lahir").val(bulan).trigger('change');
                    $("#tahun_lahir").val(tahun).trigger('change');
                    $("#gender_cd").val(data[0].gender_cd);
                    $("#addr_txt").val(data[0].addr_txt);
                    $("#religion").val(data[0].religion);
                    $("#status_pernikahan").val(data[0].status_pernikahan);
                    $("#jabatan_id").val(data[0].jabatan);
                    $("#pangkat").val(data[0].pangkat);
                    $("#nrp").val(data[0].nrp);
                    $("#addr_txt_office").val(data[0].addr_txt_office);
                    $("#nama_atasan").val(data[0].nama_atasan);
                    $("#jabatan_atasan").val(data[0].jabatan_atasan);
                    $("#cellphone").val(data[0].cellphone);
                    $("#email").val(data[0].email);
                    $("#person_id").val(data[0].person_id);
                    $("#riwayat_hidup_id").val(data[0].riwayat_hidup_id);
                    $("#jenis_pengajuan_id").val(data[0].jenis_pengajuan_id);
                    $("#tempat_ttd").val(data[0].tempat_ttd);
                    $("#hari_tanda_tangan").val(hari_ttd).trigger('change');
                    $("#bulan_tanda_tangan").val(bulan_ttd).trigger('change');
                    $("#tahun_tanda_tangan").val(tahun_ttd).trigger('change');
                    $("#no_test_header").text(data[0].no_antrian);
                    if (data[0].nama_file) {
                        $('#photo').attr('src', '<?= base_url() ?>/images/ttd/'+data[0].nama_file).show();
                    }
                    
                    loadDataKeluarga();
                    loadDataPendidikanFormal();
                    loadDataPendidikanPolri();
                    loadDataPendidikanSpesialis();
                    loadDataRiwayatPekerjaan();
                },
                error: function() {
                    alert("Error");
                    $("#loader-wrapper").addClass("d-none");
                }
            });
            
        }

        function editidentitas() {
            $(".form-identitas").prop("disabled", false);
            $("#btn_simpanidentitas").show();
            $("#btn_editidentitas").hide();
        }

        function simpanpendidikanformal() {
            let isValid = true;
            let form_identitas = document.querySelectorAll(".form-pendidikan");

            form_identitas.forEach(function(textarea) {
                if (textarea.value.trim() === "") {
                    isValid = false;
                    textarea.classList.add("is-invalid");
                } else {
                    textarea.classList.remove("is-invalid");
                }
            });

            if (!isValid) {
                Swal.fire("Semua data pendidikan harus diisi terlebih dahulu.", "", "info");
                return false;
            }

            let riwayat_pendidikan_formal_id = $("#riwayat_pendidikan_formal_id").val();
            let person_id = $("#person_id").val();
            let nama_sekolah = $("#nama_sekolah").val();
            let jenjang_pendidikan_id = $("#jenjang_pendidikan_id").val();
            let jurusan = $("#jurusan").val();
            let tempat = $("#tempat").val();
            let tahun_mulai = $("#tahun_mulai").val();
            let tahun_selesai = $("#tahun_selesai").val();
            let keterangan = $("#keterangan").val();

            $.ajax({
                url: "<?= base_url('rh/simpanpendidikanformal') ?>",
                type: "post",
                dataType: "json",
                data: {
                    'riwayat_pendidikan_formal_id' : riwayat_pendidikan_formal_id,
                    'person_id' : person_id,
                    'nama_sekolah' : nama_sekolah,
                    'jenjang_pendidikan_id' : jenjang_pendidikan_id,
                    'jurusan' : jurusan,
                    'tempat' : tempat,
                    'tahun_mulai' : tahun_mulai,
                    'tahun_selesai' : tahun_selesai,
                    'keterangan' : keterangan
                },
                success: function(data) {
                    if (data == "berhasil") {
                        Swal.fire({
                            title: "Data keluarga berhasil di disimpan",
                            icon: "success",
                            showCancelButton: false,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "OK"
                            }).then((result) => {
                            if (result.isConfirmed) {
                                $("#modal-pendidikan-formal").modal('hide');
                                loadDataPendidikanFormal();
                                emptyFormPendidikanFormal();
                            }
                        });
                    } else {
                        Swal.fire("Data gagal di disimpan", "", "info");
                    }
                },
                error: function() {
                    alert("error");
                }
            });
        }


        function editPendidikanFormal(riwayat_pendidikan_formal_id) {
            $.ajax({
                url: "<?= base_url('rh/getDataPendidikanFormalById') ?>",
                type: "post",
                dataType: "json",
                data: {
                    'riwayat_pendidikan_formal_id' : riwayat_pendidikan_formal_id
                },
                success: function(data) {
                    $("#modal-pendidikan-formal").modal('show');
                        let riwayat_pendidikan_formal_id = $("#riwayat_pendidikan_formal_id").val(data[0].riwayat_pendidikan_formal_id);
                        let jenjang_pendidikan_id = $("#jenjang_pendidikan_id").val(data[0].jenjang_pendidikan_id);
                        let nama_sekolah = $("#nama_sekolah").val(data[0].nama_sekolah);
                        let jurusan = $("#jurusan").val(data[0].jurusan);
                        let tempat = $("#tempat").val(data[0].tempat);
                        let tahun_mulai = $("#tahun_mulai").val(data[0].tahun_mulai).trigger('change');
                        let tahun_selesai = $("#tahun_selesai").val(data[0].tahun_selesai).trigger('change');
                        let keterangan = $("#keterangan").val(data[0].keterangan);
                },
                error: function() {
                    alert("error");
                }
            });
        }

        function hapusPendidikanFormal(riwayat_pendidikan_formal_id) {
            Swal.fire({
                title: "Apakah anda yakin hapus data ini?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yakin"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                    url: "<?= base_url('rh/hapuspendidikanformal') ?>",
                    type: "post",
                    dataType: "json",
                    data: {
                        "riwayat_pendidikan_formal_id": riwayat_pendidikan_formal_id
                    },
                    success: function(data) {
                        Swal.fire("Data pendidikan formal berhasil dihapus", "", "success");
                        loadDataPendidikanFormal();
                    },
                    error: function() {
                        alert("error");
                    }
                });
                }
            });
        }

        function simpanpendidikanpolri() {
            let isValid = true;
            let form_identitas = document.querySelectorAll(".form-polri");

            form_identitas.forEach(function(textarea) {
                if (textarea.value.trim() === "") {
                    isValid = false;
                    textarea.classList.add("is-invalid");
                } else {
                    textarea.classList.remove("is-invalid");
                }
            });

            if (!isValid) {
                Swal.fire("Semua kolom pendidikan polri harus diisi terlebih dahulu.", "", "info");
                return false;
            }

            let riwayat_pendidikan_polri_id = $("#riwayat_pendidikan_polri_id").val();
            let person_id = $("#person_id").val();
            let jenis_pendidikan_polri = $("#jenis_pendidikan_polri").val();
            let tempat_pendidikan_polri = $("#tempat_pendidikan_polri").val();
            let tahun_pendidikan_polri = $("#tahun_pendidikan_polri").val();
            let keterangan_pendidikan_polri = $("#keterangan_pendidikan_polri").val();

            $.ajax({
                url: "<?= base_url('rh/simpanpendidikanpolri') ?>",
                type: "post",
                dataType: "json",
                data: {
                    'riwayat_pendidikan_polri_id' : riwayat_pendidikan_polri_id,
                    'person_id' : person_id,
                    'jenis_pendidikan_polri' : jenis_pendidikan_polri,
                    'tempat_pendidikan_polri' : tempat_pendidikan_polri,
                    'tahun_pendidikan_polri' : tahun_pendidikan_polri,
                    'keterangan_pendidikan_polri' : keterangan_pendidikan_polri,
                    'tipe_pendidikan_polri' : 1
                },
                success: function(data) {
                    if (data == "berhasil") {
                        Swal.fire({
                            title: "Data keluarga berhasil di disimpan",
                            icon: "success",
                            showCancelButton: false,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "OK"
                            }).then((result) => {
                            if (result.isConfirmed) {
                                $("#modal-pendidikan-polri").modal('hide');
                                loadDataPendidikanPolri();
                                emptyFormPendidikanPolri();
                            }
                        });
                    } else {
                        Swal.fire("Data gagal di disimpan", "", "info");
                    }
                },
                error: function() {
                    alert("error");
                }
            });
        }

        function editPendidikanPolri(riwayat_pendidikan_polri_id) {
            $.ajax({
                url: "<?= base_url('rh/getDataPendidikanPolriById') ?>",
                type: "post",
                dataType: "json",
                data: {
                    'riwayat_pendidikan_polri_id' : riwayat_pendidikan_polri_id
                },
                success: function(data) {
                    $("#modal-pendidikan-polri").modal('show');
                        let riwayat_pendidikan_polri_id = $("#riwayat_pendidikan_polri_id").val(data[0].riwayat_pendidikan_polri_id);
                        let jenis_pendidikan_polri = $("#jenis_pendidikan_polri").val(data[0].jenis);
                        let tempat_pendidikan_polri = $("#tempat_pendidikan_polri").val(data[0].tempat);
                        let tahun_pendidikan_polri = $("#tahun_pendidikan_polri").val(data[0].tahun);
                        let keterangan_pendidikan_polri = $("#keterangan_pendidikan_polri").val(data[0].keterangan);
                },
                error: function() {
                    alert("error");
                }
            });
        }

        function hapusPendidikanPolri(riwayat_pendidikan_polri_id) {
            Swal.fire({
                title: "Apakah anda yakin hapus data ini?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yakin"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                    url: "<?= base_url('rh/hapuspendidikanpolri') ?>",
                    type: "post",
                    dataType: "json",
                    data: {
                        "riwayat_pendidikan_polri_id": riwayat_pendidikan_polri_id
                    },
                    success: function(data) {
                        Swal.fire("Data pendidikan polri berhasil dihapus", "", "success");
                        loadDataPendidikanPolri();
                    },
                    error: function() {
                        alert("error");
                    }
                });
                }
            });
        }

        function simpanpendidikanspesialis() {
            let isValid = true;
            let form_identitas = document.querySelectorAll(".form-spesialis");

            form_identitas.forEach(function(textarea) {
                if (textarea.value.trim() === "") {
                    isValid = false;
                    textarea.classList.add("is-invalid");
                } else {
                    textarea.classList.remove("is-invalid");
                }
            });

            if (!isValid) {
                Swal.fire("Semua data pendidikan spesialis harus diisi terlebih dahulu.", "", "info");
                return false;
            }

            let riwayat_pendidikan_spesialis_id = $("#riwayat_pendidikan_spesialis_id").val();
            let person_id = $("#person_id").val();
            let jenis_pendidikan_spesialis = $("#jenis_pendidikan_spesialis").val();
            let tempat_pendidikan_spesialis = $("#tempat_pendidikan_spesialis").val();
            let tahun_pendidikan_spesialis = $("#tahun_pendidikan_spesialis").val();
            let keterangan_pendidikan_spesialis = $("#keterangan_pendidikan_spesialis").val();

            $.ajax({
                url: "<?= base_url('rh/simpanpendidikanspesialis') ?>",
                type: "post",
                dataType: "json",
                data: {
                    'riwayat_pendidikan_spesialis_id' : riwayat_pendidikan_spesialis_id,
                    'person_id' : person_id,
                    'jenis_pendidikan_spesialis' : jenis_pendidikan_spesialis,
                    'tempat_pendidikan_spesialis' : tempat_pendidikan_spesialis,
                    'tahun_pendidikan_spesialis' : tahun_pendidikan_spesialis,
                    'keterangan_pendidikan_spesialis' : keterangan_pendidikan_spesialis,
                    'tipe_pendidikan_spesialis' : 2
                },
                success: function(data) {
                    if (data == "berhasil") {
                        Swal.fire({
                            title: "Data pendidikan spesialis berhasil di disimpan",
                            icon: "success",
                            showCancelButton: false,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "OK"
                            }).then((result) => {
                            if (result.isConfirmed) {
                                $("#modal-pendidikan-spesialis").modal('hide');
                                loadDataPendidikanSpesialis();
                                emptyFormPendidikanSpesialis();
                            }
                        });
                    } else {
                        Swal.fire("Data gagal di disimpan", "", "info");
                    }
                },
                error: function() {
                    alert("error");
                }
            });
        }

        function editPendidikanSpesialis(riwayat_pendidikan_spesialis_id) {
            $.ajax({
                url: "<?= base_url('rh/getDataPendidikanSpesialisById') ?>",
                type: "post",
                dataType: "json",
                data: {
                    'riwayat_pendidikan_spesialis_id' : riwayat_pendidikan_spesialis_id
                },
                success: function(data) {
                    $("#modal-pendidikan-spesialis").modal('show');
                        let riwayat_pendidikan_spesialis_id = $("#riwayat_pendidikan_spesialis_id").val(data[0].riwayat_pendidikan_polri_id);
                        let jenis_pendidikan_spesialis = $("#jenis_pendidikan_spesialis").val(data[0].jenis);
                        let tempat_pendidikan_spesialis = $("#tempat_pendidikan_spesialis").val(data[0].tempat);
                        let tahun_pendidikan_spesialis = $("#tahun_pendidikan_spesialis").val(data[0].tahun);
                        let keterangan_pendidikan_spesialis = $("#keterangan_pendidikan_spesialis").val(data[0].keterangan);
                },
                error: function() {
                    alert("error");
                }
            });
        }

        function hapusPendidikanSpesialis(riwayat_pendidikan_spesialis_id) {
            Swal.fire({
                title: "Apakah anda yakin hapus data ini?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yakin"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                    url: "<?= base_url('rh/hapuspendidikanspesialis') ?>",
                    type: "post",
                    dataType: "json",
                    data: {
                        "riwayat_pendidikan_spesialis_id": riwayat_pendidikan_spesialis_id
                    },
                    success: function(data) {
                        Swal.fire("Data pendidikan spesialis berhasil dihapus", "", "success");
                        loadDataPendidikanSpesialis();
                    },
                    error: function() {
                        alert("error");
                    }
                });
                }
            });
        }

        
        function simpanriwayatpekerjaan() {
            let isValid = true;
            let form_identitas = document.querySelectorAll(".form-pekerjaan");

            form_identitas.forEach(function(textarea) {
                if (textarea.value.trim() === "") {
                    isValid = false;
                    textarea.classList.add("is-invalid");
                } else {
                    textarea.classList.remove("is-invalid");
                }
            });

            if (!isValid) {
                Swal.fire("Semua kolom riwayat pekerjaan harus diisi terlebih dahulu.", "", "info");
                return false;
            }

            let riwayat_pekerjaan_id = $("#riwayat_pekerjaan_id").val();
            let person_id = $("#person_id").val();
            let riwayat_jabatan = $("#riwayat_jabatan").val();
            let bulan_mulai_pekerjaan = $("#bulan_mulai_pekerjaan").val();
            let tahun_mulai_pekerjaan = $("#tahun_mulai_pekerjaan").val();
            let bulan_selesai_pekerjaan = $("#bulan_selesai_pekerjaan").val();
            let tahun_selesai_pekerjaan = $("#tahun_selesai_pekerjaan").val();
            let riwayat_bagian = $("#riwayat_bagian").val();
            let riwayat_satker = $("#riwayat_satker").val();

            $.ajax({
                url: "<?= base_url('rh/simpanriwayatpekerjaan') ?>",
                type: "post",
                dataType: "json",
                data: {
                    'riwayat_pekerjaan_id' : riwayat_pekerjaan_id,
                    'person_id' : person_id,
                    'riwayat_jabatan' : riwayat_jabatan,
                    'bulan_mulai_pekerjaan' : bulan_mulai_pekerjaan,
                    'tahun_mulai_pekerjaan' : tahun_mulai_pekerjaan,
                    'bulan_selesai_pekerjaan' : bulan_selesai_pekerjaan,
                    'tahun_selesai_pekerjaan' : tahun_selesai_pekerjaan,
                    'riwayat_bagian' : riwayat_bagian,
                    'riwayat_satker' : riwayat_satker
                },
                success: function(data) {
                    if (data == "berhasil") {
                        Swal.fire({
                            title: "Data pendidikan spesialis berhasil di disimpan",
                            icon: "success",
                            showCancelButton: false,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "OK"
                            }).then((result) => {
                            if (result.isConfirmed) {
                                $("#modal-riwayat-pekerjaan").modal('hide');
                                loadDataRiwayatPekerjaan();
                                emptyFormRiwayatPekerjaan();
                            }
                        });
                    } else {
                        Swal.fire("Data gagal di disimpan", "", "info");
                    }
                },
                error: function() {
                    alert("error");
                }
            });
        }

        function editRiwayatPekerjaan(riwayat_pekerjaan_id) {
            $.ajax({
                url: "<?= base_url('rh/getDataRiwayatPekerjaanById') ?>",
                type: "post",
                dataType: "json",
                data: {
                    'riwayat_pekerjaan_id' : riwayat_pekerjaan_id
                },
                success: function(data) {
                    let pecah_mulai = data[0].mulai.split("-");
                    let tahun_mulai = pecah_mulai[0];
                    let bulan_mulai = pecah_mulai[1];
                    let hari_mulai = pecah_mulai[2];

                    let pecah_selesai = data[0].selesai.split("-");
                    let tahun_selesai = pecah_selesai[0];
                    let bulan_selesai = pecah_selesai[1];
                    let hari_selesai  = pecah_selesai[2];

                    $("#modal-riwayat-pekerjaan").modal('show');
                        let riwayat_pekerjaan_id = $("#riwayat_pekerjaan_id").val(data[0].riwayat_pekerjaan_id);
                        let riwayat_jabatan = $("#riwayat_jabatan").val(data[0].jabatan);
                        let bulan_mulai_pekerjaan = $("#bulan_mulai_pekerjaan").val(bulan_mulai).trigger('change');
                        let tahun_mulai_pekerjaan = $("#tahun_mulai_pekerjaan").val(tahun_mulai).trigger('change');
                        let bulan_selesai_pekerjaan = $("#bulan_selesai_pekerjaan").val(bulan_selesai).trigger('change');
                        let tahun_selesai_pekerjaan = $("#tahun_selesai_pekerjaan").val(tahun_selesai).trigger('change');
                        let riwayat_bagian = $("#riwayat_bagian").val(data[0].bagian);
                        let riwayat_satker = $("#riwayat_satker").val(data[0].satker);
                },
                error: function() {
                    alert("error");
                }
            });
        }

        function hapusRiwayatPekerjaan(riwayat_pekerjaan_id) {
            Swal.fire({
                title: "Apakah anda yakin hapus data ini?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yakin"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                    url: "<?= base_url('rh/hapusriwayatpekerjaan') ?>",
                    type: "post",
                    dataType: "json",
                    data: {
                        "riwayat_pekerjaan_id": riwayat_pekerjaan_id
                    },
                    success: function(data) {
                        Swal.fire("Data pendidikan spesialis berhasil dihapus", "", "success");
                        loadDataRiwayatPekerjaan();
                    },
                    error: function() {
                        alert("error");
                    }
                });
                }
            });
        }


        const tabs = document.querySelectorAll('.tab');
        const panels = document.querySelectorAll('.tab-content');

        // tabs.forEach(tab => {
        //     tab.addEventListener('click', () => {
        //         activateTab(tab);
        //     });

        //     tab.addEventListener('keydown', e => {
        //         // Keyboard navigation: Left and Right arrow keys to move between tabs
        //         let index = Array.prototype.indexOf.call(tabs, e.currentTarget);
        //         if(e.key === 'ArrowRight') {
        //         e.preventDefault();
        //         const nextIndex = (index + 1) % tabs.length;
        //         tabs[nextIndex].focus();
        //         activateTab(tabs[nextIndex]);
        //         } else if(e.key === 'ArrowLeft') {
        //         e.preventDefault();
        //         const prevIndex = (index - 1 + tabs.length) % tabs.length;
        //         tabs[prevIndex].focus();
        //         activateTab(tabs[prevIndex]);
        //         }
        //     });
        // });

        function activateTab(selectedTab) {
            tabs.forEach(tab => {
                tab.classList.remove('active');
                tab.setAttribute('aria-selected', 'false');
                tab.tabIndex = -1;
            });
            panels.forEach(panel => {
                panel.hidden = true;
            });

            selectedTab.classList.add('active');
            selectedTab.setAttribute('aria-selected', 'true');
            selectedTab.tabIndex = 0;

            const panelId = selectedTab.getAttribute('aria-controls');
            document.getElementById(panelId).hidden = false;
        }

        function nextSimpanIdentitas() {
            const keluargaTab = document.getElementById('tab-keluarga');
            activateTab(keluargaTab);
        }

        function nextIdentitas() {
            let isValid = true;
            let form_identitas = document.querySelectorAll(".form-identitas");

            form_identitas.forEach(function(textarea) {
                if (textarea.value.trim() === "") {
                    isValid = false;
                    textarea.classList.add("is-invalid");
                } else {
                    textarea.classList.remove("is-invalid");
                }
            });

            if (!isValid) {
                Swal.fire("Semua data harus diisi terlebih dahulu.", "", "info");
                return false;
            }
            simpanidentitas();
            const keluargaTab = document.getElementById('tab-keluarga');
            activateTab(keluargaTab);
        }

        function nextKeluarga() {
            const pendididkanTab = document.getElementById('tab-riwayat-pendidikan');
            activateTab(pendididkanTab);
        }

        function prevKeluarga() {
            const keluargaTab = document.getElementById('tab-identitas');
            activateTab(keluargaTab);
        }

        function nextPendidikan() {
            const pendididkanTab = document.getElementById('tab-riwayat-pekerjaan');
            activateTab(pendididkanTab);
        }

        function prevPendidikan() {
            const keluargaTab = document.getElementById('tab-keluarga');
            activateTab(keluargaTab);
        }

        function nextPekerjaan() {
            const tandatanganTab = document.getElementById('tab-ttd');
            activateTab(tandatanganTab);
        }

        function prevPekerjaan() {
            const pendidikanTab = document.getElementById('tab-riwayat-pendidikan');
            activateTab(pendidikanTab);
        }

        function prevTandaTangan() {
            const pekerjaanTab = document.getElementById('tab-riwayat-pekerjaan');
            activateTab(pekerjaanTab);
        }

        function nextTandaTangan() {
            const inventoriTab = document.getElementById('tab-inventori');
            activateTab(inventoriTab);
        }

        $(function () {
            $('.select2').select2()

            $('.select2bs4').select2({
                theme: 'bootstrap4'
                })
        })

        $(document).ready(function(){
            loadExistingIdentitas();
            showtoken();

            const video = document.getElementById('video');
            const canvas = document.getElementById('canvas');
            const photo = document.getElementById('photo');
            const context = canvas.getContext('2d');

            // Minta akses ke kamera
            navigator.mediaDevices.getUserMedia({ video: true })
            .then(function (stream) {
                video.srcObject = stream;
                video.play();
            })
            .catch(function (err) {
                alert("Tidak dapat mengakses kamera: " + err);
            });

            // Ambil gambar saat tombol diklik
            $('#snap').click(function () {
                context.drawImage(video, 0, 0, canvas.width, canvas.height);
                const imageData = canvas.toDataURL('image/png');
                $('#photo').attr('src', imageData).show();
                $('#simpantandatangan').show();
            });

            $('#simpantandatangan').click(function () {
                const imageData = canvas.toDataURL('image/png');
                let person_id = $("#person_id").val(); 
                let riwayat_hidup_id = $("#riwayat_hidup_id").val();
                let tempat_ttd = $("#tempat_ttd").val();
                let hari_tanda_tangan = $("#hari_tanda_tangan").val();
                let bulan_tanda_tangan = $("#bulan_tanda_tangan").val();
                let tahun_tanda_tangan = $("#tahun_tanda_tangan").val();
                let jenis_pengajuan_id = $("#jenis_pengajuan_id").val();
                
                if (jenis_pengajuan_id == '' || jenis_pengajuan_id == null) {
                    Swal.fire("Jenis pengajuan wajib diisi", "", "warning");
                    $("#jenis_pengajuan_id").focus();
                    return;
                }

                if (tempat_ttd == '' || tempat_ttd == null) {
                    Swal.fire("Tempat tanda tangan wajib diisi", "", "warning");
                    $("#tempat_ttd").focus();
                    return;
                } 
                
                // if (tanggal_ttd == '' || tanggal_ttd == null) {
                //     Swal.fire("Tanggal tanda tangan wajib diisi", "", "warning");
                //     $("#tanggal_ttd").focus();
                //     return;
                // } 

                Swal.fire({
                    title: "Apakah anda yakin simpan data?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yakin"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "<?= base_url('rh/simpantandatangan') ?>",
                            type: 'POST',
                            data: { foto: imageData, 
                                    person_id: person_id, 
                                    riwayat_hidup_id: riwayat_hidup_id,
                                    tempat_ttd: tempat_ttd,
                                    // tanggal_ttd: tanggal_ttd,
                                    hari_tanda_tangan : hari_tanda_tangan,
                                    bulan_tanda_tangan : bulan_tanda_tangan,
                                    tahun_tanda_tangan : tahun_tanda_tangan,
                                    jenis_pengajuan_id: jenis_pengajuan_id
                                },
                            success: function (response) {
                                Swal.fire("Foto berhasil disimpan!", "", "success");
                                $('#simpantandatangan').hide();
                                nextTandaTangan();
                            },
                            error: function () {
                                Swal.fire("Gagal menyimpan foto!", "", "warning");
                            }
                        });
                    }
                });
            });  
        });
    </script>
</body>
</html>