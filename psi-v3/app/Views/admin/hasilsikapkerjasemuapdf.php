<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<style>
    body {
        font-family: helvetica, sans-serif;
        font-size: 8.5pt;
        color: #111;
    }
    .header-table {
        width: 100%;
        border-bottom: 2px solid #000;
        padding-bottom: 4px;
        margin-bottom: 8px;
    }
    .title {
        text-align: center;
        font-size: 12pt;
        font-weight: bold;
        margin-bottom: 2px;
    }
    .subtitle {
        text-align: center;
        font-size: 9pt;
        margin-bottom: 10px;
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
        padding: 5px 2px;
        font-size: 8pt;
        border: 1px solid #2c3b41;
    }
    .data-table td {
        border: 1px solid #999999;
        padding: 4px 2px;
        font-size: 8pt;
    }
</style>
</head>
<body>

    <table class="header-table" cellpadding="0" cellspacing="0">
        <tr>
            <td style="text-align: center;">
                <span style="font-size: 11pt; font-weight: bold;">BAGIAN PSIKOLOGI BIRO SDM POLDA SUMATERA SELATAN</span><br>
                <span style="font-size: 8pt; color: #444;">Jl. Jenderal Sudirman KM. 4.5 Palembang, Sumatera Selatan</span>
            </td>
        </tr>
    </table>

    <div class="title">REKAPITULASI HASIL PENILAIAN SIKAP KERJA</div>
    <div class="subtitle">
        Periode: <b><?= date('d-m-Y', strtotime($start_dttm)) ?> s/d <?= date('d-m-Y', strtotime($end_dttm)) ?></b>
        &nbsp;|&nbsp; Materi: <b><?= esc($materi_nm) ?></b>
    </div>

    <table class="data-table" cellpadding="3" cellspacing="0">
        <thead>
            <tr>
                <th width="3.5%" rowspan="2" align="center" style="vertical-align: middle;">No</th>
                <th width="7%" rowspan="2" align="center" style="vertical-align: middle;">No. Tes</th>
                <th width="16%" rowspan="2" align="center" style="vertical-align: middle;">Nama Peserta</th>
                <th width="11.5%" rowspan="2" align="center" style="vertical-align: middle;">Pangkat / NRP</th>
                <th width="11%" rowspan="2" align="center" style="vertical-align: middle;">Kesatuan</th>
                <th width="8%" rowspan="2" align="center" style="vertical-align: middle;">Materi</th>
                <th width="28%" colspan="10" align="center">Benar Per Kolom</th>
                <th width="5%" rowspan="2" align="center" style="background-color: #007bff; vertical-align: middle;">Tot Jwb</th>
                <th width="5%" rowspan="2" align="center" style="background-color: #28a745; vertical-align: middle;">Tot Bnr</th>
                <th width="5%" rowspan="2" align="center" style="background-color: #dc3545; vertical-align: middle;">Tot Slh</th>
            </tr>
            <tr>
                <th width="2.8%">K1</th>
                <th width="2.8%">K2</th>
                <th width="2.8%">K3</th>
                <th width="2.8%">K4</th>
                <th width="2.8%">K5</th>
                <th width="2.8%">K6</th>
                <th width="2.8%">K7</th>
                <th width="2.8%">K8</th>
                <th width="2.8%">K9</th>
                <th width="2.8%">K10</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($users)) { ?>
                <?php $no = 1; foreach ($users as $u) { ?>
                    <tr>
                        <td align="center"><?= $no++ ?></td>
                        <td align="center"><b><?= !empty($u->no_tes) ? esc($u->no_tes) : '-' ?></b></td>
                        <td><b><?= esc($u->person_nm) ?></b></td>
                        <td><?= (!empty($u->pangkat) && $u->pangkat !== '-' ? esc($u->pangkat) : '') . (!empty($u->nrp) && $u->nrp !== '-' ? ' / ' . esc($u->nrp) : '-') ?></td>
                        <td><?= esc($u->satuan_nm) ?></td>
                        <td align="center"><?= esc($u->materi_nm) ?></td>
                        <?php for ($k = 1; $k <= 10; $k++) { ?>
                            <td align="center" style="color: #28a745; font-weight: bold;">
                                <?= isset($u->kolom_detail[$k]) ? $u->kolom_detail[$k]['benar'] : 0 ?>
                            </td>
                        <?php } ?>
                        <td align="center" style="font-weight: bold; background-color: #f0f7ff;">
                            <?= $u->total_terjawab ?>
                        </td>
                        <td align="center" style="font-weight: bold; color: #28a745; background-color: #f0fff4;">
                            <?= $u->total_benar ?>
                        </td>
                        <td align="center" style="font-weight: bold; color: #dc3545; background-color: #fff5f5;">
                            <?= $u->total_salah ?>
                        </td>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="19" align="center">Tidak ada data hasil untuk filter yang dipilih.</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <table style="width: 100%; margin-top: 25px; font-size: 9pt;" cellpadding="0" cellspacing="0">
        <tr>
            <td width="70%"></td>
            <td width="30%" align="center">
                Palembang, <?= date('d F Y') ?><br>
                <b>Penguji / Administrator</b><br><br><br><br>
                ( .................................................. )
            </td>
        </tr>
    </table>

</body>
</html>
