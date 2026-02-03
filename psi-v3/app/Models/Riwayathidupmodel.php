<?php namespace App\Models;

use CodeIgniter\Model;

class Riwayathidupmodel extends Model
{
    protected $table      = 'riwayat_hidup';
    protected $allowedFields = ['jenis_pengajuan_id', 'person_id','status_cd'];

    public function insertexam($data) {
        return $this->db->table('user_exam')
                 ->insert($data);
    }
    public function simpanjawaban($data) {
        return $this->db->table('inventori_psikologi')
                        ->insert($data);
    }

    public function getJawabanInventori($pertanyaan_id, $person_id) {
        return $this->db->table('inventori_psikologi')
                        ->select('*')
                        ->where('status_cd', 'normal')
                        ->where('inventori_pertanyaan_id', $pertanyaan_id)
                        ->where('person_id', $person_id)
                        ->get();
    }

    public function updatejawaban($pertanyaan_id, $person_id, $data) {
        return $this->db->table('inventori_psikologi')
                        ->set($data)
                        ->where('status_cd', 'normal')
                        ->where('inventori_pertanyaan_id', $pertanyaan_id)
                        ->where('person_id', $person_id)
                        ->update();
    }

    public function getPertanyaanInventori() {
        return $this->db->table('inventori_pertanyaan')
                        ->select('no_soal')
                        ->where('status_cd', 'normal')
                        ->groupBy('no_soal')
                        ->get();
    }
    public function getUserExam($user_id, $group_id) {
        // $date = date('Y-m-d');
        return $this->db->table('user_exam')
                        ->select('*')
                        ->where('status_cd', 'normal')
                        ->where('user_id', $user_id)
                        // ->where('no_antrian', $notest)
                        ->where('group_id', $group_id)
                        // ->where('created_dttm >=', $date.' 00:00:00')
                        // ->where('created_dttm <=', $date.' 23:59:59')
                        ->orderBy('user_exam', 'DESC')
                        ->limit(1)
                        ->get();
    }

    public function updateexam($user_exam, $data) {
        return $this->db->table('user_exam')
                        ->set($data)
                        ->where('user_exam', $user_exam)
                        // ->where('no_antrian', $notest)
                        // ->where('group_id', $group_id)
                        ->update();
    }

    public function getDataRiwayatPekerjaanByPersonId($person_id) {
        return $this->db->table('riwayat_pekerjaan a')
                        ->select('*')
                        ->where('a.status_cd', 'normal')
                        ->where('a.person_id', $person_id)
                        ->get();
    }

    public function getDataRiwayatPekerjaanById($riwayat_pekerjaan_id) {
        return $this->db->table('riwayat_pekerjaan a')
                        ->select('*')
                        ->where('a.status_cd', 'normal')
                        ->where('a.riwayat_pekerjaan_id', $riwayat_pekerjaan_id)
                        ->get();
    }

    public function getDataPendidikanFormalByPersonId($person_id) {
        return $this->db->table('riwayat_pendidikan_formal a')
                        ->select('*')
                        ->join('person b', 'b.person_id = a.person_id')
                        ->join('jenjang_pendidikan c', 'c.jenjang_pendidikan_id = a.jenjang_pendidikan_id')
                        ->where('a.status_cd', 'normal')
                        ->where('a.person_id', $person_id)
                        ->orderBy('c.jenjang_pendidikan_id')
                        ->get();
    }

    public function getDataPendidikanFormalById($riwayat_pendidikan_formal_id) {
        return $this->db->table('riwayat_pendidikan_formal a')
                        ->select('*')
                        ->join('person b', 'b.person_id = a.person_id')
                        ->join('jenjang_pendidikan c', 'c.jenjang_pendidikan_id = a.jenjang_pendidikan_id')
                        ->where('a.status_cd', 'normal')
                        ->where('a.riwayat_pendidikan_formal_id', $riwayat_pendidikan_formal_id)
                        ->orderBy('c.jenjang_pendidikan_id')
                        ->get();
    }

    public function getDataPendidikanPolriByPersonId($person_id) {
        return $this->db->table('riwayat_pendidikan_polri a')
                        ->select('*')
                        ->join('person b', 'b.person_id = a.person_id')
                        ->where('a.status_cd', 'normal')
                        ->where('a.person_id', $person_id)
                        ->where('a.tipe', 1)
                        ->get();
    }

