<table border="0" style="width: 100%;">
            <tbody>
                <tr>
                    <td width="25px;" style="text-align: center;">1.</td><td width="150px">Nama lengkap</td><td width="20px;" style="text-align: center;">:</td><td width="345px;"><?= $identitas[0]->person_nm ?></td>
                </tr>
                <tr>
                    <td style="text-align: center;">2.</td><td>Tempat/tanggal lahir</td><td style="text-align: center;">:</td><td><?= $identitas[0]->birth_place ?>/<?= $identitas[0]->birth_dttm ?></td>
                </tr>
                <tr>
                    <td style="text-align: center;">3.</td><td>Jenis kelamin</td><td style="text-align: center;">:</td><td><?= $identitas[0]->gender_cd ?></td>
                </tr>
                <tr>
                    <td style="text-align: center;">4.</td><td>Alamat</td><td style="text-align: center;">:</td><td><?= $identitas[0]->addr_txt ?></td>
                </tr>
                <tr>
                    <td style="text-align: center;">5.</td><td>Agama</td><td style="text-align: center;">:</td><td><?= $identitas[0]->agama_nm ?></td>
                </tr>
                <tr>
                    <td style="text-align: center;">6.</td><td>Status pernikahan</td><td style="text-align: center;">:</td><td><?= $identitas[0]->status_pernikahan_nm ?></td>
                </tr>
                <tr>
                    <td style="text-align: center;">7.</td><td>Jabatan saat ini</td><td style="text-align: center;">:</td><td><?= $identitas[0]->jabatan ?></td>
                </tr>
                <tr>
                    <td style="text-align: center;">8.</td><td>Pangkat dan NRP</td><td style="text-align: center;">:</td><td><?= $identitas[0]->pangkat ?> - <?= $identitas[0]->nrp ?></td>
                </tr>
                <tr>
                    <td style="text-align: center;">9.</td><td>Alamat Kantor</td><td style="text-align: center;">:</td><td><?= $identitas[0]->addr_txt_office ?></td>
                </tr>
                <tr>
                    <td style="text-align: center;">10.</td><td>Nama atasan langsung</td><td style="text-align: center;">:</td><td><?= $identitas[0]->nama_atasan ?></td>
                </tr>
                <tr>
                    <td style="text-align: center;">11.</td><td>Jabatan atasan langsung</td><td style="text-align: center;">:</td><td><?= $identitas[0]->jabatan_atasan ?></td>
                </tr>
                <tr>
                    <td style="text-align: center;">12.</td><td>No HP</td><td style="text-align: center;">:</td><td><?= $identitas[0]->cellphone ?></td>
                </tr>
                <tr>
                    <td style="text-align: center;">13.</td><td>Email</td><td style="text-align: center;">:</td><td><?= $identitas[0]->email ?></td>
                </tr>
            </tbody>
        </table>