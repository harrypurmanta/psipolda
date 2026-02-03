<?php namespace App\Models;

use CodeIgniter\Model;

class Usersmodel extends Model
{
    protected $table      = 'users';
    // protected $primaryKey = 'user_id';
    protected $allowedFields = ['user_nm', 'pwd0','user_group','person_id','status_cd', 'created_dttm','created_user','update_dttm','update_user','nullified_dttm','nullified_user'];

    public function getSatuan() {
        return $this->db->table('person')
                        ->select('satuan')
                        ->groupBy('satuan')
                        ->get();
    }
    
    public function getNotest($user_id, $group_id) {
        return $this->db->table('user_exam')
                        ->select('*')
                        ->where('user_id', $user_id)
                        ->where('group_id', $group_id)
                        ->get();
    }

    public function cekperson($person_nm,$satuan,$birth_place,$birth_dttm,$materi_id,$group_id) {
        return $this->db->table('user_exam a')
                        ->join('users b','b.user_id = a.user_id')
                        ->join('person c','c.person_id = b.person_id')
                        ->where('c.person_nm', $person_nm)
                        ->where('c.satuan',$satuan)
                        ->where('c.birth_place',$birth_place)
                        ->where('c.birth_dttm',$birth_dttm)
                        ->where('a.materi_id',$materi_id)
                        ->where('a.group_id',$group_id)
                        ->get();
    }
    public function checklogin($u,$p) {
        return $this->db->table('users a')
                        ->join('person b','b.person_id = a.person_id')
                        ->where('a.user_nm', $u)
                        ->where('a.pwd0',$p)
                        ->where('a.user_group','siswa')
                        ->get();
    }
    public function checkloginadmin($u,$p) {
        return $this->db->table('users')
                        ->where('user_nm', $u)
                        ->where('pwd0',$p)
                        ->whereIn('user_group',['owner','manajer'])
                        ->get();
    }

    public function getbyCellphone($cellphone) {
        return $this->db->table('person a')
                        ->select('*')
                        ->join('users b', 'b.person_id = a.person_id','left')
                        ->where('a.status_cd', 'normal')
                        ->where('a.cellphone', $cellphone)
                        ->get();
    }

    public function getbynrp($nrp) {
        return $this->db->table('person a')
                        ->select('*')
                        ->join('users b', 'b.person_id = a.person_id','left')
                        ->where('a.status_cd', 'normal')
                        ->where('a.nrp', $nrp)
                        ->get();
    }

    public function checkUsernm($user_nm) {
        return $this->db->table('person a')
                        ->select('*')
                        ->join('users b', 'b.person_id = a.person_id','left')
                        ->where('a.status_cd', 'normal')
                        ->where('b.user_nm', $user_nm)
                        ->get();
    }

    public function getbynormal() {
        return $this->db->table('person a')
                        ->select('*')
                        ->join('users b', 'b.person_id = a.person_id','left')
                        ->join('satuan c', 'c.satuan_id = a.satuan','left')
                        ->join('pendidikan d', 'd.pendidikan_id = a.pendidikan','left')
                        ->where('a.status_cd', 'normal')
                        ->where('b.user_group', 'siswa')
                        ->get();
    }

    public function getbyId($id){
        return $this->db->table('person a')
                 ->select('*')
                 ->join('users b', 'b.person_id = a.person_id','left')
                 ->where('a.person_id',$id)
                 ->get();
    }

    public function getbyUserId($user_id){
        return $this->db->table('person a')
                 ->select('*')
                 ->join('users b', 'b.person_id = a.person_id','left')
                 ->join('satuan c', 'c.satuan_id = a.satuan','left')
                 ->join('pendidikan d', 'd.pendidikan_id = a.pendidikan','left')
                 ->where('b.user_id',$user_id)
                 ->get();
    }

    public function getbyUsernm($user_nm){
        return $this->db->table('users')
                        ->where('user_nm',$user_nm)
                        ->get();
    }

    public function updateuser($person_id,$data) {
        return $this->db->table('users')
                        ->set($data)
                        ->where('person_id',$person_id)
                        ->update();
    }

    public function updateperson($person_id,$data) {
        return $this->db->table('person')
                        ->set($data)
                        ->where('person_id',$person_id)
                        ->update();
    }

    public function getMaxSessionUser($user_id) {
        return $this->db->table('session_soal')
                        ->select('session_soal_nm')
                        ->where('user_id',$user_id)
                        ->orderby('session_soal_id','desc')
                        ->limit(1)
                        ->get();
    }

