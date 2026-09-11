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
            <h1>Data Users - Sikap Kerja</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
              <li class="breadcrumb-item"><a href="<?= base_url('admin/hasil') ?>">Hasil</a></li>
              <li class="breadcrumb-item active">Users Sikap Kerja</li>
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
                <div class="row col-md-12" style="align-items: center;">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="start_dttm">Tanggal Awal</label>
                      <input class="form-control" type="date" name="start_dttm" id="start_dttm" value="<?= !empty($start_dttm) ? $start_dttm : date("Y-m-d") ?>">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="end_dttm">Tanggal Akhir</label>
                      <input class="form-control" type="date" name="end_dttm" id="end_dttm" value="<?= !empty($end_dttm) ? $end_dttm : date("Y-m-d") ?>">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="materi_id">Materi</label>
                      <select class="form-control" name="materi_id" id="materi_id">
                        <option value="semua">-- Semua Materi --</option>
                        <?php if (!empty($materi)) { ?>
                          <?php foreach ($materi as $m) { ?>
                            <option value="<?= $m->materi_id ?>" <?= (isset($materi_id) && $materi_id == $m->materi_id) ? 'selected' : '' ?>>
                              <?= $m->materi_nm ?>
                            </option>
                          <?php } ?>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group" style="margin-top: 30px;">
                      <button type="button" onclick="loadDataUserSikapKerja()" class="btn btn-primary">
                        <i class="fa fa-search"></i> Tampilkan
                      </button>
                      <button type="button" onclick="cetakPdfSemua()" class="btn btn-danger ml-1">
                        <i class="fa fa-file-pdf"></i> Cetak Semua (PDF)
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <table id="table_usersikapkerja" class="table table-bordered table-hover table-striped">
                  <thead>
                    <tr>
                      <th style="text-align:center; width: 40px;">No.</th>
                      <th style="text-align:center; width: 80px;">No. Tes</th>
                      <th style="text-align:center;">Nama</th>
                      <th style="text-align:center;">Satuan</th>
                      <th style="text-align:center;">Materi</th>
                      <th style="text-align:center;">TTL</th>
                      <th style="text-align:center;">Jenis Kelamin</th>
                      <th style="text-align:center;">No. Hp</th>
                      <th style="text-align:center; width: 170px;">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

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
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <strong>Copyright &copy; 2024.</strong> All rights reserved.
  </footer>
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
<!-- AdminLTE App -->
<script src="<?= base_url() ?>/dist/dist/js/adminlte.min.js"></script>

<!-- Page specific script -->
<script>
  $(document).ready(function () {
    loadDataUserSikapKerja();
  });

  loadDataUserSikapKerja = () => {
    let start_date = $("#start_dttm").val();
    let end_date = $("#end_dttm").val();
    let materi_id = $("#materi_id").val();

    if ($.fn.DataTable.isDataTable('#table_usersikapkerja')) {
      $('#table_usersikapkerja').DataTable().destroy();
    }

    $("#table_usersikapkerja").DataTable({
      processing: true,
      ajax: {
        url: "<?= base_url('admin/hasil/getUserSikapKerja') ?>",
        type: "POST",
        data: {
          start_date: start_date,
          end_date: end_date,
          materi_id: materi_id
        },
        dataSrc: function(json) {
          if (!Array.isArray(json)) {
            return [];
          }
          let nomor = 1;
          json.forEach((row) => {
            row.nomor = nomor++;
          });
          return json;
        },
        error: function(xhr, status, error) {
          console.error("AJAX Error:", error, xhr.responseText);
        }
      },
      pageLength: 100,
      columns: [
        {
          data: "nomor",
          className: "text-center",
          defaultContent: "-"
        },
        {
          data: "no_tes",
          className: "text-center",
          defaultContent: "-",
          render: function(data) {
            return data ? `<b>${data}</b>` : "-";
          }
        },
        {
          data: "person_nm",
          className: "text-left",
          defaultContent: "-"
        },
        {
          data: "satuan_nm",
          className: "text-left",
          defaultContent: "-",
          render: function(data) {
            return data ? data : "-";
          }
        },
        {
          data: "materi_nm",
          className: "text-center",
          defaultContent: "-",
          render: function(data, type, row) {
            let nm = data ? data : (row.materi ? "Materi " + row.materi : "-");
            return `<span class="badge badge-info">${nm}</span>`;
          }
        },
        {
          data: "birth_dttm",
          className: "text-center",
          defaultContent: "-",
          render: function(data, type, row) {
            let ttl = "";
            if (row.birth_place) {
              ttl += row.birth_place + ", ";
            }
            if (data) {
              ttl += data;
            }
            return ttl ? ttl : "-";
          }
        },
        {
          data: null,
          className: "text-center",
          render: function(data) {
            if (data && (data.gender_cd == "m" || data.gender_cd == "M")) {
              return "Laki-laki";
            } else if (data && (data.gender_cd == "f" || data.gender_cd == "F")) {
              return "Perempuan";
            }
            return "-";
          }
        },
        {
          data: "cellphone",
          className: "text-center",
          defaultContent: "-",
          render: function(data) {
            return data ? data : "-";
          }
        },
        {
          data: null,
          className: "text-center",
          render: function(data) {
            let rowMateri = data.materi ? data.materi : ($("#materi_id").val() !== "semua" ? $("#materi_id").val() : "");
            return `<button class="btn btn-primary btn-sm" type="button" onclick="lihathasilsikapkerja(${data.user_id}, '${rowMateri}')" title="Lihat Hasil">
                      <i class="fa fa-eye"></i> Lihat
                    </button>
                    <button class="btn btn-danger btn-sm" type="button" onclick="cetakPdfUser(${data.user_id}, '${rowMateri}')" title="Cetak PDF">
                      <i class="fa fa-file-pdf"></i> PDF
                    </button>`;
          }
        }
      ]
    });
  }

  function lihathasilsikapkerja(user_id, materi_id) {
    let start_date = $("#start_dttm").val();
    let end_date = $("#end_dttm").val();
    window.open("<?= base_url() ?>/admin/hasil/hasilsikapkerja/" + start_date + "/" + end_date + "/" + user_id + "/" + materi_id, '_blank');
  }

  function cetakPdfUser(user_id, materi_id) {
    let start_date = $("#start_dttm").val();
    let end_date = $("#end_dttm").val();
    window.open("<?= base_url() ?>/admin/hasil/hasilsikapkerjapdf/" + start_date + "/" + end_date + "/" + user_id + "/" + materi_id, '_blank');
  }

  function cetakPdfSemua() {
    let start_date = $("#start_dttm").val();
    let end_date = $("#end_dttm").val();
    let materi_id = $("#materi_id").val();
    window.open("<?= base_url() ?>/admin/hasil/hasilsikapkerjasemuapdf/" + start_date + "/" + end_date + "/13/" + materi_id, '_blank');
  }
</script>
</body>
</html>
