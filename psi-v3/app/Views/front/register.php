<?= $this->include('front/include/header') ?>
<body class="hold-transition register-page">
<div class="wrapper mt-5">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="login/register" class="h3"><b>Daftar member baru</b></a>
    </div>
    <div class="card-body">
          <form id="formRegister">
            <div class="row col-md-12">
                <div class="col-md-6">
                  <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Nama lengkap" id="person_nm" name="person_nm" required autocomplete="off"/>
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-user"></span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Pangkat" id="pangkat" name="pangkat" required autocomplete="off"/>
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-ticket-alt"></span>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
            <div class="row col-md-12">
                <div class="col-md-6">
                  <div class="form-group mb-3">
                    <select name="satuan" id="satuan" class="form-control select2bs4" required>
                        <option value="0" disabled selected>Pilih Satuan</option>
                        <?php
                           foreach ($satuan as $key) {
                        ?>
                        <option value="<?= $key->satuan_id ?>"><?= $key->satuan_nm ?></option>
                        <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Tempat Lahir" id="birth_place" name="birth_place" required autocomplete="off"/>
                      <div class="input-group-append">
                        <div class="input-group-text">
                          <span class="fas fa-globe-asia"></span>
                        </div>
                      </div>
                  </div>
                </div>
            </div>
            <div class="row col-md-12">
                  <div class="form-group col-md-3">
                      <label for="hari">Tanggal lahir</label>
                      <select class="form-control select2bs4" name="hari" id="hari" required>
                          <?php
                              for ($i=1; $i <= 31 ; $i++) { 
                          ?>
                          <option value="<?= $i ?>"><?= $i ?></option>
                          <?php } ?>
                      </select>
                  </div>
                  <div class="form-group col-md-5">
                          <label for="bulan">Bulan lahir</label>
                          <select class="form-control select2bs4" name="bulan" id="bulan" required>
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
                  <div class="form-group col-md-4">
                        <label for="tahun">Tahun lahir</label>
                          <select class="form-control select2bs4" name="tahun" id="tahun" required>
                            <?php
                              $thn = date("Y");
                                for ($t=1970; $t <= $thn ; $t++) { 
                            ?>
                            <option <?= ($t==$thn?'selected':'') ?> value="<?= $t ?>"><?= $t ?></option>
                            <?php } ?>
                          </select>
                  </div>
            </div>
            <div class="row col-md-12">
                <div class="col-md-6">
                  <div class="input-group mb-3">
                    <select class="form-control" name="gender_cd" id="gender_cd" required>
                      <option value="m">Laki-laki</option>
                      <option value="f">Perempuan</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group mb-3">
                    <select name="pendidikan" id="pendidikan" class="form-control select2bs4">
                        <option value="0" disabled selected>Pilih Pendidikan</option>
                        <?php
                           foreach ($pendidikan as $key) {
                        ?>
                        <option value="<?= $key->pendidikan_id ?>"><?= $key->pendidikan_nm ?> (<?= $key->pendidikan_cd ?>)</option>
                        <?php } ?>
                    </select>
                  </div>
                </div>
            </div>
            <div class="row col-md-12">
                <div class="col-md-6">
                  <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="NRP" name="user_nm" id="user_nm" required autocomplete="off" maxlength="8" minlength="8"/>
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-user"></span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="No Handphone" name="cellphone" id="cellphone" required autocomplete="off"/>
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-mobile"></span>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
            <div class="row">
              <div class="col-8"> 
              </div>
              <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">Simpan</button>
              </div>
            </div>
          </form>
      <a href="/login" class="text-center">Kembali ke halaman login</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<?= $this->include('front/include/js') ?>
<script>
  $(document).ready(function() {
       
   });

  $("#formRegister").on("submit", function(e) {
    e.preventDefault();
      var person_nm = $("#person_nm").val();
      var satuan = $("#satuan").val();
      var birth_place = $("#birth_place").val();
      var hari = $("#hari").val();
      var bulan = $("#bulan").val();
      var tahun = $("#tahun").val();
      var cellphone = $("#cellphone").val();
      var addr_txt = $("#addr_txt").val();
      var user_nm = $("#user_nm").val();
      var gender_cd = $("#gender_cd").val();
      // var nrp = $("#nrp").val();
      var pendidikan = $("#pendidikan").val();
      var pangkat = $("#pangkat").val();
      console.log(pendidikan);
      console.log(satuan);
      
      $.ajax({
        url: "<?= base_url('login/simpanregister') ?>",
        type: "post",
        dataType: "json",
        data: {
            "person_nm" : person_nm,
            "satuan" : satuan,
            "birth_place" : birth_place,
            "hari" : hari,
            "bulan" : bulan,
            "tahun" : tahun,
            "cellphone" : cellphone,
            "addr_txt" : addr_txt,
            "user_nm" : user_nm,
            // "nrp" : nrp,
            "pendidikan" : pendidikan,
            "pangkat" : pangkat,
            "gender_cd" : gender_cd
        },
        success: function(data) {
          if (data == 'pendidikankosong') {
            Swal.fire("Pendidikan wajib diisi", "", "warning");
          } else if (data == 'satuankosong') {
            Swal.fire("Satuan wajib diisi", "", "warning");
          } else if (data == "userada") {
            Swal.fire("Username sudah digunakan", "", "warning");
          } else if (data == "cellphoneada") {
            Swal.fire("No. Handphone sudah digunakan", "", "warning");
          } else if (data == "nrpada") {
            Swal.fire("NRP sudah digunakan", "", "warning");
          } else if (data == "sukses") {
            Swal.fire("Pendaftaran berhasil", "", "success");
            setTimeout(location.href = "<?= base_url() ?>/login", 2000);
          }
        },
        error: function(e) {
          alert(e.responseText);
        }
      });
  });
    </script>

<script>
    $(function() {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' /* optional */
        });

        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
          theme: 'bootstrap4'
        })
    });
    </script>
</body>
</html>
