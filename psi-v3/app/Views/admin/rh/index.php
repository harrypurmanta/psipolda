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
                            <h1>Data Riwayat Hidup</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                                <li class="breadcrumb-item active">Riwayat Hidup</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="box">
                                        <div class="box-body">
                                            <form class="form-horizontal">
                                                <div class="form-group row">
                                                    <label for="tanggal_tes" class="col-sm-2 control-label">Tanggal Tes</label>
                                                    <div class="col-sm-3">
                                                        <input type="date" class="form-control" id="tanggal_tes" name="tanggal_tes" autocomplete="off" value="<?= date('Y-m-d') ?>"> 
                                                    </div>
                                                    <div>
                                                        <button onclick="loadDataPerson()" type="button" class="btn btn-sm btn-primary">Tampilkan</button>
                                                    </div>
                                                </div>
                                                
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table id="table_person" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th style="text-align:center;" width="20px;">No.</th>
                                                <th class="text-center">Nama</th>
                                                <th style="text-align:center;">Satuan</th>
                                                <th style="text-align:center;">NRP</th>
                                                <th style="text-align:center;">Aksi</th>
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


    <!-- jQuery -->
    <?= $this->include('admin/template/scriptjs') ?>
    <!-- Page specific script -->
    <script>
    $(document).ready(function(){
        loadDataPerson();
    });

    loadDataPerson = () => {
        var tanggal = $("#tanggal_tes").val();
            $("#table_person").DataTable({
                ajax: {
                    url: "/admin/rh/getDataPersonRh",
                    type: "POST",
                    data: function(d) {
                        d.tanggal = tanggal
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
                pageLength: 20,
                columns: [{
                        data: "nomor",
                        className: "text-center",
                        createdCell: function(td, cellData, rowData, row, col) {
                            $(td).css("vertical-align", "center")
                        }
                    },
                    {
                        data: "person_nm",
                        className: "text-left"
                    },
                    {
                        data: "satuan_nm",
                        className: "text-center"
                    },
                    {
                        data: "nrp",
                        className: "text-center"
                    },
                    {
                        data: null,
                        className: "text-center",
                        render: function(data) {
                            return `<a class="btn btn-primary btn-sm" href="<?= base_url() ?>/admin/rh/hasilpdfrh/${data.person_id}/${data.user_id}/${tanggal}" target="_blank">Download</a>`;
                        }
                    }
                ]
            })
        }
    </script>
</body>

</html>