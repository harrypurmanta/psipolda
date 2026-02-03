<table style="width: 100%;">
            <tbody>
                <tr>
                    <td style="width: 65%; text-align: center; font-weight: normal; font-size: 14px;">
                        KEPOLISIAN DAERAH SUMATERA SELATAN<br>
                        BIRO SUMBER DAYA MANUSIA<br>
                        BAGIAN PSIKOLOGI
                        <hr>
                    </td>
                    <td style="width: 35%; text-align: center;">
                        <table border="1" cellpadding="5" cellspacing="0" style="width: 100%;">
                            <tbody>
                                <tr>
                                    <td style="font-size: 12px;">
                                        NOMOR TES : <br>
                                        <b style="font-size: 20px;"><?= isset($NoTest[0]->NoTest) ? $NoTest[0]->NoTest : '' ?></b>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
        <h1 style="text-align: center;">RIWAYAT HIDUP</h1>
        <h4>JENIS PENGAJUAN : <?= isset($identitas[0]->jenis_pengajuan_nm) ? $identitas[0]->jenis_pengajuan_nm : '' ?></h4>
        <div style="margin-top: 10px; margin-bottom: 10px;">
            <table border="1" cellpadding="3" cellspacing="0" style="width: 30%;">
                <tr>
                    <td style="font-size: 14px; font-weight: bold;">I. IDENTITAS DIRI</td>
                </tr>
            </table>
        </div>

<table border="0" style="width: 100%;">
            <tbody>
                <tr>
                    <td width="25px;" style="text-align: center;">1.</td><td width="150px">Nama lengkap</td><td width="20px;" style="text-align: center;">:</td><td width="345px;"><?= isset($identitas[0]->person_nm) ? $identitas[0]->person_nm : '' ?></td>
                </tr>
                <tr>
                    <td style="text-align: center;">2.</td><td>Tempat/tanggal lahir</td><td style="text-align: center;">:</td><td><?= isset($identitas[0]->birth_place) ? $identitas[0]->birth_place : '' ?>/<?= isset($identitas[0]->birth_dttm) ? tanggalIndo($identitas[0]->birth_dttm) : '' ?></td>
                </tr>
                <tr>
                    <td style="text-align: center;">3.</td><td>Jenis kelamin</td><td style="text-align: center;">:</td>
                    <td><?php
                            if (isset($identitas[0]->gender_cd)) {
                                echo ($identitas[0]->gender_cd === 'm') ? 'Laki-laki' : (($identitas[0]->gender_cd === 'f') ? 'Perempuan' : '');
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center;">4.</td><td>Alamat</td><td style="text-align: center;">:</td><td><?= isset($identitas[0]->addr_txt) ? $identitas[0]->addr_txt : '' ?></td>
                </tr>
                <tr>
                    <td style="text-align: center;">5.</td><td>Agama</td><td style="text-align: center;">:</td><td><?= isset($identitas[0]->agama_nm) ? $identitas[0]->agama_nm : '' ?></td>
                </tr>
                <tr>
                    <td style="text-align: center;">6.</td><td>Status pernikahan</td><td style="text-align: center;">:</td><td><?= isset($identitas[0]->status_pernikahan_nm) ? $identitas[0]->status_pernikahan_nm : '' ?></td>
                </tr>
                <tr>
                    <td style="text-align: center;">7.</td><td>Jabatan saat ini</td><td style="text-align: center;">:</td><td><?= isset($identitas[0]->jabatan) ? $identitas[0]->jabatan : '' ?></td>
                </tr>
                <tr>
                    <td style="text-align: center;">8.</td><td>Pangkat dan NRP</td><td style="text-align: center;">:</td><td><?= isset($identitas[0]->pangkat) ? $identitas[0]->pangkat : '' ?> - <?= isset($identitas[0]->nrp) ? $identitas[0]->nrp : '' ?></td>
                </tr>
                <tr>
                    <td style="text-align: center;">9.</td><td>Alamat Kantor</td><td style="text-align: center;">:</td><td><?= isset($identitas[0]->addr_txt_office) ? $identitas[0]->addr_txt_office : '' ?></td>
                </tr>
                <tr>
                    <td style="text-align: center;">10.</td><td>Nama atasan langsung</td><td style="text-align: center;">:</td><td><?= isset($identitas[0]->nama_atasan) ? $identitas[0]->nama_atasan : '' ?></td>
                </tr>
                <tr>
                    <td style="text-align: center;">11.</td><td>Jabatan atasan langsung</td><td style="text-align: center;">:</td><td><?= isset($identitas[0]->jabatan_atasan) ? $identitas[0]->jabatan_atasan : '' ?></td>
                </tr>
                <tr>
                    <td style="text-align: center;">12.</td><td>No HP</td><td style="text-align: center;">:</td><td><?= isset($identitas[0]->cellphone) ? $identitas[0]->cellphone : '' ?></td>
                </tr>
                <tr>
                    <td style="text-align: center;">13.</td><td>Email</td><td style="text-align: center;">:</td><td><?= isset($identitas[0]->email) ? $identitas[0]->email : '' ?></td>
                </tr>
            </tbody>
        </table>
<br>
<br>
<div style="width: 100%;">
        <table border="1" cellpadding="3" cellspacing="0" style="width: 30%;">
                <tr>
                    <td style="font-size: 14px; font-weight: bold;">II. KELUARGA</td>
                </tr>
            </table>
        <p style="text-align: center;">Susunan Keluarga (Istri/Suami dan Anak-anak)</p>
        <table border="1" width="100%;" style="width: 100%;">
            <thead>
                <tr>
                    <th width="70px;" style="text-align: center;"></th>
                    <th width="125px;" style="text-align: center;">Nama</th>
                    <th width="25px;" style="text-align: center;">L/P</th>
                    <th width="135px;" style="text-align: center;">Tempat/Tgl Lahir</th>
                    <th style="text-align: center;">Pendidikan</th>
                    <th style="text-align: center;">Pekerjaan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($keluarga as $keluarga_key) {
                ?>
                <tr>
                    <td width="70px;" style="text-align: center;"><?= $keluarga_key->hubungan ?></td>
                    <td width="125px;"><?= $keluarga_key->keluarga_nm ?></td>
                    <td width="25px;" style="text-align: center;"><?= $keluarga_key->jenis_kelamin ?></td>
                    <td width="135px;" style="text-align: center;"><?= $keluarga_key->tempat_lahir ?>/<?= $keluarga_key->tanggal_lahir ?></td>
                    <td style="text-align: center;"><?= $keluarga_key->pendidikan ?></td>
                    <td style="text-align: center;"><?= $keluarga_key->pekerjaan ?></td>
                    
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>