    public function simpanSessionUser($data) {
        $this->db->table('session_soal')
                 ->insert($data);
    }

    public function simpanuser($data) {
        $this->db->table('users')
                 ->insert($data);
        return $this->db->insertID();
    }

    public function simpanperson($data) {
        $this->db->table('person')
                 ->insert($data);
        return $this->db->insertID();
    }

    public function hapususer($person_id) {
        $this->db->table("person")
                 ->set("status_cd","nullified")
                 ->where("person_id",$person_id)
                 ->update();

        $this->db->table("users")
                 ->set("status_cd","nullified")
                 ->where("person_id",$person_id)
                 ->update();
    }

    public function getjawAllJMateri() {
        return $this->db->table('materi')
                        ->select('*')
                        ->where('status_cd','normal')
                        ->whereNotIn('materi_nm',["Sikap Kerja","Latihan"])
                        ->get();
    }

    public function gethasillatihanbyid($user_id) {

    }

    public function getJenisSoal() {
        return $this->db->table('jenis_soal')
                        ->select('*')
                        ->where('status_cd','normal')
                        ->get();
    }

    public function getResponLatihanmateri($user_id,$materi_id) {
        return $this->db->table('respon_latihan')
                        ->select('*')
                        ->where('created_user_id',$user_id)
                        ->where('materi',$materi_id)
                        ->groupby('used')
                        ->get();
    }

    public function getlatihanKecerdasanSkor($user_id,$used,$materi_id) {
        return $this->db->table('respon_latihan a')
                        ->select('*, a.pilihan_nm as pilihan_respon, a.no_soal as no_soal_respon,c.kunci as kunci_soal,b.jawaban_nm as jawaban_nmx')
                        ->join('jawaban b','b.jawaban_id=a.jawaban_id','left')
                        ->join('soal c','c.soal_id=b.soal_id','left')
                        ->where('a.group_id',2)
                        ->where('a.created_user_id',$user_id)
                        ->where('a.used',$used)
                        ->where('a.materi',$materi_id)
                        ->get(); 
    }

    public function getlatihanKepribadianSkor($user_id,$used,$materi_id) {
        return $this->db->table('respon_latihan a')
                        ->select('*, a.pilihan_nm as pilihan_respon, a.no_soal as no_soal_respon,c.kunci as kunci_soal,b.jawaban_nm as jawaban_nmx')
                        ->join('jawaban b','b.jawaban_id=a.jawaban_id','left')
                        ->join('soal c','c.soal_id=b.soal_id','left')
                        ->where('a.group_id',3)
                        ->where('a.created_user_id',$user_id)
                        ->where('a.used',$used)
                        ->where('a.materi',$materi_id)
                        ->get(); 
    }

    public function getUserHasilKreplin($start_dttm,$end_dttm,$group_id,$satuan) {
        if ($satuan == "semua") {
            return $this->db->table('respon a')
                        ->select('c.person_nm, c.satuan, DATE(c.birth_dttm) AS birth_dttm, c.birth_place, c.gender_cd, c.cellphone, b.user_id, a.created_user_id, d.satuan_nm, e.pendidikan_nm')
                        ->join('users b','b.user_id = a.created_user_id')
                        ->join('person c','c.person_id = b.person_id')
                        ->join('satuan d','d.satuan_id = c.satuan')
                        ->join('pendidikan e','e.pendidikan_id = c.pendidikan')
                        ->where('a.created_dttm >=', $start_dttm.' 00:00:00')
                        ->where('a.created_dttm <=', $end_dttm.' 23:59:59')
                        ->where('a.group_id',$group_id)
                        ->where('a.status_cd', 'finish')
                        ->groupBy('a.created_user_id')
                        ->get(); 
        } else {
            return $this->db->table('respon a')
                        ->select('c.person_nm, c.satuan, DATE(c.birth_dttm) AS birth_dttm, c.birth_place, c.gender_cd, c.cellphone, b.user_id, a.created_user_id, d.satuan_nm, e.pendidikan_nm')
                        ->join('users b','b.user_id = a.created_user_id')
                        ->join('person c','c.person_id = b.person_id')
                        ->join('satuan d','d.satuan_id = c.satuan')
                        ->join('pendidikan e','e.pendidikan_id = c.pendidikan')
                        ->where('a.created_dttm >=', $start_dttm.' 00:00:00')
                        ->where('a.created_dttm <=', $end_dttm.' 23:59:59')
                        ->where('a.group_id', $group_id)
                        ->where('c.satuan', $satuan)
                        ->groupBy('a.created_user_id')
                        ->get(); 
        }
        
    }

