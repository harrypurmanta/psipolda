<!DOCTYPE html>
<html>
<head>
</head>
<body>
    <p style="text-align: center;">
            KEPOLISIAN NEGARA REPUBLIK INDONESIA <br>
            DAERAH SUMATERA SELATAN <br>
            BIRO SUMBER DAYA MANUSIA
        </p>
        <hr>
        <p style="text-align: center;"><strong>BDI</strong></p>

    <table border="0" width="100%">
        <tbody>
            <tr>
                <td style="vertical-align: top; font-weight: bold;" class="text-left text-bold" width="80">Nama</td>
                <td style="vertical-align: top;" class="text-cente text-boldr" width="10">:</td>
                <td style="vertical-align: top;" class="text-left" width="170"><?= $user[0]->person_nm ?></td>
                <td style="vertical-align: top; font-weight: bold;" class="text-left text-bold" width="110">Jenis Kelamin/Usia</td>
                <td style="vertical-align: top;" class="text-center text-bold" width="10">:</td>
                <td style="vertical-align: top;" class="text-left" width="170"><?= ($user[0]->gender_cd=="m"?"Laki-laki":"Perempuan") ?> / <?= $thn_lahir ?> Thn</td>
            </tr>
            <tr>
                <td style="vertical-align: top; font-weight: bold;" class="text-left text-bold" width="80">Pangkat/NRP</td>
                <td style="vertical-align: top;" class="text-center text-bold" width="10">:</td>
                <td style="vertical-align: top;" class="text-left" width="170"><?= $user[0]->pangkat ?> / <?= $user[0]->nrp ?></td>
                <td style="vertical-align: top; font-weight: bold;" class="text-left text-bold" width="110">tgl Pemeriksaan</td>
                <td style="vertical-align: top;" class="text-center text-bold" width="10">:</td>
                <td style="vertical-align: top;" class="text-left" width="170"><?= date("d-m-Y",strtotime($tanggal_pemeriksaan[0]->created_dttm)) ?></td>
            </tr>
            <tr>
                <td style="vertical-align: top; font-weight: bold;" class="text-left text-bold" width="80">Kesatuan</td>
                <td style="vertical-align: top;" class="text-center text-bold" width="10">:</td>
                <td style="vertical-align: top;" class="text-left" width="170"><?= $user[0]->satuan_nm ?></td>
                <td style="vertical-align: top; font-weight: bold;" class="text-left text-bold" width="110">Pendidikan</td>
                <td style="vertical-align: top;" class="text-center text-bold" width="10">:</td>
                <td style="vertical-align: top;" class="text-left" width="170"><?= $user[0]->pendidikan_nm ?></td>
            </tr>
            <tr>
                <td style="vertical-align: top;" class="text-left text-bold" width="80"></td>
                <td style="vertical-align: top;" class="text-center text-bold" width="10"></td>
                <td style="vertical-align: top;" class="text-left" width="170"></td>
                <td style="vertical-align: top; font-weight: bold;" class="text-left text-bold" width="110">No. Peserta</td>
                <td style="vertical-align: top;" class="text-center text-bold" width="10">:</td>
                <td style="vertical-align: top;" class="text-left" width="170"><?= $notest ?></td>
            </tr>
        </tbody>
    </table>
    <hr>
    <p style="text-align: center;"><strong>HASIL</strong></p>

    <table>
        <tbody>
            <tr>
                <td width="80px"><strong>Total</strong></td>
                <td width="10px">:</td>
                <td><?= $total ?></td>
            </tr>
            <tr>
                <td width="80px"><strong>Kategori</strong></td>
                <td width="10px">:</td>
                <td><?= $kategori ?></td>
            </tr>
        </tbody>
    </table>
</body>
</html>