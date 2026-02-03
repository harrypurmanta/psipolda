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
                                  <label for="satuan">Satuan</label>
                                  <select class="form-control select2" name="satuan" id="satuan">
                                      <option value="semua">Pilih Satuan (Semua)</option>
                                    <?php 
                                        foreach ($satuan as $key) {
                                    ?>
                                      <option value="<?= $key->satuan_id ?>"><?= $key->satuan_nm ?></option>
                                    <?php } ?>
                                  </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                  <button type="button" onclick="loadDataUserKreplin()" class="btn btn-primary">Tampilkan</button>
                                </div>
                            </div>
                        </div>
                    <!-- </div> -->
                </div>
              <div class="card-body">
                <table id="table_userkreplin" class="table table-bordered table-hover">
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
<?= $this->include('admin/template/scriptjs') ?>
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

  loadDataUserKreplin = () => {
    let start_date = $("#start_dttm").val();
    let end_date = $("#end_dttm").val();
    let satuan = $("#satuan").val();
            $("#table_userkreplin").DataTable({
                ajax: {
                    url: "/admin/hasil/getUserKreplin",
                    type: "POST",
                    data: function(d) {
                        d.start_date = start_date,
                        d.end_date = end_date,
                        d.satuan = satuan
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
                        data: null,
                        className: "text-center",
                        render: function(data) {
                          var ttl = data.birth_place+', '+ bulanIndo(data.birth_dttm);
                          return ttl;
                        }
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
                        className: "center",
                        render: function(data) {
                          return `<button class="btn btn-primary btn-sm" type="button" onclick="lihathasilkreplin(${data.user_id})">Lihat Hasil</button>`
                        }
                    }
                ]
            })
        }

        function lihathasilkreplin(user_id) {
          let start_date = $("#start_dttm").val();
          let end_date = $("#end_dttm").val();
          
          window.open("<?= base_url() ?>/admin/hasil/hasilkreplin/"+start_dttm.value+"/"+end_dttm.value+"/"+user_id,'_blank');
        }

        function unduhkreplin(user_id) {
          window.open("<?= base_url() ?>/admin/hasil/hasilkreplinpdf/"+start_dttm.value+"/"+end_dttm.value+"/"+user_id,'_blank');
        }
</script>
</body>
</html>