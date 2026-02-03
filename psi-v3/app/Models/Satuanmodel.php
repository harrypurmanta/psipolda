<?php namespace App\Models;

use CodeIgniter\Model;

class Satuanmodel extends Model
{
    protected $table      = 'satuan';
    // protected $primaryKey = 'user_id';
    protected $allowedFields = ['satuan_id','satuan_nm', 'satuan_cd','status_cd'];

    public function getSatuan() {
        return $this->db->table('satuan')
                        ->select('*')
                        ->where('status_cd', 'normal')
                        ->get();
    }

    public function getPendidikan() {
        return $this->db->table('pendidikan')
                        ->select('*')
                        ->where('status_cd', 'normal')
                        ->get();
    }

    public function resetResponBySatuan($satuan_id) {
        // return $this->db->table('person a')
        //                 ->join('users b', 'b.person_id = a.person_id')
        //                 ->join('respon c', 'c.created_user_id = b.user_id')
        //                 ->where('a.satuan', $satuan_id)
        //                 ->where('c.status_cd', 'finish')
        //                 ->set('c.status_cd', 'reset')
        //                 ->update();

        return $this->db->table('respon a')
                        ->join('users b', 'b.user_id = a.created_user_id')
                        ->join('person c', 'c.person_id = b.person_id AND c.satuan =' . $satuan_id)
                        // ->where('c.satuan', $satuan_id)
                        ->where('a.status_cd', 'finish')
                        ->set('a.status_cd', 'reset')
                        ->update();
    }
}