    public function getDataPendidikanPolriById($riwayat_pendidikan_polri_id) {
        return $this->db->table('riwayat_pendidikan_polri a')
                        ->select('*')
                        ->join('person b', 'b.person_id = a.person_id')
                        ->where('a.status_cd', 'normal')
                        ->where('a.riwayat_pendidikan_polri_id', $riwayat_pendidikan_polri_id) 
                        ->where('a.tipe', 1) 
                        ->get();
    }

    public function getDataPendidikanSpesialisByPersonId($person_id) {
        return $this->db->table('riwayat_pendidikan_polri a')
                        ->select('*')
                        ->join('person b', 'b.person_id = a.person_id')
                        ->where('a.status_cd', 'normal')
                        ->where('a.person_id', $person_id)
                        ->where('a.tipe', 2)
                        ->get();
    }

    public function getDataPendidikanSpesialisById($riwayat_pendidikan_polri_id) {
        return $this->db->table('riwayat_pendidikan_polri a')
                        ->select('*')
                        ->join('person b', 'b.person_id = a.person_id')
                        ->where('a.status_cd', 'normal')
                        ->where('a.riwayat_pendidikan_polri_id', $riwayat_pendidikan_polri_id) 
                        ->where('a.tipe', 2) 
                        ->get();
    }

    public function getDataKeluargaByPersonId($person_id) {
        return $this->db->table('keluarga')
                        ->select('*')
                        ->where('status_cd', 'normal')
                        ->where('person_id', $person_id)
                        ->get();
    }

    public function getDataKeluargaById($keluarga_id) {
        return $this->db->table('keluarga')
                        ->select('*')
                        ->where('status_cd', 'normal')
                        ->where('keluarga_id', $keluarga_id)
                        ->get();
    }

