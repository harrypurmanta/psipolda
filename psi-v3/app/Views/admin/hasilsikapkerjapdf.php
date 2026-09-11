<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<style>
    body {
        font-family: helvetica, sans-serif;
        font-size: 10pt;
        color: #111;
    }
    .header-table {
        width: 100%;
        border-bottom: 2px solid #000;
        padding-bottom: 5px;
        margin-bottom: 10px;
    }
    .title {
        text-align: center;
        font-size: 13pt;
        font-weight: bold;
        margin-top: 5px;
        margin-bottom: 2px;
    }
    .subtitle {
        text-align: center;
        font-size: 11pt;
        margin-bottom: 12px;
    }
    .bio-table {
        width: 100%;
        margin-bottom: 12px;
    }
    .bio-table td {
        padding: 3px 2px;
        font-size: 9.5pt;
    }
    .summary-table {
        width: 100%;
        margin-bottom: 12px;
        border-collapse: collapse;
    }
    .summary-table td {
        border: 1px solid #777;
        text-align: center;
        padding: 6px;
        font-size: 10pt;
    }
    .data-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 5px;
    }
    .data-table th {
        background-color: #2c3b41;
        color: #ffffff;
        font-weight: bold;
        text-align: center;
        padding: 6px 4px;
        font-size: 9.5pt;
        border: 1px solid #2c3b41;
    }
    .data-table td {
        border: 1px solid #999999;
        padding: 5px 4px;
        font-size: 9.5pt;
    }
    .data-table tfoot td {
        font-weight: bold;
        background-color: #eeeeee;
        border: 1px solid #777;
    }
</style>
</head>
<body>

    <table class="header-table" cellpadding="0" cellspacing="0">
        <tr>
            <td style="text-align: center;">
                <span style="font-size: 11pt; font-weight: bold;">BAGIAN PSIKOLOGI BIRO SDM POLDA SUMATERA SELATAN</span><br>
                <span style="font-size: 8.5pt; color: #444;">Jl. Jenderal Sudirman KM. 4.5 Palembang, Sumatera Selatan</span>
            </td>
        </tr>
    </table>

    <div class="title">HASIL PENILAIAN SIKAP KERJA</div>
    <div class="subtitle">Materi: <b><?= esc($materi_nm) ?></b></div>

    <!-- Biodata Peserta -->
    <table class="bio-table" cellpadding="2" cellspacing="0">
        <tr>
            <td width="20%"><b>No. Tes</b></td>
            <td width="3%">:</td>
            <td width="37%"><b style="font-size: 11pt; color: #000;"><?= !empty($no_tes) ? $no_tes : '-' ?></b></td>
            <td width="20%"><b>Tanggal Ujian</b></td>
            <td width="3%">:</td>
            <td width="17%"><?= !empty($tanggal_pemeriksaan[0]->created_dttm) ? date('d-m-Y H:i', strtotime($tanggal_pemeriksaan[0]->created_dttm)) : date('d-m-Y') ?></td>
        </tr>
        <tr>
            <td><b>Nama</b></td>
            <td>:</td>
            <td><b><?= !empty($user[0]->person_nm) ? $user[0]->person_nm : '-' ?></b></td>
            <td><b>Jenis Kelamin / Usia</b></td>
            <td>:</td>
            <td><?= (!empty($user[0]->gender_cd) && strtolower($user[0]->gender_cd) == 'm' ? 'Laki-laki' : 'Perempuan') . ' / ' . $thn_lahir . ' Thn' ?></td>
        </tr>
        <tr>
            <td><b>Pangkat / NRP</b></td>
            <td>:</td>
            <td><?= (!empty($user[0]->pangkat) ? $user[0]->pangkat : '-') . ' / ' . (!empty($user[0]->nrp) ? $user[0]->nrp : '-') ?></td>
            <td><b>Tempat / Tgl Lahir</b></td>
            <td>:</td>
            <td><?= (!empty($user[0]->birth_place) ? $user[0]->birth_place . ', ' : '') . (!empty($user[0]->birth_dttm) ? date('d-m-Y', strtotime($user[0]->birth_dttm)) : '-') ?></td>
        </tr>
        <tr>
            <td><b>Kesatuan</b></td>
            <td>:</td>
            <td><?= !empty($user[0]->satuan_nm) ? $user[0]->satuan_nm : '-' ?></td>
            <td><b>Pendidikan</b></td>
            <td>:</td>
            <td><?= !empty($user[0]->pendidikan_nm) ? $user[0]->pendidikan_nm : '-' ?></td>
        </tr>
        <tr>
            <td><b>No. Handphone</b></td>
            <td>:</td>
            <td><?= !empty($user[0]->cellphone) ? $user[0]->cellphone : '-' ?></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </table>

    <!-- Ringkasan Hasil -->
    <table class="summary-table" cellpadding="4" cellspacing="0">
        <tr>
            <td style="background-color: #e8f4fd; width: 33.33%;">
                <span style="font-size: 8.5pt; color: #555;">TOTAL TERJAWAB</span><br>
                <b style="font-size: 14pt; color: #007bff;"><?= $total_terjawab ?></b>
            </td>
            <td style="background-color: #eafaf1; width: 33.33%;">
                <span style="font-size: 8.5pt; color: #555;">TOTAL BENAR</span><br>
                <b style="font-size: 14pt; color: #28a745;"><?= $total_benar ?></b>
            </td>
            <td style="background-color: #fdeeed; width: 33.34%;">
                <span style="font-size: 8.5pt; color: #555;">TOTAL SALAH</span><br>
                <b style="font-size: 14pt; color: #dc3545;"><?= $total_salah ?></b>
            </td>
        </tr>
    </table>

    <!-- Tabel Rincian Kolom -->
    <div style="font-size: 10pt; font-weight: bold; margin-bottom: 4px;">Rincian Hasil Per Kolom:</div>
    <table class="data-table" cellpadding="4" cellspacing="0">
        <thead>
            <tr>
                <th width="10%">No</th>
                <th width="36%">Nama Kolom</th>
                <th width="18%">Terjawab</th>
                <th width="18%">Benar</th>
                <th width="18%">Salah</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($hasil_kolom)) { ?>
                <?php $no = 1; foreach ($hasil_kolom as $row) { ?>
                    <tr>
                        <td align="center"><?= $no++ ?></td>
                        <td><?= esc($row->kolom_nm) ?></td>
                        <td align="center"><?= $row->terjawab ?></td>
                        <td align="center" style="color: #28a745; font-weight: bold;"><?= $row->benar ?></td>
                        <td align="center" style="color: #dc3545; font-weight: bold;"><?= $row->salah ?></td>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="5" align="center">Tidak ada data hasil.</td>
                </tr>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2" align="right"><b>TOTAL :</b></td>
                <td align="center"><b><?= $total_terjawab ?></b></td>
                <td align="center" style="color: #28a745;"><b><?= $total_benar ?></b></td>
                <td align="center" style="color: #dc3545;"><b><?= $total_salah ?></b></td>
            </tr>
        </tfoot>
    </table>

</body>
</html>
