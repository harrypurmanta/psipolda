<?php 
  $this->session = \Config\Services::session();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin | Soal</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="<?= base_url() ?>/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>/dist/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>/plugins/sweetalert2/sweetalert2.css">
  <style>
    #loader-wrapper {
      display: flex;
      position: fixed;
      z-index: 1060;
      top: 0;
      right: 0;
      bottom: 0;
      left: 0;
      flex-direction: row;
      align-items: center;
      justify-content: center;
      padding: 0.625em;
      overflow-x: hidden;
      transition: background-color 0.1s;
      background-color: rgb(253 253 253 / 58%);
      -webkit-overflow-scrolling: touch;
    }

    .loader {
      border: 10px solid #f3f3f3;
      border-radius: 50%;
      border-top: 10px solid #3af3f5;
      border-bottom: 10px solid #3abcec;
      width: 50px;
      height: 50px;
      -webkit-animation: spin 2s linear infinite;
      animation: spin 2s linear infinite;
      margin: 1.75rem auto;
    }

      

        @keyframes fadeIn {
          0% {
            opacity: 0;
          }
          100% {
            opacity: 1;
          }
        }

        @-moz-keyframes fadeIn {
          0% {
            opacity: 0;
          }
          100% {
            opacity: 1;
          }
        }

        @-webkit-keyframes fadeIn {
          0% {
            opacity: 0;
          }
          100% {
            opacity: 1;
          }
        }

        @-o-keyframes fadeIn {
          0% {
            opacity: 0;
          }
          100% {
            opacity: 1;
          }
        }

        @-ms-keyframes fadeIn {
          0% {
            opacity: 0;
          }
          100% {
            opacity: 1;
          }
        }

        @-webkit-keyframes spin {
          0% {
            -webkit-transform: rotate(0deg);
          }
          100% {
            -webkit-transform: rotate(360deg);
          }
        }

        @keyframes spin {
          0% {
            transform: rotate(0deg);
          }
          100% {
            transform: rotate(360deg);
          }
        }
  </style>
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">
 <!-- Navbar -->
 <?= $this->include('admin/navbar') ?>
  <!-- /.navbar -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Soal</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Soal</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <div class="col-md-6">
                  <form class="form-horizontal">
                    <div class="card-body">
                      <div class="form-group row">
                        <label for="group_id" class="col-sm-3 col-form-label">Group Soal</label>
                        <div class="col-sm-9">
                          <select name="group_id" id="group_id" class="form-control select2bs4" style="width: 100%;">
                              <option value="" disabled <?= (empty($this->session->get('group_filter')) && empty($this->session->get('group_id')) ? "selected" : "") ?>>Pilih Group Soal</option>
                              <?php
                                  $selected_group = $this->session->get('group_filter') ?? $this->session->get('group_id');
                                  foreach ($group as $key) {
                              ?>
                              <option value="<?= $key->group_soal_id ?>" <?= ($selected_group == $key->group_soal_id ? "selected" : "") ?>>
                                  <?= $key->group_nm ?>
                              </option>
                              <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="materi_id" class="col-sm-3 col-form-label">Materi Soal</label>
                        <div class="col-sm-9">
                          <select name="materi_id" id="materi_id" class="form-control select2bs4" style="width: 100%;">
                              <option value="" disabled selected>Pilih Materi Soal</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10 d-flex justify-content-end">
                          <div class="form-check">
                            <button type="button" class="btn btn-sm btn-primary" onclick="tampilkansoal()">Tampilkan</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              <div class="col-lg-12">
                <a href="<?= base_url() ?>/admin/soal/viewTambahsoal" class="btn btn-primary">Tambah Soal</a>
                <button onclick="tambahsoallatihan()" class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah-sk">Tambah SK</button>
                
                <div class="col-lg-9" style="display:inline-block;text-align:right;width:100%;">
                  <button type="button" class="btn btn-info ml-2" data-toggle="modal" data-target="#modalImportSK">
                    <i class="fas fa-file-excel"></i> Import Sikap Kerja (Excel)
                  </button>
                  <button type="button" class="btn btn-success ml-2" data-toggle="modal" data-target="#modalImportSoal">
                    <i class="fas fa-file-excel"></i> Import Soal (Excel)
                  </button>
                </div>
              </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body" id="dv_cardbody">
                  <table id="tbl_soal" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th width="10" style="text-align: center;">No.</th>
                        <th width="100" style="text-align: center;">No. Soal</th>
                        <th style="text-align: center;">Soal</th>
                        <th style="text-align: center;">Kunci</th>
                        <th style="text-align: center;" width="100">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->

    <!-- Modal Tambah SK -->
    <div class="modal fade" id="modal-tambah-sk">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title font-weight-bold">Tambah Soal Sikap Kerja (SK)</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="form_tambah_sk">
              <div class="form-group row">
                <label for="sk_group_id" class="col-sm-3 col-form-label font-weight-bold">Group Soal <span class="text-danger">*</span></label>
                <div class="col-sm-9">
                  <select name="group_id" id="sk_group_id" class="form-control select2bs4" style="width: 100%;">
                    <option value="" disabled selected>Pilih Group Soal</option>
                    <?php if (!empty($group)) : ?>
                      <?php foreach ($group as $key) : ?>
                        <option value="<?= $key->group_soal_id ?>"><?= $key->group_nm ?></option>
                      <?php endforeach; ?>
                    <?php endif; ?>
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <label for="sk_materi_id" class="col-sm-3 col-form-label font-weight-bold">Materi Soal <span class="text-danger">*</span></label>
                <div class="col-sm-9">
                  <select name="materi_id" id="sk_materi_id" class="form-control select2bs4" style="width: 100%;">
                    <option value="" disabled selected>Pilih Materi Soal</option>
                  </select>
                </div>
              </div>

              <hr>

              <div class="form-group" id="dv_form_text">
                <label class="font-weight-bold mb-2">Karakter Kolom (5 Karakter unik per Kolom):</label>
                <div class="row">
                  <div class="col-md-4 col-12 mb-3">
                    <label for="kolom1" class="col-form-label font-weight-bold">Kolom 1</label>
                    <input onkeyup="checkdupe('kolom1')" oninput="this.value = this.value.toUpperCase()" maxlength="5" type="text" class="form-control" id="kolom1" name="kolom1" placeholder="ABCDE">
                  </div>
                  <div class="col-md-4 col-12 mb-3">
                    <label for="kolom2" class="col-form-label font-weight-bold">Kolom 2</label>
                    <input onkeyup="checkdupe('kolom2')" oninput="this.value = this.value.toUpperCase()" maxlength="5" type="text" class="form-control" id="kolom2" name="kolom2" placeholder="ABCDE">
                  </div>
                  <div class="col-md-4 col-12 mb-3">
                    <label for="kolom3" class="col-form-label font-weight-bold">Kolom 3</label>
                    <input onkeyup="checkdupe('kolom3')" oninput="this.value = this.value.toUpperCase()" maxlength="5" type="text" class="form-control" id="kolom3" name="kolom3" placeholder="ABCDE">
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-4 col-12 mb-3">
                    <label for="kolom4" class="col-form-label font-weight-bold">Kolom 4</label>
                    <input onkeyup="checkdupe('kolom4')" oninput="this.value = this.value.toUpperCase()" maxlength="5" type="text" class="form-control" id="kolom4" name="kolom4" placeholder="ABCDE">
                  </div>
                  <div class="col-md-4 col-12 mb-3">
                    <label for="kolom5" class="col-form-label font-weight-bold">Kolom 5</label>
                    <input onkeyup="checkdupe('kolom5')" oninput="this.value = this.value.toUpperCase()" maxlength="5" type="text" class="form-control" id="kolom5" name="kolom5" placeholder="ABCDE">
                  </div>
                  <div class="col-md-4 col-12 mb-3">
                    <label for="kolom6" class="col-form-label font-weight-bold">Kolom 6</label>
                    <input onkeyup="checkdupe('kolom6')" oninput="this.value = this.value.toUpperCase()" maxlength="5" type="text" class="form-control" id="kolom6" name="kolom6" placeholder="ABCDE">
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-4 col-12 mb-3">
                    <label for="kolom7" class="col-form-label font-weight-bold">Kolom 7</label>
                    <input onkeyup="checkdupe('kolom7')" oninput="this.value = this.value.toUpperCase()" maxlength="5" type="text" class="form-control" id="kolom7" name="kolom7" placeholder="ABCDE">
                  </div>
                  <div class="col-md-4 col-12 mb-3">
                    <label for="kolom8" class="col-form-label font-weight-bold">Kolom 8</label>
                    <input onkeyup="checkdupe('kolom8')" oninput="this.value = this.value.toUpperCase()" maxlength="5" type="text" class="form-control" id="kolom8" name="kolom8" placeholder="ABCDE">
                  </div>
                  <div class="col-md-4 col-12 mb-3">
                    <label for="kolom9" class="col-form-label font-weight-bold">Kolom 9</label>
                    <input onkeyup="checkdupe('kolom9')" oninput="this.value = this.value.toUpperCase()" maxlength="5" type="text" class="form-control" id="kolom9" name="kolom9" placeholder="ABCDE">
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-4 col-12 mb-3">
                    <label for="kolom10" class="col-form-label font-weight-bold">Kolom 10</label>
                    <input onkeyup="checkdupe('kolom10')" oninput="this.value = this.value.toUpperCase()" maxlength="5" type="text" class="form-control" id="kolom10" name="kolom10" placeholder="ABCDE">
                  </div>
                </div>
              </div>

              <div class="form-group d-none" id="dv_form_gambar">
                <label class="font-weight-bold mb-2">Gambar Kolom (5 Gambar unik per Kolom):</label>
                <div class="row">
                  <?php foreach ($kolom as $key) { ?>
                  <div class="col-md-6 col-12 mb-3">
                    <label for="kolom_gambar<?= $key->kolom_id ?>" class="col-form-label font-weight-bold"><?= $key->kolom_nm ?></label>
                    <input type="file" class="form-control" id="kolom_gambar<?= $key->kolom_id ?>" name="kolom_gambar<?= $key->kolom_id ?>" multiple>
                    <button type="button" onclick="simpansoalgambar(<?= $key->kolom_id ?>)" class="btn btn-success">Simpan</button>
                  </div>
                  
                  <?php } ?>
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button onclick="simpansoallatihan()" type="button" class="btn btn-info">Simpan</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="modal-lg">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header" style="padding: 0px 10px;">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div id="modal_body" class="modal-body">

          </div>
          
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
     
    </div>
    <div class="d-none" id='loader-wrapper'>
        <div class="loader"></div>
      </div>
  </div>

  <!-- Modal Import Soal -->
  <div class="modal fade" id="modalImportSoal" tabindex="-1" role="dialog" aria-labelledby="modalImportSoalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalImportSoalLabel"><i class="fas fa-file-excel text-success"></i> Import Soal dari Excel</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="formImportSoal" method="POST" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="form-group">
              <label for="import_group_id">Group Soal <span class="text-danger">*</span></label>
              <select name="group_id" id="import_group_id" class="form-control select2bs4" style="width: 100%;" required>
                <option value="" disabled selected>Pilih Group Soal</option>
                <?php foreach ($group as $key) { ?>
                  <option value="<?= $key->group_soal_id ?>"><?= $key->group_nm ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label for="import_materi_id">Materi Soal <span class="text-danger">*</span></label>
              <select name="materi_id" id="import_materi_id" class="form-control select2bs4" style="width: 100%;" required>
                <option value="" disabled selected>Pilih Materi Soal</option>
              </select>
            </div>
            <div class="form-group">
              <label for="file_excel">File Excel (.xls, .xlsx) <span class="text-danger">*</span></label>
              <input type="file" name="file_excel" id="file_excel" class="form-control-file" accept=".xls,.xlsx" required>
            </div>
            <div class="alert alert-info">
              <i class="fas fa-info-circle mr-1"></i> Gunakan template Excel terbaru di bawah ini. Kolom <code>kolom_id</code>, <code>clue</code>, dan <code>typesoal</code> dapat diisi sesuai kebutuhan atau boleh dikosongkan.<br>
              <a href="<?= base_url('admin/soal/downloadTemplate') ?>" class="btn btn-xs btn-success mt-2"><i class="fas fa-download"></i> Download Template Excel</a>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-success"><i class="fas fa-upload"></i> Mulai Import</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal Import Soal Sikap Kerja -->
  <div class="modal fade" id="modalImportSK" tabindex="-1" role="dialog" aria-labelledby="modalImportSKLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalImportSKLabel"><i class="fas fa-file-excel text-info"></i> Import Soal Sikap Kerja dari Excel</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="formImportSK" method="POST" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="form-group">
              <label for="import_sk_group_id">Group Soal <span class="text-danger">*</span></label>
              <select name="group_id" id="import_sk_group_id" class="form-control select2bs4" style="width: 100%;" required>
                <option value="" disabled selected>Pilih Group Soal</option>
                <?php foreach ($group as $key) { ?>
                  <option value="<?= $key->group_soal_id ?>"><?= $key->group_nm ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label for="import_sk_materi_id">Materi Soal <span class="text-danger">*</span></label>
              <select name="materi_id" id="import_sk_materi_id" class="form-control select2bs4" style="width: 100%;" required>
                <option value="" disabled selected>Pilih Materi Soal</option>
              </select>
            </div>
            <div class="form-group">
              <label for="file_excel_sk">File Excel (.xls, .xlsx) <span class="text-danger">*</span></label>
              <input type="file" name="file_excel" id="file_excel_sk" class="form-control-file" accept=".xls,.xlsx" required>
            </div>
            <div class="alert alert-info">
              <i class="fas fa-info-circle mr-1"></i> <strong>Khusus Sikap Kerja (Kecermatan):</strong><br>
              <small>Template ini dirancang khusus untuk Sikap Kerja (terdiri dari 6 kolom: <code>no_soal</code>, <code>soal</code>, <code>kunci</code>, <code>clue</code>, <code>kolom_id</code>, <code>typesoal</code>). Opsi jawaban ABCDE akan otomatis disimpan dari nilai clue.</small><br>
              <a href="<?= base_url('admin/soal/downloadTemplateSK') ?>" class="btn btn-xs btn-info mt-2"><i class="fas fa-download"></i> Download Template Sikap Kerja</a>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-info"><i class="fas fa-upload"></i> Mulai Import SK</button>
          </div>
        </form>
      </div>
    </div>
  </div>

</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?= base_url() ?>/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url() ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="<?= base_url() ?>/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url() ?>/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>/plugins/sweetalert2/sweetalert2.js"></script>
<!-- Select2 -->
<script src="<?= base_url() ?>/plugins/select2/js/select2.full.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url() ?>/dist/dist/js/adminlte.min.js"></script>
<!-- Page specific script -->
<script>
  function loadMateri(groupId, targetSelectId, selectedMateriId, callback) {
    var $select = $(targetSelectId);
    $select.prop('disabled', true);
    $select.html('<option value="" disabled selected>Memuat materi...</option>').trigger('change');

    if (!groupId) {
      $select.html('<option value="" disabled selected>Pilih Materi Soal</option>');
      $select.prop('disabled', false).trigger('change');
      if (typeof callback === 'function') callback();
      return;
    }

    $.ajax({
      url: "<?= base_url('soal/getMateriByGroup') ?>",
      type: "GET",
      data: { group_id: groupId },
      dataType: "json",
      success: function(data) {
        $select.empty();
        $select.append('<option value="" disabled ' + (!selectedMateriId ? 'selected' : '') + '>Pilih Materi Soal</option>');
        if (data && data.length > 0) {
          $.each(data, function(i, item) {
            var isSelected = (selectedMateriId && selectedMateriId == item.materi_id) ? 'selected' : '';
            $select.append('<option value="' + item.materi_id + '" ' + isSelected + '>' + item.materi_nm + '</option>');
          });
        } else {
          $select.append('<option value="" disabled selected>Tidak ada materi untuk group ini</option>');
        }
        $select.prop('disabled', false);
        $select.trigger('change');
        if (typeof callback === 'function') callback();
      },
      error: function() {
        $select.html('<option value="" disabled selected>Gagal memuat materi</option>');
        $select.prop('disabled', false).trigger('change');
        if (typeof callback === 'function') callback();
      }
    });
  }

  $(function () {
    // Inisialisasi Select2 untuk semua select dengan tema Bootstrap 4
    $('.select2bs4').each(function() {
      var $modal = $(this).closest('.modal');
      $(this).select2({
        theme: 'bootstrap4',
        width: '100%',
        dropdownParent: $modal.length ? $modal : $(document.body)
      });
    });

    if ($('#example2').length) {
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    }

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });

    // Chaining Group Soal -> Materi Soal pada filter halaman
    $('#group_id').on('change', function() {
      var groupId = $(this).val();
      loadMateri(groupId, '#materi_id');
    });

    // Chaining Group Soal -> Materi Soal pada Modal Tambah SK
    $('#sk_group_id').on('change', function() {
      var groupId = $(this).val();
      loadMateri(groupId, '#sk_materi_id');
    });

    // Chaining Group Soal -> Materi Soal pada Modal Import Soal
    $('#import_group_id').on('change', function() {
      var groupId = $(this).val();
      loadMateri(groupId, '#import_materi_id');
    });

    // Sinkronisasi group pilihan saat Modal Import dibuka
    $('#modalImportSoal').on('show.bs.modal', function () {
      var currentGroupId = $('#group_id').val();
      if (currentGroupId && !$('#import_group_id').val()) {
        $('#import_group_id').val(currentGroupId).trigger('change');
        var currentMateriId = $('#materi_id').val();
        loadMateri(currentGroupId, '#import_materi_id', currentMateriId);
      }
    });

    // Reset Modal Import saat ditutup
    $('#modalImportSoal').on('hidden.bs.modal', function () {
      $('#formImportSoal')[0].reset();
      $('#import_group_id').val('').trigger('change');
      $('#import_materi_id').html('<option value="" disabled selected>Pilih Materi Soal</option>').trigger('change');
    });

    // Auto-load materi jika group_id sudah terpilih saat pertama kali render (session)
    var initialGroupId = $('#group_id').val();
    var sessionMateri = "<?= $this->session->get('materi_filter') ?? $this->session->get('materi_id') ?? '' ?>";
    if (initialGroupId) {
      loadMateri(initialGroupId, '#materi_id', sessionMateri, function() {
        if (sessionMateri) {
          tampilkansoal();
        }
      });
    }

    var initialSkGroupId = $('#sk_group_id').val();
    if (initialSkGroupId) {
      loadMateri(initialSkGroupId, '#sk_materi_id');
    }

    // Chaining Group Soal -> Materi Soal pada Modal Import SK
    $('#import_sk_group_id').on('change', function() {
      var groupId = $(this).val();
      loadMateri(groupId, '#import_sk_materi_id');
    });

    // Sinkronisasi group pilihan saat Modal Import SK dibuka
    $('#modalImportSK').on('show.bs.modal', function () {
      var currentGroupId = $('#group_id').val();
      if (currentGroupId && !$('#import_sk_group_id').val()) {
        $('#import_sk_group_id').val(currentGroupId).trigger('change');
        var currentMateriId = $('#materi_id').val();
        loadMateri(currentGroupId, '#import_sk_materi_id', currentMateriId);
      }
    });

    // Reset Modal Import SK saat ditutup
    $('#modalImportSK').on('hidden.bs.modal', function () {
      $('#formImportSK')[0].reset();
      $('#import_sk_group_id').val('').trigger('change');
      $('#import_sk_materi_id').html('<option value="" disabled selected>Pilih Materi Soal</option>').trigger('change');
    });

    $('#formImportSoal').on('submit', function(e) {
      e.preventDefault();
      var formData = new FormData(this);
      $.ajax({
        url: "<?= base_url('admin/soal/importExcel') ?>",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        beforeSend: function() {
          $("#loader-wrapper").removeClass("d-none");
        },
        success: function(data) {
          $("#loader-wrapper").addClass("d-none");
          try {
            var res = JSON.parse(data);
            if (res.status === 'success') {
              var importedGroupId = $("#import_group_id").val();
              var importedMateriId = $("#import_materi_id").val();
              $('#modalImportSoal').modal('hide');
              Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: res.message,
              }).then(() => {
                if (importedGroupId) {
                  $("#group_id").val(importedGroupId);
                  loadMateri(importedGroupId, '#materi_id', importedMateriId, function() {
                    tampilkansoal();
                  });
                } else {
                  tampilkansoal();
                }
                $('#formImportSoal')[0].reset();
                $('#import_materi_id').html('<option value="" disabled selected>Pilih Materi Soal</option>');
              });
            } else {
              Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: res.message,
              });
            }
          } catch (e) {
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: 'Terjadi kesalahan sistem parsing response.',
            });
          }
        },
        error: function() {
          $("#loader-wrapper").addClass("d-none");
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Terjadi kesalahan saat mengunggah file.',
          });
        }
      });
    });

    $('#formImportSK').on('submit', function(e) {
      e.preventDefault();
      var formData = new FormData(this);
      $.ajax({
        url: "<?= base_url('admin/soal/importExcelSK') ?>",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        beforeSend: function() {
          $("#loader-wrapper").removeClass("d-none");
        },
        success: function(data) {
          $("#loader-wrapper").addClass("d-none");
          try {
            var res = JSON.parse(data);
            if (res.status === 'success') {
              var importedGroupId = $("#import_sk_group_id").val();
              var importedMateriId = $("#import_sk_materi_id").val();
              $('#modalImportSK').modal('hide');
              Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: res.message,
              }).then(() => {
                if (importedGroupId) {
                  $("#group_id").val(importedGroupId);
                  loadMateri(importedGroupId, '#materi_id', importedMateriId, function() {
                    tampilkansoal();
                  });
                } else {
                  tampilkansoal();
                }
                $('#formImportSK')[0].reset();
                $('#import_sk_materi_id').html('<option value="" disabled selected>Pilih Materi Soal</option>');
              });
            } else {
              Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: res.message,
              });
            }
          } catch (e) {
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: 'Terjadi kesalahan sistem parsing response.',
            });
          }
        },
        error: function() {
          $("#loader-wrapper").addClass("d-none");
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Terjadi kesalahan saat mengunggah file.',
          });
        }
      });
    });


  });

  $('#sk_materi_id').change(function() {
    var materi_id = $(this).val();
    if (materi_id == 18) {
      $('#dv_form_text').addClass('d-none');
      $('#dv_form_gambar').removeClass('d-none');
    } else {
      $('#dv_form_text').removeClass('d-none');
      $('#dv_form_gambar').addClass('d-none');
    }
  });

  function tampilkansoal() {
    var group_id = $('#group_id').val();
    var materi = $('#materi_id').val();

    if (!group_id) {
      alert("Pilih Group Soal terlebih dahulu");
      return;
    }
    if (!materi) {
      alert("Pilih Materi Soal terlebih dahulu");
      return;
    }

    $.ajax({
      url: "<?= base_url('soal/showsoal') ?>",
      type: "post",
      data: {
        "filter": "filter",
        "group_id": group_id,
        "materi": materi,
      },
      beforeSend: function() {
        $("#loader-wrapper").removeClass("d-none");
      },
      success: function(data) {
        $("#loader-wrapper").addClass("d-none");
        $('#dv_cardbody').html(data);
        if ($.fn.DataTable.isDataTable('#example2')) {
          $('#example2').DataTable().destroy();
        }
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,
        });
      },
      error: function() {
        $("#loader-wrapper").addClass("d-none");
        alert("error");
      }
    });
  }

  function showsoal(filter) {
      var group_id = $('#group_id').val() || $("input[name='group_filter']:checked").val();
      var materi = $('#materi_id').val() || $("input[name='materi_filter']:checked").val();
      
      if (materi == undefined && filter == "filter") {
          alert("Pilih Materi Soal terlebih dahulu");
          return;
      } else {
        $.ajax({
          url: "<?= base_url('soal/showsoal') ?>",
          type: "post",
          data: {
            "filter" : filter,
            "group_id": group_id,
            "materi": materi,
          },
          beforeSend: function() {
            $("#loader-wrapper").removeClass("d-none");
          },
          success: function(data) {
            $("#loader-wrapper").addClass("d-none");
            $('#dv_cardbody').html(data);
            if ($.fn.DataTable.isDataTable('#example2')) {
              $('#example2').DataTable().destroy();
            }
            $('#example2').DataTable({
              "paging": true,
              "lengthChange": false,
              "searching": true,
              "ordering": true,
              "info": true,
              "autoWidth": false,
              "responsive": true,
            });
          },
          error: function() {
            $("#loader-wrapper").addClass("d-none");
            alert("error");
          }
        });
      }
      
  }

  function checkboxenable(jawaban_nm,kolom_id,soal_id) {
    var checkBox = document.getElementById('customSwitch1_'+kolom_id+'_'+soal_id);
    if (checkBox.checked) {
        var status_cd = "normal";
        var old_status = "disasble";
    } else {
      var status_cd = "disable";
      var old_status = "normal";
    }

    $.ajax({
          url: "<?= base_url('soal/updatestatus') ?>",
          type: "post",
          data: {
            "jawaban_nm" : jawaban_nm,
            "kolom_id"  : kolom_id,
            "status_cd" : status_cd,
            "old_status" : old_status
          },
          beforeSend: function() {
            $("#loader-wrapper").removeClass("d-none")
          },
          success: function(data) {
            $("#loader-wrapper").addClass("d-none");
          },
          error: function() {
            alert("error");
          }
        });
  }



  function checkdupe(kolom) {
    var char = document.getElementById(kolom).value;
    for (i = 0; i < char.length; i++) {
      for (j = i + 1; j < char.length; j++) {
          if (char[i] == char[j]) {
            alert("Karakter tidak boleh sama !");
            var val = char.substr(0, char.length - 1);
            document.getElementById(kolom).value = val;
          }
      }
    }
  }

  function tambahsoallatihan() {
    if (document.getElementById('form_tambah_sk')) {
      document.getElementById('form_tambah_sk').reset();
      $('#sk_group_id').val('').trigger('change');
      $('#sk_materi_id').html('<option value="" disabled selected>Pilih Materi Soal</option>').trigger('change');
      $('#dv_form_text').removeClass('d-none');
      $('#dv_form_gambar').addClass('d-none');
    }
  }

  function simpansoallatihan() {
    var kolom1 = $("#kolom1").val() || "";
    var kolom2 = $("#kolom2").val() || "";
    var kolom3 = $("#kolom3").val() || "";
    var kolom4 = $("#kolom4").val() || "";
    var kolom5 = $("#kolom5").val() || "";
    var kolom6 = $("#kolom6").val() || "";
    var kolom7 = $("#kolom7").val() || "";
    var kolom8 = $("#kolom8").val() || "";
    var kolom9 = $("#kolom9").val() || "";
    var kolom10 = $("#kolom10").val() || "";

    var group_id = $("#sk_group_id").val();
    if (!group_id) {
      alert("Pilih group soal dahulu");
      document.getElementById("sk_group_id").focus();
      return;
    }

    var materi_id = $("#sk_materi_id").val();
    if (!materi_id) {
      alert("Pilih materi dahulu");
      document.getElementById("sk_materi_id").focus();
      return;
    }

    if (kolom1.length < 5) {
      alert("Jumlah karakter pada KOLOM 1 kurang dari 5");
      document.getElementById("kolom1").focus();
      return;
    } 
    
    if (kolom2.length < 5) {
      alert("Jumlah karakter pada KOLOM 2 kurang dari 5");
      document.getElementById("kolom2").focus();
      return;
    }

    if (kolom3.length < 5) {
      alert("Jumlah karakter pada KOLOM 3 kurang dari 5");
      document.getElementById("kolom3").focus();
      return;
    }

    if (kolom4.length < 5) {
      alert("Jumlah karakter pada KOLOM 4 kurang dari 5");
      document.getElementById("kolom4").focus();
      return;
    }

    if (kolom5.length < 5) {
      alert("Jumlah karakter pada KOLOM 5 kurang dari 5");
      document.getElementById("kolom5").focus();
      return;
    }

    if (kolom6.length < 5) {
      alert("Jumlah karakter pada KOLOM 6 kurang dari 5");
      document.getElementById("kolom6").focus();
      return;
    }

    if (kolom7.length < 5) {
      alert("Jumlah karakter pada KOLOM 7 kurang dari 5");
      document.getElementById("kolom7").focus();
      return;
    }

    if (kolom8.length < 5) {
      alert("Jumlah karakter pada KOLOM 8 kurang dari 5");
      document.getElementById("kolom8").focus();
      return;
    }

    if (kolom9.length < 5) {
      alert("Jumlah karakter pada KOLOM 9 kurang dari 5");
      document.getElementById("kolom9").focus();
      return;
    }

    if (kolom10.length < 5) {
      alert("Jumlah karakter pada KOLOM 10 kurang dari 5");
      document.getElementById("kolom10").focus();
      return;
    }  

    $.ajax({
      url: "<?= base_url('soal/simpansoallatihan') ?>",
      type: "post",
      dataType: "json",
      data: {
        "kolom1" : kolom1,
        "kolom2" : kolom2,
        "kolom3" : kolom3,
        "kolom4" : kolom4,
        "kolom5" : kolom5,
        "kolom6" : kolom6,
        "kolom7" : kolom7,
        "kolom8" : kolom8,
        "kolom9" : kolom9,
        "kolom10" : kolom10,
        "group_id" : group_id,
        "materi_id" : materi_id
      },
      beforeSend: function() {
        $("#loader-wrapper").removeClass("d-none");
      },
      success: function(data) {
        $("#loader-wrapper").addClass("d-none");
        
        if (data == "sukses") {
          $('#modal-tambah-sk').modal("hide");
          $('#modal-lg').modal("hide");
          alert("Sukses");
        } else {
          alert("Gagal");
        }
      },
      error: function() {
        $("#loader-wrapper").addClass("d-none");
        alert("error");
      }
    });
  }

  function simpansoalgambar(kolom) {
        var kolom_lama = $("#kolom"+kolom+"_lama").val();

          let inputFile = document.getElementById("kolom_gambar" + kolom);
          let files = inputFile.files;
          
          if (files.length < 5) {
              Swal.fire("Gagal", "Minimal harus upload 5 file", "warning");
              return;
          }

          if (files.length > 5) {
              Swal.fire("Gagal", "Maksimal hanya boleh 5 file", "warning");
              return;
          }

          if (files.length === 0) {
              Swal.fire("Pilih file terlebih dahulu", "", "warning");
              return;
          }

          let formData = new FormData();

          for (let i = 0; i < files.length; i++) {
              formData.append("gambar[]", files[i]);
          }

          formData.append("kolom", kolom);
          formData.append("kolom_lama", kolom_lama);
          formData.append("group_id", 13);

          $.ajax({
              url: "<?= base_url('admin/soal/simpansoalgambar') ?>",
              type: "POST",
              data: formData,
              processData: false,
              contentType: false,
              dataType: "json",

              beforeSend: function () {
                  $("#loader-wrapper").show();
              },

              success: function (res) {
                  $("#loader-wrapper").hide();

                  if (res == "sukses") {
                      Swal.fire("Berhasil", "Soal berhasil disimpan", "success")
                  } else {
                      Swal.fire("Gagal", res.message, "error");
                  }
              },

              error: function () {
                  $("#loader-wrapper").hide();
                  Swal.fire("Error", "Upload gagal", "error");
              }
          });
    }

  function tambahsoal() {
    $.ajax({
        url: "<?= base_url('soal/tambahsoal') ?>",
        success: function(data) {
          $('#modal_body').html(data);

        },
        error: function() {
          alert("error");
        }
      });
  }

  function editsoal(soal_id) {
    $.ajax({
        url: "<?= base_url('soal/editsoal') ?>",
        type: "post",
        dataType: "json",
        data: {
          "soal_id": soal_id
        },
        success: function(data) {
          $('#modal_body').html(data);

        },
        error: function() {
          alert("error");
        }
      });
  }

  function simpansoal() {
      var formdata = new FormData();
      var soal_nm = $("#soal_nm").val();
      var kunci = $("#kunci").val();
      var no_soal = $("#no_soal").val();
      var group_id = $("input[name='group_nm']:checked").val();
      var materi = $("input[name='materi']:checked").val();

      jQuery.each($("input[name='soal_img'")[0].files, function(i, file) {
        formdata.append('soal_img['+i+']', file);
      });
      formdata.append('soal_nm',soal_nm);
      formdata.append('kunci',kunci);
      formdata.append('no_soal',no_soal);
      formdata.append('group_id',group_id);
      formdata.append('materi',materi);
      $.ajax({
        url: "<?= base_url('soal/simpansoal') ?>",
        type: "post",
        data: formdata,
        contentType: false,
        processData: false,
        success: function(data) {
          $('#modal-lg').modal("hide");
          alert("Sukses");
        },
        error: function() {
          alert("error");
        }
      });
  }
  
  function updatesoal(soal_id) {
    var formdata = new FormData();
    var soal_nm = $("#soal_nm").val();
    var soal_img_lama = $("#soal_img_lama").val();
    var kunci = $("#kunci").val();
    var no_soal = $("#no_soal").val();
    var group_id = $("input[name='group_nm']:checked").val();
    var materi = $("input[name='materi']:checked").val();

      jQuery.each($("input[name='soal_img'")[0].files, function(i, file) {
        formdata.append('soal_img['+i+']', file);
      });
      formdata.append('soal_nm',soal_nm);
      formdata.append('kunci',kunci);
      formdata.append('no_soal',no_soal);
      formdata.append('group_id',group_id);
      formdata.append('materi',materi);
      formdata.append('soal_img_lama',soal_img_lama);
      formdata.append('soal_id',soal_id);

   
    $.ajax({
      url: "<?= base_url('soal/updatesoal') ?>",
      type: "post",
      data: formdata,
      contentType: false,
        processData: false,
      success: function(data) {
        $('#modal-lg').modal("hide");
        alert("Sukses");
        $("#example2").load(window.location.href+" #example2");
      },
      error: function() {
        alert("error");
      }
    });
  }

  function hapussoal(soal_id) {

      $.ajax({
        url: "<?= base_url('soal/hapussoal') ?>",
        type: "post",
        dataType: "json",
        data: {
          "soal_id": soal_id
        },
        success: function(data) {
          $('#modal-lg').modal("hide");
            alert("Sukses");
          $("#example2").load(window.location.href+" #example2");
        },
        error: function() {
          alert("error");
        }
      });
  }

  function showjawaban(soal_id) {
    var td_form = document.querySelectorAll(".td_form");
    if (td_form.length !== 0) {
        for (let i = 0; i < td_form.length; i++) {
          td_form[i].remove();
        }
    }
        $.ajax({
          url: "<?= base_url('soal/showjawaban') ?>",
          type: "post",
          dataType: "json",
          data: {
            "soal_id": soal_id
          },
          success: function(data) {
            $('#tr_data_'+soal_id).html(data);
          },
          error: function() {
            alert("error");
          }
        });
  }


