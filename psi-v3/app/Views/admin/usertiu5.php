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
            <h1>Data Users</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
              <li class="breadcrumb-item active">Users</li>
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
                    <!-- <div class="row"> -->
                        <div class="row col-md-12" style="align-items: center;">
                            <div class="col-md-3">
                                <div class="form-group">
                                  <label for="start_dttm">Tanggal Awal</label>
                                  <input class="form-control" type="date" name="start_dttm" id="start_dttm" value="<?= date("Y-m-d") ?>">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                  <label for="end_dttm">Tanggal Akhir</label>
                                  <input class="form-control" type="date" name="end_dttm" id="end_dttm" value="<?= date("Y-m-d") ?>">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                  <label for="end_dttm">Tipe Soal</label>
                                  <select class="form-control" name="tipesoal" id="tipesoal">
                                    <option value="1">Tipe 1</option>
                                    <option value="2">Tipe 2</option>
                                    <option value="3">Tipe 3</option>
                                  </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                  <button type="button" onclick="loadDataUserTiu5()" class="btn btn-primary">Tampilkan</button>
                                </div>
                            </div>
                        </div>
                    <!-- </div> -->
                </div>
              <div class="card-body">
                <table id="table_userdass" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th style="text-align:center;">No.</th>
                    <th style="text-align:center;">Nama</th>
                    <th style="text-align:center;">Satuan</th>
                    <th style="text-align:center;">TTL</th>
                    <th style="text-align:center;">Jenis Kelamin</th>
                    <th style="text-align:center;">No. Hp</th>
                    <th style="text-align:center;">Action</th>
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
  $(function () {
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": true,
    });
  });

  loadDataUserTiu5 = () => {
    let start_date = $("#start_dttm").val();
    let end_date = $("#end_dttm").val();
    let tipesoal = $("#tipesoal").val();
            $("#table_userdass").DataTable({
                ajax: {
                    url: "/admin/hasil/getUserTiu5",
                    type: "POST",
                    data: function(d) {
                        d.start_date = start_date,
                        d.end_date = end_date,
                        d.tipesoal = tipesoal
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
                columns: [{
                        data: "nomor",
                        className: "center",
                        createdCell: function(td, cellData, rowData, row, col) {
                            $(td).css("vertical-align", "center")
                        }
                    },
                    {
                        data: "person_nm",
                        className: "left"
                    },
                    {
                        data: "satuan_nm",
                        className: "left"
                    },
                    {
                        data: "birth_dttm",
                        className: "center"
                    },
                    {
                        data: null,
                        className: "text-center",
                        render: function(data) {
                          if (data.gender_cd == "m") {
                            return `Laki-laki`;
                          } else {
                            return `Perempuan`;
                          }
                        }
                    },
                    {
                        data: "cellphone",
                        className: "center"
                    },
                    {
                        data: null,
                        className: "text-center",
                        render: function(data) {
                          return `<button class="btn btn-primary btn-sm" type="button" onclick="lihathasiltiu5(${data.user_id}, ${tipesoal})">Lihat Hasil</button>
                          <button class="btn btn-primary btn-sm" type="button" onclick="unduhtiu5(${data.user_id}, ${tipesoal})"><i class="fa fa-download"> PDF</i></button>`
                        }
                    }
                ]
            })
        }

        function lihathasiltiu5(user_id, tipesoal) {
          let start_date = $("#start_dttm").val();
          let end_date = $("#end_dttm").val();
          window.open("<?= base_url() ?>/admin/hasil/hasiltiu5/"+start_dttm.value+"/"+end_dttm.value+"/"+user_id+"/"+tipesoal,'_blank');
        }
        function unduhtiu5(user_id, tipesoal) {
          window.open("<?= base_url() ?>/admin/hasil/hasiltiu5pdf/"+user_id+"/"+tipesoal,'_blank');
        }
</script>
</body>
</html>