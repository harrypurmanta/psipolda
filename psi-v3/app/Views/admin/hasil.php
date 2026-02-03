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
            <h1>Data Hasil</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
              <li class="breadcrumb-item active">Hasil</li>
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
                        </div>
                    <!-- </div> -->
                </div>
              <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th style="text-align:center;">No.</th>
                    <th style="text-align:center;">Materi</th>
                    <th style="text-align:center;">Hasil</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                    $no = 1;
                            foreach ($group as $km) {
                        ?>
                  <tr>
                    <td class="text-center" width="30"><?= $no++; ?></td>
                    <td class="text-center"> <?= $km->group_nm ?> </td>
                    <td class="text-center"><button onclick="unduhexcel(<?= $km->group_soal_id ?>, <?= $km->materi_id ?>)" class="btn btn-primary"><i class="fa fa-eye"></i></button></td>
                  </tr>
                  <?php  } ?>
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
 function unduhexcel(group_id, materi_id) {
    let start_dttm = $("#start_dttm").val();
    let end_dttm = $("#end_dttm").val();
    if (group_id == 1) {
      window.location.href = "<?= base_url() ?>/admin/hasil/hasilexcel/"+start_dttm+"/"+end_dttm+"/"+group_id+"/"+materi_id
    } else if (group_id == 2) {
      window.location.href = "<?= base_url() ?>/admin/hasil/hasilexcel/"+start_dttm+"/"+end_dttm+"/"+group_id+"/"+materi_id
    } else if (group_id == 3){
      window.location.href = "<?= base_url() ?>/admin/hasil/userkreplin/"+start_dttm+"/"+end_dttm+"/"+group_id+"/"+materi_id
    } else if (group_id == 4){
      window.location.href = "<?= base_url() ?>/admin/hasil/userdass/"+start_dttm+"/"+end_dttm+"/"+group_id+"/"+materi_id
    } else if (group_id == 5){
      window.location.href = "<?= base_url() ?>/admin/hasil/usertiu5/"+start_dttm+"/"+end_dttm+"/"+group_id+"/"+materi_id
    } else if (group_id == 6){
      window.location.href = "<?= base_url() ?>/admin/hasil/hasilexcelpapi/"+start_dttm+"/"+end_dttm+"/"+group_id+"/"+materi_id
    } else if (group_id == 7){
      window.location.href = "<?= base_url() ?>/admin/hasil/hasilexcelmaterig/"+start_dttm+"/"+end_dttm+"/"+group_id+"/"+materi_id
    } else if (group_id == 8){
      window.location.href = "<?= base_url() ?>/admin/hasil/userdbi/"+start_dttm+"/"+end_dttm+"/"+group_id+"/"+materi_id
    } else if (group_id == 9){
      window.location.href = "<?= base_url() ?>/admin/hasil/userpauli/"+start_dttm+"/"+end_dttm+"/"+group_id+"/"+materi_id
    }
    
 }
</script>
</body>
</html>