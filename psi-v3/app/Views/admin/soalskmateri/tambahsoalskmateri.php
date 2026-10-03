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
            <h1>Tambah Soal Sikap Kerja (Materi N)</h1>
          </div> 
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url() ?>/admin">Home</a></li>
              <li class="breadcrumb-item"><a href="<?= base_url() ?>/admin/soalsikapkerjamateri">SK Materi</a></li>
              <li class="breadcrumb-item active">Tambah Soal</li>
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
                            <div class="row align-items-center">
                                <div class="col-2">
                                    <div class="form-group mb-0 ml-3">
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="typesoal" value="text" checked onclick="changeTypeSoal('text')">
                                                Teks
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="typesoal" value="gambar" onclick="changeTypeSoal('gambar')">
                                                Gambar
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-8 text-center">
                                    <div id="dv_text">
                                        <input type="hidden" id="jawaban_nm_lama" name="jawaban_nm_lama"
                                        value="<?= empty($jawaban[0]->jawaban_nm) ? '' : $jawaban[0]->jawaban_nm ?>">

                                        <h3 class="mb-0">
                                            <b><?= !empty($kolom[0]->kolom_nm) ? $kolom[0]->kolom_nm : 'Kolom ' . $kolom_id ?></b> |
                                            <input type="text" name="jawaban_nm" id="jawaban_nm"
                                                value="<?= empty($jawaban[0]->jawaban_nm) ? '' : $jawaban[0]->jawaban_nm ?>"
                                                <?= empty($jawaban[0]->jawaban_nm) ? '' : 'disabled' ?>
                                                style="width: 120px; text-align: center; font-weight: bold; text-transform: uppercase; letter-spacing: 2px;"
                                                maxlength="5"
                                                placeholder="5 Karakter"
                                                autocomplete="off"
                                                oninput="this.value = this.value.toUpperCase();">

                                            <?php if (!empty($jawaban[0]->jawaban_nm)) { ?>
                                            <button onclick="editclue()" type="button"
                                                class="btn btn-sm btn-warning" id="btn_edit">
                                                <i class="fa fa-edit"></i> Edit Clue
                                            </button>
                                            <?php } ?>

                                            <button onclick="simpanclue(<?= $kolom_id ?>, <?= $sk_group_id ?>)"
                                                type="button"
                                                class="btn btn-sm btn-success <?= empty($jawaban[0]->jawaban_nm) ? '' : 'd-none' ?>" id="btn_simpan">
                                                <i class="fa fa-save"></i> Generate Soal
                                            </button>
                                        </h3>
                                    </div>
                                    <div id="dv_gambar" class="col-12 border p-2 d-none">
                                        <div class="row text-center g-2">
                                            <!-- ITEM 1 -->
                                            <div class="col">
                                                <img id="preview1" src="" class="img-preview mb-1" style="max-height: 50px;">
                                                <input type="file" name="gambarsk1" class="form-control form-control-sm" accept="image/*">
                                                <div class="fw-bold mt-1">A</div>
                                            </div>
                                            <!-- ITEM 2 -->
                                            <div class="col">
                                                <img id="preview2" src="" class="img-preview mb-1" style="max-height: 50px;">
                                                <input type="file" name="gambarsk2" class="form-control form-control-sm" accept="image/*">
                                                <div class="fw-bold mt-1">B</div>
                                            </div>
                                            <!-- ITEM 3 -->
                                            <div class="col">
                                                <img id="preview3" src="" class="img-preview mb-1" style="max-height: 50px;">
                                                <input type="file" name="gambarsk3" class="form-control form-control-sm" accept="image/*">
                                                <div class="fw-bold mt-1">C</div>
                                            </div>
                                            <!-- ITEM 4 -->
                                            <div class="col">
                                                <img id="preview4" src="" class="img-preview mb-1" style="max-height: 50px;">
                                                <input type="file" name="gambarsk4" class="form-control form-control-sm" accept="image/*">
                                                <div class="fw-bold mt-1">D</div>
                                            </div>
                                            <!-- ITEM 5 -->
                                            <div class="col">
                                                <img id="preview5" src="" class="img-preview mb-1" style="max-height: 50px;">
                                                <input type="file" name="gambarsk5" class="form-control form-control-sm" accept="image/*">
                                                <div class="fw-bold mt-1">E</div>
                                            </div>
                                            <div class="col-12 mt-2">
                                                <button onclick="simpanImage()" type="button" class="btn btn-sm btn-success" id="btn_simpan_img">
                                                    <i class="fa fa-save"></i> Generate Soal Gambar
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2 text-right">
                                    <a href="<?= base_url() ?>/admin/soalsikapkerjamateri" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body" id="dv_body">
                            <?php if (empty($bagian1)) { ?>
                                <div class="alert alert-info text-center">
                                    <h5><i class="icon fas fa-info"></i> Petunjuk Belum Dibuat</h5>
                                    Masukkan 5 karakter huruf/angka unik pada kotak di atas, lalu klik <b>Generate Soal</b> untuk membuat 50 soal secara otomatis.
                                </div>
                            <?php } else { ?>
                            <div class="row">
                                <div class="col-md-3">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center;" width="80">No.</th>
                                                <th style="text-align: center;">Soal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($bagian1 as $key1) { ?>
                                            <tr>
                                                <td style="text-align: center; vertical-align: middle;"><?= $key1->no_soal ?></td>
                                                <td style="text-align: center;">
                                                    <div style="display: flex; align-items: center; justify-content: center;">
                                                        <input onblur="updatesoalsk(<?= $key1->soal_id ?>)" style="text-align: center; width: 120px; font-weight: bold; letter-spacing: 2px;" type="text" value="<?= $key1->soal_nm ?>" id="soal_nm_<?= $key1->soal_id ?>" name="soal_nm_<?= $key1->soal_id ?>" maxlength="4" autocomplete="off" oninput="this.value = this.value.toUpperCase();">
                                                        <i class="fa fa-check" id="icon_<?= $key1->soal_id ?>" style="display:none; margin-left:6px; color: #54d654; font-size:18px;"></i>
                                                        <i class="fa fa-times-circle" id="icon_gagal_<?= $key1->soal_id ?>" style="display:none; margin-left:6px; color: #e33434; font-size:18px;"></i>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-3">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center;" width="80">No.</th>
                                                <th style="text-align: center;">Soal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($bagian2 as $key2) { ?>
                                            <tr>
                                                <td style="text-align: center; vertical-align: middle;"><?= $key2->no_soal ?></td>
                                                <td style="text-align: center;">
                                                    <div style="display: flex; align-items: center; justify-content: center;">
                                                        <input onblur="updatesoalsk(<?= $key2->soal_id ?>)" style="text-align: center; width: 120px; font-weight: bold; letter-spacing: 2px;" type="text" value="<?= $key2->soal_nm ?>" id="soal_nm_<?= $key2->soal_id ?>" name="soal_nm_<?= $key2->soal_id ?>" maxlength="4" autocomplete="off" oninput="this.value = this.value.toUpperCase();">
                                                        <i class="fa fa-check" id="icon_<?= $key2->soal_id ?>" style="display:none; margin-left:6px; color: #54d654; font-size:18px;"></i>
                                                        <i class="fa fa-times-circle" id="icon_gagal_<?= $key2->soal_id ?>" style="display:none; margin-left:6px; color: #e33434; font-size:18px;"></i>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-3">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center;" width="80">No.</th>
                                                <th style="text-align: center;">Soal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($bagian3 as $key3) { ?>
                                            <tr>
                                                <td style="text-align: center; vertical-align: middle;"><?= $key3->no_soal ?></td>
                                                <td style="text-align: center;">
                                                    <div style="display: flex; align-items: center; justify-content: center;">
                                                        <input onblur="updatesoalsk(<?= $key3->soal_id ?>)" style="text-align: center; width: 120px; font-weight: bold; letter-spacing: 2px;" type="text" value="<?= $key3->soal_nm ?>" id="soal_nm_<?= $key3->soal_id ?>" name="soal_nm_<?= $key3->soal_id ?>" maxlength="4" autocomplete="off" oninput="this.value = this.value.toUpperCase();">
                                                        <i class="fa fa-check" id="icon_<?= $key3->soal_id ?>" style="display:none; margin-left:6px; color: #54d654; font-size:18px;"></i>
                                                        <i class="fa fa-times-circle" id="icon_gagal_<?= $key3->soal_id ?>" style="display:none; margin-left:6px; color: #e33434; font-size:18px;"></i>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-3">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center;" width="80">No.</th>
                                                <th style="text-align: center;">Soal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($bagian4 as $key4) { ?>
                                            <tr>
                                                <td style="text-align: center; vertical-align: middle;"><?= $key4->no_soal ?></td>
                                                <td style="text-align: center;">
                                                    <div style="display: flex; align-items: center; justify-content: center;">
                                                        <input onblur="updatesoalsk(<?= $key4->soal_id ?>)" style="text-align: center; width: 120px; font-weight: bold; letter-spacing: 2px;" type="text" value="<?= $key4->soal_nm ?>" id="soal_nm_<?= $key4->soal_id ?>" name="soal_nm_<?= $key4->soal_id ?>" maxlength="4" autocomplete="off" oninput="this.value = this.value.toUpperCase();">
                                                        <i class="fa fa-check" id="icon_<?= $key4->soal_id ?>" style="display:none; margin-left:6px; color: #54d654; font-size:18px;"></i>
                                                        <i class="fa fa-times-circle" id="icon_gagal_<?= $key4->soal_id ?>" style="display:none; margin-left:6px; color: #e33434; font-size:18px;"></i>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <?php } ?>
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
    function changeTypeSoal(type) {
        if (type == 'text') {
            $("#dv_text").removeClass("d-none"); 
            $("#dv_gambar").addClass("d-none");
        } else if (type == 'gambar') {
            $("#dv_gambar").removeClass("d-none"); 
            $("#dv_text").addClass("d-none");
        }
    }

    function editclue() {
        $("#jawaban_nm").prop("disabled", false).focus();   
        $("#btn_simpan").removeClass("d-none"); 
        $("#btn_edit").addClass("d-none"); 
    }

    function simpanclue(kolom_id, sk_group_id) {
        var jawaban_nm = $("#jawaban_nm").val().trim().toUpperCase();
        var jawaban_nm_lama = $("#jawaban_nm_lama").val().trim().toUpperCase();
        var materi_id = <?= $materi_id ?>;

        if (jawaban_nm.length < 5) {
            Swal.fire("Peringatan", "Jumlah karakter pada clue harus tepat 5 karakter", "warning");
            document.getElementById("jawaban_nm").focus();
            return;
        } 

        for (var i = 0; i < jawaban_nm.length; i++) {
            for (var j = i + 1; j < jawaban_nm.length; j++) {
                if (jawaban_nm[i] == jawaban_nm[j]) {
                    Swal.fire("Peringatan", "Karakter tidak boleh ada yang sama!", "warning");
                    return;
                }
            }
        }

        $.ajax({
            url: "<?= base_url('admin/soalsikapkerjamateri/updateclue') ?>",
            type: "post",
            dataType: "json",
            data: {
                "kolom_id": kolom_id,
                "jawaban_nm": jawaban_nm,
                "jawaban_nm_lama": jawaban_nm_lama,
                "materi_id": materi_id,
                "sk_group_id": sk_group_id
            },
            beforeSend: function() {
                $("#loader-wrapper").removeClass("d-none");
            },
            success: function(data) {
                $("#loader-wrapper").addClass("d-none");
                if (data === "finish" || data.status === true || (data && data.message === "finish")) {
                    Swal.fire({
                        title: "Soal berhasil disimpan!",
                        icon: "success",
                        confirmButtonText: "OK"
                    }).then((result) => {
                        location.reload();
                    });
                } else {
                    Swal.fire("Gagal", "Gagal menyimpan soal: " + ((data && data.message) ? data.message : data), "error");
                }
            },
            error: function(xhr, status, error) {
                $("#loader-wrapper").addClass("d-none");
                if (xhr.responseText && xhr.responseText.trim().indexOf("finish") !== -1) {
                    Swal.fire({
                        title: "Soal berhasil disimpan!",
                        icon: "success",
                        confirmButtonText: "OK"
                    }).then((result) => {
                        location.reload();
                    });
                    return;
                }
                Swal.fire("Error", "Terjadi kesalahan saat memproses data", "error");
            }
        });
    }

    function simpanImage() {
        var formData = new FormData();
        var kolom_id = <?= $kolom_id ?>;
        var sk_group_id = <?= $sk_group_id ?>;
        var materi_id = <?= $materi_id ?>;
        var jawaban_lama = $("#jawaban_nm_lama").val();

        for (var i = 1; i <= 5; i++) {
            var files = $("input[name='gambarsk" + i + "']")[0].files;
            if (files.length > 0) {
                formData.append('gambarsk' + i, files[0]);
            }
        }

        formData.append('kolom_id', kolom_id);
        formData.append('sk_group_id', sk_group_id);
        formData.append('materi_id', materi_id);
        formData.append('jawaban_lama', jawaban_lama);
        formData.append('typeSoal', 'gambar');

        $.ajax({
            url: "<?= base_url('admin/soalsikapkerjamateri/updateGambarSk') ?>",
            type: "post",
            dataType: "json",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            beforeSend: function() {
                $("#loader-wrapper").removeClass("d-none");
            },
            success: function(data) {
                $("#loader-wrapper").addClass("d-none");
                if (data === "finish" || data.status === true || (data && data.message === "finish")) {
                    Swal.fire({
                        title: "Soal gambar berhasil disimpan!",
                        icon: "success",
                        confirmButtonText: "OK"
                    }).then((result) => {
                        location.reload();
                    });
                } else {
                    Swal.fire("Info", (data && data.message) ? data.message : "Gagal memproses gambar", "info");
                }
            },
            error: function(xhr, status, error) {
                $("#loader-wrapper").addClass("d-none");
                if (xhr.responseText && xhr.responseText.trim().indexOf("finish") !== -1) {
                    Swal.fire({
                        title: "Soal gambar berhasil disimpan!",
                        icon: "success",
                        confirmButtonText: "OK"
                    }).then((result) => {
                        location.reload();
                    });
                    return;
                }
                Swal.fire("Error", "Gagal upload gambar: " + (xhr.responseText || error), "error");
            }
        });
    }

    function updatesoalsk(soal_id) {
        let soal_nm = $("#soal_nm_" + soal_id).val().trim().toUpperCase();
        let icon = $("#icon_" + soal_id);
        let icongagal = $("#icon_gagal_" + soal_id);
        var jawaban_nm = <?= json_encode(empty($jawaban[0]->jawaban_nm) ? '' : $jawaban[0]->jawaban_nm) ?>;
        let invalidChars = [];

        if (soal_nm.length !== 4) {
            Swal.fire("Peringatan", "Panjang soal harus 4 karakter!", "warning");
            icongagal.fadeIn(100);
            setTimeout(function() { icongagal.fadeOut(400); }, 2000);
            return;
        }

        for (var i = 0; i < soal_nm.length; i++) {
            for (var j = i + 1; j < soal_nm.length; j++) {
                if (soal_nm[i] == soal_nm[j]) {
                    Swal.fire("Peringatan", "Karakter tidak boleh sama!", "warning");
                    icongagal.fadeIn(100);
                    setTimeout(function() { icongagal.fadeOut(400); }, 2000);
                    return;
                }
            }
        }

        if (jawaban_nm && jawaban_nm.indexOf('|') === -1) {
            for (let char of soal_nm) {
                if (!jawaban_nm.includes(char)) {
                    invalidChars.push(char);
                }
            }

            if (invalidChars.length > 0) {
                Swal.fire("Peringatan", "Karakter " + invalidChars.join(", ") + " tidak ada di clue: " + jawaban_nm, "warning");
                icongagal.fadeIn(100);
                setTimeout(function() { icongagal.fadeOut(400); }, 2000);
                return;
            }
        }

        $.ajax({
            url: "<?= base_url('admin/soalsikapkerjamateri/updatesoalskmateri') ?>",
            type: "post",
            dataType: "json",
            data: { "soal_id": soal_id, "soal_nm": soal_nm },
            success: function(data) {
                if (data === "berhasil" || data.status === true || (data && data.message === "berhasil")) {
                    icon.fadeIn(100);
                    setTimeout(function() { icon.fadeOut(300); }, 2000);
                } else {
                    icongagal.fadeIn(100);
                    setTimeout(function() { icongagal.fadeOut(400); }, 2000);
                }
            },
            error: function(xhr) {
                if (xhr.responseText && xhr.responseText.trim().indexOf("berhasil") !== -1) {
                    icon.fadeIn(100);
                    setTimeout(function() { icon.fadeOut(300); }, 2000);
                    return;
                }
                icongagal.fadeIn(100);
                setTimeout(function() { icongagal.fadeOut(400); }, 2000);
            }
        });
    }
</script>
</body>
</html>
