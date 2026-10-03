<?php

namespace App\Controllers;
use App\Models\Soalmodel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class MateriN extends BaseController
{
    protected $soalmodel;
    public function __construct()
	{
		$this->session = \Config\Services::session();
        $this->soalmodel = new Soalmodel();
	}

    public function index()
    {
        $request = \Config\Services::request();
        $materi_id = $request->uri->getSegment(2);
        $data['group'] = $this->soalmodel->getGroup()->getResult();
        $data['soal'] = $this->soalmodel->getSoal(1,1,$materi_id,0)->getResult();
        $data['jawaban'] = $this->soalmodel->getjawaban($data['soal'][0]->soal_id)->getResult();
        $data['total_soal'] = $this->soalmodel->getTotalSoal(1,$request->uri->getSegment(2))->getResult();
        return view('front/materin',$data);
    }

    public function biodata() {
        $request = \Config\Services::request();
        $materi_id = $request->uri->getSegment(3);
        $group_id = $request->uri->getSegment(4);
        
        return view('front/biodata');
    }

    public function ujian() {
        $request = \Config\Services::request();
        $group_id = $request->uri->getSegment(3);
        $materi_id = $request->uri->getSegment(4);
        $data['materi'] = $this->soalmodel->getMateriInMateriN()->getResult();
        $kolom_id = 0;
        
        $data['group_id'] = $group_id;
        $data['materi_id'] = $materi_id;
        $data['soal'] = $this->soalmodel->getSoal(1, $group_id, $materi_id, $kolom_id)->getResult();
        $data['jawaban'] = (count($data['soal']) > 0) ? $this->soalmodel->getjawaban($data['soal'][0]->soal_id)->getResult() : [];
        $data['total_soal'] = $this->soalmodel->getTotalSoal($group_id, $materi_id)->getResult();

        $db = \Config\Database::connect();
        $materi_row = $db->table('materi')->where('materi_id', $materi_id)->get()->getRow();
        $data['materi_nm'] = $materi_row ? $materi_row->materi_nm : '';

        return view('front/materiN/ujian', $data);
    }

    public function petunjukmaterin() {
        $request = \Config\Services::request();
        $data = [
            'group_id' => $request->uri->getSegment(4),
            'materi' => $this->soalmodel->getMateriById($request->uri->getSegment(3))->getResult(),
        ];

        return view('front/materiN/petunjukmaterin',$data);
    }

    public function updateFinishRespon() {
        $materi_id = $this->request->getPost("materi_id");
        $group_id = $this->request->getPost("group_id");
        $user_id = $this->session->user_id;

        $data = [
            "status_cd" => "finish"
        ];
        $reset = $this->soalmodel->updateFinishRespon($materi_id, $group_id, $user_id, $data);

        return $this->response->setJSON($reset);
    }

    public function insertNoTest() {
        if ($this->session->get("user_nm") == "") {
			return redirect('/');
		}
        $request = \Config\Services::request();
        $dataexam = [
            "group_id" => $group_id,
            "materi_id" => $materi,
            "user_id" => $this->session->user_id,
            "no_antrian" => $no_antrian,
        ];
        $insertexam = $this->soalmodel->insertexam($dataexam);
    }

    public function startujian() {
        if ($this->session->get("user_nm") == "") {
			return redirect('/');
		}
        $request = \Config\Services::request();
        $soal_id = $this->request->getPost("soal_id");
        $jawaban_id = $this->request->getPost("jawaban_id");
        $group_id = $this->request->getPost("group_id");
        $no_soal = (int)$this->request->getPost("no_soal");
        $pilihan_nm = $this->request->getPost("pilihan_nm");
        $kolom_id = (int)$this->request->getPost("kolom_id");
        $materi = $this->request->getPost("materi");
        $proc = $this->request->getPost("proc");
        $waktu = $this->request->getPost("waktu");
        $date = date("Y-m-d H:i:s");

        if ($proc == "next" && empty($jawaban_id) && empty($pilihan_nm)) {
            return $this->response->setJSON("jawaban_kosong");
        }

        if ($proc != "prev" && $proc != "prevsoal" && $proc != "start") {
            $getResponByid = $this->soalmodel->getResponByPrev($soal_id, $group_id, $materi, $this->session->user_id)->getResult();
            if (count($getResponByid) > 0) {
                $data = [
                    "jawaban_id" => $jawaban_id,
                    "pilihan_nm" => $pilihan_nm,
                    "soal_id" => $soal_id,
                    "no_soal" => $no_soal,
                    "group_id" => $group_id,
                    "materi" => $materi,
                    "created_user_id" => $this->session->user_id,
                    "created_dttm" => $date,
                    "used" => 0,
                    "kolom_id" => $kolom_id,
                ];
    
                $this->soalmodel->updateResponPrev($soal_id, $group_id, $materi, $this->session->user_id, $data);
            } else {
                if ($jawaban_id !== "null" && !empty($soal_id)) {
                    $data = [
                        "jawaban_id" => $jawaban_id,
                        "pilihan_nm" => $pilihan_nm,
                        "soal_id" => $soal_id,
                        "no_soal" => $no_soal,
                        "group_id" => $group_id,
                        "materi" => $materi,
                        "used" => 0,
                        "kolom_id" => $kolom_id,
                        "created_user_id" => $this->session->user_id,
                        "created_dttm" => $date,
                    ];
        
                    $this->soalmodel->simpanRespon($data);
                }
            }
        }

        if ($proc == "selesai") {
            return $this->response->setJSON(["proc" => "selesai"]);
        }

        if ($proc == "prevsoal") {
            $no_soal = $no_soal - 1;
        } else if ($proc == "next") {
            $no_soal = $no_soal + 1;
        } else if ($proc == "start" && $no_soal < 1) {
            $no_soal = 1;
        }

        $res = $this->soalmodel->getSoal($no_soal, $group_id, $materi, $kolom_id)->getResult();
        if (count($res) == 0 && $proc == "next") {
            return $this->response->setJSON(["proc" => "selesai"]);
        }

        $soal_nm = "";
        $group_nm = "";
        if (count($res) > 0) {
            $soal_nm = $res[0]->soal_nm;
            $soal_id = $res[0]->soal_id;
            $group_id = $res[0]->group_id;   
            $group_nm = isset($res[0]->group_nm) ? $res[0]->group_nm : "";   
            $kolom_id = $res[0]->kolom_id;
        }

        $res_ttlsoal = $this->soalmodel->getTotalSoal($group_id, $materi)->getResult();

        // Ambil semua respon tersimpan untuk materi dan group ini oleh user
        $db = \Config\Database::connect();
        $all_respon = $db->table('respon')
                         ->select('soal_id, pilihan_nm')
                         ->where('group_id', $group_id)
                         ->where('created_user_id', $this->session->user_id)
                         ->whereIn('status_cd', ['normal', 'finish'])
                         ->where('materi', $materi)
                         ->get()
                         ->getResult();

        $respon_map = [];
        foreach ($all_respon as $resp) {
            $respon_map[$resp->soal_id] = $resp->pilihan_nm;
        }

        $pilihan_nmx = isset($respon_map[$soal_id]) ? $respon_map[$soal_id] : "";

        // Build box_list
        $box_list = [];
        foreach ($res_ttlsoal as $boxsoal) {
            $has_respon = isset($respon_map[$boxsoal->soal_id]);
            $box_list[] = [
                "no_soal"    => (int)$boxsoal->no_soal,
                "soal_id"    => $boxsoal->soal_id,
                "has_respon" => $has_respon,
                "pilihan_nm" => $has_respon ? $respon_map[$boxsoal->soal_id] : ""
            ];
        }

        // Build jawaban_list
        $jawaban_list = [];
        $jawaban_idx = "";
        $pilihan_nms = "";
        if (count($res) > 0) {
            $getjawaban = $this->soalmodel->getjawaban($res[0]->soal_id)->getResult();
            foreach ($getjawaban as $key) {
                if ($pilihan_nmx == $key->pilihan_nm) {
                    $jawaban_idx = $key->jawaban_id;
                    $pilihan_nms = $key->pilihan_nm;
                }
                $jawaban_list[] = [
                    "jawaban_id"  => $key->jawaban_id,
                    "pilihan_nm"  => $key->pilihan_nm,
                    "jawaban_nm"  => $key->jawaban_nm,
                    "jawaban_img" => isset($key->jawaban_img) ? $key->jawaban_img : ""
                ];
            }
        }

        return $this->response->setJSON([
            "soal_id"          => $soal_id,
            "soal_nm"          => $soal_nm,
            "no_soal"          => $no_soal,
            "group_id"         => $group_id,
            "group_nm"         => $group_nm,
            "kolom_id"         => $kolom_id,
            "proc"             => $proc,
            "jawaban_idx"      => $jawaban_idx,
            "pilihan_nms"      => $pilihan_nms,
            "pilihan_nmx"      => $pilihan_nmx,
            "total_soal_count" => count($res_ttlsoal),
            "materi_id"        => $materi,
            "durasi"           => 5400,
            "soal"             => count($res) > 0 ? [
                "soal_img" => isset($res[0]->soal_img) ? $res[0]->soal_img : "",
                "materi"   => isset($res[0]->materi) ? $res[0]->materi : $materi
            ] : null,
            "jawaban_list"     => $jawaban_list,
            "box_list"         => $box_list,
            "base_url"         => base_url()
        ]);
    }

    public function sikapkerja() {
        $request = \Config\Services::request();
        $data['materi'] = $this->soalmodel->getMateriById(21)->getResult();
        $materi_id = $request->uri->getSegment(4);
        $group_id = $request->uri->getSegment(3);
        return view('front/sikapkerja',$data);
    }

    public function sikapkerjaujian() {
        $request = \Config\Services::request();
        $proc = $this->request->getPost("proc");
        $soal_id = $this->request->getPost("soal_id");
        $jawaban_id = $this->request->getPost("jawaban_id");
        $group_id = $this->request->getPost("group_id");
        $no_soal = $this->request->getPost("no_soal");
        $pilihan_nm = $this->request->getPost("pilihan_nm");
        $kolom_id = $this->request->getPost("kolom_id");
        $materi = $this->request->getPost("materi");
        $date = date("Y-m-d H:i:s");
        if (isset($jawaban_id)) {
            $data = [
                "jawaban_id" => $jawaban_id,
                "pilihan_nm" => $pilihan_nm,
                "soal_id" => $soal_id,
                "no_soal" => $no_soal,
                "group_id" => $group_id,
                "materi" => $materi,
                "used" => 0,
                "kolom_id" => $kolom_id,
                "created_user_id" => $this->session->user_id,
                "created_dttm" => $date,
                "session" => $this->session->session
            ];
            $respon_id = $this->soalmodel->simpanRespon($data);
        }
        $no_soal = $no_soal + 1;
        // if ($proc == "start") {
        //     $kolom_id = $kolom_id + 1;
        // } 

        if ($proc == "persiapan") {
            echo json_encode(array("ret"=>"persiapan", "kolom"=>$kolom_id));
        } else if ($no_soal == 51 && $materi == 21 && $kolom_id <= 10) {
            echo json_encode(array("ret"=>"persiapan", "kolom"=>$kolom_id));
        } else if ($materi == 21 && $kolom_id == 11) {
            echo json_encode(array("ret"=>"selesai"));
        } else {
            $res = $this->soalmodel->getSoal($no_soal,$group_id,$materi,$kolom_id)->getResult();
            if (count($res)>0) {
                $ret = "<div class='col-md-12'>
                    <table border='0' style='margin: 0 auto;'>
                        <tbody>
                            <tr style='font-size:75px;font-weight:bold;text-align:center;'>";
                            if ($res[0]->typesoal == "gambar") {
                                $getjawaban = $this->soalmodel->getjawaban($res[0]->soal_id)->getResult();
                                foreach ($getjawaban as $key) {
                                    $jawaban_nm = explode('|', $key->jawaban_nm);
                                    foreach ($jawaban_nm as $jwb_nm) {
                                        $src = base_url("images/soalskmateri/materi/$materi/kolom/$kolom_id/$jwb_nm");
                                        $ret .= "<td width='70'><img src='$src' style='height: 100px; width: 100px; margin: 5px;'></td>";
                                    }
                                }
                            } else {
                                $getjawaban = $this->soalmodel->getjawaban($res[0]->soal_id)->getResult();
                                foreach ($getjawaban as $key) {
                                    $jawaban_nm = str_split($key->jawaban_nm,1);
                                    foreach ($jawaban_nm as $jwb_nm) {
                                        $ret .= "<td width='70'>$jwb_nm</td>";
                                    }
                                }
                            }

                            // $getjawaban = $this->soalmodel->getjawaban($res[0]->soal_id)->getResult();
                            //     foreach ($getjawaban as $key) {
                            //         $jawaban_nm = str_split($key->jawaban_nm,1);
                            //         foreach ($jawaban_nm as $jwb_nm) {
                            //             $ret .= "<td width='70'>$jwb_nm</td>";
                            //         }
                            //     }

                        $ret .= "</tr>
                            <tr style='font-size:35px;font-weight:normal;text-align:center;'>
                                <td>A</td>
                                <td>B</td>
                                <td>C</td>
                                <td>D</td>
                                <td>E</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class='col-md-12' style='width:100%; margin-top:30px;'>
                    <label style='font-size:20px;' for='Pertanyaan'>Pertanyaan ".$no_soal."</label>
                    <div class='col-md-12 row' style='display:flex; justify-content:center; flex-wrap:wrap;'>";

                    if ($res[0]->typesoal == "gambar") {
                        foreach ($res as $keySoal) {
                            $soal_nm = explode('|', $keySoal->soal_nm);
                            foreach ($soal_nm as $jwb_nm) {
                                $src = base_url("images/soalskmateri/materi/$materi/kolom/$kolom_id/$jwb_nm");
                                $ret .= "<img src='$src' style='height: 100px; width: 100px; margin: 5px;'>";
                            }
                        }
                    } else {
                        foreach ($res as $keySoal) {
                            $soal_nm = str_split($keySoal->soal_nm,1);
                            foreach ($soal_nm as $jwb_nm) {
                                $ret .= "<div class='col-md-2' style='background-color:grey;min-height:70px;font-size:65px;font-weight:bold;text-align:center;margin:10px;display: inline-block;'>
                        ".$jwb_nm."</div>";
                            }
                        }
                    }
                        // foreach ($res as $keySoal) {
                        //     $soal_nm = str_split($keySoal->soal_nm,1);
                        //     foreach ($soal_nm as $jwb_nm) {
                        //         $ret .= "<div style='background-color:grey;min-width:70px;min-height:70px;font-size:65px;font-weight:bold;text-align:center;margin:10px;'>
                        // ".$jwb_nm."</div>";
                        //     }
                        // }
                        
                $ret .= "</div>
                    <div class='col-md-12' style='display:flex;'>";
                    foreach ($getjawaban as $k) {
                        $jawaban_id = $k->jawaban_id;
                        $ret .= "<button onclick='startujian(\"next\",\"A\",".$jawaban_id.",".$res[0]->soal_id.",$group_id,$no_soal,$kolom_id,$materi)' style='margin:5px;font-weight:bold;font-size: 20px;'
                        class='btn btn-block btn-outline-success'>A</button>
                    <button onclick='startujian(\"next\",\"B\",".$jawaban_id.",".$res[0]->soal_id.",$group_id,$no_soal,$kolom_id,$materi)' style='margin:5px;font-weight:bold;font-size: 20px;'
                        class='btn btn-block btn-outline-success'>B</button>
                    <button onclick='startujian(\"next\",\"C\",".$jawaban_id.",".$res[0]->soal_id.",$group_id,$no_soal,$kolom_id,$materi)' style='margin:5px;font-weight:bold;font-size: 20px;'
                        class='btn btn-block btn-outline-success'>C</button>
                    <button onclick='startujian(\"next\",\"D\",".$jawaban_id.",".$res[0]->soal_id.",$group_id,$no_soal,$kolom_id,$materi)' style='margin:5px;font-weight:bold;font-size: 20px;'
                        class='btn btn-block btn-outline-success'>D</button>
                    <button onclick='startujian(\"next\",\"E\",".$jawaban_id.",".$res[0]->soal_id.",$group_id,$no_soal,$kolom_id,$materi)' style='margin:5px;font-weight:bold;font-size: 20px;'
                        class='btn btn-block btn-outline-success'>E</button>";
                    }
                        
                $ret .= "</div>
                </div>";
                echo json_encode(array("ret"=>$ret, "kolom"=>$kolom_id,"group_id"=>$group_id,"no_soal"=>$no_soal));
            } else {
                $ret = "soal_tidak_ada";
                echo json_encode(array("ret"=>$ret));
            }
        }
    }

    public function hasiltryout($materi_param = null, $group_param = null) {
        if ($this->session->get("user_nm") == "" && empty($this->session->get("user_id"))) {
            return redirect('/');
        }

        $request = \Config\Services::request();
        $user_id = $this->session->get("user_id") ?? $this->session->user_id;
        $materi_id = $materi_param ?? $request->uri->getSegment(3);
        $group_id = $group_param ?? $request->uri->getSegment(4);

        $db = \Config\Database::connect();

        // Cari group_id jika tidak ada di URL
        if (empty($group_id)) {
            $last_resp = $db->table('respon')
                ->where('created_user_id', $user_id)
                ->whereIn('materi', [19, 20, 21])
                ->orderBy('respon_id', 'DESC')
                ->get()
                ->getRow();
            if ($last_resp && !empty($last_resp->group_id)) {
                $group_id = $last_resp->group_id;
            } else {
                $group_id = 14;
            }
        }

        // Ambil info group
        $group_row = $db->table('group_soal')->where('group_soal_id', $group_id)->get()->getRow();
        $group_nm = $group_row ? $group_row->group_nm : "Group " . $group_id;

        // Ambil materi untuk materiN (19: Kecerdasan, 20: Kepribadian, 21: Sikap Kerja)
        $materi_rows = $db->table('materi')->whereIn('materi_id', [19, 20, 21])->get()->getResult();
        $id_kecerdasan = 19;
        $id_kepribadian = 20;
        $id_sikapkerja = 21;
        $nm_kecerdasan = "Kecerdasan";
        $nm_kepribadian = "Kepribadian";
        $nm_sikapkerja = "Sikap Kerja";

        foreach ($materi_rows as $mr) {
            $nm = strtolower($mr->materi_nm);
            if (strpos($nm, 'kecerdasan') !== false) {
                $id_kecerdasan = $mr->materi_id;
                $nm_kecerdasan = $mr->materi_nm;
            } else if (strpos($nm, 'kepribadian') !== false) {
                $id_kepribadian = $mr->materi_id;
                $nm_kepribadian = $mr->materi_nm;
            } else if (strpos($nm, 'sikap') !== false) {
                $id_sikapkerja = $mr->materi_id;
                $nm_sikapkerja = $mr->materi_nm;
            }
        }

        // 1. KECERDASAN
        $subquery_kec = $db->table('respon')
            ->select('MAX(respon_id) as max_id')
            ->where('created_user_id', $user_id)
            ->where('materi', $id_kecerdasan);
        if (!empty($group_id)) {
            $subquery_kec->where('group_id', $group_id);
        }
        $subquery_kec->groupBy('soal_id');
        $max_ids_kec = array_column($subquery_kec->get()->getResultArray(), 'max_id');

        $respon_kec = [];
        if (!empty($max_ids_kec)) {
            $respon_kec = $db->table('respon a')
                ->select('a.soal_id, a.pilihan_nm, c.kunci')
                ->join('soal c', 'c.soal_id = a.soal_id', 'left')
                ->whereIn('a.respon_id', $max_ids_kec)
                ->get()
                ->getResult();
        } else {
            $subquery_kec_fb = $db->table('respon')
                ->select('MAX(respon_id) as max_id')
                ->where('created_user_id', $user_id)
                ->where('materi', $id_kecerdasan)
                ->groupBy('soal_id');
            $max_ids_kec_fb = array_column($subquery_kec_fb->get()->getResultArray(), 'max_id');
            if (!empty($max_ids_kec_fb)) {
                $respon_kec = $db->table('respon a')
                    ->select('a.soal_id, a.pilihan_nm, c.kunci')
                    ->join('soal c', 'c.soal_id = a.soal_id', 'left')
                    ->whereIn('a.respon_id', $max_ids_kec_fb)
                    ->get()
                    ->getResult();
            }
        }

        $terjawab_kec = 0;
        $benar_kec = 0;
        $salah_kec = 0;

        foreach ($respon_kec as $rk) {
            if (!empty($rk->pilihan_nm) && $rk->pilihan_nm !== 'null') {
                $terjawab_kec++;
                if (!empty($rk->kunci) && trim(strtoupper($rk->pilihan_nm)) === trim(strtoupper($rk->kunci))) {
                    $benar_kec++;
                } else {
                    $salah_kec++;
                }
            }
        }

        // 2. KEPRIBADIAN
        $subquery_kep = $db->table('respon')
            ->select('MAX(respon_id) as max_id')
            ->where('created_user_id', $user_id)
            ->where('materi', $id_kepribadian);
        if (!empty($group_id)) {
            $subquery_kep->where('group_id', $group_id);
        }
        $subquery_kep->groupBy('soal_id');
        $max_ids_kep = array_column($subquery_kep->get()->getResultArray(), 'max_id');

        $respon_kep = [];
        if (!empty($max_ids_kep)) {
            $respon_kep = $db->table('respon a')
                ->select('a.soal_id, a.pilihan_nm, c.kunci')
                ->join('soal c', 'c.soal_id = a.soal_id', 'left')
                ->whereIn('a.respon_id', $max_ids_kep)
                ->get()
                ->getResult();
        } else {
            $subquery_kep_fb = $db->table('respon')
                ->select('MAX(respon_id) as max_id')
                ->where('created_user_id', $user_id)
                ->where('materi', $id_kepribadian)
                ->groupBy('soal_id');
            $max_ids_kep_fb = array_column($subquery_kep_fb->get()->getResultArray(), 'max_id');
            if (!empty($max_ids_kep_fb)) {
                $respon_kep = $db->table('respon a')
                    ->select('a.soal_id, a.pilihan_nm, c.kunci')
                    ->join('soal c', 'c.soal_id = a.soal_id', 'left')
                    ->whereIn('a.respon_id', $max_ids_kep_fb)
                    ->get()
                    ->getResult();
            }
        }

        $terjawab_kep = 0;
        $benar_kep = 0;
        $salah_kep = 0;

        foreach ($respon_kep as $rkp) {
            if (!empty($rkp->pilihan_nm) && $rkp->pilihan_nm !== 'null') {
                $terjawab_kep++;
                if (!empty($rkp->kunci) && trim(strtoupper($rkp->pilihan_nm)) === trim(strtoupper($rkp->kunci))) {
                    $benar_kep++;
                } else {
                    $salah_kep++;
                }
            }
        }

        // 3. SIKAP KERJA (Per Kolom)
        $kolom_list = $db->table('soal a')
            ->select('a.kolom_id, COALESCE(b.kolom_nm, CONCAT("Kolom ", a.kolom_id)) as kolom_nm')
            ->join('kolom_soal b', 'b.kolom_id = a.kolom_id', 'left')
            ->where('a.materi', $id_sikapkerja)
            ->where('a.status_cd', 'normal')
            ->groupBy('a.kolom_id')
            ->orderBy('a.kolom_id', 'ASC')
            ->get()
            ->getResult();

        if (empty($kolom_list)) {
            $kolom_list = $db->table('kolom_soal')
                ->select('kolom_id, kolom_nm')
                ->orderBy('kolom_id', 'ASC')
                ->get()
                ->getResult();
        }

        if (empty($kolom_list)) {
            $kolom_list = [];
            for ($i = 1; $i <= 10; $i++) {
                $kolom_list[] = (object)[
                    'kolom_id' => $i,
                    'kolom_nm' => "Kolom " . $i
                ];
            }
        }

        $hasil_sikap_kerja = [];
        $total_sk_terjawab = 0;
        $total_sk_benar = 0;
        $total_sk_salah = 0;
        $chart_labels = [];
        $chart_terjawab = [];
        $chart_benar = [];
        $chart_salah = [];

        foreach ($kolom_list as $klm) {
            $kolom_id = $klm->kolom_id;
            $kolom_nm = !empty($klm->kolom_nm) ? $klm->kolom_nm : "Kolom " . $kolom_id;

            $subquery_sk = $db->table('respon')
                ->select('MAX(respon_id) as max_id')
                ->where('created_user_id', $user_id)
                ->where('materi', $id_sikapkerja)
                ->where('kolom_id', $kolom_id);
            if (!empty($group_id)) {
                $subquery_sk->where('group_id', $group_id);
            }
            $subquery_sk->groupBy('soal_id');
            $max_ids_sk = array_column($subquery_sk->get()->getResultArray(), 'max_id');

            $respon_sk = [];
            if (!empty($max_ids_sk)) {
                $respon_sk = $db->table('respon a')
                    ->select('a.pilihan_nm, c.kunci')
                    ->join('soal c', 'c.soal_id = a.soal_id', 'left')
                    ->whereIn('a.respon_id', $max_ids_sk)
                    ->get()
                    ->getResult();
            } else {
                $subquery_sk_fb = $db->table('respon')
                    ->select('MAX(respon_id) as max_id')
                    ->where('created_user_id', $user_id)
                    ->where('materi', $id_sikapkerja)
                    ->where('kolom_id', $kolom_id)
                    ->groupBy('soal_id');
                $max_ids_sk_fb = array_column($subquery_sk_fb->get()->getResultArray(), 'max_id');
                if (!empty($max_ids_sk_fb)) {
                    $respon_sk = $db->table('respon a')
                        ->select('a.pilihan_nm, c.kunci')
                        ->join('soal c', 'c.soal_id = a.soal_id', 'left')
                        ->whereIn('a.respon_id', $max_ids_sk_fb)
                        ->get()
                        ->getResult();
                }
            }

            $terjawab_klm = 0;
            $benar_klm = 0;
            $salah_klm = 0;

            foreach ($respon_sk as $r) {
                if (!empty($r->pilihan_nm) && $r->pilihan_nm !== 'null') {
                    $terjawab_klm++;
                    if (!empty($r->kunci) && trim(strtoupper($r->pilihan_nm)) === trim(strtoupper($r->kunci))) {
                        $benar_klm++;
                    } else {
                        $salah_klm++;
                    }
                }
            }

            $total_sk_terjawab += $terjawab_klm;
            $total_sk_benar += $benar_klm;
            $total_sk_salah += $salah_klm;

            $chart_labels[] = $kolom_nm;
            $chart_terjawab[] = $terjawab_klm;
            $chart_benar[] = $benar_klm;
            $chart_salah[] = $salah_klm;

            $hasil_sikap_kerja[] = (object)[
                'kolom_id' => $kolom_id,
                'kolom_nm' => $kolom_nm,
                'terjawab' => $terjawab_klm,
                'benar'    => $benar_klm,
                'salah'    => $salah_klm
            ];
        }

        $data = [
            'materi_id'          => $materi_id,
            'group_id'           => $group_id,
            'group_nm'           => $group_nm,
            'nm_kecerdasan'      => $nm_kecerdasan,
            'terjawab_kec'       => $terjawab_kec,
            'benar_kec'          => $benar_kec,
            'salah_kec'          => $salah_kec,
            'nm_kepribadian'     => $nm_kepribadian,
            'terjawab_kep'       => $terjawab_kep,
            'benar_kep'          => $benar_kep,
            'salah_kep'          => $salah_kep,
            'nm_sikapkerja'      => $nm_sikapkerja,
            'hasil_sikap_kerja'  => $hasil_sikap_kerja,
            'total_sk_terjawab'  => $total_sk_terjawab,
            'total_sk_benar'     => $total_sk_benar,
            'total_sk_salah'     => $total_sk_salah,
            'chart_labels'       => $chart_labels,
            'chart_terjawab'     => $chart_terjawab,
            'chart_benar'        => $chart_benar,
            'chart_salah'        => $chart_salah,
        ];

        return view('front/materiN/hasiltryout', $data);
    }

}