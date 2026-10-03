<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Usersmodel;
use App\Models\Soalmodel;
use App\Models\SoalmodelSKMateri;
use App\Models\Jawabanmodel;

class Soalsikapkerjamateri extends BaseController
{
    protected $session;
    protected $usermodel;
    protected $soalmodel;
    protected $jawabanmodel;
    protected $SoalmodelSKMateri;

    const GROUP_ID = 14;
    const MATERI_ID = 21;
    const SK_GROUP_ID = 0;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->usermodel = new Usersmodel();
        $this->soalmodel = new Soalmodel();
        $this->jawabanmodel = new Jawabanmodel();
        $this->SoalmodelSKMateri = new SoalmodelSKMateri();
    }

    public function index()
    {
        if ($this->session->get("user_nm") == "") {
            return redirect('/');
        }

        $db = \Config\Database::connect();
        $materi_row = $db->table('materi')->where('materi_id', self::MATERI_ID)->get()->getRow();

        $data = [
            'materi' => [
                (object)[
                    'materi_id' => self::MATERI_ID,
                    'materi_nm' => $materi_row ? $materi_row->materi_nm : 'Sikap Kerja'
                ]
            ],
            'group_id' => self::GROUP_ID,
            'materi_id' => self::MATERI_ID,
            'sk_group_id' => self::SK_GROUP_ID
        ];

        return view('admin/soalskmateri/soal', $data);
    }

    public function showkolom()
    {
        $group_id = self::GROUP_ID;
        $materi_id = self::MATERI_ID;

        $res = $this->SoalmodelSKMateri->getKolomSkMateri($group_id, $materi_id)->getResult();

        return $this->response->setJSON($res);
    }

    public function tambahsoalSkMateri()
    {
        if ($this->session->get("user_nm") == "") {
            return redirect('/');
        }

        $kolom_id = $this->request->getUri()->getSegment(4) ?: 1;
        $group_id = self::GROUP_ID;
        $materi_id = self::MATERI_ID;
        $sk_group_id = self::SK_GROUP_ID;

        $getSoal = $this->SoalmodelSKMateri->getSoalByIdSK($kolom_id, $group_id, $materi_id, $sk_group_id)->getResult();
        $soal_id_new = count($getSoal) > 0 ? $getSoal[0]->soal_id : null;
        $typeSoal = count($getSoal) > 0 ? $getSoal[0]->typesoal : 'text';

        $total = count($getSoal);
        $size  = $total > 0 ? ceil($total / 4) : 0;

        $bagian1 = $total > 0 ? array_slice($getSoal, 0, $size) : [];
        $bagian2 = $total > 0 ? array_slice($getSoal, $size, $size) : [];
        $bagian3 = $total > 0 ? array_slice($getSoal, $size * 2, $size) : [];
        $bagian4 = $total > 0 ? array_slice($getSoal, $size * 3) : [];

        $data = [
            'kolom' => $this->SoalmodelSKMateri->getKolomById($kolom_id)->getResult(),
            'bagian1' => $bagian1,
            'bagian2' => $bagian2,
            'bagian3' => $bagian3,
            'bagian4' => $bagian4,
            'jawaban' => $soal_id_new ? $this->SoalmodelSKMateri->getJawabanBySoalId($soal_id_new)->getResult() : [],
            'soal_id' => $soal_id_new,
            'materi_id' => $materi_id,
            'kolom_id' => $kolom_id,
            'sk_group_id' => $sk_group_id,
            'typeSoal' => $typeSoal
        ];

        return view('admin/soalskmateri/tambahsoalskmateri', $data);
    }

    public function viewEditsoalSkMateri()
    {
        if ($this->session->get("user_nm") == "") {
            return redirect('/');
        }

        $kolom_id = $this->request->getUri()->getSegment(4) ?: 1;
        $group_id = self::GROUP_ID;
        $materi_id = self::MATERI_ID;
        $sk_group_id = self::SK_GROUP_ID;

        $getSoal = $this->SoalmodelSKMateri->getSoalByIdSK($kolom_id, $group_id, $materi_id, $sk_group_id)->getResult();
        if (count($getSoal) > 0) {
            $soal_id_new = $getSoal[0]->soal_id;
            $typeSoal = $getSoal[0]->typesoal ?: 'text';
        } else {
            $soal_id_new = null;
            $typeSoal = 'text';
        }

        $total = count($getSoal);
        $size  = $total > 0 ? ceil($total / 4) : 0;

        $bagian1 = $total > 0 ? array_slice($getSoal, 0, $size) : [];
        $bagian2 = $total > 0 ? array_slice($getSoal, $size, $size) : [];
        $bagian3 = $total > 0 ? array_slice($getSoal, $size * 2, $size) : [];
        $bagian4 = $total > 0 ? array_slice($getSoal, $size * 3) : [];

        $data = [
            'kolom' => $this->SoalmodelSKMateri->getKolomById($kolom_id)->getResult(),
            'bagian1' => $bagian1,
            'bagian2' => $bagian2,
            'bagian3' => $bagian3,
            'bagian4' => $bagian4,
            'jawaban' => $soal_id_new ? $this->SoalmodelSKMateri->getJawabanBySoalId($soal_id_new)->getResult() : [],
            'soal_id' => $soal_id_new,
            'materi_id' => $materi_id,
            'kolom_id' => $kolom_id,
            'sk_group_id' => $sk_group_id,
            'typeSoal' => $typeSoal
        ];

        return view('admin/soalskmateri/editsoalskmateri', $data);
    }

    public function detailsoal()
    {
        return $this->viewEditsoalSkMateri();
    }

    public function updateclue()
    {
        if ($this->session->get("user_nm") == "") {
            return $this->response->setJSON("unauthorized");
        }

        $kolom_id = (int)$this->request->getPost('kolom_id');
        $jawaban_nm = strtoupper(trim($this->request->getPost('jawaban_nm')));
        $jawaban_nm_lama = strtoupper(trim($this->request->getPost('jawaban_nm_lama')));
        $group_id = self::GROUP_ID;
        $materi_id = self::MATERI_ID;
        $sk_group_id = self::SK_GROUP_ID;

        $soalList = $this->SoalmodelSKMateri->getSoalByIdSK($kolom_id, $group_id, $materi_id, $sk_group_id)->getResult();

        if (count($soalList) == 0) {
            $res = $this->randomchar($jawaban_nm, $kolom_id, $materi_id, $sk_group_id, $group_id);
        } else {
            if ($jawaban_nm_lama === $jawaban_nm) {
                $res = "finish";
            } else {
                $res = $this->randomcharUpdate($jawaban_nm, $kolom_id, $materi_id, $sk_group_id, $group_id, $soalList, $jawaban_nm_lama);
            }
        }

        return $this->response->setJSON([
            'status' => ($res === 'finish'),
            'message' => $res
        ]);
    }

    public function insertGambarSk()
    {
        return $this->updateGambarSk();
    }

    public function updateGambarSk()
    {
        if ($this->session->get("user_nm") == "") {
            return $this->response->setJSON(['status' => false, 'message' => 'Unauthorized']);
        }

        $kolom_id = (int)$this->request->getPost('kolom_id');
        $jawaban_nm_lama = $this->request->getPost('jawaban_lama') ?: $this->request->getPost('jawaban_nm_lama');
        $group_id = self::GROUP_ID;
        $materi_id = self::MATERI_ID;
        $sk_group_id = self::SK_GROUP_ID;
        $allowedMime = ['image/png', 'image/jpg', 'image/jpeg'];

        $path = FCPATH . "images/soalskmateri/materi/$materi_id/kolom/$kolom_id";
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        $soal_nm = [];
        $uploadedFiles = [];
        $pilihanArr = ['A', 'B', 'C', 'D', 'E'];

        for ($i = 1; $i <= 5; $i++) {
            $file = $this->request->getFile('gambarsk' . $i);
            if (!$file || !$file->isValid()) {
                continue;
            }

            if (!in_array($file->getMimeType(), $allowedMime)) {
                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'Hanya gambar diperbolehkan (gambarsk' . $i . ')'
                ]);
            }

            $pilihan = $pilihanArr[$i - 1];
            $newName = $i . $pilihan . '_' . $materi_id . '_' . $kolom_id . '.' . $file->getExtension();
            $fullPath = $path . '/' . $newName;

            if (file_exists($fullPath)) {
                unlink($fullPath);
            }

            if ($file->move($path, $newName)) {
                $uploadedFiles[] = $newName;
                $soal_nm[] = $newName;
            } else {
                return $this->response->setJSON([
                    'status' => false,
                    'message' => $file->getErrorString()
                ]);
            }
        }

        if (count($uploadedFiles) < 5) {
            // Check if existing images already present
            $existingImages = [];
            for ($i = 1; $i <= 5; $i++) {
                $pilihan = $pilihanArr[$i - 1];
                $pattern = $path . '/' . $i . $pilihan . '_' . $materi_id . '_' . $kolom_id . '.*';
                $matches = glob($pattern);
                if (!empty($matches)) {
                    $existingImages[] = basename($matches[0]);
                }
            }
            if (count($existingImages) == 5) {
                $soal_nm = $existingImages;
            } else {
                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'Harap upload kelima gambar A, B, C, D, E'
                ]);
            }
        }

        $soal_nm_str = implode('|', $soal_nm);
        $soalList = $this->SoalmodelSKMateri->getSoalByIdSK($kolom_id, $group_id, $materi_id, $sk_group_id)->getResult();

        if (count($soalList) == 0) {
            $res = $this->randomcharGambar($soal_nm_str, $kolom_id, $materi_id, $sk_group_id, $group_id);
        } else {
            $res = $this->randomcharGambarUpdate($soal_nm_str, $kolom_id, $materi_id, $sk_group_id, $group_id, $soalList, $jawaban_nm_lama);
        }

        return $this->response->setJSON([
            'status' => ($res === 'finish'),
            'message' => $res
        ]);
    }

    public function updatesoalskmateri()
    {
        $soal_id = $this->request->getPost('soal_id');
        $soal_nm = $this->request->getPost('soal_nm');

        $updatesoal = $this->SoalmodelSKMateri->updateSingleSoal($soal_id, $soal_nm);
        $ret = $updatesoal ? "berhasil" : "gagal";

        return $this->response->setJSON([
            'status' => ($ret === 'berhasil'),
            'message' => $ret
        ]);
    }

    public function randomchar($char, $kolom, $materi_id = 21, $sk_group_id = 0, $group_id = 14)
    {
        $characters = $char;
        $pilihan = "ABCDE";
        $no = 1;

        for ($i = 0; $i < 50; $i++) {
            $indexs = rand(0, strlen($pilihan) - 1);
            $kunci = $pilihan[$indexs];

            $hilang = $characters[$indexs];
            $soal_txt = $this->randsoal($characters, "");

            if (strlen($soal_txt) === 5) {
                $soal_nm = str_replace($hilang, "", $soal_txt);
            } else {
                $soal_nm = $soal_txt;
            }

            $data = [
                'soal_nm' => $soal_nm,
                'group_id' => $group_id,
                'no_soal' => $no,
                'kunci' => $kunci,
                'materi' => $materi_id,
                'status_cd' => 'normal',
                'kolom_id' => $kolom,
                'clue' => $characters,
                'sk_group_id' => $sk_group_id,
                'typesoal' => "text"
            ];

            $soal_id = $this->SoalmodelSKMateri->insertSoal($data);

            $datax = [
                "soal_id" => $soal_id,
                "pilihan_nm" => $pilihan,
                "jawaban_nm" => $characters,
                "jawaban_img" => "",
                "status_cd" => "normal"
            ];

            $this->SoalmodelSKMateri->insertJawaban($datax);
            $no++;
        }

        return "finish";
    }

    public function randomcharUpdate($char, $kolom, $materi_id = 21, $sk_group_id = 0, $group_id = 14, $soal_id = [], $jawaban_nm_lama = '')
    {
        $characters = $char;
        $pilihan = "ABCDE";
        $no = 1;
        $index = 0;
        $ret = "finish";

        for ($i = 0; $i < 50; $i++) {
            $indexs = rand(0, strlen($pilihan) - 1);
            $kunci = $pilihan[$indexs];

            $hilang = $characters[$indexs];
            $soal_txt = $this->randsoal($characters, "");

            if (strlen($soal_txt) === 5) {
                $soal_nm = str_replace($hilang, "", $soal_txt);
            } else {
                $soal_nm = $soal_txt;
            }

            $data = [
                'soal_nm' => $soal_nm,
                'group_id' => $group_id,
                'no_soal' => $no,
                'kunci' => $kunci,
                'materi' => $materi_id,
                'status_cd' => 'normal',
                'kolom_id' => $kolom,
                'clue' => $characters,
                'sk_group_id' => $sk_group_id,
                'typesoal' => "text"
            ];

            if (isset($soal_id[$index])) {
                $updatesoal = $this->SoalmodelSKMateri->updateSoalById($soal_id[$index]->soal_id, $data);

                if ($updatesoal) {
                    $dataJawaban = [
                        "pilihan_nm" => $pilihan,
                        "jawaban_nm" => $characters,
                        "status_cd" => "normal"
                    ];

                    $updatejawaban = $this->SoalmodelSKMateri->updateJawabanBySoalId($soal_id[$index]->soal_id, $dataJawaban);
                    $ret = $updatejawaban ? "finish" : "gagaljwb";
                } else {
                    $ret = "gagalsoal";
                }
            } else {
                // If fewer than 50 rows existed, insert the rest
                $new_soal_id = $this->SoalmodelSKMateri->insertSoal($data);
                $dataJawaban = [
                    "soal_id" => $new_soal_id,
                    "pilihan_nm" => $pilihan,
                    "jawaban_nm" => $characters,
                    "jawaban_img" => "",
                    "status_cd" => "normal"
                ];
                $this->SoalmodelSKMateri->insertJawaban($dataJawaban);
            }

            $no++;
            $index++;
        }

        return $ret;
    }

    public function randsoal($characters, $randSoal)
    {
        $randomString = $randSoal;
        for ($s = 0; $s < 5; $s++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        $randSoal = count_chars($randomString, 3);
        if (strlen($randSoal) == 5) {
            $soal_nm = str_shuffle($randSoal);
        } else {
            $soal_nm = $this->randsoal($characters, $randSoal);
        }

        return $soal_nm;
    }

    public function randsoalGambar(array $characters): string
    {
        shuffle($characters);
        $selected = array_slice($characters, 0, 5);
        return implode('|', $selected);
    }

    public function randomcharGambar($char, $kolom, $materi_id = 21, $sk_group_id = 0, $group_id = 14)
    {
        $characters = explode('|', $char);
        $pilihan = "ABCDE";
        $no = 1;

        for ($i = 0; $i < 50; $i++) {
            $indexs = rand(0, strlen($pilihan) - 1);
            $kunci = $pilihan[$indexs];

            $index = ord($kunci) - 65;
            $hilang = $characters[$index] ?? '';

            $soal_txt = $this->randsoalGambar($characters);
            $soal_arr = explode('|', $soal_txt);
            $soal_arr = array_values(array_diff($soal_arr, [$hilang]));
            $soal_nm = implode('|', $soal_arr);

            $data = [
                'soal_nm' => $soal_nm,
                'group_id' => $group_id,
                'no_soal' => $no,
                'kunci' => $kunci,
                'materi' => $materi_id,
                'status_cd' => 'normal',
                'kolom_id' => $kolom,
                'clue' => $char,
                'sk_group_id' => $sk_group_id,
                'typesoal' => "gambar"
            ];

            $soal_id = $this->SoalmodelSKMateri->insertSoal($data);

            $datax = [
                "soal_id" => $soal_id,
                "pilihan_nm" => $pilihan,
                "jawaban_nm" => $char,
                "jawaban_img" => "",
                "status_cd" => "normal"
            ];

            $this->SoalmodelSKMateri->insertJawaban($datax);
            $no++;
        }

        return "finish";
    }

    public function randomcharGambarUpdate($char, $kolom, $materi_id = 21, $sk_group_id = 0, $group_id = 14, $soal_id = [], $jawaban_nm_lama = '')
    {
        $characters = explode('|', $char);
        $pilihan = "ABCDE";
        $no = 1;
        $ret = "finish";

        for ($i = 0; $i < 50; $i++) {
            $indexs = rand(0, strlen($pilihan) - 1);
            $kunci = $pilihan[$indexs];

            $index = ord($kunci) - 65;
            $hilang = $characters[$index] ?? '';

            $soal_txt = $this->randsoalGambar($characters);
            $soal_arr = explode('|', $soal_txt);
            $soal_arr = array_values(array_diff($soal_arr, [$hilang]));
            $soal_nm = implode('|', $soal_arr);

            $data = [
                'soal_nm' => $soal_nm,
                'group_id' => $group_id,
                'no_soal' => $no,
                'kunci' => $kunci,
                'materi' => $materi_id,
                'status_cd' => 'normal',
                'kolom_id' => $kolom,
                'clue' => $char,
                'sk_group_id' => $sk_group_id,
                'typesoal' => "gambar"
            ];

            if (isset($soal_id[$i])) {
                $updatesoal = $this->SoalmodelSKMateri->updateSoalById($soal_id[$i]->soal_id, $data);

                if ($updatesoal) {
                    $dataJawaban = [
                        "pilihan_nm" => $pilihan,
                        "jawaban_nm" => $char,
                        "status_cd" => "normal"
                    ];

                    $updatejawaban = $this->SoalmodelSKMateri->updateJawabanBySoalId($soal_id[$i]->soal_id, $dataJawaban);
                    $ret = $updatejawaban ? "finish" : "gagaljwb";
                } else {
                    $ret = "gagalsoal";
                }
            } else {
                $new_soal_id = $this->SoalmodelSKMateri->insertSoal($data);
                $dataJawaban = [
                    "soal_id" => $new_soal_id,
                    "pilihan_nm" => $pilihan,
                    "jawaban_nm" => $char,
                    "jawaban_img" => "",
                    "status_cd" => "normal"
                ];
                $this->SoalmodelSKMateri->insertJawaban($dataJawaban);
            }

            $no++;
        }

        return $ret;
    }
}