function plusbtn(soal_id,jawaban_id) {
  var tr_form = document.getElementById("tr_form_"+soal_id+"_"+jawaban_id);
  var table   = document.getElementById("tb_jawaban"+soal_id);
  var table_len = (table.rows.length);
  var row = table.insertRow(table_len).outerHTML = "<tr class='tr_form' id='tr_form_"+soal_id+"_"+table_len+"'><td style='text-align:center;width:50px;'><button onclick='timesbtn("+soal_id+","+table_len+")' type='button' class='btn btn-outline-danger'><i class='fa fa-times'></i></button></td><td style='text-align:center;width:50px;'><input style='width:50px;text-align:center;' type='text' name='pilihan_nm[]' data-id='new'/> </td><td><input style='padding-left:10px;width:100%;' type='text' name='jawaban_nm[]'/></td></tr>";

}

function checkbtn(soal_id) {
      var formdata = new FormData();
      var pilihan_nm = [];
      var jawaban_nm = [];
      var jawaban_id = [];


      jQuery.each($("input[name='jawaban_img[]'")[0].files, function(i, file) {
        formdata.append('jawaban_img['+i+']', file);
      });

      $("input[name='jawaban_img[]'").each(function() {
        jawaban_id.push($(this).data("jawaban_id"));
      });

      // var jawaban_id = $("input[name='jawaban_img[]'").map(function() {
      //     return {
      //       jawaban_id: $(this).data("jawaban_id")
      //     };
      // }).get();


      var pilihan_nm = $("input[name='pilihan_nm[]'").map(function() {
            return {
                id: $(this).data("id"),
                value: $(this).val()
            };
        }).get();

      $("input[name='jawaban_nm[]'").each(function() {
        jawaban_nm.push($(this).val());
      });

      formdata.append('pilihan_nm',pilihan_nm);
      formdata.append('jawaban_nm',jawaban_nm);
      formdata.append('soal_id',soal_id);
      formdata.append('jawaban_id',jawaban_id);

      $.ajax({
          url: "<?= base_url('soal/simpanjawaban') ?>",
          type: "post",
          data: formdata,
          contentType: false,
          processData: false,
          
          success: function(data) {
            alert("Sukses");
            showjawaban(soal_id);
          },
          error: function() {
            alert("error");
          }
      });
}

function deletebtn(soal_id,jawaban_id) {
  let text = "Apakah anda yakin menghapus data ini ?";
  if (confirm(text) == true) {
    $.ajax({
          url: "<?= base_url('soal/deletejawaban') ?>",
          type: "post",
          dataType: "json",
          data: {
            "jawaban_id": jawaban_id
          },
          success: function(data) {
            if (data == "sukses") {
              alert("Sukses");
            } else {
              alert("Gagal");
            }
            document.getElementById("tr_form_"+soal_id+"_"+jawaban_id).outerHTML="";
            showjawaban(soal_id);
          },
          error: function() {
            alert("error");
          }
      });
  } else {

  }
  
}

function timesbtn(soal_id,jawaban_id) {
  document.getElementById("tr_form_"+soal_id+"_"+jawaban_id).outerHTML="";
}

function simpangambarjawaban(soal_id,jawaban_id) {

}
</script>
</body>
</html>