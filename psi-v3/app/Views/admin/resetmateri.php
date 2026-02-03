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
              <button onclick="tambahuser()" class="btn btn-primary" data-toggle="modal" data-target="#modal-lg">Tambah</button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="table_materi" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th style="text-align:center;">No.</th>
                    <th style="text-align:center;">Materi</th>
                    <th style="text-align:center;">Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $request = \Config\Services::request();
                    $user_id = $request->uri->getSegment(4);
                    $no = 1;
                        foreach ($group as $key) {
                         
                    ?>
                  <tr>
                    <td style="text-align:center;"><?= $no++ ?></td>
                    <td><?= $key->group_nm ?></td>
                    <td style="text-align:center;"><button class="btn btn-primary" onclick="resetrespon(<?= $key->materi_id ?>,<?= $key->group_soal_id ?>, <?= $user_id ?>)">Reset</button></td>
                  </tr>
                    <?php
                        }
                    ?>
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
        <div class="d-none" id='loader-wrapper'>
            <div class="loader"></div>
        </div>
 

</div>
<!-- ./wrapper -->

<?= $this->include('admin/template/scriptjs') ?>
<script>
  $(function () {
    $('#table_materi').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": true,
    });
  });

  function resetrespon(materi_id, group_id, user_id) {
    Swal.fire({
      title: "Apakah anda yakin mereset data ini ?",
      // text: "Apakah anda yakin mereset data ini ?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Reset"
    }).then((result) => {
      if (result.isConfirmed) {
            $.ajax({
                url: "<?= base_url('admin/users/resetrespon') ?>",
                type: "post",
                dataType: "json",
                data: {
                "materi_id": materi_id,
                "group_id": group_id,
                "user_id": user_id
                },
                beforeSend: function() {
                    $("#loader-wrapper").removeClass("d-none")
                },
                success: function(data) {
                    if (data == true) {
                          Swal.fire({
                            title: "Reset berhasil",
                            text: "Jawaban peserta ini sudah di reset",
                            icon: "success"
                          });
                    } else {
                        Swal.fire("Reset gagal", "", "warning");
                    }
                    $("#loader-wrapper").addClass("d-none");
                },
                error: function() {
                  Swal.fire("Ada terjadi sesuatu, mohon hubungi administrator", "", "warning");
                }
            });
      }
    });
  }
</script>
</body>
</html>