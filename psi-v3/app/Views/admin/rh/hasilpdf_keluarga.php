<div style="width: 100%;">
        <p style="border: 1px solid black;">II. KELUARGA</p>
        <div style="width: 100%; text-align: center;">
            <p>Susunan Keluarga (Istri/Suami dan Anak-anak)</p>
        </div>
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