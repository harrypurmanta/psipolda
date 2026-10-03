<?php 
  $this->session = \Config\Services::session();
?>
<?= $this->include('admin/template/head') ?>

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
            <h1>Soal Sikap Kerja Materi</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url() ?>/admin">Home</a></li>
              <li class="breadcrumb-item active">Soal Sikap Kerja Materi</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                      <form class="form-horizontal">
                        <div class="card-body">
                          <div class="form-group row">
                            <label for="materi_id" class="col-sm-2 col-form-label">Materi</label>
                            <div class="col-sm-10">
                              <select name="materi_id" id="materi_id" class="form-control">
                                  <?php foreach ($materi as $key) { ?>
                                  <option value="<?= $key->materi_id ?>" selected>
                                      <?= $key->materi_nm ?> (Materi N - Group 14)
                                  </option>
                                  <?php } ?>
                              </select>
                            </div>
                          </div>
                          <div class="form-group row">
                            <div class="offset-sm-2 col-sm-10 d-flex justify-content-end">
                              <div class="form-check">
                                <button type="button" class="btn btn-sm btn-primary" onclick="tampilkansoal()"><i class="fas fa-search mr-1"></i> Tampilkan</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  <table id="tbl_soal" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th width="50" style="text-align: center;">No.</th>
                        <th style="text-align: center;">Kolom Soal</th>
                        <th style="text-align: center;">Petunjuk</th>
                        <th style="text-align: center;" width="140">Aksi</th>
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
    <div class="d-none" id='loader-wrapper'>
        <div class="loader"></div>
    </div>
</div>
  
</div>
<!-- ./wrapper -->
<?= $this->include('admin/template/scriptjs') ?>
<!-- Page specific script -->
<script>
  $(function () {
    tampilkansoal();
  });

  tampilkansoal = () => {
    var materi_id = $("#materi_id").val() || 21;
    $("#tbl_soal").DataTable({
        ajax: {
            url: "<?= base_url() ?>/admin/soalsikapkerjamateri/showkolom",
            type: "POST",
            data: function(d) {
                d.materi_id = materi_id;
            },
            dataSrc: function(json) {
                let nomor = 1;
                json.forEach((row, idx) => {
                    if (idx > 0) {
                        nomor++;
                    }
                    row.nomor = nomor;
                });

                return json;
            }
        },
        bDestroy: true,
        pageLength: 20,
        columns: [
            {
                data: "nomor",
                className: "text-center",
                createdCell: function(td, cellData, rowData, row, col) {
                    $(td).css("vertical-align", "middle");
                }
            },
            {
                data: "kolom_nm",
                className: "text-left",
                createdCell: function(td, cellData, rowData, row, col) {
                    $(td).css("vertical-align", "middle");
                }
            },
            {
                data: "clue",
                className: "text-center",
                createdCell: function(td, cellData, rowData, row, col) {
                    $(td).css("vertical-align", "middle");
                },
                render: function(data) {
                    if (!data) {
                        return '<span class="badge badge-secondary">Belum ada clue</span>';
                    }
                    if (data.indexOf('|') !== -1) {
                        return '<span class="badge badge-info"><i class="fas fa-image mr-1"></i> Soal Gambar (5 Gambar)</span>';
                    }
                    return '<span class="badge badge-primary font-weight-bold" style="font-size: 15px; letter-spacing: 2px;">' + data + '</span>';
                }
            },
            {
                data: null,
                className: "text-center",
                createdCell: function(td, cellData, rowData, row, col) {
                    $(td).css("vertical-align", "middle");
                },
                render: function(data) {
                  if (data.clue == null) {
                    return `
                        <a href="<?= base_url() ?>/admin/soalsikapkerjamateri/tambahsoalSkMateri/${data.kolom_id}/14/21/0" type="button" class="btn btn-sm btn-success" title="Tambah Soal"><i class="fas fa-plus"></i> Tambah</a>`;
                  }

                  if (data.kolom_id != null) {
                    return `
                        <a href="<?= base_url() ?>/admin/soalsikapkerjamateri/detailsoal/${data.kolom_id}/14/21/0" type="button" class="btn btn-sm btn-primary" title="Lihat Detail"><i class="fas fa-eye"></i></a>
                        <a href="<?= base_url() ?>/admin/soalsikapkerjamateri/viewEditsoalSkMateri/${data.kolom_id}/14/21/0" type="button" class="btn btn-sm btn-warning" title="Edit Soal"><i class="fas fa-edit"></i></a>`;
                  }
                  return '';
                }
            }
        ]
    });
}
</script>
</body>
</html>