    public function getUserHasilPauli($start_dttm,$end_dttm,$group_id,$satuan) {
        if ($satuan == "semua") {
            return $this->db->table('respon a')
                        ->select('c.person_nm, c.satuan, DATE(c.birth_dttm) AS birth_dttm, c.birth_place, c.gender_cd, c.cellphone, b.user_id, a.created_user_id, d.satuan_nm, e.pendidikan_nm')
                        ->join('users b','b.user_id = a.created_user_id')
                        ->join('person c','c.person_id = b.person_id')
                        ->join('satuan d','d.satuan_id = c.satuan')
                        ->join('pendidikan e','e.pendidikan_id = c.pendidikan')
                        ->where('a.created_dttm >=', $start_dttm.' 00:00:00')
                        ->where('a.created_dttm <=', $end_dttm.' 23:59:59')
                        ->where('a.group_id',$group_id)
                        ->where('a.status_cd', 'finish')
                        ->groupBy('a.created_user_id')
                        ->get(); 
        } else {
            return $this->db->table('respon a')
                        ->select('c.person_nm, c.satuan, DATE(c.birth_dttm) AS birth_dttm, c.birth_place, c.gender_cd, c.cellphone, b.user_id, a.created_user_id, d.satuan_nm, e.pendidikan_nm')
                        ->join('users b','b.user_id = a.created_user_id')
                        ->join('person c','c.person_id = b.person_id')
                        ->join('satuan d','d.satuan_id = c.satuan')
                        ->join('pendidikan e','e.pendidikan_id = c.pendidikan')
                        ->where('a.created_dttm >=', $start_dttm.' 00:00:00')
                        ->where('a.created_dttm <=', $end_dttm.' 23:59:59')
                        ->where('a.group_id', $group_id)
                        ->where('c.satuan', $satuan)
                        ->where('a.status_cd', 'finish')
                        ->groupBy('a.created_user_id')
                        ->get(); 
        }
        
    }

    public function getTanggalTes($user_id, $group_id) {
        return $this->db->table('user_exam')
                        ->select('created_dttm')
                        ->where('group_id',$group_id)
                        ->where('user_id',$user_id)
                        ->get(); 
    }

    public function getDepression($user_id,$group_id,$sk_group_id) {
        return $this->db->table('respon a')
                        ->select('SUM(a.pilihan_nm) as jumlah_d')
                        ->join('soal b','b.soal_id = a.soal_id')
                        ->where('a.created_user_id',$user_id)
                        ->where('b.sk_group_id',$sk_group_id)
                        ->where('a.group_id',$group_id)
                        ->get(); 
    }
    public function getAnxiety($user_id,$group_id,$sk_group_id) {
        return $this->db->table('respon a')
                        ->select('SUM(a.pilihan_nm) as jumlah_a')
                        ->join('soal b','b.soal_id = a.soal_id')
                        ->where('a.created_user_id',$user_id)
                        ->where('b.sk_group_id',$sk_group_id)
                        ->where('a.group_id',$group_id)
                        ->get(); 
    }
    public function getStess($user_id,$group_id,$sk_group_id) {
        return $this->db->table('respon a')
                        ->select('SUM(a.pilihan_nm) as jumlah_s')
                        ->join('soal b','b.soal_id = a.soal_id')
                        ->where('a.created_user_id',$user_id)
                        ->where('b.sk_group_id',$sk_group_id)
                        ->where('a.group_id',$group_id)
                        ->get(); 
    }

    public function getHasilDbiByUserId($user_id,$group_id) {
        return $this->db->table('respon a')
                        ->select('SUM(a.pilihan_nm) as jumlah')
                        ->join('soal b','b.soal_id = a.soal_id')
                        ->where('a.created_user_id',$user_id)
                        ->where('a.group_id',$group_id)
                        ->get(); 
    }

