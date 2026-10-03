<?php 

namespace App\Models;

use CodeIgniter\Model;

class SoalmodelSKMateri extends Model
{
    protected $table = 'soal';
    protected $primaryKey = 'soal_id';
    protected $allowedFields = ['soal_id', 'no_soal', 'soal_nm', 'soal_img', 'kunci', 'status_cd', 'group_id', 'materi', 'kolom_id', 'clue', 'typesoal', 'sk_group_id'];

    public function getKolomSkMateri($group_id = 14, $materi_id = 21)
    {
        return $this->db->table('kolom_soal a')
            ->select('a.kolom_id, b.clue, a.kolom_nm')
            ->join('soal b', 'b.kolom_id = a.kolom_id AND b.group_id = ' . (int)$group_id . ' AND b.materi = ' . (int)$materi_id . ' AND b.status_cd = "normal"', 'left')
            ->groupBy('a.kolom_id, b.clue, a.kolom_nm')
            ->orderBy('a.kolom_id', 'ASC')
            ->get();
    }

    public function getKolomById($kolom_id)
    {
        return $this->db->table('kolom_soal')
            ->select('*')
            ->where('kolom_id', $kolom_id)
            ->get();
    }

    public function getSoalByIdSK($kolom_id, $group_id = 14, $materi_id = 21, $sk_group_id = 0)
    {
        return $this->db->table('soal')
            ->select('*')
            ->where('kolom_id', $kolom_id)
            ->where('group_id', $group_id)
            ->where('materi', $materi_id)
            ->where('sk_group_id', $sk_group_id)
            ->where('status_cd', 'normal')
            ->orderBy('no_soal', 'ASC')
            ->get();
    }

    public function getJawabanBySoalId($soal_id)
    {
        return $this->db->table('jawaban')
            ->select('*')
            ->where('soal_id', $soal_id)
            ->where('status_cd', 'normal')
            ->get();
    }

    public function getSoalIdByClue($clue, $group_id = 14, $sk_group_id = 0, $kolom_id = null, $materi_id = 21)
    {
        $builder = $this->db->table('soal')
            ->select('soal_id')
            ->where('group_id', $group_id)
            ->where('materi', $materi_id)
            ->where('sk_group_id', $sk_group_id)
            ->where('status_cd', 'normal');

        if (!empty($clue)) {
            $builder->where('clue', $clue);
        }
        if ($kolom_id !== null) {
            $builder->where('kolom_id', $kolom_id);
        }

        return $builder->orderBy('no_soal', 'ASC')->get();
    }

    public function getSoalIdByClueSKGambar($clue, $group_id = 14, $sk_group_id = 0, $kolom_id = null, $materi_id = 21)
    {
        $builder = $this->db->table('soal')
            ->select('soal_id')
            ->where('group_id', $group_id)
            ->where('materi', $materi_id)
            ->where('sk_group_id', $sk_group_id)
            ->where('status_cd', 'normal');

        if (!empty($clue)) {
            $builder->where('clue', $clue);
        }
        if ($kolom_id !== null) {
            $builder->where('kolom_id', $kolom_id);
        }

        return $builder->orderBy('no_soal', 'ASC')->get();
    }

    public function insertSoal($data)
    {
        $this->db->table('soal')->insert($data);
        return $this->db->insertID();
    }

    public function insertJawaban($data)
    {
        return $this->db->table('jawaban')->insert($data);
    }

    public function updateSoalById($soal_id, $data)
    {
        return $this->db->table('soal')
            ->where('soal_id', $soal_id)
            ->update($data);
    }

    public function updateJawabanBySoalId($soal_id, $data)
    {
        return $this->db->table('jawaban')
            ->where('soal_id', $soal_id)
            ->update($data);
    }

    public function updatesoalsk($group_id, $sk_group_id, $kolom, $data, $soal_id, $jawaban_nm_lama, $materi_id = 21)
    {
        return $this->db->table('soal')
            ->set($data)
            ->where('group_id', $group_id)
            ->where('sk_group_id', $sk_group_id)
            ->where('kolom_id', $kolom)
            ->where('soal_id', $soal_id)
            ->where('materi', $materi_id)
            ->update();
    }

    public function updatejawabansk($jawaban_nm, $data, $soal_id, $jawaban_nm_lama)
    {
        return $this->db->table('jawaban')
            ->set($data)
            ->where('soal_id', $soal_id)
            ->update();
    }

    public function updateSingleSoal($soal_id, $soal_nm)
    {
        return $this->db->table('soal')
            ->where('soal_id', $soal_id)
            ->update(['soal_nm' => $soal_nm]);
    }
}
