<table style="text-align: center; width: 50%;">
    <tbody>
        <tr>
            <td style="border-bottom: 1px solid black;">KEPOLISIAN DAERAH SUMATERA SELATAN <br>
                BIRO SUMBER DAYA MANUSIA <br>
                BAGIAN PSIKOLOGI 
            </td>
        </tr>
    </tbody>
</table>
<br>
<br>
<table border="0">
    <tbody>
        <tr>
            <td width="100px">NOMOR UJIAN</td>
            <td width="15px" style="text-align: center;">:</td>
            <td width="150px"><?= isset($NoTest[0]->NoTest) ? $NoTest[0]->NoTest : '' ?></td>
            <td width="100px">JABATAN</td>
            <td width="15px" style="text-align: center;">:</td>
            <td width="150px"><?= isset($identitas[0]->jabatan) ? $identitas[0]->jabatan : '' ?></td>
        </tr>
        <tr>
            <td width="100px">NAMA</td>
            <td width="15px" style="text-align: center;">:</td>
            <td width="150px"><?= isset($identitas[0]->person_nm) ? $identitas[0]->person_nm : '' ?></td>
            <td width="100px">KESATUAN</td>
            <td width="15px" style="text-align: center;">:</td>
            <td width="150px"><?= isset($identitas[0]->satuan_nm) ? $identitas[0]->satuan_nm : '' ?></td>
        </tr>
        <tr>
            <td width="100px">PANGKAT/NRP</td>
            <td width="15px" style="text-align: center;">:</td>
            <td width="150px"><?= isset($identitas[0]->pangkat) ? $identitas[0]->pangkat : '' ?>/<?= isset($identitas[0]->nrp) ? $identitas[0]->nrp : '' ?></td>
            <td width="100px">TANGGAL UJIAN</td>
            <td width="15px" style="text-align: center;">:</td>
            <td width="150px"><?= isset($identitas[0]->tanggal_ttd) ? tanggalIndo($identitas[0]->tanggal_ttd) : '' ?></td>
        </tr>
    </tbody>
</table>
<div style="text-align: center;">
    <h4>INVENTORI TES PSIKOLOGI </h4>
</div>
<label><b>Instruksi:</b></label>
<p style="text-align: justify;">Anda dihadapkan pada beberapa pertanyaan. Bacalah setiap nomor dan sub pertanyaan dengan 
saksama karena tiap-tiap pertanyaan saling berhubungan. Jawablah pertanyaan-pertanyaan di tempat 
yang telah disediakan. Selamat mengerjakan. </p>


<?php
$db = db_connect();
$no = 1;

foreach ($no_soal as $nosoal_key) {
    // Ambil semua soal untuk no_soal ini
    $soal = $db->query("SELECT * FROM inventori_pertanyaan a 
                        LEFT JOIN inventori_psikologi b 
                        ON b.inventori_pertanyaan_id = a.inventori_pertanyaan_id  AND b.person_id = $person_id 
                        WHERE a.status_cd = 'normal' 
                        AND a.no_soal = $nosoal_key->no_soal")->getResult();

    if (!empty($soal)) {
        echo '<table width="90%" border="0" cellpadding="5">';
        $huruf = 'a';

        foreach ($soal as $index => $soal_key) {
            echo '<tr valign="top">';
            
            // Baris pertama tampilkan nomor utama
            if ($index == 0) {
                echo '<td width="30px" rowspan="' . count($soal) . '">' . $no++ . '.</td>';
            }

            // Pertanyaan + Jawaban
            echo '<td width="20px">' . $huruf++ . '.</td>';
            echo '<td style="width: 100%;">';
            echo $soal_key->inventori_pertanyaan_nm . '<br>';
            echo '<b>Jawaban : </b>'. $soal_key->jawaban.'<br>';
            echo '</td>';
            echo '</tr>';
        }

        echo '</table><br>';
    }
}
?>