    public function getUserHasilDass($start_dttm,$end_dttm,$group_id) {
        return $this->db->table('respon a')
                        ->select('*')
                        ->join('users b','b.user_id = a.created_user_id')
                        ->join('person c','c.person_id = b.person_id')
                        ->join('satuan d','d.satuan_id = c.satuan')
                        ->join('pendidikan e','e.pendidikan_id = c.pendidikan')
                        ->where('a.created_dttm >=', $start_dttm.' 00:00:00')
                        ->where('a.created_dttm <=', $end_dttm.' 23:59:59')
                        ->where('a.group_id',$group_id)
                        ->where('a.status_cd', 'finish')
                        ->groupBy('a.created_user_id')
                        ->orderBy('a.no_soal')
                        ->get(); 
    }

    public function getUserHasilDbi($start_dttm, $end_dttm, $group_id) {
        return $this->db->table('respon a')
                        ->select('*')
                        ->join('users b','b.user_id = a.created_user_id')
                        ->join('person c','c.person_id = b.person_id')
                        ->join('satuan d','d.satuan_id = c.satuan')
                        ->join('pendidikan e','e.pendidikan_id = c.pendidikan')
                        ->where('a.created_dttm >=', $start_dttm.' 00:00:00')
                        ->where('a.created_dttm <=', $end_dttm.' 23:59:59')
                        ->where('a.group_id',$group_id)
                        ->where('a.status_cd', 'finish')
                        ->groupBy('a.created_user_id')
                        ->orderBy('a.no_soal')
                        ->get(); 
    }
    

    public function getUserHasilPapi($start_dttm,$end_dttm,$group_id) {
        return $this->db->table('respon a')
                        ->select('*')
                        ->join('users b','b.user_id = a.created_user_id')
                        ->join('person c','c.person_id = b.person_id')
                        ->join('satuan d','d.satuan_id = c.satuan')
                        ->join('pendidikan e','e.pendidikan_id = c.pendidikan')
                        ->where('a.created_dttm >=', $start_dttm.' 00:00:00')
                        ->where('a.created_dttm <=', $end_dttm.' 23:59:59')
                        ->where('a.group_id', $group_id)
                        ->where('a.status_cd', 'finish')
                        ->groupBy('a.created_user_id')
                        ->orderBy('a.no_soal')
                        ->get(); 
    }

    public function getUserHasilTiu5($start_dttm, $end_dttm, $group_id, $tipesoal) {
        return $this->db->table('respon a')
                        ->select('*')
                        ->join('users b','b.user_id = a.created_user_id')
                        ->join('person c','c.person_id = b.person_id')
                        ->join('satuan d','d.satuan_id = c.satuan')
                        ->join('pendidikan e','e.pendidikan_id = c.pendidikan')
                        ->where('a.created_dttm >=', $start_dttm.' 00:00:00')
                        ->where('a.created_dttm <=', $end_dttm.' 23:59:59')
                        ->where('a.group_id',$group_id)
                        ->where('a.materi', $tipesoal)
                        ->where('a.status_cd', 'finish')
                        ->groupBy('a.created_user_id')
                        ->orderBy('a.no_soal')
                        ->get(); 
    }



    public function getHasilKreplinByUser($start_dttm,$end_dttm,$user_id,$kolom_id,$sk_group_id) {
        return $this->db->table('respon a')
                        ->select('*,COUNT(respon_id) as jumlah_jawab')
                        ->join('kolom_soal b','b.kolom_id = a.kolom_id')
                        ->join('soal c','c.soal_id = a.soal_id')
                        ->where('a.created_dttm >=', $start_dttm.' 00:00:00')
                        ->where('a.created_dttm <=', $end_dttm.' 23:59:59')
                        ->where('a.created_user_id',$user_id)
                        ->where('a.kolom_id',$kolom_id)
                        ->where('c.sk_group_id',$sk_group_id)
                        ->where('c.group_id', 3)
                        ->orderBy('a.created_dttm')
                        // ->groupBy('a.kolom_id')
                        // ->groupBy('c.sk_group_id')
                        ->get(); 
    }

    