    public function getRiwayatHidupByUserIdHasil($user_id, $date) {
        return $this->db->table('users a')
                        ->select('b.addr_txt, b.addr_txt_office, b.birth_dttm, b.birth_place, b.blood_type, b.cellphone, b.country, b.email, b.gender_cd, b.jabatan, b.jabatan_atasan, c.jenis_pengajuan_id,
                        b.nama_atasan, b.nrp, b.pangkat, b.person_id, b.person_nm, b.religion, c.riwayat_hidup_id, b.status_pernikahan, c.nama_file, c.lokasi_file, c.tempat_ttd, c.tanggal_ttd, e.satuan_nm, DATE(d.created_dttm) AS tanggal_ujian, f.jenis_pengajuan_nm, g.agama_nm, h.status_pernikahan_nm, d.no_antrian')
                        ->join('person b', 'b.person_id = a.person_id', 'LEFT')
                        ->join('riwayat_hidup c', 'c.person_id = b.person_id', 'LEFT')
                        // ->join('user_exam d', 'a.user_id = d.user_id', 'LEFT')
                        ->join('satuan e', 'e.satuan_id = b.satuan', 'LEFT')
                        ->join('jenis_pengajuan f', 'f.jenis_pengajuan_id = c.jenis_pengajuan_id', 'LEFT')
                        ->join('agama g', 'g.agama_id = b.religion', 'LEFT')
                        ->join('status_pernikahan h', 'h.status_pernikahan_id = b.status_pernikahan', 'LEFT')
                        ->where('a.status_cd', 'normal')
                        ->where('b.status_cd', 'normal')
                        ->where('d.created_dttm >=', $date.' 00:00:00')
                        ->where('d.created_dttm <=', $date.' 23:59:59')
                        ->where('a.user_id', $user_id)
                        ->get();
    }

    public function getIdentitasByUserIdHasil($user_id) {
        return $this->db->table('users a')
                        ->select('b.addr_txt, b.addr_txt_office, b.birth_dttm, b.birth_place, b.blood_type, b.cellphone, b.country, b.email, b.gender_cd, b.jabatan, b.jabatan_atasan, c.jenis_pengajuan_id,
                        b.nama_atasan, b.nrp, b.pangkat, b.person_id, b.person_nm, b.religion, c.riwayat_hidup_id, b.status_pernikahan, c.nama_file, c.lokasi_file, c.tempat_ttd, c.tanggal_ttd, e.satuan_nm, f.jenis_pengajuan_nm, g.agama_nm, h.status_pernikahan_nm')
                        ->join('person b', 'b.person_id = a.person_id', 'LEFT')
                        ->join('riwayat_hidup c', 'c.person_id = b.person_id', 'LEFT')
                        // ->join('user_exam d', 'a.user_id = d.user_id', 'LEFT')
                        ->join('satuan e', 'e.satuan_id = b.satuan', 'LEFT')
                        ->join('jenis_pengajuan f', 'f.jenis_pengajuan_id = c.jenis_pengajuan_id', 'LEFT')
                        ->join('agama g', 'g.agama_id = b.religion', 'LEFT')
                        ->join('status_pernikahan h', 'h.status_pernikahan_id = b.status_pernikahan', 'LEFT')
                        ->where('a.status_cd', 'normal')
                        ->where('b.status_cd', 'normal')
                        ->where('a.user_id', $user_id)
                        ->get();
    }

    public function getRiwayatHidupByUserId($user_id) {
        // $date = date('Y-m-d');
        return $this->db->table('users a')
                        ->select('b.addr_txt, b.addr_txt_office, b.birth_dttm, b.birth_place, b.blood_type, b.cellphone, b.country, b.email, b.gender_cd, b.jabatan, b.jabatan_atasan, c.jenis_pengajuan_id,
                        b.nama_atasan, b.nrp, b.pangkat, b.person_id, b.person_nm, b.religion, c.riwayat_hidup_id, b.status_pernikahan, c.nama_file, c.lokasi_file, c.tempat_ttd, c.tanggal_ttd, e.satuan_nm, DATE(d.created_dttm) AS tanggal_ujian, f.jenis_pengajuan_nm, g.agama_nm, h.status_pernikahan_nm, d.no_antrian')
                        ->join('person b', 'b.person_id = a.person_id', 'LEFT')
                        ->join('riwayat_hidup c', 'c.person_id = b.person_id', 'LEFT')
                        ->join('user_exam d', 'a.user_id = d.user_id', 'LEFT')
                        ->join('satuan e', 'e.satuan_id = b.satuan', 'LEFT')
                        ->join('jenis_pengajuan f', 'f.jenis_pengajuan_id = c.jenis_pengajuan_id', 'LEFT')
                        ->join('agama g', 'g.agama_id = b.religion', 'LEFT')
                        ->join('status_pernikahan h', 'h.status_pernikahan_id = b.status_pernikahan', 'LEFT')
                        ->where('a.status_cd', 'normal')
                        ->where('b.status_cd', 'normal')
                        // ->where('d.created_dttm >=', $date.' 00:00:00')
                        // ->where('d.created_dttm <=', $date.' 23:59:59')
                        ->where('a.user_id', $user_id)
                        ->orderBy('d.user_exam', 'DESC')
                        ->limit(1)
                        ->get();
    }
    public function getJenisPengajuan() {
        return $this->db->table('jenis_pengajuan')
                        ->select('*')
                        ->where('status_cd', 'normal')
                        ->get();
    }

    public function getJenjangPendidikan() {
        return $this->db->table('jenjang_pendidikan')
                        ->select('*')
                        ->where('status_cd', 'normal')
                        ->get();
    }

    public function getAgama() {
        return $this->db->table('agama')
                        ->select('agama_id, agama_nm')
                        ->where('status_cd', 'normal')
                        ->get();
    }

    public function getStatusPernikahan() {
        return $this->db->table('status_pernikahan')
                        ->select('status_pernikahan_id, status_pernikahan_nm')
                        ->where('status_cd', 'normal')
                        ->get();
    }

    public function getSatuan() {
        return $this->db->table('person')
                        ->select('satuan')
                        ->groupBy('satuan')
                        ->get();
    }

    public function getNotestHasil($user_id, $date) {
        return $this->db->table('user_exam')
                        ->select('no_antrian AS NoTest')
                        ->where('user_id', $user_id)
                        ->where('group_id', 99)
                        ->where('created_dttm >=', $date.' 00:00:00')
                        ->where('created_dttm <=', $date.' 23:59:59')
                        ->limit(1)
                        ->orderBy('user_exam', 'DESC')
                        ->get();
    }

    public function getNotestHasilRH($user_id) {
        return $this->db->table('user_exam')
                        ->select('no_antrian AS NoTest')
                        ->where('user_id', $user_id)
                        ->where('group_id', 99)
                        ->limit(1)
                        ->orderBy('user_exam', 'DESC')
                        ->get();
    }
    
    public function getNotest($user_id) {
        $date = date('Y-m-d');
        return $this->db->table('user_exam')
                        ->select('no_antrian AS NoTest')
                        ->where('user_id', $user_id)
                        ->where('group_id', 99)
                        ->where('created_dttm >=', $date.' 00:00:00')
                        ->where('created_dttm <=', $date.' 23:59:59')
                        ->limit(1)
                        ->orderBy('user_exam', 'DESC')
                        ->get();
    }

    public function simpanriwayathidup($data) {
        return $this->db->table('riwayat_hidup')
                        ->insert($data);
    }

    public function simpanidentitas($data) {
        return $this->db->table('person')
                        ->insert($data);
    }

    public function simpankeluarga($data) {
        return $this->db->table('keluarga')
                        ->insert($data);
    }

    public function simpanpendidikanformal($data) {
        return $this->db->table('riwayat_pendidikan_formal')
                        ->insert($data);
    }

    public function simpanpendidikanpolri($data) {
        return $this->db->table('riwayat_pendidikan_polri')
                        ->insert($data);
    }

    public function simpanriwayatpekerjaan($data) {
        return $this->db->table('riwayat_pekerjaan')
                        ->insert($data);
    }

    public function simpanpendidikanspesialis($data) {
        return $this->db->table('riwayat_pendidikan_polri')
                        ->insert($data);
    }

    public function updateriwayathidup($riwayat_hidup_id, $data) {
        return $this->db->table('riwayat_hidup')
                        ->set($data)
                        ->where('riwayat_hidup_id',$riwayat_hidup_id)
                        ->update();
    }

    public function updateidentitas($person_id, $data) {
        return $this->db->table('person')
                        ->set($data)
                        ->where('person_id',$person_id)
                        ->update();
    }

    public function updatekeluarga($keluarga_id, $data) {
        return $this->db->table('keluarga')
                        ->set($data)
                        ->where('keluarga_id',$keluarga_id)
                        ->update();
    }

    public function updatependidikanformal($riwayat_pendidikan_formal_id, $data) {
        return $this->db->table('riwayat_pendidikan_formal')
                        ->set($data)
                        ->where('riwayat_pendidikan_formal_id',$riwayat_pendidikan_formal_id)
                        ->update();
    }

    public function updatependidikanpolri($riwayat_pendidikan_polri_id, $data) {
        return $this->db->table('riwayat_pendidikan_polri')
                        ->set($data)
                        ->where('riwayat_pendidikan_polri_id',$riwayat_pendidikan_polri_id)
                        ->update();
    }

    public function updatependidikanspesialis($riwayat_pendidikan_polri_id, $data) {
        return $this->db->table('riwayat_pendidikan_polri')
                        ->set($data)
                        ->where('riwayat_pendidikan_polri_id',$riwayat_pendidikan_polri_id)
                        ->update();
    }

    public function updateriwayatpekerjaan($riwayat_pekerjaan_id, $data) {
        return $this->db->table('riwayat_pekerjaan')
                        ->set($data)
                        ->where('riwayat_pekerjaan_id',$riwayat_pekerjaan_id)
                        ->update();
    }

    public function getByPersonId($person_id){
        return $this->db->table('person a')
                 ->select('*')
                 ->join('users b', 'b.person_id = a.person_id','left')
                 ->where('a.person_id',$person_id)
                 ->get();
    }


    // ============================ MODEL RH ADMIN

    public function getRiwayatHidup($tanggal) {
        return $this->db->table('users a')
                        ->select('a.user_id, b.addr_txt, b.addr_txt_office, b.birth_dttm, b.birth_place, b.blood_type, b.cellphone, b.country, b.email, b.gender_cd, b.jabatan, b.jabatan_atasan, c.jenis_pengajuan_id,
                        b.nama_atasan, b.nrp, b.pangkat, b.person_id, b.person_nm, b.religion, c.riwayat_hidup_id, b.status_pernikahan, c.nama_file, c.lokasi_file, c.tempat_ttd, c.tanggal_ttd, e.satuan_nm')
                        ->join('person b', 'b.person_id = a.person_id')
                        ->join('riwayat_hidup c', 'c.person_id = b.person_id')
                        ->join('satuan e', 'e.satuan_id = b.satuan', 'LEFT')
                        ->where('a.status_cd', 'normal')
                        ->where('b.status_cd', 'normal')
                        ->where('c.tanggal_ttd >=', $tanggal.' 00:00:00')
                        ->where('c.tanggal_ttd <=', $tanggal.' 23:59:59')
                        ->get();
    }

}