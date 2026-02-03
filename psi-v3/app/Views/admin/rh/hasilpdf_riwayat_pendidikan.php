<div style="width: 100%;">
    <table border="1" cellpadding="3" cellspacing="0" style="width: 40%;">
        <tr>
            <td style="font-size: 14px; font-weight: bold;">III. RIWAYAT PENDIDIKAN</td>
        </tr>
    </table>
    <p>1. Pendidikan Formal</p>
    <table border="1" width="100%;">
        <thead>
            <tr>
                <th width="60px" style="text-align: center;"></th>
                <th width="100px" style="text-align: center;">Nama Sekolah</th>
                <th style="text-align: center;">Jurusan</th>
                <th style="text-align: center;">Tempat</th>
                <th style="text-align: center;">Thn s/d Thn</th>
                <th style="text-align: center;">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($formal as $formal_key) {
            ?>
            <tr>
                <td width="60px" style="text-align: center;"><?= $formal_key->jenjang_pendidikan_nm ?></td>
                <td width="100px" style="text-align: center;"><?= $formal_key->nama_sekolah ?></td>
                <td style="text-align: center;"><?= $formal_key->jurusan ?></td>
                <td style="text-align: center;"><?= $formal_key->tempat ?></td>
                <td style="text-align: center;"><?= $formal_key->tahun_mulai ?> s/d <?= $formal_key->tahun_selesai ?></td>
                <td style="text-align: center;"><?= $formal_key->keterangan ?></td>
                
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <p>2. Pendidikan Polri (Dikma dan Dikbang) </p>
    <table border="1" width="100%;">
        <thead>
            <tr>
                <th width="25px" style="text-align: center;">No</th>
                <th width="125px" style="text-align: center;">Jenis</th>
                <th width="145px" style="text-align: center;">Tempat</th>
                <th style="text-align: center;">Tahun</th>
                <th width="145px" style="text-align: center;">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
                foreach ($pendidikan_polri as $polri_key) {
            ?>
            <tr>
                <td width="25px" style="text-align: center;"><?= $no++; ?></td>
                <td width="125px" style="text-align: center;"><?= $polri_key->jenis ?></td>
                <td width="145px" style="text-align: center;"><?= $polri_key->tempat ?></td>
                <td style="text-align: center;"><?= $polri_key->tahun ?></td>
                <td width="145px" style="text-align: center;"><?= $polri_key->keterangan ?></td>
                
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <p>3. Pendidikan Pengembangan Spesiasialis yang diikuti/Termasuk Pelatihan Yang diadakan Polri  </p>
    <table border="1" width="100%;">
        <thead>
            <tr>
                <th width="25px" style="text-align: center;">No</th>
                <th width="125px" style="text-align: center;">Jenis Dikbangspes</th>
                <th width="145px" style="text-align: center;">Tempat</th>
                <th style="text-align: center;">Tahun</th>
                <th width="145px" style="text-align: center;">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
                foreach ($pendidikan_spesialis as $spesialis_key) {
            ?>
            <tr>
                <td width="25px" style="text-align: center;"><?= $no++; ?></td>
                <td width="125px" style="text-align: center;"><?= $spesialis_key->jenis ?></td>
                <td width="145px" style="text-align: center;"><?= $spesialis_key->tempat ?></td>
                <td style="text-align: center;"><?= $spesialis_key->tahun ?></td>
                <td width="145px" style="text-align: center;"><?= $spesialis_key->keterangan ?></td>
                
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <br><br><br>
    <table border="1" cellpadding="3" cellspacing="0" style="width: 40%;">
        <tr>
            <td style="font-size: 14px; font-weight: bold;">IV. RIWAYAT PEKERJAAN</td>
        </tr>
    </table>
    <p>1. Uraikan dengan singkat pekerjaan Anda selama ini (dimulai dari posisi terakhir):</p>
    <table border="1" width="100%;">
        <thead>
            <tr>
                <th width="25px" style="text-align: center;">No</th>
                <th width="120px" style="text-align: center;">Jabatan</th>
                <th width="150px" style="text-align: center;">Bln/Thn s/d Bln/Thn</th>
                <th style="text-align: center;">Bagian/Dept.</th>
                <th width="125px" style="text-align: center;">Satker</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $no = 1;
                foreach ($riwayat_pekerjaan as $pekerjaan_key) {
            ?>
            <tr>
                <td width="25px" style="text-align: center;"><?= $no++; ?></td>
                <td width="120px">&nbsp;<?= $pekerjaan_key->jabatan ?></td>
                <td width="150px" style="text-align: center;"><?= $pekerjaan_key->mulai ?> s/d <?= $pekerjaan_key->selesai ?></td>
                <td style="text-align: center;"><?= $pekerjaan_key->bagian ?></td>
                <td width="125px" style="text-align: center;"><?= $pekerjaan_key->satker ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<div style="width: 100%;">
    <table style="text-align: center; margin-top: 120px; padding-left: 350px;">
        <tbody>
            <tr>
                <td><?= isset($identitas[0]->tempat_ttd) ? $identitas[0]->tempat_ttd : '' ?>,  <?= isset($identitas[0]->tanggal_ttd) ? tanggalIndo($identitas[0]->tanggal_ttd) : '' ?></td>
            </tr>
            <tr>
                <td>Pemohon</td>
            </tr>
            <tr>
                <td><img src="/images/ttd/<?= isset($identitas[0]->nama_file) ? $identitas[0]->nama_file : '' ?>" alt="gambar ttd" width="150px" height="150px"></td>
            </tr>
            <tr>
                <td>( <?= isset($identitas[0]->person_nm) ? $identitas[0]->person_nm : '' ?> )</td>
            </tr>
            <tr>
                <td><?= isset($identitas[0]->pangkat) ? $identitas[0]->pangkat : '' ?> / <?= isset($identitas[0]->nrp) ? $identitas[0]->nrp : '' ?></td>
            </tr>
        </tbody>
    </table>
</div>  