    public function getHasilPauliByUser($start_dttm, $end_dttm, $user_id, $sk_group_id)
{
    // subquery respon (AMAN, tanpa string ON JOIN)
    $responSub = $this->db->table('respon')
        ->select('respon_id, soal_id, pilihan_nm')
        ->where('created_user_id', $user_id)
        ->where('status_cd', 'finish')
        ->where('created_dttm >=', $start_dttm . ' 00:00:00')
        ->where('created_dttm <=', $end_dttm . ' 23:59:59')
        ->getCompiledSelect();

    return $this->db->table('kolom_pauli k')
        ->select([
            'k.kolom_id', 'k.kolom_nm',

            'COUNT(c.soal_id) AS total_soal',

            'COALESCE(SUM(CASE 
                WHEN r.pilihan_nm IS NOT NULL AND r.pilihan_nm <> "" 
                THEN 1 ELSE 0 
            END),0) AS terjawab',

            'COALESCE(SUM(CASE 
                WHEN r.pilihan_nm IS NULL OR r.pilihan_nm = "" 
                THEN 1 ELSE 0 
            END),0) AS tidak_terjawab',

            'COALESCE(SUM(CASE 
                WHEN r.pilihan_nm IS NOT NULL 
                 AND r.pilihan_nm <> "" 
                 AND r.pilihan_nm <> c.kunci 
                THEN 1 ELSE 0 
            END),0) AS salah'
        ])
        ->join(
            'soal c',
            'c.kolom_id = k.kolom_id
             AND c.group_id = 9
             AND c.status_cd = "normal"
             AND c.materi = 11
             AND c.sk_group_id = '.$this->db->escape($sk_group_id),
            'left'
        )
        ->join(
            "($responSub) r",
            'r.soal_id = c.soal_id',
            'left'
        )
        ->groupBy('k.kolom_id')
        ->orderBy('k.kolom_id', 'ASC')
        ->get();
}





    // public function getHasilPauliByUser($start_dttm,$end_dttm,$user_id,$kolom_id,$sk_group_id) {
    //     return $this->db->table('respon a')
    //                     ->select('*,COUNT(respon_id) as jumlah_jawab')
    //                     ->join('kolom_soal b','b.kolom_id = a.kolom_id')
    //                     ->join('soal c','c.soal_id = a.soal_id')
    //                     ->where('a.created_dttm >=', $start_dttm.' 00:00:00')
    //                     ->where('a.created_dttm <=', $end_dttm.' 23:59:59')
    //                     ->where('a.created_user_id',$user_id)
    //                     ->where('a.kolom_id',$kolom_id)
    //                     ->where('c.sk_group_id',$sk_group_id)
    //                     ->where('c.group_id', 9)
    //                     ->orderBy('a.created_dttm')
    //                     // ->groupBy('a.kolom_id')
    //                     // ->groupBy('c.sk_group_id')
    //                     ->get(); 
    // }

    public function getPauliSalah($start_dttm,$end_dttm,$user_id)
{
    return $this->db->table('respon a')
        ->select('COUNT(a.respon_id) as jumlah_salah')
        ->join(
            'soal c',
            'c.soal_id = a.soal_id AND c.kunci != a.pilihan_nm',
            'inner'
        )
        ->where('a.created_dttm >=', $start_dttm.' 00:00:00')
        ->where('a.created_dttm <=', $end_dttm.' 23:59:59')
        ->where('a.created_user_id', $user_id)
        ->where('a.group_id', 9)
        ->get();
}


    // public function getPauliSalah($start_dttm,$end_dttm,$user_id) {
    //     return $this->db->table('respon a')
    //                     ->select('count(a.respon_id) as jumlah_salah')
    //                     ->join('soal c','c.soal_id = a.soal_id AND c.kunci != a.pilihan_nm')
    //                     ->where('a.created_dttm >=', $start_dttm.' 00:00:00')
    //                     ->where('a.created_dttm <=', $end_dttm.' 23:59:59')
    //                     ->where('a.created_user_id',$user_id)
    //                     ->where('a.group_id',9)
    //                     ->orderBy('a.created_dttm')
    //                     // ->groupBy('a.kolom_id')
    //                     // ->groupBy('c.sk_group_id')
    //                     ->get(); 
    // }

    public function getKreplinSalah($start_dttm,$end_dttm,$user_id) {
        return $this->db->table('respon a')
                        ->select('count(a.respon_id) as jumlah_salah')
                        ->join('soal c','c.soal_id = a.soal_id AND c.kunci != a.pilihan_nm')
                        ->where('a.created_dttm >=', $start_dttm.' 00:00:00')
                        ->where('a.created_dttm <=', $end_dttm.' 23:59:59')
                        ->where('a.created_user_id',$user_id)
                        ->where('a.group_id',3)
                        ->orderBy('a.created_dttm')
                        // ->groupBy('a.kolom_id')
                        // ->groupBy('c.sk_group_id')
                        ->get(); 
    }

    public function updatekunci($soal_id,$data) {
        return $this->db->table('soal')
                        ->set($data)
                        ->where('soal_id',$soal_id)
                        ->update();
    }
}